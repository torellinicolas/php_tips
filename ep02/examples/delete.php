<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = (new User())->findById(6);

if($user) {
      $user->destroy();
}else {
      echo "<pre>";
      print_r($user);
      echo "</pre>";
}

