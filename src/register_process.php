<?
  include './dbconn.php';

  // register 폼에서 사용자가 입력한 정보 변수에 저장
  $id = $_POST['id'];
  $name = $_POST['name'];
  $pwd = $_POST['pwd'];
  $email = $_POST['email'];
  $sub = $_POST['subscribe'];

  // 사용자가 입력한 아이디가 이미 DB에 존재하는지 확인
  $query = "select * from user where uid = '$id'";
  $result = mysqli_query($conn, $query);
  $num = mysqli_num_rows($result);

  // 존재하지 않는다면 DB에 추가하고 회원가입 완료
  if (!$num) {
    // user 테이블에 회원정보 추가
    $inputquery = "INSERT INTO user VALUES ('$id', '$name', '$pwd', '$email', '$sub')";
    mysqli_query($conn, $inputquery);

    // 가입한 계정으로 세션 시작
    session_start();
    $_SESSION["id"] = $id;
    $_SESSION["subcode"] = $sub;

    // home 페이지로 이동
    echo "<script>location.href='./index.php'</script>";

    // DB연결 종료
    mysqli_close($conn);
  }
  // 존재한다면 에러메시지 출력 및 register 페이지로 이동
  else {
    mysqli_close($conn);
    ?>
    <script>
      alert('ID is already in use by another user!');
      location.href='./register.php';
    </script><?
  }


?>
