<div id="guest_details">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $store = $_SESSION['store'];
        // echo $user_id;
        $date = date("Y-m-d H:i:s");
    
    if(isset($_GET['guest_id'])){
        $check_id = $_GET['guest_id'];
        $get_user = new selects();
        $details = $get_user->fetch_details_cond('check_ins', 'checkin_id', $check_id);
        foreach($details as $detail){
        //get guest information
        $get_guest = new selects();
        $results = $get_guest->fetch_details_cond('guests', 'guest_id', $detail->guest);
        foreach($results as $result){
            $fullname = $result->last_name." ".$result->other_names;
            $gender = $result->gender;
        }

?>

<div class="info"></div>
<div class="displays all_details">
    <!-- <div class="info"></div> -->
    <button class="page_navs" id="back" onclick="showPage('cancel_checkin.php')"><i class="fas fa-angle-double-left"></i> Back</button>
    <h2>Guest Details</h2>
    <div class="guest_name">
        <h4>
            <?php 
                if($gender == "Male"){
                    echo "Mr. ".$fullname. " | Guest00". $detail->guest;
                /* }else if($gender == "Female" && $detail->age <= 24){
                    echo "Ms. ". $detail->last_name . " ". $detail->first_name . " | Guest00". $detail->guest_id; */
                }else{
                    echo "Ms. ". $fullname . " | Guest00". $detail->guest;
                }
            ?> 
        </h4>
        <div class="displays allResults" id="payment_det">
            <table id="guest_detail_table" class="searchTable">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Room Category</td>
                        <td>Check in date</td>
                        <td>Check out date</td>
                        <td>Days stayed</td>
                        <td>Amount Due</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td>
                            <?php 
                                $get_cat = new selects();
                                $categories = $get_cat->fetch_details_cond('items', 'item_id', $detail->room);
                                foreach($categories as $cats){
                                    $category_id = $cats->category;
                                    $item_name = $cats->item_name;
                                }
                                //get category name
                                $get_cat_name = new selects();
                                $cat_name = $get_cat_name->fetch_details_group('categories', 'category', 'category_id', $category_id);
                                echo $cat_name->category." (".$item_name.")";


                            ?>
                        </td>
                        <td><?php echo date("jS M, Y", strtotime($detail->check_in_date));?></td>
                        <td><?php echo date("jS M, Y", strtotime($detail->check_out_date));?></td>
                        <td style="text-align:center">
                            <?php 
                                $in_date = strtotime($detail->check_in_date);
                                $today = date("Y-m-d");
                                $today_date = strtotime($today);
                                $date_diff = $today_date - $in_date;
                                $days = round($date_diff / (60 * 60 * 24));
                                if($days < 0){
                                    echo "Yet to check in";
                                }else{
                                    echo $days;
                                }
                            ?>
                        </td>
                        <td style="text-align:center"><?php echo number_format($detail->amount_due, 2)?></td>
                    </tr>
                    <?php
                        $n = 2;
                        $get_checkins = new selects();
                        $datas = $get_checkins->fetch_details_negCond('check_ins', 'checkin_id', $check_id, 'sponsor', $check_id);
                        if(gettype($datas) == 'array'){
                            foreach($datas as $data){
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td>
                            <?php 
                               $get_cat = new selects();
                               $categories = $get_cat->fetch_details_cond('items', 'item_id', $data->room);
                               foreach($categories as $cats){
                                   $category_id = $cats->category;
                                   $item_name = $cats->item_name;
                               }
                                //get category name
                                $get_cat_name = new selects();
                                $cat_name = $get_cat_name->fetch_details_group('categories', 'category', 'category_id', $category_id);
                                echo $cat_name->category." (".$item_name.")";


                            ?>
                        </td>
                        <td><?php echo date("jS M, Y", strtotime($data->check_in_date));?></td>
                        <td><?php echo date("jS M, Y", strtotime($data->check_out_date));?></td>
                        <td style="text-align:center">
                            <?php 
                                $in_date = strtotime($data->check_in_date);
                                $today = date("Y-m-d");
                                $today_date = strtotime($today);
                                $date_diff = $today_date - $in_date;
                                $days = round($date_diff / (60 * 60 * 24));
                                if($days < 0){
                                    echo "Yet to check in";
                                }else{
                                    echo $days;
                                }
                            ?>
                        </td>
                        <td style="text-align:center"><?php echo number_format($data->amount_due, 2)?></td>
                    </tr>
                    <?php $n++; } } $n++; ?>
                </tbody>
            </table>
            <?php
                //get ordered items by guest
                $get_order = new selects();
                $orders = $get_order->fetch_details_cond('sales', 'customer', $check_id);
                if(gettype($orders) == 'array'){
            ?>
            <div class="ordered_items" id="ordered_items">
                <h3>Ordered items</h3>
                <table id="ordered_items" class="searchTable">
                <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Item</td>
                            <td>Quantity</td>
                            <td>Unit price</td>
                            <td>Amount</td>
                            <td>Time</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n = 1;
                            foreach($orders as $order){
                        ?>
                        <tr>
                            <td style="text-align:center; color:red;"><?php echo $n?></td>
                            <td>
                                <?php 
                                    //get item name
                                    $get_name = new selects();
                                    $names = $get_name->fetch_details_group('items', 'item_name', 'item_id', $order->item);
                                    echo strtoupper($names->item_name);
                                ?>
                            </td>
                            <td style="text-align:center; color:var(--otherColor)"><?php echo $order->quantity?></td>
                            <td><?php echo number_format($order->price, 2);?></td>
                            <td><?php echo number_format($order->total_amount, 2)?></td>
                            <td style="color:var(--otherColor)"><?php echo date("d-m-y H:ia", strtotime($order->post_date))?></td>
                            <td>
                                <a style="color:red; font-size:1rem" href="javascript:void(0) "title="return item" onclick="getGuestReturnItem('<?php echo $order->sales_id?>', <?php echo $check_id?>)"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        
                        <?php $n++; }?>
                    </tbody>
                </table>
                <?php
                    //get total of items ordered
                    $get_total = new selects();
                    $totalss = $get_total->fetch_sum_single('sales', 'total_amount', 'customer', $check_id);
                    foreach($totalss as $totals){
                        $total_amount = $totals->total;
                    }
                ?>
                <h2 style="text-align:right; font-size:1.1rem; margin:5px 0"><span style="color:#222; font-weight:bold; text-decoration:none!important">Total:</span> <?php echo "₦".number_format($total_amount, 2)?></h2>
            </div>
            <?php }?>
            <div class="payment_details">
                <h3>Payment Details</h3>
                <table id="guest_payment_table" class="searchTable">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Payment date</td>
                            <td>Amount due</td>
                            <td>Amount paid</td>
                            <td>Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n = 1;
                            $get_payment = new selects();
                            $rows = $get_payment->fetch_details_cond('payments', 'customer', $check_id);
                            if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                        ?>
                        <tr>
                            <td style="text-align:center; color:red;"><?php echo $n?></td>
                            <td>
                                <?php 
                                    echo date("jS M, Y", strtotime($row->post_date));
                                ?>
                            </td>
                            <td><?php echo number_format($row->amount_due, 2);?></td>
                            <td><?php echo number_format($row->amount_paid, 2)?></td>
                            <td>
                                <?php 
                                    $balance = $row->amount_due - $row->amount_paid - $row->discount;
                                    echo number_format($balance, 2);
                                ?>
                            </td>
                        </tr>
                        
                        <?php $n++; } }?>
                    </tbody>
                </table>
            </div>
            <div class="amount_due" style="align-items:center">
                
                <h2><span style="color:#222; font-weight:bold; text-decoration:none!important">Amount due:</span> <?php echo "₦".number_format($detail->amount_due, 2)?></h2>
            </div>
                <!-- check out and payment mode options -->
                <div class="payment_mode">
                    <?php
                        if($detail->check_out_date > $date && $detail->guest_status != -1){
                        ?>
                        <div>
                            <input type="hidden" name="check_id" id="check_id" value="<?php echo $check_id?>">
                            <input type="hidden" name="user" id="user" value="<?php echo $user_id?>">
                            <button type="submit" name="cancel_checkout" id="cancel_checkout" style="background:red" href="javascript:void(0)" class="modes" onclick="cancelCheckIn()">Cancel check in <i class="fas fa-cancel"></i></button>
                        </div>
                        <?php
                        }
                        if($detail->guest_status == 2){
                            echo "<p style='color:green; font-size:1.1rem;'>Guest has checked out <i class='fas fa-thumbs-up'></i></p>";
                        }else if($detail->guest_status == -1){
                            echo "<p style='color:red; font-size:1.1rem;'>Guest cancelled check in <i class='fas fa-thumbs-down'></i></p>";
                        }else if($detail->amount_due == 0){
                            
                    ?>
                    <div>
                        <input type="hidden" name="guest_id" id="guest_id" value="<?php echo $check_id?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id?>">
                        <button type="submit" name="check_out" id="check_out" style="background:green" href="javascript:void(0)" class="modes" onclick="checkOut()">Check out <i class="fas fa-check-double"></i></button>
                    </div>
                    <?php
                        }else{
                    ?>
                    <h3>Post Payment</h3>
                    <div class="payment_mode">
                    <div class="close_stockin add_user_form" style="width:100%; margin:0;">
                        <section class="addUserForm">
                            <div class="inputs" style="display:flex;flex-wrap:wrap">
                                <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $detail->amount_due?>">
                                <input type="hidden" name="check_in_id" id="check_in_id" value="<?php echo $check_id?>">
                                <div class="data" style="width:auto">
                                    <label for="payment_type">Payment mode</label>
                                    <select name="payment_type" id="payment_type" onchange="checkOtherMode(this.value)">
                                        <option value="" selected>Select payment type</option>
                                        <option value="Cash">CASH</option>
                                        <option value="POS">POS</option>
                                        <option value="Transfer">TRANSFER</option>
                                    </select>
                                </div>
                                <div class="data" id="amount_deposit" style="width:auto">
                                    <label id="amount_label" for="deposit">Amount paid (NGN)</label>
                                    <input type="text" name="deposits" id="deposits" value="0">
                                </div>
                                <div class="data" id="selectBank" style="width:auto">
                                    <select name="bank" id="bank">
                                        <option value=""selected>Select Bank</option>
                                        <?php
                                            $get_bank = new selects();
                                            $rows = $get_bank->fetch_details('banks', 10, 10);
                                            foreach($rows as $row):
                                        ?>
                                        <option value="<?php echo $row->bank_id?>"><?php echo $row->bank?>(<?php echo $row->account_number?>)</option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="data" style="width:auto">
                                    <button onclick="addPayment()" style="background:green; padding:8px; border-radius:5px;font-size:.8rem;">post payment <i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </section>
                    </div>
            <!-- </div> -->
                    <?php
                        }
                    ?>
                    
                </div>
                
            </div>
            <!-- paymend mode forms -->
            
            <?php
                if(gettype($details) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
            ?>
        </div>
    </div>
    
</div>
<?php
            }
        }
    }else{
        header("Location: ../index.php");
    }
?>
</div>