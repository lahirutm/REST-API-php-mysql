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
    if(isset($_POST['email'])) $email = $database->escape($_POST['email']);

        $sql = "SELECT * FROM `users` WHERE `status`=1 ";

        if(isset($first_name) && !empty($first_name)){
            $sql .= " AND `first_name` LIKE '%".$first_name."%' ";
        }
        if(isset($last_name) && !empty($last_name)){
            $sql .= " AND `last_name` LIKE '%".$first_name."%' ";
        }
        if(isset($username) && !empty($username)){
            $sql .= " AND `username` LIKE '%".$first_name."%' ";
        }    
        if(isset($email) && !empty($email)){
            $sql .= " AND `email` LIKE '%".$first_name."%' ";
        }
        
        $results = $database->select($sql);
        $count = $database->num_rows($sql);

        if($count>0){
            $arr = ["response"=>"success","count"=>$count,"data"=>$results];
        }
        else $arr = ["response"=>"unsuccess","message"=>"No users found for the search. ".$database->error()];
}
else  $arr = ["response"=>"unsuccess","message"=>"Bad request !"];

echo json_encode($arr);
?>