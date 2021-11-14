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
// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Epoch Materials Management System";
// Apply the template
include ("master.php");
?>

</body>
</html>
