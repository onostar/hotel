<?php
    session_start();

    include "../classes/dbh.php";
    include "../classes/select.php";

    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        // instantiate classes
        $fetch_user = new selects();
        $users = $fetch_user->fetch_details_cond('users', 'username', $username);
        foreach($users as $user){
            $fullname = $user->full_name;
            $role = $user->user_role;
            $user_id = $user->user_id;
        }
        $_SESSION['user_id'] = $user_id;

        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Hotel, Lodging, Accomodation, lounge, bar, hotel software, lodging and accomodation software, accounting, hotel software">
    <meta name="description" content="An online/offline hotel and lodging software management system. Developed for the management of guests check in, check out, bills, restaurant, etc">
    <title>Hotel management system </title>
    <link rel="icon" type="image/png" size="32x32" href="../images/logo.png">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <header>
            <h1 class="logo">
                <a href="users.php" title="Logistics">
                    <img src="../images/logo.png" alt="Logo" class="img-fluid">
                </a>
            </h1>
            <h2>Demo Hotels and Suites</h2>
            <!-- <div class="other_menu">
                <a href="#" title="Our Gallery"><?php echo ucwords($role);?></a>
            </div> -->
            <a href="#" title="my role" class="other_menu"><?php echo ucwords($role);?></a>

            <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> <?php echo ucwords($fullname);?> <i class="fas fa-chevron-down"></i></button>
                
                <div class="login_option">
                    <div>
                        <a class="password_link page_navs" href="javascript:void(0)" data-page="update_password" onclick="showPage('update_password.php')">Change password <i class="fas fa-key"></i></a>
                        <button id="loginBtn"><a href="../controller/logout.php">Log out <i class="fas fa-power-off"></i></a></button>
                    </div>
                </div>
            </div>
            <div class="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div>
        </header>
        <div class="admin_main">
            
            <!-- side menu -->
            <?php include "side_menu.php"?>
            <!-- main contents -->
            <section id="contents">
                <!-- quick links -->
                <div id="quickLinks">
                    <div class="quick_links">
                        <div class="links page_navs" onclick="showPage('check_in.php')" title="Check in Guest">
                            <i class="fas fa-pen-alt"></i>
                            <p>Check in</p>
                        </div>
                        <div class="links page_navs" onclick="showPage('guest_payment.php')" title="New Guest payment">
                            <i class="fas fa-hand-holding-dollar"></i>
                            <p>New Guest Payment</p>
                        </div>
                        <div class="links page_navs" onclick="showPage('other_payment.php')" title="Post other payments">
                            <i class="fas fa-money-check"></i>
                            <p>Other Payments</p>
                        </div>
                        <div class="links page_navs" onclick="showPage('check_out.php')" title="Check out guest">
                            <i class="fas fa-door-open"></i>
                            <p>Check out guest</p>
                        </div>
                        <div class="links page_navs" onclick="showPage('cancel_checkin.php')" title="Cancel guest checkin">
                            <i class="fas fa-power-off"></i>
                            <p>Cancel checkin</p>
                        </div>
                    </div>
                </div>
                <div class="quick_links">

                </div>
                <div class="contents">

                    <?php
                        if(isset($_SESSION['success'])){
                            echo "<div class='success'>".
                                $_SESSION['success'].
                            "</div>";
                            unset($_SESSION['success']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<div class='error'>".
                                $_SESSION['error'].
                            "</div>";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <!-- dashboard -->
                    <?php include "dashboard.php"?>
                </div>
            </section>
        </div>
    </main>
    
    <script src="../jquery.js"></script>
    <script src="../jquery.table2excel.js"></script>
    <script src="../script.js"></script>
    <script>
        
            setTimeout(function(){
                $(".success").hide();
            }, 4000);
            setTimeout(function(){
                $(".error").hide();
            }, 4000);

            /* let today = new Date();
            alert(today.toLocaleDateString()); */
    </script>
</body>
</html>


<?php
    }else{
        header("Location: ../index.php");
    }

?>