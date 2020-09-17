<?
  // 세션 시작
  session_start();
  // 비회원의 비정상적인 접근 방지
  if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_card.php"</script>';

  include './dbconn.php';

  // register_change 폼에서 사용자가 입력한 정보 변수에 저장
  $id = $_POST['id'];
  $name = $_POST['name'];
  $pwd = $_POST['pwd'];
  $email = $_POST['email'];
  $sub = $_POST['subscribe'];

  // 변경할 아이디로 DB 회원정보 조회(중복 조회)
  $query = "select * from user where uid = '$id'";
  $result = mysqli_query($conn, $query);
  $num = mysqli_fetch_array($result);

  // 만약에 입력된 아이디가 중복되지 않는다면 입력된 아이디, 패스워드, 이름, 이메일 주소, 구독형태로 개인정보 갱신
  if (!$num) {
    // 회원 정보 업데이트 쿼리
    $updatequery = "UPDATE user SET uid = '$id', name = '$name', password = '$pwd', email = '$email', subcode = '$sub' WHERE uid = '$_SESSION[id]'";
    mysqli_query($conn, $updatequery);

    // 기존 세션 종료 및 새로운 세션 시작
    session_destroy();
    session_start();
    // 새로운 세션에 새로운 아이디 정보 추가
    $_SESSION["id"] = $id;
    $_SESSION["subcode"] = $sub;

    echo "<script>location.href='./index.php'</script>";
  }
  // 만약 입력된 아이디와 중복되는 아이디가 있다면 에러메시지 출력 및 홈으로 이동
  else {
    // 입력된 아이디가 지금 회원의 아이디와 동일할 경우 아이디를 제외한 나머지 정보 갱신
    if ($num['uid'] == $_SESSION[id]) {
      $updatequery = "UPDATE user SET name = '$name', password = '$pwd', email = '$email', subcode = '$sub' WHERE uid = '$_SESSION[id]'";
      mysqli_query($conn, $updatequery);
      $_SESSION["subcode"] = $sub;
      echo "<script>location.href='./index.php'</script>";
    }

    // DB연결 종료
    mysqli_close($conn);

    ?>
    <script>
      // 에러메시지 출력 및 기존 입력 페이지 이동
      alert('ID is already in use by another user!');
      location.href='./register_change.php';
    </script><?
  }
?>
