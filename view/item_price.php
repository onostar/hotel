<div id="edit_item_price">
<?php

    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
    }

?>

    <div class="info"></div>
    <div class="displays allResults">
        <h2>Manage other item prices</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchGuestPayment" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <table id="priceTable" class="searchTable">
            <thead>
                <tr style="background:var(--otherColor)">
                    <td>S/N</td>
                    <td>Department</td>
                    <td>item</td>
                    <td>Cost Price</td>
                    <td>Sales Price</td>
                    <td></td>
                </tr>
            </thead>

            <?php
                $n = 1;
                $select_cat = new selects();
                $rows = $select_cat->fetch_details_negCond1('items', 'department', 'Accomodation');
                if(gettype($rows) == "array"){
                foreach($rows as $row):
            ?>
            <tbody>
                <tr>
                    <td style="text-align:center;"><?php echo $n?></td>
                    
                    <td>
                        <?php 
                            echo $row->department;
                        ?>
                    </td>
                    <td><?php echo $row->item_name?></td>
                    <td>
                        <?php echo "₦ ". number_format($row->cost_price);?>
                    </td>
                    <td>
                        <?php echo "₦ ". number_format($row->sales_price);?>
                    </td>
                    <td class="prices">
                        <a style="background:var(--moreColor)!important; color:#fff!important; padding:4px; border-radius:5px;" href="javascript:void(0)" data-form="check<?php echo $row->item_id?>" class="each_prices" onclick="displayPriceForm('<?php echo $row->item_id?>');">Modify Price <i class="fas fa-pen"></i></a>
                    </td>
                </tr>
            </tbody>

            <?php $n++; endforeach; }?>
        </table>
        
        <?php
            if(gettype($rows) == "string"){
                echo "<p class='no_result'>'$rows'</p>";
            }
        ?>
    </div>
</div>