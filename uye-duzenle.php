<?php
session_start();
define("_VALID_PHP", true);
require_once("init.php");
if (!$user->logged_in)
    redirect_to($SiteAddress . "index.html");
$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();
$_GET['il'] = $row['il'];
$_GET['ilce'] = $row['ilce'];
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
        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>  
        <!--Css Coding End-->	
        <!--JS Coding Start-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/global.js"></script>
        <!--JS Coding End-->
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
                                        <li ><a href="<?= ($SiteAddress) ?>ilan-ekle/" ><?= ($dil['ilan-ekle']) ?></a></li>
                                        <li ><a href="<?= ($SiteAddress) ?>ilanlarim/" ><?= ($dil['ilan-listesi']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'DusukFiyat' ? "active" : "") ?>" ><a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=DusukFiyat" ><?= ($dil['takipteki-ilanlar']) ?></a></li>
                                        <li class="<?= ($_GET['Tip'] == 'Liste' ? "active" : "") ?>" ><a href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=Liste" ><?= ($dil['favori-ilanlarim']) ?></a></li>
                                        <li class="active"><a href="<?= ($SiteAddress) ?>uye-guncelle/"><?= ($dil['bilgilerimi-guncelle']) ?></a></li>
                                        <span id="loader" class="pull-right" style="display:none"></span>
                                    </ul>
                                    <!-- /.nav -->

                                    <div class="tab-content">
                                        <div id="msgholder"></div>

                                        <div class="tab-pane active ">
                                            <?php if ($row['userlevel'] !== 9) : ?>
                                                <div class=" row-fluid">
                                                    <table class="utility">
                                                        <tr>
                                                            <td><strong><?= ($dil['uyelik-hizmet-sonlanma-suresi']) ?></strong> <?php echo Gun($row['mem_expire']); ?> <?= ($dil['gun']) ?></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php if ($row['membership_id'] == 0) : ?>
                                                            <tr>
                                                                <td>Hizmet Paketi Yok</td>
                                                                <td>--/--</td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td style="color:#09F" class="border"><strong> <?php echo $mrow['title']; ?> <?= ($dil['uyelik-paketini-kullaniyorsunuz']) ?>  </strong></td>
                                                                <td style="color:#09F" class="border"><strong> <?= ($dil['bitis-tarihi']) ?> : <?php echo $mrow['expiry']; ?></strong></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </table>
                                                    <div id="show-result"></div> 
                                                </div>
                                                <div class="row-fluid">
                                                    <?php if ($row['membership_id'] == 0) : ?>
                                                        <?php foreach ($listpackrow as $prow): ?>
                                                            <div class="span3">
                                                                <div class="pricing boxed">
                                                                    <div class="column promoted">

                                                                        <h2><?php echo $prow['title']; ?></h2>

                                                                        <div class="content">
                                                                            <div class="price">
                                                                                <h3><?php echo $core->formatMoney($prow['price']); ?></h3>

                                                                                <h4><?php echo $prow['days'] . ' ' . $member->getPeriod($prow['period']); ?></h4>
                                                                            </div>
                                                                            <ul>
                                                                                <li>İlan Sayısı : <?php echo ($prow['adcount'] == 0) ? 'Sınırsız' : $prow['adcount']; ?></li>
                                                                                <li><?php echo $prow['description']; ?></li>

                                                                            </ul>

                                                                            <?php if ($prow['price'] == 0): ?>
                                                                                <a href="javascript:void(0)" class="btn  btn-success add-cart"  id="item_<?php echo $prow['id'] . ':FREE'; ?>"> <span class="icon-ok-sign" ></span><?= ($dil['aktive-et']) ?> </a>
                                                                            <?php else: ?>
                                                                                <?php if ($gatelist): ?>
                                                                                    <?php foreach ($gatelist as $grow): ?>
                                                                                        <?php if ($grow['active']): ?>
                                                                                            <a href="javascript:void(0);" class="add-cart" id="item_<?php echo $prow['id'] . ':' . $grow['id']; ?>"> <img src="<?php echo SITEURL . '/gateways/' . $grow['dir'] . '/' . $grow['displayname'] . '.png'; ?>" alt=""  title="<?php echo $grow['displayname']; ?>"/> </a>
                                                                                        <?php endif; ?>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <!-- /.content -->
                                                                    </div>
                                                                    <!-- /.column -->
                                                                </div>
                                                                <!-- /.pricing --></div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <!-- /.tab-content -->
                                                <hr>
                                            </div>
                                        <?php endif; ?>                       
                                        <form action="" method="post" id="admin_form" name="admin_form" enctype="multipart/form-data">
                                            <input name="userType" type="hidden" value="1" />
                                            <input name="userlevel" type="hidden" value="<?php echo $row['userlevel']; ?>" />
                                            <div class="row-fluid">
                                                <div class="span4 ">
                                                    <?php echo ($row['avatar']) ? '<img src="' . UPLOADURL . $row['avatar'] . '" alt=""/>' : '<img src="' . UPLOADURL . 'default.png" alt=""/>'; ?> 

                                                    <?php echo ($row['avatar']) ? '<span><input type="checkbox" value="1" name="logoRemove" /> ' . $dil['sil'] . '</span>' : '<input name="avatar" type="file" size="40" class="fileinput mask" />'; ?>                                   

                                                    <div class="control-group">
                                                        <label class="control-label" for="user_email">
                                                            <?= ($dil['kullanici-adi']) ?>
                                                            <span class="form-required" title="This field is required.">*</span>
                                                        </label>

                                                        <div class="controls">
                                                            <input name="username" type="text" class="inputbox"  id="username" size="45" placeholder="<?php echo $row['username']; ?>"  autofocus="true" required tabindex="1" value="<?php echo $row['username']; ?>"  readonly="readonly"/>
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
                                                            <input name="email" type="text" class="inputbox"  value="<?php echo $row['email']; ?>" size="45" tabindex="2" required readonly />
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
                                                            <input name="password" type="password"  class="inputbox" size="45" placeholder="************" /></div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->

                                                    <div class="control-group">
                                                        <label class="control-label" for="ad">
                                                            <?= ($dil['adiniz']) ?> 
                                                            <span class="form-required" title="This field is required.">*</span>
                                                        </label>

                                                        <div class="controls">
                                                            <input name="fname" type="text" class="inputbox" size="45" value="<?php echo $row['fname']; ?>" tabindex="4"  placeholder="adınızı yazın" required />                                            </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->
                                                    <div class="control-group">
                                                        <label class="control-label" for="soyad">
                                                            <?= ($dil['soyadiniz']) ?>
                                                            <span class="form-required" title="This field is required.">*</span>
                                                        </label>

                                                        <div class="controls">
                                                            <input name="lname" type="text" class="inputbox" size="45" value="<?php echo $row['lname']; ?>" tabindex="5" placeholder="soyadınızı yazın" required />                                            </div>
                                                        <!-- /.controls -->
                                                    </div>

                                                </div>
                                                <div class="span4 ">
                                                    <?php if ($row['userType'] !== '1') { ?>
                                                        <div class="control-group">
                                                            <label class="control-label">
                                                                <?= ($dil['faaliyet-alani']) ?>
                                                                <span class="form-required" title="This field is required.">*</span>
                                                            </label>
                                                            <div class="btn-group" >
                                                                <label class="checkbox inline badge">
                                                                    &nbsp;<input type="radio"  name="userType" value="2"  <?php getChecked($row['userType'], 2); ?>   required="true" />
                                                                    <?= ($dil['emlak-ofisi']) ?></label>
                                                                <label class="checkbox inline badge ">
                                                                    &nbsp;<input type="radio" name="userType" value="3" <?php getChecked($row['userType'], 3); ?>   required="true" />
                                                                    <?= ($dil['insaat-firmasi']) ?></label>
                                                                <label class="checkbox inline badge ">
                                                                    &nbsp;<input type="radio" name="userType" value="4" <?php getChecked($row['userType'], 4); ?>  required="true" />
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
                                                                <input name="firmaadi" type="text"  id="firmaadi"  maxlength="200" value="<?php echo $row['firmaadi']; ?>" tabindex="7"  placeholder="Örn: Ata Emlak Gayrimenkul"required/>
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
                                                                <input name="firmayetkilisi" type="text" id="firmayetkilisi"  maxlength="20" value="<?php echo $row['firmayetkili']; ?>" placeholder="Örn: Mustafa Kemal"  tabindex="8"required/>
                                                            </div>
                                                            <!-- /.controls -->
                                                        </div>
                                                        <!-- /.control-group -->	
                                                    <?php } ?>
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

                                                        <textarea  id="adres"  name="adres" type="text" style="height:90px;" tabindex="11"><?php echo $row['adres']; ?></textarea>
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
                                                            <input name="telefon" type="text"   id="telefon" value="<?php echo $row['tel']; ?>" tabindex="12" required class="input-medium" placeholder="532 xxx xx xx">
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
                                                            <input name="faks" type="text"   id="faks" value="<?php echo $row['fax']; ?>" tabindex="13" class="input-medium" placeholder="532 xxx xx xx" required/>
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
                                                            <input name="gsm" type="text"   id="gsm" value="<?php echo $row['gsm']; ?>" tabindex="14" class="input-medium"  placeholder="532 xxx xx xx" required />
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->
                                                    <div class="control-group">
                                                        <label class="control-label" for="gsm">
                                                            <?= ($dil['gelismelerden-haberim-olsun']) ?>
                                                            <span class="form-required" title="This field is required.">*</span>
                                                        </label>
                                                        <div class="controls">
                                                            <div class="btn-group" >
                                                                <label class="checkbox inline badge">
                                                                    &nbsp;<input name="newsletter" type="radio" id="newsletter-1" value="1" <?php getChecked($row['newsletter'], 1); ?>/>
                                                                    Evet</label>
                                                                <label class="checkbox inline badge ">
                                                                    &nbsp;<input name="newsletter" type="radio" id="newsletter-2" value="0" <?php getChecked($row['newsletter'], 0); ?> />
                                                                    Hayır</label>
                                                            </div>
                                                        </div>
                                                        <!-- /.controls -->
                                                    </div>
                                                    <!-- /.control-group -->
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
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <hr />
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
        <?php echo $core->doForm("processUser", "ajax/controller.php"); ?>   
        <script type="text/javascript">
            // <![CDATA[
            $(document).ready(function () {
                $("a.add-cart").live("click", function () {
                    $.ajax({
                        type: "POST",
                        url: "ajax/controller.php",
                        data: 'addtocart=' + $(this).attr('id').replace('item_', ''),
                        success: function (msg) {
                            $("#show-result").html(msg);

                        }
                    });
                    return false;
                });
            });

            // ]]>
        </script>        
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
