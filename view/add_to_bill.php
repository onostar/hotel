<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        if(isset($_GET['invoice'])){
            $invoice = $_GET['invoice'];
       

?>
<div id="sales_order">
<div id="sales_form" class="displays all_details">
    <?php
       
        // $_SESSION['invoice'] = $invoice;
    ?>
    
    <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
        <h3 style="background:var(--otherColor); color:#ff; text-align:left!important;" >Add order to invoice <?php echo $invoice?></h3>
        
            <!-- search forms -->
        <!-- <form method="POST" id="addUserForm"> -->
            <section class="addUserForm">
                <div class="inputs">
                    <!-- bar items form -->
                    <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                        <label for="item"> Search Items</label>
                        <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>">
                        <input type="hidden" name="staff" id="staff" value="<?php echo $staff?>">
                        <input type="text" name="item" id="item" required placeholder="Input item name or barcode" onkeyup="getItemsOrder(this.value)">
                        <div id="sales_item">
                            
                        </div>
                    </div>
                    
                </div>
            </section>
            
        </div>
    </div>

</div>
<!-- for editing item quantitiy and price -->
<div class="show_more"></div>
<!-- showing all items in the sales order -->
<div class="sales_order"></div>
<?php
        }
    }else{
        header("Location: ../index.php");
    }
?>
</div>