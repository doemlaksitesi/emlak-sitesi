<?php
define("_VALID_PHP", true);
require_once("init.php");

if ($user->logged_in)
    redirect_to($SiteAddress . "ilanlarim/");

$numusers = countEntries("users");
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

        <title>Ücretsiz emlak ilanı vermek için üye olun</title>
        <meta name="description" content="Ücretsiz Emlak ofisi,İnşaat Firması,Müteahhit sitesi için ücretsiz üye ol">
        <meta name="keywords" content="Emlak ofisi,İnşaat Firması,Müteahhit sitesi kur">
        <link rel="image_src" href="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />

        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="Ücretsiz emlak ilanı vermek için üye olun" />
        <meta property="og:description" content="Ücretsiz Emlak ofisi,İnşaat Firması,Müteahhit sitesi için ücretsiz üye ol" />
        <meta property="og:image" content="<?= (SITEURL) ?><?= ($core->site_logo) ?>" />


        <!--Css Coding Start-->
        <link rel='stylesheet' id='font-css' href='http://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin%2Clatin-ext&#038;ver=3.6' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>
        <link rel="stylesheet" type="text/css" href="assets/libraries/sharebar/jquery.share.css" />
        <link rel="stylesheet" href="assets/libraries/BootstrapFormHelpers/css/bootstrap-formhelpers.css"/>
        <!--Css Coding End-->
        <script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script>
        <script type="text/javascript" src="assets/libraries/sharebar/jquery.share.js"></script> 
        <script type="text/javascript" src="assets/admin/global.js"></script>
    </head>
    <body class="home page page-template">
        <? include("ust-bolum.php"); ?>
        <? include("ililce.php"); ?>
        <div id="content" class="clearfix">
            <div class="container">
                <div class="row">
                    <div id="main" class="span12">
                        <div class="login-register">
                            <?php if (!$core->reg_allowed): ?>
                                <div class="msgInfo"><?= ($dil['uye-alimlari-kisa-bir-sureligine-kapatilmistir']) ?></div>
                            <?php elseif ($core->user_limit != 0 and $core->user_limit == $numusers): ?>
                                <div class="msgInfo"><?= ($dil['izin-verilen-uye-sayisi-asildigi-icin-uye-alimlari-kapatilmistir']) ?></div>
                            <?php else: ?>
                                <div class="row">
                                    <? if ($_GET['UyeTipi'] == 'bireysel') { ?>
                                        <div class="span12 ">
                                            <ul class="tabs nav nav-tabs">
                                                <li class="active"><a href="#login" data-toggle="tab"><i  class="icon-ok-sign"></i> <?= ($dil['bireysel-uyelik']) ?></a></li>
                                                <div id="Paylas" class="pull-left" ></div> 
                                                <div class="pull-right">
                                                    <a href="<? echo $SiteAddress; ?>kurumsal-uye/" class="btn  btn-danger"><i  class="icon-thumbs-up"></i><?= ($dil['kurumsal-uyelik']) ?></a> <?= ($dil['veya']) ?> 
                                                    <a href="<? echo $SiteAddress; ?>giris-yap/" class="btn  btn-info"><i  class="icon-thumbs-up"></i><?= ($dil['giris-yap']) ?></a> 
                                                </div>                      
                                            </ul>
                                            <!-- /.nav -->
                                            <div class="tab-content" style="overflow: visible;">
                                                <div id="msgholder"></div>
                                                <span id="loader" style="display:none"></span>
                                                <form action="" method="post" name="user_form" id="user_form">
                                                    <input name="doRegister" type="hidden" value="1" />
                                                    <input name="firmaadi" type="hidden" value="" />
                                                    <input name="firmayetkilisi" type="hidden" value="" />
                                                    <input name="userType" type="hidden" value="1" />
                                                    <input name="membership_id" type="hidden" value="<?php echo GetName("select * from memberships WHERE defaults='1'", "id"); ?>" />
                                                    <input name="trial_used" type="hidden" value="<?= (GetName("select * from memberships where defaults='1'", "trial")) ?>" />
                                                    <div class="row-fluid">
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label" for="user_email">
                                                                    <?= ($dil['kullanici-adi']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <span id="getusername">
                                                                        <input name="username" type="text" class="inputbox"  id="username" size="45" placeholder="<?= ($dil['kullanici-adi']) ?>"  autofocus="true" required tabindex="1" />
                                                                        <span id="yes" style="display:none" class="text-success"><?= ($dil['kullanici-adi-uygun']) ?></span>
                                                                        <span id="no" style="display:none" class="text-error"><?= ($dil['kullanici-adi-kullanimda']) ?></span>
                                                                        <img  src="assets/img/tick.png" alt="" id="yes" style="display:none"  title="<?= ($dil['kullanici-adi-uygun']) ?>" />
                                                                        <img src="assets/img/tick.png" alt="" id="no" style="display:none"  title="<?= ($dil['kullanici-adi-kullanimda']) ?>" /> </span>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="user_email">
                                                                    <?= ($dil['eposta-adresiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="email" type="text" class="inputbox"  value="<?php echo post('email'); ?>" size="45" tabindex="2" required placeholder="info@firmaadi.com"  />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="password">
                                                                    <?= ($dil['sifreniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="pass" type="password" class="inputbox"  size="45" placeholder="*********" tabindex="2" required /></div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="cpassword">
                                                                    <?= ($dil['sifre-tekrar']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="pass2" type="password" class="inputbox"  size="45" placeholder="**********" tabindex="3" required />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <!-- /.control-group -->
                                                            <!-- /.form-actions -->
                                                        </div>
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label" for="ad">
                                                                    <?= ($dil['adiniz']) ?> 
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="fname" type="text" class="inputbox" size="45" value="<?php echo post('fname'); ?>" tabindex="4"  placeholder="adınızı yazın" required />                                            </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="soyad">
                                                                    <?= ($dil['soyadiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="lname" type="text" class="inputbox" size="45" value="<?php echo post('lname'); ?>" tabindex="5" placeholder="soyadınızı yazın" required />                                            </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label">
                                                                    <?= ($dil['lokasyon']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls ">
                                                                    <select id="il" name="il" class="row-fluid">
                                                                        <option value="" ><?= ($dil['il']) ?> <?= ($dil['seciniz']) ?></option>
                                                                    </select>

                                                                    <select name="ilce" id="ilce" class=row-fluid>
                                                                        <option value=""><?= ($dil['ilce']) ?> <?= ($dil['seciniz']) ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="adres">
                                                                    <?= ($dil['adresiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <textarea  id="adres"  name="adres" type="text" style="height:90px;" tabindex="11" placeholder="<?= ($dil['uye-adres-not']) ?>"></textarea>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <!-- /.form-actions -->
                                                        </div>
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label" for="telefon">
                                                                    <?= ($dil['telefon']) ?>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="telefon" type="text"   id="telefon" value="<?php echo post('telefon'); ?>" tabindex="12"  class="input-medium " placeholder="532 xxx xx xx" required>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="faks">
                                                                    <?= ($dil['fax']) ?>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="faks" type="text"   id="faks" value="<?php echo post('faks'); ?>" tabindex="13" class="input-medium "  placeholder="532 xxx xx xx" />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="gsm">
                                                                    <?= ($dil['gsm']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="gsm" type="text"   id="gsm" value="<?php echo post('gsm'); ?>" tabindex="14" class="input-medium"  placeholder="532 xxx xx xx" required />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <div style="width: 100%; height: 100px; overflow-x: hidden;  overflow-y: scroll;"><?= (html_entity_decode($dil['sozlesme'])) ?></div>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label >
                                                                    <input type="checkbox" value="1" name="sozlesme" id="sozlesme" tabindex="16" required />
                                                                    <?= ($dil['kullanici-sozlesme-onay']) ?>
                                                                </label>
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group clearfix">
                                                                <div class="controls span8">
                                                                    <input name="captcha" type="text" size="10" maxlength="2" class="inputbox" required placeholder="<?= ($dil['yandaki-islemin-sonucu']) ?>" />
                                                                </div>
                                                                <div class="controls span4" style="margin-top:10px;">
                                                                    <span><img src="image.php?str=10-1=?&uzunluk=80" alt="<?= ($k) ?>" /></span>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <button class=" btn-large btn-block btn-success " type="submit"><i  class="icon-thumbs-up"></i> <?= ($dil['bilgilerimi-onayliyorum']) ?> </button>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <!-- /.form-actions -->
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.tab-pane -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                    <? } ?>
                                    <? if ($_GET['UyeTipi'] == 'kurumsal') { ?>
                                        <div class="span12 ">
                                            <ul class="tabs nav nav-tabs">
                                                <li class="active"><a href="#login" data-toggle="tab"><i  class="icon-ok-sign"></i> <?= ($dil['kurumsal-uyelik']) ?></a></li>
                                                <div id="Paylas" class="pull-left" ></div> 
                                                <div class="pull-right">

                                                    <a href="<? echo $SiteAddress; ?>bireysel-uye/" class="btn  btn-danger"><i  class="icon-thumbs-up"></i><?= ($dil['bireysel-uyelik']) ?></a> <?= ($dil['veya']) ?> 
                                                    <a href="<? echo $SiteAddress; ?>giris-yap/" class="btn  btn-info"><i  class="icon-thumbs-up"></i><?= ($dil['giris-yap']) ?></a> 
                                                </div>                      
                                            </ul>
                                            <!-- /.nav -->
                                            <div class="tab-content" style="overflow: visible;">
                                                <div id="msgholder"></div>
                                                <span id="loader" style="display:none"></span>
                                                <form action="" method="post" name="user_form" id="user_form">
                                                    <input name="doRegister" type="hidden" value="1" />
                                                    <input name="membership_id" type="hidden" value="<?php echo GetName("select * from memberships WHERE defaults='1'", "id"); ?>" />
                                                    <input name="trial_used" type="hidden" value="<?= (GetName("select * from memberships where defaults='1'", "trial")) ?>" />
                                                    <div class="row-fluid">
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label" for="user_email">
                                                                    <?= ($dil['kullanici-adi']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <span id="getusername">
                                                                        <input name="username" type="text" class="inputbox"  id="username" size="45" placeholder="kullanıcı adı" />
                                                                        <span id="yes" style="display:none" class="text-success"><?= ($dil['kullanici-adi-uygun']) ?></span>
                                                                        <span id="no" style="display:none" class="text-error"><?= ($dil['kullanici-adi-kullanimda']) ?></span>
                                                                        <img  src="assets/img/tick.png" alt="" id="yes" style="display:none"  title="<?= ($dil['kullanici-adi-uygun']) ?>" />
                                                                        <img src="assets/img/tick.png" alt="" id="no" style="display:none"  title="<?= ($dil['kullanici-adi-kullanimda']) ?>" /> </span>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="user_email">
                                                                    <?= ($dil['eposta-adresiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>

                                                                <div class="controls">
                                                                    <input name="email" type="text" class="inputbox"  value="<?php echo post('email'); ?>" size="45" tabindex="2" required placeholder="info@firmaadi.com"  />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="password">
                                                                    <?= ($dil['sifreniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="pass" type="password" class="inputbox"  size="45" placeholder="*********" tabindex="2" required /></div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="cpassword">
                                                                    <?= ($dil['sifre-tekrar']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="pass2" type="password" class="inputbox"  size="45" placeholder="**********" tabindex="3" required />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="ad">
                                                                    <?= ($dil['adiniz']) ?> 
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="fname" type="text" class="inputbox" size="45" value="<?php echo post('fname'); ?>" tabindex="4"  placeholder="adınızı yazın" required />                                            </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="soyad">
                                                                    <?= ($dil['soyadiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="lname" type="text" class="inputbox" size="45" value="<?php echo post('lname'); ?>" tabindex="5" placeholder="soyadınızı yazın" required />                                            </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                        </div>
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label">
                                                                    <?= ($dil['faaliyet-alani']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="btn-group" >
                                                                    <label class="checkbox inline badge">
                                                                        &nbsp;<input type="radio"  name="userType" value="2"  checked="checked"   required="true" />
                                                                        <?= ($dil['emlak-ofisi']) ?></label>
                                                                    <label class="checkbox inline badge ">
                                                                        &nbsp;<input type="radio" name="userType" value="3"    required="true" />
                                                                        <?= ($dil['insaat-firmasi']) ?></label>
                                                                    <label class="checkbox inline badge ">
                                                                        &nbsp;<input type="radio" name="userType" value="4"   required="true" />
                                                                        <?= ($dil['muteahhit']) ?></label>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="firmaadi">
                                                                    <?= ($dil['firma-adi']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>

                                                                <div class="controls">
                                                                    <input name="firmaadi" type="text"  id="firmaadi"  maxlength="200" value="<?php echo post('firmaadi'); ?>" tabindex="7"  placeholder="Örn: Ata Emlak Gayrimenkul"required/>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="firmayetkilisi">
                                                                    <?= ($dil['firma-yetkilisi']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>

                                                                <div class="controls">
                                                                    <input name="firmayetkilisi" type="text" id="firmayetkilisi"  maxlength="20" value="<?php echo post('firmayetkilisi'); ?>" placeholder="Örn: Mustafa Kemal"  tabindex="8"required/>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label">
                                                                    <?= ($dil['lokasyon']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls ">
                                                                    <select id="il" name="il" class="row-fluid">
                                                                        <option value="" ><?= ($dil['il']) ?> <?= ($dil['seciniz']) ?></option>
                                                                    </select>

                                                                    <select name="ilce" id="ilce" class=row-fluid>
                                                                        <option value="0"><?= ($dil['ilce']) ?> <?= ($dil['seciniz']) ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="adres">
                                                                    <?= ($dil['adresiniz']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>

                                                                <textarea  id="adres"  name="adres" type="text" style="height:90px;" tabindex="11" placeholder="<?= ($dil['uye-adres-not']) ?>"></textarea>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <!-- /.form-actions -->
                                                        </div>
                                                        <div class="span4 ">
                                                            <div class="control-group">
                                                                <label class="control-label" for="telefon">
                                                                    <?= ($dil['telefon']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="telefon" type="text"   id="telefon" value="<?php post('telefon'); ?>" tabindex="12"  class="input-medium" placeholder="532 xxx xx xx" required>

                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="faks">
                                                                    <?= ($dil['fax']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="faks" type="text"   id="faks" value="<?php echo post('faks'); ?>" tabindex="13" class="input-medium" placeholder="532 xxx xx xx" />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label class="control-label" for="gsm">
                                                                    <?= ($dil['gsm']) ?>
                                                                    <span class="form-required" title="This field is required.">*</span>
                                                                </label>
                                                                <div class="controls">
                                                                    <input name="gsm" type="text"   id="gsm" value="<?php echo post('gsm'); ?>" tabindex="14" class="input-medium"  placeholder="532 xxx xx xx" required />
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <div style="width: 100%; height: 100px; overflow-x: hidden;  overflow-y: scroll;"><?= (html_entity_decode($dil['sozlesme'])) ?></div>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group">
                                                                <label >
                                                                    <input type="checkbox" value="1" name="sozlesme" id="sozlesme" tabindex="16" required />
                                                                    <?= ($dil['kullanici-sozlesme-onay']) ?>
                                                                </label>

                                                            </div>
                                                            <!-- /.control-group -->
                                                            <div class="control-group clearfix">
                                                                <div class="controls span8">
                                                                    <input name="captcha" type="text" size="10" maxlength="2" class="inputbox" required placeholder="<?= ($dil['yandaki-islemin-sonucu']) ?>" />
                                                                </div>
                                                                <div class="controls span4" style="margin-top:10px;">
                                                                    <span><img src="image.php?str=10-1=?&uzunluk=80" alt="<?= ($k) ?>" /></span>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <div class="controls">
                                                                    <button class=" btn-large btn-block btn-success " type="submit"><i  class="icon-thumbs-up"></i> <?= ($dil['bilgilerimi-onayliyorum']) ?> </button>
                                                                </div>
                                                                <!-- /.controls -->
                                                            </div>
                                                            <!-- /.control-group -->
                                                            <!-- /.form-actions -->
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- /.tab-pane -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- /.span4-->
                                    <? } ?>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.login-register -->
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
                                    $("#user_form").submit(function () {
                                        var str = $(this).serialize();
                                        showLoader();
                                        $.ajax({
                                            type: "POST",
                                            url: "ajax/user.php",
                                            data: str,
                                            success: function (msg) {
                                                $("#msgholder").ajaxComplete(function (event, request, settings) {
                                                    if (msg == 'OK') {
                                                        hideLoader();
                                                        result = '<div class="alert alert-success"><?= ($dil['uye-kayit-onay-1']) ?><\/div>';
                                                        $("#fullform").hide();
                                                    } else {
                                                        hideLoader();
                                                        result = msg;
                                                    }
                                                    $('html, body').animate({
                                                        scrollTop: 0
                                                    }, 600);
                                                    $(this).html(result);

                                                });
                                            }
                                        });
                                        return false;
                                    });
                                });
                                // ]]>
                            </script>
                        <?php endif; ?>
                    </div>
                    <!-- /#main -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /#content -->
        <!-- Full Layout /--> 
        <script type="text/javascript">
            // <![CDATA[
            $(document).ready(function () {
                $('#username').keyup(username_check);
            });
            function username_check() {
                var username = $('#username').val();
                if (username == "" || username.length < 4) {
                    $('#yes').hide();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "ajax/user.php",
                        data: 'checkUsername=' + username,
                        cache: false,
                        success: function (response) {
                            if (response == 1) {
                                $('#yes').hide();
                                $('#no').fadeIn();
                            } else {
                                $('#no').hide();
                                $('#yes').fadeIn();
                            }

                        }
                    });
                }
            }
            // ]]>
        </script>           
        <? include("alt-bolum.php"); ?>
        <!--JS Coding Start-->
        <script>

            $('#username').keydown(function (e) {
                if (e.keyCode == 32) {
                    return false;
                }
            });

        </script>
        <!--JS Coding End-->
        <!--[if lt IE 9]>
           <script src="assets/js/html5.js" type="text/javascript"></script>
           <![endif]-->
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type="text/javascript"  src="assets/libraries/BootstrapFormHelpers/js/bootstrap-formhelpers-phone.js"></script>
        <script type='text/javascript' src='assets/js/retina.js'></script>
        <script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>

    </body>
</html>
<?
/* include("assets/lib/cache-end.php"); */?>