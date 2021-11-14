<?php
try  
{  
	include ("sql_con.php");
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT EMP_ID, LAST_NAME, FIRST_NAME, ADMIN_FLAG FROM USERS WHERE HANDLE = :username AND PWD_HASH = :password";  
                $statement = $conn->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();
                $result = $statement->fetch();
                if($count > 0)  
                {  
                    setcookie("userid", $result['EMP_ID']);
                    setcookie("name", $result['FIRST_NAME'] . " " . $result['LAST_NAME']);
                    setcookie("admin",$result['ADMIN_FLAG']);
                    header("location:Splash.php");
                }  
                else  
                {  
                    $message = '<label>Incorrect Username or Password</label>';  
                    setcookie("userid", $result['EMP_ID'], time() - 3600);
                    unset($_COOKIE["userid"]);
                    setcookie("name", $result['FIRST_NAME'] . " " . $result['LAST_NAME'], time() - 3600);
                    unset($_COOKIE["name"]);
                    setcookie("admin",$result['ADMIN_FLAG'], time() - 3600);
                    unset($_COOKIE["admin"]);
               }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  

 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>EPOCH Materials Management System | Login Portal</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
      <body style="margin-top:20px;margin-left:20px;margin-right:20px;">
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
          <td width="10%" valign="top" bgcolor="#EEEEEE">
          <td width="90%" valign="top">
          <?php  
          if(isset($message))  
          {  
               echo '<label class="text-danger">'.$message.'</label>';  
          }  
          ?>  
          <h3 align="">EPOCH Login Portal</h3><br />  
          <form method="post">  
               <table>
                    <tr>
                    <td><label>Username</label></td>
                    <td><input type="text" name="username" class="form-control" style="text-transform:uppercase"/></td>
     </tr><tr>
               <td><label>Password</label></td>
               <td><input type="password" name="password" class="form-control" /></td>
               </tr><tr>
               <td></td><td><input type="submit" name="login" class="btn btn-info" value="Login" /></td>
     </tr>
     </table>
          </form>  
     </div>  
     <br />  
          </td>
      </tr>
  </table>
  <br />
  <table width="100%" cellspacing="0" cellpadding="10" border="0" style="color:#EEEEEE">
      <tr>
          <td colspan="2" bgcolor="#3c3c3c"><?php echo "&copy " . date('Y') . " AMP Business Solutions" ?></td>
      </tr>
  </table>
            <div class="container" style="width:500px;">  
      </body>  
 </html>  