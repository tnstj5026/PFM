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
  $cost = $_POST['unitcost'];
	$quan = $_POST['qty'];
  $curp = $_POST['curprice'];
	$uid = $_SESSION['id'];

	// 종목명으로 해당 종목의 종목코드 조회
	$subquery = "(SELECT code FROM value WHERE description = '$desc')";
	// 종목코드와 회원 아이디로 평균단가 및 수량 갱신
	$updatequery = "UPDATE stock SET cost = '$cost', quantity = '$quan' WHERE uid = '$uid' && code = $subquery";
	mysqli_query($conn, $updatequery);

	// 종목의 현재가격 갱신
	$updatequery = "UPDATE value SET price = '$curp' WHERE description = '$desc'";
	mysqli_query($conn, $updatequery);

	// DB연결 종료
	mysqli_close($conn);
	echo "<script>location.href='./nav_stock.php'</script>";

?>
