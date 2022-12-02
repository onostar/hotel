<?php

    $category = htmlspecialchars(stripslashes($_POST['room_category']));
    $room = ucwords(htmlspecialchars(stripslashes(($_POST['room']))));

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/inserts.php";

    $add_room = new add_items('rooms', 'room', 'category', $room, $category);
    $add_room->create_item();