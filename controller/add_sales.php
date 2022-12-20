<?php
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";
    // session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        if(isset($_SESSION['invoice'])){
            $invoice = $_SESSION['invoice'];
        }
        if(isset($_SESSION['staff'])){
            $staff = $_SESSION['staff'];
        }
        if(isset($_GET['sales_item'])){
            $item = $_GET['sales_item'];
        }

    $quantity = 1;
    
    //get selling price
    $get_item = new selects();
    $rows = $get_item->fetch_details_cond('items', 'item_id', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row){
            $price = $row->sales_price;
            $name = $row->item_name;
            $department = $row->department;
            $qty = $row->quantity;
        }
            if($department == "Bar" && $qty == 0){
                echo "<p style='color:red'>$name has zero quantity! Cannot proceed</p>";
            }else if($price == 0){
                echo "<p style='color:red'>$name does not have selling price! Cannot proceed</p>";
            }else{
                //insert into sales order
                $sell_item = new post_sales($item, $staff, $invoice, $quantity, $price, $user_id);
                $sell_item->add_sales();
                if($sell_item){

        ?>
<!-- display sales for this invoice number -->
<div class="displays allResults" id="stocked_items">
    <h2>Items in sales order</h2>
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
                    <?php echo $detail->quantity?>
                    <a style="color:#fff; background:green;border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="increase quantity" onclick="increaseQty('<?php echo $detail->item?>')"><i class="fas fa-arrow-up"></i></a>
                    <a style="color:#fff; background:var(--primaryColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="decrease quantity" onclick="reduceQty('<?php echo $detail->item?>')"><i class="fas fa-arrow-down"></i></a>
                </td>
                <td>
                    <?php 
                        echo "₦".number_format($detail->price, 2);
                    ?>
                </td>
                <td>
                    <?php 
                        $item_total = $detail->quantity * $detail->price;
                        echo "₦".number_format($item_total, 2);
                    ?>
                </td>
                <td>
                    <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deleteSales('<?php echo $detail->sales_id?>', <?php echo $detail->item?>)"><i class="fas fa-trash"></i></a>
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
        $amounts = $get_total->fetch_sum_2con('sales', 'price', 'quantity', 'staff', 'invoice', $staff, $invoice);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }
        // $total_worth = $total_amount * $total_qty;
        echo "<p class='total_amount' style='color:green'>Total Due: ₦".number_format($total_amount, 2)."</p>";
    ?>
    <div class="close_stockin">
        <button onclick="postSales()" style="background:red; padding:8px; border-radius:5px;">Save and Print <i class="fas fa-power-off"></i></button>
    </div>
</div>    

<?php
                }
            }
?>
   
    
<?php
         }
    }else{
        header("Location: ../index.php");
    } 
?>