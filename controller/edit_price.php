<?php
    session_start();    
    if(isset($_POST['change_prize'])){
        $category = htmlspecialchars(stripslashes($_POST['category_id']));
        $price = htmlspecialchars(stripslashes($_POST['price']));

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";

        $change_price = new Update_table();
        $change_price->update('categories', 'price', 'category_id', $price, $category);
        if($change_price){
            //  = "<p>Price changed successfully!</p>";
            $_SESSION['success'] = "<div class='success'><p>Price changed successfully! <i class='fas fa-thumbs-up'></i></p></div>";
            header("Location: ../view/users.php");
        }
    }