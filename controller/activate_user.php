<?php

    if(isset($_GET['user_id'])){
        $user = $_GET['user_id'];

        // instantiate class
        include "../classes/dbh.php";
        include "../classes/update.php";

        $activate_user = new Update_table();
        $activate_user->update('users', 'status', 'user_id', 0, $user);
    }