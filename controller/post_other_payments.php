<?php

    
    $posted_by = htmlspecialchars(stripslashes($_POST['posted_by']));
    $guest = htmlspecialchars(stripslashes($_POST['guest']));
    $mode = ucwords(htmlspecialchars(stripslashes($_POST['payment_mode'])));
    $bank = ucwords(htmlspecialchars(stripslashes($_POST['bank_paid'])));
    $sender = ucwords(htmlspecialchars(stripslashes($_POST['sender'])));
    $amount_due = htmlspecialchars(stripslashes($_POST['guest_amount']));
    $amount_paid = htmlspecialchars(stripslashes($_POST['amount_paid']));
    //generate invoice

    $rand_num = mt_rand(000001, 999999);
    $invoice = $mode."/".$rand_num;

    //instantiate classes
    include "../classes/dbh.php";
    include "../classes/inserts.php";
    $post_payment = new payments($posted_by, $guest, $mode, $bank, $sender, $amount_due, $amount_paid, $invoice);

    $post_payment->payment();
    if($post_payment){
        echo "<div class='success'><p>Payment posted successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    }
    