<?php

class User 
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function verifyLogin($username, $password)
    {
     $stmt = $this->pdo->prepare("select * from users where username = :u limit 1");
     $stmt->execute(['u'=> $username]);
     $user = $stmt->fetch();

     if($user && password_verify($password, $user['password'])){
      return $user;  
    }
     return false;
    }
    
}