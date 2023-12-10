<?php
    session_start();
    // $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    
?>
<hr>
    <h2 style="background:var(--otherColor); color:#fff; padding:10px;">Profit and Loss statement between "<?php echo date("jS M, Y", strtotime($from))?>" AND "<?php echo date("jS M, Y", strtotime($to))?>"</h2>
    <div class="profitNloss">
        <?php
            // get accounts
            $get_revenue = new selects();
            $revs = $get_revenue->fetch_sum_2date('payments', 'amount_paid', 'date(post_date)', $from, $to);
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
                //cost of sales
                $get_costs = new selects();
                $costs = $get_costs->fetch_revenueDate($from, $to);
                foreach($costs as $cost){
                    $cost_of_sales = $cost->total_cost;
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
                $exps = $get_exp->fetch_sum_2date('expenses', 'amount', 'date(post_date)', $from, $to);
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
    // get net profit
        $total_profit = $revenue - ($cost_of_sales + $expense);
        echo "<p class='total_amount' style='background:red; color:#fff; text-decoration:none; padding:10px; width:30%; float:right'>Net Profit: ₦".number_format($total_profit, 2)."</p>";
    // }
?>
