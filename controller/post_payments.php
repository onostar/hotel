<?php
    session_start();
    $user = $_SESSION['user_id'];
    $trans_type = "sales";
    $invoice = $_POST['sales_invoice'];
    $payment_type = htmlspecialchars(stripslashes($_POST['payment_type']));
    $bank = htmlspecialchars(stripslashes($_POST['bank']));
    $cash = htmlspecialchars(stripslashes($_POST['multi_cash']));
    $pos = htmlspecialchars(stripslashes($_POST['multi_pos']));
    $transfer = htmlspecialchars(stripslashes($_POST['multi_transfer']));
    $discount = htmlspecialchars(stripslashes($_POST['discount']));
    $store = htmlspecialchars(stripslashes($_POST['store']));
    $id = htmlspecialchars(stripslashes($_POST['check_in_id']));
    $amount_due = htmlspecialchars(stripslashes($_POST['total_amount']));
    $amount_paid = htmlspecialchars(stripslashes($_POST['deposits']));
    $type = "Accomodation";
    $date = date("Y-m-d H:i:m");

    //instantiate classes
    include "../classes/dbh.php";
    include "../classes/inserts.php";
    include "../classes/select.php";
    include "../classes/update.php";
    //get guest details from checkin
    $get_guest = new selects();
    $results = $get_guest->fetch_details_cond('check_ins', 'checkin_id', $id);
    foreach($results as $result){
        // $customer = $result->guest;
        $room = $result->room;
        
    }
    if($payment_type == "Multiple"){
        $new_amount = $amount_due - ($cash + $pos + $transfer);
    }else{
        $new_amount = $amount_due - $amount_paid;
    }
    //insert payments
    if($payment_type == "Multiple"){
        //insert into payments
        if($cash !== '0'){
            $insert_payment = new payments($user, 'Cash', $bank, $amount_due, $cash, $discount, $invoice, $store, $type, $customer, $date);
            $insert_payment->payment();
        }
        if($pos !== '0'){
            $insert_payment = new payments($user, 'POS', $bank, $amount_due, $pos, $discount, $invoice, $store, $type, $customer, $date);
            $insert_payment->payment();
        }
        if($transfer !== '0'){
            $insert_payment = new payments($user, 'Transfer', $bank, $amount_due, $transfer, $discount, $invoice, $store, $type, $customer, $date);
            $insert_payment->payment();
        }
        //
        $insert_multi = new multiple_payment($user, $invoice, $cash, $pos, $transfer, $bank, $store, $date);
        $insert_multi->multi_pay();
    }else{
        $insert_payment = new payments($user, $payment_type, $bank, $amount_due, $amount_paid, $discount, $invoice, $store, $type, $id, $date);
        $insert_payment->payment();
    }
    if($insert_payment){
        //update room
        $update_room = new Update_table();
        $update_room->update('items', 'item_status', 'item_id', 2, $room);
        //update guest status and amount due

        $update_guest = new Update_table();
        $update_guest->update_double('check_ins', 'guest_status', 1, 'amount_due', $new_amount, 'checkin_id', $id);
        echo "<p style='color:green; padding:5px 10px;'>Payment posted successfully! <i class='fas fa-thumbs-up'></i></p>";
    
?>
    <div id="printBtn">
        <button onclick="printSalesReceipt('<?php echo $invoice?>')">Print Receipt <i class="fas fa-print"></i></button>
    </div>
<?php }?>