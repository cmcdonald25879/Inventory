<!-- Housekeeping -->
<?php
if(!isset($_COOKIE["userid"])) {
    header("location:Login.php");
}
?>
<!-- End Housekeeping -->
<html>
<head>
<title><?php echo $pagetitle; ?></title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>

<body style="margin-top:20px;margin-left:20px;margin-right:20px;">
<?php include ("sql_con.php"); ?>

<table width="100%" border="0" cellpadding="10" cellspacing="0"border="0">
    <tr bgcolor="#3c3c3c">
    <td><img src="images/logo_dark.jpg" width="200" height="200" /></td><td colspan="5" style="color:#EEEEEE"><h1>Epoch Materials Management<br />Administrative Console</h1><h4><br />AMP Materials Management Specialists</h4></td>
    </tr>
<!--
        <tr bgcolor="#EEEEEE">
        <td nowrap><a href=#">Navigation Link 1</a></td> 
        <td nowrap><a href="PermissionLookup.php">User Lookup</a></td>
        <td nowrap><a href="#">Navigation Link 3</a></td> 
        <td nowrap><a href="#">Navigation Link 4</a></td>
        <td width="100%">&nbsp;</td>
    </tr>
-->
</table>
<br />
<table width="100%" cellpadding="10" cellspacing="0" border="0">
    <tr>
        <td width="10%" valign="top" bgcolor="#EEEEEE"><strong>Materials Management</strong><br /><br />
            <a href="Ordering.php">Ordering</a><br />
            <?php if($_COOKIE["admin"] > 0) {
                echo "<a href='Reports.php'>Reports</a><br />";
                echo "<a href='Administration.php'>Administration</a><br />";
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $query = "SELECT USER_ID FROM USER_APPROVAL_LINK WHERE USER_ID = :approver_ID";  
            $statement = $conn->prepare($query);  
            $statement->execute(array('approver_ID'     =>     $_COOKIE["userid"]));  
            if($statement->rowCount() > 0) {
                echo "<a href='RequisitionsForApproval.php'>Approval Portal</a><br />";
            }
 
            $MMCheck = $conn->query("SELECT MM_FLAG FROM USERS WHERE EMP_ID = '" . $_COOKIE['userid'] . "';");
            $MMCheckVar = $MMCheck->fetch();
            if($MMCheckVar['MM_FLAG'] == 1) {
                echo "<a href='Distribution.php'>PLACEHOLDER FOR PICKLIST</a><br />";
            }
            ?>
            <a href="Login.php">Log Out</a><br />
        </td>
        <td width="90%" valign="top"><?php echo $pagemaincontent; ?>
        </td>
    </tr>
</table>
<br />
<table width="100%" cellspacing="0" cellpadding="10" border="0" style="color:#EEEEEE">
    <tr>
        <td colspan="2" bgcolor="#3c3c3c"><?php echo "&copy " . date('Y') . " AMP Business Solutions" ?></td>
    </tr>
</table>

<!-- Housekeeping -->
<?php $conn = null;
?>
<!-- End Housekeeping -->

</body>
</html>