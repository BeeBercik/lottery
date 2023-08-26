<?php

declare(strict_types=1);

namespace App;

class Codes
{
   private string $code;

   public function __construct()
   {
      $this->code = $this->randomCode();
   }
 
   public function randomCode(): string
   {
      $code = '123456789A';
      return $code;
   }

   public function checkCodes($codes): bool
   {
      $win = false;
      foreach($codes as $code) {
         if($code['code'] === $this->code) $win = true;
      }

      return $win;
   }

   public function properlyCode($code): bool {
      $ok = true;
      if(strlen($code) != 10) $ok = false;

      return $ok;
   }
}