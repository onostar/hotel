<?php

    $fullname = ucwords(htmlspecialchars(stripslashes($_POST['full_name'])));
    $username = ucwords(htmlspecialchars(stripslashes($_POST['username'])));
    $role = ucwords(htmlspecialchars(stripslashes($_POST['user_role'])));
    $password = 123;

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/inserts.php";

    $add_user = new Add_userController($fullname, $username, $role, $password);
    $add_user->create_user();