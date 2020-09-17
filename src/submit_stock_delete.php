<?
	// 세션 시작
	session_start();
	// 비정상 접근 방지
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_stock.php"</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	include './dbconn.php';

	// 회원이 입력한 정보 변수에 저장
	$desc = $_POST['description'];
	$uid = $_SESSION['id'];

	// 종목명을 바탕으로 종목코드 조회
	$subquery = "(SELECT code FROM value WHERE description = '$desc')";
	// 회원이 가지고 있는 해당 주식 삭제
  $query = "DELETE FROM stock WHERE uid = '$uid' && code = $subquery";
  $result = mysqli_query($conn, $query);

	// DB연결 종료
	mysqli_close($conn);

	echo "<script>location.href='./nav_stock.php'</script>";
?>
