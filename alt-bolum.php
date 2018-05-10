<div id="footer-wrapper">
	<div class="text-center footer-long" >
		<img  src="assets/img/markers/family-house.png" width="40" height="40" alt="Emlak" /> <?=($dil['alt-reklam-kusak'])?> 
	</div>
	<div id="footer-top">
		<div id="footer-top-inner" class="container">
			<div class="row">
				<?php
				$sql = "select * from e_pages WHERE  dil='$Lang' and menu='2' and durum='1' order by id";
				$qs  = mysql_query($sql);
				while($pagemenu = mysql_fetch_array($qs)){ ?>							 
					<div class="span3">
						<div id="nav_menu-2" class="widget widget-nav_menu"><h2><?=($pagemenu['baslik'])?></h2>
							<div class="menu-helpful-links-container">
								<ul id="menu-helpful-links" class="menu">
    							
									<?php
									$sql = "select * from e_pages WHERE  dil='$Lang' and anakat='".$pagemenu['eid']."' and  durum=1 order by id";
									$qsub  = mysql_query($sql);
									while($pagesubmenu = mysql_fetch_array($qsub)){ ?>	
							 
										<li class="menu-item">
											<a href="<?=($SiteAddress)?><?=(seflink($pagesubmenu['baslik']))?>/sayfa-<?=($pagesubmenu['id'])?>/">
												<i class="icon-normal-right-arrow-small iconcat"></i>
												<?=($pagesubmenu['baslik'])?>
											</a>
										</li>
										<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>
			</div>

		</div>
		<!-- /#footer-top-inner -->
	</div>
	<!-- /#footer-top -->

	<div class="footer-bottom">
		<div id="footer" class="footer container">
			<div id="footer-inner">
				<div class="row">
					<div class="span6">
						<div id="text-3" class="widget widget-text">
							<div class="textwidget"><?=($dil['telif-yazisi'])?></div>
						</div>
					</div>
					<!-- /.copyright -->

					<div class="span6">
						<div id="nav_menu-3" class="widget widget-nav_menu">
							<div class="menu-footer-links-container">
								<ul id="menu-footer-links" class="menu">
									<li class="menu-item active"><a href="<?=($SiteAddress)?>"><?=($dil['anasayfa'])?></a></li>
									<li class="menu-item active"><a  href="<?=($SiteAddress)?>giris-yap/"><?=($dil['giris-yap'])?></a></li>
									<li class="menu-item active"><a  data-toggle="modal" href="#EmlakUyeTipi"><?=($dil['uye-ol'])?></a></li>
									
									<li class="menu-item"><a href="<?=($SiteAddress)?>iletisim/"><?=($dil['iletisim'])?></a></li>
									<li class="menu-item"><img src="assets/img/visa_mastercard_4.gif" alt="" /></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.span6 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /#footer-inner -->
		</div>
		<!-- /#footer -->
	</div>
</div>
<div style="position: relative; bottom: 0; background-color: #ccccff; text-align: center; font-size: 9px;">Bu site <a href="http://www.egebilnet.net">Egebilnet emlak sitesi</a> ile hazırlanmıştır.</div>

<? if($demomode=='0'){?>
<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '<?=(SITEURL)?>online-destek/index.php/tur/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1/(disable_pro_active)/true?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
	<? }else{ ?>
	<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//www.egebilnet.net/OnlineSupport/index.php/tur/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
	<? } ?>

<?=(mb_convert_encoding($GoogleAnalytics, "UTF-8", "HTML-ENTITIES"))?>

<!--<script>
    $(window).load(function (){
        var nav = $('.navigation');
        $(window).scroll(function (){
            if ($(this).scrollTop() > 80){
                nav.addClass("f-nav");
            } else{
                nav.removeClass("f-nav");
            }
        });
    });
</script>-->