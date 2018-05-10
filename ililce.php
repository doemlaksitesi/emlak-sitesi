<?php
define("_VALID_PHP", true);
require_once("init.php");

$ildeger = $_GET['il'];
$ilcedeger = $_GET['ilce'];
$semtdeger = $_GET['semt'];
$mahalledeger = $_GET['mahalle'];
$islem = $_GET["islem"];

if ($islem == "il") {
    $sql = mysql_query("select * from il where visible=1 order by il_adi asc");
    echo '<option  value="">' . $dil['il'] . " " . $dil['seciniz'] . '</option>';
    while ($a = mysql_fetch_array($sql)) {
        if ($a['id'] == $ildeger) {
            $secili = "selected";
        } else {
            $secili = "";
        }
        echo '<option ' . $secili . '  value="' . $a['id'] . '">' . $a['il_adi'] . '</option>';
    }
}

if ($islem == "ilce") {
    $id = trim(intval($_POST["id"]));

    if ($id == $ilcedeger) {
        $il = $ilcedeger;
    } else {
        $il = $id;
    }

    $sql = mysql_query("select * from ilce where il_id=" . $il . " and visible=1 order by ilce_adi asc");
    echo '<option  value="">' . $dil['ilce'] . " " . $dil['seciniz'] . '</option>';
    while ($a = mysql_fetch_array($sql)) {
        if ($a['id'] == $ilcedeger) {
            $secili = "selected";
        } else {
            $secili = "";
        }
        echo '<option ' . $secili . ' value="' . $a['id'] . '">' . $a['ilce_adi'] . '</option>';
    }
}

if ($islem == "semt") {
    $id = trim(intval($_POST["id"]));
    if ($id == $semtdeger) {
        $ilce = $semtdeger;
    } else {
        $ilce = $id;
    }

    $sql = mysql_query("select * from semt where ilce_id=" . $ilce . " and visible=1 order by semt_adi asc");
    echo '<option  value="">' . $dil['semt'] . " " . $dil['seciniz'] . '</option>';
    while ($a = mysql_fetch_array($sql)) {
        if ($a['id'] == $semtdeger) {
            $secili = "selected";
        } else {
            $secili = "";
        }
        echo '<option  ' . $secili . ' value="' . $a['id'] . '">' . $a['semt_adi'] . '</option>';
    }
}

if ($islem == "mahalle") {
    $id = trim(intval($_POST["id"]));
    if ($id == $mahalledeger) {
        $semt = $mahalledeger;
    } else {
        $semt = $id;
    }
    $sql = mysql_query("select * from mahalle where semt_id=" . $semt . " and visible=1 order by mahalle_adi asc");
    echo '<option  value="">' . $dil['mahalle'] . " " . $dil['seciniz'] . '</option>';
    while ($a = mysql_fetch_array($sql)) {
        if ($a['id'] == $mahalledeger) {
            $secili = "selected";
        } else {
            $secili = "";
        }
        echo '<option ' . $secili . ' value="' . $a['id'] . '">' . $a['mahalle_adi'] . '</option>';
    }
}
?>
<? if ($islem == "") { ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $.post("<?= ($SiteAddress) ?>ililce/?islem=il&il=<?= ($ildeger) ?>", function (data) {
                //il listesi
                $("#il").html(data);
                //secili ilce listesi
                $("#il option:selected").each(function () {
                    var istek = jQuery(this).val();
                    $.post("<?= ($SiteAddress) ?>ililce/?islem=ilce&ilce=<?= ($ilcedeger) ?>", {id: istek}, function (data){
                        $("#ilce").html(data).show();
                        $("#semt").empty();
                        $("#mahalle").empty();
                        $('#semt').append('<option value=""><?= ($dil['semt']) ?> <?= ($dil['seciniz']) ?></option>');
                        $('#mahalle').append('<option value=""><?= ($dil['mahalle']) ?> <?= ($dil['seciniz']) ?></option>');                         
                        $("#ilce option:selected").each(function () {
                            var istek = jQuery(this).val();
                            $.post("<?= ($SiteAddress) ?>ililce/?islem=semt&semt=<?= ($_GET['semt']) ?>", {id: istek}, function (data){
                                $("#semt").html(data).show('slow');
                                $("#mahalle").empty();
                                $('#mahalle').append('<option value=""><?= ($dil['mahalle']) ?> <?= ($dil['seciniz']) ?></option>');
                                $("#semt option:selected").each(function () {
                                    var istek = jQuery(this).val();
                                    $.post("<?= ($SiteAddress) ?>ililce/?islem=mahalle&mahalle=<?= ($mahalledeger) ?>", {id: istek}, function (data){
                                        $("#mahalle").html(data).show('slow');
                                    });
                                });
                            });                            
                        });
                        
                    });
                });
            });
        });
        $(document).on('change', '#il', function () {
            $("#il option:selected").each(function () {
                var istek = jQuery(this).val();
                $.post("<?= ($SiteAddress) ?>ililce/?islem=ilce&ilce=<?= ($_GET['ilce']) ?>", {id: istek}, function (data) {
                    $("#ilce").html(data).show();
                    $("#semt").empty();
                    $("#mahalle").empty();
                    $('#semt').append('<option value=""><?= ($dil['semt']) ?> <?= ($dil['seciniz']) ?></option>');
                    $('#mahalle').append('<option value=""><?= ($dil['mahalle']) ?> <?= ($dil['seciniz']) ?></option>');

                });
            });
        });
        $(document).on('change', '#ilce', function (){
            $("#ilce option:selected").each(function () {
                var istek = jQuery(this).val();
                $.post("<?= ($SiteAddress) ?>ililce/?islem=semt&semt=<?= ($_GET['semt']) ?>", {id: istek}, function (data){
                    $("#semt").html(data).show();
                    $("#mahalle").empty();
                    $('#mahalle').append('<option value=""><?= ($dil['mahalle']) ?> <?= ($dil['seciniz']) ?></option>');
                });
            });
        });
        $(document).on('change', '#semt', function (){
            $("#semt option:selected").each(function () {
                var istek = jQuery(this).val();
                $.post("<?= ($SiteAddress) ?>ililce/?islem=mahalle&mahalle=<?= ($_GET['mahalle']) ?>", {id: istek}, function (data){
                    $("#mahalle").html(data).show();
                });
            });
        });
    </script>
<? } ?>
