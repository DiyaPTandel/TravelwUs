<?php
$password = "Diy@180905"; //you can convert your password to a hash one.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Your hashed password is: " . $hashed_password;
?>