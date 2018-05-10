<?php
define("_VALID_PHP", true);
require_once("init.php");

$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();
?>
<?
$ID = $_GET['ID'];
$Action = toGet($_POST['Action'], $_GET['Action']);
$miSend = toGet($_GET['miSend'], $_POST['miSend']);


$sql = "select * from t_advert where ID='" . $ID . "'";
$qrPageInfo = mysql_query($sql);
$rsPageInfo = mysql_fetch_array($qrPageInfo);

$sql = "select * from t_advert_detail where IlanNo='" . $ID . "' and Dil='" . $Lang . "'";
$query = mysql_query($sql);
$multi = mysql_fetch_array($query);


$ip = $_SERVER['REMOTE_ADDR'];
if (IsHave("Select * from t_visitors where PageType='Estate' and EstateID='" . $ID . "' and IP='" . $ip . "'") == 0) {
    mysql_query("insert into t_visitors (PageType, IP, EstateID) values('Estate', '" . $ip . "', '" . $ID . "')");
}
if ($miSend != '') {

    switch ($Action) {

        case 'DusukFiyat' :

            if (!$user->logged_in) {
                redirect_to($SiteAddress . "giris-yap/");
            }



            if (IsHave("Select * from t_add_list where EstateID='" . $ID . "' and tip='DusukFiyat' and CookieID='" . $row['id'] . "'") == 0) {
                $sql = "insert into t_add_list (EstateID, CookieID, ADate,tip,fiyat1) values ('" . $ID . "', '" . $row['id'] . "',
				'" . date("Y-m-d H:i:s") . "','DusukFiyat', '" . $rsPageInfo['RentPrice'] . "')";
                mysql_query($sql);
            }
            $mesaj = $dil['dusuk-fiyat-uyarisi-ok'];
            $uyaristil = "alert-success";

            break;

        case 'Liste' :

            if (!$user->logged_in) {
                redirect_to($SiteAddress . "giris-yap/");
            }



            if (IsHave("Select * from t_add_list where EstateID='" . $ID . "' and tip='Liste' and CookieID='" . $row['id'] . "'") == 0) {
                $sql = "insert into t_add_list (EstateID, CookieID,tip) values ('" . $ID . "', '" . $row['id'] . "', 'Liste')";
                mysql_query($sql);
            }

            $mesaj = $dil['ifavoriilanuyarisi'];
            $uyaristil = "alert-success";

            break;

        case 'HataliIlan':

            if (!$user->logged_in) {
                redirect_to($SiteAddress . "giris-yap/");
            }
            $sql = "insert into t_hatali_ilan (IlanNo, Mesaj) values('" . $_POST['IlanNo'] . "', '" . $_POST['hata'] . "')";
            mysql_query($sql);

            $mesaj = $dil['hatali-ilan-onay'];
            $uyaristil = "alert-success";
            break;

        case 'TavsiyeEt':

            if (!$user->logged_in) {
                redirect_to($SiteAddress . "giris-yap/");
            }
            $row = $core->getRowById("email_templates", 16);
            $sender_email = sanitize($user->name);
            $name = sanitize($_POST['benimadim']);
            $benimeposta = sanitize($_POST['benimeposta']);
            $arkadaseposta = sanitize($_POST['arkadaseposta']);
            $ilanurl = sanitize($_POST['ilanurl']);
            require_once(BASEPATH . "assets/lib/class_mailer.php");
            $mailer = $mail->sendMail();

            $body = str_replace(array('[SENDER]', '[NAME]', '[ILANURL]', '[SITE_NAME]', '[URL]'), array($benimeposta, $name, $ilanurl, $dil['sitename'], $SiteAddress), $row['body']);
            $message = Swift_Message::newInstance()
                    ->setSubject($row['subject'])
                    ->setTo($arkadaseposta)
                    ->setFrom(array($benimeposta => $name))
                    ->setBody(cleanOut($body), 'text/html');
            if ($mailer->send($message)) {

                $mesaj = 'Arkadaşınıza bilgilendirme eposta gönderildi.';
                $uyaristil = "alert-success";
            }
            break;
    } //Action
} //miSend
?>
<?
$sql = "select * from t_advert where ID='" . $ID . "' and Visible='1' and Validate='1' limit 1";
$q = mysql_query($sql);
$rsProperty = mysql_fetch_array($q);
if (@mysql_num_rows($q) == 0) {
    redirect_to($SiteAddress);
}
$iladi = getName("select * from il where   id='" . $rsProperty['il'] . "'", "il_adi");
$ilceadi = getName("select * from ilce where   id='" . $rsProperty['ilce'] . "'", "ilce_adi");
$semtadi = getName("select * from semt where   id='" . $rsProperty['semt'] . "'", "semt_adi");
$mahadi = getName("select * from mahalle where   id='" . $rsProperty['mah'] . "'", "mahalle_adi");
$CategoryName = getName("select * from e_category where ItemID='" . $rsProperty['EstateType'] . "' and Lang='" . $Lang . "' ", "Name");

$sql = "select * from e_criteria_type where Category LIKE '%" . $rsProperty['EstateType'] . "%'  and Lang='$Lang'  ";
$q = mysql_query($sql);
while ($listing = mysql_fetch_array($q)) {
    $Category = explode(',', $listing['Category']);

    foreach ($Category as $InCat) {
        if ($InCat == $rsProperty['EstateType']) {

            if ($listing['Type'] == 'price') {
                $Price = $rsProperty[$listing['SefName']];
                $PriceCurrency = $rsProperty[$listing['SefName'] . '_Cur'];
            }
        }
    }
}


?>
<?
$tgetir = uyebilgi($rsProperty['user_id']);

if ($tgetir['avatar'] == '') {
    $uresim = 'assets/uploads/Uyeler/temp.png';
} else {
    $uresim = 'assets/uploads/Uyeler/' . $tgetir['avatar'];
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
        <link rel="alternate" hreflang="<? echo $Lang ?>" href="<?php echo $SiteAddress ?>" />
        <link rel="canonical" href="<?php echo $urladresi ?>" />
        <base href="<?= (SITEURL) ?>" />    
        
        <meta name="google-site-verification" content="<?= ($GoogleDogrulama) ?>" />
        <meta name="msvalidate.01" content="<?= ($bingdogrulama) ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="<?= ($favicon) ?>" type="image/png"/>
        
        <title><?= ($multi['Baslik']) ?></title>
        <meta name=description content="<? echo yazikes(temizle($multi['Aciklama']), ".", "300"); ?>"/>
        <meta name=keywords content="<?= (str_replace(' ', ",", stripslashes($multi['Baslik']))) ?>"/>
 
        <meta property="fb:app_id" content="1804101559893553" />
        <meta property="og:url" content="<?php echo $urladresi ?>" />
        <meta property="og:type"  content="website" />
        <meta property="og:title"   content="<?= ($multi['Baslik']) ?>" />
        <meta property="og:description" content="<? echo yazikes(temizle($multi['Aciklama']), ".", "200"); ?>" />
        <meta property="og:image" content="<?= (SITEURL) ?>assets/uploads/estate/<?= (getName("select * from t_advert_images where   ParentID='" . $ID . "' and anaresim=1 ", "Images")) ?>" />

        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->    
        <!--Css Coding Start-->
        <link rel='stylesheet' id='font-css' href='https://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin%2Clatin-ext&#038;ver=3.6' type='text/css' media='all'/>

        <link rel='stylesheet' id='bootstrap-css' href='assets/libraries/bootstrap/css/bootstrap.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='bootstrap-responsive-css' href='assets/libraries/bootstrap/css/bootstrap-responsive.min.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='pictopro-normal-css' href='assets/icons/pictopro-normal/pictopro.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='justvector-web-font-css' href='assets/icons/justvector-web-font/stylesheet.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='chosen-css' href='assets/libraries/chosen/chosen.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='aviators-css' href='assets/css/jquery.bxslider.css' type='text/css' media='all'/>
        <link rel='stylesheet' id='properta-css' href='assets/css/<?= ($core->theme) ?>.css' type='text/css' media='all'/>	
        <!--Css Coding End-->
        <!--[if lt IE 9]>
        <script src="assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->
        <!--JS Coding Start-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script type='text/javascript' src='assets/libraries/chosen/chosen.jquery.min.js'></script>
        <script type="text/javascript"> function swapStyleSheet(sheet)
            {
                document.getElementById('properta-css').setAttribute('href', sheet);
            }
        </script>

        <!--JS Coding End-->
        <script type="text/javascript" src="assets/js/jquery.calendar.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/calendar.css" />

        <link href="assets/libraries/gallery/dist/css/lightslider.css" rel="stylesheet">
        <link href="assets/libraries/gallery/dist/css/lightgallery.css" rel="stylesheet">
        <script src="assets/libraries/gallery/dist/js/lightslider.js"></script>
        <script src="assets/libraries/gallery/dist/js/lightgallery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/js/lightgallery-all.min.js"></script> 

        <script>
    $(document).ready(function () {

        var is_mobile = false;
        if ($('.phone-control').css('display') == 'none') {
            is_mobile = true;
        }

        if (is_mobile == true) {

            $('#clspanel').hide().addClass('bottomFixed').css({"left": "0"});
            $("#openpanel").click(function () {
                $('#clspanel').slideDown();
            });
            $("#closepanel").click(function () {
                $('#clspanel').slideUp();
            });
            $('#ozellikler').removeClass('in');

        } else {

            $('#openpanel').hide();
            $('#clspanel').css({'display': 'inline-block'});

        }//is_mobil control


        var $lgl = $('#image-gallery');
        $lgl.lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            thumbItem: 8,
            slideMargin: 0,
            enableDrag: true,
            //speed : 4000,
            pause: 3000,
            freeMove: true,
            currentPagerPosition: 'middle',
            enableThumbDrag: true,
          
            auto: true,
            keyPress: true,
            onSliderLoad: function (el) {
                el.lightGallery({
                    selector: '#image-gallery .lslide',
                    download: false,
                });
            }
        });
    });

        </script>                
    </head>
    <body class="home page page-template">
        <!--Modal Login Page Start-->
        <div class="modal hide fade "  id="odememodal">
            <div class="modal-header">
                <h2>Ödeme Sayfasına Yönlendiriliyorsunuz...</h2> 
                <small class="muted" > Ödeme yapıldıktan sonra rezarvasyon işleminiz onaylanacak ve bilgilendirme epostası alacaksınız.</small>
            </div>

            <div class="modal-body"   >

                <div class=" row-fluid"> 

                    <img  src="assets/img/ajax-loader-big.gif" alt="loader"/>
                    <hr>

                    <img src="assets/img/online-odeme.jpg" alt="online ödeme"/>      
                </div>
            </div>

        </div><!--Modal Login Page End-->

        <? include("ust-bolum.php"); ?>

        <div id="content" class="clearfix">
            <? include("detay.php"); ?>
        </div>
        <!-- /#content -->
     
        <div class="phone-control" ></div>

        <? include("alt-bolum.php"); ?>
        
        <!--İlan Seslendirme-->
        <?php if($core->speech==TRUE){ ?><iframe style="width:0; height:0; padding:0; border:none; margin:0; display: none" src="http://responsivevoice.org/responsivevoice/getvoice.php?t='<?=($multi['Baslik'])?>, , , ,<?=($dil['ilan-ses-son-ek'])?>'&tl=<? echo $Lang ?>-<? echo strtoupper($Lang) ?>"></iframe><?php } ?>
        <!--İlan Seslendirme-->
        
        <link type="text/css" rel="stylesheet" href="assets/libraries/datepicker/css/datepicker.css" />
        <script type='text/javascript' src='assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
        <script type='text/javascript' src='assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang ?>.js'></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= ($core->googleapi) ?>"></script>
        <script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='assets/js/retina.js'></script>
        <script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>
        <script type='text/javascript' src='assets/js/jquery.vticker.js'></script>
        <script type='text/javascript' src='assets/js/properta.js'></script>
        <script type="application/javascript" src="assets/js/jquery.placeholder.js"></script>         
    </body>
</html>
