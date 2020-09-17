<?
// Start the session
session_start();
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Household Account - Loan</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<?
	include './funpack.php';

	// 회원일 경우 로그아웃 및 접속 아이디 출력
	if ($_SESSION['id']) printUser();
	// 비회원일 경우 회원가입 및 로그인 출력
	else printNonUser();
	?>
	<div id="header">
		<div>
			<!-- 네이게이션바(홈, 예금, 카드, 대출[현위치], 주식) 출력-->
			<ul id="navigation">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="nav_deposit.php">Deposit</a>
				</li>
				<li>
					<a href="nav_card.php">Card</a>
				</li>
				<li class="active">
					<a href="nav_loan.php">Loan</a>
				</li>
				<li>
					<a href="nav_stock.php">Stock</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<!-- 대출 거래내역 입력 버튼-->
		<div>
			<p style="text-align: right; text-decoration:none;"><a href="submit_loan.php" style="text-decoration:none">Input</a></p>
		</div>
		<!-- 대출 거래내역의 컬럼 종류-->
		<div style="overflow-x:auto;">
		  <table style="width: 130%; height: 50px">
		    <tr>
					<th>No.</th>
		      <th>Account #</th>
		      <th>Bank</th>
		      <th>Loan Date</th>
		      <th>Maturity Date</th>
		      <th>Amount</th>
		      <th>Rate</th>
					<th>Montly Fee</th>
		    </tr>
				<?
				// 데이터 베이스 접속
				include './dbconn.php';

				// 회원이 보유한 계좌번호 조회
				$sub_query = "(SELECT * FROM account WHERE uid = '" . $_SESSION['id'] . "')";
				$result = mysqli_query($conn, $sub_query);
			  $num = mysqli_num_rows($result);

				// account 와 loan 테이블을 조인하여 회원의 전체 계좌 정보를 조회
				if ($num) $query = "SELECT l.no, l.account, a.bank, l.contract, l.maturity, a.rate, l.amount FROM "
				 . $sub_query . " as a JOIN loan as l on a.account = l.account ORDER BY l.account, l.contract";
				// 위 쿼리와 같은 동작의 다른 형태의 쿼리문(예비 쿼리)
				//$query = "SELECT a.account, a.bank, l.loan, l.maturity, a.rate, l.amount FROM account as a RIGHT JOIN loan as l on a.account = l.account && uid = '$tmp'";
				//$query = "SELECT a.account, a.bank, l.loan, l.maturity, a.rate, l.amount FROM account as a, loan as l WHERE (a.account = l.account) && (l.uid = '$tmp')";
				$result = mysqli_query($conn, $query);

				// 앞서 작성된 쿼리로 구한 정보를 테이블로 출력
				// 회원이 원하는 데이터를 삭제할 수 있도록 URL를 쿼리 형식으로 하이퍼링크를 만들어 인덱스를 출력, 사용자는 데이터 삭제를 원하는 레코드의 인덱스를 선택
				$idx = 1;
				while($row = mysqli_fetch_array($result)) {
					echo"
						<tr>
							<td><a href='submit_loan.php?idx=" . $row[no] . "' style='text-decoration: none'>$idx</a></td>
							<td>" . substr($row[account],0,3) . "-" . substr($row[account],3,3) . "-" . substr($row[account],6,4) . "</td>
							<td>$row[bank]</td>
							<td>$row[contract]</td>
							<td>$row[maturity]</td>
							<td>" . money_print($row[amount]) . "</td>
							<td>" . $row[rate] . "%" . "</td>
							<td>" . money_print($row[amount] * ($row[rate] / 100)) . "</td>
						</tr>";

					$idx++;
				}

				// DB연결 종료
				mysqli_close($conn);
				?>
		  </table>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>
