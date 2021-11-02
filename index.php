<?php

    require_once 'db.php';
    require_once 'User.php';

    $UNameErr = false;
    $UErrMess = "";
    $PassErr = false;
    $RePassErr = false;
    $regSuc = false;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $UnameList = User::getUsernames();

        if(empty($_POST['username'])) {
            $UNameErr = true;
            $UErrMess = "A mezőt ne hagyja üresen";
        }

        foreach($UnameList as $name) {
            if(strcasecmp($_POST['username'], $name) == 0) {
                $UNameErr = true;
                $UErrMess = "A felhasználónév már foglalt";
            } 
        }

        if(strcasecmp($_POST['username'], $_POST['password']) == 0) {
            $UNameErr = true;
            $UErrMess = "A felhasználónáv és a jelszó nem lehet ugyan az";
        }

        if(empty($_POST['password'])) {
            $PassErr = true;
        }

        if(empty($_POST['rePassword'])) {
            $RePassErr = true;
        }

        if(!$UNameErr && !$PassErr && !$RePassErr) {
                $db_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $User = new User($_POST['username'], $db_hash);
                $User->saveToDb();
                $regSuc = true;
            }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="main.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Reg Form</title>
</head>
<body>
    <form method='POST'>
        <div id="userField">
            <label for="usern">Felhasználónév: </label><input id="usern" name="username" type="text"><span id="usernCounter"></span>
            <span><?php if($UNameErr) echo $UErrMess; ?></span>
        </div>
        <div id="passField">
            <label for="pass">Jelszó: </label><input id="pass" name="password" type="password"><span id="passCounter"></span>
        </div>
        <div id="rePassField">
            <label for="rePass">Jelszó újra: </label><input id="rePass" name="rePassword" type="password"><span id="passCheckDisplay"></span>
        </div>
        <div>
            <input id="submit" type="submit" value="Regisztrál">
        </div>
        <p style="visibility: hidden;" id="regSuccess">Helyes Adatok</p>
        <?php if($regSuc) echo "Sikeres regisztráció!" ?>
    </form>
</body>
</html>