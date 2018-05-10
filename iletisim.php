<?php
define("_VALID_PHP", true);
require_once("init.php");


$row = $user->getUserData();
?>
<?
$queryContact = mysql_query("select * from t_contact");
$rsContact = mysql_fetch_array($queryContact);
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
        <meta charset="utf-8">
        <link rel="alternate" hreflang="<? echo $Lang ?>" href="<?php echo $SiteAddress ?>" />
        <link rel="canonical" href="<?php echo $urladresi ?>" />
        <base href="<?= (SITEURL) ?>" />

        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="msvalidate.01" content="<?= ($bingdogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="<?= (SITEURL) ?><?= ($favicon) ?>" type="image/png"/>

        <title><?= ($rsContact['CompanyName']) ?></title>
        <meta name="description" content="<? echo yazikes(temizle($SiteDesicription), ".", "300"); ?>"/>
        <meta name="keywords" content="<?= ($SiteKeywords) ?>"/>
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($rsContact['CompanyName']) ?>" />
        <meta property="og:description" content="<? echo yazikes(temizle($SiteDesicription), ".", "300"); ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />        


        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->

        <!--Css Coding Start-->
        <link rel='stylesheet' id='font-css' href='http://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin%2Clatin-ext&#038;ver=3.6' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='chosen-css' href='assets/libraries/chosen/chosen.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>
        <link rel="stylesheet" type="text/css" href="assets/libraries/sharebar/jquery.share.css" />
        <link rel="stylesheet" href="assets/libraries/BootstrapFormHelpers/css/bootstrap-formhelpers.css"/>

        <!--Css Coding End-->

        <!--JS Coding Start-->
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.7.2.min.js'></script>
        <script type="text/javascript"> function swapStyleSheet(sheet) {
        document.getElementById('properta-css').setAttribute('href', sheet);
    }</script>
        <script type="text/javascript" src="assets/libraries/sharebar/jquery.share.js"></script>
        <script type="text/javascript"  src="assets/libraries/BootstrapFormHelpers/js/bootstrap-formhelpers-phone.js"></script>
        <script type='text/javascript' src='assets/js/validator.js'></script>

        <script type="text/javascript">

         $(document).ready(function () {

             $('.top').removeClass('birbes animated fadeInDown');
             $('#Paylas').share({
                 networks: ['facebook', 'twitter', 'googleplus', 'linkedin', 'tumblr', 'pinterest', ],
                 theme: 'square'
             });

         }); // end document.ready
        </script>


        <style>
            div small.error {
                color: #B94A48;
                font-size:10px;}

        </style>



        <!--JS Coding End-->


    </head>

    <body class="home page page-template" onUnload="GUnload()">
<? include("ust-bolum.php"); ?>

        <div id="content" class="clearfix">

            <div class="container">
                <div id="msgholder"></div>

                <div class="row">

                    <div id="main" class="span9"><div id="Paylas" class="pull-right" ></div>
                        <article class="clearfix page type-page">
                            <header class="entry-header">

                                <h1 class="page-header entry-title">
<?= ($rsContact['CompanyName']) ?> <?= ($dil['iletisim-bilgileri']) ?>
                                </h1>



                            </header>
                            <!-- .entry-header -->

                            <div class="entry-content">
                                <p  class="well">
                                    <strong><?= ($dil['adres']) ?> :</strong>  <?= ($rsContact['address']) ?> <strong>
<?= (getName("select * from ilce WHERE id='" . $rsContact['town'] . "' ", 'ilce_adi')) ?></strong> / <strong><?= (getName("select * from il WHERE id='" . $rsContact['city'] . "' ", 'il_adi')) ?></strong><br />

                                    <strong> <?= ($dil['telefon']) ?> :</strong> <?= ($rsContact['phone']) ?> <strong><?= ($dil['gsm']) ?> : </strong><?= ($rsContact['gsm']) ?> <strong><?= ($dil['fax']) ?> : </strong><?= ($rsContact['fax']) ?><br />
                                    <strong> <?= ($dil['eposta']) ?> :</strong> <img alt="<?= ($rsContact['Email']) ?>"  src="image.php?str=<?= ($rsContact['email']) ?>&uzunluk=200" border="1">
                                </p>


                                <div class="well" id="map" style="width: auto; height: 450px"></div>







                            </div>
                            <!-- .entry-content -->
                        </article>
                        <!-- /#post -->


                    </div>
                    <!-- /#main -->

                    <div class="sidebar span3">
                        <h2><?= ($dil['iletisim-formu']) ?></h2>
                        <span id="loader" style="display:none"></span>

                        <div class="property-filter widget">
                            <div class="content">
                                <form action="" method="post" id="admin_form" name="admin_form">
                                    <input type="hidden" name="Action" id="Action" value="Contact"> 
                                    <div class="area-from control-group">
                                        <label class="control-label">
<?= ($dil['adiniz'] . " " . $dil['soyadiniz']) ?>
                                        </label>

                                        <div class="controls">
                                            <input name="name" type="text"   id="name" placeholder="?" value="<?php if ($user->logged_in) echo $user->name; ?>" required="true">
                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->

                                    <div class="area-from control-group">
                                        <label class="control-label">
<?= ($dil['gsm']) ?>
                                        </label>

                                        <div class="controls">
                                            <input name="gsm" type="text"   id="gsm" placeholder="?" value="<?php if ($user->logged_in) echo $user->gsm; ?>" required="true">
                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->

                                    <div class="area-to control-group">
                                        <label class="control-label">
<?= ($dil['eposta']) ?>
                                        </label>

                                        <div class="controls">
                                            <input name="email" type="text"  id="email" placeholder="?" value="<?php if ($user->logged_in) echo $user->email; ?>" required="true">
                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->

                                    <div class="area-from control-group">
                                        <label class="control-label">
<?= ($dil['konu-basliginiz']) ?>
                                        </label>

                                        <div class="controls">
                                            <select name="subject" class="form-control" >
                                                <option value=""><?= ($dil['seciniz']) ?></option>
                                                <option value="<?= ($dil['destek-almak-istiyorum']) ?>"><?= ($dil['destek-almak-istiyorum']) ?>!</option>
                                                <option value="<?= ($dil['reklam-vermek-istiyorum']) ?>"><?= ($dil['reklam-vermek-istiyorum']) ?>!</option>
                                                <option value="<?= ($dil['gorus-bildimek-istiyorum']) ?>"><?= ($dil['gorus-bildimek-istiyorum']) ?>!</option>
                                                <option value="Ödeme Bildirimi"><?= ($dil['odeme-bildirimi']) ?></option>
                                            </select>
                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->



                                    <div class="area-to control-group">
                                        <label class="control-label">
<?= ($dil['mesajiniz']) ?>
                                        </label>

                                        <div class="controls">
                                            <textarea name="message" cols="55" rows="4"   id="message" required="true"></textarea>
                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->

                                    <div class="control-group">
                                        <label class="control-label">
                                            <strong><?= ($dil['dorulama']) ?> 3 + 5 =? </strong>
                                        </label>

                                        <div class="controls">

                                            <input name="code" type="text"  id="code" maxlength="5" class="input-medium" placeholder="<?= ($dil['islemin-sounucunu-girin']) ?>" required="true">

                                        </div>
                                        <!-- /.controls -->
                                    </div>
                                    <!-- /.control-group -->

                                    <div class="form-actions">
                                        <input id="submit" name="submit" class="btn" value="<?= ($dil['gonder']) ?>" type="submit" />

                                    </div>
                                    <!-- /.form-actions -->
                                </form>
                            </div>
                            <!-- /.content -->
                        </div><!-- /.property-filter -->                                
                    </div>
                    <!-- /#sidebar -->

                </div>
                <!-- /.row -->
            </div>


        </div>
        <!-- /#content -->
        <script type="text/javascript">
       // <![CDATA[
            function showLoader() {
                $("#loader").fadeIn(200);
            }

            function hideLoader() {
                $("#loader").fadeOut(200);
            }
            ;

            $(document).ready(function () {
                $("#admin_form").submit(function () {
                    var str = $(this).serialize();
                    showLoader();
                    $.ajax({
                        type: "POST",
                        url: "ajax/sendmail.php",
                        data: str,
                        success: function (msg) {
                            $("#msgholder").ajaxComplete(function (event, request, settings) {
                                if (msg == 1) {
                                    hideLoader();
                                    result = '<div class="alert alert-success"><span><?= ($dil['tesekkur-ederiz']) ?><\/span><?= ($dil['talep-onay']) ?><\/div>';
                                    $("#fullform").hide();
                                } else {
                                    hideLoader();
                                    result = msg;
                                }
                                $(this).html(result);
                            });
                        }
                    });
                    return false;
                });
            });
       // ]]>
        </script>           
<? include("alt-bolum.php"); ?>
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <!--[if lt IE 9]>
           <script src="assets/js/html5.js" type="text/javascript"></script>
           <![endif]-->

  <script type='text/javascript' src='assets/js/retina.js'></script>
<?
$sql = "select * from t_google";
$qrGoogle = mysql_query($sql);
$rsGoogle = mysql_fetch_array($qrGoogle);
?>

        <script src="https://maps.googleapis.com/maps/api/js?key=<?= ($core->googleapi) ?>"></script>
        <script type="text/javascript">
             function initialize() {
                 var latLng = new google.maps.LatLng(<?= ($rsContact['x_coor']) ?>, <?= ($rsContact['y_coor']) ?>);
                 var map = new google.maps.Map(document.getElementById('map'), {
                     zoom: 15,
                     center: latLng,
                     mapTypeId: google.maps.MapTypeId.ROADMAP
                 });
                 var marker = new google.maps.Marker({
                     position: latLng,
                     title: 'Sürükle bırak',
                     map: map,
                     draggable: false
                 });


             }

        // Onload handler to fire off the app.
             google.maps.event.addDomListener(window, 'load', initialize);
        </script>

    </body>
</html>

