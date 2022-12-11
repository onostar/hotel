<?php

    
    $posted = htmlspecialchars(stripslashes($_POST['posted_by']));
    $item = htmlspecialchars(stripslashes($_POST['item_id']));
    $supplier = htmlspecialchars(stripslashes($_POST['supplier']));
    $invoice = htmlspecialchars(stripslashes($_POST['invoice_number']));
    $quantity = htmlspecialchars(stripslashes($_POST['quantity']));
    $cost_price = htmlspecialchars(stripslashes($_POST['cost_price']));
    $sales_price = htmlspecialchars(stripslashes($_POST['sales_price']));
    $expiration = htmlspecialchars(stripslashes($_POST['expiration_date']));
    // $guest_id = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

    //instantiate classes
    include "../classes/dbh.php";
    include "../classes/inserts.php";
    include "../classes/update.php";
    include "../classes/select.php";
    $stock_in = new stockins($item, $supplier, $invoice, $quantity, $cost_price, $sales_price, $expiration, $posted);

    $stock_in->stockin();
    if($stock_in){
        $update_item = new Update_table();
        $update_item->update_quantity($cost_price, $sales_price, $quantity, $item);
        if($update_item){

?>
    <!-- display stockins for this invoice number -->
<div class="displays allResults" id="stocked_items">
    <h2>Items stocked in with invoice <?php echo $invoice?></h2>
    <table id="stock_items_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Item name</td>
                <td>Quantity</td>
                <td>Unit cost</td>
                <td>Unit sales</td>
                <td>Expiration</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_2cond('purchases', 'vendor', 'invoice', $supplier, $invoice);
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
                <td style="text-align:center"><?php echo $detail->quantity?></td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->cost_price, 2);
                    ?>
                </td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->sales_price, 2);
                    ?>
                </td>
                <td><?php echo $detail->expiration_date?></td>
                <td>
                    <section>
                        <input type="hidden" name="purchase_id" id="purchase_id" value="<?php echo $detail->purchase_id?>">
                        <input type="hidden" name="purchase_item" id="purchase_item" value="<?php echo $detail->item?>">
                        <button type="submit" name="del_purchase" id="del_purchase" style="background:none; box-shadow:none!important; border:none" title="delete purchase" onclick="deletePurchase()"><i class="fas fa-trash" style="color:red; font-size:1rem;"></i></buton>
                    </section>
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
        $amounts = $get_total->fetch_sum_2con('purchases', 'cost_price', 'quantity', 'vendor', 'invoice', $supplier, $invoice);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }
        // $total_worth = $total_amount * $total_qty;
        echo "<p class='total_amount' style='color:red'>Total Cost: ₦".number_format($total_amount, 2)."</p>";
    ?>
    <div class="close_stockin">
        <button onclick="closeStockin()" style="background:red; padding:8px; border-radius:5px;">Close stockin <i class="fas fa-power-off"></i></button>
    </div>
</div>
<?php
        }
    }

?>