<div class="modal hide fade" id="EmlakUyeTipi">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <i class="icon-remove">
            </i>
        </button>
        <h2 style="margin-bottom:0">
            <?= ($dil['uyelik-tipini-secin']) ?>
        </h2>
        <small class="muted">
            <?= ($dil['sadece-bireysel-uyeler']) ?>
        </small>
    </div>
    <div class="modal-body">
        <div class="row-fluid">
            <a href="<?= ($SiteAddress) ?>bireysel-uye/" class="btn btn-large btn-success">
                <i class="icon-user">
                </i><?= ($dil['bireysel-uyelik']) ?><br />
                <small>
                    <?= ($dil['sahibinden']) ?>
                </small>
            </a> <?= ($dil['veya']) ?>
            <a href="<?= ($SiteAddress) ?>kurumsal-uye/" class="btn btn-large btn-info">
                <i class="icon-user">
                </i>
                <i class="icon-user">
                </i><?= ($dil['kurumsal-uyelik']) ?><br />
                <small>
                    <?= ($dil['emlak-ofisi']) ?>, <?= ($dil['insaat-firmasi']) ?>, <?= ($dil['muteahhitler']) ?>
                </small>
            </a>
        </div>
    </div>
</div>
<div class="top">
    <div class="container">
        <div class="top-inner inverted">
            <div class="header clearfix">
                <?php if (count($core->LangValues) > 1): ?>
                    <div id="language-switch" class="languages">
                        <div id="lang_sel_list" class="lang_sel_list_horizontal">
                            <ul>
                                <?php foreach ($core->LangValues as $Language): ?>
                                    <?php $ChangeLanguage = str_replace("/$Lang/", "/" . $Language['Name'] . "/", $urladresi); ?>
                                    <li data-placement="bottom" class="tooltips" title="<?= ($Language['BrowserLang']) ?>" >
                                        <a  href="<?= ($ChangeLanguage) ?>" >
                                            <img src="assets/css/flag/blank.gif" class="flag flag-<?= ($Language['Name']) ?>" alt="<?= ($Language['BrowserLang']) ?>"  /> 
                                        </a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <? endif; ?>
                <!--
                <div  class="ustgsm" ><?= ($dil['musteri-hizmetleri']) ?><i class="icon-normal-mobile-phone"></i> <span> <a href="tel:<?= ($p = getName("select * from t_contact ", "gsm")) ?>"><?= ($p = getName("select * from t_contact ", "gsm")) ?></a></span></div>
                -->

                <div style=" position: absolute; left:5px; top:-20px" class="visible-desktop">
                    <?php echo social_link('link'); ?>
                </div>
                <div class="row-fluid">
                    <div class="branding span4">

                        <div class="logo pull-left">
                            <a href="<?= ($SiteAddress) ?>" title="<?= ($dil['sitename']) ?> <?= ($dil['sitetitle']) ?>">
                                <img src="<?= ($core->site_logo) ?>"  alt="<?= ($dil['sitename']) ?> <?= ($dil['sitetitle']) ?>">
                            </a>
                        </div>

                    </div>
                    <div id="ustreklam" class="span8 visible-desktop">
                        <?php echo reklam('1'); ?>
                    </div>
                </div>
            </div>
            <div class="navigation navbar clearfix">
                <div class="pull-left">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                    <div class="nav-collapse collapse">
                        <ul id="menu-main" class="nav">
                            <li class="menu-item menu-item-parent">
                                <a href="<?= ($SiteAddress) ?>">
                                    <?= ($dil['anasayfa']) ?>
                                </a>
                            </li>
                            <?php
                            $sql = "select * from e_category where Lang='" . $Lang . "' and Visible='1' and Menu='1'   order by Seq asc ";
                            $q1 = mysql_query($sql);
                            while ($level1 = mysql_fetch_array($q1)) {
                                ?>
                                <li class="menu-item menu-item-parent ">
                                    <a href="<? echo $SiteAddress; ?>arama/<?= (seflink($level1['Name'])) ?>/?Cat=<? echo $level1['ItemID']; ?>" title="<?= ($level1['Name']) ?>">
                                        <?= ($level1['Name']) ?>
                                    </a>

                                    <!--Level2-->
                                    <ul class="sub-menu ">
                                        <?php
                                        $sql = "select * from e_criteria_type where SubCategory='1' and Category='" . $level1['ItemID'] . "'  and Lang='" . $Lang . "' and Visible='1' order by Seq asc ";
                                        $queryLists = mysql_query($sql);
                                        while ($level2 = mysql_fetch_array($queryLists)) {
                                            $sql = "select * from e_criteria_details where CriteriaItemID='" . $level2['ItemID'] . "'  and Lang='" . $Lang . "' and Visible='1' order by Seq asc ";
                                            $queryLists = mysql_query($sql);
                                            while ($level3 = mysql_fetch_array($queryLists)) {
                                                ?>
                                                <li class="menu-item">
                                                    <a href="<?= ($SiteAddress) ?>arama/<?= (seflink($level1['Name'])) ?>-<?= (seflink($level3['Name'])) ?>/?<?= ($level2['SefName']) ?>[]=<? echo $level3['ItemID']; ?>&Cat=<? echo $level1['ItemID']; ?>">
                                                        <i class="icon-normal-right-arrow-circle iconcat"></i>	<?= ($level3['Name']) ?>
                                                    </a>

                                                    <!--Level3-->
                                                    <ul class="sub-menu ">
                                                        <!--Status-->
                                                        <?php
                                                        $sql = "select * from e_criteria_details where CriteriaItemID='63'  and Lang='" . $Lang . "' and Visible='1' order by Seq asc ";
                                                        $q = mysql_query($sql);
                                                        while ($Status = mysql_fetch_array($q)) {
                                                            $x = getName("select * from e_criteria_type  where  ItemID='63' and Lang='" . $Lang . "' ", "Category");
                                                            $istr = explode(',', $x);
                                                            foreach ($istr as $val) {
                                                                if ($val == $level1['ItemID']) {
                                                                    ?>

                                                                    <li class="menu-item">
                                                                        <a href="<?= ($SiteAddress) ?>arama/<?= (seflink($Status['Name'])) ?>-<?= (seflink($level3['Name'])) ?>/?<?= ($level2['SefName']) ?>[]=<? echo $level3['ItemID']; ?>&durumu[]=<? echo $Status['ItemID']; ?>&Cat=<? echo $level1['ItemID']; ?>">
                                                                            <i class="icon-normal-right-arrow-small iconcat"></i>	<? echo $Status['Name']; ?> <?= ($level3['Name']) ?>
                                                                        </a>
                                                                    </li>

                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <!--Status-->

                                                    </ul>
                                                    <!--Level3-->

                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>

                            <?php } ?>
                            <li class="menu-item menu-item-parent">
                                <a href="javascript:void(0);">
                                    <?= ($dil['uye-listesi']) ?>
                                </a>
                                <ul class="sub-menu agency-home ">
                                    <li class="menu-item ">
                                        <a href="<?= ($SiteAddress) ?>emlak-ofisleri/">
                                            <i class="icon-normal-profile-tick">
                                            </i> <?= ($dil['emlak-ofisi']) ?>
                                        </a>
                                    </li>
                                    <li class="menu-item ">
                                        <a href="<?= ($SiteAddress) ?>insaat-firmalari/">
                                            <i class="icon-normal-group-three ">
                                            </i> <?= ($dil['insaat-firmasi']) ?>
                                        </a>
                                    </li>
                                    <li class="menu-item ">
                                        <a href="<?= ($SiteAddress) ?>muteahhitler/">
                                            <i class="icon-normal-profile-rays ">
                                            </i> <?= ($dil['muteahhit']) ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            $sql = "select * from e_pages WHERE  dil='$Lang' and menu=1 and durum=1 order by id";
                            $qs = mysql_query($sql);
                            while ($pagemenu = mysql_fetch_array($qs)) {
                                ?>							 

                                <li class="menu-item menu-item-parent">
                                    <a href="javascript:void(0);">
                                        <?= ($pagemenu['baslik']) ?>
                                    </a>
                                    <ul class="sub-menu agency-home ">
                                        <?php
                                        $sql = "select * from e_pages WHERE  dil='$Lang' and anakat='" . $pagemenu['eid'] . "' and  durum=1 order by id";
                                        $qsub = mysql_query($sql);
                                        while ($pagesubmenu = mysql_fetch_array($qsub)) {
                                            ?>	

                                            <li class="menu-item">
                                                <a href="<?= ($SiteAddress) ?><?= (seflink($pagesubmenu['baslik'])) ?>/<?= ($pagesubmenu['id']) ?>p.html">
                                                    <i class="icon-normal-right-arrow-small iconcat"></i>
                                                    <?= ($pagesubmenu['baslik']) ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="btn-group pull-right " style="margin: 15px 10px 10px 10px;">
                    <a class="btn btn-small btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                        <?= ($dil['ilan-ekle']) ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $sql1 = "select * from e_category where Lang='" . $Lang . "' and visible='1' order by Seq asc ";
                        $queryList1 = mysql_query($sql1);
                        while ($level1x = mysql_fetch_array($queryList1)) {
                            ?>
                            <li>
                                <a href="<?= ($SiteAddress) ?>ilan-ekle/<? echo seflink($level1x['Name']); ?>/?Cat=<? echo $level1x['ItemID']; ?>">
                                    <? echo $level1x['Name']; ?>
                                </a>
                            </li>


                        <?php } ?>

                    </ul>
                </div>
                <div class="pull-right">
                    <div class="user-area pull-right" style="margin: 10px 0 10px 0;">
                        <?php if ($user->logged_in) { ?>
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn btn-small  dropdown-toggle">
                                    <i class="icon-user">
                                    </i><?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
                                </a>
                                <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret">
                                    </span>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php if (!$user->is_Admin()) { ?>
                                        <li class="text-center">
                                            <small class="text-warning">
                                                <?= ($dil['kalan-sureniz']) ?>
                                                <span class="badge badge-info">
                                                    <?php echo Gun($row['mem_expire']); ?>
                                                </span><?= ($dil['gun']) ?>
                                            </small>
                                        </li>
                                    <?php } ?>
                                    <?php if ($user->is_Admin()) { ?>
                                        <li>
                                            <a class="btn btn-small" href="<?= (SITEURL) ?>yonetim/index.php" target="_blank">
                                                <i class="icon-wrench">
                                                </i> <?= ($dil['admin-panel']) ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a  href="<?= ($SiteAddress) ?>ilanlarim/">
                                            <i class="icon-th-list">
                                            </i> <?= ($dil['ilanlarim']) ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a  href="<?= ($SiteAddress) ?>favori-ilanlar/?Tip=DusukFiyat">
                                            <i class="icon-eye-open">
                                            </i> <?= ($dil['takipteki-ilanlar']) ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a  href="<?= ($SiteAddress) ?>uye-guncelle/">
                                            <i class="icon-wrench">
                                            </i> <?= ($dil['bilgilerim']) ?>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a  href="<?= ($SiteAddress) ?>cikis-yap/">
                                            <i class="icon-off">
                                            </i> <?= ($dil['cikis-yap']) ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php } else { ?>
                            <a class="btn btn-small " href="<?= ($SiteAddress) ?>giris-yap/">
                                <i class="icon-user"></i> <?= ($dil['giris-yap']) ?>
                            </a>

                            <a class="btn btn-small btn-warning" data-toggle="modal" href="#EmlakUyeTipi">
                                <i class="icon-plus-sign"></i> <?= ($dil['uye-ol']) ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
