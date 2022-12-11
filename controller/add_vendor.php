<?php

    $supplier = ucwords(htmlspecialchars(stripslashes($_POST['supplier'])));
    $contact = ucwords(htmlspecialchars(stripslashes($_POST['contact_person'])));
    $phone = htmlspecialchars(stripslashes(($_POST['phone'])));
    $email = htmlspecialchars(stripslashes(($_POST['email'])));

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/inserts.php";

    $add_vendor = new add_suppliers($supplier, $contact, $phone, $email);
    $add_vendor->create_vendor();