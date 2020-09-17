<?
// Start the session
session_start();
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Household Account - Stock</title>
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
			<!-- 네이게이션바(홈, 예금, 카드, 대출, 주식[현위치]) 출력-->
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
				<li>
					<a href="nav_loan.php">Loan</a>
				</li>
				<li class="active">
					<a href="nav_stock.php">Stock</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<!-- 보유 주식 입력 버튼 및 종목 현재가 수정 버튼-->
		<div>
			<p style="text-align: right; text-decoration:none;">
				<a href="submit_price.php" style="text-decoration:none; margin-right: 20px;">Price</a>
				<a href="submit_stock.php" style="text-decoration:none">Input</a>
			</p>
		</div>

		<div style="overflow-x:auto;">
			<!-- 보유 주식 정보 컬럼 종류-->
		  <table style="width: 110%; height: 50px">
		    <tr>
					<th>No.</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
					<th>Quantity</th>
		      <th>Extended Cost</th>
		      <th>Current Price</th>
		      <th>Valuation</th>
		    </tr>
				<?
				include './dbconn.php';

				// 종목코드로 종목이름을 검색해서 회원이 소유한 주식의 정보를 조회
				$query = "select v.description, s.cost, s.quantity, v.price from stock as s LEFT JOIN value as v on s.code = v.code where uid = '" . $_SESSION['id'] . "'";
				$result = mysqli_query($conn, $query);

				// 회원이 소유한 주식의 정보 테이블로 출력
				$idx = 1;
				while($row = mysqli_fetch_array($result)) {
					// 인덱스는 추후 사용자가 데이터를 수정 할 수 있도록 쿼리 형식으로 하이퍼링크 테그와 결합
					echo"
						<tr>
							<td><a href='submit_stock.php?desc=" . $row[description] . "' style='text-decoration: none'>$idx</a></td>
							<td>$row[description]</td>
							<td>"	. money_print($row[cost]) . "</td>
							<td>$row[quantity]</td>
							<td>"	. money_print($row[cost] * $row[quantity]) . "</td>
							<td>"	. money_print($row[price]) . "</td>
							<td>"	. money_print(($row[price] - $row[cost]) * $row[quantity]) . "</td>
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
