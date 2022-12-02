<div id="addUser" class="displays">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Add Users</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <form class="addUserForm">
            <div class="inputs">
                <input type="text" name="full_name" id="full_name" placeholder="Enter full name" required>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
                <select name="user_role" id="user_role" required style="padding:10px;">
                    <option value="" selected>Select user role</option>
                    <option value="Admin">Admin</option>
                    <option value="cashier">Cashier</option>
                    <option value="receptionist">Receptionist</option>
                </select>

                <button type="submit" id="add_user" name="add_user" onclick="addUser()">Add user <i class="fas fa-users"></i></button>
            </div>
        </form>    
        <!-- </form> -->
    </div>
</div>
