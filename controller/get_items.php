<?php
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_likeCond('items', 'item_name', $item, 'department', 'Accomodation');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <option onclick="addSales('<?php echo $row->item_id?>')">
        <?php
            if($row->department == 'Bar'){
        ?>
        <?php echo $row->item_name." (Price => ₦".$row->sales_price.", Quantity => ".$row->quantity.")"?>

        <?php
            }else{
        ?>
        <?php echo $row->item_name." (Price => ₦".$row->sales_price.")"?>

        <?php }?>
    </option>
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>