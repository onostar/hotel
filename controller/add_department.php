<?php

    $department = ucwords(htmlspecialchars(stripslashes($_POST['department'])));

    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/inserts.php";

    $add_item = new add_single_item('departments', 'department', $department);
    $add_item->create_single_item();