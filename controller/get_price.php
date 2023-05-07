<?php

    $room = htmlspecialchars(stripslashes($_POST['check_in_room']));

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_category = new selects();
    $row = $get_category->fetch_details_group('items', 'category', 'item_id', $room);
     $category = $row->category;
    
    $prices = $get_category->fetch_details_group('categories', 'price', 'category_id', $category);
?>
    <input type="text" name="room_fee" id="room_fee" value="<?php echo $prices->price?>" style="color:green; font-weight:bold;">
<?php
        
?>