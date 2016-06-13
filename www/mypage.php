<?php
include_once 'function.php';
session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="javascript.fullPage.css"/>
    <link rel="stylesheet" href="css/style.css">

    <style>
        #section {
            float: left;
            width:80%;
            padding:10px;
        }
        #section .table{
            margin: 50px auto;
            width: 80%;
            border: 3px solid #73AD21;
            padding: 10px;
        }
        .Row
        {
            display: table-row;
        }
        .Cell
        {
            display: table-cell;
            border: solid;
            border-width: thin;
            padding-left: 5px;
            padding-right: 5px;
        }
       /* hide input file button*/
        .image-upload > input
        {
            display: none;
        }
    </style>

</head>
<?php include_once 'header.php'?>
<?php include_once 'leftsidebar.php'?>

<body>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $permitted = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $folder = "ProfileImages/";

    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $filepath = $folder.$GLOBALS['email_address'].'.'.$ext;
    echo "$filepath";

    move_uploaded_file($file_tmp, $filepath);
    try{
        $db = new DatabaseHandler();
        if($db->ConnectDB()){
            $db->UploadProfilePhoto($_SESSION['valid_user'], $filepath);
            $db->DisconnectDB();
        }
    }catch(Exception $e){
//        echo $e;
        //Failed($e);
    }
}
?>

<div id="section">
    <div class="table">
        <div class="Row">
            <div class="Cell">
                <form action = "" method = "POST" enctype="multipart/form-data">
                <div class="image-upload">
                    <label for="file-input">
                        <img src="img/defaultprofile.png"/>
                    </label>
                    <input id="file-input" type="file"  name="image"  onchange="this.form.submit()"/>
                </div>
                </form>
            </div>
            <div class="Cell">
                dddddddddddddddddddddddddd
            </div>
        </div>
    </div>
</div>

</body>

</html>