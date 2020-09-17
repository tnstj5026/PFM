------------------------------------------------------- Project WebServer -------------------------------------------------------

http://52.79.177.105/                                       // 데모 웹서버 주소

-------------------------------------------------------- Mysql Setting ----------------------------------------------------------

mysql -u root -p                                            // 루트 계정 접속
CREATE user 'project'@localhost identified by 'project';		// project 계정 생성
CREATE database finance;                                    // finance 데이터베이스 생성
GRANT all privileges on finance.* to project@localhost;     // project 계정에 권한 부여
exit                                                        // mysql 종료
mysql -uroot -p --database finance < finance.sql         // project 계정의 finance 데이터베이스에 DB 복구

------------------------------------------------------------ php.ini ------------------------------------------------------------

1. short_open_tag=On                                        // <?php 설정
2. date.timezone = Asia/Seoul                               // 타임존 설정

------------------------------------------------------------ Account ------------------------------------------------------------

ID: sju2010
Password: 12345

그 밖의 계정은 user을 통해서 접근 가능
