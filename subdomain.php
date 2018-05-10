
<?php 
define("_VALID_PHP", true);
require_once("init.php");

	  
$row = $user->getUserData();
$mrow = $user->getUserMembership();
$gatelist = $member->getGateways(true);
$listpackrow = $member->getMembershipListFrontEnd();

$SiteAddressSub = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$SiteAddressSub=strtok($SiteAddressSub,'?');
									
$_SESSION['order'] = $_GET['order'];
?>
<?php

$sayfaUrl = toGet($_GET['sayfa'], $_POST['sayfa']);


$querystring = "";

foreach($_GET as $val => $value) {

if (!is_array($value)){
	
	if ($val != "sayfa" && $val != "id") $querystring .= "$val=".$value."&amp;";
}	

  foreach($value as $key){
  	if ($val != "sayfa" && $val!==$value) $querystring .= $val."[]=".$key."&amp;";	
  	
  }
}

$uye = uyebilgiSubdomain($_GET['subdomain']);
if($uye['avatar']== ''){
	$uyeresim = 'assets/uploads/Uyeler/default.png';
}else{
	$uyeresim = 'assets/uploads/Uyeler/'.$uye['avatar'];
}
$ilv = 48;	
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang=tr>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang=tr>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="<? echo $Lang?>">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
                <link rel="alternate" hreflang=""<? echo $Lang?>" href="<?php echo $SiteAddress?>" />
                <link rel="canonical" href="<?php echo $urladresi?>" />
		<base href="<?=(SITEURL)?>" />
		<!--START SEO TOOLS START-->
		<meta name=google-site-verification content=<?=($GoogleDogrulama)?> />
		<meta name=msvalidate.01 content=<?=($bingdogrulama)?> />
		<meta name=viewport content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="<?=($favicon)?>" type="image/png"/>
		<title><?=($uye['fname'])?> <?=($uye['lname'])?> <?=($uye['firmaadi'])?></title>
		<meta name="description" content="<?=($uye['fname'])?> <?=($uye['lname'])?> <?=($uye['firmaadi'])?>">
		<meta name="keywords" content="<?=($uye['fname'])?>,<?=($uye['lname'])?>">
		<link rel=image_src href=<?=($core->site_logo)?> />
		<!--START SEO TOOLS END-->
		<!--[if lt IE 9]>
		<script src="assets/js/html5.js" type="text/javascript"></script>
		<![endif]-->
    
		<!--CSS START-->
		<link rel=stylesheet id=revolution-fullwidth href=<?=(SITEURL)?>assets/libraries/rs-plugin/css/fullwidth.css type=text/css media='all'/>
		<link rel=stylesheet id=revolution-settings href=<?=(SITEURL)?>assets/libraries/rs-plugin/css/settings.css type=text/css media='all'/>
		<link rel="stylesheet" id="bootstrap-css" href="<?=(SITEURL)?>assets/libraries/bootstrap/css/bootstrap.min.css" type="text/css" media="all"/>
		<link rel=stylesheet id=bootstrap-responsive-css href=<?=(SITEURL)?>assets/libraries/bootstrap/css/bootstrap-responsive.min.css type=text/css media='all'/>
		<link rel=stylesheet id=pictopro-normal-css href=<?=(SITEURL)?>assets/icons/pictopro-normal/pictopro.css type=text/css media='all'/>
		<link rel=stylesheet id=properta-css href=<?=(SITEURL)?>assets/css/<?=($core->theme)?>.css type=text/css media='all'/>
		<link rel='stylesheet' id='aviators-css' href='<?=(SITEURL)?>assets/css/jquery.bxslider.css' type='text/css' media='all'/>
		
		<link type="text/css" rel="stylesheet" href="<?=(SITEURL)?>assets/libraries/datepicker/css/datepicker.css" />
		<link href="<?=(SITEURL)?>assets/css/sumoselect.css" rel="stylesheet" />

		<!--[if lt IE 9]>
		<script src=assets/js/html5.js type=text/javascript></script>
		<![endif]-->
		<!--JAVASCRIPT START-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		
		<!--<script type=text/javascript src=assets/js/jquery/jquery-1.8.3.js></script>-->
		
		<!--JS Coding End-->        
	</head>

	<body class="home page page-template" >
		<? include("ust-bolum.php");?>

		<div id="content" class="clearfix">

			<div class="container">
				<div class="row">
					<? include("sol-bolum.php");?>
					<!-- /#sidebar -->



      

					<div id="main" class="span9 birdokuz animated fadeInRight">
						<div id="Paylas" class="pull-right" ></div>

						<h1 class="page-header"><?=($uye['firmaadi'])?> - <?=($uye['fname'])?> <?=($uye['lname'])?></h1>

						<div class="agent">
							<div class="row">
								<div class="image span1">
									<img src="<?=($uyeresim)?>" class="thumbnail-image" alt="<?=($uye['firmaadi'])?> - <?=($uye['fname'])?> <?=($uye['lname'])?>" >
								</div><!-- /.image -->

      

       
								<div class="span8">
									<div class="info">
										<div class="box">
											<div class="phone">
												<i class="icon icon-normal-mobile-phone"></i>
												<?=($uye['gsm'])?>
											</div><!-- /.phone -->
											<div class="office">
												<i class="icon icon-normal-phone"></i>
												<?=($uye['tel'])?>
											</div><!-- /.office -->
              
											<div class="office">
												<i class="icon icon-flag"></i>
												<?=($uye['adres'])?>                     
												<?=(getName("select * from ilce where   id='".$uye['ilce']."'","ilce_adi"))?> - 
												<?=(getName("select * from il where   id='".$uye['il']."'","il_adi"))?>
											</div><!-- /.office -->

                
										</div><!-- /.box -->
									</div><!-- /.info -->
									<hr/>
								
								</div><!-- /.span7 -->
   
							</div><!-- /.row -->
						</div><!-- /.agent -->

						<hr>

						<h2 class="page-header"><?=($dil['bu-kisinin-ilan-portfoyu'])?></h2>

						<div class=properties-grid>
						
							<div class=row-fluid>
							
							<div class="btn-group">

											<?
											if($demomode=='0'){
												$userlisting = "and user_id='".$uye['id']."'";
											}
											//Filtre
											if($_GET['Cat']){
												$filtre= " and EstateType='".$_GET['Cat']."'"; 
											} 		
		
		
											$sql1 = "select * from e_category where Lang='".$Lang."' and Visible='1' order by Seq asc ";
											$queryList1 = mysql_query($sql1);
											while($rsListx = mysql_fetch_array($queryList1)){
												if($rsListx['ItemID']==$_GET['Cat']){
													$secili='btn-info';
												}else{
													$secili='';
												}
												?>
          
												<a class="btn <?=(fullurl())?>" href="<?=($SiteAddressSub)?>?Cat=<? echo $rsListx['ItemID'];?>">
													<i class=" badge badge-info">
														<?=($_GET['Tip']=='DusukFiyat'?"active":"")?>
		
														<?=(CountRow("select count(*) as count_row from t_advert where EstateType='".$rsListx['ItemID']."' $userlisting "))?></i><br /><? echo $rsListx['Name'];?></a>
    
												<?} ?>
										</div> 
								<div class="pull-right" >
									<label class="pull-left" style="padding-top: 3px;">Sırala :</label>&nbsp; 
									<select class="pull-right btn"  name="order" id="order" onchange="top.location.href = '<?=(fullurl())?>?order='+ this.options[ this.selectedIndex ].value;">				  
										<option value="">Sırala</option>
										<option value="1" <?=($_SESSION['order']=='1' ? "selected='selected'" : "")?>>Fiyat Artan</option>
										<option value="2" <?=($_SESSION['order']=='2' ? "selected='selected'" : "")?>>Fiyat Azalan</option>
										<option value="3" <?=($_SESSION['order']=='3' ? "selected='selected'" : "")?>>Eklenme Tarihi (Yeni)</option>
										<option value="4" <?=($_SESSION['order']=='4' ? "selected='selected'" : "")?>>Eklenme Tarihine (Eski)</option></select>
								</div>
							</div>
           
							<div class=row-fluid>
                   
					    
								<?
								
								
								
                     
								
								
								if(empty($_SESSION["order"])){
									$OrderBy = '4'; 
								}else{
									$OrderBy = $_SESSION["order"];	
								}
								switch($OrderBy){
											
									case 1:
									$order = "ORDER BY fiyat asc limit";
									break;
										  
									case 2:
									$order = "ORDER BY fiyat desc limit";
									break;
										  
									case 3:
									$order = "ORDER BY ADate asc limit";
									break;
										  
									case 4:
									$order = "ORDER BY ADate desc limit";
									break;
										  
								}
								
								
								//Pagination - Sayfalama
								$sayfax = 20 ;
								$sql = "select  * FROM  t_advert where    Visible='1' and Validate='1' and user_id='".$uye['id']."' $filtre  ";
								$q = mysql_query($sql);
								$toplamilan = mysql_num_rows($q); 
								$toplam_sayfa = ceil($toplamilan / $sayfax);
								$sayfa = isset($sayfaUrl) ? (int) $sayfaUrl : 1;
								$sayfa_goster = 8; 
								$en_az_orta = ceil($sayfa_goster/2);
								$en_fazla_orta = ($toplam_sayfa+1) - $en_az_orta;		 
								$sayfa_orta = $sayfa;
								if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
								if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;					 
								$sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
								$sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta);					 
								if($sol_sayfalar < 1) $sol_sayfalar = 1;
								if($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;	
								$limit = ($sayfa - 1) * $sayfax; 
											            					       
								//Listing query - ilan sorgulama
								
								
								
								//and user_id='".$uye['id']."'		       
								$sql = "select  * FROM  t_advert where   Visible='1' and Validate='1' $userlisting  $filtre  $order  ".$limit.",".$sayfax." ";                      						
								$qrDisplay = mysql_query($sql);
								while($rsDisplay = mysql_fetch_array($qrDisplay)){	
									
									$AdTitle = getName("select * from t_advert_detail where  IlanNo='".$rsDisplay['ID']."' and Dil='".$Lang."' ","Baslik");	
									$AdDescription= getName("select * from t_advert_detail where  IlanNo='".$rsDisplay['ID']."' and Dil='".$Lang."' ","Aciklama");	
									$iladi 	  = getName("select * from il where   id='".$rsDisplay['il']."'","il_adi");
									$ilceadi  = getName("select * from ilce where   id='".$rsDisplay['ilce']."'","ilce_adi");
									$semtadi  = getName("select * from semt where   id='".$rsDisplay['semt']."'","semt_adi");
									$mahadi   = getName("select * from mahalle where   id='".$rsDisplay['mah']."'","mahalle_adi"); 
									
									$sql = "select * from e_criteria_type where Category LIKE '%".$rsDisplay['EstateType']."%'  and Lang='$Lang'  ";
									$q = mysql_query($sql);
									while($listing = mysql_fetch_array($q)){
										$Category = explode(',',$listing['Category']);

										foreach($Category as $InCat){

											if($InCat == $rsDisplay['EstateType']){

												if($listing['Type']=='price'){ 	
													$Price =  $rsDisplay[$listing['SefName']];
													$PriceCurrency =  $rsDisplay[$listing['SefName'].'_Cur'];
				 				
												}
				 			
												if($listing['SubCategory']=='1'){
				 				 	
													$MainCategory =  getName("select * from e_criteria_details  where  ItemID='".$rsDisplay[$listing['SefName']]."' and Lang='".$Lang."' ","Name");				 				
													$SubCategory =  getName("select * from e_category  where  ItemID='".$rsDisplay['EstateType']."' and Lang='".$Lang."' ","Name");;
												}
												
												//Icon fields - ikon listesi
											

											}
										}
									}
									//Status fields Rent-Sales, Emlak durumu Satılık-kiralık vs
									$Status  =  getName("select * from e_criteria_details  where  ItemID='".$rsDisplay['durumu']."' and Lang='".$Lang."' ","Name");	

									$str = $SiteAddress.seflink($Status)."/".seflink($SubCategory)."/".seflink($iladi)."/".seflink($ilceadi)."/".seflink($semtadi)."/".seflink($MainCategory)."/".seflink($AdTitle)."/detay-".$rsDisplay['ID']."/";	
									$Seflink = preg_replace('/([^:])(\/{2,})/', '$1/', $str);
                      				
                      				
									//listing picture - ilan resimleri
									$picture = getName("select * from t_advert_images  where anaresim='1' and  ParentID='".$rsDisplay['ID']."'","Images");
									if(!empty($picture)){
                      					
										$img = "assets/uploads/estate/".$picture."-orta.jpg";
									}
									else{
										$img = "assets/uploads/estate/temp-orta.jpg";
									}

									?>									
									<div class=span3>                   
										<div class=property>                    
											<div class=image>
												<div class=content>
													<a  href="<?=$Seflink?>" title="<?=($AdTitle)?>">
														<div class="description">
															<p> <?=(strip_tags(html_entity_decode($AdDescription)))?></p>
														</div>
														<img src=<?=($img)?> alt="<?=($AdTitle)?>">
													</a>
												</div>
												<div class="rent-sale" >
													<?=($Status)?>  <?=($SubCategory)?>  <?=($MainCategory)?>
												</div>											
												<? if(number_format($Price)!=='0'){ ?>
													<div class=price>
														<?=(number_format($Price)." ".$PriceCurrency)?> 											
													</div>
													<?} ?>
											</div>
											
											<div class=info>
												<div class="title clearfix">
													<h2>
														<a href="<?=($Seflink)?>" title="<?=($AdTitle)?>">
															<?=($AdTitle)?>
														</a>
													</h2>
												</div>
												<div class=location><?=($iladi)?>  <?=($ilceadi)?>  <?=($semtadi)?> <?=($mahadi)?></div>
											</div>
										</div>
										
										<div class="property-info clearfix">
											<?												
											$str= '  Category IN ('.$rsDisplay['EstateType'].')';												
											$sql = "select * from e_criteria_type where $str  and Listing='1' and Lang='$Lang' and Visible='1' ";
											$q = mysql_query($sql);
											while($listing = mysql_fetch_array($q)){
																								
												$istr = getName("select * from e_criteria_details  where  ItemID='".$rsDisplay[$listing['SefName']]."' and Lang='".$Lang."' ","Name");	
												if($listing['Type']=='date'){
													$istr = date("d-m-Y",strtotime($rsDisplay[$listing['SefName']]));	
												}
												if($istr && $listing['Type']=='textbox'){											 	
													echo '<span data-placement="bottom" class="btn btn-mini tooltips"  title="'.$listing['Name'].'" ><i  class="'.$listing['Icon'].' "></i> '.$rsDisplay[$listing['SefName']].'</span>  ';
													}else{
														
														echo '<span data-placement="bottom" class="btn btn-mini tooltips"  title="'.$listing['Name'].'" ><i  class="'.$listing['Icon'].' "></i> '.$istr.'</span>  ';
													}
											}											
											?>
									
										</div>
                       
									</div>
									<?} ?>

							</div>
                  
							<!--Sayfalama Başl.-->
							<div class="pagination">
								<ul>
							<?php
						     $url=strtok($_SERVER["REQUEST_URI"],'?');
									$sayfaq = $url."?".$querystring."sayfa=1";
									
									if($sayfa != 1) echo '<li> <a href="'.$sayfaq.'">&lt;&lt; '.$dil['ilk-sayfa'].'</a></li> ';
							 
									for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++){
										if($sayfa == $s){
											echo '<li class="disabled"> <a>' . $s . '</a></li>';
										} else{
														
											$sayfaq = $url."?".$querystring."sayfa=$s";
											echo '<li><a href="'.$sayfaq.'">'.$s.'</a></li> ';
											        
										}
									}						   
									?>
								</ul>
							</div>
							<!--Sayfalama Bitiş-->
					    
					    
						</div>

						<? echo reklam('3');?> 
 


					</div>

					<!-- /#main -->

				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->

		</div>

		</div>
		<!-- /#content -->
         
		<? include("alt-bolum.php");?>
		<script>
			$(document).ready(function() 
				{	
					$('.tooltips').tooltip();	
				});	
		</script>

		<script type='text/javascript' src='<?=(SITEURL)?>assets/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='<?=(SITEURL)?>assets/js/bootstrap-tooltip.js'></script>		
		<script type='text/javascript' src='<?=(SITEURL)?>assets/libraries/datepicker/js/bootstrap-datepicker.js'></script>
		<script type='text/javascript' src='<?=(SITEURL)?>assets/libraries/datepicker/js/locales/bootstrap-datepicker.<? echo $Lang?>.js'></script>
		<script type='text/javascript' src='<?=(SITEURL)?>assets/js/jquery.number.min.js'></script>
		<script src="<?=(SITEURL)?>assets/js/jquery.sumoselect.js"></script>		
		<script type='text/javascript' src='<?=(SITEURL)?>assets/js/jquery.vticker.js'></script>
		<script type='text/javascript' src='<?=(SITEURL)?>assets/js/properta.js'></script> 

 
    
	</body>
</html>
