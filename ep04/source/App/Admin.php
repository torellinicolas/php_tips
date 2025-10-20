<?php

namespace Source\App;

class Admin
{
      public function home($data)
      {
            echo "<h1>Admin Home</h1>";
            echo "<pre>";
            echo print_r($data);
            echo "</pre>";
      }
}