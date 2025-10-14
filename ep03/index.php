<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Support\Email;

$email = new Email();
$email->add(
      "Olá Mundo! Esse é o meu Primeiro E-mail!",
      "<h1>Estou apenas testando!</h1>Espero que tenha dado certo!",
      "Nicolas Torelli",
      "nicolaspenatorelli@gmail.com"
)->send();

if(!$email->error()) {
      var_dump(true);
}else {
      echo $email->error()->getMessage();
}


