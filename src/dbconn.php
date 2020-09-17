<?
     // DB접속 계정 정보 입력
     $host_name = "localhost";
     $db_user_id = "project";
     $db_pwd = "project";
     $db_name = "finance";
     $conn = mysqli_connect($host_name, $db_user_id, $db_pwd, $db_name);

     // DB접속 확인
     if ($conn->connect_error) {
       printf("Connect failed: %s\n", $conn->connect_error);
       exit();
     }
?>
