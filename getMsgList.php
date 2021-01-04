<?php
require_once "config.php";
require_once "model/user.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_SESSION['USER'])) {
    $t = unserialize($_SESSION['USER']);
    $msgList =$t->GetAllMsg();
    
//$temp = "";
// for($i=0; $i < count($msg); $i++) {
//     $temp .= '{"index":"'. $msglist[$i]->getindex() . '",';
//     $temp .= '"sender":"'  . $msglist[$i]->getsender() . '",';
//     $temp .= '"reciver":"'   . $msglist[$i]->getreciver() . '"},';
//     $temp .= '"data":"'   . $msglist[$i]->getdate() . '"},';
//     $temp .= '"msg":"'   . $msglist[$i]->getmsg() . '"},';

// }

// $temp = substr($temp, 0, strlen($temp)-1);
// $temp ='{"records":['.$temp.']}';
echo json_encode($MsgList);

}