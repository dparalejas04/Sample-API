<?php
    class Post{
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }

        public function insert_todo($d){ 
            
                $sql = "INSERT INTO todo_tbl (todo_date, todo_description) VALUES (?, ?)";
                $sql = $this->pdo->prepare($sql);

                $sql->execute([
                    $d->date,
                    $d->description
                ]);
                return array("success"=>"Successfully Inserted");
            
        }
    }

?>