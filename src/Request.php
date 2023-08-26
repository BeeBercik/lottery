<?php

declare(strict_types=1);

namespace App; 

class Request
{
   protected array $post = [];
   protected array $get = [];

   public function __construct($POST, $GET)
   {
      $this->post = $POST;
      $this->get = $GET;
   }

   public function postInfo($data)
   {
      return $this->post[$data] ?? null;
   }

   public function getInfo($data)
   {
      return $this->get[$data] ?? null;
   }
}

