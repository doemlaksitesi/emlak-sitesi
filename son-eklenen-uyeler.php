<div class="tabbable" id="haber">
    <ul class="nav nav-tabs" style="margin-bottom:0;">
        <li ><a style="background: #008000 !important;"  href="javascript:;" data-toggle="tab">Son Eklenen Üyeler</a></li>	  
        <li><a href="#emlak-ofisi" data-toggle="tab"><?php echo $dil['emlak-ofisi']; ?></a></li>	  
        <li><a href="#insaat-firmasi" data-toggle="tab"><?php echo $dil['insaat-firmasi']; ?></a></li>	 
    </ul>
    <div class="row-fluid">
        <div class="tab-content" style="background-color:#fff;">

            <div class="tab-pane active" id="emlak-ofisi" style="padding: 20px">                    
                    <div class="partners">
                        <div class="row">
                            <?php
                            $sql = "Select * from users where  userType='2' order by created asc    limit 5 ";
                            $q   = mysql_query($sql);
                            while($uye = mysql_fetch_array($q)){
                            if($uye['avatar']!==NULL){

                          ?>
                            <div class="span3">
                                <div class="partner" style="padding-bottom: 10px; height: 110px; text-align: center">
                                    <a href="<?php echo sublink($uye['id']);?>">
                                        <img src="assets/uploads/Uyeler/<?php echo $uye['avatar'];?>"  class="thumbnail-image" alt="<?php echo $uye['firmaadi'];?>"  height="100">
                                    </a>
                                </div>
                            </div>
                            <!-- /.span3 -->
                            <?php } } ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.partners -->
                
            </div>
            <div class="tab-pane" id="insaat-firmasi">
             <div class="partners">
                        <div class="row">
                            <?php
                            $sql = "Select * from users where  userType='3' order by created asc    limit 5 ";
                            $q   = mysql_query($sql);
                            while($uye = mysql_fetch_array($q)){
                            if($uye['avatar']!==NULL){

                          ?>
                            <div class="span3">
                                <div class="partner" style="padding-bottom: 10px; height: 110px; text-align: center">
                                    <a href="<?php echo sublink($uye['id']);?>">
                                        <img src="assets/uploads/Uyeler/<?php echo $uye['avatar'];?>"  class="thumbnail-image" alt="<?php echo $uye['firmaadi'];?>"  height="100">
                                    </a>
                                </div>
                            </div>
                            <!-- /.span3 -->
                            <?php } } ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.partners -->
            </div>
           
        </div>
    </div>
</div>