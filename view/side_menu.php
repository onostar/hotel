<aside class="main_menu" id="mobile_log">
    <div class="login">
        <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
        <div class="login_option">
            <div>
                <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                <!-- <h3>OR</h3>
                <a href="registration.php" id="signupBtn">Member Registration</a> -->
            </div>
        </div>
    </div>
    <nav>
        <h3><a href="users.php" title="Home"><i class="fas fa-home"></i> Dashboard</a></h3>
        <ul>
            <?php if($role == "Admin"){?>

            <li><a href="javascript:void(0);" class="allMenus" title="Administrator Setup menu" id="adminMenu"><span><i class="fas fa-gem"></i> Admin menu</span> <span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu adminMenu">   
                    <li><a href="javascript:void(0);" title="Add users" class="page_navs" onclick="showPage('add_user.php')"><i class="fas fa-user-plus"></i> Add Users</a></li>
                    <li><a href="javascript:void(0);" title="Disable users" class="page_navs" onclick="showPage('disable_user.php')"><i class="fas fa-user-slash"></i> Disable user</a></li>
                    <li><a href="javascript:void(0);" title="Activate users" class="page_navs" onclick="showPage('activate_user.php')"><i class="fas fa-user-check"></i> Activate user</a></li>
                    <li><a href="javascript:void(0);" title="Add departments" class="page_navs" onclick="showPage('add_department.php')"><i class="fas fa-layer-group"></i> Add Departments</a></li>
                    <li><a href="javascript:void(0);" title="Add categories" class="page_navs" onclick="showPage('add_category.php')"><i class="fas fa-layer-group"></i> Add Categories</a></li>
                    <li><a href="javascript:void(0);" title="Add sales representatives" class="page_navs" onclick="showPage('add_staff.php')"><i class="fas fa-user-tie"></i> Add Sales Rep</a></li>
                    <li><a href="javascript:void(0);" title="Create items" class="page_navs" onclick="showPage('add_item.php')"><i class="fas fa-gift"></i> Add Items</a></li>
                    <li><a href="javascript:void(0);" title="modify item names" class="page_navs" onclick="showPage('modify_item.php')"><i class="fas fa-folder"></i> Modify Items</a></li>
                    <li><a href="javascript:void(0);" title="Add banks" class="page_navs" onclick="showPage('add_bank.php')"><i class="fas fa-bank"></i> Add Bank</a></li>
                    <li><a href="javascript:void(0);" title="Edit room prices" class="page_navs" onclick="showPage('room_price.php')"><i class="fas fa-tags"></i> Manage room prices</a></li>
                    <li><a href="javascript:void(0);" title="manage other item prices" class="page_navs" onclick="showPage('item_price.php')"><i class="fas fa-tags"></i> Manage item prices</a></li>
                </ul>
            </li>

            <?php }?>
            <li><a href="javascript:void(0);" class="allMenus" title="Front desk menu" data-menu="frontDesk" id="frontDesk"><span><i class="fas fa-gem"></i> Front Desk </span><span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu frontDesk">
                    <li><a href="javascript:void(0);" title="Check in guest" class="page_navs" onclick="showPage('check_in.php')"><i class="fas fa-right-to-bracket"></i> Check in guest</a></li>
                    <li><a href="javascript:void(0);" title="Check out guest" class="page_navs" onclick="showPage('check_out.php')"><i class="fas fa-door-open"></i> Check out guest</a></li>
                    <li><a href="javascript:void(0);" title="Cancel guest checkin" class="page_navs" onclick="showPage('cancel_checkin.php')"><i class="fas fa-power-off"></i> Cancel check in</a></li>
                    <li><a href="javascript:void(0);" title="Extend guest stay" class="page_navs" onclick="showPage('extend_stay.php')"><i class="fa-solid fa-calendar-plus"></i> Extend stay</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="allMenus" title="payment menu" data-menu="payments" id="payments"><span><i class="fas fa-gem"></i> BIlls & Payments</span><span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu payments">
                    <li><a href="javascript:void(0);" title="Create new bill" class="page_navs" onclick="showPage('new_bill.php')"><i class="fas fa-clipboard"></i> Create new bill</a></li>
                    <li><a href="javascript:void(0);" title="Add to exisiting bill" class="page_navs" onclick="showPage('add_to_bill.php')"><i class="fas fa-clipboard"></i> Add to bill</a></li>
                    <li><a href="javascript:void(0);" title="Guest payments" class="page_navs" onclick="showPage('guest_payment.php')"><i class="fas fa-money-check-dollar"></i> New Guest payment</a></li>
                    <li><a href="javascript:void(0);" title="Add payments" class="page_navs" onclick="showPage('other_payment.php')"><i class="fas fa-hand-holding-dollar"></i> Make payment</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="allMenus" title="Inventory menu" data-menu="inventory" id="inventory"><span><i class="fas fa-gem"></i> Inventory </span><span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu inventory">
                    <li><a href="javascript:void(0);" title="Stock balance" class="page_navs" onclick="showPage('stock_balance.php')"><i class="fas fa-database"></i> Stock balance</a></li>
                    <li><a href="javascript:void(0);" title="Stockin items purchased" class="page_navs" onclick="showPage('stockin_purchase.php')"><i class="fas fa-cart-plus"></i> Stockin purchases</a></li>
                    <li><a href="javascript:void(0);" title="Add a supplier purchased" class="page_navs" onclick="showPage('add_vendor.php')"><i class="fas fa-user-tie"></i> Add supplier</a></li>
                    <li><a href="javascript:void(0);" title="Adjust item quantity" class="page_navs" onclick="showPage('stock_adjustment.php')"><i class="fas fa-folder"></i> Adjust Quantity</a></li>
                    
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="allMenus" title="General Reports" data-menu="reports" id="reports"><span><i class="fas fa-gem"></i> Reports </span><span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu reports">
                    <li><a href="javascript:void(0);" title="List of rooms" class="page_navs" onclick="showPage('room_list.php')"><i class="fas fa-list-check"></i> Room List</a></li>
                    <li><a href="javascript:void(0);" title="List of bar items" class="page_navs" onclick="showPage('bar_items.php')"><i class="fas fa-beer"></i> Bar items</a></li>
                    <li><a href="javascript:void(0);" title="List of restaurant items" class="page_navs" onclick="showPage('restaurant_items.php')"><i class="fas fa-utensils"></i> Restaurant items</a></li>
                    <li><a href="javascript:void(0);" title="List of banks" class="page_navs" onclick="showPage('Bank_list.php')"><i class="fas fa-bank"></i> Bank List</a></li>
                    <li><a href="javascript:void(0);" title="List of suppliers" class="page_navs" onclick="showPage('vendor_list.php')"><i class="fas fa-users"></i> List of suppliers</a></li>
                    <li><a href="javascript:void(0);" title="List of staffs" class="page_navs" onclick="showPage('staff_list.php')"><i class="fas fa-user-tie"></i> Staff List</a></li>
                    <li><a href="javascript:void(0);" title="List of rooms" class="page_navs" onclick="showPage('guest_list.php')"><i class="fas fa-users"></i> Current guest List</a></li>
                    <li><a href="javascript:void(0);" title="Check in report" class="page_navs" onclick="showPage('checkin_report.php')"><i class="fas fa-gauge"></i> Check in report</a></li>
                    <li><a href="javascript:void(0);" title="Guest check out report" class="page_navs" onclick="showPage('check_out_report.php')"><i class="fas fa-door-open"></i> Check out report</a></li>
                    <li><a href="javascript:void(0);" title="Report on rooms" class="page_navs" onclick="showPage('room_reports.php')"><i class="fas fa-home"></i> Room reports</a></li>
                    <li><a href="javascript:void(0);" title="Purchase reports" class="page_navs" onclick="showPage('purchase_reports.php')"><i class="fas fa-shopping-cart"></i> Purchase reports</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="allMenus" title="Financial Reports" data-menu="financial_reports" id="financial_reports"><span><i class="fas fa-gem"></i> Financial Reports </span><span class="second_icon"><i class="fas fa-chevron-down more_option"></i></span></a>
                <ul class="subMenu financial_reports">
                    <li><a href="javascript:void(0);" title="Revenue report" class="page_navs" onclick="showPage('revenue_report.php')"><i class="fas fa-coins"></i> Revenue report</a></li>
                    <li><a href="javascript:void(0);" title="Cash list report" class="page_navs" onclick="showPage('cash_list.php')"><i class="fas fa-money-check"></i> Cash Revenue list</a></li>
                    <li><a href="javascript:void(0);" title="Transfer list report" class="page_navs" onclick="showPage('pos_list.php')"><i class="fas fa-money-check"></i> Pos Revenue list</a></li>
                    <li><a href="javascript:void(0);" title="Transfer list report" class="page_navs" onclick="showPage('transfer_list.php')"><i class="fas fa-wifi"></i> Transfer Revenue list</a></li>
                    
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<aside class="mobile_menu" id="mobile_log">
    <div class="login">
        <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
        <div class="login_option">
            <div>
                <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                <!-- <h3>OR</h3>
                <a href="registration.php" id="signupBtn">Member Registration</a> -->
            </div>
        </div>
    </div>
    <nav>
        <h3><a href="users.php" title="Home"><i class="fas fa-home"></i> Dashboard</a></h3>
        <ul>        
            
            
        </ul>
    </nav>
</aside>