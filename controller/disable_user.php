<?php
    
    if(isset($_GET['id'])){
        $user = $_GET['id'];

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";

        $disable_user = new Update_table();
        $disable_user->update('users', 'status', 'user_id', -1, $user);
    }