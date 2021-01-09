<?php
require_once 'core/init.php';

$salt 		 				 = Hash::salt(32);
$generate_password = 'charbel';
$password 				 = Hash::make($generate_password,$salt);

echo 'Salt: ';
echo $salt;

echo '<br><br>';

echo 'Password: ';
echo $password;

echo '<br><br>';

echo $generate_password;
?>
