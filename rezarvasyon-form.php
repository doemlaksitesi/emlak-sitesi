<link type="text/css" rel="stylesheet" href="assets/libraries/datepicker/css/datepicker.css" />
 <script type='text/javascript' src='assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
<script type='text/javascript' src='assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang?>.js'></script>


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
 						$sql = "select * from rezervasyon where ilanid='$ID'";
						  $qrDisplay = mysql_query($sql);
						   while($rzv = mysql_fetch_array($qrDisplay)) {?>
				{
					title  : 'Dolu',					   
					start  : '<?=($rzv['giris'])?>',
					end  : '<?=($rzv['cikis'])?>',					
					allDay: true
				},
				<? } ?>
				
			]
			
		}]
	});
	
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#giris').datepicker({
		language: "tr",
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
		format: "dd-mm-yyyy",
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');
	
	

});

function rezarvasyonUyeol()
{
if (confirm('Rezarvasyon yapmak için üye olmalısınız.')) { $('#EmlakUyeTipi').modal('show');}; void('');	
}

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



</script>


    <div  class="widget enquire hidden-phone">

    <h2><i class=" icon-normal-mail-open"></i> Rezarvasyon Durumu</h2>
	<div id="calendar"></div>
	<br/>
 <span id="loader" style="display:none"></span>
    <div class="content">
    <span id="loader" style="display:none"></span>
    
        <form action="" method="post" id="admin_form" name="admin_form" <? if (!$user->logged_in){ ?>onclick="rezarvasyonUyeol();"<? } ?>>
            <input type="hidden" name="subject" id="subject" value="İlan talep isteği">
            <input type="hidden" name="ilanurl" id="ilanurl" value="<?=($_SERVER['REQUEST_URI'])?>">
			<input type="hidden" name="email" id="email" value="<?=($tgetir['email'])?>">
			<input type="hidden" name="uyeid" id="uyeid" value="<?=($tgetir['id'])?>">
			<input type="hidden" name="ilanid" id="ilanid" value="<?=($ID)?>">    
			
			<div class="control-group">
                <label class="control-label" for="giris">
                   <i class="icon-calendar icon-white"></i> Giriş Tarihi
                    <span class="form-required" title="Bu alan boş geçilemez.">*</span>
                </label>

                <div class="controls">
                   <input name="giris" type="text"   id="giris" placeholder="02-02-2013" value="" class="datepicker" required="true">
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->
			
			<div class="control-group">
                <label class="control-label" for="cikis">
                   <i class="icon-calendar icon-white"></i>  Çıkış Tarihi
                    <span class="form-required" title="Bu alan boş geçilemez.">*</span>
                </label>

                <div class="controls">
                   <input name="cikis" type="text"   id="cikis" placeholder="02-03-2013" value="" class="datepicker"  required="true">
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->
			
			<div class="control-group">
                <label class="control-label" for="first_last_name">
                    <i class=" icon-user icon-white"></i> Kişi
                    <span class="form-required" title="Bu alan boş geçilemez.">*</span>
                </label>

                <div class="controls">
                   <select name="kisi" class="btn-block" style="text-align: left;">
				   	<option value="1">1 Yetişkin</option>
					<option value="2">2 Yetişkin</option>
					<option value="3">3 Yetişkin</option>
					<option value="4">4 Yetişkin</option>
				   </select>
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->
			           
            <div class="control-group">
                <label class="control-label" for="first_last_name">
                    <?=($dil['adiniz'] ." ". $dil['soyadiniz'])?>
                    <span class="form-required" title="Bu alan boş geçilemez.">*</span>
                </label>

                <div class="controls">
                   <input name="name" type="text"   id="name" placeholder="?" value="<?php if ($user->logged_in) echo $user->name;?>" required="true">
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->

            <div class="control-group">
                <label class="control-label" for="Phone">
                     <?=($dil['telefon'])?>
                <span class="form-required" title="This field is required.">*</span>
                </label>

                <div class="controls">
                     <input name="gsm" type="text"   id="gsm" placeholder="?" value="<?php if ($user->logged_in) echo $user->gsm;?>" required="true">
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->

            

           

            
             <div class="control-group">
                <label class="control-label" for="image_text">
                    <strong>Doğrulama 3 + 5 =? </strong>
                    
                </label>

                <div class="controls">
                   <input name="code" type="text"  id="code" maxlength="5" class="input-medium" placeholder="İşlemin sounucunu girin" required="true">
                </div>
                <!-- /.controls -->
            </div><!-- /.control-group -->

            <div class="form-actions">
             
               <input id="submit" name="submit" class="btn btn-primary arrow-right"  value="Rezevasyon Yap" type="submit" />
            </div>
            <!-- /.form-actions -->
			<br/>
        </form>
    </div><!-- /.content -->

</div> 

<div  class=" our-agents">



        <h2><i class=" icon-normal-cap-winner"></i> <?=($dil['ilan-sahibi'])?></h2>

        <div class="content">
           
            <div class="agent  well" style="border:none; padding-bottom:0;">
                <div class="">

<a href="<?=($SiteAddress)?><?=(seflink($dil['emlak-ofisi']))?>/<?=(seflink($tgetir['firmaadi']))?>/uye-<?=($tgetir['id'])?>/" title="<?=($tgetir['fname'])?> <?=($tgetir['lname'])?>">
<img  alt="<?=($tgetir['fname'])?> <?=($tgetir['lname'])?>" src="<?=($uresim)?>"/></a>

                    
                </div>
                <!-- /.image -->

                <div class="name">
               <a class="text-cut" title="<?=($tgetir['fname'])?> <?=($tgetir['lname'])?>" href="<?=($SiteAddress)?><?=(seflink($dil['emlak-ofisi']))?>/<?=(seflink($tgetir['firmaadi']))?>/uye-<?=($tgetir['id'])?>/"><?=($tgetir['firmaadi'])?> <?=($tgetir['fname'])?> <?=($tgetir['lname'])?></a>
                    
                </div>
                <!-- /.name -->

                <div class="phone pull-left">
                    <i class="icon icon-normal-phone"></i>
                   <?=($tgetir['gsm'])?>
                </div>
              
				
				 <div class="phone pull-right">
                    <i class="icon icon-normal-phone"></i>
                   <?=($tgetir['tel'])?>
                </div>
              
<br/>
                
                <div class="">
                    <a href="<?=($SiteAddress)?><?=(seflink($dil['emlak-ofisi']))?>/<?=(seflink($tgetir['firmaadi']))?>/uye-<?=($tgetir['id'])?>/" class="btn btn-block btn-mini"><i class="icon  icon-normal-share"></i> <?=($dil['tum-ilanlarini-goster'])?></a><br />


                </div>
                <!-- /.phone -->
            </div>
            
            <!-- /.agent -->
        </div>
        
        <!-- /.content -->

    </div>

<script type="text/javascript">
// <![CDATA[


  function showLoader() {
	  $("#loader").fadeIn(200);
  }

  function hideLoader() {
	  $("#loader").fadeOut(200);
  };	
  
  $(document).ready(function() {
	  $("#admin_form").submit(function () {
		  var str = $(this).serialize();
		  showLoader();
		  $.ajax({
			  type: "POST",
			  url: "ajax/rezarvasyon.php",
			  data: str,
			  success: function (msg) {
				  $("#msgholder").ajaxComplete(function(event, request, settings) {
				  if(msg  == 1) {
					  hideLoader();
					  result = '<div class="alert alert-success"><span>Teşekkür ederiz.<\/span>Talebiniz ilan sahibine gönderildi,en kısa sürede size geri dönüş yapılacaktır.<\/div>';
					  
					 staticmodal();
					 
					 setTimeout(function() {
						  location.href = 'http://www.paypal.com';
						}, 5000);

					  
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



