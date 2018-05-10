
<?php
define("_VALID_PHP", true);
require_once("init.php");

$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();

$firmaadi = toGet($_GET['firmaadi'], $_POST['firmaadi']);
$ilv = toGet($_GET['il'], $_POST['il']);
$ilcev = toGet($_GET['ilce'], $_POST['ilce']);
$UyeTip = toGet($_GET['UyeTip'], $_POST['UyeTip']);

$iladi = getName("select * from il where   id='" . $ilv . "'", "il_adi");
$ilceadi = getName("select * from ilce where   id='" . $ilcev . "'", "ilce_adi");

$u = array(
    $UyeTip == 2 ? $dil['emlak-ofisi'] : "",
    $UyeTip == 3 ? $dil['insaat-firmasi'] : "",
    $UyeTip == 4 ? $dil['muteahhit'] : "",
);
foreach ($u as $val) {
    if (!empty($val)) {
        $membertype = $val;
    }
}
$membersearch = 1;
?>
<!DOCTYPE html>
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

        <title><?= ($kelime) ?> <?= ($iladi) ?> <?= ($ilceadi) ?> <?= ($membertype) ?></title>
        <meta name="description" content="<?= ($kelime) ?> <?= ($iladi) ?> <?= ($ilceadi) ?> <?= ($membertype) ?>"/>
        <meta name="keywords" content="emlak sitesi"/>
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($iladi) ?> <?= ($ilceadi) ?> <?= ($membertype) ?>" />
        <meta property="og:description" content="<?= ($kelime) ?> <?= ($iladi) ?> <?= ($ilceadi) ?> <?= ($membertype) ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <!--CSS START-->
        <link rel=stylesheet id=bootstrap-css href=assets/libraries/bootstrap/css/bootstrap.min.css type=text/css media='all'/>
        <link rel=stylesheet id=bootstrap-responsive-css href=assets/libraries/bootstrap/css/bootstrap-responsive.min.css type=text/css media='all'/>
        <link rel=stylesheet id=pictopro-normal-css href=assets/icons/pictopro-normal/pictopro.css type=text/css media='all'/>
        <link rel=stylesheet id=properta-css href=assets/css/<?= ($core->theme) ?>.css type=text/css media='all'/>

        <!--[if lt IE 9]>
        <script src=assets/js/html5.js type=text/javascript></script>
        <![endif]-->

        <!--JAVASCRIPT START-->
        <script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script>
        <!--CSS END-->
        <!--JAVASCRIPT END-->
    </head>
    <body class="home page page-template">
        <? include("ust-bolum.php"); ?>
        <div id=content class=clearfix>
            <div class=container>
                <div class=row>
                    <? include("sol-bolum.php"); ?>

                    <div id="main" class="span9 ">
                        <div class="visible-desktop"><? echo reklam('12'); ?></div> 
                        <h1 class="page-header"><?= ($kelime) ?> <?= ($iladi) ?> <?= ($ilceadi) ?> <?= ($membertype) ?> </h1>
                        <div class="properties-grid">
                            <div class="row-fluid">
                                <?
                                if ($UyeTip != '-1' && $UyeTip != '') {
                                    $UyeTip = "  userType='" . $UyeTip . "'";
                                }

                                if ($ilv != '-1' && $ilv != '') {
                                    $ilv = " and  il='" . $ilv . "'";
                                }
                                if ($ilcev != '-1' && $ilcev != '') {
                                    $ilcev = " and  ilce='" . $ilcev . "'";
                                }
                                if ($firmaadi != '-1' && $firmaadi != '') {
                                    $firmaadi = " and firmaadi LIKE '%$firmaadi%'";
                                }

                                $sql = "select * from users where $UyeTip $ilv $ilcev $firmaadi";
                                $qrDisplay = mysql_query($sql);
                                while ($rsDisplay = mysql_fetch_array($qrDisplay)) {


                                    if ($rsDisplay['avatar']) {
                                        $img = "assets/uploads/Uyeler/" . $rsDisplay['avatar'] . "";
                                    } else {
                                        $img = "assets/uploads/Uyeler/default.png";
                                    }
                                    ?>
                                    <div class="span3" style="height: 200px;">                   
                                        <div class="property" >                    
                                            <div class=image >
                                                <div class=content style="background-color: #fff; padding: 3px;">
                                                    <a href="<?= (sublink($rsDisplay['id'])) ?>">
                                                        <img  src="<?= ($img) ?>" style="height: 80px"  alt="<?= (seflink($rsDisplay['firmaadi'])) ?>">
                                                    </a>
                                                </div>

                                            </div>

                                            <div class=info>
                                                <div class="title clearfix">
                                                    <h2>
                                                        <a href="<?= (sublink($rsDisplay['id'])) ?>" title="<?= ($AdTitle) ?>">
                                                            &nbsp;<?= ($rsDisplay['firmaadi']) ?>
                                                        </a>
                                                    </h2>
                                                </div>
                                                <div class=location>
                                                    <?= (getName("select * from il where   id='" . $rsDisplay['il'] . "'", "il_adi")) ?> - <?= (getName("select * from ilce where   id='" . $rsDisplay['ilce'] . "'", "ilce_adi")) ?>&nbsp;</div>
                                            </div>
                                        </div>

                                        <div class="property-info clearfix">
                                            <span class="btn btn-mini btn-block">
                                                <i class="icon icon-normal-phone" style="color: #000"></i>
                                                <?= ($rsDisplay['tel']) ?>
                                                <br />
                                                <i class="icon icon-normal-mobile-phone" style="color: #000"></i>
                                                <?= ($rsDisplay['gsm']) ?> 

                                            </span>

                                        </div>

                                    </div>

                                <? } ?>
                            </div>
                        </div>
                        <? echo reklam('13'); ?>
                    </div>
                </div>
            </div>
        </div>
        <? include("alt-bolum.php"); ?>
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/jquery.number.min.js'></script>
        <script src="assets/js/bolgeler_JS.js" type="text/javascript"></script>
        <script type='text/javascript' src='assets/js/jquery.vticker.js'></script>
        <script>
            $(document).ready(function () {
                $('#p_min').number(true, 0);
                $('#p_max').number(true, 0);
            });
        </script>
        <?= (mb_convert_encoding($GoogleAnalytics, "UTF-8", "HTML-ENTITIES")) ?>
    </body>
</html>
