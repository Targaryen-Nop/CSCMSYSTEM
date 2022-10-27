<?php
session_start();
date_default_timezone_set("Asia/Bangkok");

include "connectdb.php";

if (isset($_POST['user_login']) && isset($_POST['pwd_login'])) {

  $sql_aes    = "SELECT AES_ENCRYPT('" . $_POST['pwd_login'] . "','ACL4064') AS PASS";
  $query_aes  = mysqli_query($connection, $sql_aes);
  $result_aes = mysqli_fetch_array($query_aes);

  $sql   = "select * from cscm_users where user_name='" . mysqli_real_escape_string($connection, $_POST["user_login"]) . "' and user_password='" . $result_aes['PASS'] . "'";
  $query = mysqli_query($connection, $sql);
  $num   = mysqli_num_rows($query);
?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
  if ($num <= 0) {
    echo "<br><br><center><font size='5' color='red' face='MS Sans Serif'><b>Username or Password Invalid</b></font></center>";
    echo "<meta http-equiv=refresh content=2;URL=login.php>";
    exit();
  } else {
    $result                     = mysqli_fetch_array($query);
    $_SESSION['login_id']       = $result['user_id'];
    $_SESSION['user_rname']      = $result['user_rname'];
    $_SESSION['user_lname']     = $result['user_lname'];
    $_SESSION['user_name']       = $result['user_name'];
    $_SESSION['user_lnameth']     = $result['user_lnameth'];
    $_SESSION['user_nameth']       = $result['user_rnameth'];
    $_SESSION['user_phone']     = $result['user_phone'];
    $_SESSION['user_address']   = $result['user_address'];
    $_SESSION['auth']           = $result['user_auth'];
    $_SESSION['email']          = $result['user_email'];


    echo "<br><br><center><font size='5' color='green' face='MS Sans Serif'><b>Login Please Wait</b></font></center>";
    if ($_SESSION['auth'] == 'Student') {
      echo "<meta http-equiv='refresh' content='1 ;url=main.php?id=$_SESSION[login_id]'>";
    } else if ($_SESSION['auth'] == 'Teacher' || $_SESSION['auth'] == 'Engineer') {
      echo "<meta http-equiv='refresh' content='1 ;url=manage_cscm_persons.php'>";
    }
    exit();
  }
} ?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>CSCM Login</title>
  <link rel="stylesheet" href="login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/Kanit/Kanit.css" rel="stylesheet" />
</head>

<body>

  <div class="center">
    <div class="item-center">
      <form method="post" action="" enctype="multipart/form-data">
        <h3 class="h1 font-en">
          Login
        </h3>
        <p class="font-th">
          ชื่อผู้ใช้กรอกรหัสประจำตัวนักศึกษา
        </p>
        <p class="font-th">
          รหัสผ่านกรอกบัตรประจำตัวประชาชน
        </p>

        <div class="txt_field">
          <input class="btn font-th" type="text" placeholder="ชื่อผู้ใช้" required name='user_login'>

        </div>
        <div class="txt_field">
          <input class="btn font-th" type="password" placeholder="รหัสผ่าน" required name='pwd_login'>

        </div>
        <div class="submit">
          <button class="font-th " type="submit" name="submit" value="Submit" style=" text-align: center;">
            เข้าใช้งาน !
          </button>

        </div>
      </form>
    </div>
    <!--- rigth_bar ------------->
  </div>

</body>

<style>
  * {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
  }

  p {
    color: #a3a3a3;
    font-size: 14px;
  }

  .font-en {
    font-family: ARIBLK;
  }

  .font-th {
    font-family: 'Kanit';
  }

  @font-face {
    font-family: ARIBLK;
    src: url(ariblk.ttf);
    
  }

  .item-center {
    text-align: center;
  }

  .center {
    box-shadow: 0px 2px 30px 3px rgba(102, 102, 102, 0.37);
    border-radius: 30px;
    width: 45%;
    height: 65%;
    padding: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: none;
  }

  .h1 {
    padding: 10px;
    text-align: center;
    font-size: 55px;
    color: #463dbc;
  }

  .btn {
    margin-top: 15px;
    width: 60%;
    height: 50px;
    margin-left: 20px;
    margin-bottom: 5px;
    border-radius: 30px;
    background-color: #DEDCE5;

  }

  button {
    margin-top: 15px;
    margin-bottom: 15px;
    font-size: 16px;
    border: none;
    outline: none;
    width: 60%;
    height: 50px;
    margin-left: 20px;
    margin-bottom: 5px;
    border-radius: 30px;
    background-color: #463DBC;
    color: white;
  }

  button:hover {
    background-color:  #817ad3;
  }

  input {
    text-align: center;
    width: 80%;
    height: 40px;
    font-size: 16px;
    border: none;
    border-bottom: 1px solid #DEDCE5;
    outline: none;
  }
</style>

</html>