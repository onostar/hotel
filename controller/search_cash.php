<?php

    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_revenue = new selects();
    $details = $get_revenue->fetch_details_2dateCon('payments', 'payment_mode', 'date(post_date)', $from, $to, 'Cash');
    $n = 1;  
?>
<h2>Cash Report from '<?php echo date("jS M, Y", strtotime($from)) . "' to '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRevenue" placeholder="Enter keyword" onkeyup="searchData(this.value)">
    </div>
    <table id="Revenue_table" class="searchTable">
        <thead>
        <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Invoice</td>
                <td>Guest</td>
                <td>Item</td>
                <td>Amount</td>
                <td>Date</td>
                <td>Post Time</td>
                <td>Collectd by</td>
                
            </tr>
        </thead>
        <tbody>
<?php
    if(gettype($details) === 'array'){
    foreach($details as $detail){

?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><a style="color:green" href="javascript:void(0)" title="View payment details" onclick="showPage('invoice_details.php?payment_id=<?php echo $detail->payment_id?>')"><?php echo $detail->invoice?></a></td>
                <td>
                    <?php
                        $get_guest = new selects();
                        $rows = $get_guest->fetch_details_cond('check_ins', 'guest_id', $detail->guest);
                        foreach($rows as $row){
                            $full_name = $row->first_name . " ".$row->last_name;
                        }
                        echo $full_name;
                    ?>
                </td>
                <td>
                    <?php 
                        /* $get_room = new selects();
                        $rooms = $get_room->fetch_details_group('rooms', 'room', 'room_id', $detail->room);
                        echo $rooms->room; */
                    ?>
                </td>
                <td><?php echo "₦".number_format($detail->amount_paid, 2)?></td>
                <td style="color:var(--moreColor)"><?php echo date("jS M, Y", strtotime($detail->post_date));?></td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:sa", strtotime($detail->post_date));?></td>
                <td>
                    <?php
                        //get posted by
                        $get_posted_by = new selects();
                        $checkedin_by = $get_posted_by->fetch_details_group('users', 'full_name', 'user_id', $detail->posted_by);
                        echo $checkedin_by->full_name;
                    ?>
                </td>
                
            </tr>
            <?php $n++; }?>
        </tbody>
    </table>
<?php
    }else{
        echo "<p class='no_result'>'$details'</p>";
    }
    // get sum
    $get_total = new selects();
    $amounts = $get_total->fetch_sum_2dateCond('payments', 'amount_paid', 'payment_mode', 'post_date', $from, $to, 'Cash');
    foreach($amounts as $amount){
        echo "<p class='total_amount'>Total: ₦".number_format($amount->total, 2)."</p>";
    }
?>
