<?php
    session_start();    
    // if(isset($_POST['change_prize'])){
        $item = htmlspecialchars(stripslashes($_POST['item_id']));
        $quantity = ucwords(htmlspecialchars(stripslashes($_POST['quantity'])));

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";
        include "../classes/select.php";

        //get item name
        $get_name = new selects();
        $row = $get_name->fetch_details_group('items', 'item_name', 'item_id', $item);
        $item_name = $row->item_name;
        //update quantity
        $change_qty = new Update_table();
        $change_qty->update('items', 'quantity', 'item_id', $quantity, $item);
        if($change_qty){
             echo "<div class='success'><p>$item_name quantity adjusted successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }else{
            echo "<p style='background:red; color:#fff; padding:5px'>Failed to modify quantity <i class='fas fa-thumbs-down'></i></p>";
        }
    // }