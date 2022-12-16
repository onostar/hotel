<?php
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";
    // session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    $item = htmlspecialchars(stripslashes($_POST['sales_item']));
    $staff = htmlspecialchars(stripslashes($_POST['staff']));
    $invoice = htmlspecialchars(stripslashes($_POST['sales_invoice']));
    $quantity = 1;
    
    //get selling price
    $get_item = new selects();
    $rows = $get_item->fetch_details_cond('items', 'item_id', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row){
            $price = $row->sales_price;
        }
    
        //insert into sales order
        $sell_item = new inserts();
        echo $item;
?>
<p><?php echo $invoice?></p>    
<p><?php echo $item?></p>    
    
<?php
         }
    }else{
        header("Location: ../index.php");
    } 
?>