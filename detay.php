<div class="container">
    <div id="msgholder"></div>
    <?php if ($mesaj) { ?>
        <div class="alert <? echo $uyaristil; ?> ">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <? echo $mesaj; ?>
        </div>
    <? } ?>

    <div class="row">


        <div class="sidebar span3">

            <div id="AgencyList" class=" bgcolor3" style=" text-align: center; margin-bottom: 10px">
                <span class="btn   pull-right btn-primary btn-block" style="border-radius: 0; margin: 0;"><i class=" icon-normal-cap-winner"></i> <?= ($dil['ilan-sahibi']) ?></span>

                <div id="danisman-slide" class="row-fluid" >
                    <ul>
                        <li>                           
                            <a  href="<?= ($SiteAddress) ?><?= (seflink($dil['emlak-ofisi'])) ?>/<?= (seflink($tgetir['firmaadi'])) ?>/uye-<?= ($tgetir['id']) ?>/" title="<?= ($tgetir['fname']) ?> <?= ($tgetir['lname']) ?>">
                                <img width="160" alt="<?= ($tgetir['fname']) ?> <?= ($tgetir['lname']) ?>" src="<?= ($uresim) ?>"/></a>
                            <div class="AgencyList-h2" ><h2 style="margin: 0;"><?= ($tgetir['firmaadi']) ?> <?= ($tgetir['fname']) ?> <?= ($tgetir['lname']) ?></h2></div>
                            <div><?= (getName("select * from il where   id='" . $tgetir['il'] . "'", "il_adi")) ?> - <?= (getName("select * from ilce where   id='" . $tgetir['ilce'] . "'", "ilce_adi")) ?></div>
                            <div><i class="icon-normal-phone-circle"></i> <?= ($tgetir['tel']) ?> - <?= ($tgetir['gsm']) ?></div>
                        </li>
                    </ul>                    
                </div>	
                <a class="btn btn-block btn-success" title="<?= ($tgetir['fname']) ?> <?= ($tgetir['lname']) ?>" href="<?= ($SiteAddress) ?><?= (seflink($tgetir['firmaadi'])) ?>-<?= (seflink($tgetir['fname'])) ?>-<?= (seflink($tgetir['lname'])) ?>/uye-<?= ($tgetir['id']) ?>/"><i class="icon-list"></i> <?php echo $dil['bu-kisinin-ilan-portfoyu']?></a>
            </div>
            <script type="text/javascript">
                $(function(){
                $('#danisman-slide').vTicker({
                speed: 500,
                        pause: 3000,
                        animation: 'fade',
                        mousePause: true,
                        showItems: 1
                });
                });
            </script>
            <?php if ($rsProperty['EstateType'] == '524'): ?>
                <span class="btn btn-large btn-block btn-info" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;"><?= ($dil['gecelik']) ?> <i class=" icon-normal-tag"></i> <?= (number_format($Price)) ?> <?= ($PriceCurrency) ?></span>	
                <div  class="widget enquire" >

                    <span id="loader" style="display:none"></span>
                    <div class="content" >
                        <span id="loader" style="display:none"></span>



                        <form action="" method="post" id="admin_formr" name="admin_formr" <? if (!$user->logged_in) { ?>onclick="rezarvasyonUyeol();"<? } ?>>
                            <input type="hidden" name="subject" id="subject" value="<?= ($dil['ilan-talep-istegi']) ?>">
                            <input type="hidden" name="ilanurl" id="ilanurl" value="<? echo $url; ?>">
                            <input type="hidden" name="email" id="email" value="<?= ($tgetir['email']) ?>">
                            <input type="hidden" name="uyeid" id="uyeid" value="<?= ($tgetir['id']) ?>">
                            <input type="hidden" name="ilanid" id="ilanid" value="<?= ($ID) ?>">  


                            <div class="control-group">
                                <label class="control-label" for="giris">
                                    <i class="icon-calendar icon-white"></i> <?= ($dil['giris-tarihi']) ?>
                                    <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                                </label>

                                <div class="controls">
                                    <input name="giris" type="text"   id="giris" placeholder="02-02-2013" value="" class="datepicker" required="true">
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="cikis">
                                    <i class="icon-calendar icon-white"></i>  <?= ($dil['cikis-tarihi']) ?>
                                    <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                                </label>

                                <div class="controls">
                                    <input name="cikis" type="text"   id="cikis" placeholder="02-03-2013" value="" class="datepicker"  required="true">
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="first_last_name">
                                    <i class=" icon-user icon-white"></i> <?= ($dil['kisi']) ?>
                                    <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                                </label>

                                <div class="controls">
                                    <select name="kisi" class="btn-block" style="text-align: left;">
                                        <option value="1">1 <?= ($dil['kisi']) ?></option>
                                        <option value="2">2 <?= ($dil['kisi']) ?></option>
                                        <option value="3">3 <?= ($dil['kisi']) ?></option>
                                        <option value="4">4 <?= ($dil['kisi']) ?></option>
                                    </select>
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="first_last_name">
                                    <?= ($dil['adiniz'] . " " . $dil['soyadiniz']) ?>
                                    <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                                </label>

                                <div class="controls">
                                    <input name="name" type="text"   id="name" placeholder="?" value="<?php if ($user->logged_in) echo $user->name; ?>" required="true">
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="Phone">
                                    <?= ($dil['telefon']) ?>
                                    <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                                </label>

                                <div class="controls">
                                    <input name="gsm" type="text"   id="gsm" placeholder="?" value="<?php if ($user->logged_in) echo $user->gsm; ?>" required="true">
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="image_text">
                                    <strong><?= ($dil['dogrulama']) ?> 3 + 5 =?</strong>

                                </label>

                                <div class="controls">
                                    <input name="code" type="text"  id="code" maxlength="5" class="input-medium" placeholder="<?= ($dil['islemin-sounucunu-girin']) ?>" required="true">
                                </div>
                                <!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="form-actions">

                                <input id="submit" name="submit" class="btn btn-primary arrow-right"  value="<?= ($dil['rezervasyon-yap']) ?>" type="submit" />
                            </div>
                            <!-- /.form-actions -->
                            <br/>
                        </form>
                    </div><!-- /.content -->

                </div>
                <!--rezarvasyonformu-->
                <hr />
                <h2><i class=" icon-normal-mail-open"></i> <?= ($dil['rezarvasyon-durumu']) ?></h2>	
                <div id="calendar"></div>	
                <script type="text/javascript">
                    // <![CDATA[


                    function showLoader() {
                    $("#loader").fadeIn(200);
                    }

                    function hideLoader() {
                    $("#loader").fadeOut(200);
                    };
                    $(document).ready(function() {
                    $("#admin_formr").submit(function () {
                    var str = $(this).serialize();
                    showLoader();
                    $.ajax({
                    type: "POST",
                            url: "ajax/rezarvasyon.php",
                            data: str,
                            success: function (msg) {
                            $("#msgholder").ajaxComplete(function(event, request, settings) {
                            if (msg == 1) {
                            hideLoader();
                            result = '<div class="alert alert-success"><span><?= ($dil['tesekkur-ederiz']) ?><\/span><?= ($dil['talep-onay']) ?><\/div>';
                            /*
                             staticmodal();
                                 
                             setTimeout(function() {
                             location.href = 'http://www.paypal.com';
                             }, 5000);
                             */

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
                <script type="text/javascript">
                    $(document).ready(function() {
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    var h = {};
                    $("#calendar").fullCalendar({

                    header:{
                    title:false
                    },
                            buttons:{
                            title:false,
                                    today:false
                            },
                            eventSources: [{

                            events: [

    <?
    $bugun = date("Y-m-d", time());
    $biryil = date("Y-m-d", strtotime("+1year"));

    $sql = "SELECT * FROM rezervasyon WHERE ilanid='" . $ID . "' and giris BETWEEN '" . $bugun . "' AND '" . $biryil . "' ";
    $qrDisplay = mysql_query($sql);
    while ($rzv = mysql_fetch_array($qrDisplay)) {
        ?>
                                {
                                title  : '<?= ($dil['dolu']) ?>',
                                        start  : '<?= ($rzv['giris']) ?>',
                                        end  : '<?= ($rzv['giris']) ?>',
                                },
    <? } ?>


                            {
                            title: '<?= ($dil['gecmis-gun']) ?>',
                                    start: new Date(y - 10, m, d),
                                    end: new Date(y, m, d - 1),
                                    color: 'gray'
                            },
                            ],
                                    eventClick: function(event) {
                                    if (event.url) {
                                    window.open(event.url);
                                    return false;
                                    }
                                    }

                            }]
                    });
                    /*var ayIsimleri = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
                     var gunIsimleriKisa = ['Paz','Pzt','Sal','Çar','Per','Cum','Cmt'];
                     var gunIsimleri = ['Paz','Pzt','Sal','Çar','Per','Cum','Cmt'];
                         
                     var ilanUrl = 'ilan';
                         
                     $(document).ready(function() {
                         
                     var date = new Date();
                     var d = date.getDate();
                     var m = date.getMonth();
                     var y = date.getFullYear();
                         
                     var calendar = $('#calendar').fullCalendar({
                     header: {
                     left: 'title',
                     center: '',
                     right: 'prev,next'
                     },
                     firstDay:1,
                     dayNames: gunIsimleri,
                     dayNamesShort: gunIsimleriKisa,
                     monthNames: ayIsimleri,
                     events: [
                     {
                     title: 'DOLU',
                     start: '2013-12-31',
                     end: '2013-12-31',
                     color: 'red'
                     },
                     {
                     title: 'GEÇMİŞ TARİH',
                     start: new Date(y-10, m, d),
                     end: new Date(y, m, d-1),
                     color: 'gray'
                     }
                     ]
                     });
                         
                     });*/

                    var nowTemp = new Date();
                    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
                    var checkin = $('#giris').datepicker({
                    language: "tr",
                            weekStart: 1,
                            format: "dd-mm-yyyy",
                            onRender: function(date) {
                            return date.valueOf() < now.valueOf() ? 'disabled' : '';
                            }
                    }).on('changeDate', function(ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                            newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                    }
                    checkin.hide();
                    $('#cikis')[0].focus();
                    }).data('datepicker');
                    var checkout = $('#cikis').datepicker({
                    language: "tr",
                            weekStart: 1,
                            format: "dd-mm-yyyy", onRender: function(date) {
                            return date.valueOf() < now.valueOf() ? 'disabled' : '';
                            }
                    }).on('changeDate', function(ev) {
                    checkout.hide();
                    }).data('datepicker');
                    });
                    function staticmodal(){
                    $("#odememodal").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#odememodal a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#odememodal").modal('hide'); // dismiss the dialog
                    });
                    });
                    $("#odememodal").on("hide", function() { // remove the event listeners when the dialog is dismissed
                    $("#odememodal a.btn").off("click");
                    });
                    $("#odememodal").on("hidden", function() { // remove the actual elements from the DOM when fully hidden
                    $("#odememodal").remove();
                    });
                    $("#odememodal").modal({ // wire up the actual modal functionality and show the dialog
                    "backdrop" : "static",
                            "keyboard" : true,
                            "show" : true // ensure the modal is shown immediately
                    });
                    }


                    function rezarvasyonUyeol()
                    {
                    $('#EmlakUyeTipi').modal('show');
                    }


                </script>			
            <?php endif; ?>
            <div class="accordion" style="padding: 0; margin: 0">
                <div class="accordion-group">
                    <div class="accordion-heading" style="padding: 0; margin: 0">
                        <a class="accordion-toggle btn btn-warning" data-toggle="collapse"  href="#enquireproperties_widget-2">
                            <i class=" icon-normal-mail-open"></i> <?= ($dil['ilan-sahibine-mesaj-gonderin']) ?>
                        </a>
                    </div>


                    <div id="enquireproperties_widget-2" class="widget enquire  accordion-body collapse" >
                        <div class="content bgcolor1">
                            <span id="loader" style="display:none"></span>

                            <form action="" method="post" id="admin_form" name="admin_form">
                                <input type="hidden" name="subject" id="subject" value="İlan talep isteği">
                                <input type="hidden" name="ilanurl" id="ilanurl" value="<?= ($_SERVER['REQUEST_URI']) ?>">
                                <input type="hidden" name="gidecekmail" id="gidecekmail" value="<?= ($tgetir['email']) ?>">             
                                <div class="control-group">
                                    <label class="control-label" for="first_last_name">
                                        <?= ($dil['adiniz'] . " " . $dil['soyadiniz']) ?>
                                        <span class="form-required" title="Bu alan boş geçilemez.">*</span>
                                    </label>

                                    <div class="controls">
                                        <input name="name" type="text"   id="name" placeholder="?" value="<?php if ($user->logged_in) echo $user->name; ?>" required="true">
                                    </div>
                                    <!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="Phone">
                                        <?= ($dil['telefon']) ?>
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>

                                    <div class="controls">
                                        <input name="gsm" type="text"   id="gsm" placeholder="?" value="<?php if ($user->logged_in) echo $user->gsm; ?>" required="true">
                                    </div>
                                    <!-- /.controls -->
                                </div><!-- /.control-group -->



                                <div class="control-group">
                                    <label class="control-label" for="Email">
                                        <?= ($dil['eposta']) ?>
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>

                                    <div class="controls">
                                        <input name="email" type="text"  id="email" placeholder="?" value="<?php if ($user->logged_in) echo $user->email; ?>" required="true">
                                    </div>
                                    <!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="InfoMessages">
                                        <?= ($dil['mesajiniz']) ?>
                                        <span class="form-required" title="This field is required.">*</span>
                                    </label>

                                    <div class="controls">
                                        <textarea name="message" cols="55" rows="4"   id="message" required="true"><?= ($ID) ?> <?= ($dil['nolu-ilan-hakkinda-daha-fazla-bilgi-istiyorum']) ?></textarea>
                                    </div>
                                    <!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="control-group">
                                    <label class="control-label" for="image_text">
                                        <strong><?= ($dil['dogrulama']) ?> 3 + 5 =?</strong>

                                    </label>

                                    <div class="controls">
                                        <input name="code" type="text"  id="code" maxlength="5" class="input-medium" placeholder="<?= ($dil['islemin-sounucunu-girin']) ?>" required="true">
                                    </div>
                                    <!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="form-actions">

                                    <input id="submit" name="submit" class="btn btn-primary arrow-right" value="<?= ($dil['gonder']) ?>" type="submit" />
                                </div>
                                <!-- /.form-actions -->
                                <br/>
                            </form>
                        </div><!-- /.content -->

                    </div> 
                </div>

            </div>


            <script type="text/javascript">
                // <![CDATA[
                function showLoader()
                {
                $("#loader").fadeIn(200);
                }

                function hideLoader()
                {
                $("#loader").fadeOut(200);
                };
                $(document).ready(function()
                {
                $("#admin_form").submit(function ()
                {
                var str = $(this).serialize();
                showLoader();
                $.ajax(
                {
                type: "POST",
                        url: "ajax/sendmail.php",
                        data: str,
                        success: function (msg)
                        {
                        $("#msgholder").ajaxComplete(function(event, request, settings)
                        {
                        if (msg == 1)
                        {
                        hideLoader();
                        result = '<div class="alert alert-success"><span><?= ($dil['tesekkur-ederiz']) ?><\/span><?= ($dil['talep-onay']) ?><\/div>';
                        $("#fullform").hide();
                        } else
                        {
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
            <script type=text/javascript src=assets/js/mortgage.js></script>
            <script>
                $(document).ready(function(){
                $("#mortgage").submit();
                });
            </script>

            <a href="javascript:;" id="openpanel" class="btn btn-danger btn-block bottomFixed" style="left:0"><?= ($dil['kredi-hesaplama']) ?></a>


            <div  id="clspanel" style="z-index: 2000; background-color: #fff" >
                <div id="closepanel"  class="btn  btn-block btn-primary" style="border-radius:0; margin-top: 10px;"><i class="icon-normal-currency-euro"></i><i class="icon-normal-currency-dollar"></i> <?= ($dil['kredi-hesaplama']) ?></div>
                <form id="mortgage" name="mortgage"  onsubmit="mortgageCalc(this);
            return false;">

                    <div class="input-prepend row-fluid">
                        <span class="add-on "><?= ($dil['kredi-miktari']) ?> <sup>(TL)</sup></span>
                        <input name="LA" id="LA" onkeyup="keyPress();" class="span6"  type="text" value="200000">
                    </div>

                    <div class="input-prepend row-fluid">
                        <span class="add-on "><?= ($dil['kredi-vade']) ?> <sup>(<?= ($dil['kredi-vade-ay']) ?>)</sup></span>
                        <input name="YR" onkeyup="keyPress();" class="span6"  type="text" value="120">
                    </div>

                    <div class="input-prepend row-fluid">
                        <span class="add-on "><?= ($dil['kredi-faiz-orani']) ?> <sup>(%)</sup></span>
                        <input name="IR" onkeyup="keyPress();" class="span6"  type="text" value="1.18">
                    </div>

                    <div class="input-prepend row-fluid">
                        <span class="add-on "><?= ($dil['kredi-aylik-odeme']) ?> <sup>(TL)</sup></span>
                        <input name="MT" class="span6"  type="text" readonly="true" >
                    </div>

                    <div class="input-prepend row-fluid">
                        <span class="add-on "><?= ($dil['kredi-tutari']) ?> <sup>(TL)</sup></span>
                        <input name="MP" class="span6"  type="text"  readonly="true">
                    </div>

                    <!-- <div class="input-prepend row-fluid">
                       <span class="add-on span6">Toplam Ödeme <sup>(TL)</sup></span>
                       <input name="TT" class="span6"  type="text"  readonly="true">
                     </div>-->
                </form>
            </div>
            <hr />
            <? echo reklam('7'); ?>
        </div>
        <!-- /#sidebar -->

        <div id="main" class="span9 single-property">
            <h1 class="page-header fl"><?= ($multi['Baslik']) ?></h1>
            <div  style="margin-top: 20px; text-align: center;"><? echo reklam('8'); ?></div>
            <div class="property-detail">
                <div class="row">
                    <div class="span6">
                        <ul class=" nav nav-tabs" style="margin-top:0; margin-bottom: 0;">
                            <li class="active" style="padding-bottom:0;">
                                <a id="tabmap" href="#resim" data-toggle="tab">
                                    <i class="icon icon-normal-image"></i>&nbsp; <?= ($dil['ilan-resimleri']) ?>
                                </a></li>
                            <? if ($rsProperty['xcoor']) { ?>
                                <li style="padding-bottom:0;">
                                    <a href="#harita" data-toggle="tab">
                                        <i class="icon-map-marker"></i>&nbsp;<?= ($dil['harita']) ?></a>
                                </li>
                            <? } ?>
                        </ul>
                        <!-- /.nav -->
                        <div class="tab-content" style="padding: 4px;">
                            <div class="tab-pane active" id="resim" >
                                <?php
                                if(getName("select * from t_advert_images  where  ParentID='" . $ID . "'", "Images")==""){ ?>                                   
                                    <img src="assets/uploads/estate/temp-buyuk.jpg"  alt="<?= ($multi['Baslik']) ?>" />                                     
                                <? } ?> 
                                <ul id="image-gallery">
                                    <?php
                                    $img = getName("select * from t_advert_images  where  ParentID='" . $ID . "'", "Images");
                                    $sql = "select * from t_advert_images where ParentID='" . $ID . "' and Visible='1' order by Seq asc";
                                    $qrImage = mysql_query($sql);
                                    while ($rsImage = mysql_fetch_array($qrImage)) {
                                        $img = $rsImage['Images'];
                                        
                                        
                                        if ($rsImage['Images']== '') {
                                           $img = 'temp-buyuk.jpg';
                                        } else {
                                            $img = $rsImage['Images'];
                                        }
                           
                                        ?>
                                        <li  style="text-align: center; vertical-align: central;" data-thumb="assets/uploads/estate/thmb/<?= ($img) ?>" data-src="assets/uploads/estate/<?= ($img) ?>" >
                                            <img  src="assets/uploads/estate/<?= ($img) ?>" alt="<?= ($multi['Baslik']) ?>"  />
                                        </li>
                                    <? } ?> 
                                </ul>
                            </div>
                            <!-- /detay .tab-pane -->
                            <div class="tab-pane " id="harita">
                                <div id="map_canvas" style="width:100%; height:400px;"></div>
                            </div>
                            <!-- /harita .tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                        <hr>

                        <div class="accordion" style="margin-bottom: 0">
                            <div class="accordion-group">
                                <div class="accordion-heading" style="margin-bottom: 0;">
                                    <a class="accordion-toggle btn" data-toggle="collapse" style="padding: 0"  href="#acikalama">
                                        <h2><?= ($dil['ilan-aciklamasi']) ?></h2>
                                    </a>
                                </div>
                                <div id="acikalama" class="accordion-body collapse in"  >
                                    <div class="accordion-inner well well-small" >
                                        <?= (html_entity_decode($multi['Aciklama'])) ?>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!--İlan açıklama son-->

                        <div class="accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading" style="margin-bottom: 0;">
                                    <a class="accordion-toggle btn btn-mini" data-toggle="collapse" style="padding: 0"  href="#ozellikler">
                                        <h2><?= ($dil['ilan-ozellikleri']) ?></h2>
                                    </a>
                                </div>
                                <div id="ozellikler" class="accordion-body collapse in" >
                                    <div class="accordion-inner well well-small" >
                                        <!-- Emlak Özellikleri Listesi Başlangıç-->
                                        <?php
                                        $sql = " select * from e_criteria_type where Category LIKE '%" . $rsProperty['EstateType'] . "%'  and Lang='" . $Lang . "' and visible='1' order by Seq asc   ";
                                        $q = mysql_query($sql);
                                        while ($sorgu = mysql_fetch_array($q)) {
                                            ?>
                                            <?
                                            $kats = explode(",", $sorgu['Category']);
                                            foreach ($kats as $InCat) {

                                                if ($InCat == $rsProperty['EstateType']) {

                                                    if ($rsProperty[$sorgu['SefName']]) {
                                                        ?><? if ($sorgu['Type'] == 'checkbox') {
                                                            ?>
                                                            <ul class="detail-lists">
                                                                <h4><?= ($sorgu['Name']) ?></h4>
                                                                <?
                                                                $sql = "select * from e_criteria_details where CriteriaItemID='" . $sorgu['ItemID'] . "' and Lang='" . $Lang . "' and Visible=1 order by Seq";
                                                                ?>
                                                                <?= (getCheckListGlobalImage($sql, $sorgu['SefName'], $rsProperty[$sorgu['SefName']])) ?>                                       
                                                            </ul>

                                                        <? } ?>
                                                    <? } ?>
                                                <? } ?>
                                            <? } ?>							
                                        <? } ?>							
                                        <!-- Emlak Özellikleri Listesi Bitiş-->
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- Emlak Özellikleri Listesi Son-->
                    </div>

                    <div class="overview">
                        <div class=" overview">
                            <div class="row">
                                <div class="span3">
                                    <h2><?= ($dil['ilan-bilgileri']) ?> 
                                        <span class="badge badge-info pull-right">ID: #<?= ($rsProperty['ID']) ?></span></h2>
                                    <p>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th colspan="2">
                                                    <span class="contract-type  pull-right " style="background-color:#F66">
                                                        <i class=" icon-normal-tag"></i><?= (number_format($Price)) ?> <?= ($PriceCurrency) ?>
                                                    </span>

                                                    <small class="text-info"><?= ($dil['eklenme-tarihi-']) ?> <? echo date("d-m-Y", strtotime($rsProperty['ADate'])); ?></small><br>
                                                    <small class=" text-success"><?= ($dil['guncellenme-tarihi']) ?> <? echo date("d-m-Y", strtotime($rsProperty['GDate'])); ?></small>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><?= ($dil['bolge']) ?>:</th>
                                                <td ><?= ($iladi . " / " . $ilceadi) ?> / <?= ($semtadi) ?> <?= ($mahadi) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tipi:</th>
                                                <td ><?= ($CategoryName) ?></td>
                                            </tr>
                                            <!-- Emlak Özellikleri Listesi Başlangıç-->                       
                                            <?
                                            $hidden = ($user->is_Admin() ? "" : " and Hidden!='1'" );
                                            $private = "<span style=\"font-size: 8px; position:absolute;\" class=\"label label-important\">" . $dil['gizli'] . "</span>";

                                            $sql = " select * from e_criteria_type where Category LIKE '%" . $rsProperty['EstateType'] . "%'  and Lang='" . $Lang . "'  $hidden and visible='1'  order by seq asc  ";
                                            $q = mysql_query($sql);
                                            while ($sorgu = mysql_fetch_array($q)) {

                                                $k = explode(',', $sorgu['Category']);
                                                foreach ($k as $x) {
                                                    if ($x == $rsProperty['EstateType']) {

                                                        if ($rsProperty[$sorgu['SefName']]) {
                                                            ?>               
                                                            <? if ($sorgu['Type'] == 'selectbox' || $sorgu['Type'] == 'textbox' || $sorgu['Type'] == 'date') { ?>                       
                                                                <tr>
                                                                    <th>

                                                                        <?= ($sorgu['Name']) ?> <?= ($sorgu['Hidden'] == '1' ? $private : "") ?> :
                                                                    </th>

                                                                    <td>
                                                                        <? if ($sorgu['Type'] == 'selectbox') { ?> <?= (getName("select * from e_criteria_details  where  ItemID='" . $rsProperty[$sorgu['SefName']] . "' and Lang='" . $Lang . "'", "Name")) ?> <? } ?>				
                                                                        <? if ($sorgu['Type'] == 'textbox') { ?>
                                                                            <?= ($rsProperty[$sorgu['SefName']]) ?>
                                                                        <? } ?>
                                                                        <? if ($sorgu['Type'] == 'date') { ?>
                                                                            <?= (date("d-m-Y", strtotime($rsProperty[$sorgu['SefName']]))) ?>
                                                                        <? } ?> 

                                                                    </td>
                                                                </tr>
                                                            <? } ?>
                                                        <? } ?>  
                                                    <? } ?>  
                                                <? } ?>
                                            <? } ?>
                                            <!-- Emlak Özellikleri Listesi Bitiş-->
                                        </tbody>
                                    </table>
                                    </p> 
                                    <form method="post" action="<?= ($_SERVER['REQUEST_URI'] ) ?>" style="margin: 5px 0 5px 0;">
                                        <input name="image_text" type="hidden" value="<?php echo GetKey(); ?>">
                                        <input type="hidden" name="Action" id="Action" value="DusukFiyat">
                                        <input type="hidden" name="miSend"  value="1">
                                        <button type="submit" class="btn  btn-block btn-warning">
                                            <i class="icon   icon-tag"></i> <?= ($dil['fiyati-dusunce-haber-ver']) ?></button>
                                    </form>
                                    <form method="post" action="<?= ($_SERVER['REQUEST_URI'] ) ?>" style="margin-bottom: 5px;">
                                        <input name="image_text" type="hidden" value="<?php echo GetKey(); ?>">
                                        <input type="hidden" name="Action" id="Action" value="Liste">
                                        <input type="hidden" name="miSend"  value="1">
                                        <button type="submit" class="btn  btn-block btn-info">
                                            <i class="icon   icon-tag"></i> <?= ($dil['favorilere-ekle']) ?></button>
                                    </form>
                                    <div class="row-fluid">
                                        <!-- Button to trigger modal -->
                                        <a href="#TavsiyeEt" data-toggle="modal" class="btn btn-mini  btn-link" >
                                            <i class="icon  icon-eye-open"></i> <?= ($dil['arkadasima-gonder']) ?></a>
                                        <!--Modal Login Page Start-->

                                        <a href="#HataliIlan" data-toggle="modal" class="btn btn-mini  btn-link pull-right">
                                            <i class="icon  icon-question-sign"></i> <?= ($dil['hatali-ilan-bildir']) ?></a>
                                    </div>
                                    <div class="well well-small text-center">
                                        <span class="badge badge-warning"><?= ($demomode == '1' ? '11253' : CountRow("select count(*) as count_row from t_visitors where EstateID='" . $ID . "'")) ?></span> <?= ($dil['kisi-inceledi']) ?></div>
                                    <div class="well well-small text-center">
                                       <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad4bce38c7f20a4"></script> 
                                    </div>

                                </div>
                                <!-- /.span2 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.overview -->  
                    </div>                          
                </div>
            </div>
            <div  style="margin-top: 20px; text-align: center;"><? echo reklam('9'); ?></div>
        </div>
    </div>
    <!-- /#main -->
</div>
<!-- /.row -->
</div>
<!-- /.container -->
<script type="text/javascript">

    function initialize()
    {

    var latlng = new google.maps.LatLng(<?= ($rsProperty['xcoor']) ?>, <?= ($rsProperty['ycoor']) ?>), // Stockholm

            mapOptions =
    {
    scrollwheel: false,
            zoom: 18,
            center: latlng
    },
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions),
            styledMapType = new google.maps.StyledMapType("", {name: "Edited"}),
            marker = new google.maps.Marker(
            {
            position: latlng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title:"<?= ($tgetir['firmaadi']) ?>"
            }),
            infowindow = new google.maps.InfoWindow(
            {
            content: "<div><a href='<?= ($SiteAddress) ?><?= (seflink($dil['emlak-ofisi'])) ?>/<?= (seflink($tgetir['firmaadi'])) ?>/uye-<?= ($tgetir['id']) ?>/' title='<?= ($tgetir['firmaadi']) ?>'><img  class='img-rounded' alt='<?= ($tgetir['ad']) ?> <?= ($tgetir['soyad']) ?>' src='<?= ($uresim) ?>'/></a></div>"
            });
    map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
    function toggleBounce ()
    {
    if (marker.getAnimation() != null)
    {
    marker.setAnimation(null);
    } else
    {
    marker.setAnimation(google.maps.Animation.BOUNCE);
    }
    }
    // Add click listener to toggle bounce
    google.maps.event.addListener(marker, 'click', function ()
    {
    toggleBounce();
    infowindow.open(map, marker);
    setTimeout(toggleBounce, 1500);
    });
    setTimeout(toggleBounce, 1500);
    }

    // Call initialize -- in prod, add this to window.onload or some other DOM ready alternative
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e)
    {
    initialize();
    })


</script>
<div class="modal hide fade" style="width:350px; " id="HataliIlan">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <i class="icon-remove"></i></button>
        <h2 style="margin-bottom:0;"><?= ($dil['hatali-ilan-bildirimi']) ?></h2>
        <small class="muted" ><?= ($dil['hatali-ilan-1']) ?></small>
    </div>

    <div class="modal-body"   style="overflow:visible;">
        <div class=" row-fluid"> 
            <div class="tab-content " >
                <div class="tab-pane active" >
                    <form method="post" name="HataliIlan" id="HataliIlan" action="<?= ($_SERVER['REQUEST_URI'] ) ?>" class="form-vertical">
                        <input type="hidden" name="Action" id="Action" value="HataliIlan">
                        <input type="hidden" name="miSend" id="Misend" value="1">
                        <div class="control-group">
                            <label>Görüşünüz</label>
                            <div class="controls">
                                <input type="radio" name="hata" required value="Gayrimenkul Satılmış/Kiralanmış" />&nbsp;<?= ($dil['gayrimenkul-satilmis-kiralanmis']) ?>
                            </div>
                            <hr />
                            <div class="controls">
                                <input type="radio" name="hata" required value="Gayrimenkul Bilgisi Hatalı" />&nbsp;<?= ($dil['gayrimenkul-bilgisi-hatali']) ?>
                            </div>
                            <hr />
                            <div class="controls">
                                <input type="radio" name="hata" required value="Hatalı Fiyat" />&nbsp;<?= ($dil['hatali-fiyat']) ?>
                            </div>
                            <hr />
                            <div class="controls">
                                <input type="radio" name="hata" required value="Hatalı Fotoğraf" />&nbsp;<?= ($dil['hatali-fotograf']) ?>
                            </div>
                            <hr />
                            <div class="controls">
                                <input type="radio" name="hata" required value="Hatalı Telefon" />&nbsp;<?= ($dil['hatali-telefon']) ?>
                            </div>
                            <hr />
                            <div class="controls">
                                <input type="radio" name="hata" required value="İlan Sahibinden Değil Emlak Ofisinden" />&nbsp;<?= ($dil['ilan-sahibinden-degil-emlak-ofisinden']) ?>
                            </div>
                        </div>


                        <div class="control-group clearfix">
                            <div class="controls span8">
                                <input name="image_text" type="text" class="span8"   id="image_text" placeholder="<?= ($dil['guvenlik-kodu']) ?>" required> 
                            </div>
                            <div class="controls span4" style="margin-top:10px;">
                                <img src="image.php?str=<?php echo GetKey(); ?>&uzunluk=70" >
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">

                                <button type="submit" class="btn btn-block btn-success"><?= ($dil['gonder']) ?></button>

                            </div>
                        </div>	

                    </form>	   
                </div>

            </div>
        </div>
    </div>


</div>
<!--Modal Login Page End-->
<div class="modal hide " style="width:430px; " id="TavsiyeEt">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <i class="icon-remove"></i></button>
        <h2 style="margin-bottom:0;"><?= ($dil['arkadasima-gonder']) ?></h2>
        <small class="muted" ><?= ($dil['bu-ilan-arkadasinizin-ihtiyaclarina-uygun-olabilir']) ?></small>
    </div>

    <div class="modal-body"   style="overflow:visible;">

        <div class=" row-fluid"> 
            <div class="tab-content " >
                <div class="tab-pane active" >
                    <form method="post" action="<?= ($_SERVER['REQUEST_URI'] ) ?>" class="form-vertical">
                        <input type="hidden" name="Action" id="Action" value="TavsiyeEt">
                        <input type="hidden" name="miSend" id="miSend" value="1">
                        <input type="hidden" name="ilanurl" id="ilanurl" value="<? echo $url; ?>">

                        <div class="control-group">
                            <div class="controls">
                                <input name="benimadim" type="text"   id="benimadim" placeholder="<?= ($dil['adiniz']) ?> <?= ($dil['soyadiniz']) ?>" value="<?php if ($user->logged_in) echo $user->name; ?>" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input name="benimeposta" type="email"   id="benimeposta" placeholder="<?= ($dil['eposta-adresiniz']) ?>" value="<?php if ($user->logged_in) echo $user->email; ?>" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <input name="arkadaseposta" type="email"   id="arkadaseposta" placeholder="<?= ($dil['arkadasinizin-eposta-adresi']) ?>" required>
                            </div>
                        </div>


                        <div class="control-group clearfix">
                            <div class="controls span8">
                                <input name="image_text" type="text" class="span8"   id="image_text" placeholder="<?= ($dil['guvenlik-kodu']) ?>" required> 
                            </div>
                            <div class="controls span4" style="margin-top:10px;">
                                <img src="image.php?str=<?php echo GetKey(); ?>&uzunluk=70" >
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">

                                <button type="submit" class="btn btn-block btn-success"><?= ($dil['gonder']) ?></button>

                            </div>
                        </div>	

                    </form>	   
                </div>

            </div>
        </div>
    </div>


</div><!--Modal Login Page End-->

