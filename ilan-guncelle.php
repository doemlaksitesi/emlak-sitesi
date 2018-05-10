<?php
define("_VALID_PHP", true);
require_once("init.php");

if (!$user->logged_in)
    redirect_to($SiteAddress . "giris-yap/");

$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();
//$estateCount = CountRow("select count(*) as count_row from t_advert where  user_id='".$row[id]."'");
?>

<?
$ID = toGet($_GET['ID'], $_POST['ID']);
$Category = toGet($_GET['Cat'], $_POST['Cat']);
$Action = toGet($_GET['Action'], $_POST['Action']);
$Video = toGet($_GET['Video'], $_POST['Video']);
$xcoor = toGet($_GET['xcoor'], $_POST['xcoor']);
$ycoor = toGet($_GET['ycoor'], $_POST['ycoor']);

if ($row['userlevel'] !== '9') {
    $clause = "and user_id='" . $row['id'] . "'";
}

$sql = "select * from t_advert where ID='" . $ID . "' $clause ";
$qrEdit = mysql_query($sql);
$rsEdit = mysql_fetch_array($qrEdit);
if (@mysql_num_rows($qrEdit) == 0) {
    redirect_to($SiteAddress . "ilanlarim/");
}

switch ($Action) {

    case 'EditEstate':

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        $t = date("Y-m-d H:i:s");
        $p = $_POST['ilansuresi'] . " day";
        $yenitarih = strtotime($p, strtotime($t));
        $yenitarih = date('Y-m-d H:i:s', $yenitarih);

        //Criteria post, name and values in to array 
        $sql = "select * from e_criteria_type where  Lang='$Lang' and Visible='1' ";
        $q = mysql_query($sql);
        while ($criteria = mysql_fetch_array($q)) {
            if (!empty($_POST[$criteria['SefName']])) {
                if ($criteria['Type'] == 'price') {
                    $UpdateRow[] = $criteria['SefName'] . "=" . "'" . $_POST[$criteria['SefName']] . "'";
                    $UpdateRow[] = $criteria['SefName'] . "_Cur" . "=" . "'" . $_POST[$criteria['SefName'] . "_Cur"] . "'";
                }
                if ($criteria['Type'] == 'date') {
                    $UpdateRow[] = $criteria['SefName'] . "=" . "'" . date("Y-m-d", strtotime($_POST[$criteria['SefName']])) . "'";
                }
                if ($criteria['Type'] == 'textbox' || $criteria['Type'] == 'selectbox') {
                    $UpdateRow[] = $criteria['SefName'] . "=" . "'" . $_POST[$criteria['SefName']] . "'";
                }
                if ($criteria['Type'] == 'checkbox') {
                    $UpdateRow[] = $criteria['SefName'] . "=" . "'" . implode(",", $_POST[$criteria['SefName']]) . "'";
                }
                unlink($_POST[$criteria['SefName']]);
            }
        }
        $RowName = implode(",", $UpdateRow);

        $sql = "update t_advert  set
			il='" . $_POST['il'] . "',
			ilce='" . $_POST['ilce'] . "',
			semt='" . $_POST['semt'] . "',
			mah='" . $_POST['mahalle'] . "',
			xcoor='" . $xcoor . "',
			ycoor='" . $ycoor . "',
			GDate='" . date("Y-m-d H:i:s") . "',
			Video='" . $Video . "',
			$RowName			
			where ID='" . $ID . "' ";
        $query = mysql_query($sql);

        if ($query) {

            //Çoklu dil ile  ilan başlık ve açıklama(tr,en,ru,de vs....)            
            if ($core->googleapi !== '') {
                include("assets/lib/translate/class.php");
            }

            $sql = "select * from e_language where Visible='1' order by Seq asc";
            $qrLang = mysql_query($sql);
            while ($rsLang = mysql_fetch_array($qrLang)) {
                if ($_POST['autotranslate'] == '1' && $core->googleapi !== '') {

                    if ($Lang !== $rsLang['Name']) {
                        $aciklama = "PageDesc-" . $Lang;
                        $aciklama = strip_tags(html_entity_decode($_POST[$aciklama]));
                        $dtranslates = getTranslation($Lang, $rsLang['Name'], $aciklama);
                    } else {
                        $aciklama = "PageDesc-" . $rsLang['Name'];
                        $dtranslates = $_POST[$aciklama];
                    }

                    $baslik = "PageTitle-" . $Lang;
                    $translates = getTranslation($Lang, $rsLang['Name'], $_POST[$baslik]);
                } else {
                    $baslik = "PageTitle-" . $rsLang['Name'];
                    $aciklama = "PageDesc-" . $rsLang['Name'];
                    $translates = $_POST[$baslik];
                    $dtranslates = $_POST[$aciklama];
                }

                $sql = "update t_advert_detail set Baslik='" . $translates . "', Aciklama='" . $dtranslates . "' where IlanNo='" . $ID . "' and Dil='" . $rsLang['Name'] . "'  ";
                mysql_query($sql);
                //Auto Google Translate
            }//./Çoklu dil başlık açıklama	

            /* image upload */
            $ImageName = seflink(GetName("select * from t_advert_detail where Dil='$Lang' and IlanNo='" . $ID . "'", "Baslik"));

            foreach ($_POST['imageUpload'] as $key => $value) {

                $mainimage = ($value === reset($_POST['imageUpload'])) ? "1" : "0";

                $newname = substr($ImageName, 0, 50) . "-" . rand(0, 900000);

                $DBimage = $newname . "." . @end(explode(".", $value));

                $imgControl = GetName("select * from  t_advert_images where Images='" . $value . "'", "Images");

                if ($imgControl !== $value) {

                    $sql = "insert into t_advert_images (ParentID, Images, Seq, anaresim, Visible) values('" . $ID . "', '" . $DBimage . "', '" . $key . "','" . $mainimage . "', '1')";
                    mysql_query($sql);
                    rename("assets/uploads/estate/" . $value, "assets/uploads/estate/" . $DBimage);
                    rename("assets/uploads/estate/thmb/" . $value, "assets/uploads/estate/thmb/" . $DBimage);
                } elseif ($mainimage == "1") {

                    $sql = "update t_advert_images set anaresim='0' where ParentID='" . $ID . "'";
                    $q = mysql_query($sql);
                    $sql = "update t_advert_images set anaresim='" . $mainimage . "', Seq='" . $key . "' where Images='" . $value . "'";
                    $q = mysql_query($sql);
                }

                $sql = "update t_advert_images set  Seq='" . $key . "' where Images='" . $value . "'";
                $q = mysql_query($sql);
            }
            /* image upload */

            header('Location: ' . $SiteAddress . 'ilanlarim/');
        }//$query success query

        break;
}//Action

$_GET['il'] = $rsEdit['il'];
$_GET['ilce'] = $rsEdit['ilce'];
$_GET['semt'] = $rsEdit['semt'];
$_GET['mahalle'] = $rsEdit['mah'];
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="tr-TR">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="tr-TR">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="<? echo $Lang ?>">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <base href="<?= (SITEURL) ?>" />

        <!--Star Seo Tool Start-->
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">

        <title>İlan Güncelleme</title>
        <!--Css Coding Start-->
        <link rel='stylesheet' id='font-css' href='http://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin%2Clatin-ext&#038;ver=3.6' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='chosen-css' href='assets/libraries/chosen/chosen.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>
        <link type="text/css" rel="stylesheet" href="assets/lib/loader/agile-uploader.css" />
        <link type="text/css" rel="stylesheet" href="assets/libraries/datepicker/css/datepicker.css" />

        <!--Css Coding End-->





        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>


        <script type='text/javascript' src='assets/js/jquery.number.min.js'></script>
        <script type='text/javascript' src='assets/js/validator.js'></script>
        <script src="assets/js/jquery.tinylimiter.js" type="application/javascript"></script>
        <script type='text/javascript' src='assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang; ?>.js'></script>

        <script type="text/javascript" src="<?= (SITEURL) ?>assets/lib/ckeditor/ckeditor.js"></script>
        <link type="text/css" href="assets/lib/orakuploader/orakuploader.css" rel="stylesheet"/>    
        <script type="text/javascript" src="assets/lib/orakuploader/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/lib/orakuploader/orakuploader.js"></script>

    </head>

    <body class="home page page-template">
<? include("ust-bolum.php"); ?>
<? include("ililce.php"); ?>

        <div id="content" class="clearfix">

            <div class="container">
                <div class="row">

                    <div id="main" class="span12">

                        <div class="login-register">

                            <div class="row">
                                <div class="span12 ">
                                    <ul class="tabs nav nav-tabs">
                                        <li class="active">
                                            <a href="<?= ($SiteAddress) ?>ilan-ekle/" ><?= ($dil['ilan-ekle']) ?></a></li>
                                        <li >
                                            <a href="<?= ($SiteAddress) ?>ilanlarim/" ><?= ($dil['ilan-listesi']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'DusukFiyat' ? "active" : "") ?>" >
                                            <a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=DusukFiyat" ><?= ($dil['takipteki-ilanlar']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'Liste' ? "active" : "") ?>" >
                                            <a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=Liste" ><?= ($dil['favori-ilanlarim']) ?></a></li>
                                        <li>
                                            <a href="<?= ($SiteAddress) ?>uye-guncelle/"><?= ($dil['bilgilerimi-guncelle']) ?></a></li>
                                    </ul>
                                    <!-- /.nav -->





                                    <form name="addform" id="addform" action="<? echo SITEURL; ?>ilan-guncelle.php" method="post" enctype="multipart/form-data" class="add-advert-form remove-empty">
                                        <input type="hidden" name="ID" value="<?= ($ID) ?>">
                                        <input type="hidden" name="Action" value="EditEstate">
                                        <div class="well well-large" style="background-color: #fdfdfd">
                                            <div class="control-group success">
                                                <div class="controls">
                                                    <ul class="unstyled">
                                                        <li  class="popular-category">
                                                            <label class="control-label">
<?= ($dil['tipi']) ?>
                                                            </label>
                                                            <select name="EstateType" class="input-medium  "   id="EstateType">
                                                                <option><?= (getName("select * from e_category where ItemID='" . $rsEdit['EstateType'] . "' and  Lang='" . $Lang . "'  order by Seq asc", "Name")) ?></option>
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
<?
$sql = " select * from e_criteria_type where Category LIKE '%" . $rsEdit['EstateType'] . "%'  and Lang='" . $Lang . "' and visible='1' order by Seq asc   ";
$q = mysql_query($sql);
while ($sorgu = mysql_fetch_array($q)) {

    $Hidden = "<span style=\"font-size: 8px; position:absolute;\" class=\"label label-important\">" . $dil['gizli'] . "</span>";
    ?>
                                                    <?
                                                    $kats = explode(",", $sorgu['Category']);
                                                    foreach ($kats as $InCat) {

                                                        if ($InCat == $rsEdit['EstateType']) {
                                                            ?>                                                           
                                                            <? if ($sorgu['Type'] == 'selectbox') { ?>
                                                                <div class="span2">
                                                                    <div class="controls">
                                                                        <ul class="unstyled">
                                                                            <li  class="popular-category">
                                                                                <label class="control-label">
                <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $Hidden : "") ?>
                                                                                </label>
                                                                                    <?= (getCheckListSelect("select * from  e_criteria_details where CriteriaItemID='" . $sorgu['ItemID'] . "'  and Lang='" . $Lang . "' order by Seq asc", $sorgu['SefName'], $rsEdit[$sorgu['SefName']], 'input-medium')) ?></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
            <? } ?>
            <? if ($sorgu['Type'] == 'textbox') { ?>  
                                                                <div class="span2">
                                                                    <div class="controls">
                                                                        <ul class="unstyled">
                                                                            <li  class="popular-category">
                                                                                <label class="control-label">
                <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $Hidden : "") ?>
                                                                                </label>                      
                                                                                <input type="text" class="input-medium" name="<? echo $sorgu['SefName']; ?>" id="<? echo $sorgu['ItemID']; ?>" value="<?= ($rsEdit[$sorgu['SefName']]) ?>" placeholder="?">   
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
            <? } ?>
            <? if ($sorgu['Type'] == 'date') { ?>  
                                                                <div class="span2">
                                                                    <div class="controls">
                                                                        <ul class="unstyled">
                                                                            <li  class="popular-category">
                                                                                <label class="control-label">
                <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $Hidden : "") ?>
                                                                                </label>                      
                                                                                <input type="text" class="input-medium <?= ($sorgu['Type'] == 'date' ? "datepicker" : "") ?>" name="<? echo $sorgu['SefName']; ?>" id="<? echo $sorgu['ItemID']; ?>" value="<?= (date("d-m-Y", strtotime($rsEdit[$sorgu['SefName']]))) ?>" placeholder="?">   
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
            <? } ?>
            <? if ($sorgu['Type'] == 'price') { ?>
                                                                <div class="span2">
                                                                    <ul class="unstyled">
                                                                        <li  class="popular-category pull-left">
                                                                            <label class="control-label ">
                <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $Hidden : "") ?>
                                                                            </label>
                                                                            <input name="<?= ($sorgu['SefName']) ?>" type="text" class="input-small" id="RentPrice" placeholder="?" value="<?= ($rsEdit[$sorgu['SefName']]) ?>" required>                      
                                                                        </li>                   
                                                                        <li  class="popular-category">
                                                                            <label class="control-label ">
                <?= ($dil['para-birimi']) ?>
                                                                            </label>
                                                                            <select  name="<?= ($sorgu['SefName']) ?>_Cur" id="CurrencyChange" class="input-mini" >
                                                                                <option value="TL" <?= ($rsEdit[$sorgu['SefName'] . '_Cur'] == "TL" ? "selected" : "") ?>>TL</option>
                                                                                <option value="USD" <?= ($rsEdit[$sorgu['SefName'] . '_Cur'] == "USD" ? "selected" : "") ?>>USD</option>
                                                                                <option value="EUR" <?= ($rsEdit[$sorgu['SefName'] . '_Cur'] == "EUR" ? "selected" : "") ?>>EUR</option>
                                                                                <option value="GBD" <?= ($rsEdit[$sorgu['SefName'] . '_Cur'] == "GBD" ? "selected" : "") ?>>GBD</option>
                                                                                <option value="RUB" <?= ($rsEdit[$sorgu['SefName'] . '_Cur'] == "RUB" ? "selected" : "") ?>>RUB</option>
                                                                            </select>
                                                                        </li>                  
                                                                    </ul>
                                                                </div>
            <? } ?>
        <? } ?>
                                                    <? } ?>
                                                <? } ?>
                                            </div>
                                            <div><span class="label label-important"><?= ($dil['gizli']) ?></span> <?= ($dil['gizli-bilgi-uyarisi']) ?></div>
                                        </div><!--well and-->
                                        <div class="well well-large" style="background-color: #fff">
                                            <div class="row-fluid">
<?
$sql = " select * from e_criteria_type where Category LIKE '%" . $rsEdit['EstateType'] . "%'  and Lang='" . $Lang . "' and visible='1' order by Seq asc   ";
$q = mysql_query($sql);
while ($sorgu = mysql_fetch_array($q)) {

    $Hidden = "<span style=\"font-size: 8px; position:absolute;\" class=\"label label-important\">" . $dil['gizli'] . "</span>";
    ?>
                                                    <?
                                                    $kats = explode(",", $sorgu['Category']);
                                                    foreach ($kats as $InCat) {

                                                        if ($InCat == $rsEdit['EstateType']) {
                                                            ?><? if ($sorgu['Type'] == 'checkbox') {
                                                                ?>
                                                                <div class="span3" >
                                                                    <div class="control-group" >
                                                                        <label class="control-label">
                <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $Hidden : "") ?>
                                                                        </label>
                                                                        <div class="controls " style="height: 300px; overflow-x: scroll;">

                                                                            <ul class="unstyled"><?
                $sql = "select * from e_criteria_details where CriteriaItemID='" . $sorgu['ItemID'] . "' and Lang='" . $Lang . "' and Visible=1 order by Seq";
                ?>
                                                                                <?= (getCheckListGlobal($sql, $sorgu['SefName'], $rsEdit[$sorgu['SefName']])) ?>                                       
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
            <? } ?>
        <? } ?>
                                                    <? } ?>
                                                <? } ?>
                                            </div>
                                        </div> <!--well and-->


                                        <div class="well well-large" style="background-color: #fff">
                                            <div class="row-fluid">
                                                <div class="control-group">

                                                    <div id="tab" class="btn-group" data-toggle="buttons-radio">
<?
$sql = "select * from e_language where Visible='1' order by Seq asc";
$qrLang = mysql_query($sql);
while ($rsLang = mysql_fetch_array($qrLang)) {
    ?>

                                                            <a href="#<?= ($rsLang['Name']) ?>" class="btn  <? if ($rsLang['Name'] == $Lang) { ?>active<? } ?>" data-toggle="tab">
                                                                <img src="assets/css/flag/blank.gif" class="flag flag-<?= ($rsLang['Name']) ?>" alt=""  /></a>

<? }
?>
                                                        <label class="btn"><input type="checkbox" name="autotranslate" id="autotranslate" value="1"> <?= ($dil['yabanci-dil']) ?></label>
                                                    </div>

                                                    <div class="tab-content" style="background-color: #fff">
<?
$sql = "select * from e_language where Visible='1' order by Seq asc";
$qrLang = mysql_query($sql);
while ($rsLang = mysql_fetch_array($qrLang)) {
    ?>
                                                            <div class="tab-pane <? if ($rsLang['Name'] == $Lang) { ?>active<? } ?>" id="<?= ($rsLang['Name']) ?>">

                                                                <label class="control-label">
                                                                    <span class="label"><img src="assets/css/flag/blank.gif" class="flag flag-<?= ($rsLang['Name']) ?>" alt=""  /></span> <?= ($dil['ilan-basligi']) ?></label>
                                                                <div class="controls">

                                                                    <input name="PageTitle-<?= ($rsLang['Name']) ?>" type="text" class="<? if ($rsLang['OpenSiteLang'] == '1') { ?>required<? } ?> input-block-level" id="PageTitle-<?= ($rsLang['Name']) ?>" maxlength="150" size="55" value="<?= (GetName("select * from t_advert_detail where IlanNo='" . $ID . "' and Dil='" . $rsLang['Name'] . "'", "Baslik")) ?>"   />

                                                                </div>
                                                                <label class="control-label" for="description">
                                                                    <span class="label"><img src="assets/css/flag/blank.gif" class="flag flag-<?= ($rsLang['Name']) ?>" alt=""  /></span> <?= ($dil['ilan-aciklamasi']) ?></label>

                                                                <div class="controls">
                                                                    <textarea name="PageDesc-<?= ($rsLang['Name']) ?>"  class="<? if ($rsLang['OpenSiteLang'] == '1') { ?>required<? } ?>"  style=" height:200px;" id="PageDesc-<?= ($rsLang['Name']) ?>"  placeholder="SEO arama motorlarında daha fazla gösterim sağlar."><?= (html_entity_decode(GetName("select * from t_advert_detail where IlanNo='" . $ID . "' and Dil='" . $rsLang['Name'] . "'", "Aciklama"))) ?></textarea>
                                                                    <script type="text/javascript">
                                                                      CKEDITOR.replace('PageDesc-<?= ($rsLang['Name']) ?>', {
                                                                        height: '400px',
                                                                      });
                                                                    </script>

                                                                </div>

                                                            </div>
<? } ?>
                                                    </div>
                                                </div>
                                                <!--./control-group-->
                                            </div>
                                        </div> <!--well title and-->

                                        <div class="well well-large" style="background-color: #fff">
                                            <div class="row-fluid">

                                                <div class="span3">
                                                    <div class="control-group clearfix">
                                                        <label class="control-label" for="description">
<?= ($dil['lokasyon']) ?>
                                                        </label>

                                                        <select id="il" name="il" class="row-fluid" onchange="ilLokasyon();return false">
                                                            <option value="" ><?= ($dil['il']) ?> <?= ($dil['seciniz']) ?></option>
                                                        </select>

                                                        <select name="ilce" id="ilce" class=row-fluid onchange="ilceLokasyon();
                                                                    return false">
                                                            <option value="0"><?= ($dil['ilce']) ?> <?= ($dil['seciniz']) ?></option>
                                                        </select>
                                                        <select name="semt" id="semt" class=row-fluid onchange="semtLokasyon();
                                                                    return false">
                                                            <option value="0"><?= ($dil['semt']) ?> <?= ($dil['seciniz']) ?></option>
                                                        </select>
                                                        <select name="mahalle" id="mahalle" class=row-fluid onchange="mahalleLokasyon();return false">
                                                            <option value="0">Mahalle Seçiniz</option>
                                                        </select>

                                                        <div class=" row-fluid">
                                                            <input  id="ycoor"  type="text" name="xcoor" class="span6" placeholder="x koordinat"  value="<?= ($rsEdit['xcoor']) ?>"  />
                                                            <input  id="xcoor" type="text" name="ycoor" class="span6"  placeholder="y koordinat" value="<?= ($rsEdit['ycoor']) ?>"   />
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="span9">
                                                    <div id="map"  style="width:100%; height: 300px"></div>
                                                </div>


                                            </div>
                                        </div> <!--well map and-->

                                        <div class="well well-large" style="background-color: #fff">
                                            <div class="row-fluid">

                                                <div class="span12">
                                                    <label class="control-label" for="video">
                                                        Resim Yükleme
                                                        <span></span></label>
                                                    <div id="imageUpload" orakuploader="on"></div>

                                                </div>

                                            </div>
                                        </div> <!--image upload-->


                                        <div class="well well-large" style="background-color: #fff">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div  id="processs" class="pull-right"></div>
                                                    <input type="submit" id="gonder" onclick="CKupdate();"   class="btn-large btn-success btn-block" value="<?= ($dil['kaydet']) ?>">
                                                </div>

                                            </div> <!--well picture and-->	
                                        </div>
                                        <div class="loading"></div>								
                                    </form>


                                </div>
                                <!-- /.span4-->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.login-register -->
                    </div>
                    <!-- /#main -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#content -->

<?
$sql = "select * from  t_advert_images where ParentID='" . $ID . "' order by Seq asc ";
$queryList = mysql_query($sql);
$imageCount = 20 - mysql_num_rows($queryList);
while ($rsList = mysql_fetch_array($queryList)) {

    $attach .= '"' . $rsList['Images'] . '",';
    //$sql = "update t_advert_images set Images='".$rsList['Images']."-orta.jpg' where ID='" . $rsList['ID'] . "'";
    //$q = mysql_query($sql);
}
?>
        <script>
            $(document).ready(function () {
                //$(".submitButton").hide();
                $('#imageUpload').orakuploader({
                    orakuploader: true,
                    orakuploader_path: 'assets/lib/orakuploader/',

                    orakuploader_main_path: 'assets/uploads/estate',
                    orakuploader_thumbnail_path: 'assets/uploads/estate/thmb',

                    orakuploader_use_main: true,
                    orakuploader_use_sortable: true,
                    orakuploader_use_dragndrop: true,
                    orakuploader_use_rotation: true,

                    orakuploader_add_image: 'assets/lib/orakuploader/images/add.png',
                    orakuploader_add_label: 'Resim yükle',

                    orakuploader_resize_to: 1024,
                    orakuploader_thumbnail_size: 300,

                    //orakuploader_watermark: 'assets/lib/orakuploader/images/watermark.png',

                    orakuploader_maximum_uploads: 20,
                    orakuploader_hide_on_exceed: true,

                    orakuploader_crop_to_width: 800,
                    orakuploader_crop_to_height: 600,

                    orakuploader_crop_thumb_to_width: 300,
                    orakuploader_crop_thumb_to_height: 225,

                    //orakuploader_hide_in_progress: true,

                    //Attaching pre-uploaded images (add only the file names w/o directories)
                    orakuploader_attach_images: [<?php echo $attach; ?>],

                    orakuploader_max_exceeded: function () {
                        alert("İzin verilen resim sayısı <?php echo $imageCount; ?>");
                    },

                    orakuploader_main_changed: function (filename) {
                        $("#mainlabel-images").remove();
                        $("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Vitrin Resimi</div>");
                    }

                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function CKupdate() {
                $('#addform').submit(function () {
                    $(".loading").show();
                    $('#gonder').remove();
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                });
            });
        </script>
<? include("alt-bolum.php"); ?>

        <!--JS Coding End-->
        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->


        <script src="https://maps.googleapis.com/maps/api/js?key=<?= ($core->googleapi) ?>"></script>
        <script type="text/javascript">
            var longval = "#xcoor";
            var latval = "#ycoor";
            var geocoder;
            var map;
            var marker;

            function initialize() {
                //MAP

                initialLat = "<?= ($rsEdit['xcoor']) ?>";
                initialLong = "<?= ($rsEdit['ycoor']) ?>";

                var latlng = new google.maps.LatLng(initialLat, initialLong);
                var options = {
                    zoom: 18,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map"), options);

                geocoder = new google.maps.Geocoder();

                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    position: latlng
                });

                google.maps.event.addListener(marker, "dragend", function (event) {
                    var point = marker.getPosition();
                    map.panTo(point);
                });

            }
            ;

            function codeAddress(value) {
                var address = value;
                geocoder.geocode({'address': address}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(14);
                        marker.setPosition(results[0].geometry.location);
                        $(latval).val(marker.getPosition().lat());
                        $(longval).val(marker.getPosition().lng());
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                });
            }
            ;

            $(document).ready(function () {
                initialize();
                //Add listener to marker for reverse geocoding
                google.maps.event.addListener(marker, 'drag', function () {
                    geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                $(latval).val(marker.getPosition().lat());
                                $(longval).val(marker.getPosition().lng());
                            }
                        }
                    });
                });

            });

        </script>

        <script>
            function ilLokasyon() {
                var il = $("#il :selected").text();
                codeAddress(il);
            }
            function ilceLokasyon() {
                var il = $("#il :selected").text();
                var ilce = $("#ilce :selected").text();
                codeAddress(il + "," + ilce);
            }

            function semtLokasyon() {
                var il = $("#il :selected").text();
                var ilce = $("#ilce :selected").text();
                var semt = $("#semt :selected").text();
                codeAddress(il + "," + ilce + "," + semt);
            }
            function mahalleLokasyon() {
                var il = $("#il :selected").text();
                var ilce = $("#ilce :selected").text();
                var semt = $("#semt :selected").text();
                var mah = $("#mahalle :selected").text();
                codeAddress(il + "," + ilce + "," + semt + "," + mah);
            }
        </script>

        <script>
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                startView: 2,
                language: "tr",
                orientation: "top right",
                autoclose: true,
                todayHighlight: true
            });


            //Search form remove empty input 
            $(document).ready(function ()
            {
                $('.remove-empty').submit(function ()
                {
                    $(this).find(':input').filter(function () {
                        return !this.value;
                    }).attr('disabled', 'disabled');
                    return true; // make sure that the form is still submitted
                });
            });

        </script>

        <script type='text/javascript' src='assets/js/retina.js'></script>
        <script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>
        <script type='text/javascript' src='assets/js/properta.js'></script>



    </body>
</html>
