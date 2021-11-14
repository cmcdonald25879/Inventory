<?php
$reqBasic = $conn->query("SELECT ITEM_BINS_LINK.QTY FROM ITEM_BINS_LINK WHERE ITEM_BINS_LINK.BIN_ID = '" . $_GET['bin'] . "';");
$reqBasicRow = $reqBasic->fetch();
$varQty['qty'] = $reqBasicRow['QTY'] - $_GET['qty'];
if($_GET['varQty'] == 0) {
    $reqUpdate = $conn->query("UPDATE ITEM_BINS_LINK SET ITEM_SKU = NULL;");
    $reqUpdate = $conn->query("UPDATE ITEM_BINS_LINK SET QTY = " . $reqBasicRow['QTY'] . "';");
    $reqUpdate = $conn->query("UPDATE REQUISITION_LINES SET PICKED = '1' WHERE '" . $_GET['reqLin'] . "';");
}
else {
    $reqUpdate = $conn->query("UPDATE ITEM_BINS_LINK SET QTY =" . $reqBasicRow['QTY'] . "';");
    $reqUpdate = $conn->query("UPDATE REQUISITION_LINES SET PICKED = '1' WHERE '" . $_GET['reqLin'] . "';");
}
header("location:PickList.php");
?>