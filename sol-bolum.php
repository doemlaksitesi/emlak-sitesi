<?php include_once("ililce.php"); ?>
<div class="sidebar span3" style="padding-top: 0px;">
    <?php if ($membersearch == 1) { ?>

        <!--üye arama motoru-->
        <div class="row-fluid" >
            <a  class="btn span12   btn-inverse" style="border-radius:0;"><i class="icon-normal-profile-tick"></i> <?= ($dil['uye-arama-formu']) ?></a>
        </div> 

        <div  class="widget enquire " >
            <div class="content bgcolor2">

                <form method="get" name="aramamotoru" id="aramamotoru action=<?= ($Lang) ?>/uye-ara/">
                    <div class="control-group ">            
                        <input name="firmaadi" type="text"  id="firmaadi" placeholder="<?= ($dil['firma-adi-ile-arama']) ?>" >                  					</div>

                    <div class="control-group ">
                        <label class="control-label" for="il">
                            <i class=icon-hand-right></i> <?= ($dil['il']) ?>
                            <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                        </label>
                        <div class="controls">
                            <select id="il" name="il" class="row-fluid">
                                <option value="" ><?= ($dil['il']) ?> <?= ($dil['seciniz']) ?></option>
                            </select>
                        </div>
                        <!-- /.controls -->
                    </div>
                    <!-- /.control-group -->
                    <div class="control-group  ">
                        <label for=ilce><i class=icon-hand-right></i> <?= ($dil['ilce']) ?><span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span></label>
                        <div class="controls">
                            <select name="ilce" id="ilce" class=row-fluid>
                                <option value="0"><?= ($dil['ilce']) ?> <?= ($dil['seciniz']) ?></option>
                            </select>
                        </div>
                        <!-- /.controls -->
                    </div>
                    <!-- /.control-group -->          


                    <div class="control-group">
                        <div class="controls">
                            <label for=kimden>

                                <label for=e><input type=radio name=UyeTip id=e value=2 <?php getChecked($UyeTip, 2); ?> />
                                    <i class="icon-normal-profile-tick iconsize18 iconblack"></i><? echo $dil['emlak-ofisi']; ?></label>

                                <label for=i><input type=radio name=UyeTip id=i value=3 <?php getChecked($UyeTip, 3); ?> /> 
                                    <i class="icon-normal-group-three iconsize18 iconblack"></i><? echo $dil['insaat-firmasi']; ?></label>
                                <label for=m><input type=radio name=UyeTip id=m value=4  <?php getChecked($UyeTip, 4); ?>/>
                                    <i class="icon-normal-profile-rays iconsize18 iconblack"></i><? echo $dil['muteahhit']; ?></label>

                        </div>

                    </div>
                    <!-- /.control-group -->          

                    <div class="form-actions">
                        <button onclick="madeSelection(document.getElementById('il'), '<?= ($dil['il']) ?> <?= ($dil['seciniz']) ?>')" class="btn btn-primary arrow-right " type="submit"><i class="icon-search icon-white"></i> <?= ($dil['aramayi-baslat']) ?></button>
                        <input onclick="formTemizle(this.form)" type="button" value="<?= ($dil['formu-temizle']) ?>" />
                    </div>
                    <!-- /.form-actions -->
                </form>
            </div>
        </div>
        <!--üye arama motoru son-->

    <? } else { ?>
        <!--arama motoru-->

        <div  class="widget enquire"  >
            <div class="content" style=" margin-bottom:10px;">
                <script type="text/javascript">

                    function criteria(str) {

                        $("#sonuc").html('<div id=resim><center><img src="assets/img/emlak-detay.png"></center></div>');
                        $.ajax({
                            type: 'POST',
                            url: 'ajax/category_criteria.php?Lang=<?= ($Lang) ?>&loadForm=1&Cat=' + str,
                            data: $('#aramamotoru').serialize(),
                            success: function (cevap) {

                                $("#sonuc").html(cevap);
                                //Multiple select 
                                $('.multiple').SumoSelect({placeholder: '<?= ($dil['seciniz']) ?>', okCancelInMulti: false, captionFormat: '{0} Kriter Seçili', });
                                //Only number select
                                $('.onlynumber').number(true, null);
                                $('.tooltips').tooltip();
    //window.location.hash      = $('#aramamotoru').serialize()


                            }//success

                        })//ajax

                    }//criteria function

                    //Search form remove empty input 
                    $(document).ready(function () {
                        $('.remove-empty').submit(function () {
                            $(this).find(':input').filter(function () {
                                return !this.value;
                            }).attr('disabled', 'disabled');
                            return true; // make sure that the form is still submitted
                        });
                        //criteria(<? if ($Category == '') {
        echo $Category = 3;
    } else {
        echo $Category;
    } ?>);
                        //Multiple select 
                        $('.multiple').SumoSelect({placeholder: '<?= ($dil['seciniz']) ?>', okCancelInMulti: false, captionFormat: '{0} Kriter Seçili', });
                        //Only number select
                        $('.onlynumber').number(true, null);
                        $('.tooltips').tooltip();

                    });

                </script>
                <div>


                    <form action="<?= ($Lang) ?>/search" method="get" class="remove-empty">

                        <div class="row-fluid">
                            <div class="control-group  span8">									
                                <div class="controls">
                                    <input  name="ilanno" required="true"  type="text" placeholder="<?php echo $dil['ilan-no-placeholder']; ?>">
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->
                            <div class="control-group  span4">									
                                <div class="controls">
                                    <button class="btn btn-mini btn-primary" style="margin-top: 5px; padding: 0" type="submit"><?php echo $dil['aramayi-baslat']; ?></button></div>
                            </div>
                            <!-- /.controls -->
                        </div>
                        <!-- /.control-group -->

                    </form>		



                    <form method="get" name="aramamotoru" enctype="multipart/form-data"  class="remove-empty" id="aramamotoru" action="<?= ($Lang) ?>/arama/" />

                    <div class="control-group  ">
                        <div class="kategorisec">
                            <label for=EstateType><i class=icon-hand-right></i> <?= ($dil['emlak-kategorisi']) ?><span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span></label>
                            <div class="controls tooltips" title="<?= ($dil['emlak-kategorisi']) ?>" data-placement="right"><?= (GetSelectListGlobal("Cat", "row-fluid  ", "", "", "select * from e_category where  Lang='" . $Lang . "' and Visible='1' order by Seq asc", "ItemID", "Name", "" . $Category . "", "onchange=\"criteria(this.value)\"")) ?>
                            </div>
                            <!-- /.controls -->
                        </div>
                    </div>
                    <!-- /.control-group -->


                    <div class="row-fluid tooltips"  title="Lokasyon seçim alanı" data-placement="right">

                        <div class="control-group span6">
                            <label class="control-label" for="il">
                                <i class=icon-hand-right></i> <?= ($dil['il']) ?>
                                <span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span>
                            </label>
                            <div class="controls">
                                <select id="il" name="il" class="row-fluid">
                                    <option value="" ><?= ($dil['il']) ?> <?= ($dil['seciniz']) ?></option>
                                </select>
                            </div>
                            <!-- /.controls -->
                        </div>
                        <!-- /.control-group -->
                        <div class="control-group  span6">
                            <label for=ilce><i class=icon-hand-right></i> <?= ($dil['ilce']) ?><span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span></label>
                            <div class="controls">
                                <select name="ilce" id="ilce" class=row-fluid>
                                    <option value="0"><?= ($dil['ilce']) ?> <?= ($dil['seciniz']) ?></option>
                                </select>
                            </div>
                            <!-- /.controls -->
                        </div>
                        <!-- /.control-group -->
                        <div class="row-fluid">
                            <div class="control-group  span6">
                                <label for=semt><i class=icon-hand-right></i> <?= ($dil['semt']) ?><span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span></label>
                                <div class="controls">
                                    <select name="semt" id="semt" class="row-fluid">
                                        <option value="0"><?= ($dil['semt']) ?> <?= ($dil['seciniz']) ?></option>
                                    </select>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->
                            <div class="control-group  span6">
                                <label for=mahalle><i class=icon-hand-right></i> <?= ($dil['mahalle']) ?><span class="form-required" title="<?= ($dil['bu-alan-bos-gecilemez']) ?>">*</span></label>
                                <div class="controls">
                                    <select name="mahalle" id="mahalle" class=row-fluid>
                                        <option value="0"><?= ($dil['mahalle']) ?> <?= ($dil['seciniz']) ?></option>
                                    </select>
                                </div>
                                <!-- /.controls -->
                            </div>
                            <!-- /.control-group -->
                        </div>
                    </div>


                    <div id="sonuc" ><?php include("ajax/category_criteria.php"); ?></div>

                    <div class="form-actions" ">
                        <button class="btn-block btn-primary  " type="submit"><i class="icon-search icon-white"></i> <?= ($dil['aramayi-baslat']) ?></button>
                    </div>
                    <!-- /.form-actions -->

                    <input type="hidden" name="order" value="<?= ($_SESSION['order']) ?>" >

                    </form>
                </div>



            </div>

        </div>
        <!--arama motoru son-->
<? } ?>

    <div class="visible-desktop row-fluid"> <? echo reklam('2'); ?></div>

    <hr />
    <div class="visible-desktop row-fluid"> <? echo reklam('3'); ?></div>
    
    <div id="mostrecentproperties_widget-2" class="widget properties visible-desktop">

		<h2><i class=icon-globe></i> <?=($dil['haberler'])?></h2>

		<div id="haber-slide" class="leftslide">
			<ul class="nav nav-tabs nav-stacked ">
				<? $sql = "select * from haberler WHERE  dil='$Lang' and anakat!=1  and anasayfa=1 order by id limit 10  ";
				$qs  = mysql_query($sql);
				while($haberlist = mysql_fetch_array($qs)){
                          	
					?>
					<li><a href="<?=($SiteAddress)?><?=(seflink($haberlist['baslik']))?>/haberler-<?=($haberlist['id'])?>/"><?=($haberlist['baslik'])?></a></li>
					<?} ?>        
			</ul>      
		</div>
		<!-- /.content -->

	</div> 
	<script type="text/javascript">
		$(function(){
				$('#haber-slide').vTicker({ 
						speed: 500,
						pause: 3000,
						animation: 'fade',
						mousePause: true,
						showItems: 7
					});
			});
	</script>
        

    <div class="visible-desktop">
        <div  class="btn  btn-block btn-primary" style="border-radius:0; margin-top: 20px;"><i class="icon-normal-currency-euro"></i><i class="icon-normal-currency-dollar"></i> <?= ($dil['doviz-kurlari']) ?></div>
        <ul class="nav nav-tabs nav-stacked">    
            <?php
            foreach ($Doviz as $val => $value) {
                echo '<li class="active"><a><b>' . $val . '</b> = ' . $dil['doviz-alis'] . ': <span class="text-info">' . $value['Buying'] . '</span> - ' . $dil['doviz-satis'] . ': <span class="text-warning">' . $value['Selling'] . '</span></a></li>';
            }
            ?>
        </ul>

    </div>
    
    
    <script type=text/javascript src=assets/js/mortgage.js></script>	
    <script>
                $(document).ready(function () {
                    $("#mortgage").submit();
                });
    </script>
    

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
    <div class="visible-desktop">
        <?php echo social_link('fbpage'); ?>
    </div>


</div>
