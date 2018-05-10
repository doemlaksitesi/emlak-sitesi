<?php 
  define("_VALID_PHP", true);
  require_once("init.php");
  
  if (!$user->logged_in)
      redirect_to("index.html");
	  
  $row = $user->getUserData();
  $mrow = $user->getUserMembership();
  $gatelist = $member->getGateways(true);
  $listpackrow = $member->getMembershipListFrontEnd();

?>
<?

  $ID = toGet($_GET['ID'], $_POST['ID']);
  $Tip = toGet($_GET['Tip'], $_POST['Tip']);
  $miSend = toGet($_GET['miSend'], $_POST['miSend']);
  $Action = toGet($_GET['Action'], $_POST['Action']);
  $SessID = toGet($_GET['SessID'], $_POST['SessID']);
  
  
  if ($miSend != '') {
  	  switch($Action) {
	  		 case 'Remove' :
	  		 
	  		 if( $demomode == 1 ) {
		         redirect_to($SiteAddress."favori-ilanlar/");
		         return NULL;
		        }
        
        
				   $str = explode("-", $_POST['SelectEstateID']);
				   for ($x=0;$x<count($str);$x++) {
				   		if ($str!='') {
							$sql = "delete from t_add_list where EstateID='".$str[$x]."' and tip='".$Tip."'";
							mysql_query($sql);				 
				   			}
						}
				   if (CountRow("select count(*) as count_row from t_add_list where CookieID='".$row['id']."'") ==0) {
				   	   setcookie("AddList", "", time()-3600);
				   	   header("Location: favori-ilanlar/"); 
				   	   }	
				   
			 	   break;		
	  		 }	
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
<html lang="<? echo $Lang?>">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <base href="<?=(SITEURL)?>" />
    
    <!--Star Seo Tool Start-->
    <meta name="google-site-verification" content="<?=($GoogleDogrulama)?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
    
    <title>Favori İlanlar</title>
    <meta name="description" content="Açıklama">
    <meta name="keywords" content="Anahtar kelimeler">
    <link rel="image_src" href="<?=($SiteAddress)?>images/estate/<?=($fbi[Images])?>_small.jpg" />
    <meta property="og:image" content="<?=($SiteAddress)?>images/estate/<?=($fbi[Images])?>_small.jpg"/>
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
    <link rel='stylesheet' id='properta-css' href='assets/css/<?=($core->theme)?>.css' type='text/css' media='all'/>
    <link rel="stylesheet" type="text/css" href="assets/libraries/sharebar/jquery.share.css" />
    <!--Css Coding End-->
	
    <!--JS Coding Start-->
	<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.2.min.js'></script>  
	<script type="text/javascript"> function swapStyleSheet(sheet){document.getElementById('properta-css').setAttribute('href', sheet);}</script>

</head>

<body class="home page page-template">
<? include("ust-bolum.php");?>

<div id="content" class="clearfix">

<div class="container">
        <div class="row">

            <div id="main" class="span12">

                <div class="login-register">

                    <div class="row">
                        <div class="span12 ">
                          <ul class="tabs nav nav-tabs">
                          <li ><a href="<?=($SiteAddress)?>ilan-ekle/" ><?=($dil['ilan-ekle'])?></a></li>
                            <li ><a href="<?=($SiteAddress)?>ilanlarim/" ><?=($dil['ilan-listesi'])?></a></li>
                            <li class="<?=($_GET['Tip']=='DusukFiyat'?"active":"")?>" ><a href="<?=($SiteAddress)?>favori-ilanlar/?Tip=DusukFiyat" ><?=($dil['takipteki-ilanlar'])?></a></li>
                            <li class="<?=($_GET['Tip']=='Liste'?"active":"")?>" ><a href="<?=($SiteAddress)?>favori-ilanlar/?Tip=Liste" ><?=($dil['favori-ilanlarim'])?></a></li>
                            <li><a href="<?=($SiteAddress)?>uye-guncelle/"><?=($dil['bilgilerimi-guncelle'])?></a></li>
                          </ul>
                            <!-- /.nav -->

                            <div class="tab-content">
                                <div class="tab-pane active ">

<table class="table table-striped table-condensed">
	  <thead>
      <tr>
      <th  style="width:10px;"><?=($dil['no'])?></th>
          <th></th>
          <th><?=($dil['eklenme-tarihi-'])?></th>
          <th><?=($dil['ilan-sahibi'])?></th>
      </tr>
  </thead>   
  <tbody>
  
  <form method="post" name="frmMyList" id="frmMyList" action="<?=($SiteAddress)?>favori-ilanlar/" onSubmit="return frmSubmitMyList()">
			   <input type="hidden" name="miSend" id="miSend" value="1">
               <input type="hidden" name="Tip" id="Tip" value="<?=($Tip)?>">
			   <input type="hidden" name="Action" id="Action" value="Remove">
              <?
						 $sql = "select * from t_add_list where   CookieID='".$row['id']."' and  tip='".$Tip."'";
						  $ds = mysql_query($sql);
						   while($fds = mysql_fetch_array($ds)) {
											
											
														$sql = "select * from t_advert where  ID='".$fds['EstateID']."'";
                      	                   						
														$qrDisplay = mysql_query($sql);
														$rsDisplay = mysql_fetch_array($qrDisplay);	
									
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
																		//Status fields Rent-Sales, Emlak durumu Satılık-kiralık vs
																		$Status  =  getName("select * from e_criteria_details  where  ItemID='".$rsDisplay['durumu']."' and Lang='".$Lang."' ","Name");	
																		//Icon fields - ikon listesi
											

																	}
																}
															}

															$str = $SiteAddress.seflink($Status)."/".seflink($SubCategory)."/".seflink($iladi)."/".seflink($ilceadi)."/".seflink($semtadi)."/".seflink($MainCategory)."/".seflink($AdTitle)."/detay-".$rsDisplay['ID']."/";	
															$Seflink = preg_replace('/([^:])(\/{2,})/', '$1/', $str);
                      				
                      				
															//listing picture - ilan resimleri
															$picture = getName("select * from t_advert_images  where anaresim='1' and  ParentID='".$rsDisplay['ID']."'","Images");
															if(!empty($picture)){
                      					
																$img = "assets/uploads/estate/thmb/".$picture."";
															}
															else{
																$img = "assets/uploads/estate/temp-orta.jpg";
															}
                      
															?>
															<tr  >
																<td  >
																	<input type="checkbox" name="coklu[]" value="<?=($rsDisplay['ID'])?>">
																	<span class="badge badge-info"><?=($rsDisplay['ID'])?></span></td>
																<td >
																	<div class="pull-left" style="margin-right:10px; width:100px; "><img src="<?=($img)?>"    class="img-rounded" /></div>
																	<div >
																		<strong><?=(GetName("select * from t_advert_detail where IlanNo='".$rsDisplay['ID']."' and Dil='".$Lang."'", "Baslik"))?></strong><br />
																		<div><?=($Status)?> - <?=($SubCategory)?> - <?=($MainCategory)?>
																			</div>
																			
																			<div class=location><?=($iladi)?> - <?=($ilceadi)?> - <?=($semtadi)?> <?=($mahadi)?></div>
																			<span class="btn btn-info btn-mini"><?=(number_format($Price)." ".$PriceCurrency)?></span>
																		
																		<br>
																		<!-- Emlak Özellikleri Listesi Başlangıç-->
																		<?												
																		$str= '  Category IN ('.$rsDisplay['EstateType'].')';	
																		$sql = "select * from e_criteria_type where  $str  and Lang='$Lang' and Visible='1'  ";
																		$q = mysql_query($sql);
																		while($listing = mysql_fetch_array($q)){
																			
																								
																			$istr = getName("select * from e_criteria_details  where  ItemID='".$rsDisplay[$listing['SefName']]."' and Lang='".$Lang."' ","Name");	
																			if($listing['Type']=='date'){
																				$istr = $rsDisplay[$listing['SefName']];	
																			}
																			
																			if($istr){
																				echo '<span data-placement="left" class="btn btn-mini tooltips"  title="'.$listing['Name'].'" ><i  class="'.$listing['Icon'].' "></i> '.$istr.'</span>  ';
																			}					 	
																			
																		}											
																		?>

																		
																	</div>
																	

																</td>
																<td >
																	 <button class="btn btn-mini btn-danger" type="submit" name="SelectEstateID" id="SelectEstateID" value="<?=($rsDisplay['ID'])?>"><i class="icon-remove-sign"></i> <?=($dil['sil'])?></button>


																</td>
																
																<td  width="200">
																<?=(GetName("select * from users where id='".$rsDisplay['user_id']."'", "fname"))?>
		<?=(GetName("select * from users where id='".$rsDisplay['user_id']."'", "lname"))?>
		
																	<span><i class="icon-normal-phone"></i> <?=(GetName("select * from users where id='".$rsDisplay['user_id']."'", "gsm"))?></span>
                              
																</td>                                       
															</tr>
    
 

 
															<?} ?>  
															 
</form>
                                   
  </tbody>
</table>
</div>
<!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                            <hr>
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
            
<? include("alt-bolum.php");?>
<!--JS Coding End-->
 <!--[if lt IE 9]>
    <script src="assets/js/html5.js" type="text/javascript"></script>
    <![endif]-->
<script type='text/javascript' src='assets/js/bootstrap.min.js'></script>
<script type='text/javascript' src='assets/js/retina.js'></script>
<script type='text/javascript' src='assets/js/jquery.ezmark.js'></script>


</body>
</html>
