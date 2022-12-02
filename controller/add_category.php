<?php

    $category = ucwords(htmlspecialchars(stripslashes($_POST['category'])));
    $department = ucwords(htmlspecialchars(stripslashes($_POST['department'])));

    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/inserts.php";

    $add_cat = new add_cats($department, $category);
    $add_cat->create_category();