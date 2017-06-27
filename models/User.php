<?php
class User {
   public $id;
   public $name;
   public $email;
   public $password;

   public function __construct($id, $name, $email, $password) {
      $this->id = $id;
      $this->name = $name;
      $this->email = $email;
      $this->password = $password;
   }

   public static function add($name, $email, $password) {
      $db = Db::get();
      $insertUser = "INSERT INTO Users(name, email, passwrd) VALUES('$name', '$email', '$password');";
      $operationOk = $db->query($insertUser);
      return $operationOk;
   }

   public static function verifyCorrect($email, $password) {
      $db = Db::get();
      $findUser = "SELECT userID, email FROM Users WHERE email = '$email' AND passwrd = '$password';";

      $res = $db->query($findUser);

      if ($res->num_rows > 0) {
         $user = $res->fetch_assoc();
         $loginData = array(
            'ok' => True, 
            'userID' => $user['userID'], 
            'email' => $user['email']
         );
      } else {
         $loginData['ok'] = False;
      }
      return $loginData;
   }
}
?>