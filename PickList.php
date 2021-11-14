<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta name="description"
	content="A blank HTML document for testing purposes.">
<meta name="author" content="Six Revisions">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://sixrevisions.com/favicon.ico"
	type="image/x-icon" />
</head>
<body>
  
<?php
include ("sql_con.php");
// Buffer larger content areas like the main page content
ob_start();
?>

<?php
$reqBasic = $conn->query("SELECT REQUISITIONS.ID AS ID,	COUNT(REQUISITION_LINES.REQUISITION_NUMBER) AS 'Line_Count', REQUISITIONS.NOTES, REQUISITIONS.DELIVERY_DEPARTMENT, REQUISITION_LINES.ITEM_SKU, REQUISITION_LINES.QTY, BINS.AISLE, BINS.BAY, BINS.SHELF, BINS.BIN_SLOT, BINS.BIN_ID, REQUISITION_LINES.ID AS 'REQ_LINE_ID' FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID LEFT JOIN ITEM_BINS_LINK ON ITEM_BINS_LINK .ITEM_SKU = REQUISITION_LINES.ITEM_SKU LEFT JOIN BINS ON BINS.BIN_ID = ITEM_BINS_LINK.BIN_ID WHERE REQUISITION_LINES.REQUISITION_NUMBER = '" . $_GET['req'] . "' AND REQUISITION_LINES.PICKED IS NULL ORDER BY BINS.AISLE, BINS.BAY, BINS.SHELF, BINS.BIN_SLOT;");

if ($reqBasicRow = $reqBasic->RowCount()) {
	echo "<h2>Items to Pull from Stock</h2><br />";
	echo "<table><tr><td>Requisition Line</td><td>Item SKU</td><td>Qty</td><td>Aisle</td><td>Bay</td><td>Shelf</td><td>Bin</td><tr>";
	$reqLineCounter = 1;
	while ($reqBasicRow = $reqBasic->fetch()) {
		echo "<tr><td>" . $_GET['req'] . "-" . $reqLineCounter . "</td><td>" . $reqBasicRow['ITEM_SKU'] . "</td><td>" . $reqBasicRow['QTY'] . "</td><td>" . $reqBasicRow['AISLE'] . "</td><td>" . $reqBasicRow['BAY'] . "</td><td>" . $reqBasicRow['SHELF'] . "</td><td>" . $reqBasicRow['BIN_SLOT'] . "</td><td><a href='pickItem.php?qty=" . $reqBasicRow['QTY'] . "&bin=" . $reqBasicRow['BIN_ID'] . "&reqLin=" . $reqBasicRow['REQ_LINE_ID'] . "'>Item Picked</td></tr>";
		$reqLineCounter++;

	}
	echo "</table>";
	echo "<br /?";
}

$reqBasic = $conn->query("SELECT REQUISITIONS.ID AS ID,	COUNT(REQUISITION_LINES.REQUISITION_NUMBER) AS 'Line_Count', REQUISITIONS.NOTES, REQUISITIONS.DELIVERY_DEPARTMENT, REQUISITION_LINES.ITEM_SKU, REQUISITION_LINES.QTY, BINS.AISLE, BINS.BAY, BINS.SHELF, BINS.BIN_SLOT FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID LEFT JOIN ITEM_BINS_LINK ON ITEM_BINS_LINK .ITEM_SKU = REQUISITION_LINES.ITEM_SKU LEFT JOIN BINS ON BINS.BIN_ID = ITEM_BINS_LINK.BIN_ID WHERE REQUISITION_LINES.REQUISITION_NUMBER = '" . $_GET['req'] . "' AND REQUISITION_LINES.PICKED = '1' ORDER BY BINS.AISLE, BINS.BAY, BINS.SHELF, BINS.BIN_SLOT;");

if ($reqBasicRow = $reqBasic->RowCount()) {
	echo "<h2>Items to Pull from Stock</h2><br />";
	echo "<table><tr><td>Requisition Line</td><td>Item SKU</td><td>Qty</td><td>Aisle</td><td>Bay</td><td>Shelf</td><td>Bin</td><tr>";
	$reqLineCounter = 1;
	while ($reqBasicRow = $reqBasic->fetch()) {
		echo "<tr><td>" . $_GET['req'] . "-" . $reqLineCounter . "</td><td>" . $reqBasicRow['ITEM_SKU'] . "</td><td>" . $reqBasicRow['QTY'] . "</td><td>" . $reqBasicRow['AISLE'] . "</td><td>" . $reqBasicRow['BAY'] . "</td><td>" . $reqBasicRow['SHELF'] . "</td><td>" . $reqBasicRow['BIN_SLOT'] . "</td></tr>";
		$reqLineCounter++;

	}
	echo "</table>";
}
?>

<?php
// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Epoch Materials Management System - Approved Requests";
// Apply Approved Requests
include ("master.php");
?>

</body>
</html>