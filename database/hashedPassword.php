<?php
$name = 'anja';
$input = 'asafarim+'.$name;

$password = $input;
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

echo $input."\n".$hashedPassword;