<?php
define("_VALID_PHP", true);
header("HTTP/1.0 404 Not Found");
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
        <!--START SEO TOOLS START-->
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="msvalidate.01" content="<?= ($bingdogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="<?= ($favicon) ?>" type="image/png"/>
        <title>404 Sayfası <?= (cleanOut($dil['sitetitle'])) ?></title>
        <meta name="description" content="404 <?= (cleanOut($dil['sitedesicription'])) ?>"/>
        <meta name="keywords" content="404,<?= (cleanOut($dil['sitekeywords'])) ?>"/>
        <link rel="image_src" href="<?= ($core->site_logo) ?>" />

        <!--START SEO TOOLS END-->
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
                    
                    <div id="main" class="span12 error404">

                <div class="not-found">
                    <h1>404</h1>
                    <h2>Aradığınız sayfa büyük olasılıkla silinmiş veya kaldırılmış olabilir.</h2>
                    <p><a href="<?php echo $SiteAddress; ?>arama/" class="btn btn-large btn-default">Tüm ilanları göster</a></p>
                </div>
            </div>
                </div>
            </div>
        </div>
<? if ($demomode == '1') { ?>


            <div class="modal hide"  id="myModal" > <a class="close" data-dismiss="modal">×</a>
                <a href="http://www.egebilnet.net/emlak-sitesi-siparis-ver" target="_blank"><img src="<?php echo SITEURL; ?>assets/img/emlak-sitesi/emlak-sitesi-hazir-emlak-sitesi.jpg" alt="emlak sitesi,hazır emlak sitesi" /></a>
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