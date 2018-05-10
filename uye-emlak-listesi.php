<?php
define("_VALID_PHP", true);
require_once("init.php");

if (!$user->logged_in)
    redirect_to("index.html");

$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();
?>
<?php
$sayfaUrl = toGet($_GET['sayfa'], $_POST['sayfa']);
$querystring = "";

foreach ($_GET as $val => $value) {

    if (!is_array($value)) {

        if ($val != "sayfa" && $val != "id")
            $querystring .= "$val=" . $value . "&amp;";
    }

    foreach ($value as $key) {
        if ($val != "sayfa" && $val !== $value)
            $querystring .= $val . "[]=" . $key . "&amp;";
    }
}


$Action = toGet($_GET['Action'], $_POST['Action']);
$ID = toGet($_GET['ID'], $_POST['ID']);
$miSend = toGet($_GET['miSend'], $_POST['miSend']);
$Title = toGet($_GET['Title'], $_POST['Title']);
//$PageType = GetName("select * from t_pages where ID='".$ID."'", "PageType");
//$ItemID = toGet($_GET['ItemID'], $_POST['ItemID']);
$AdvertType = toGet($_GET['AdvertType'], $_POST['AdvertType']);



ilanyetki($ID);


$DisplayAdvert = toGet($_GET['DisplayAdvert'], $_POST['DisplayAdvert']);
$PrivateAdvert = toGet($_GET['PrivateAdvert'], $_POST['PrivateAdvert']);
$RentAdvert = toGet($_GET['RentAdvert'], $_POST['RentAdvert']);
$SaleAdvert = toGet($_GET['SaleAdvert'], $_POST['SaleAdvert']);





$Status = $_GET['Status'];
switch ($Action) {



    case 'Delete' :
        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        
        ilansil($ID);

        if (isset($_POST['coklu'])) {

            foreach ($_POST['coklu'] as $sil) {
                
                ilansil($sil);
            }

            echo '<script type="text/javascript">alert("' . count($_POST['coklu']) . ' adet ilanınız silindi"); </script>';
        }

        break;

    case 'tarihguncelle' :

        $t = date("Y-m-d H:i:s");

        if (isset($_POST['coklu'])) {

            foreach ($_POST['coklu'] as $ID) {
                $sql = "update t_advert set GDate='" . $t . "' where ID='" . $ID . "'";
                mysql_query($sql);
            }

            echo '<script type="text/javascript">alert("' . count($_POST['coklu']) . ' adet ilanınız güncellendi"); </script>';
        } else {

            echo '<script type="text/javascript">alert("İlan seçimi yapmanız gerekir."); </script>';
        }



        break;

    case 'otuzgun' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        $s = "30 day";
        $t = date("Y-m-d H:i:s");
        $yenitarih = strtotime($s, strtotime($t));
        $yenitarih = date('Y-m-d H:i:s', $yenitarih);


        if (isset($_POST['coklu'])) {

            foreach ($_POST['coklu'] as $ID) {
                $sql = "update t_advert set Sure='" . $yenitarih . "' where ID='" . $ID . "'";
                mysql_query($sql);
            }

            echo '<script type="text/javascript">alert("' . count($_POST['coklu']) . ' adet ilanınızın 30 gün uzatıldı."); </script>';
        } else {

            echo '<script type="text/javascript">alert("İlan seçimi yapmanız gerekir."); </script>';
        }

        break;

    case 'altmisgun' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        $s = "60 day";
        $t = date("Y-m-d H:i:s");
        $yenitarih = strtotime($s, strtotime($t));
        $yenitarih = date('Y-m-d H:i:s', $yenitarih);


        if (isset($_POST['coklu'])) {

            foreach ($_POST['coklu'] as $ID) {
                $sql = "update t_advert set Sure='" . $yenitarih . "' where ID='" . $ID . "'";
                mysql_query($sql);
            }

            echo '<script type="text/javascript">alert("' . count($_POST['coklu']) . ' adet ilanınızın 60 gün uzatıldı."); </script>';
        } else {

            echo '<script type="text/javascript">alert("İlan seçimi yapmanız gerekir."); </script>';
        }

        break;


    case 'Hide' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }


        $sql = "update t_advert set Visible='0' where ID='" . $ID . "'";
        mysql_query($sql);
        break;


    case 'Show' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        $sql = "update t_advert set Visible='1' where ID='" . $ID . "'";
        mysql_query($sql);
        break;

    case 'Uzat' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        $s = $_GET['s'] . " day";
        $t = date("Y-m-d H:i:s");
        $yenitarih = strtotime($s, strtotime($t));
        $yenitarih = date('Y-m-d H:i:s', $yenitarih);


        $sql = "update t_advert set Sure='" . $yenitarih . "' where ID='" . $ID . "'";
        mysql_query($sql);

        redirect_to($SiteAddress."ilanlarim/?");


        break;

    case 'sanaltur' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        if (isset($_FILES['dosya'])) {
            $hata = $_FILES['dosya']['error'];
            if ($hata != 0) {
                echo 'Yüklenirken bir hata gerçekleşmiş.';
            } else {
                $boyut = $_FILES['dosya']['size'];
                if ($boyut > (1024 * 1024 * 30)) {
                    echo 'Dosya 3MB den büyük olamaz.';
                } else {
                    $tip = $_FILES['dosya']['type'];
                    $isim = $_FILES['dosya']['name'];
                    $uzanti = explode('.', $isim);
                    $uzanti = $uzanti[count($uzanti) - 1];
                    if ($tip != 'application/x-shockwave-flash' || $uzanti != 'swf') {
                        echo 'Yanlızca Swf dosyaları gönderebilirsiniz.';
                    } else {
                        $dosya = $_FILES['dosya']['tmp_name'];
                        $dosyaadi = seflink(getName("select * from t_advert_detail where Dil='" . $Lang . "' ", "Baslik")) . "-" . $ID . ".swf";
                        copy($dosya, 'assets/uploads/sanaltur/' . $dosyaadi);

                        $sql = "update t_advert set sanaltur='" . $dosyaadi . "' where ID='" . $ID . "'";
                        mysql_query($sql);

                        redirect_to("ilanlarim/?");
                    }
                }
            }
        }


        break;

    case 'sanaltursil' :

        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }

        if (isset($_POST['sanaltursil'])) {

            $sql = "update t_advert set sanaltur='' where ID='" . $ID . "'";
            mysql_query($sql);

            unlink("assets/uploads/sanaltur/" . $_POST['sanaltursil']);

            redirect_to($SiteAddress."ilanlarim/?");
        }


        break;


    case 'ShowDisplay' :
        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        $sql = "update t_advert set DisplayAdvert='" . $Status . "' where ID='" . $ID . "'";
        mysql_query($sql);
        break;

    case 'ShowPrivate' :
        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        $sql = "update t_advert set PrivateAdvert='" . $Status . "' where ID='" . $ID . "'";
        mysql_query($sql);
        break;

    case 'ShowRent' :
        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        $sql = "update t_advert set RentAdvert='" . $Status . "' where ID='" . $ID . "'";
        mysql_query($sql);
        break;

    case 'ShowSale' :
        if ($demomode == 1) {
            redirect_to($SiteAddress . "ilanlarim/");
            return NULL;
        }
        $sql = "update t_advert set SaleAdvert='" . $Status . "' where ID='" . $ID . "'";
        mysql_query($sql);
        break;
}
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
        <link rel="alternate" hreflang=""<? echo $Lang?>" href="<?php echo $SiteAddress?>" />
        <link rel="canonical" href="<?php echo $urladresi?>" />
        <base href="<?= (SITEURL) ?>" />

        <!--Star Seo Tool Start-->
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">

        <title>İlan Listesi</title>
        <link rel="image_src" href="<?= ($SiteAddress) ?>images/estate/<?= ($fbi[Images]) ?>_small.jpg" />
        <meta property="og:image" content="<?= ($SiteAddress) ?>images/estate/<?= ($fbi[Images]) ?>_small.jpg"/>
        <!--Star Seo Tool End-->

        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->

        <!--Css Coding Start-->
        <link rel='stylesheet' id='font-css' href='http://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin%2Clatin-ext&#038;ver=3.6' type='text/css' media='all'/>
        <link rel='stylesheet' id='revolution-fullwidth' href='assets/libraries/rs-plugin/css/fullwidth.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='revolution-settings' href='assets/libraries/rs-plugin/css/settings.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>
        <link rel="stylesheet" type="text/css" href="assets/libraries/sharebar/jquery.share.css" />
        <!--Css Coding End-->

        <!--JS Coding Start-->
        <script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script> 
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/bootstrap-tooltip.js'></script>


        <script type="text/javascript">
            // Tüm checkboxları seç    
            function tumunuSec(status)
            {
                $("#ilanlistesi input").each(function ()
                {
                    $(this).attr("checked", status);
                });
            }
        </script>


    </head>

    <body class="home page page-template">
<? include("ust-bolum.php"); ?>

        <div id="content" class="clearfix">

            <div class="container">
                <div class="row">

                    <div id="main" class="span12">

                        <div class="login-register">

                            <div class="row">
                                <div class="span12 ">
                                    <ul class="tabs nav nav-tabs">
                                        <li >
                                            <a href="<?= ($SiteAddress) ?>ilan-ekle/" ><?= ($dil['ilan-ekle']) ?></a></li>
                                        <li class="active" >
                                            <a href="<?= ($SiteAddress) ?>ilanlarim/" ><?= ($dil['ilan-listesi']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'DusukFiyat' ? "active" : "") ?>" >
                                            <a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=DusukFiyat" ><?= ($dil['takipteki-ilanlar']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'Liste' ? "active" : "") ?>" >
                                            <a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=Liste" ><?= ($dil['favori-ilanlarim']) ?></a></li>
                                        <li>
                                            <a href="<?= ($SiteAddress) ?>uye-guncelle"><?= ($dil['bilgilerimi-guncelle']) ?></a></li>
                                    </ul>
                                    <!-- /.nav -->

                                    <div class="tab-content">
                                        <div class="tab-pane active ">

                                            <a class="btn btn-danger" href="<?= ($SiteAddress) ?>ilanlarim/"><?= ($dil['filtrele']) ?></a>
                                            :
<?
$sql1 = "select * from e_category where Lang='" . $Lang . "' order by Seq asc ";
$queryList1 = mysql_query($sql1);
while ($rsListx = mysql_fetch_array($queryList1)) {
    if ($rsListx['ItemID'] == $_GET['Tip']) {
        $secili = 'btn-inverse';
    } else {
        $secili = '';
    }
    ?>
                                                <a class="btn <?= ($secili) ?>" href="<?= ($SiteAddress) ?>ilanlarim/?Cat=<? echo $rsListx['ItemID']; ?>"><? echo $rsListx['Name']; ?></a>
<? } ?>

                                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="pull-right" >
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ilannoarama('ilanguncelle');
}
?>
                                                <div class="control-group ">

                                                    <div class="row-fluid"> 
                                                        <div class="span8">
                                                            <input name="ilanno" type="text"  id="ilanno" placeholder="<?= ($dil['ilan-no-ile-guncelle']) ?>" required="true" >                    
                                                        </div>
                                                        <div class="span4"> 
                                                            <input class="btn" style="margin:5px 0 0 0;" type="submit" value="<?= ($dil['aramayi-baslat']) ?>" >                 

                                                        </div>
                                                    </div>
                                                    <!-- /.controls -->
                                                </div><!-- /.control-group -->

                                            </form> 


                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="coklusecim">
                                                <table class="table table-striped table-condensed" id="ilanlistesi">
                                                    <thead>
                                                        <tr>
                                                            <th ><?= ($dil['no']) ?></th>
                                                            <th>
                                                                <label class="pull-left btn btn-info"><input type="checkbox" onclick="tumunuSec(this.checked)"> <?= ($dil['tumunu-sec']) ?></label>  

                                                                <select name="Action">
                                                                    <option><?= ($dil['secilen-ilanlari']) ?></option>
                                                                    <option value="tarihguncelle"><?= ($dil['tarih-guncelle']) ?></option>
                                                                    <option value="otuzgun">İlan Süresi 30 Gün Uzat</option>
                                                                    <option value="altmisgun">İlan Süresi 60 Gün Uzat</option>
                                                                    <option value="Delete"><?= ($dil['sil']) ?></option>
                                                                </select>

                                                                <input type="submit" class="btn btn-default" name="coklu" onClick="submitform()" value="<?= ($dil['onayla']) ?>">
                                                            </th>
                                                            <th></th>

                                                            <th><?= ($dil['durumu']) ?></th>                                          
                                                        </tr>
                                                    </thead>   
                                                    <tbody>



<?php
//Filtre
if ($_GET['Cat']) {
    $filtre = " and EstateType='" . $_GET['Cat'] . "'";
}

if ($row['userlevel'] !== '9') {
    $clause = "and user_id='" . $row['id'] . "'";
}



$sayfax = 15;
$sql = "select * from t_advert where Validate='1'  $clause   " . $filtre . " order by id desc";

$q = mysql_query($sql);
$toplamilan = mysql_num_rows($q);
//echo $toplamilan; 

$toplam_sayfa = ceil($toplamilan / $sayfax);
$sayfa = isset($sayfaUrl) ? (int) $sayfaUrl : 1;

$sayfa_goster = 8;


$en_az_orta = ceil($sayfa_goster / 2);
$en_fazla_orta = ($toplam_sayfa + 1) - $en_az_orta;

$sayfa_orta = $sayfa;
if ($sayfa_orta < $en_az_orta)
    $sayfa_orta = $en_az_orta;
if ($sayfa_orta > $en_fazla_orta)
    $sayfa_orta = $en_fazla_orta;

$sol_sayfalar = round($sayfa_orta - (($sayfa_goster - 1) / 2));
$sag_sayfalar = round((($sayfa_goster - 1) / 2) + $sayfa_orta);

if ($sol_sayfalar < 1)
    $sol_sayfalar = 1;
if ($sag_sayfalar > $toplam_sayfa)
    $sag_sayfalar = $toplam_sayfa;

$limit = ($sayfa - 1) * $sayfax;


$sql = "select * from t_advert where Validate='1'  $clause  " . $filtre . " order by ID desc limit  " . $limit . "," . $sayfax . " ";

$qrDisplay = mysql_query($sql);
while ($rsDisplay = mysql_fetch_array($qrDisplay)) {

    $AdTitle = getName("select * from t_advert_detail where  IlanNo='" . $rsDisplay['ID'] . "' and Dil='" . $Lang . "' ", "Baslik");
    $AdDescription = getName("select * from t_advert_detail where  IlanNo='" . $rsDisplay['ID'] . "' and Dil='" . $Lang . "' ", "Aciklama");
    $iladi = getName("select * from il where   id='" . $rsDisplay['il'] . "'", "il_adi");
    $ilceadi = getName("select * from ilce where   id='" . $rsDisplay['ilce'] . "'", "ilce_adi");
    $semtadi = getName("select * from semt where   id='" . $rsDisplay['semt'] . "'", "semt_adi");
    $mahadi = getName("select * from mahalle where   id='" . $rsDisplay['mah'] . "'", "mahalle_adi");

    $sql = "select * from e_criteria_type where Category LIKE '%" . $rsDisplay['EstateType'] . "%'  and Lang='$Lang'  ";
    $q = mysql_query($sql);
    while ($listing = mysql_fetch_array($q)) {
        $Category = explode(',', $listing['Category']);

        foreach ($Category as $InCat) {

            if ($InCat == $rsDisplay['EstateType']) {

                if ($listing['Type'] == 'price') {
                    $Price = $rsDisplay[$listing['SefName']];
                    $PriceCurrency = $rsDisplay[$listing['SefName'] . '_Cur'];
                }

                if ($listing['SubCategory'] == '1') {

                    $MainCategory = getName("select * from e_criteria_details  where  ItemID='" . $rsDisplay[$listing['SefName']] . "' and Lang='" . $Lang . "' ", "Name");
                    $SubCategory = getName("select * from e_category  where  ItemID='" . $rsDisplay['EstateType'] . "' and Lang='" . $Lang . "' ", "Name");
                    ;
                }
                //Status fields Rent-Sales, Emlak durumu Satılık-kiralık vs
                $Status = getName("select * from e_criteria_details  where  ItemID='" . $rsDisplay['durumu'] . "' and Lang='" . $Lang . "' ", "Name");
                //Icon fields - ikon listesi
            }
        }
    }

    $str = $SiteAddress.seflink($AdTitle)."/detay-".$rsDisplay['ID']."/";
    $Seflink = preg_replace('/([^:])(\/{2,})/', '$1/', $str);


    //listing picture - ilan resimleri
    $picture = getName("select * from t_advert_images  where anaresim='1' and  ParentID='" . $rsDisplay['ID'] . "'", "Images");
    if (!empty($picture)) {

        $img = "assets/uploads/estate/thmb/" . $picture . "";
    } else {
        $img = "assets/uploads/estate/temp-orta.jpg";
    }
    ?>
                                                            <tr  >
                                                                <td  >
                                                                    <input type="checkbox" name="coklu[]" value="<?= ($rsDisplay['ID']) ?>">
                                                                    <span class="badge badge-info"><?= ($rsDisplay['ID']) ?></span></td>
                                                                <td width="100%">
                                                                    <div class="pull-left" style="margin-right:10px; width:100px; "><img src="<?= ($img) ?>"    class="img-rounded" /></div>
                                                                    <div >
                                                                        <strong><?= (GetName("select * from t_advert_detail where IlanNo='" . $rsDisplay['ID'] . "' and Dil='" . $Lang . "'", "Baslik")) ?></strong><br />
                                                                        <div><?= ($Status) ?>  <?= ($SubCategory) ?>  <?= ($MainCategory) ?>
                                                                        </div>

                                                                        <div class=location><?= ($iladi) ?> - <?= ($ilceadi) ?> - <?= ($semtadi) ?> <?= ($mahadi) ?></div>
                                                            <? if (number_format($Price) !== '0') { ?>
                                                                            <span class="btn"><?= (number_format($Price) . " " . $PriceCurrency) ?></span>
                                                            <? } ?>

                                                                      
                                                                        <br />
                                                                        <?
                                                                        $sql = "select * from t_add_list where   CookieID='" . $row['id'] . "' and EstateID='" . $rsDisplay['ID'] . "'";
                                                                        $ds = mysql_query($sql);
                                                                        $takip = mysql_num_rows($ds);

                                                                        if ($takip > 0) {
                                                                            ?>

                                                                            <span class="badge badge-warning"><?= ($takip) ?></span>
                                                                            <small class=" text-warning"> <?= ($dil['kisi-bu-ilani-takip-ediyor']) ?><br /> <?= ($dil['fiyatta-bir-indirim-yapmaniz']) ?></small>
                                                                        <? } ?>
                                                                    </div>


                                                                </td>
                                                                <td width="100%">
                                                                    <span class="muted"><? echo date("d-m-Y", strtotime($rsDisplay['ADate'])); ?> <?= ($dil['eklendi']) ?></span><br />
                                                                    <span class=" text-success"><? echo date("d-m-Y", strtotime($rsDisplay['GDate'])); ?> <?= ($dil['guncellendi']) ?></span><br />



                                                                    <div class="btn-group ">
                                                                       
                                                                        <a href="<?= ($SiteAddress) ?>ilan-guncelle/<?= ($rsDisplay['ID']) ?>/" class="btn btn-mini"><?= ($dil['duzenle']) ?></a>
    <? if ($rsDisplay['Visible'] == '1') { ?>
                                                                            <a href="<?= ($SiteAddress) ?>ilanlarim/?&Action=Hide&ID=<?= ($rsDisplay['ID']) ?>" class="btn btn-mini btn-success " onClick="return confirm('<?= ($dil['ilan-durdur-uyari']) ?>')"><?= ($dil['durdur']) ?></a>
                                                                        <? } else { ?>
                                                                            <a href="<?= ($SiteAddress) ?>ilanlarim/?&Action=Show&ID=<?= ($rsDisplay['ID']) ?>" class="btn btn-mini btn-danger" onClick="return confirm('<?= ($dil['ilan-yayin-uyari']) ?>')"><?= ($dil['yayinla']) ?></a>
    <? } ?>

                                                                        <a href="<?= ($SiteAddress) ?>ilanlarim/?Action=Delete&ID=<?= ($rsDisplay['ID']) ?>" onClick="return confirm('<?= ($dil['ilan-silme-uyari']) ?>')" class="btn btn-mini btn-danger"><?= ($dil['sil']) ?></a>
                                                                        <a class="btn btn-mini btn-warning" target="_blank" href="<?= $Seflink ?>"  > <?= ($dil['ilani-test-et']) ?></a><br />

                                                                    </div>
    <? if ($rsDisplay['EstateType'] == '524') { ?>
                                                                        <a href="#BosDoluKontrol<? echo $rsDisplay['ID'] ?>" data-toggle="modal" class="btn"><i class="icon icon-calendar"></i> <?= ($dil['rezarvasyon-takvimi']) ?></a>
                                                                        <!--Takvim-->
                                                                        <div class="modal hide " style="width:380px;" id="BosDoluKontrol<? echo $rsDisplay['ID'] ?>">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
                                                                                <h2>Rezarvasyon Güncelleme</h2>
                                                                                <small class="muted" >Boş dolu olarak işaretlemek için tarihlere tıklayın.</small>
                                                                            </div>

                                                                            <div class="modal-body"   style="overflow:visible;">


                                                                                <div class="tab-content " >
                                                                                    <div class="tab-pane active" >
                                                                                        <iframe src="ajax/ajax-takvim/query.php?iid=<?= ($rsDisplay['ID']) ?>&u=<?= ($row['id']) ?>" width="300" height="250"></iframe>	   
                                                                                    </div>

                                                                                </div>
                                                                            </div>



                                                                        </div><!--Takvim-->  
    <? } ?>

                                                                </td>
                                                                <!--<td><? echo getValue("fname", "users", "id =" . $rsDisplay['user_id']); ?> <? echo getValue("lname", "users", "id =" . $rsDisplay['user_id']); ?></td>-->
                                                                <td  valign="middle" <?php if (Gun($rsDisplay['Sure']) == '0') { ?>style="background-color: #ffb3ae"<?php } ?>>
                                                                    <div class=" text-success">
                                                                        <span class="badge badge-warning"><? echo Gun($rsDisplay['Sure']); ?></span> <?= ($dil['gun-kaldi']) ?></div>

    <?php if (Gun($rsDisplay['Sure']) < '7') { ?>
                                                                        <select name="sureuzat" class="input-medium" onchange="top.location.href = '<?=($SiteAddress)?>ilanlarim/?Action=Uzat&ID=<?= ($rsDisplay['ID']) ?>&s=' + this.options[ this.selectedIndex ].value + '';">
                                                                            <option  selected="selected"  value="">İlan Süresi Uzat</option>
                                                                            <option   value="30">30 Gün</option>
                                                                            <option   value="60">60 Gün</option>
                                                                        </select>

    <? } ?>
                                                                    <? if ($rsDisplay['Validate'] == '0') { ?>
                                                                        <span class="label label-danger">
                                                                            <i class="icon-time"></i> <?= ($dil['onay-bekliyor']) ?></span>
    <? } ?>

                                                                </td>                                       
                                                            </tr>




<? } ?>

                                                    </tbody>
                                                </table>

                                            </form> 

                                        </div>
                                        <!-- /.tab-pane -->

                                    </div>
                                    <!-- /.tab-content -->
                                    <!--Sayfalama Başl.-->
                                    <div class="pagination">
                                        <ul>
<?php
$url = strtok($_SERVER["REQUEST_URI"], '?');
$sayfaq = $url . "?" . $querystring . "sayfa=1";

if ($sayfa != 1)
    echo '<li> <a href="' . $sayfaq . '">&lt;&lt; ' . $dil['ilk-sayfa'] . '</a></li> ';

for ($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
    if ($sayfa == $s) {
        echo '<li class="disabled"> <a>' . $s . '</a></li>';
    } else {

        $sayfaq = $url . "?" . $querystring . "sayfa=$s";
        echo '<li><a href="' . $sayfaq . '">' . $s . '</a></li> ';
    }
}
?>

                                        </ul>
                                    </div>
                                    <!--Sayfalama Bitiş-->
                                    <hr>
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

<? include("alt-bolum.php"); ?>
        <script>
            $(document).ready(function () {
                $('.tooltips').tooltip();
            });
        </script>
        <!--JS Coding End-->
        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->


        <script type='text/javascript' src='assets/js/retina.js'></script>
        <script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>


    </body>
</html>
