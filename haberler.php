<?php
define("_VALID_PHP", true);
require_once("init.php");


$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();


$id = $_GET['id'];
$sql = "select * from haberler WHERE dil='$Lang' and id='$id' ";
$q = mysql_query($sql);
$haberoku = mysql_fetch_array($q);

$resim = getName("select * from haber_resimleri WHERE eid='" . $haberoku['anakat'] . "' ", 'resim');
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang=tr>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang=tr>
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

        <title><?= ($haberoku['baslik']) ?></title>
        <meta name="description" content="<? echo yazikes(temizle($haberoku['icerik']), ".", "300"); ?>"/>
        <meta name="keywords" content="<?= (str_replace(' ', ",", stripslashes($haberoku['baslik']))) ?>"/>
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />


        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($haberoku['baslik']) ?>" />
        <meta property="og:description" content="<? echo yazikes(temizle($haberoku['icerik']), ".", "300"); ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />


        <!--CSS START-->
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

        <!--CSS END-->
        <!--JAVASCRIPT END-->
    </head>
    <body class="home page page-template">
        <? include("ust-bolum.php"); ?>
        <div id=content class=clearfix>


            <div class=container>
                <div class=row>
                    <? include("sol-bolum.php"); ?>

                    <div id=main class=span9>
                        <h1 class="page-header "><?= ($haberoku['baslik']) ?></h1>
                        <hr/>

                        <div class="habertarih"><?= ($haberoku['tarih']) ?> - Yazar : <?= ($haberoku['ekleyen']) ?></div>
                        <div id="haberoku">
                            <h2 class="page-header "><?= ($haberoku['baslik']) ?></h2>
                            <?= (html_entity_decode($haberoku['icerik'])) ?>


                        </div>


                        <div class="clearfix"></div>

                        <? echo reklam('3'); ?>
                        <hr>




                    </div>



                </div>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('img').attr('src', $(this).attr('src').replace('="', '="../'));
                    });
                </script>


            </div>
        </div>
    </div>
</div>
<? include("alt-bolum.php"); ?>
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
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=suko79"></script>

<?= (mb_convert_encoding($GoogleAnalytics, "UTF-8", "HTML-ENTITIES")) ?>
</body>
</html>
