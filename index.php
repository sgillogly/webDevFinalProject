<?php
session_set_cookie_params(3600, '/');
session_start();

include("nav.php");
require("model.php");

$action = $_GET['action'] ?? "home";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if($action == "home"){
        include("home.php");
    } else if ($action == "create"){
        include("create.php");
    } else if($action == "login"){
        include("login.php");
    } else if($action == "logout"){
        if($_SESSION['user_login_in'] == true){
            unset($_SESSION['user_login_in']);
        }
        header("Location: index.php?action=home");
    } else if($action == "new"){
        if(!empty($_SESSION['user_login_in'])){
            include("createEntry.php");
        } else{
            header("Location: index.php?action=login");
        }
    } else if($action == "update"){
        if(!empty($_SESSION['user_login_in'])){
            $result = getEntryUser($_GET['id']);
            if($_SESSION['userID'] == $result['userID']){
                $result = currentEntry($_SESSION['userID'], $_GET['id']);
                include("update.php");
            } else {
                header("Location: index.php?action=read");
            }
        } else{
            header("Location: index.php?action=login");
        }
    } else if($action == "read"){
        if(!empty($_SESSION['user_login_in'])){
            $results = userEntries($_SESSION['userID']);
            include("read.php");
        } else{
            header("Location: index.php?action=login");
        }
    } else if($action == "delete"){
        if(!empty($_SESSION['user_login_in'])){
            $result = getEntryUser($_GET['id']);
            if($_SESSION['userID'] == $result['userID']){
                deleteEntry($_GET['id']);
                header("Location: index.php?action=read");
            } else {
                header("Location: index.php?action=read");
            }
        } else{
            header("Location: index.php?action=login");
        }
    }
} else {
    $form = $_POST['form'] ?? NULL;
    if($form == "create"){
        if(add_new_user($_POST['user'], $_POST['pass'])){
            header("Location: index.php?action=login");
        } else{
            echo "A user with that name has already been created. Please try again.";
            include("create.php");
        }
    } else if($form == "login"){
        if(verify_user($_POST['user'], $_POST['pass'])){
            $_SESSION['user_login_in'] = true;
            $_SESSION['userID'] = getID($_POST['user']);
            header("Location: index.php?action=home");
        } else{
            echo "User log in failed. Please try again.";
            include("login.php");
        }
    } else if($form == "new"){
        if(newEntry($_SESSION['userID'], $_POST['entry']) == true){
            header("Location: index.php?action=read");
        } else{
            echo "New entry failed to be added. Please try again.";
            include("createEntry.php");
        }
    } else if($form == "update"){
        updateEntry($_POST['entryID'], $_POST['entry']);
        header("Location: index.php?action=read");
    }
}
?>