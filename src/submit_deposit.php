<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?
	// 세션 시작
	session_start();
	// 비회원의 비정상적인 접근 방지
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_deposit.php"</script>';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Data - Deposit</title>
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
			<!-- 예금 거래내역 데이터 입력 폼(거래일, 받는사람/보낸사람, 거래방식, 입금/출금, 거래금액)-->
			<form action="./submit_deposit_process.php" method="post">
				<div class="top-fields-wthree">
					<h3 class="inner-hdng-agileinfo">Date</h3>
					<div class="input-fields-w3ls">
						<input id="datepicker" name="Date" type="text" placeholder="Date" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
								required="" autocomplete="off" />
					</div>
				<h3 class="inner-hdng-agileinfo">Description</h3>
					<div class="input-fields-w3ls">
						<input type="text" name="description" placeholder="Description" minlength="3" required="" autocomplete="off" />
					</div>
				<h3 class="inner-hdng-agileinfo">Transaction</h3>
					<div class="input-fields-w3ls">
						<select id="trstype" name="trs" onchange="change_country(this.value)" class="frm-field required" required="">
							<option value="IB">IB</option>
							<option value="Check">Check</option>
							<option value="Cash">Cash</option>
							<option value="Others">Others</option>
						</select>
					</div>
					<div class="input-fields-w3ls" style="margin-top: 20px; margin-bottom: 15px">
						<p>Transaction Type:</p>
						<input type="radio" id="withdraw" name="Trs" value="withdraw" required>
						<label for="withdraw">withdraw</label>
						<input type="radio" id="deposit" name="Trs" value="deposit" required>
						<label for="deposit">deposit</label>
					</div>
					<div class="input-fields-w3ls">
						<input type="number" name="amount" placeholder="Amount" min="1" required="" autocomplete="off" />
					</div>
				</div>
				<input type="submit" value="Submit">
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
