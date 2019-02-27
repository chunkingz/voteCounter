<?php 
session_start();
@mysql_connect("localhost","root","");
@mysql_select_db("votecounter");
try
	{
$pass = '';
$user = 'root';
$host = 'localhost';
$db = 'votecounter';

$pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);

$pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setattribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
catch(PDOException $e)
{
echo $e->getmessage();
}

?>
