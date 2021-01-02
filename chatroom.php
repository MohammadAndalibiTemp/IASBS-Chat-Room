<?php
session_start();
require_once "config.php";
require_once "model/user.php";
if(!isset($_SESSION['USER'])) {
    header('Location: index.php');
}

#if(!isset($_POST["ui_send"]))
#    return;
if($_POST["ui_chatbox"]!=""){
    $u = unserialize($_SESSION['USER']);
    $sender = $u->getUsername();
    $reciver = $_SESSION['reciver'];
    $Msg = $_POST["ui_chatbox"];
    $date = date("Y-m-d H:i:s");
    $Query = "INSERT INTO chat(`sender`, `reciver`,`date`, `msg`) VALUES ('".$sender."','".$reciver."','".$date."','".$Msg."')";
    $connection = database::ConnectToDB();
    $result = mysqli_query($connection, $Query);
    if(!$result)
            die(mysqli_error($connection));
    mysqli_close($connection);

    
    
}

include $ShareFolderPath."header.html";
include $ViewPath."chatroom.html";


include $ShareFolderPath."footer.html";


?>