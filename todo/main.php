<?php
require_once("./config/database.php");
require_once("./models/auth.php");
require_once("./models/post.php");

$db = new Connection();
$pdo = $db->connect();

$auth = new Auth($pdo);
$post = new Post($pdo);

    $req = [];
    if (isset($_REQUEST['request'])){
        $req = explode('/', rtrim($_REQUEST['request'], '/'));
    }else{
        $req = array("errorcatcher");
    }

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            switch ($req[0]){
                case 'register':
                    // echo 'sample';
                    $d = json_decode(file_get_contents("php://input"));
                    echo json_encode($auth->registration($d));
                break;

                case 'login':
                    $d = json_decode(file_get_contents("php://input"));
                    echo json_encode($auth->login($d));
                break;

                case 'inserttodo':
                    $d = json_decode(file_get_contents("php://input"));
                    echo json_encode($post->insert_todo($d));
                break;
            
            default:
                echo "no endpoint";
            break;
        }
        break;
        default:
            echo "prohibited";
        break;
        }
?>