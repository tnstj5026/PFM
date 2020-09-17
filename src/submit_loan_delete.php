<?
	// 세션 시작
	session_start();
	// 비정상적인 접근 차단
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_loan.php"</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	include './dbconn.php';

	// URL쿼리 정보 및 세션 정보 변수에 저장
	$idx = $_POST['index'];
	$uid = $_SESSION['id'];

	// 해당 레코드 삭제 쿼리 (거래 내역은 삭제되지만 계좌 정보는 삭제하지 않음)
	$query = "DELETE FROM loan WHERE no = '$idx'";
  $result = mysqli_query($conn, $query);

	// DB연결 종료
	mysqli_close($conn);
	echo "<script>location.href='./nav_loan.php'</script>";
?>
