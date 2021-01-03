<?php
session_start();
require_once "config.php";
require_once "model/user.php";
if(!isset($_SESSION['USER'])) {
    header('Location: index.php');
}

#if(!isset($_POST["ui_send"]))
#    return;

if(isset($_POST['ui_send'])){
    $u = unserialize($_SESSION['USER']);
    $sender = $u->getUsername();
    $reciver = $_SESSION['reciver'];
    $Msg = $_POST["ui_chatbox"];
    $date = date("Y-m-d H:i:s");

    $paramTypes = "ssss";
    $Parameters = array($sender,$reciver,$date,$Msg);
    database::ExecuteQuery('sendMsg', $paramTypes, $Parameters);
    
}


include $ViewPath."chatroom.html";



?>