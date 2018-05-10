<?php
define("_VALID_PHP", true);
require_once("init.php");

$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();

$il = toGet($_GET['il'], $_POST['il']);
$ilce = toGet($_GET['ilce'], $_POST['ilce']);
$semt = toGet($_GET['semt'], $_POST['semt']);
$mah = toGet($_GET['mahalle'], $_POST['mahalle']);
$Category = toGet($_GET['Cat'], $_POST['Cat']);
$_SESSION['order'] = $_GET['order'];
$sayfaUrl = toGet($_GET['sayfa'], $_POST['sayfa']);
$ilanoarama = toGet($_GET['ilanno'], $_POST['ilanno']);

$_SESSION['il'] = $il;
$_SESSION['ilce'] = $ilce;
$_SESSION['semt'] = $semt;
$_SESSION['mahalle'] = $mah;

$url = strtok($_SERVER["REQUEST_URI"], '?');

$SeoCriteria = array();
$SeoCriteria[] = getName("select * from il where   id='" . $il . "'", "il_adi");
$SeoCriteria[] = getName("select * from ilce where id='" . $ilce . "'", "ilce_adi");
$SeoCriteria[] = getName("select * from semt where   id='" . $semt . "'", "semt_adi");
$SeoCriteria[] = getName("select * from mahalle where   id='" . $mah . "'", "mahalle_adi");
$SeoCriteria[] = getName("select * from e_category  where   ItemID='" . $Category . "' and Lang='$Lang' ", "Name");

foreach ($_GET as $val => $value) {
    if (!is_array($value)) {
        if ($val != "sayfa" && $val != "")
            $querystring .= "$val=" . $value . "&amp;";
    }
    foreach ($value as $key) {
        if ($val != "sayfa" && $val !== $value)
            $querystring .= $val . "[]=" . $key . "&amp;";
        $q = getName("select * from e_criteria_details where ItemID='" . $key . "' and Lang='$Lang'", "Name");
        if (!intval($q)) {
            $SeoCriteria[] = $q;
        }
    }
}
foreach ($SeoCriteria as $val) {
    if ($val != "") {
        $seotitle .= $val . " ";
        $seokeywords .= $val . ",";
        $SeoCriteria .= '<button  class="btn" title="' . $val . ' ilanları">' . $val . "</button>";
    }
}
$seotitle .= $dil['emlak-ilanlari'];
?>                      
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang=<? echo $Lang ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang=<? echo $Lang ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="<? echo $Lang ?>">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <link rel="alternate" hreflang="<? echo $Lang ?>" href="<?php echo $SiteAddress ?>" />
        <link rel="canonical" href="<?php echo $urladresi ?>" />
        <base href="<?= (SITEURL) ?>" />
        <!--START SEO TOOLS START-->
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="msvalidate.01" content="<?= ($bingdogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="<?= (SITEURL) ?><?= ($favicon) ?>" type="image/png"/>

        <title><?= ($seotitle) ?></title>
        <meta name="description" content="<? echo yazikes(temizle($seotitle), ".", "300"); ?>"/>
        <meta name="keywords" content="<?= (str_replace(' ', ",", stripslashes($seokeywords))) ?>"/>
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($seotitle) ?>" />
        <meta property="og:description" content="<? echo yazikes(temizle($seotitle), ".", "300"); ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />



        <!--START SEO TOOLS END-->
        <!--CSS START-->
        <link rel=stylesheet id=bootstrap-css href=assets/libraries/bootstrap/css/bootstrap.min.css type=text/css media='all'/>
        <link rel=stylesheet id=bootstrap-responsive-css href=assets/libraries/bootstrap/css/bootstrap-responsive.min.css type=text/css media='all'/>
        <link rel=stylesheet id=pictopro-normal-css href=assets/icons/pictopro-normal/pictopro.css type=text/css media='all'/>
        <link rel=stylesheet id=properta-css href=assets/css/<?= ($core->theme) ?>.css type=text/css media='all'/>

        <link type="text/css" rel="stylesheet" href="assets/libraries/datepicker/css/datepicker.css" />
        <link href="assets/css/sumoselect.css" rel="stylesheet" />
        <!--CSS END-->


        <!--JAVASCRIPT START-->
        <!--[if lt IE 9]>
        <script src=assets/js/html5.js type=text/javascript></script>
        <![endif]-->
        <script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script>		
        <!--JAVASCRIPT END-->
    </head>
    <body class="home page page-template">
        <? include("ust-bolum.php"); ?>
        <div id=content class=clearfix>
            <div class=container>
                <div class=row>
                    <? include_once("sol-bolum.php"); ?>
                    <div id=main class=span9>
                        <div class="visible-desktop"><? echo reklam('10'); ?></div> 
                        <h1 class="page-header">
                            <div class="btn-group">
                                <button  class="btn btn-warning"><?= ($dil['arama-kriterleri']) ?>:</button>
                                <?= ($SeoCriteria) ?>
                                <select class="btn span2"  name="order"  onchange="top.location.href = '<?= ($url . "?" . $querystring . "order=") ?>' + this.options[ this.selectedIndex ].value;">				  
                                    <option value=""><?= ($dil['ilani-sirala']) ?></option>
                                    <option value="1" <?= ($_SESSION['order'] == '1' ? "selected='selected'" : "") ?>><?= ($dil['fiyat-artan']) ?></option>
                                    <option value="2" <?= ($_SESSION['order'] == '2' ? "selected='selected'" : "") ?>><?= ($dil['fiyat-azalan']) ?></option>
                                    <option value="3" <?= ($_SESSION['order'] == '3' ? "selected='selected'" : "") ?>><?= ($dil['yeni-tarih']) ?></option>
                                    <option value="4" <?= ($_SESSION['order'] == '4' ? "selected='selected'" : "") ?>><?= ($dil['eski-tarih']) ?></option>				    </select>
                            </div>

                        </h1>



                        <div class=properties-grid>

                            <div class=row-fluid>


                                <div class=row-fluid>


                                    <?php
                                    $adsdate = ($demomode == false) ? "and Sure >= NOW()" : false;
                                    if (toGet($ilanoarama) != '-1' && toGet($ilanoarama) != '') {

                                        if (IsHave("select * from t_advert where ID='" . $ilanoarama . "' and Visible='1'") == 1) {

                                            header("location:  " . $SiteAddress . "detay-" . $ilanoarama . "/");
                                        } else {

                                            echo "<div class=\"alert alert-error\">" . $dil['ilan-bulunamadi'] . "</div>";
                                        }
                                    }

                                    if (toGet($il) != '-1' && toGet($il) != '') {
                                        $il = " il='" . $il . "' and";
                                    }

                                    if (toGet($ilce) != '-1' && toGet($ilce) != '') {
                                        $ilce = "  ilce='" . $ilce . "' and";
                                    }

                                    if (toGet($semt) != '-1' && toGet($semt) != '') {
                                        $semt = "  semt='" . $semt . "' and";
                                    }

                                    if (toGet($mah) != '-1' && toGet($mah) != '') {
                                        $mah = "  mah='" . $mah . "' and";
                                    }



                                    //Criteria post or get listing
                                    $sql = "select * from e_criteria_type where  Lang='$Lang' and SearchForm='1' and Visible='1'  ";
                                    $q = mysql_query($sql);
                                    while ($criteria = mysql_fetch_array($q)) {

                                        //empty control
                                        if (!empty($_GET[$criteria['SefName']])) {

                                            if ($criteria['Type'] == 'selectbox' || $criteria['Type'] == 'checkbox') {

                                                if (count($_GET[$criteria['SefName']]) > 0) {
                                                    $bdrm = implode(',', $_GET[$criteria['SefName']]);
                                                    $str .= ' AND ' . $criteria['SefName'] . ' IN (' . $bdrm . ') ';
                                                }
                                            }//selectbox checkbox control										
                                        }//empty control


                                        if ($criteria['BeetWeen'] == '1' && $criteria['Type'] == 'textbox' && $criteria['Type'] !== 'selectbox') {
                                            if (toGet($_GET[$criteria['SefName'] . '1']) != '-1' && toGet($_GET[$criteria['SefName'] . '1']) != '' && toGet($_GET[$criteria['SefName'] . '2']) != '-1' && toGet($_GET[$criteria['SefName'] . '2']) != '') {

                                                $clean1 = str_replace(",", "", $_GET[$criteria['SefName'] . '1']);
                                                $clean2 = str_replace(",", "", $_GET[$criteria['SefName'] . '2']);
                                                $str .= " and " . $criteria['SefName'] . ">=" . $clean1 . " and " . $criteria['SefName'] . "<=" . $clean2 . " ";
                                            }//price
                                        }

                                        if ($criteria['Type'] == 'price' && $criteria['BeetWeen'] == '1') {
                                            if (toGet($_GET[$criteria['SefName'] . '1']) != '-1' && toGet($_GET[$criteria['SefName'] . '1']) != '' && toGet($_GET[$criteria['SefName'] . '2']) != '-1' && toGet($_GET[$criteria['SefName'] . '2']) != '') {
                                                $clean1 = str_replace(",", "", $_GET[$criteria['SefName'] . '1']);
                                                $clean2 = str_replace(",", "", $_GET[$criteria['SefName'] . '2']);
                                                $str .= " and " . $criteria['SefName'] . ">=" . $clean1 . " and " . $criteria['SefName'] . "<=" . $clean2 . " ";
                                            }
                                            //Currency
                                            if (toGet($_GET[$criteria['SefName'] . '_Cur']) != '-1' && toGet($_GET[$criteria['SefName'] . '_Cur']) != '') {
                                                $str .= ' AND ' . $criteria['SefName'] . "_Cur" . ' IN ("' . $_GET[$criteria['SefName'] . '_Cur'] . '")';
                                            }//Currency control
                                        }//price
                                    }//criteria list 
                                    //Agency fields - Kimden (Sahibinden emlak ofisi vs..)
                                    if (toGet($_GET['Agency']) != '-1' && toGet($_GET['Agency']) != '') {

                                        if (count($_GET['Agency']) > 0) {
                                            $bdrm = implode(',', $_GET['Agency']);
                                            $str .= ' AND UserType IN (' . $bdrm . ')';
                                        }
                                    }

                                    if (empty($_SESSION["order"])) {
                                        $OrderBy = '4';
                                    } else {
                                        $OrderBy = $_SESSION["order"];
                                    }
                                    switch ($OrderBy) {

                                        case 1:
                                            $order = "ORDER BY fiyat asc limit";
                                            break;

                                        case 2:
                                            $order = "ORDER BY fiyat desc limit";
                                            break;

                                        case 3:
                                            $order = "ORDER BY ADate asc limit";
                                            break;

                                        case 4:
                                            $order = "ORDER BY ADate desc limit";
                                            break;
                                    }


                                    //Pagination - Sayfalama
                                    $sayfax = 32;
                                    $sql = "select  * FROM  t_advert where $il $ilce $semt $mah   EstateType='" . $Category . "' and  Visible='1' and Validate='1' $str $adsdate  ";
                                    $q = mysql_query($sql);
                                    $toplamilan = mysql_num_rows($q);
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

                                    //Listing query - ilan sorgulama		       
                                    $sql = "select  * FROM  t_advert where $il $ilce $semt $mah   EstateType='" . $Category . "' and  Visible='1' and Validate='1' $str $adsdate  $order  " . $limit . "," . $sayfax . " ";
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

                                                    //Icon fields - ikon listesi
                                                }
                                            }
                                        }
                                        //Status fields Rent-Sales, Emlak durumu Satılık-kiralık vs
                                        $Status = getName("select * from e_criteria_details  where  ItemID='" . $rsDisplay['durumu'] . "' and Lang='" . $Lang . "' ", "Name");

                                        $str = $SiteAddress . seflink($AdTitle) . "/detay-" . $rsDisplay['ID'] . "/";
                                        $Seflink = preg_replace('/([^:])(\/{2,})/', '$1/', $str);


                                        //listing picture - ilan resimleri
                                        $picture = getName("select * from t_advert_images  where anaresim='1' and  ParentID='" . $rsDisplay['ID'] . "'", "Images");
                                        if (!empty($picture)) {

                                            $img = "assets/uploads/estate/thmb/" . $picture . "";
                                        } else {
                                            $img = "assets/uploads/estate/temp-orta.jpg";
                                        }
                                        ?>									
                                        <div class=span3>                   
                                            <div class=property>                    
                                                <div class=image>
                                                    <div class=content>
                                                        <a  href="<?= $Seflink ?>" title="<?= ($AdTitle) ?>">
                                                            <div class="description">
                                                                <p> <?= (strip_tags(html_entity_decode($AdDescription))) ?></p>
                                                            </div>
                                                            <img src=<?= ($img) ?> alt="<?= ($AdTitle) ?>">
                                                        </a>
                                                    </div>
                                                    <div class="rent-sale" >
    <?= ($Status) ?>  <?= ($SubCategory) ?>  <?= ($MainCategory) ?>
                                                    </div>											
    <? if (number_format($Price) !== '0') { ?>
                                                        <div class=price>
        <?= (number_format($Price) . " " . $PriceCurrency) ?> 											
                                                        </div>
    <? } ?>
                                                </div>

                                                <div class=info>
                                                    <div class="title clearfix">
                                                        <h2>
                                                            <a href="<?= ($Seflink) ?>" title="<?= ($AdTitle) ?>">
                                                    <?= ($AdTitle) ?>
                                                            </a>
                                                        </h2>
                                                    </div>
                                                    <div class=location><?= ($iladi) ?>&nbsp;<?= ($ilceadi) ?>  <?= ($semtadi) ?> <?= ($mahadi) ?></div>
                                                </div>
                                            </div>



                                        </div>
                                                            <? } ?>

                                </div>

                                <!--Sayfalama Başl.-->
                                <div class="pagination">
                                    <ul>
<?php
$sayfaq = $SiteAddress . "search/?" . "sayfa=1";
if ($sayfa != 1)
    echo '<li> <a href="' . $sayfaq . '">&lt;&lt; ' . $dil['ilk-sayfa'] . '</a></li> ';
for ($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
    if ($sayfa == $s) {
        echo '<li class="disabled"> <a>' . $s . '</a></li>';
    } else {
        $sayfaq = $SiteAddress . "search/?" . $querystring . "sayfa=$s";
        echo '<li><a href="' . $sayfaq . '">' . $s . '</a></li> ';
    }
}
?>						  
                                    </ul>
                                </div>
                                <!--Sayfalama Bitiş-->

                                        <?php if ($toplam_sayfa == '0') { ?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Uyarı!</strong> Aradığınız kriterlere uygun ilan bulunamadı.
                                    </div>
                                        <? } ?>				    

                            </div>
                            <div class="visible-desktop"><? echo reklam('11'); ?></div> 
                        </div>
                    </div>
                </div>
            </div>
<? include("alt-bolum.php"); ?>
            <script>
                $(document).ready(function () {
                    $('.tooltips').tooltip();
                });
            </script>
            <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
            <script type='text/javascript' src='assets/js/bootstrap-tooltip.js'></script>		
            <script type='text/javascript' src='assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
            <script type='text/javascript' src='assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang ?>.js'></script>
            <script type='text/javascript' src='assets/js/jquery.number.min.js'></script>
            <script src="assets/js/jquery.sumoselect.js"></script>
            <script type='text/javascript' src='assets/js/jquery.vticker.js'></script>	
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=suko79"></script>

    </body>
</html>
