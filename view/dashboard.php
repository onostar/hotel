
<div id="dashboard">
    <div class="cards" id="card4">
        <a href="javascript:void(0)" class="page_navs" onclick="showPage('guest_list.php')">
            <div class="infos">
                <p><i class="fas fa-users"></i> Current Guests</p>
                <p>
                <?php
                    $get_guest = new selects();
                    $guests = $get_guest->fetch_count_cond('check_ins', 'status', 1);
                    echo $guests;
                ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card2">
        <a href="javascript:void(0)" class="page_navs" onclick="showPage('room_list.php')">
            <div class="infos">
                <p><i class="fas fa-house"></i> Available rooms</p>
                <p>
                <?php
                    $get_room = new selects();
                    $rooms = $get_room->fetch_count_2cond('items', 'item_status', 0, 'department', 'Accomodation');
                    echo $rooms;
                ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card3">
        <a href="javascript:void(0)" onclick="showPage('revenue_report.php')">
            <div class="infos">
                <p><i class="fas fa-coins"></i> Today's Revenue</p>
                <p>
                <?php
                    $get_sales = new selects();
                    $rows = $get_sales->fetch_sum_curdate('payments', 'amount_due', 'post_date');
                    foreach($rows as $row){
                        echo "₦".number_format($row->total, 2);
                    }
                ?>
                </p>
            </div>
        </a>
    </div> 
    <!-- <div class="cards" id="card5">
        <a href="javascript:void(0)" onclick="showPage('checkin_report.php')">
            <p>Checked in today</p>
            <div class="infos">
            <i class="fas fa-coins"></i>
                <p>
                <?php
                    $get_guests = new selects();
                    $guests = $get_guests->fetch_count_curDateCon('check_ins', 'check_in_date', 'status', 0);
                    echo $guests;
                ?>
                </p>
            </div>
        </a>
    </div> --> 
    
    
</div>
<!-- check out report -->
<div class="check_out_due">
    <div class="displays allResults" id="check_out_guest">
        <!-- <div class="search">
            <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div> -->
        <h3>Guests due for checkout</h3>
        <table id="check_out_table" class="searchTable" style="width:100%;">
            <thead>
                <tr style="background:var(--moreColor)">
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>Room Category</td>
                    <td>Room</td>
                    <td>Checked In</td>
                    <td></td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_users = new selects();
                    $details = $get_users->fetch_details_dateCond('check_ins', 'status', 1);
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    <td><?php echo $detail->last_name . " ". $detail->first_name;?></td>
                    <td>
                        <?php 
                            $get_cat = new selects();
                            $categories = $get_cat->fetch_details_group('rooms', 'category', 'room_id', $detail->room);
                            $category_id = $categories->category;
                            //get category name
                            $get_cat_name = new selects();
                            $cat_name = $get_cat_name->fetch_details_group('categories', 'category', 'category_id', $category_id);
                            echo $cat_name->category;


                        ?>
                    </td>
                    <td>
                        <?php 
                            $get_room = new selects();
                            $rooms = $get_room->fetch_details_group('rooms', 'room', 'room_id', $detail->room);
                            echo $rooms->room;
                        ?>
                    </td>
                    <td><?php echo date("jS M, Y", strtotime($detail->check_in_date));?></td>
                    <td style="text-align:center"><span style="font-weight:bold; background:skyblue; border-radius:5px; text-align:Center; width:auto;padding:5px 10px;"><a href="javascript:void(0)" class="page_navs" title="View guest details" style="color:#fff" onclick="showPage('guest_details.php?guest_id=<?php echo $detail->guest_id?>')">Details</a></span></td>
                    
                </tr>
                <?php $n++; endforeach;}?>
            </tbody>
        </table>
        
        <?php
            if(gettype($details) == "string"){
                echo "<p class='no_result'>'$details'</p>";
            }
        ?>
    </div>
</div>

<?php 
    if($role === "Admin"){
?>
<!-- management summary -->
<div id="paid_receipt" class="management">
    <hr>
    <div class="daily_monthly">
        <!-- daily revenue summary -->
        <div class="daily_report allResults">
            <h3>Daily Check ins</h3>
            <table>
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Guests</td>
                        <td>Revenue</td>
                    </tr>
                </thead>
                <?php
                    $get_daily = new selects();
                    $dailys = $get_daily->fetch_daily_checkins();
                    if(gettype($dailys) == "array"){
                    foreach($dailys as $daily):

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $n?></td>
                        <td><?php echo date("jS M, Y",strtotime($daily->check_in_date))?></td>  
                        <td style="text-align:center"><?php echo $daily->customers?></td>
                        <td><?php echo "₦".number_format($daily->revenue)?></td>
                    </tr>
                </tbody>
                <?php $n++; endforeach; }?>

                
            </table>
            <?php
                if(gettype($dailys) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
            ?>
        </div>
        <!-- monthly revenue summary -->
        <div class="monthly_report allResults">
            <h3>Monthly Check ins</h3>
            <table>
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Month</td>
                        <td>Check ins</td>
                        <td>Daily Average</td>
                    </tr>
                </thead>
                <?php
                    $n =1;
                    $get_monthly = new selects();
                    $monthlys = $get_monthly->fetch_monthly_checkins();
                    if(gettype($monthlys) == "array"){
                    foreach($monthlys as $monthly):

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $n?></td>
                        <td><?php echo date("M, Y", strtotime($monthly->check_in_date))?></td>
                        <td style="text-align:center"><?php echo $monthly->customers?></td>
                        <td style="text-align:center"><?php
                            $average = $monthly->arrivals/$monthly->daily_average;
                            echo intVal($average);
                        ?></td>
                    </tr>
                </tbody>
                <?php $n++; endforeach; }?>

                
            </table>
            <?php 
                if(gettype($monthlys) == "string"){
                    echo "<p class='no_result'>'$monthlys'</p>";
                }
            ?>
        </div>
        
    </div>
</div>

<?php }?>