<?
	// 기존 세션 정보 불러오기
	session_start();
	// 세션 종료(로그아웃) (기존 세션 정보 폐기)
	session_destroy();

	// 홈으로 이동
  echo "<script>location.href='./index.php'</script>";
?>
