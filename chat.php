<?php
session_start();
require_once "config.php";
require_once "model/user.php";
if(!isset($_SESSION['USER'])) {
    header('Location: index.php');
}
else{
    $u = unserialize($_SESSION['USER']);
    $sender = $u->getUsername();
    include $ShareFolderPath."header.html";
    #include
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_reciver = $_POST['reciver'];
        $_SESSION['reciver'] = $_reciver;
        header('location: chatroom.php');
        exit;
    }
    include $ShareFolderPath."footer.html";
}
?>