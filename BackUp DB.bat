echo off
D:\xampp\mysql\bin\mysqldump -hlocalhost -uroot -proot videoclub > D:\xampp\htdocs\Proyecto_Final\BackUpBD\dataBaseBackup_%Date:~6,4%%Date:~3,2%%Date:~0,2%.sql
exit