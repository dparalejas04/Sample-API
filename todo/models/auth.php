<?php
    class Auth{
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }

        public function login($d){
            $un = $d->username;
            $pw = $d->password;

            $sql = "SELECT * FROM accounts WHERE account_name='$d->username' AND account_password='$d->password' LIMIT 1";

            if($res = $this->pdo->query($sql)->fetchAll()){

                return array("data"=>array("accounts_id"=>$res[0]['accounts_id'], "account_name"=>$res[0]['account_name'], "account_email"=>$res[0]['account_email']));
            } else {
                
                return array("error"=>"Incorrect username or password");
            }
        }
    


        public function registration($d){
            
            $sql = "SELECT * FROM accounts WHERE account_email='$d->email' LIMIT 1";

            if ($result = $this->pdo->query($sql)->fetchall()){
                return array("error"=>"Failed Registered");

            }else {

                $sql = "INSERT INTO accounts (account_name, account_email, account_password) VALUES (?, ?, ?)";
                $sql = $this->pdo->prepare($sql);

                $sql->execute([
                    $d->username,
                    $d->email,
                    $d->password
                ]);
                return array("success"=>"Successfully Registered");
            }
        }
    }

?>