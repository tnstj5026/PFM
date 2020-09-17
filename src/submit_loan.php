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
	if (!$_SESSION['id']) echo '<script>alert("Plese login!"); location.href="./nav_loan.php"</script>';

	// 구독형태에 따른 접근 권한 판단
	if (!$_SESSION['subcode']) echo '<script>alert("Sorry, You are not allowed to access to this page."); location.href="./index.php"</script>';

	// URL에 idx의 값이 존재 할 경우(사용자가 데이터의 수정을 원할 경우)
	if ($_GET['idx']) {
		include './dbconn.php';

		// 거래번호를 통해서 해당 거래의 계좌번호 조회
		$subquery = "(SELECT account FROM loan WHERE no = '" . $_GET['idx'] . "')";
		// 조회한 계좌번호와 회원 아이디를 가지고 계좌 정보 조회
		$query = "SELECT * FROM account WHERE account = $subquery && uid = '" . $_SESSION['id'] . "'";
		$result = mysqli_query($conn, $query);

		// 비정상 접근 방지(조회한 계좌 정보가 존재하지 않을 경우)
		if (!$row = mysqli_fetch_array($result)) echo "<script>location.href='./nav_loan.php'</script>";
		// ------------------------------------ 사용자 인증 ------------------------------------

		// 거래번호를 통해서 해당 거래의 거래 정보 조회
		$subquery = "SELECT * FROM loan WHERE no = '" . $_GET['idx'] . "'";
		$result = mysqli_query($conn, $subquery);
		$row_2 = mysqli_fetch_array($result);
	}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Data - Loan</title>
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
			<!-- 대출 거래 내역 데이터 입력 폼(계좌번호, 은행, 계약일, 만기일, 대출금액, 이자율), 삭제페이지일 경우 거래 정보 출력 및 변경 방지(readonly)-->
			<form action="submit_loan_process.php" method="post">
				<div class="top-fields-wthree">
				<h3 class="inner-hdng-agileinfo">Account</h3>
					<div class="input-fields-w3ls">
						<input type="text" name="accountnum" <?if($_GET['idx']) echo 'value="' . $row_2['account'] . '" readonly'?> placeholder="Account #(10 digits)" pattern="[0-9]{10,10}" required="" autocomplete="off" />
					</div>
					<div class="input-fields-w3ls">
						<input type="text" name="bank" <?if($_GET['idx']) echo 'value="' . $row['bank'] . '" readonly'?> placeholder="Bank" pattern="[a-zA-Z]{2, }" required="" autocomplete="off" />
					</div>
				<h3 class="inner-hdng-agileinfo">Date</h3>
					<div class="input-fields-w3ls">
						<input id="datepicker1" name="loanD" type="text" <?if($_GET['idx']) echo 'value="' . $row_2['contract'] . '" disabled'?> placeholder="Loan Date" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
								required="" autocomplete="off" />
						<input id="datepicker2" name="maturityD" type="text" placeholder="Maturity Date" <?if($_GET['idx']) echo 'value="' . $row_2['maturity'] . '" disabled'?> value="" min = "document.getElementById('datepicker1').value" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}"
								required="" autocomplete="off" />
					</div>
				<h3 class="inner-hdng-agileinfo">Debt</h3>
					<div class="input-fields-w3ls">
						<input type="number" name="amount" <?if($_GET['idx']) echo 'value="' . $row_2['amount'] . '" readonly'?> placeholder="Amount" min="1" required="" autocomplete="off" />
						<input type="number" name="rate" <?if($_GET['idx']) echo 'value="' . $row['rate'] . '" readonly'?> placeholder="Rate" step=0.01 min="0.01" max="50" required="" autocomplete="off" />
						<!-- sumbit_loan_delete에서 delete작업을 처리하도록 대출계약의 인덱스번호를 저장하는 입력 폼(화면에는 표시 않음)-->
						<?if($_GET['idx']) echo '<input type="number" name="index" value="' . $_GET['idx'] . '" style="display: none;">'?>
					</div>
				</div>
				<?
					// 삭제페이지일 경우 Delete 버튼을 아닐경우 Submit 버튼을 표시
					if($_GET['idx']) echo '<input type="submit" value="Delete" formaction="submit_loan_delete.php">';
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
