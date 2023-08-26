<?php

declare(strict_types=1);

namespace App;

use PDO;

class Model
{
   protected PDO $connPDO;

   public function __construct()
   {
      $config = require_once('config/modelConfig.php');
      $this->connection($config);
   }

   public function connection($config): void
   {
      $dsn = "mysql:host={$config['host']};dbname={$config['database']}";
      $this->connPDO = new PDO($dsn, $config['login'], $config['password']);
   }

   public function checkUser($login): ?int
   {
      $login = htmlentities($login);
      $query = "SELECT id from users where login='$login'";
      $result = $this->connPDO->query($query);
      $user = $result->fetch(PDO::FETCH_ASSOC);

      return $user['id'] ?? null;
   }
   
   public function userInfo($id): array
   {
      $id = (int) $id;
      $query = "SELECT * from users where id='$id'";
      $result = $this->connPDO->query($query);
      $info = $result->fetch(PDO::FETCH_ASSOC);
      return $info ?? [];
   }

   public function userCodes($id): array
   {
      $query = "SELECT code from codes where user_id='$id'";
      $result = $this->connPDO->query($query);
      $codes = $result->fetchAll(PDO::FETCH_ASSOC);
      
      return $codes;
   }

   public function addCode(string $code, int $id): void
   {
      $code = htmlentities($code);
      $id = (int) $id;

      $query = "INSERT INTO codes (code, user_id) VALUES ('$code', '$id')";
      $result = $this->connPDO->query($query);
   }

}