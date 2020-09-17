<?
// Start the session
session_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700" rel="stylesheet">
  <title>Profile</title>
  <style>
    .login-popup-sec ul li input:focus, .login-popup-sec .login-popup-clsbtn:focus, {outline: none;}
    .login-popup-sec { font-family: 'calibri', sans-serif; margin: 30px auto; padding: 0; width: 390px; box-sizing: border-box; position: relative; }
    .login-popup-sec .login-content {background: #fff; width: 100%; float: left; overflow: hidden; box-sizing: border-box; padding-bottom: 20px;-webkit-box-shadow: 0px 5px 20px 0px rgba(103, 103, 103, 0.43);-moz-box-shadow: 0px 5px 20px 0px rgba(103, 103, 103, 0.43);box-shadow: 0px 5px 20px 0px rgba(103, 103, 103, 0.43); }
    .login-popup-sec h2 { font-family: 'calibri', sans-serif; font-size: 33px; margin: 0px; padding: 20px 0; letter-spacing: 1px; width: 100%; background: #fff; text-align: center; text-transform: uppercase; color: #333333; float: left; width: 100%; -webkit-box-shadow: 0 13px 24px 0 rgba(0,0,0,0.19); box-shadow: 0 13px 24px 0 rgba(0,0,0,0.19); }
    .login-popup-sec h3 { font-family: 'Montserrat', sans-serif; font-size: 16px; margin: 0px; padding: 20px 0; }
    .login-popup-sec ul { padding: 37px 50px 0 50px; margin: 0px; float: left; width: 100%; list-style: none; box-sizing: border-box; }
    .login-popup-sec ul li { margin: 0; padding: 0px; float: left; width: 100%; box-sizing: border-box; text-align: center; }
    .login-popup-sec ul li input { height: 50px; font-family: 'Montserrat', sans-serif; font-size: 14px; color: #222; border: solid 1px #9c9c9c; margin: 0px; padding: 15px; width: 100%; float: left; box-sizing: border-box; -webkit-box-shadow: 0 5px 5px 0 rgba(0,0,0,0.13); box-shadow: 0 5px 5px 0 rgba(0,0,0,0.13); margin-bottom: 25px; }
    .login-popup-sec ul li button.login-btn { font-family: 'Montserrat', sans-serif; font-size: 16px; color: #fff; cursor: pointer; border: 0px; margin: 0px; width: 100%; background: #0054a6; height: 50px; }
    .login-popup-sec .login-popup-clsbtn { font-size: 14px; line-height: 18px; width: 28px; height: 28px; -webkit-border-radius: 50%; border-radius: 50%; background: #FFF; position: absolute; right: -14px; top: -14px; border: 0px; -webkit-box-shadow: 0 0 2px 0 rgba(0,0,0,0.27); box-shadow: 0 0 2px 0 rgba(0,0,0,0.27); cursor: pointer; }
    .login-popup-sec .login-popup-clsbtn:hover {color: #fff; background: #0006fe;}
    .login-popup-sec ul li button.login-btn:hover { background: #014689; }
    .login-popup-sec ul li .social-icon { margin-bottom: 8px; }
    .popup-graybox {position: fixed;width: 100%;top: 0;left: 0;height: 100vh;z-index: 99999;text-align: center;align-items: center;display: flex;box-sizing: border-box;overflow: auto;}
     @media only screen and (max-width:480px) {
    .login-popup-sec { width: 90%; }
    .login-popup-sec ul { padding: 37px 20px 0 20px; }
    .login-popup-sec h2 {font-size: 24px;padding: 15px 0;}
    .login-popup-sec ul li input {font-size: 12px;margin-bottom: 15px;height: 45px;}
    .login-popup-sec h3 {font-size: 14px;padding: 15px 0;}
    .login-popup-sec ul li button.login-btn {font-size: 12px;letter-spacing: 0.5px;height: 45px;}
    .login-popup-sec ul li .social-icon {margin-bottom: 5px;}
    }
  </style>
</head>

<body>
<section class="popup-graybox">
<div class="login-popup-sec" >
  <div class="login-content">
    <h2 data-edit="text">Sign Up</h2>
    <form action="register_change_process.php" name="login_form" method="post">
    <ul>
      <?
      	include './dbconn.php';

        // 세션 아이디를 통해서 현재 로그인 회원의 정보 조회
        $query = "select * from user where uid = '$_SESSION[id]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        // 조회된 정보 회원가입 폼에 출력
        echo '
        <li>
          <input type="text" name="id" value = "' . $row[uid] . '" placeholder="Ynur ID" data-edit="placeholder" minlength="5"	maxlength="10" required>
        </li>
        <li>
          <input type="password" name="pwd" value = "' . $row[password] . '" placeholder="Your Password" data-edit="placeholder" minlength="5" maxlength="10" required>
        </li>
        <li>
          <input type="text" name="name" value = "' . $row[name] . '" placeholder="Your Name" data-edit="placeholder" minlength="1"	maxlength="15" required>
        </li>
        <li>
          <input type="email" name="email" value = "' . $row[email] . '" placeholder="Your Email" data-edit="placeholder" required>
        </li>
          <input type="radio" id="Starter" name="subscribe" value="0" required'; if(!$_SESSION[subcode]) echo ' checked'; echo '>
          <label for="Starter" style="margin-right: 50px;">Starter</label>
          <input type="radio" id="Premium" name="subscribe" value="1" required'; if($_SESSION[subcode]) echo ' checked'; echo '>
          <label for="Premium">Premium</label>
        <li style="margin-top: 25px;">
          <button class="login-btn" type="submit">Update</button>
        </li>';

      // DB연결 종료
      mysqli_close($conn);
    ?>
      <li>
        <h5></h5>
      </li>
    </ul>
  </form>
  </div>
</div>
</section>
</body>
</html>
