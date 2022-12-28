<div id="create_bill">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
    
    if(isset($_GET['staff_id'])){
        $staff = $_GET['staff_id'];
        $_SESSION['staff'] = $staff;

    


?>
<div id="sales_form" class="displays all_details">
    <?php
        //generate receipt invoice
        $random_num = mt_rand(10000000, 99999999);
        $invoice = "wk00".$staff.$random_num;
        $_SESSION['invoice'] = $invoice;
    ?>
    
    <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
        <h3 style="background:var(--primaryColor); color:#ff; text-align:left!important;" >Sales order <?php echo $invoice?></h3>
        

        <!-- select item category -->

        <div class="item_categories">
            <!-- buttons -->
            <!-- <button id="bar_btn" onclick="showBar()">Bar Items <i class="fas fa-beer"></i></button>
            <button id="res_btn" onclick="showRestaurant()">Restaurant Items <i class="fas fa-utensils"></i></button> -->

            <!-- search forms -->
        <!-- <form method="POST" id="addUserForm"> -->
            <section class="addUserForm">
                <div class="inputs">
                    <!-- bar items form -->
                    <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                        <label for="item"> Search Items</label>
                        <input type="hidden" name="sales_invoice" id="sales_invoice" value="<?php echo $invoice?>">
                        <input type="hidden" name="staff" id="staff" value="<?php echo $staff?>">
                        <input type="text" name="item" id="item" required placeholder="Input item name" onkeyup="getItems(this.value)">
                        <div id="sales_item">
                            
                        </div>
                    </div>
                    <!-- restaurant item form -->
                    <!-- <div class="data diff_cats" id="restaurant_items" style="width:100%; margin:10px 0">
                        <label for="item"> Search Restaurant Items</label>
                        <input type="text" name="item" id="item" list="suggestions" required placeholder="Input item name" oninput="displayStockinForm()">
                        <datalist id="suggestions">
                            <?php
                                $get_item = new selects();
                                $rows = $get_item->fetch_details_cond('items', 'department', 'Restaurant');
                                foreach($rows as $row){
                            ?>
                            <option value="<?php echo $row->item_name?>"><?php echo $row->item_name?></option>
                            <?php } ?>
                        </datalist>
                    </div> -->
                </div>
                
            </section>
            
        </div>
    </div>

</div>
<div class="show_more"></div>
<div class="sales_order">

</div>
<?php
    }
    }else{
        header("Location: ../index.php");
    }
?>
</div>