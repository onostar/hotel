<?php
        $sales = $_GET['sales_id'];
        $item = $_GET['item_id'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/update.php";
        // check item current quantity in database
        $check_qty = new selects();
        $qty = $check_qty->fetch_details_group('items', 'quantity', 'item_id', $item);
        $current_qty = $qty->quantity;
        // check item current quantity in sales order
        $check_salesqty = new selects();
        $qtys = $check_salesqty->fetch_details_group('sales', 'quantity', 'sales_id', $sales);
        $sales_qty = $qtys->quantity;
        //get invoice
        $get_invoice = new selects();
        $rows = $get_invoice->fetch_details_group('sales', 'invoice', 'sales_id', $sales);
        $invoice = $rows->invoice;
        // echo $sales_qty;
        if($sales_qty == $current_qty){
            echo "<script>alert('Available quantity is less than required!');
            </script>";
?>
<!-- display items with same invoice number -->
<div class="displays allResults" id="stocked_items">
    <!-- <h2>Items in sales order</h2> -->
    <table id="addsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Item name</td>
                <td>Quantity</td>
                <td>Unit sales</td>
                <td>Amount</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('sales','invoice', $invoice);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get category name
                        $get_item_name = new selects();
                        $item_name = $get_item_name->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $item_name->item_name;
                    ?>
                </td>
                <td style="text-align:center; color:red;font-size:1,1rem">
                    <span style="font-size:1.2rem; margin:0 2px"><?php echo $detail->quantity?></span>
                    <a style="color:#fff; background:green;border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="increase quantity" onclick="increaseQty('<?php echo $detail->sales_id?>', '<?php echo $detail->item?>')"><i class="fas fa-arrow-up"></i></a>
                    <a style="color:#fff; background:var(--primaryColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="decrease quantity" onclick="reduceQty('<?php echo $detail->sales_id?>')"><i class="fas fa-arrow-down"></i></a>
                    <a style="color:#fff; background:var(--otherColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="show more options" onclick="showMore('<?php echo $detail->sales_id?>')"><i class="fas fa-chevron-up"></i></a>

                </td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->price, 2);
                    ?>
                </td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->total_amount, 2);
                    ?>
                </td>
                <td>
                    <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deleteSales('<?php echo $detail->sales_id?>', '<?php echo $detail->item?>')"><i class="fas fa-trash"></i></a>
                </td>
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>

    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }

        // get sum
        $get_total = new selects();
        $amounts = $get_total->fetch_sum_con('sales', 'price', 'quantity', 'invoice', $invoice);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }
        // $total_worth = $total_amount * $total_qty;
        echo "<p class='total_amount' style='color:green'>Total Due: ₦".number_format($total_amount, 2)."</p>";
    ?>
    <div class="close_stockin">
        <button onclick="postSales('<?php echo $invoice?>')" style="background:red; padding:8px; border-radius:5px;">Save and Print <i class="fas fa-print"></i></button>
    </div>
</div>
<?php            
        }else{
        //update quantity
        $update = new Update_table();
        $update->increase_qty(1, $sales);
        if($update){
        //update total amount
        // check item new quantity in sales order
        $check_itemqty = new selects();
        $shows = $check_itemqty->fetch_details_cond('sales', 'sales_id', $sales);
        foreach($shows as $show){
            $new_qty = $show->quantity;
            $unit_price = $show->price;
        }
        $total_price = $new_qty * $unit_price;
        $update_total = new Update_table();
        $update_total->update('sales', 'total_amount', 'sales_id', $total_price, $sales);
        if($update_total){
?>
<!-- display items with same invoice number -->
<div class="displays allResults" id="stocked_items">
    <!-- <h2>Items in sales order</h2> -->
    <table id="addsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Item name</td>
                <td>Quantity</td>
                <td>Unit sales</td>
                <td>Amount</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('sales','invoice', $invoice);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get category name
                        $get_item_name = new selects();
                        $item_name = $get_item_name->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $item_name->item_name;
                    ?>
                </td>
                <td style="text-align:center; color:red;font-size:1,1rem">
                    <span style="font-size:1.2rem; margin:0 2px"><?php echo $detail->quantity?></span>
                    <a style="color:#fff; background:green;border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="increase quantity" onclick="increaseQty('<?php echo $detail->sales_id?>', '<?php echo $detail->item?>')"><i class="fas fa-arrow-up"></i></a>
                    <a style="color:#fff; background:var(--primaryColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="decrease quantity" onclick="reduceQty('<?php echo $detail->sales_id?>')"><i class="fas fa-arrow-down"></i></a>
                    <a style="color:#fff; background:var(--otherColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="show more options" onclick="showMore('<?php echo $detail->sales_id?>')"><i class="fas fa-chevron-up"></i></a>

                </td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->price, 2);
                    ?>
                </td>
                <td>
                    <?php 
                        
                        echo "₦".number_format($detail->total_amount, 2);
                    ?>
                </td>
                <td>
                    <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deleteSales('<?php echo $detail->sales_id?>', '<?php echo $detail->item?>')"><i class="fas fa-trash"></i></a>
                </td>
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>

    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }

        // get sum
        $get_total = new selects();
        $amounts = $get_total->fetch_sum_con('sales', 'price', 'quantity', 'invoice', $invoice);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }
        // $total_worth = $total_amount * $total_qty;
        echo "<p class='total_amount' style='color:green'>Total Due: ₦".number_format($total_amount, 2)."</p>";
    ?>
    <div class="close_stockin">
        <button onclick="postSales('<?php echo $invoice?>')" style="background:red; padding:8px; border-radius:5px;">Save and Print <i class="fas fa-print"></i></button>
    </div>
</div>    
<?php
            }            
        }
    }
?>