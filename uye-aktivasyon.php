<?php
define("_VALID_PHP", true);
require_once("init.php");

if ($user->logged_in)
    redirect_to($SiteAddress . "ilanlarim/");


if (isset($_POST['doLogin']))
    : $result = $user->login($_POST['username'], $_POST['password']);

    /* Login Successful */
    if ($result)
        : redirect_to($SiteAddress . "ilanlarim/");
    endif;
endif;
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

        <title><?= (str_replace('"', "&#34;", stripslashes($SiteTitle))) ?></title>
        <meta name="description" content="Açıklama">
        <meta name="keywords" content="Anahtar kelimeler">
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
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.7.2.min.js'></script>  
        <script type="text/javascript" src="assets/admin/global.js"></script>
        <script type="text/javascript"> function swapStyleSheet(sheet) {
                document.getElementById('properta-css').setAttribute('href', sheet);
            }</script>
        <script type="text/javascript" src="assets/libraries/sharebar/jquery.share.js"></script>
        <!--JS Coding End-->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#Paylas').share({
                    networks: ['facebook', 'twitter', 'googleplus', 'linkedin', 'tumblr', 'pinterest', ],
                    theme: 'square'
                });

                $('.top').removeClass('birbes animated fadeInDown');


            });
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
                                        <li class="active"><a href="#login" data-toggle="tab">Üye Aktivasyon Paneli</a></li>
                                        <div id="Paylas" class="pull-right" ></div>
                                    </ul>
                                    <!-- /.nav -->

                                    <div class="tab-content">

                                        <div class="row-fluid">



                                            <div class="span4 ">


                                                <div id="msgholder"></div>
                                                <span id="loader" style="display:none"></span>
                                                <form action="" method="post" id="admin_form" name="admin_form">

                                                    <div class="control-group">
                                                        <label class="control-label">
                                                            <?= ($dil['eposta-adresiniz']) ?>
                                                            <span class="form-required">*</span>
                                                        </label>

                                                        <div class="controls">
                                                            <input name="email" type="text" size="45" maxlength="40" class="inputbox" />
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->

                                                    <div class="control-group">
                                                        <label class="control-label">
                                                            <?= ($dil['aktivasyon-kodu']) ?>
                                                            <span class="form-required">*</span>
                                                        </label>

                                                        <div class="controls">
                                                            <input name="token" type="text" size="45" maxlength="40" class="inputbox" />
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->

                                                    <div class="form-actions">
                                                        <input name="submit" value="<?= ($dil['aktive-et']) ?>" type="submit" class=" btn-success btn-block"/>
                                                    </div>
                                                    <!-- /.form-actions -->

                                                </form>


                                                <hr />


                                                <form action="" method="post" id="login_form" name="login_form">
                                                    <input name="doLogin" type="hidden" value="1" />

                                                    <?php print $core->showMsg; ?>

                                                    <div class="control-group">

                                                        <div class="controls">
                                                            <input name="username" disabled="true" type="text" size="45" maxlength="20"  placeholder="<?= ($dil['kullanici-adi']) ?>" required="true"  value=""/>
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->

                                                    <div class="control-group">


                                                        <div class="controls">
                                                            <input name="password" type="password" disabled="true" size="45" maxlength="20" placeholder="<?= ($dil['sifreniz']) ?>" required="true" value="" />
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->

                                                    <div class="control-group clearfix">
                                                        <div class="controls span8">
                                                            <input type="checkbox" name="remember" disabled="true" value="1" /> <?= ($dil['oturumumu-surekli-acik-tut']) ?>
                                                        </div>


                                                    </div>

                                                    <div class="control-group clearfix">
                                                        <div class="controls">
                                                            <button class=" btn btn-block" disabled="true"   type="submit"><?= ($dil['giris-yap']) ?></button>
                                                            <a href=<?= ($SiteAddress) ?>sifremi-unuttum/" class="btn btn-link pull-right"><?= ($dil['sifremi-unuttum']) ?></a>
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->
                                                    <!-- /.form-actions -->
                                                </form>
                                            </div>
                                            <div class="span4 ">
                                                <div class="hero-unit ">
                                                    <h3><?= ($dil['bireysel-uye-ol']) ?></h3>
                                                    <p class="text-success"><?= ($dil['bireysel-uye-ol-not']) ?> </p>

                                                    <a href="<?= ($SiteAddress) ?>bireysel-uye/" class="btn btn-primary btn-block btn-large"><?= ($dil['uyeligimi-baslat']) ?></a>

                                                </div>
                                            </div>

                                            <div class="span4 ">
                                                <div class="hero-unit">
                                                    <h3><?= ($dil['kurumsal-uye-ol']) ?></h3>
                                                    <p class="text-success"><?= ($dil['kurumsal-uye-ol-not']) ?></p>

                                                    <a href="<?= ($SiteAddress) ?>kurumsal-uye/"  class="btn btn-primary btn-block btn-large"><?= ($dil['uyeligimi-baslat']) ?></a>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.tab-pane -->


                                    </div>
                                    <!-- /.tab-content -->

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

        <?php echo $core->doForm("accActivate", "ajax/user.php"); ?>            
        <? include("alt-bolum.php"); ?>
        <!--JS Coding End-->
        <!--[if lt IE 9]>
           <script src="assets/js/html5.js" type="text/javascript"></script>
           <![endif]-->
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/retina.js'></script>
        <script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>


    </body>
</html>
