<?
// 숫자를 입력받아 원화 표시로 출력 ex.1000 -> ₩1,000
function money_print($rawdata) {
  // 실수형 데이터 필터링
  $rawdata = round($rawdata);

  // 입력된 데이터의 양수 및 음수 구분
  if ($rawdata < 0) $rawdata_abs = substr($rawdata, 1);
  else $rawdata_abs = $rawdata;

  // 입력된 데이터의 부호를 제외한 나머지 부분 세자리씩 끊어 읽기
  if (strlen($rawdata_abs) % 3) {
    $formated = substr($rawdata_abs, 0, strlen($rawdata_abs) % 3);
    $formated .= ',';
  }
  for ($a = 0; $a < (int)(strlen($rawdata_abs) / 3); $a++) {
    $formated .= substr($rawdata_abs, (strlen($rawdata_abs) % 3) + 3 * $a, 3);
    $formated .= ',';
  }
  $formated = substr($formated, 0, strlen($formated) - 1);

  // 원화 마크 붙이기
  if ($rawdata < 0) $formated = '₩ -' . $formated;
  else $formated = '₩ ' . $formated;

  // 결과값 반환
  return $formated;
}

function Kor_money($num) {
  var num = $num;
  var unit = ["억", "만", ""];
  var divnum = [];
  var ans = '';

  num = num.toString();
  var div = parseInt(num.length/4, 10);
  var mod = num.length%4;

  if(mod) divnum.push(num.substr(0, mod));
  for (var i = 0; i < div; i++)
    divnum.push(num.substr(mod + 4*i, 4));

  for (var i = 0; i < divnum.length; i++) {
    divnum[i] = parseInt(divnum[i], 10).toString();
    if(divnum[i].length == 4) divnum[i] = divnum[i][0] + ',' + divnum[i].substr(1, 3);
    if(divnum[i] != '0') ans += divnum[i] + unit[unit.length - divnum.length + i] + ' ';
  }
}

function printUser() {
  echo '<div id="account">
    <div>
    <ul id="logintab">
      <li>
        <a href="session_end.php" style="text-decoration:none; color: black">Log out</a>
      </li>
      <li>
        <a href="register_change.php" style="text-decoration:none; color: black">' . $_SESSION['id'] . '</a>
      </li>
    </ul>
  </div>
  </div>';
}

function printNonUser() {
  echo '<div id="account">
    <div>
    <ul id="logintab">
      <li>
        <a href="login.php" style="text-decoration:none; color: black">Sign in</a>
      </li>
      <li>
        <a href="register.php" style="text-decoration:none; color: black">Sign up</a>
      </li>
    </ul>
  </div>
  </div>';
}
?>
