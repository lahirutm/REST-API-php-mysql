<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
require('class.database.php');

$arr = [];
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['id'])) $id = $database->escape($_POST['id']);

    if(isset($id) && !is_null($id) && $id>0){
        $sql = "SELECT * FROM `users` WHERE `id`='$id'";
        $results = $database->select($sql);
        $count = $database->num_rows($sql);

        if($count>0){
            $arr = ["response"=>"success","data"=>$results[0]];
        }
        else $arr = ["response"=>"unsuccess","message"=>"User not found !".$database->error()];                   
    }
    else $arr = ["response"=>"unsuccess","message"=>"Id required !"];
}
else  $arr = ["response"=>"unsuccess","message"=>"Bad request !"];

echo json_encode($arr);
?>