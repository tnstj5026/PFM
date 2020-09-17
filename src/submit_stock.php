<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?
	// 세션 시작
	session_start();
	// 비정상 접근 방지
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_stock.php"</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	// URL에 desc의 값이 존재 할 경우(사용자가 데이터의 수정을 원할 경우)
	if ($_GET['desc']) {
		include './dbconn.php';

		// 종목명으로 종목코드 조회
		$subquery = "(SELECT code FROM value WHERE description = '" . $_GET['desc'] . "')";
		// 조회한 종목코드와 회원아이디로 보유 주식 조회
		$query = "SELECT * FROM stock WHERE uid = '" . $_SESSION['id'] . "' && code = $subquery";
		$result = mysqli_query($conn, $query);

		// 비정상 접근 방지(데이터 수정을 원하는 종목을 회원이 가지고 있지 않을 경우)
		if (!$row = mysqli_fetch_array($result)) echo "<script>location.href='./nav_stock.php'</script>";

		// 종목명으로 종목코드 및 현재가 정보 조회
		$subquery = "SELECT * FROM value WHERE description = '" . $_GET['desc'] . "'";
		$result = mysqli_query($conn, $subquery);
		$row_2 = mysqli_fetch_array($result);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Data - Stock</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Found Pet Details Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs Sign up Web Templates,
 Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design">

	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}

	</script>
	<!-- Custom Theme files -->
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link href="css/style_submit.css" rel='stylesheet' type='text/css' />
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet">
	<!--//fonts-->
</head>
<body>
	<!--background-->
	<h1></h1>
	<div class="main-w3layouts-content">
		<div class="w3-agile-login-form">
			<!-- 주식 데이터 입력 폼(종목명, 평균단가, 수량, 현재가)-->
			<form action="submit_stock_process.php" method="post">
				<div class="top-fields-wthree">
					<h3 class="inner-hdng-agileinfo">Stock</h3>
					<div class="input-fields-w3ls">
						<input type="text" name="description" <?if($_GET['desc']) echo 'value="' . $_GET['desc'] . '" readonly'?> placeholder="Description" minlength="2" required="" autocomplete="off" />
					</div>
					<h3 class="inner-hdng-agileinfo">Transaction</h3>
					<div class="input-fields-w3ls">
						<input type="number" name="unitcost" <?if($_GET['desc']) echo 'value="' . $row['cost'] . '"'?> placeholder="Unit Cost" min="1" required="" autocomplete="off" />
					</div>
						<p></p>
					<div>
						<input type="number" name="qty" <?if($_GET['desc']) echo 'value="' . $row['quantity'] . '"'?> placeholder="Quantity" min="1" required="" autocomplete="off" />
					</div>
					<h3 class="inner-hdng-agileinfo">Valuation</h3>
					<div class="input-fields-w3ls" style="margin-top: 20px; margin-bottom: 15px">
						<input type="number" name="curprice" <?if($_GET['desc']) echo 'value="' . $row_2['price'] . '"'?> placeholder="Current Price" min="0" required="" autocomplete="off" />
					</div>
				</div>
				<?
					// 사용자가 수정 혹은 삭제 페이지를 통해 접속한 경우 Delete, Change 버튼 표시
					if($_GET['desc']) echo '<input type="submit" value="Delete" formaction="submit_stock_delete.php"> ' .
						 '<input type="submit" value="Change" formaction="submit_stock_change.php">';
					// 사용자가 데이터 입력을 원할 경우 Submit 버튼 표시
					else echo '<input type="submit" value="Submit">';
				?>
			</form>
		</div>
	</div>
	<div class="clear"></div>

	<!-- JavaScript plugins -->
	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

	<!-- Calendar -->
	<script src="js/jquery-ui.js"></script>
	<script>
		$(function () {
			$("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
		});
	</script>
	<!-- //Calendar -->
	<!--// JavaScript plugins -->
</body>

</html>
