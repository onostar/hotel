<?php
    session_start();
    
        $guest = $_POST['guest_id'];
        $user = $_POST['user_id'];
        $date = date("Y-m-d H:i:s");
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";
        include "../classes/select.php";

        $check_out = new Update_table();
        $check_out->update_tripple('check_ins', 'guest_status', 2, 'checked_out', $date, 'checked_out_by', $user, 'checkin_id', $guest);
        if($check_out){
        // update room
        //get room
        $get_room = new selects();
        $rooms = $get_room->fetch_details_group('check_ins', 'room', 'checkin_id', $guest);
        $the_room = $rooms->room;
        //update room status
        $update_room = new Update_table();
        $update_room->update('items', 'item_status', 'item_id', 0, $the_room);
        if($update_room){
            echo "<div class='succeed'><p><i class='fas fa-thumbs-up'></i></p><p>Guest Checked out successfully!</p></div>";
            // header("Location: ../view/users.php");
        }else{
            echo "<p>Failed to update room! <i class='fas fa-thumbs-up'></i></p>";
            // header("Location: ../view/users.php");
        }
    }