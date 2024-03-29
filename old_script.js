// toggle password
function togglePassword(){
    let pw = document.querySelectorAll(".password");
    pw.forEach(ps => {
       if(ps.type === "password"){
            ps.type = "text";
            document.querySelector(".icon").innerHTML = "<i class='fas fa-eye-slash'></i>";
            document.querySelector(".icon_txt").innerHTML = "Hide password";
       }else{
            ps.type = "password";
            document.querySelector(".icon").innerHTML = "<i class='fas fa-eye'></i>";
            document.querySelector(".icon_txt").innerHTML = "Show password";
       } 
    });
}

//toggle logout
$(document).ready(function(){
     $("#loginDiv").click(function(){
          $(".login_option").toggle();
     })
})

//toggle menu with more options
$(document).ready(function(){
     $(".addMenu").click(function(){
          $(".nav1Menu").toggle();
          //change icon from plus to miinus and vice versa
          let option_icon = document.querySelector(".options");
          if(document.querySelector(".nav1Menu").style.display == "block"){
               option_icon.innerHTML = "<i style='background:none; color:#fff!important; box-shadow:none!important;' class='fas fa-minus'></i>";
          }else{
               option_icon.innerHTML = "<i style='background:none; color:#fff!important; box-shadow:none!important;' class='fas fa-plus'></i>";
          }

     })
})
//toggle all submenu
$(document).ready(function(){
     $("#adminMenu").click(function(){
          $(".adminMenu").toggle();
          $(".frontDesk").hide();
          $(".payments").hide();
          $(".reports").hide();
          $(".financial_reports").hide();
          $(".inventory").hide();
     })
     $("#frontDesk").click(function(){
          $(".adminMenu").hide();
          $(".frontDesk").toggle();
          $(".payments").hide();
          $(".reports").hide();
          $(".financial_reports").hide();
          $(".inventory").hide();
     })
     $("#payments").click(function(){
          $(".adminMenu").hide();
          $(".frontDesk").hide();
          $(".payments").toggle();
          $(".reports").hide();
          $(".financial_reports").hide();
          $(".inventory").hide();
     })
     $("#reports").click(function(){
          $(".adminMenu").hide();
          $(".frontDesk").hide();
          $(".payments").hide();
          $(".reports").toggle();
          $(".financial_reports").hide();
          $(".inventory").hide();
     })
     $("#financial_reports").click(function(){
          $(".adminMenu").hide();
          $(".frontDesk").hide();
          $(".payments").hide();
          $(".reports").hide();
          $(".financial_reports").toggle();
          $(".inventory").hide();
     })
     $("#inventory").click(function(){
          $(".adminMenu").hide();
          $(".frontDesk").hide();
          $(".payments").hide();
          $(".reports").hide();
          $(".financial_reports").hide();
          $(".inventory").toggle();
     })
})
//show payment mode forms
function showCash(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#cash").show();
}
function showPos(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#pos").show();
}
function showTransfer(){
     document.querySelectorAll(".payment_form").forEach(function(forms){
          forms.style.display = "none";
     })
     $("#transfer").show();
}
//show pages dynamically with xhttp request
function showPage(page){
     let xhr = false;
     if(window.XMLHttpRequest){
          xhr = new XMLHttpRequest();
     }else{
          xhr = new ActiveXObject("Microsoft.XMLHTTP");
     }
     if(xhr){
          xhr.onreadystatechange = function(){
               if(xhr.readyState == 4 && xhr.status == 200){
                    document.querySelector(".contents").innerHTML = xhr.responseText;
               }
          }
          xhr.open("GET", page, true );
          xhr.send(null);
     }
}

//add users
function addUser(){
     let username = document.getElementById("username").value;
     let full_name = document.getElementById("full_name").value;
     let user_role = document.getElementById("user_role").value;
     // alert(hotel_address);
     if(full_name.length == 0 || full_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter user full name!");
          $("#full_name").focus();
          return;
     }else if(username.length == 0 || username.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter a username!");
          $("#username").focus();
          return;
     }else if(user_role.length == 0 || user_role.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select user role!");
          $("#user_role").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_users.php",
               data : {username:username, full_name:full_name, user_role:user_role},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#usernane").val('');
     $("#full_name").val('');
     $("#user_role").val('');
     $("#full_name").focus();
     return false;
}

//add departments
function addDepartment(){
     let department = document.getElementById("department").value;
     if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input department!");
          $("#department").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_department.php",
               data : {department:department},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#department").val('');
     $("#department").focus();
     return false;
}
//add categories
function addCategory(){
     let category = document.getElementById("category").value;
     let department = document.getElementById("department").value;
     if(category.length == 0 || category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter category!");
          $("#category").focus();
          return;
     }else if(department.length == 0 || department.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a department!");
          $("#department").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_category.php",
               data : {category:category, department:department},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#category").val('');
     $("#category").focus();
     return false;
}
//add bank
function addBank(){
     let bank = document.getElementById("bank").value;
     let account_num = document.getElementById("account_num").value;
     if(bank.length == 0 || bank.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input bank name!");
          $("#bank").focus();
          return;
     }else if(account_num.length == 0 || account_num.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input account number!");
          $("#account_num").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_bank.php",
               data : {bank:bank, account_num:account_num},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#bank").val('');
     $("#account_num").val('');
     $("#bank").focus();
     return false;
}
//search for data within table
function searchData(data){
     let $row = $(".searchTable tbody tr");
     let val = $.trim(data).replace(/ +/g, ' ').toLowerCase();
     $row.show().filter(function(){
          var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
          return !~text.indexOf(val);
     }).hide();
}

// disale user
function disableUser(user_id){
     let disable = confirm("Do you want to disable this user?", "");
     if(disable){
          // alert(user_id);
          $.ajax({
               type: "GET",
               url : "../controller/disable_user.php?id="+user_id,
               success : function(response){
                    $("#disable_user").html(response);
               }
          })
          setTimeout(function(){
               $('#disable_user').load("disable_user.php #disable_user");
          }, 3000);
          return false;
     }
}

// activate disabled user
function activateUser(user_id){
     let activate = confirm("Do you want to activate this user account?", "");
     if(activate){
          $.ajax({
               type : "GET",
               url : "../controller/activate_user.php?user_id="+user_id,
               success : function(response){
                    $("#activate_user").html(response);
               }
          })
          setTimeout(function(){
               $("#activate_user").load("activate_user.php #activate_user");
          }, 3000);
          return false;
     }
}

// add items 
function addItem(){
     let department = document.getElementById("department").value;
     let item_category = document.getElementById("item_category").value;
     let item = document.getElementById("item").value;
     if(item_category.length == 0 || item_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select item category!");
          $("#item_category").focus();
          return;
     }else if(item.length == 0 || item.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter item name");
          $("#item").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_item.php",
               data : {department:department, item_category:item_category, item:item},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     // $("#room_category").val('');
     $("#item").val('');
     $("#item").focus();
     return false;    
}
// add staffs 
function addStaff(){
     let staff_name = document.getElementById("staff_name").value;
     let phone_number = document.getElementById("phone_number").value;
     let home_address = document.getElementById("home_address").value;
     if(staff_name.length == 0 || staff_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff name!");
          $("#staff_name").focus();
          return;
     }else if(home_address.length == 0 || home_address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff residential address");
          $("#home_address").focus();
          return;
     }else if(phone_number.length == 0 || phone_number.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input staff phone number");
          $("#phone_number").focus();
          return;
     }else if(phone_number.length < 11){
          alert("Phone number is too short");
          $("#phone_number").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_staff.php",
               data : {staff_name:staff_name, phone_number:phone_number, home_address:home_address},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     // $("#room_category").val('');
     $("#staff_name").val('');
     $("#phone_number").val('');
     $("#home_address").val('');
     $("#staff_name").focus();
     return false;    
}
// add suppliers 
function addSupplier(){
     let supplier = document.getElementById("supplier").value;
     let contact_person = document.getElementById("contact_person").value;
     let phone = document.getElementById("phone").value;
     let email = document.getElementById("email").value;
     if(supplier.length == 0 || supplier.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input supplier name!");
          $("#supplier").focus();
          return;
     }else if(contact_person.length == 0 || contact_person.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input contact person name");
          $("#contact_person").focus();
          return;
     }else if(phone.length == 0 || phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input phone number");
          $("#phone").focus();
          return;
     }else if(email.length == 0 || email.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input email address");
          $("#email").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/add_vendor.php",
               data : {supplier:supplier, contact_person:contact_person, phone:phone, email:email},
               success : function(response){
               $(".info").html(response);
               }
          })
     }
     $("#supplier").val('');
     $("#contact_person").val('');
     $("#phone").val('');
     $("#email").val('');
     $("#supplier").focus();
     return false;    
}

// get item categories
function getCategory(post_department){
     let department = post_department;
     if(department){
          $.ajax({
               type : "POST",
               url :"../controller/get_categories.php",
               data : {department:department},
               success : function(response){
                    $("#item_category").html(response);
               }
          })
          return false;
     }else{
          $("#item_category").html("<option value'' selected>Select department first</option>")
     }
     
}
// get room
function getRooms(check_category){
     let check_in_category = check_category;
     if(check_in_category){
          $.ajax({
               type : "POST",
               url :"../controller/get_rooms.php",
               data : {check_in_category:check_in_category},
               success : function(response){
                    $("#check_in_room").html(response);
               }
          })
          return false;
     }else{
          $("#check_in_room").html("<option value'' selected>Select category first</option>")
     }
     
}

//get price for rooms
function getPrice(check_room){
     let check_in_room = check_room;
     // alert(check_room);
     // return;
     if(check_in_room){
          $.ajax({
               type : "POST",
               url :"../controller/get_price.php",
               data : {check_in_room:check_in_room},
               success : function(response){
                    $("#amount").html(response);
               }
          })
          $("#room_price").show();
          return false;
     }else{
          $("#amount").html("<p>Please select room first</p>");
     }
     
}

//check in
function checkIn(){
     let posted_by = document.getElementById("posted_by").value;
     let check_in_category = document.getElementById("check_in_category").value;
     let check_in_room = document.getElementById("check_in_room").value;
     let last_name = document.getElementById("last_name").value;
     let first_name = document.getElementById("first_name").value;
     let age = document.getElementById("age").value;
     let gender = document.getElementById("gender").value;
    
     let contact_address = document.getElementById("contact_address").value;
     let contact_phone = document.getElementById("contact_phone").value;
     
     let check_in_date = document.getElementById("check_in_date").value;
     let check_out_date = document.getElementById("check_out_date").value;
     let amount_due = document.getElementById("amount_due").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     // alert(today);
     if(check_in_category.length == 0 || check_in_category.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select room category!");
          $("#check_in_category").focus();
          return;
     }else if(check_in_room.length == 0 || check_in_room.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select room");
          $("#check_in_room").focus();
          return;
     }else if(last_name.length == 0 || last_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Enter Last Name");
          $("#last_name").focus();
          return;
     }else if(first_name.length == 0 || first_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Enter First Name");
          $("#first_name").focus();
          return;
     }else if(age.length == 0 || age.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Enter Age");
          $("#age").focus();
          return;
     }else if(gender.length == 0 || gender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Select Gender");
          $("#gender").focus();
          return;
     
     }else if(contact_address.length == 0 || contact_address.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Enter contact person's Address");
          $("#contact_address").focus();
          return;
     }else if(contact_phone.length == 0 || contact_phone.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Enter contact's Phone number");
          $("#contact_phone").focus();
          return;
     
     }else if(check_in_date.length == 0 || check_in_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Input Check in date");
          $("#check_in_date").focus();
          return;
     }else if(check_out_date.length == 0 || check_out_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Input Check out date");
          $("#check_out_date").focus();
          return;
     }else if(new Date(today).getTime() > new Date(check_in_date).getTime()){
          alert("Check in date cannot be lesser than todays date");
          $("#check_in_date").focus();
          return;
     }else if((new Date(check_in_date )).getTime() > (new Date(check_out_date)).getTime()){
          alert("Check in date cannot be greater than check out date");
          $("#check_in_date").focus();
          return;
     }else if(amount_due.length == 0 || amount_due.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select room to display amount");
          $("#check_in_room").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/check_in.php",
               data : {posted_by:posted_by,check_in_room:check_in_room, last_name:last_name, first_name:first_name, age:age, gender:gender,contact_address:contact_address, contact_phone:contact_phone, check_in_date:check_in_date, check_out_date:check_out_date, amount_due:amount_due},
               success : function(response){
               $(".info").html(response);
               }
          })
          $("#check_in_category").val('');
          $("#check_in_room").val('');
          $("#last_name").val('');
          $("#first_name").val('');
          $("#amount_due").val('');
          $("#check_in_date").val('');
          $("#check_out_date").val('');
          $("#age").val('');
          $("#gender").val('');
          $("#days").html('');
          $("#contact_address").val('');
          $("#contact_phone").val('');
          $("#check_in_category").focus();
          return false; 
     }
        
}

//calculate days from check in and check out
function calculateDays(){
     let check_in_date = document.getElementById("check_in_date").value;
     let check_out_date = document.getElementById("check_out_date").value; 
     let fee = document.getElementById("fee");
     let room_fee = document.getElementById("room_fee").value;
     let num_days = document.getElementById("days");
     firstDay = new Date(check_in_date);
     secondDay = new Date(check_out_date);
     days = secondDay.getTime() - firstDay.getTime();
     totalDays = days / (1000 * 60 * 60 * 24);
     newAmount = totalDays * parseInt(room_fee);
     $("#total_amount").show();
     fee.innerHTML = "<input type='number' name='amount_due' id='amount_due' value='"+newAmount+"' style='color:green'>";
     num_days.innerHTML = "<p style='font-weight:bold; font-size:.9rem'>"+totalDays+" day(s)</p>";
     // alert(totalDays);
}
function changeRoom(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let current_room = document.getElementById("current_room").value;
     let new_room = document.getElementById("new_room").value;
     if(new_room.length == 0 || new_room.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select room!");
          $("#new_room").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/change_room.php",
               data : {posted_by:posted_by, guest:guest, current_room:current_room, new_room:new_room},
               success : function(response){
                    $("#guest_room_details").html(response);
               }
          })
          setTimeout(function(){
               $("#guest_room_details").load("change_room_form.php?guest_id="+guest+" #guest_room_details");
          }, 2000);
          return false;
     }
}
//post guest cash payment
function postCash(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("payment_mode").value;
     let bank_paid = document.getElementById("bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#amount_paid").focus();
          return;
     // }else if(parseInt(amount_paid) < parseInt(guest_amount)){
     //      alert("Insufficient funds!");
     //      $("#guest_amount").focus();
     //      return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#all_payments").html(response);
          }
     })
          setTimeout(function(){
               $('#all_payments').load("post_payment.php?guest_id=+"+guest + "#all_payments");
          }, 3000);
     }
     return false;    

}
//post guest POS payment
function postPos(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("pos_mode").value;
     let bank_paid = document.getElementById("pos_bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("pos_amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#pos_amount_paid").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select POS Bank!");
          $("#pos_bank_paid").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#all_payments").html(response);
          }
     })
          setTimeout(function(){
               $('#all_payments').load("post_payment.php?guest_id=+"+guest + "#all_payments");
          }, 3000);
     }
     return false;    

}
//post guest Transfer payment
function postTransfer(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("transfer_mode").value;
     let bank_paid = document.getElementById("transfer_bank_paid").value;
     let sender = document.getElementById("transfer_sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("transfer_amount").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#transfer_amount").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Bank Transferred to!");
          $("#transfer_bank_paid").focus();
          return;
     }else if(sender.length == 0 || sender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Input Name of sender!");
          $("#transfer_sender").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#all_payments").html(response);
          }
     })
          setTimeout(function(){
               $('#all_payments').load("post_payment.php?guest_id=+"+guest + "#all_payments");
          }, 3000);
     }
     return false;    

}
//post other cash payments for guest
function postOtherCash(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("payment_mode").value;
     let bank_paid = document.getElementById("bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#amount_paid").focus();
          return;
     // }else if(parseInt(amount_paid) < parseInt(guest_amount)){
     //      alert("Insufficient funds!");
     //      $("#guest_amount").focus();
     //      return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}
//post other Pos payments for guest
function postOtherPos(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("pos_mode").value;
     let bank_paid = document.getElementById("pos_bank_paid").value;
     let sender = document.getElementById("sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("pos_amount_paid").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#pos_amount_paid").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select POS Bank!");
          $("#pos_bank_paid").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}
//post other Transfer payments for guest
function postOtherTransfer(){
     let posted_by = document.getElementById("posted_by").value;
     let guest = document.getElementById("guest").value;
     let payment_mode = document.getElementById("transfer_mode").value;
     let bank_paid = document.getElementById("transfer_bank_paid").value;
     let sender = document.getElementById("transfer_sender").value;
     let guest_amount = document.getElementById("guest_amount").value;
     let amount_paid = document.getElementById("transfer_amount").value;
     
     if(amount_paid.length == 0 || amount_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input amount paid!");
          $("#transfer_amount").focus();
          return;
     }else if(bank_paid.length == 0 || bank_paid.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select Bank Transferred to!");
          $("#transfer_bank_paid").focus();
          return;
     }else if(sender.length == 0 || sender.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please Input Name of sender!");
          $("#transfer_sender").focus();
          return;
     }else{
     $.ajax({
          type : "POST",
          url : "../controller/post_other_payments.php",
          data : {posted_by:posted_by, guest:guest, payment_mode:payment_mode, bank_paid:bank_paid, sender:sender, guest_amount:guest_amount, amount_paid:amount_paid},
          success : function(response){
               $("#guest_details").html(response);
          }
     })
          setTimeout(function(){
               $('#guest_details').load("guest_details.php?guest_id=+"+guest + "#guest_details");
          }, 3000);
     }
     return false;    

}

//check out guest
function checkOut(){
     let checkout = confirm("Do you want to check out this guest?", "");
     if(checkout){
          // alert(user_id);
          let user_id = document.getElementById("user_id").value;
          let guest_id = document.getElementById("guest_id").value;
          $.ajax({
               type : "POST",
               url : "../controller/check_out.php",
               data : {user_id:user_id, guest_id:guest_id},
               success : function(response){
                    $("#guest_details").html(response);
               }
          })
          setTimeout(function(){
               $("#guest_details").load("guest_details.php?guest_id="+guest_id+ "#guest_details");
          }, 3000);
     }
     return false;
}

//display modify item name
function modifyItemForm(item_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_item_name.php?item_id="+item_id,
          success : function(response){
               $(".info").html(response);
          }
     })
     return false;
 
 }
//display change price for other items
function displayPriceForm(item_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_item_details.php?item_id="+item_id,
          success : function(response){
               $(".info").html(response);
          }
     })
     return false;
 
 }
//display stockin form
function displayStockinForm(){
     // alert(item_id);
     let invoice = document.getElementById("invoice").value;
     let vendor = document.getElementById("vendor").value;
     let item = document.getElementById("item").value;
     if(invoice.length == 0 || invoice.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input invoice number!");
          $("#invoice").focus();
          return;
     }else if(vendor.length == 0 || vendor.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select supplier!");
          $("#vendor").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/get_stockin_details.php",
               data : {invoice:invoice, vendor:vendor, item:item},
               success : function(response){
                    $(".info").html(response);
               }
          })
          $("#invoice").attr("readonly", true);
          $("#vendor").attr("readonly", true);
          return false;
     }
     
 }

 //stockin in items
function stockin(){
     let posted_by = document.getElementById("posted_by").value;
     let invoice_number = document.getElementById("invoice_number").value;
     let supplier = document.getElementById("supplier").value;
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     let cost_price = document.getElementById("cost_price").value;
     let sales_price = document.getElementById("sales_price").value;
     let expiration_date = document.getElementById("expiration_date").value;
     let todayDate = new Date();
     let today = todayDate.toLocaleDateString();
     // alert(today);
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(quantity == "0"){
          alert("Please input quantity purchased!");
          $("#quantity").focus();
          return;
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input cost price");
          $("#cost_price").focus();
          return;
     }else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input selling price");
          $("#sales_price").focus();
          return;
     }else if(expiration_date.length == 0 || expiration_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item expiration date");
          $("#expiration_date").focus();
          return;
     }else if(new Date(today).getTime() > new Date(expiration_date).getTime()){
          alert("You can not stock in expired items!");
          $("#expiration_date").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/stock_in.php",
               data : {posted_by:posted_by,supplier:supplier, invoice_number:invoice_number, item_id:item_id, quantity:quantity, cost_price:cost_price, sales_price:sales_price, expiration_date:expiration_date},
               success : function(response){
               $(".stocked_in").html(response);
               }
          })
          $("#quantity").val('');
          $("#expiration_date").val('');
          $("#quantity").focus();
          return false; 
     }
}

//delete individual purchases
function deletePurchase(purchase, item){
     let confirmDel = confirm("Are you sure you want to delete this purchase?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_purchase.php?purchase_id="+purchase+"&item_id="+item,
               success : function(response){
                    $(".stocked_in").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//close stock in form
function closeStockin(){
     $("#stockin").load("stockin_purchase.php #stockin");
}

//display adjust quantity form
function displayQuantityForm(item_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_item_qty.php?item_id="+item_id,
          success : function(response){
               $(".info").html(response);
          }
     })
     return false;
 
 }
 //adjust item quantity
 function adjustQty(){
     let item_id = document.getElementById("item_id").value;
     let quantity = document.getElementById("quantity").value;
     if(quantity.length == 0 || quantity.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#item_name").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/stock_adjustment.php",
               data: {item_id:item_id, quantity:quantity},
               success : function(response){
                    $("#adjust_quantity").html(response);
               }
          })
          setTimeout(function(){
               $("#adjust_quantity").load("stock_adjustment.php #adjust_quantity");
          }, 1500);
          return false
     }
 }
//  display change rom price
function roomPriceForm(item_id){
     // alert(item_id);
     $.ajax({
          type : "GET",
          url : "../controller/get_room_details.php?item_id="+item_id,
          success : function(response){
               $(".info").html(response);
          }
     })
     return false;
 
 }
 
 //close price form
 function closeForm(){
     
         $(".priceForm").hide();
     
 }

 //change room price
 function changeRoomPrice(){
     let item_id = document.getElementById("item_id").value;
     let price = document.getElementById("price").value;

     $.ajax({
          type : "POST",
          url : "../controller/edit_room_price.php",
          data: {item_id:item_id, price:price},
          success : function(response){
               $("#edit_price").html(response);
          }
     })
     setTimeout(function(){
          $("#edit_price").load("room_price.php #edit_price");
     }, 1500);
     return false;
 }
 //change other item price
 function changeItemPrice(){
     let item_id = document.getElementById("item_id").value;
     let cost_price = document.getElementById("cost_price").value;
     let sales_price = document.getElementById("sales_price").value;
     if(cost_price >= sales_price){
          alert("Selling price can not be lesser than cost price!");
          $("sales_price").focus();
          return;
     }else if(cost_price.length == 0 || cost_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter cost price!");
          $("#cost_price").focus();
          return;
     }else if(sales_price.length == 0 || sales_price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter selling price!");
          $("#sales_price").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/edit_price.php",
               data: {item_id:item_id, cost_price:cost_price, sales_price:sales_price},
               success : function(response){
                    $("#edit_item_price").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_price").load("item_price.php #edit_item_price");
          }, 1500);
          return false
     }
 }
 //modify item name
 function modifyItem(){
     let item_id = document.getElementById("item_id").value;
     let item_name = document.getElementById("item_name").value;
     if(item_name.length == 0 || item_name.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input item name!");
          $("#item_name").focus();
          return;
     }else{
          $.ajax({
               type : "POST",
               url : "../controller/modify_item.php",
               data: {item_id:item_id, item_name:item_name},
               success : function(response){
                    $("#edit_item_name").html(response);
               }
          })
          setTimeout(function(){
               $("#edit_item_name").load("modify_item.php #edit_item_name");
          }, 1500);
          return false
     }
 }
//  search checkIns 
function searchCheckIns(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_checkins.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
//  search checkOuts 
function searchCheckOuts(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_checkouts.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
//  search revenue 
function searchRevenue(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_revenue.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
// search cash
function searchCash(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_cash.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
// search POS
function searchPos(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_pos.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
// search transfer
function searchTransfer(){
     let from_date = document.getElementById('from_date').value;
     let to_date = document.getElementById('to_date').value;
     /* authentication */
     if(from_date.length == 0 || from_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#from_date").focus();
          return;
     }else if(to_date.length == 0 || to_date.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#to_date").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_transfer.php",
               data: {from_date:from_date, to_date:to_date},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}
// update password
function updatePassword(){
     let username = document.getElementById('username').value;
     let current_password = document.getElementById('current_password').value;
     let new_password = document.getElementById('new_password').value;
     let retype_password = document.getElementById('retype_password').value;
     /* authentication */
     if(current_password == 0 || current_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter current password");
          $("#current_password").focus();
          return;
     }else if(new_password == 0 || new_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please enter new password");
          $("#new_password").focus();
          return;
     }else if(new_password.length < 6){
          alert("New password must be greater or equal to 6 characters");
          $("#new_password").focus();
          return;
     }else if(retype_password == 0 || retype_password.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please retype new password");
          $("#retype_password").focus();
          return;
     }else if(new_password !== retype_password){
          alert("Passwords does not match!");
          $("#retype_password").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_password.php",
               data: {username:username, current_password:current_password, new_password:new_password, retype_password:retype_password},
               success: function(response){
               $(".info").html(response);
               }
          });
     }
     return false;
}
//  Get room reports 
function getRoomReports(room){
     let room_id = room;
     /* authentication */
     if(room_id){
          $.ajax({
               type: "POST",
               url: "../controller/room_reports.php",
               data: {room_id:room_id},
               success: function(response){
                    $(".new_data").html(response);
               }
          });
     }else{
          alert("select a room!");
          return;
     }
     return false;
}

//get vendors
function getVendors(vendor){
     let ven_input = vendor;
     if(ven_input){
          $.ajax({
               type : "POST",
               url :"../controller/get_vendors.php",
               data : {ven_input:ven_input},
               success : function(response){
                    $("#vendors").html(response);
               }
          })
          return false;
     }else{
          $("#vendors").html("<option value='' selected>No result</option>")
     }
     
}

//  search purchases 
function searchPurchase(){
     let purchase_from = document.getElementById("purchase_from").value;
     let purchase_to = document.getElementById("purchase_to").value;
     /* authentication */
     if(purchase_from .length == 0 || purchase_from .replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date!");
          $("#purchase_from").focus();
          return;
     }else if(purchase_to.length == 0 || purchase_to.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please select a date range!");
          $("#purchase_to").focus();
          return;
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/search_purchase.php",
               data: {purchase_from:purchase_from, purchase_to:purchase_to},
               success: function(response){
               $(".new_data").html(response);
               }
          });
     }
     return false;
}

//show bill types forms
function showWalkin(){
     $("#walkin_customers").show();
     $("#existing_guests").hide();
}
function showGuest(){
     $("#walkin_customers").hide();
     $("#existing_guests").show();
}
//show sales form categories (bar and restuarant)
function showBar(){
     $("#bar_items").show();
     $("#restaurant_items").hide();
}
function showRestaurant(){
     $("#bar_items").hide();
     $("#restaurant_items").show();
}

//get item for sales
function getItems(item_name){
     let item = item_name;
     // alert(check_room);
     // return;
     if(item.length >= 3){
          if(item){
               $.ajax({
                    type : "POST",
                    url :"../controller/get_items.php",
                    data : {item:item},
                    success : function(response){
                         $("#sales_item").html(response);
                    }
               })
               return false;
          }else{
               $("#sales_item").html("<p>Please enter atleast 3 letters</p>");
          }
     }
     
}

//add sales
function addSales(item_id){
     let item = item_id;
     $.ajax({
          type : "GET",
          url : "../controller/add_sales.php?sales_item="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
     })
     return false;
}
//delete individual items from sales order
function deleteSales(sales, item){
     let confirmDel = confirm("Are you sure you want to remove this item?", "");
     if(confirmDel){
          
          $.ajax({
               type : "GET",
               url : "../controller/delete_sales.php?sales_id="+sales+"&item_id="+item,
               success : function(response){
                    $(".sales_order").html(response);
               }
               
          })
          return false;
     }else{
          return;
     }
}
//increase quantity for sales item
function increaseQty(sales, item){
     // alert(sales);
     $.ajax({
          type : "GET",
          url : "../controller/increase_qty.php?sales_id="+sales+"&item_id="+item,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//decrease quantity for sales item
function reduceQty(sales){
     $.ajax({
          type : "GET",
          url : "../controller/decrease_qty.php?item="+sales,
          success : function(response){
               $(".sales_order").html(response);
          }
          
     })
     return false;
}
//show more options for sales item to edit price and quantity
function showMore(sales){
     $.ajax({
          type : "GET",
          url : "../controller/edit_price_qty.php?item="+sales,
          success : function(response){
               $(".show_more").html(response);
          }
          
     })
     return false;
}

//update sales quantit and price
function updatePriceQty(){
     let sales_id = document.getElementById("sales_id").value;
     let qty = document.getElementById("qty").value;
     let price = document.getElementById("price").value;
     // let inv_qty = document.getElementById("inv_qty").value;
     /* authentication */
     if(qty.length == 0 || qty.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input quantity!");
          $("#qty").focus();
          return;
     }else if(price.length == 0 || price.replace(/^\s+|\s+$/g, "").length == 0){
          alert("Please input unit price!");
          $("#price").focus();
          return;
     }else if(qty < 1){
          alert("Qauntity cannot be zero or negative!");
          $("#qty").focus();
          return;
     }else if(price < 1){
          alert("Price cannot be zero or negative!");
          $("#price").focus();
          return;
     /* }else if(qty > inv_qty){
          alert("Available quantity is less than required!");
          $("#qty").focus();
          return; */
     }else{
          $.ajax({
               type: "POST",
               url: "../controller/update_price_qty.php",
               data: {sales_id:sales_id, qty:qty, price:price},
               success: function(response){
               $(".sales_order").html(response);
               }
          });

     }
     $(".show_more").html('');
     return false;
}
//post sales
function postSales(invoice){
     $.ajax({
          type : "GET",
          url : "../controller/post_sales.php?invoice="+invoice,
          success : function(response){
               $("#create_bill").html(response);
          }
     })
     setTimeout(function(){
          $("#create_bill").load("create_bill.php #create_bill");
     }, 500);
     return false;
     
}