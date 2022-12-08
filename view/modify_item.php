<div id="edit_item_name">
<?php

    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
    }

?>

    <div class="info"></div>
    <div class="displays allResults" style="width:70%!important;">
        <h2>Modify item names</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchGuestPayment" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <table id="priceTable" class="searchTable">
            <thead>
                <tr style="background:var(--otherColor)">
                    <td>S/N</td>
                    <td>Department</td>
                    <td>Category</td>
                    <td>item</td>
                    <td></td>
                </tr>
            </thead>

            <?php
                $n = 1;
                $select_cat = new selects();
                $rows = $select_cat->fetch_details('items');
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
                    <td>
                        <?php
                            //get category
                            $get_cat = new selects();
                            $detail = $get_cat->fetch_details_group('categories', 'category', 'category_id', $row->category);
                            echo $detail->category;
                            
                        ?>
                    </td>
                    <td><?php echo $row->item_name?></td>
                    <td class="prices">
                        <a style="background:var(--moreColor)!important; color:#fff!important; padding:4px; border-radius:5px;" href="javascript:void(0)" data-form="check<?php echo $row->item_id?>" class="each_prices" onclick="modifyItemForm('<?php echo $row->item_id?>');">Modify name <i class="fas fa-pen"></i></a>
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