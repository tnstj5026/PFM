<?
	// 세션 시작
	session_start();
	// 비정상 접근 방지
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_stock.php";</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	include './dbconn.php';

	// 사용자가 입력한 정보 변수에 저장
	$desc = $_POST['description'];
  $pric = $_POST['price'];
	$uid = $_SESSION['id'];

	// 종목명으로 주식 종목 정보 조회
  $query = "SELECT * FROM value WHERE description = '$desc'";
  $result = mysqli_query($conn, $query);

	// 만약 해당 종목이 있을 경우
  if ($row = mysqli_fetch_array($result)) {
		// 해당 종목의 현재가 갱신
		$updatequery = "UPDATE value SET price = '$pric' WHERE description = '$desc'";
		mysqli_query($conn, $updatequery);

    echo "<script>location.href='./nav_stock.php'</script>";
  }
	// 만약 해당 종목이 없을 경우
  else {
		// 종목을 새로 만들고 현재가를 입력
		$insertquery = "INSERT INTO value VALUES (NULL, '$desc', '$pric')";
		mysqli_query($conn, $insertquery);

		echo '<script>location.href="./nav_stock.php"</script>';
  }

	// DB연결 종료
	mysqli_close($conn);
?>
