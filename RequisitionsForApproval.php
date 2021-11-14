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
$reqBasic = $conn->query("SELECT REQUISITIONS.STATUS, REQUISITIONS.ID AS ID, USER_R.LAST_NAME, USER_R.FIRST_NAME, REQUISITIONS.DATE_ENTERED,	SUM(REQUISITION_LINES.LINE_COST) AS 'Cost',	COUNT(LINE_COST) AS 'Line Count',	REQUISITIONS.NOTES,	USER_A.APPROVAL_LIMIT FROM REQUISITIONS LEFT JOIN REQUISITION_LINES ON REQUISITION_LINES.REQUISITION_NUMBER = REQUISITIONS.ID LEFT JOIN USERS USER_R ON REQUISITIONS.REQUESTING_USER = USER_R.EMP_ID LEFT JOIN USER_APPROVAL_LINK ON REQUISITIONS.DELIVERY_DEPARTMENT = USER_APPROVAL_LINK.DEPT_ID LEFT JOIN USERS USER_A ON  USER_APPROVAL_LINK.USER_ID = USER_A.EMP_ID WHERE USER_A.EMP_ID = '" . $_COOKIE['userid'] . "' GROUP BY REQUISITIONS.ID ORDER BY REQUISITIONS.DATE_ENTERED;");

if ($reqBasicRow = $reqBasic->RowCount()) {
	echo "<table><tr><td>Requisition Number</td><td>Requesting User</td><td>Date Entered</td><td>Total Cost</td><td>Lines</td><td>Notes</td>";

	while ($reqBasicRow = $reqBasic->fetch()) {
		if(($reqBasicRow['Cost'] < $reqBasicRow['APPROVAL_LIMIT']) & ($reqBasicRow['STATUS'] === '1'))
		echo "<tr><td><a href='DetailApproval.php?req=" . $reqBasicRow['ID'] . "'>" . $reqBasicRow['ID'] . "</td><td>" . $reqBasicRow['LAST_NAME'] . ", " . $reqBasicRow['FIRST_NAME'] . "</td><td>" . $reqBasicRow['DATE_ENTERED'] . "</td><td>" . round($reqBasicRow['Cost'], 2) . "</td><td>" . $reqBasicRow['Line Count'] . "</td><td>" . $reqBasicRow['NOTES'] . "</td></tr>";
	}
	echo "</table>";
}
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