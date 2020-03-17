<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
require('class.database.php');

$arr = [];
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['first_name'])) $first_name = $database->escape($_POST['first_name']);
    if(isset($_POST['last_name'])) $last_name = $database->escape($_POST['last_name']);
    if(isset($_POST['username'])) $username = $database->escape($_POST['username']);
    if(isset($_POST['password'])) $password = $database->escape($_POST['password']);
    if(isset($_POST['email'])) $email = $database->escape($_POST['email']);

    if(isset($first_name) && !empty($first_name)){
        if(isset($last_name) && !empty($last_name)){
            if(isset($username) && !empty($username)){
                if(isset($password) && !empty($password)){
                    if(isset($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $sql = "INSERT INTO `users` 
                        (
                            `first_name`,`last_name`,`username`,`password`,`email`
                        ) 
                        VALUES (
                            '$first_name','$last_name','$username','".md5($password)."','$email'
                        )";

                        $insert_id = $database->insert($sql);

                        if($insert_id>0){
                            $arr = ["response"=>"success","message"=>"User successfuly created.","id"=>$insert_id];
                        }
                        else $arr = ["response"=>"unsuccess","message"=>"Create user failed. ".$database->error()];
                    }
                    else $arr = ["response"=>"unsuccess","message"=>"Valid email required !"];
                }
                else $arr = ["response"=>"unsuccess","message"=>"Password required !"];
            }
            else $arr = ["response"=>"unsuccess","message"=>"Username required !"];
        }
        else $arr = ["response"=>"unsuccess","message"=>"Last name required !"];
    }
    else $arr = ["response"=>"unsuccess","message"=>"First name equired !"];
}
else  $arr = ["response"=>"unsuccess","message"=>"Bad request !"];

echo json_encode($arr);
?>