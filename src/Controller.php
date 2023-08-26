<?php

declare(strict_types=1);

namespace App;

require_once('src/Model.php');
require_once('src/View.php');
require_once('src/Codes.php');

class Controller
{
   protected Model $Model;
   protected Request $Request;
   protected View $View;
   protected Codes $Codes;

   public function __construct($request)
   {
      $this->Model = new Model();
      $this->View = new View();
      $this->Codes = new Codes();
      $this->Request = $request;
   }

   public function run(): void
   {
      $action = $this->Request->getInfo('action');

      switch($action) {
         case 'login':
            $page = 'login';
            if(isset($_POST['login'])) {
               $login = htmlentities($this->Request->postInfo('login'));
               $userID = $this->Model->checkUser($login);
               if($userID) {
                  header("Location: index.php?action=account&userID=$userID"); 
                  exit;
               }
            }

            $data = [];
            $this->View->render($page, $data);
         break;
         case 'account':
            $page = 'dashboard';
            $userID = (int) $this->Request->getInfo('userID');
            $userInfo = $this->Model->userInfo($userID);
            $userCodes = $this->Model->userCodes($userID);
            $winner = $this->Codes->checkCodes($userCodes);

            $data = [
               'id' => $userID,
               'login' => $userInfo['login'],
               'finalCode' => $this->Codes->randomCode(),
               'userCodes' => $userCodes,
               'winner' => $winner
            ];
            $this->View->render($page, $data);
         break;
         case 'addCode':
            $page = 'addCode';

            $userID = $this->Request->getInfo('userID');
            $userInfo = $this->Model->userInfo($userID);

            $data = $userInfo;
            $this->View->render($page, $data);
         break;
         default:
            $page = 'welcome';

            $code = $this->Request->postInfo('code');
            if(isset($_POST['code'])) {
               $userID = (int) $this->Request->postInfo('userID');
               if($this->Codes->properlyCode($code)) {
                  dump($userID);
                  $this->Model->addCode($code, $userID);
                  header("Location: index.php?action=account&userID={$_POST['userID']}&before=codeAdded");
               } else {
                  header("Location: index.php?action=account&userID={$_POST['userID']}&before=codeNoAdded");
               }
            }

            $data = [];
            $this->View->render($page, $data);   
         break;
      }
   }

}