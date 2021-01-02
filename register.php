<?php
require "config.php";
require "model/user.php";
include $ShareFolderPath."header.html";
//include $ShareFolderPath."menu.html";

$Message = '';
$uiName_cv = "";
$uiFamily_cv = "";
$uiUsername_cv = "";

if(isset($_POST['uiRegister']))
{
    $uiName_cv = $_POST['uiName'];
    $uiFamily_cv = $_POST['uiFamily'];
    $uiUsername_cv = $_POST['uiUsername'];

    $validationMessage = validation();
    if($validationMessage == "") {
        $u = new user();
        $u->setName($_POST['uiName']);
        $u->setFamily($_POST['uiFamily']);
        $u->setUsername($_POST['uiUsername']);
        $u->setPassword($_POST['uiPassword']);
        if($u->Save())
            $Message = 'You have successfully registed.';
        else
            $Message = 'The username already exists. Please use a different username.';
    }
    else
        $Message = $validationMessage;
}


include $ViewPath."register.html";

include $ShareFolderPath."footer.html";


function validation()
{
    $Message = "";
    if($_POST["uiName"] == "")
        $Message = 'Enter your name'."<br/>";
    if($_POST["uiFamily"] == "")
        $Message .= 'Enter your family'."<br/>";
    if($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.'."<br/>";
    if($_POST["uiPassword"] == "")
        $Message .= 'Enter your password'."<br/>";

    if($_POST["uiPassword"] != $_POST["uiConfirmPassword"])
         $Message .= 'Password and confirmation password do not match.'."<br/>";

    if ($_POST["uiName"].length > 50){        
        $Message .= " your name should be less than 50 characters <br/>";}
    if ($_POST["uiFamily"].length > 50){        
        $Message .= " your family should be less than 50 characters <br/>";}
    if ($_POST["uiName"].length < 3){        
        $Message .= " your name should be more than 3 characters <br/>";}
    if ($_POST["uiFamily"].length < 3){        
        $Message .= " your family should be more than 3 characters <br/>";}
    if ($_POST["uiUsername"].length < 3){        
        $Message .= " your Username should be more than 3 characters <br/>";}
    if ($_POST["uiUsername"].length < 50){        
        $Message .= " your Username should be less than 50 characters <br/>";}
    if ($_POST["uiPassword"].length < 5){        
        $Message .= " your password is not strong enough so it should be more than 5 characters <br/>";}
    if ($_POST["uiPassword"].length > 50){        
        $Message .= " your password should be less than 50 characters <br/>";}
    
    // var re =/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    // if (!re.test(event)){
    //      errorMessage += " your Email is not valid <br/>";}






    return $Message;
}

?>