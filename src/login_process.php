<?
  include './dbconn.php';

  // 이전 login페이지에서 전달 받은 아이디 값 및 패스워드 값
  $id = $_POST['id'];
  $pwd = $_POST['pwd'];

  // DB를 검색하여 입력 받은 아이디, 패스워드와 동일한 값이 있는지 확인
  $query = "SELECT * from user WHERE uid = '$id' && password = '$pwd'";
  $result = mysqli_query($conn, $query);
  //$num = mysqli_num_rows($result);

  // 만약 동일한 값이 있다면
  if ($num = mysqli_fetch_array($result)) {
    // 해당 아이디로 세션 시작
    session_start();
    $_SESSION["id"] = $id;
    $_SESSION["subcode"] = $num[subcode];

    echo "<script>location.href='./index.php'</script>";
  // 없다면 로그인 페이지에서 입력된 아이디, 패스워드가 잘 못 됨을 알리고 다시 로그인 페이지로 이동
  } else {?>
    <script>
      alert('The ID or Password you entered is incorrect.');
      location.href='./login.php';
    </script>
    <?
  }

  // DB연결 종료
  mysqli_close($conn);
?>
