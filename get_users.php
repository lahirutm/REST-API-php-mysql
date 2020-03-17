<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
require('class.database.php');

$arr = [];
if($_SERVER['REQUEST_METHOD']=="POST"){
        $sql = "SELECT * FROM `users` WHERE `status`=1 ";
        $results = $database->select($sql);
        $count = $database->num_rows($sql);

        if($count>0){
            $arr = ["response"=>"success","count"=>$count,"data"=>$results];
        }
        else $arr = ["response"=>"unsuccess","message"=>"No users found. ".$database->error()];
}
else  $arr = ["response"=>"unsuccess","message"=>"Bad request !"];

echo json_encode($arr);
?>