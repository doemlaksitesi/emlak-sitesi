<?php
define("_VALID_PHP", true);
require_once("init.php");
$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="<? echo $Lang ?>">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="<? echo $Lang ?>">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="<? echo $Lang ?>">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <link rel="alternate" hreflang="<? echo $Lang ?>" href="<?php echo $SiteAddress ?>" />
        <link rel="canonical" href="<?php echo $urladresi ?>" />
        <base href="<?= (SITEURL) ?>" />
       
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="msvalidate.01" content="<?= ($bingdogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="<?= (SITEURL) ?><?= ($favicon) ?>" type="image/png"/>
        
        <title><?= ($dil['sitetitle']) ?></title>
        <meta name="description" content="<? echo yazikes(temizle($dil['sitedesicription']), ".", "300"); ?>"/>
        <meta name="keywords" content="<?= (str_replace(' ', ",", stripslashes($dil['sitekeywords']))) ?>"/>
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />
        
        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($multi['Baslik']) ?>" />
        <meta property="og:description" content="<? echo yazikes(temizle($multi['Aciklama']), ".", "300"); ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <!--CSS START-->
        <link rel=stylesheet id=revolution-fullwidth href=assets/libraries/rs-plugin/css/fullwidth.css type=text/css media='all'/>
        <link rel=stylesheet id=revolution-settings href=assets/libraries/rs-plugin/css/settings.css type=text/css media='all'/>
        <link rel=stylesheet id=bootstrap-css href=assets/libraries/bootstrap/css/bootstrap.min.css type=text/css media='all'/>
        <link rel=stylesheet id=bootstrap-responsive-css href=assets/libraries/bootstrap/css/bootstrap-responsive.min.css type=text/css media='all'/>
        <link rel=stylesheet id=pictopro-normal-css href=assets/icons/pictopro-normal/pictopro.css type=text/css media='all'/>
        <link rel=stylesheet id=properta-css href=assets/css/<?= ($core->theme) ?>.css type=text/css media='all'/>
        <link rel='stylesheet' id='aviators-css' href='assets/css/jquery.bxslider.css' type='text/css' media='all'/>

        <link type="text/css" rel="stylesheet" href="assets/libraries/datepicker/css/datepicker.css" />
        <link href="assets/css/sumoselect.css" rel="stylesheet" />

        <!--[if lt IE 9]>
        <script src=assets/js/html5.js type=text/javascript></script>
        <![endif]-->
        <!--JAVASCRIPT START-->
        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
        <script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script>

        <script type=text/javascript src=assets/libraries/rs-plugin/js/jquery.themepunch.revolution.min.js></script>
        <script type=text/javascript src=assets/libraries/rs-plugin/js/jquery.themepunch.plugins.min.js></script>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=suko79"></script>
        <!--JAVASCRIPT END-->
    </head>
    <body class="home page page-template">
        <? include("ust-bolum.php"); ?>
        <div id=content class=clearfix>
            <div class=container>
                <div class=row>
                    <? include("sol-bolum.php"); ?>
                    <div id=main class=span9>
                        <div class="row-fluid">						
                            <div class="span9">						
                                <div class=" fullwidthbanner-container hidden-phone" style="margin:0 auto;background-color:#fff;padding:0;margin-top:0;margin-bottom:0; width: 800px; z-index:1">
                                    <div id=frontpage-slider class="rev_slider" style=display:none;>
                                                <?= (html_entity_decode($dil['slider1'])) ?>
                                    </div>
                                </div>
                                <script type=text/javascript>jQuery("#frontpage-slider").show().revolution({delay: 9000, startwidth: 620, startheight: 250, navigationType: "bullet", navigationArrows: "solo", navigationStyle: "round", touchenabled: "on", onHoverStop: "off", navigationHAlign: "center", navigationVAlign: "bottom", navigationHOffset: 0, navigationVOffset: 20, soloArrowLeftHalign: "left", soloArrowLeftValign: "center", soloArrowLeftHOffset: 20, soloArrowLeftVOffset: 0, soloArrowRightHalign: "right", soloArrowRightValign: "center", soloArrowRightHOffset: 20, soloArrowRightVOffset: 0, shadow: 2, fullWidth: "off", fullScreen: "off", stopLoop: "off", stopAfterLoops: -1, stopAtSlide: -1, shuffle: "on", hideSliderAtLimit: 0, hideCaptionAtLimit: 0, hideAllCaptionAtLilmit: 0, startWithSlide: 0});</script> 
                            </div>							
                            <!--<div class="visible-desktop span3"> <? echo reklam('4'); ?></div>-->
                            <div id="AgencyList" class="span3" style=" text-align: center;">
                                <span class="btn  btn-block btn-primary" style="border-radius: 0; margin: 0;"><?= ($dil['gayrimenkul-danismanlari']) ?></span>

                                <div id="danisman-slide" class="row-fluid">
                                    <ul>
                                        <?
                                        $sql = "Select * from users where  danisman='1'   order by created asc  limit 5  ";
                                        $q = mysql_query($sql);
                                        while ($uye = mysql_fetch_array($q)) {
                                            
                                            $avatar = $uye['avatar'];
                                            if($avatar==NULL){
                                                $avatar = "temp.png";
                                            }
                                            ?>
                                            <li >
                                                <a  href="<?php echo $SiteAddress ?><?= (seflink($uye['fname'])) ?>-<?= (seflink($uye['lname'])) ?>/uye-<?= ($uye['id']) ?>/"><img src="assets/uploads/Uyeler/<?=($avatar)?>" alt="<?= ($uye['fname']) ?> <?= ($uye['lname']) ?>" class="img-polaroid" style="width: 115px; margin:10px  10px 5px 10px;"></a>
                                                <div class="AgencyList-h2" ><h2 style="margin: 0;"><?= ($uye['fname']) ?> <?= ($uye['lname']) ?></h2></div>
                                                <div><?= (getName("select * from il where  id='" . $uye['il'] . "'", "il_adi")) ?> - <?= (getName("select * from ilce where  id='" . $uye['ilce'] . "'", "ilce_adi")) ?></div>
                                                <div><i class="icon-normal-phone-circle"></i> <?= ($uye['gsm']) ?></div>
                                                <a  href="<?php echo $SiteAddress ?><?= (seflink($uye['fname'])) ?>-<?= (seflink($uye['lname'])) ?>/uye-<?= ($uye['id']) ?>/" class="btn btn-success  btn-block" style="border-radius: 0;"><i class="icon-list"></i> <?php echo $dil['bu-kisinin-ilan-portfoyu']?></a>
                                            </li>
<? } ?> 	
                                    </ul>					  		
                                </div>						
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#danisman-slide').vTicker({
                                        speed: 500,
                                        pause: 3000,
                                        animation: 'fade',
                                        mousePause: true,
                                        showItems: 1
                                    });
                                });
                            </script>				

                        </div>
                        <div class="visible-desktop"  style="margin-top: 20px; text-align: center;"><? echo reklam('5'); ?></div>	

                        <div class=properties-grid>
                            <h2 class="page-header">
                                <?php echo $dil['vitrin-ilanlari'];?>
                            </h2>

                            <div class=row-fluid>
                                <?
                                //Listing query - ilan sorgulama
                                $adsdate = ($demomode == false) ? "and Sure >= NOW()" : false;
                                $sql = "select  * FROM  t_advert where  Visible='1' and Validate='1' and Vitrin='1' $adsdate ORDER BY ADate desc  limit 32  ";
                                $qrDisplay = mysql_query($sql);
                                while ($rsDisplay = mysql_fetch_array($qrDisplay)) {

                                    $AdTitle = getName("select * from t_advert_detail where  IlanNo='" . $rsDisplay['ID'] . "' and Dil='" . $Lang . "' limit 1 ", "Baslik");
                                    $AdDescription = getName("select * from t_advert_detail where  IlanNo='" . $rsDisplay['ID'] . "' and Dil='" . $Lang . "' limit 1", "Aciklama");
                                    $iladi = getName("select * from il where   id='" . $rsDisplay['il'] . "' limit 1", "il_adi");
                                    $ilceadi = getName("select * from ilce where   id='" . $rsDisplay['ilce'] . "' limit 1", "ilce_adi");
                                    $semtadi = getName("select * from semt where   id='" . $rsDisplay['semt'] . "' limit 1", "semt_adi");
                                    $mahadi = getName("select * from mahalle where   id='" . $rsDisplay['mah'] . "' limit 1", "mahalle_adi");

                                    $sql = "select * from e_criteria_type where Category LIKE '%" . $rsDisplay['EstateType'] . "%'  and Lang='$Lang' and Visible='1'  ";
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

                                                    $MainCategory = getName("select * from e_criteria_details  where  ItemID='" . $rsDisplay[$listing['SefName']] . "' and Lang='" . $Lang . "' limit 1 ", "Name");
                                                    $SubCategory = getName("select * from e_category  where  ItemID='" . $rsDisplay['EstateType'] . "' and Lang='" . $Lang . "' limit 1 ", "Name");
                                                    ;
                                                }

                                                //Icon fields - ikon listesi
                                            }
                                        }
                                    }

                                    //Status fields Rent-Sales, Emlak durumu Satılık-kiralık vs
                                    $Status = getName("select * from e_criteria_details  where  ItemID='" . $rsDisplay['durumu'] . "' and Lang='" . $Lang . "'  limit 1", "Name");

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
                                                            &nbsp;<?= ($AdTitle) ?>
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div class=location><?= ($iladi) ?>&nbsp;<?= ($ilceadi) ?>  <?= ($semtadi) ?> <?= ($mahadi) ?>&nbsp;</div>
                                            </div>
                                        </div>



                                    </div>
<? } ?>


                            </div>



                        </div>


                        <div class="row-fluid visible-desktop">
                            <div  style="margin: 20px 0 20px 0; text-align: center;"><? echo reklam('6'); ?></div>
                        </div>
                        
                        <?php include 'son-eklenen-uyeler.php';?>
                        
                    </div>
                </div>
            </div>
        </div>
<? if ($demomode == '1') { ?>
        <div class="modal hide"  id="myModal" > <a class="close" data-dismiss="modal">×</a>
            <a href="http://doemlaksitesi.com" target="_blank"><img src="<?php echo SITEURL; ?>assets/img/emlak-sitesi/emlak-sitesi-hazir-emlak-sitesi.jpg" alt="emlak sitesi,hazır emlak sitesi" /></a>
            <a href="<?php echo SITEURL; ?>yonetim/login.php" target="_blank" class="btn btn-block btn-lg btn-primary">Yönetim Paneli (Test Et)</a>
        </div>
        <script type="text/javascript">
            $(window).load(function ()
            {
                window.setTimeout(function ()
                {
                    $("#myModal").modal("hide");

                    $("#myModal").modal("show").on("shown", function ()
                    {
                        window.setTimeout(function ()
                        {
                            $("#myModal").modal("hide");
                        }, 9000);
                    });
                }, 2000);
            });
        </script>
<? } ?>

        <script>
            $(document).ready(function () {
                $('.tooltips').tooltip();
            });
        </script>

<?php include("alt-bolum.php"); ?>
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/bootstrap-tooltip.js'></script>		
        <script type='text/javascript' src='assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang ?>.js'></script>
        <script type='text/javascript' src='assets/js/jquery.number.min.js'></script>
        <script src="assets/js/jquery.sumoselect.js"></script>		
        <script type='text/javascript' src='assets/js/jquery.vticker.js'></script>
        <script type='text/javascript' src='assets/js/carousel.js'></script> 
        <script type='text/javascript' src='assets/js/jquery.bxslider.js'></script>		
        <script type='text/javascript' src='assets/js/jquery.bxslider.min.js'></script>
        <script type='text/javascript' src='assets/js/properta.js'></script> 
    </body>
</html>