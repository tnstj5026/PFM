<?
// 회원 접속 세션 실행
session_start();
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Household Account - Home</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

  <!-- Google Chart UI 사용-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
	<?
	include './funpack.php';

	// 회원일 경우 로그아웃 및 접속 아이디 출력
	if ($_SESSION['id']) printUser();
	// 비회원일 경우 회원가입 및 로그인 출력
	else printNonUser();
	?>
	<!-- 네이게이션바(홈[현위치], 예금, 카드, 대출, 주식) 출력-->
	<div id="header">
		<div>
			<ul id="navigation">
				<li class="active">
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
				<li>
					<a href="nav_stock.php">Stock</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div style="display: block; height: 400px;">
			<div style="float: left; width: 50%; height: 400px;">
				<?
					// 회원의 예금 정보 출력
					if($_SESSION['id']) {
						echo '<p>[Deposit]</p>';

						include './dbconn.php';

						// 월별 출금액의 합, 입금액의 합을 구하는 쿼리
						$query_1 = "SELECT * FROM (SELECT EXTRACT(YEAR_MONTH FROM date) as ym, IFNULL(sum(draw), 0) as draw, IFNULL(sum(save), 0) as save FROM deposit
						WHERE uid = '" . $_SESSION['id'] . "' GROUP BY EXTRACT(YEAR_MONTH FROM date) ORDER BY EXTRACT(YEAR_MONTH FROM date) DESC LIMIT 4) as main ORDER BY ym";
						// 근사 개월 이전의 잔액을 구하는 쿼리
						$query_2 = "SELECT (IFNULL(sum(save), 0) - IFNULL(sum(draw), 0)) as sum FROM deposit WHERE uid = '" . $_SESSION['id'] . "' && EXTRACT(YEAR_MONTH FROM date)
						 < (SELECT EXTRACT(YEAR_MONTH FROM date) as ym FROM deposit WHERE uid = '" . $_SESSION['id'] . "' GROUP BY EXTRACT(YEAR_MONTH FROM date)
						 ORDER BY EXTRACT(YEAR_MONTH FROM date) DESC LIMIT 3, 1)";
						$result_1 = mysqli_query($conn, $query_1);
						$result_2 = mysqli_query($conn, $query_2);

						// 근사 개월 이전의 잔액
						$tmp = mysqli_fetch_array($result_2);
						$cum = $tmp[sum];
				?>
						<!-- 구글 UI Chart 예금 막대차트-->
						<script type="text/javascript">
							google.charts.load('current', {'packages':['bar']});
							google.charts.setOnLoadCallback(drawBarChart);

							function drawBarChart() {
								var data = google.visualization.arrayToDataTable([
									['Month', 'Expense', 'Income', 'Balance'],
									<?
									while($row = mysqli_fetch_array($result_1)) {
										$cum += ($row[save] - $row[draw]);
										echo "['" . $row[ym] . "', " . $row[draw] . ", " . $row[save] . ", " . $cum . "], ";
									}
									?>
								]);

								var options = {
									chart: {
										title: 'deposit statement',
									}
								};

								var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

								chart.draw(data, google.charts.Bar.convertOptions(options));
							}
						</script>
				<?
					}
					if ($num = mysqli_num_rows($result_1)) echo '<div id="columnchart_material" style="width: 400px; height: 300px;"></div>';
				?>
			</div>
			<div style="clear: right; float: right; width: 50%; height: 400px;">
				<?
					// 회원의 카드 정보 출력
					if($_SESSION['id']) {
						echo '<p>[Card]</p>';

						// 이번 달 카드 총 사용 금액을 구하는 쿼리
						$query = "SELECT * FROM (SELECT EXTRACT(YEAR_MONTH FROM date) as ym, sum(amount) as amt FROM card WHERE uid = '"
						 . $_SESSION['id'] . "' GROUP BY EXTRACT(YEAR_MONTH FROM date) ORDER BY EXTRACT(YEAR_MONTH FROM date) DESC LIMIT 4) as main ORDER BY ym";
						$result = mysqli_query($conn, $query);
				?>
					<!-- 구글 UI Chart 카드 사용내역 라인차트-->
					<script type="text/javascript">
							google.charts.load('current', {'packages':['line']});
							google.charts.setOnLoadCallback(drawChart);

						function drawChart() {

							var data = new google.visualization.DataTable();
							data.addColumn('string', 'Month');
							data.addColumn('number', 'Expense');

							data.addRows([
								<?
								while($row = mysqli_fetch_array($result))
									echo "['" . $row[ym] . "', " . $row[amt] . "], ";
								?>
							]);

							var options = {
								chart: {
									title: 'Monthly expenses',
								},
								width: 400,
								height: 300,
							};

							var chart = new google.charts.Line(document.getElementById('line_top_x'));

							chart.draw(data, google.charts.Line.convertOptions(options));
						}
					</script>
				<?
					}
					if ($num = mysqli_num_rows($result)) echo '<div id="line_top_x"></div>';
				?>
			</div>
		</div>
		<div style="display: block; height: 400px;">
			<div style="float: left; width: 50%; height: 400px;">
				<?
					// 회원의 대출 정보 출력
					if($_SESSION['id'] && $_SESSION['subcode']) {
						echo '<p>[Loan]</p>';

						// 회원이 가지고 있는 계좌의 계좌번호, 은행, 이자율에 대한 정보를 구하는 쿼리
						$sub_query = "(SELECT * FROM account WHERE uid = '" . $_SESSION['id'] . "')";
						// 회원이 가지고 있는 계좌의 계약일, 만기일, 현재일 기준 만기일까지 남은 일수 등을 구하는 쿼리
						$query = "SELECT l.contract, l.maturity, a.rate, l.amount, DATEDIFF(l.maturity, CURDATE()) as diff FROM "
						 . $sub_query . " as a JOIN loan as l on a.account = l.account WHERE maturity >= '" . date('Ym01') .
						 "' ORDER BY diff";
						$result = mysqli_query($conn, $query);

						// 월납입금 및 현재일 기준 가장 빠른 만기일을 구하는 반복문
						while($row = mysqli_fetch_array($result)) {
							$sum += $row['amount'] * ($row['rate'] / 100);
							if ($row['diff'] >= 0 && !$upcoming) $upcoming = $row['maturity'];
						}

						// 위에서 구한 월납입금 및 가장 빠른 만기일 출력
						echo '<p>- Debt repayment(' . date("F") . '): ' . money_print($sum) . '</p>';
						echo '<p>- Upcoming maturity date: ' . $upcoming . '</p>';
					}
				?>
			</div>
			<div style="clear: right; float: right; width: 50%; height: 400px;">
				<?
					// 회원의 주식 정보 출력
					if($_SESSION['id'] && $_SESSION['subcode']) {
					 	echo '<p>[Stock]</p>';

						// 회원이 가지고 있는 주식의 이름 및 벨류에이션을 출력하는 쿼리
						$query = "SELECT v.description, ((price - cost)* quantity) AS val FROM stock AS s LEFT JOIN value AS v ON s.code = v.code WHERE uid = '" . $_SESSION['id'] . "' ORDER BY val DESC";
						$result = mysqli_query($conn, $query);
				?>
					<!-- 회원이 보유한 주식을 파이차트로 표시-->
					<script type="text/javascript">
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawPieChart);

						function drawPieChart() {
							var data = google.visualization.arrayToDataTable([
								['Task', 'Hours per Day'],
								<?
								while($row = mysqli_fetch_array($result))
									if ($row[val] > 0) echo "['" . $row[description] . "', " . $row[val] . "], ";
								?>
							]);

							var options = {
								title: 'Return on investment(exclude loss)',
								is3D: true,
							};

							var chart = new google.visualization.PieChart(document.getElementById('piechart'));

							chart.draw(data, options);
						}
					</script>
				<?
					}
					//보유 주식 퍼센트 출력
					if ($num = mysqli_num_rows($result)) echo '<div id="piechart" style="width: 450px; height: 300px;"></div>';
				?>
			</div>
		</div>
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
