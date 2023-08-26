<?php

declare(strict_types=1);

namespace App;

class View
{
   public function render(string $page, array $data) {
      require_once('templates/layout.php');
   }
}