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
$reqBasic = $conn->query("SELECT USERS.LAST_NAME, USERS.FIRST_NAME, REQUISITIONS.DATE_ENTERED, SUM(REQUISITION_LINES.LINE_COST) AS 'TOTAL_COST', REQUISITIONS.NOTES FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID LEFT JOIN USERS ON REQUISITIONS.REQUESTING_USER = USERS.EMP_ID WHERE REQUISITIONS.ID = " . $_GET['req'] . ";");

$reqBasicRow = $reqBasic->fetch();
echo "<table><tr><td>Requisition Number</td><td>Requesting User</td><td>Date Entered</td><td>Total Cost</td><td>Notes</td>";
echo "<tr><td>" . $_GET['req'] . "</td><td>" . $reqBasicRow['LAST_NAME'] . ", " . $reqBasicRow['FIRST_NAME'] . "</td><td>" . $reqBasicRow['DATE_ENTERED'] . "</td><td>" . round($reqBasicRow['TOTAL_COST'], 2) . "</td><td>" . $reqBasicRow['NOTES'] . "</td></tr>";
echo "</table>";
echo "<br>";

$reqLines = $conn->query("SELECT REQUISITION_LINES.LINE_COST, REQUISITION_LINES.ITEM_SKU, ITEMS.DESCRIPTION, REQUISITION_LINES.QTY, REQUISITION_LINES.UNIT_COST FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID LEFT JOIN ITEMS ON REQUISITION_LINES.ITEM_SKU = ITEMS.ID WHERE REQUISITIONS.ID = '" . $_GET['req'] . "';");
echo "<table>";
echo "<tr><td>Item SKU</td><td>Item Description</td><td>Qty</td><td>Unit Cost</td><td>Line Total</td></tr>";
while ($reqLinesRow = $reqLines->fetch()) {
	echo "<tr><td>" . $reqLinesRow['ITEM_SKU'] . "</td><td>" . $reqLinesRow['DESCRIPTION'] . "</td><td>" . $reqLinesRow['QTY'] . "</td><td>" . $reqLinesRow['UNIT_COST'] . "</td><td>" . $reqLinesRow['LINE_COST'] . "</td></tr>";
}
echo "</table>";

echo "<a href=ApproveReq.php?req=" . $_GET['req'] . "> Approve </a>";
echo "<a href=DenyReq.php?req=" . $_GET['req'] . "> Deny </a>";
?>

<?php
// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Epoch Materials Management System - Requests for Approval";
// Apply the template
include ("master.php");
?>

</body>
</html>