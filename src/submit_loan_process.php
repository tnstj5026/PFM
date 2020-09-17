<?
	// 세션 시작
	session_start();
	// 비정상적인 접근 차단
	if (!$_SESSION['id'])	echo '<script>alert("Plese login!"); location.href="./nav_loan.php"</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	// 사용자가 입력한 데이터 변수에 저장
	$ldate = substr($_POST['loanD'], 6, 4) . substr($_POST['loanD'], 0, 2). substr($_POST['loanD'], 3, 2);
	$mdate = substr($_POST['maturityD'], 6, 4) . substr($_POST['maturityD'], 0, 2). substr($_POST['maturityD'], 3, 2);
  $anum = $_POST['accountnum'];
  $bank = $_POST['bank'];
	$amot = $_POST['amount'];
	$rate = $_POST['rate'];
	$uid = $_SESSION['id'];

	// 만기일이 계약일보다 빠를 경우 에러메시지 출력 및 loan 페이지로 이동
	if($ldate >= $mdate) echo "<script>alert('maturity date should be later than contract date.'); location.href='./nav_loan.php'</script>";
	else {
		include './dbconn.php';

		// 계좌번호를 이용해서 계좌정보를 조회하는 쿼리
		$query = "SELECT * FROM account WHERE account = '$anum'";
	  $result = mysqli_query($conn, $query);

		// 사용자가 입력한 계좌번호(계좌)가 이미 존재한다면
		if ($row = mysqli_fetch_array($result)) {
			// 조회된 계좌가 로그인한 회원의 소유가 아니라면
			if ($row[uid] != $uid) {
				?>
				<!-- 입력한 계좌번호는 이미 존재한다는 에러메시지 출력-->
		    <script>
		      alert('The account you submited already exists.');
		      location.href='./submit_loan.php';
		    </script>
		    <?
			}
			// 조회된 계좌가 로그인한 회원의 소유이지만 은행 정보가 틀렸다면
			else if ($row[bank] != $bank) {
				?>
				<!-- 입력한 계좌가 이미 다른 은행 존재한다는 에러메시지 출력-->
		    <script>
		      alert('The account you submited already exists in another bank.');
		      location.href='./submit_loan.php';
		    </script>
		    <?
			}
			// 사용자가 입력한 이자율이 계좌 정보에 등록된 이자율과 일치하지 않을 경우
			else if ($row[rate] != $rate) {
				// 해당 계좌의 이자율을 최신 이자율로 갱신
				$updatequery = "UPDATE account SET rate = $rate WHERE account = '$anum'";
				mysqli_query($conn, $updatequery);

				// 사용자가 입력한 대출거래 정보 추가
				$inputquery = "INSERT INTO loan VALUES (NULL, '$anum', '$ldate', '$mdate', '$amot')";
				mysqli_query($conn, $inputquery);
				echo "<script>location.href='./nav_loan.php'</script>";
			}
			// 사용자가 입력한 정보가 모두 동일하다면
			else {
				// 사용자가 입력한 대출거래 정보 추가
				$inputquery = "INSERT INTO loan VALUES (NULL, '$anum', '$ldate', '$mdate', '$amot')";
				mysqli_query($conn, $inputquery);
				echo "<script>location.href='./nav_loan.php'</script>";
			}
		}
		// 사용자가 입력한 계좌번호(계좌)가 존재하지 않는다면
		else {
			// 사용자의 아이디로 계좌를 새로 개설
			$inputquery = "INSERT INTO account VALUES ('$anum', '$uid', '$bank', '$rate')";
			mysqli_query($conn, $inputquery);
			// 새로 개설한 계좌에 대출 거래내역 정보 입력
			$inputquery = "INSERT INTO loan VALUES (NULL, '$anum', '$ldate', '$mdate', '$amot')";
			mysqli_query($conn, $inputquery);
			// 대출 거래내역 페이지로 이동
			echo "<script>location.href='./nav_loan.php'</script>";
		}

		// DB연결 종료
		mysqli_close($conn);
	}
?>
