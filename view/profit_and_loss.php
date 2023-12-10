<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";


?>
<div id="revenueReport" class="displays management">
    <div class="select_date">
        <!-- <form method="POST"> -->
        <section>    
            <div class="from_to_date">
                <label>Select From Date</label><br>
                <input type="date" name="from_date" id="from_date"><br>
            </div>
            <div class="from_to_date">
                <label>Select to Date</label><br>
                <input type="date" name="to_date" id="to_date"><br>
            </div>
            <button type="submit" name="search_date" id="search_date" onclick="search('search_profit.php')">Search <i class="fas fa-search"></i></button>
</section>
    </div>
<div class="displays allResults new_data" id="revenue_report" style="width:60%">
    <hr>
    <h2 style="background:var(--otherColor); color:#fff; padding:10px;">Profit and Loss statement for "<?php echo date("jS M, Y")?>"</h2>
    <div class="profitNloss">
        <?php
            // get accounts
            $get_revenue = new selects();
            $revs = $get_revenue->fetch_sum_curdate('payments', 'amount_paid', 'date(post_date)');
            if(gettype($revs)){
                foreach($revs as $rev){
                    $revenue = $rev->total;
                }
            }
        ?>
        <div class="prof_loss">
            <div class="prof">
                <h3><i class="fas fa-money-check"></i> Revenue</h3>
            </div>
            <div class="prof">
                <p><?php echo "₦".number_format($revenue, 2)?></p>
            </div>
        </div>
        <div class="prof_loss">
            <?php
                $get_costs = new selects();
                $costs = $get_costs->fetch_revenue();
                if(gettype($costs) == 'array'){
                    foreach ($costs as $cost){
                        $cost_of_sales = $cost->total_cost;
                    }
                }
            ?>
            <div class="prof">
                <h3><i class="fas fa-coins"></i> Cost of sales</h3>
            </div>
            <div class="prof">
                <p><?php echo "₦".number_format($cost_of_sales, 2)?></p>
            </div>
        </div>
        <div class="prof_loss">
            <?php
                //get expense
                $get_exp = new selects();
                $exps = $get_exp->fetch_sum_curdate('expenses', 'amount', 'date(post_date)');
                foreach($exps as $exp){
                    $expense = $exp->total;
                }

            ?>
            <div class="prof">
                <h3><i class="fas fa-hand-holding-dollar"></i> Expense</h3>
            </div>
            <div class="prof">
                <p><?php echo "₦".number_format($expense, 2)?></p>
            </div>
        </div>
        
    </div>
        
    
    <?php

        // get net profi
        
            $total_profit = $revenue - ($cost_of_sales + $expense);
            echo "<p class='total_amount' style='background:red; color:#fff; text-decoration:none; padding:10px; width:30%; float:right'>Net Profit: ₦".number_format($total_profit, 2)."</p>";
        // }
    ?>

</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>