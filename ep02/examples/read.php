<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\User;

$user = new User();
$list = $user->find()->fetch(true);

foreach($list as $userItem) {
      echo "<pre>";
      print_r($userItem->data());
      echo "</pre>";
      foreach($userItem->addresses() as $address) {
            echo "<pre>";
            print_r($address->data());
            echo "</pre>";
      }
}