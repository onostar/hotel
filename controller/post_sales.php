<?php
session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/update.php";
include "../classes/select.php";
    // session_start();
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];
        if(isset($_GET['invoice'])){
            $invoice = $_GET['invoice'];
        
        //update all items with this invoice
        $update_invoice = new Update_table();
        $update_invoice->update('sales', 'sales_status', 'invoice', $invoice, 1);
            if($update_invoice){
                //update quantity of the items in inventory
                //get all items first in the invoice
                $get_items = new selects();
                $rows = $get_items->fetch_details_cond('sales', 'invoice', $invoice);
                
                foreach($rows as $row){
                    //update individual quantity in inventory
                    //get item department
                    $get_dep = new selects();
                    $deps = $get_dep->fetch_details_group('items', 'department', 'item_id', $row->item);
                    if($deps->department == "Bar"){
                    $update_qty = new Update_table();
                    $update_qty->update_inv_qty($row->quantity, $row->item);
                    }
                }
                //  if($update_qty){
                    // print out items bought
?>
       <div class="displays allResults" id="sales_receipt">
    <h2>Demo Hotels and suites</h2>
    <h3><?php echo $invoice?></h3>
    <table id="postsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Item name</td>
                <td>Quantity</td>
                <td>Unit sales</td>
                <td>Amount</td>
                
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
                <td style="text-align:center; color:red;font-size:1.1rem"><?php echo $detail->quantity?>
                    
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

        //sold by
        $get_seller = new selects();
        $row = $get_seller->fetch_details_group('users', 'full_name', 'user_id', $user);
        echo ucwords("<p class='sold_by'>Sold by: <strong>$row->full_name</strong></p>");
    ?>
    
</div> 
   
<?php
    echo "<script>window.print();</script>";
                    // }
                // }
            }
        }
    }else{
        header("Location: ../index.php");
    } 
?>