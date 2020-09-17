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

	// 사용자가 입력한 종목을 이미 보유하고 있는지 확인
	$subquery = "(SELECT code FROM value WHERE description = '$desc')";
  $query = "SELECT * FROM stock WHERE uid = '$uid' && code = $subquery";
	$result = mysqli_query($conn, $query);

	// 이미 보유하고 있을 경우
	if ($row = mysqli_fetch_array($result)) {
		// 기존 보유 주식과 합산
    $calquan = $row[quantity] + $quan;
    $calcost = round(($row[cost] * $row[quantity] + $cost * $quan) / ($row[quantity] + $quan));

		// 보유 주식의 매수가, 수량 업데이트
    $updatequery = "UPDATE stock SET cost = '$calcost', quantity = '$calquan' WHERE uid = '$uid' && code = $subquery";
    mysqli_query($conn, $updatequery);

		// 새로운 현재가 반영
		$updatequery = "UPDATE value SET price = '$curp' WHERE description = '$desc'";
		mysqli_query($conn, $updatequery);

		// DB연결 종료
		mysqli_close($conn);

    echo "<script>location.href='./nav_stock.php'</script>";
  }
	// 보유하고 있지 않을 경우
  else {

		$result = mysqli_query($conn, $subquery);
		// 기존에 종목 테이블 존재했던 종목의 정보(현재가) 갱신
		if ($row = mysqli_fetch_array($result)) $inputquery = "UPDATE value SET price = '$curp' WHERE description = '$desc'";
		// 새로운 종목에 대한 정보(종목이름, 현재가) 삽입
		else $inputquery = "INSERT INTO value VALUES (NULL, '$desc', '$curp')";
		mysqli_query($conn, $inputquery);

		// 새로운 종목의 종목 코드 번호 조회
		$query = "SELECT code FROM value WHERE description = '$desc'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);

		// 회원 주식 보유 테이블에 새로운 보유 정보 삽입
    $inputquery = "INSERT INTO stock VALUES ('$uid', '$row[code]', '$cost', '$quan')";
    mysqli_query($conn, $inputquery);

		// DB연결 종료
		mysqli_close($conn);

		echo "<script>location.href='./nav_stock.php'</script>";
  }
?>
