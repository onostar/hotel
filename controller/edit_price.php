<?php
    session_start();    
    // if(isset($_POST['change_prize'])){
        $item = htmlspecialchars(stripslashes($_POST['item_id']));
        $cost_price = htmlspecialchars(stripslashes($_POST['cost_price']));
        $sales_price = htmlspecialchars(stripslashes($_POST['sales_price']));

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";

        $change_price = new Update_table();
        $change_price->update_double('items', 'cost_price', $cost_price, 'sales_price', $sales_price, 'item_id', $item);
        if($change_price){
             echo "<div class='success'><p>Price changed successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }else{
            echo "<p style='background:red; color:#fff; padding:5px'>Filed to change price <i class='fas fa-thumbs-down'></i></p>";
        }
    // }