<?php

    $category = htmlspecialchars(stripslashes($_POST['check_in_category']));

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_room = new selects();
    $rooms = $get_room->fetch_details_2cond('items', 'category', 'item_status', $category, 0);
?>
    <option value=""selected>Select a room</option>
<?php
    if(gettype($rooms) == 'array'){
        foreach ($rooms as $room) {
            

?>
    <option value="<?php echo $room->item_id?>"><?php echo $room->item_name?></option>
<?php
        }   
    }else{
        echo "<option value=''selected>No available room</option>";
    }
?>