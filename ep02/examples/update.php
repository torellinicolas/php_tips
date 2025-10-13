<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = (new User())->findById(4);
$user->first_name = "Cidinha";
$user->save();

echo "<pre>";
print_r($user);
echo "</pre>";