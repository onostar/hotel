<?php

    if (isset($_GET['item'])){
        $sales = $_GET['item'];
    

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_cond('sales', 'sales_id', $sales);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        //get item details from item table
        $get_item = new selects();
        $details = $get_item->fetch_details_cond('items', 'item_id', $row->item);
        foreach($details as $detail){
            // $item_price = $detail->sales_price;
            $item_qty = $detail->quantity;
            $dept = $detail->department;
        }
        
    ?>
    <div class="add_user_form priceForm" style="width:80%; padding:0!important">
        
        <section class="addUserForm" style="text-align:left; padding:5px; margin:0; width:100%;">
            <div class="inputs">
                <div class="data item_head" style="width:auto;background:var(--secondaryColor)">
                    <h4 title="available quantity"><?php echo $item_qty?></h4>
                    <input type="hidden" name="sales_id" id="sales_id" value="<?php echo $row->sales_id?>" required>
                    <input type="hidden" name="inv_qty" id="inv_qty" value="<?php echo $item_qty?>" required>
                </div>
                <div class="data" style="width:20%">
                    <label for="qty">Qty</label>
                    <input type="text" name="qty" id="qty" value="<?php echo $row->quantity?>">
                </div>
                <div class="data" style="width:20%">
                    <label for="price">Unit price (NGN)</label>
                    <input type="text" name="price" id="price" value="<?php echo $row->price?>">
                </div>
                <div class="data" style="width:20%">
                    <label for="total_amount">Total Amount (NGN)</label>
                    <input type="text" name="total_amount" id="total_amount" value="<?php echo $row->total_amount?>" readonly>
                </div>
                <div class="data" style="width:20%">
                    <button type="submit" id="change_price" name="change_price" onclick="updatePriceQty()"><i class="fas fa-check-double"></i></button>
                    <a href="javascript:void(0)" title="close form" style='background:red; padding:10px; border-radius:5px; color:#fff' onclick="closeForm()"><i class='fas fa-cancel'></i></a>
                </div>
            </div>
        </section>   
    </div>
    
<?php
    endforeach;
     }
    }    
?>