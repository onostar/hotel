<?php

    include "../classes/dbh.php";
    include "../classes/select.php";


?>
<div id="create_bill">
    <div class="displays" id="bill_types">
        <button id="walkin" class="bill_type" title="Walk in customers" onclick="showWalkin();"><i class="fas fa-users"></i> Walk in Customers</button>
        <button id="existing" class="bill_type" title="Checked in guest" onclick="showGuest();"><i class="fas fa-user-tie"></i> Add to Guests bill</button>
    </div>
    <div class="displays allResults create_bills" id="walkin_customers">
        <h2>Select a sales representative</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchStaff" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <table id="room_list_table" class="searchTable">
            <thead>
                <tr style="background:var(--moreColor)">
                    <td>S/N</td>
                    <td>Staff id</td>
                    <td>Staff name</td>
                    <td>Phone number</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_details = new selects();
                    $details = $get_details->fetch_details('staffs');
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    <td><?php echo "00".$detail->staff_id?></td>
                    <td><?php echo $detail->staff_name?></td>
                    <td><?php echo $detail->phone_number?></td>
                    <td class="prices">
                        <a style="background:var(--otherColor)!important; color:#fff!important; padding:5px; border-radius:5px;" href="javascript:void(0)" class="each_prices" onclick="showPage('create_bill.php?staff_id=<?php echo $detail->staff_id?>')"><i class="fas fa-clipboard"></i> Create Bill</a>
                    </td>
                    
                    
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
    <div class="displays allResults create_bills" id="existing_guests">
        <h2>Current Checked in Guests</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchGuestPayment" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <table id="guest_payment_table" class="searchTable">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>Room</td>
                    <td>Phone Number</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_users = new selects();
                    $details = $get_users->fetch_details_cond('check_ins', 'status', 1);
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    <td style="color:green;"><?php echo $detail->last_name . " ". $detail->first_name;?></td>
                    <td>
                        <?php 
                            $get_room = new selects();
                            $rooms = $get_room->fetch_details_group('rooms', 'room', 'room_id', $detail->room);
                            echo $rooms->room;
                        ?>
                    </td>
                    <td><?php echo $detail->contact_phone?></td>
                    <td style="text-align:center"><span style="font-weight:bold; background:skyblue; border-radius:5px; text-align:Center; width:auto;padding:5px 10px;"><a href="javascript:void(0)" class="page_navs" title="Create bill" style="color:#fff" onclick="showPage('create_bill.php?guest_id=<?php echo $detail->guest_id?>')"><i class="fas fa-clipboard"></i> Create Bill</a></span></td>
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