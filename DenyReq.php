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

$reqUpdate = $conn->query("UPDATE REQUISITIONS SET APPROVING_USER ="  . $_COOKIE['userid'] . " WHERE REQUISITIONS.ID = " . $_GET['req'] . ";");
#$reqUpdate->fetch();

$reqUpdate = $conn->query("UPDATE REQUISITIONS SET DATE_APPROVED = NOW() WHERE REQUISITIONS.ID = " . $_GET['req'] . ";");
#$reqUpdate->fetch();

$reqUpdate = $conn->query("UPDATE REQUISITIONS SET STATUS = '9'  WHERE REQUISITIONS.ID = " . $_GET['req'] . ";");
#$reqreqUpdateBasic->fetch();

header("location:RequisitionsForApproval.php");
?>

</body>
</html>