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

<form action="Administration.php" method="post">
EmployeeID: <input type="text" name="EmpID"><input type="submit"name="UserID">
</form>

<?php
$stmt = $conn->query("SELECT * FROM USERS LEFT JOIN USER_ORDERING_LINK ON USERS.EMP_ID = USER_ORDERING_LINK.USER_ID LEFT JOIN DEPARTMENTS ON USER_ORDERING_LINK.DEPT_ID = DEPARTMENTS.DEPARTMENTS WHERE USERS .EMP_ID = '" . $_POST["EmpID"] . "'
ORDER BY USER_ORDERING_LINK.DEPT_ID;");
$row = $stmt->fetch();

echo "<form action='UpdateUser.php' method='post'>";
echo "<table>";
echo "<tr><td>" . "</td><td>" . "<img src=" . $row['IMAGE_URL'] . " height=400 ></td></tr>";
echo "<tr><td>User:</td><td>" . $row['LAST_NAME'] . ", " . $row['FIRST_NAME'] . "</td></tr>";
echo "<tr><td>Username:</td><td>" . $row['HANDLE'] . "</td></tr>";
echo "<tr><td>Password:</td><td><a href=ChangePassword.php?userid=" . $row['EMP_ID']. ">Change Password</a></td></tr>";
echo "<tr><td>Approval Limit:</td><td>" . $row['APPROVAL_LIMIT'] . "</td></tr>";
echo "<tr><td>Departments</td><td>" . $row['DEPT_ID'] . " - " . $row['DESCRIPTION'] . "</td></tr>";
while ($row = $stmt->fetch()) {
    echo "<tr><td></td><td>" . $row['DEPT_ID'] . " - " . $row['DESCRIPTION'] . "</td></tr>";
}
echo "</table>";
echo "</form>";

// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Approval Groups and Limits";
// Apply the template
include ("master.php");
?>

</body>
</html>
