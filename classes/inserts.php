<?php
    session_start();
    class inserts extends Dbh{
        //check user exists method
        protected function checkUser($username){
            $check_user = $this->connectdb()->prepare("SELECT * FROM users WHERE username = :username");
            $check_user->bindValue("username", $username);
            $check_user->execute();

            if($check_user->rowCount() > 0){
                echo "<p class='exist'><span>$username</span> already exists!</p>";
                die();
            }
        }

        //insert user into database
        protected function setUser($fullname, $username, $role, $password){
            $set_user = $this->connectdb()->prepare("INSERT INTO users (full_name, username, user_role, user_password) VALUES (:full_name, :username, :user_role, :user_password)");
            $set_user->bindValue("full_name", $fullname);
            $set_user->bindValue("username", $username);
            $set_user->bindValue("user_role", $role);
            $set_user->bindValue("user_password", $password);
            $set_user->execute();
            if($set_user){
                echo "<p><span>$username</span> created successfully!</p>";
            }
        }

        //insert category

        
        //add single items
        protected function add_single($table, $column, $item){
            //check if exits exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM $table WHERE $column = :$column");
            $check_item->bindValue("$column", $item);
            $check_item->execute();
            if(!$check_item->rowCount() > 0){
                $add_item = $this->connectdb()->prepare("INSERT INTO $table ($column) VALUES (:$column)");
                $add_item->bindValue("$column", $item);
                $add_item->bindValue("$column", $item);
                $add_item->execute();
                if($add_item){
                    echo "<p><span>$item</span> Created successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$item</span> could not be createda!</p>";
                }
            }else{
                echo "<p class='exist'><span>$item</span> already exists!</p>";
            }
            
        }
        
        //add categeories
        protected function add_categories($value1, $value2){
            //check if item exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM categories WHERE department = :department AND category = :category");
            $check_item->bindValue("department", $value1);
            $check_item->bindValue("category", $value2);
            $check_item->execute();
            if($check_item->rowCount() > 0){
                echo "<p class='exist'><span>$value2</span> already exists!</p>";
                die();
                
            }else{
                $add_item = $this->connectdb()->prepare("INSERT INTO categories (department, category) VALUES (:department, :category)");
                $add_item->bindValue("department", $value1);
                $add_item->bindValue("category", $value2);
                $add_item->execute();
                if($add_item){
                    echo "<p><span>$value2</span> added successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$value2</span> could not be created!</p>";
                }
            }
            
        }
        //add items
        protected function add_items($value1, $value2, $value3){
            //check if item exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM items WHERE department = :department AND category = :category AND item_name = :item_name");
            $check_item->bindValue("department", $value1);
            $check_item->bindValue("category", $value2);
            $check_item->bindValue("item_name", $value3);
            $check_item->execute();
            if($check_item->rowCount() > 0){
                echo "<p class='exist'><span>$value3</span> already exists!</p>";
                die();
                
            }else{
                $add_item = $this->connectdb()->prepare("INSERT INTO items (department, category, item_name) VALUES (:department, :category, :item_name)");
                $add_item->bindValue("department", $value1);
                $add_item->bindValue("category", $value2);
                $add_item->bindValue("item_name", $value3);
                $add_item->execute();
                if($add_item){
                    echo "<p><span>$value3</span> added successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$value3</span> could not be created!</p>";
                }
            }
            
        }
        //add staffs
        protected function add_staffs($value1, $value2, $value3){
            //check if item exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM staffs WHERE staff_name = :staff_name OR phone_number = :phone_number");
            $check_item->bindValue("staff_name", $value1);
            $check_item->bindValue("phone_number", $value2);
            $check_item->execute();
            if($check_item->rowCount() > 0){
                echo "<p class='exist'><span>$value1</span> already exists!</p>";
                die();
                
            }else{
                $add_item = $this->connectdb()->prepare("INSERT INTO staffs (staff_name, phone_number, home_address) VALUES (:staff_name, :phone_number, :home_address)");
                $add_item->bindValue("staff_name", $value1);
                $add_item->bindValue("phone_number", $value2);
                $add_item->bindValue("home_address", $value3);
                $add_item->execute();
                if($add_item){
                    echo "<p><span>$value1</span> added successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$value1</span> could not be created!</p>";
                }
            }
            
        }
        //add vendors
        protected function add_vendors($value1, $value2, $value3, $value4){
            //check if item exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM vendors WHERE vendor = :vendor");
            $check_item->bindValue("vendor", $value1);
            $check_item->execute();
            if($check_item->rowCount() > 0){
                echo "<p class='exist'><span>$value1</span> already exists!</p>";
                die();
                
            }else{
                $add_vendor = $this->connectdb()->prepare("INSERT INTO vendors (vendor, contact_person, phone, email_address) VALUES (:vendor, :contact_person, :phone, :email_address)");
                $add_vendor->bindValue("vendor", $value1);
                $add_vendor->bindValue("contact_person", $value2);
                $add_vendor->bindValue("phone", $value3);
                $add_vendor->bindValue("email_address", $value4);
                $add_vendor->execute();
                if($add_vendor){
                    echo "<p><span>$value1</span> created successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$value1</span> could not be created!</p>";
                }
            }
            
        }
        //add banks
        protected function add_bank($value1, $value2){
            //check if item exists
            $check_item = $this->connectdb()->prepare("SELECT * FROM banks WHERE bank = :bank AND account_number = :account_number");
            $check_item->bindValue("bank", $value1);
            $check_item->bindValue("account_number", $value2);
            $check_item->execute();
            if($check_item->rowCount() > 0){
                echo "<p class='exist'>This <span>$value1 Account</span> already exists!</p>";
                die();
                
            }else{
                $add_item = $this->connectdb()->prepare("INSERT INTO banks (bank, account_number) VALUES (:bank, :account_number)");
                $add_item->bindValue("bank", $value1);
                $add_item->bindValue("account_number", $value2);
                $add_item->execute();
                if($add_item){
                    echo "<p><span>$value1</span> added successfully!</p>";
                }else{
                    echo "<p class='exist'><span>$value1</span> could not be created!</p>";
                }
            }
            
        }

        //check in
        protected function check_in_guest($posted, $room, $last_name, $first_name, $age, $gender, $contact, $address, $phone, $relationship, $cause, $check_in_date, $check_out_date, $amount){
            
            //check if already checkin
            $confirm_check  = $this->connectdb()->prepare("SELECT * FROM check_ins WHERE last_name = :last_name AND first_name = :first_name");
            $confirm_check->bindValue("last_name", $last_name);
            $confirm_check->bindValue("first_name", $first_name);
            $confirm_check->execute();
            if(!$confirm_check->rowCount() > 0){
                $check_in = $this->connectdb()->prepare("INSERT INTO check_ins (last_name, first_name, room, age, gender, contact_person, contact_phone, contact_address, relationship, death_cause, check_in_date, check_out_date, amount_due, posted_by) VALUES (:last_name, :first_name, :room, :age, :gender, :contact_person, :contact_phone, :contact_address, :relationship, :death_cause, :check_in_date, :check_out_date, :amount_due, :posted_by)");
                $check_in->bindvalue("last_name", $last_name);
                $check_in->bindvalue("first_name", $first_name);
                $check_in->bindvalue("room", $room);
                $check_in->bindvalue("age", $age);
                $check_in->bindvalue("gender", $gender);
                $check_in->bindvalue("contact_person", $contact);
                $check_in->bindvalue("contact_phone", $phone);
                $check_in->bindvalue("contact_address", $address);
                $check_in->bindvalue("relationship", $relationship);
                $check_in->bindvalue("death_cause",$cause);
                $check_in->bindvalue("check_in_date",$check_in_date);
                $check_in->bindvalue("check_out_date",$check_out_date);
                $check_in->bindvalue("amount_due",$amount);
                $check_in->bindvalue("posted_by",$posted);
                $check_in->execute();
                if($check_in){
                    /* // update room status
                    $update_room = $this->connectdb()->prepare("UPDATE rooms SET room_status = 1 WHERE room_id = :room_id");
                    $update_room->bindValue("room_status", $room);
                    $update_room->execute();
                    if($update_room){ */
                        echo "<p><span>$last_name $first_name</span> Posted successfully</p>";
                    /* }else{
                        echo "<p><span>Room status not updated</p>";
                    } */
                }else{
                    echo "<p><span>$last_name $first_name</span> could not check in</p>";
                }
            }else{
                echo "<p class='exist'><span>$last_name $first_name</span> already checked in</p>";
            }
        }
        //post payment
        protected function post_payment($posted, $guest, $mode, $bank, $sender, $amount_due, $amount_paid, $invoice){
            
            $payment = $this->connectdb()->prepare("INSERT INTO payments (guest, amount_due, amount_paid, sender, bank, payment_mode, posted_by, invoice) VALUES (:guest, :amount_due, :amount_paid, :sender, :bank, :payment_mode, :posted_by, :invoice)");
            $payment->bindValue("guest", $guest);
            $payment->bindValue("amount_due", $amount_due);
            $payment->bindValue("amount_paid", $amount_paid);
            $payment->bindValue("sender", $sender);
            $payment->bindValue("bank", $bank);
            $payment->bindValue("payment_mode", $mode);
            $payment->bindValue("posted_by", $posted);
            $payment->bindValue("invoice", $invoice);
            $payment->execute();
            if($payment){
                // update status and amount due
                $new_balance = $amount_due - $amount_paid;
                $update_status = $this->connectdb()->prepare("UPDATE check_ins SET status = 1, amount_due = :amount_due WHERE guest_id = :guest_id");
                $update_status->bindValue("amount_due", $new_balance);
                $update_status->bindValue("guest_id", $guest);
                $update_status->execute();
                /* if($update_status){
                    $_SESSION['success'] = "<p>Payment was successful! <i class='fas fa-thumbs-up'></i></p>";
                    // echo "<p>Payment was successful! <i class='fas fa-thumbs-up'></i></p>";
                    // header("Location:../view/users.php");
                }else{
                    echo "<p>Status update was not successful! <i class='fas fa-thumbs-down'></i></p>";

                } */

            }else{
                echo "<p class='exist'><span>Failed to insert payment</p>";
            }
        }

        //stock in item quantity
        protected function stockin_item($posted, $item, $vendor, $invoice, $quantity, $cost, $sales, $expiration){
            
            //check if already checkin
            // $confirm_check  = $this->connectdb()->prepare("SELECT * FROM purchases WHERE vendor = :vendor AND invoice = :invoice");
            // $confirm_check->bindValue("vendor", $vendor);
            // $confirm_check->bindValue("invoice", $invoice);
            // $confirm_check->execute();
            // if(!$confirm_check->rowCount() > 0){
                $stockin = $this->connectdb()->prepare("INSERT INTO purchases (item, invoice, vendor, cost_price, sales_price, quantity, expiration_date, posted_by) VALUES (:item, :invoice, :vendor, :cost_price, :sales_price, :quantity, :expiration_date, :posted_by)");
                $stockin->bindvalue("item", $item);
                $stockin->bindvalue("invoice", $invoice);
                $stockin->bindvalue("vendor", $vendor);
                $stockin->bindvalue("cost_price", $cost);
                $stockin->bindvalue("sales_price", $sales);
                $stockin->bindvalue("quantity", $quantity);
                $stockin->bindvalue("expiration_date", $expiration);
                $stockin->bindvalue("posted_by", $posted);
                $stockin->execute();
            // }else{
            //     echo "<p class='exist'>Invoice <span>$invoice</span> from the selected supplier already exists</p>";
            // }
        }
        //stock in item quantity
        protected function post_sales($posted, $item, $staff, $invoice, $quantity, $price, $amount){
            // check if item already exist
            $confirm_check  = $this->connectdb()->prepare("SELECT * FROM sales WHERE invoice = :invoice AND item = :item");
            $confirm_check->bindValue("invoice", $invoice);
            $confirm_check->bindValue("item", $item);
            $confirm_check->execute();
            if(!$confirm_check->rowCount() > 0){
                $add_sales = $this->connectdb()->prepare("INSERT INTO sales (item, invoice, staff, price, total_amount, quantity, posted_by) VALUES (:item, :invoice, :staff, :price, :total_amount, :quantity, :posted_by)");
                $add_sales->bindvalue("item", $item);
                $add_sales->bindvalue("invoice", $invoice);
                $add_sales->bindvalue("staff", $staff);
                $add_sales->bindvalue("price", $price);
                $add_sales->bindvalue("total_amount", $amount);
                $add_sales->bindvalue("quantity", $quantity);
                $add_sales->bindvalue("posted_by", $posted);
                $add_sales->execute();
            }else{
                echo "<div class='notify'><p>Item already exists in sales order</p></div>";
            }
        }
    }


    // add user controller
    class Add_userController extends inserts{
        private $fullname;
        private $username;
        private $role;
        private $password;

        public function __construct($fullname, $username, $role, $password)
        {
            $this->fullname = $fullname;
            $this->username = $username;
            $this->role = $role;
            $this->password = $password;
        }

        public function create_user(){
            $this->checkUser($this->username);
            $this->setUser($this->fullname, $this->username, $this->role, $this->password);
        }
    }

    

    //add single items controller
    class add_single_item extends inserts{
        private $table;
        private $column1;
        private $value1;

        public function __construct($table, $column1, $value1)
        {
            $this->table = $table;
            $this->column1 = $column1;
            $this->value1 = $value1;
        }
        public function create_single_item(){
            $this->add_single($this->table, $this->column1, $this->value1);
        }
    }
    //add categories controller
    class add_cats extends inserts{
        private $value1;
        private $value2;

        public function __construct($value1, $value2)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
        }
        public function create_category(){
            $this->add_categories($this->value1, $this->value2);
        }
    }
    //add bank controller
    class add_banks extends inserts{
        private $value1;
        private $value2;

        public function __construct($value1, $value2)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
        }
        public function create_bank(){
            $this->add_bank($this->value1, $this->value2);
        }
    }

    //controller for check in
    class check_in extends inserts{
        private $posted;
        private $room;
        private $last_name;
        private $first_name;
        private $age;
        private $gender;
        private $contact;
        private $phone;
        private $address;
        private $relationship;
        private $cause;
        private $amount;
        private $check_in_date;
        private $check_out_date;

        public function __construct($posted, $room, $last_name, $first_name, $age, $gender, $contact, $phone, $address, $relationship, $cause, $amount, $check_in_date, $check_out_date)
        {
            $this->posted = $posted;
            $this->room = $room;
            $this->last_name = $last_name;
            $this->first_name = $first_name;
            $this->address = $address;
            $this->relationship = $relationship;
            $this->age = $age;
            $this->gender = $gender;
            $this->contact = $contact;
            $this->phone = $phone;
            $this->cause = $cause;
            $this->amount = $amount;
            $this->check_in_date = $check_in_date;
            $this->check_out_date =$check_out_date;
        }

        public function check_in(){
            $this->check_in_guest($this->posted, $this->room, $this->last_name, $this->first_name, $this->age, $this->gender, $this->contact, $this->address, $this->phone, $this->relationship, $this->cause, $this->check_in_date, $this->check_out_date, $this->amount);
        }
    }

    //controller for payments
    class payments extends inserts{
        private $posted;
        private $guest;
        private $mode;
        private $bank;
        private $sender;
        private $amount_due;
        private $amount_paid;
        private $invoice;

        public function __construct($posted, $guest, $mode, $bank, $sender, $amount_due, $amount_paid, $invoice)
        {
            $this->posted = $posted;
            $this->guest = $guest;
            $this->mode = $mode;
            $this->bank = $bank;
            $this->sender = $sender;
            $this->amount_due = $amount_due;
            $this->amount_paid =$amount_paid;
            $this->invoice = $invoice;
        }

        public function payment(){
            $this->post_payment($this->posted, $this->guest, $this->mode, $this->bank, $this->sender, $this->amount_due, $this->amount_paid, $this->invoice);
        }
    }

    // controller for adding new items
    class add_items extends inserts{
        private $value1;
        private $value2;
        private $value3;

        public function __construct($value1, $value2, $value3)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
            $this->value3 = $value3;
        }
        public function create_item(){
            $this->add_items($this->value1, $this->value2, $this->value3);
        }
    }
    // controller for adding staffs
    class add_staff extends inserts{
        private $value1;
        private $value2;
        private $value3;

        public function __construct($value1, $value2, $value3)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
            $this->value3 = $value3;
        }
        public function create_staff(){
            $this->add_staffs($this->value1, $this->value2, $this->value3);
        }
    }
    // controller for adding new supplier
    class add_suppliers extends inserts{
        private $value1;
        private $value2;
        private $value3;
        private $value4;

        public function __construct($value1, $value2, $value3, $value4)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
            $this->value3 = $value3;
            $this->value4 = $value4;
        }
        public function create_vendor(){
            $this->add_vendors($this->value1, $this->value2, $this->value3, $this->value4);
        }
    }

    //controller for stocin of items
    class stockins extends inserts{
        private $item;
        private $vendor;
        private $invoice;
        private $quantity;
        private $cost;
        private $sales;
        private $expiration;
        private $posted;

        public function __construct($item, $vendor, $invoice, $quantity, $cost, $sales, $expiration, $posted)
        {
            $this->item = $item;
            $this->vendor = $vendor;
            $this->invoice = $invoice;
            $this->quantity = $quantity;
            $this->cost = $cost;
            $this->sales = $sales;
            $this->expiration = $expiration;
            $this->posted = $posted;
        }

        public function stockin(){
            $this->stockin_item($this->posted, $this->item, $this->vendor, $this->invoice, $this->quantity, $this->cost, $this->sales, $this->expiration);
        }
    }
    //controller for adding sales
    class post_sales extends inserts{
        private $item;
        private $staff;
        private $invoice;
        private $quantity;
        private $price;
        private $amount;
        private $posted;

        public function __construct($item, $staff, $invoice, $quantity, $price, $amount, $posted)
        {
            $this->item = $item;
            $this->staff = $staff;
            $this->invoice = $invoice;
            $this->quantity = $quantity;
            $this->price = $price;
            $this->amount = $amount;
            $this->posted = $posted;
        }

        public function add_sales(){
            $this->post_sales($this->posted, $this->item, $this->staff, $this->invoice, $this->quantity, $this->price, $this->amount);
        }
    }