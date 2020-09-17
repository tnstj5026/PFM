<?
	// 세션 시작
	session_start();
	// 비회원의 비정상적인 접근 방지
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_card.php"</script>';

	include './dbconn.php';

	// 사용자가 데이터 입력 폼에서 입력한 데이터
	$date = substr($_POST['Text'], 6, 4) . substr($_POST['Text'], 0, 2). substr($_POST['Text'], 3, 2);
  $desc = $_POST['Description'];
  $amou = $_POST['Amount'];
	$merc = $_POST['Merchant'];
	$uid = $_SESSION['id'];

	// 회원이 입력한 정보를 기준으로 기존 거래내역과 중복되는 레코드가 있는 확인
  $query = "select * from card where uid = '$uid' && date = '$date' && description = '$desc' && amount = $amou && merchant = '$merc'";
  $result = mysqli_query($conn, $query);
  $num = mysqli_num_rows($result);

	// 중복되는 레코드가 없다면 거래내역 추가
  if (!$num) {
    $inputquery = "INSERT INTO card VALUES (NULL, '$uid', '$date', '$desc', '$amou', '$merc')";
    mysqli_query($conn, $inputquery);
    echo "<script>location.href='./nav_card.php'</script>";

		// DB연결 종료
		mysqli_close($conn);
  }
	// 중복되는 레코드가 있다면 에러메시지 표시 및 데이터 입력 폼으로 이동
	else {
		// DB연결 종료
		mysqli_close($conn);
		?>
    <script>
      alert('The data you submited already exists.');
      location.href='./submit_card.php';
    </script>
    <?
  }

?>
