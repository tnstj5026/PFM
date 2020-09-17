<?
// Start the session
session_start();
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Household Account - Deposit</title>
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
			<!-- 네이게이션바(홈, 예금[현위치], 카드, 대출, 주식) 출력-->
			<ul id="navigation">
				<li>
					<a href="index.php">Home</a>
				</li>
				<li class="active">
					<a href="nav_deposit.php">Deposit</a>
				</li>
				<li>
					<a href="nav_card.php">Card</a>
				</li>
				<li>
					<a href="nav_loan.php">Loan</a>
				</li>
				<li>
					<a href="nav_stock.php">Stock</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<!-- 계좌 거래내역 입력 버튼-->
		<div>
			<p style="text-align: right; text-decoration:none;"><a href="submit_deposit.php" style="text-decoration:none">Input</a></p>
		</div>
		<div style="overflow-x:auto;">
			<!-- 계좌 거래내역의 컬럼 종류-->
		  <table style="width: 100%; height: 50px">
		    <tr>
		      <th>Date</th>
		      <th>Transaction Type</th>
		      <th>Name</th>
		      <th>Withdraw</th>
		      <th>Deposit</th>
		      <th>Balance</th>
		    </tr>
				<?
				include './dbconn.php';

				// 회원의 계좌 거래내역 날짜 순으로 조회하는 쿼리
				$query = "SELECT * FROM deposit WHERE uid = '" . $_SESSION['id'] . "' ORDER BY date";
				$result = mysqli_query($conn, $query);

				// 위에서 조회된 데이터 표 형태로 출력
				$total = 0;
				while($row = mysqli_fetch_array($result)) {
					$total += $row[save];
					$total -= $row[draw];
					echo"
						<tr>
							<td>$row[date]</td>
							<td>$row[type]</td>
							<td>$row[name]</td>
							<td>"	. money_print($row[draw]) . "</td>
							<td>"	. money_print($row[save]) . "</td>
							<td>" . money_print($total) . "</td>
						</tr>";
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
