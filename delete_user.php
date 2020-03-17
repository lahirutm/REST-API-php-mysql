<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
require('class.database.php');

$arr = [];
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['id'])) $id = $database->escape($_POST['id']);

    if(isset($id) && !is_null($id) && $id>0){
        $sql = "UPDATE `users` SET `status`=0 WHERE `id`='$id'";

        if($database->query($sql)===true){
            $arr = ["response"=>"success","message"=>"User successfuly deleted."];
        }
        else $arr = ["response"=>"unsuccess","message"=>"Delete user failed. ".$database->error()];                   
    }
    else $arr = ["response"=>"unsuccess","message"=>"Id required !"];
}
else  $arr = ["response"=>"unsuccess","message"=>"Bad request !"];

echo json_encode($arr);
?>