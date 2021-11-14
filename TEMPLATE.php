

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
// getting the last registered user
$stmt = $conn->query("SELECT * FROM User_Master");

echo "<table>";
while ($row = $stmt->fetch()) {
    echo "<tr><td>" . $row['Last_Name'] . "</td><td>" . "<img src=" . $row['ImageURL'] . " height=200><br />\n </td></tr>";
}
echo "</table>";

// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Test File 2 - Images and Master Pages";

// Apply the template
include ("master.php");
?>

</body>
</html>
