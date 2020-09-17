<?
	// 세션 시작
	session_start();
	// 비회원이 접속시 에러메시지 출력 및 이전 페이지로 이동
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_deposit.php"</script>';

	include './dbconn.php';

	// 사용자가 입력한 데이터 변수에 저장
	$date = substr($_POST['Date'], 6, 4) . substr($_POST['Date'], 0, 2). substr($_POST['Date'], 3, 2);
  $name = $_POST['description'];
  $type = $_POST['trs'];
	$tras = $_POST['Trs'];
	$amot = $_POST['amount'];
	$uid = $_SESSION['id'];

	// 거래 형태(입금, 출금)에 따라 적절한 쿼리 입력
	if ($tras == 'withdraw') $inputquery = "INSERT INTO deposit VALUES (NULL, '$uid', '$date', '$type', '$amot', NULL, '$name')";
	else $inputquery = "INSERT INTO deposit VALUES (NULL, '$uid', '$date', '$type', NULL, '$amot', '$name')";

	// 쿼리 실행
  mysqli_query($conn, $inputquery);
	mysqli_close($conn);

	// 페이지 이동
	echo "<script>location.href='./nav_deposit.php'</script>";

	// DB연결 종료
	mysqli_close($conn);
?>
