<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;
use Source\Models\Address;

$user = new User();
$user->first_name = "Giovanna";
$user->last_name = "Torelli";
$user->genre = "F";
$user->save();

$addr = new Address();
$addr->add($user, "Bairro Maria Luiza", "22b");
$addr->save();


echo "<pre>";
print_r($user);
echo "</pre>";