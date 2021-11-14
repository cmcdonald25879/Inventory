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
$reqBasic = $conn->query("SELECT REQUISITIONS.STATUS, REQUISITIONS.ID AS ID, REQUISITIONS.DATE_APPROVED, SUM(REQUISITION_LINES.LINE_COST) AS 'Cost', COUNT(REQUISITION_LINES.REQUISITION_NUMBER) AS 'Line_Count', REQUISITIONS.NOTES, REQUISITIONS.DELIVERY_DEPARTMENT FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID WHERE REQUISITIONS.STATUS = '3' GROUP BY REQUISITIONS.ID ORDER BY REQUISITIONS.DATE_APPROVED;");

if ($reqBasicRow = $reqBasic->RowCount()) {
	echo "<table><tr><td>Requisition Number</td><td>Department</td><td>Date Approved</td><td>Lines</td><td>Notes</td>";

	while ($reqBasicRow = $reqBasic->fetch()) {
		echo "<tr><td><a href='PickList.php?req=" . $reqBasicRow['ID'] . "'>" . $reqBasicRow['ID'] . "</td><td>" . $reqBasicRow['DELIVERY_DEPARTMENT'] . "</td><td>" . $reqBasicRow['DATE_APPROVED'] . "</td><td>" . $reqBasicRow['Line_Count'] . "</td><td>" . $reqBasicRow['NOTES'] . "</td></tr>";
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