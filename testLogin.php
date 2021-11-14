<html>
    <body>
        <?php
/**
* Script Name: PHP Form Login Remember Functionality with Cookies
**/
?>

<form action="loginSet.php" method="post" style="border: 2px dotted blue; text-align:center; width: 400px;">
<p>
    Username: <input name="username" type="text" value= "<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" class="input-field">
</p>
<p>
    Password: <input name="password" type="password" value= "<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="input-field">
</p>
<p>
    <input type="submit" value="Login">
</span>
</p>
</form>

</body>
</html>
