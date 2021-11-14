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
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
// Buffer larger content areas like the main page content
ob_start();

?>

<!--    PUT CODE HERE    -->
<form method="post">  
<table>
<tr>
<td><label>New Password:</label></td>
<td><input type="password" name="passwordNew" class="form-control" /></td>
</tr><tr>
<td><label>Confirm Password:</label></td>
<td><input type="password" name="passwordConfirm" class="form-control" /></td>
</tr><tr>
<td></td><td><input type="submit" name="changePWD" class="btn btn-info" value="Change Password" /></td>
</tr>
</form>

<!--    Assign all Page Specific variables    -->
<?php 
if(isset($_POST["changePWD"])) {
	if($_POST["passwordNew"] === $_POST["passwordConfirm"]) {
		$query = "UPDATE USERS SET PWD_HASH = " . $_POST['passwordNew'] . " WHERE EMP_ID = " . $_GET["userid"] . ";";  
		$conn->query($query);
		unset($POST["changePWD"]);
		header("location:Administration.php");
		}
	else {echo "Why you do this?"; }
}

$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Change User Password";
// Apply the template
include ("master.php");

?>
</body>
</html>
