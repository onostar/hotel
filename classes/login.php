<?php
    session_start();
    class Login extends Dbh{
        /* check if user exists */
        protected function checkUser($username, $password){
            $get_pwd = $this->connectdb()->prepare("SELECT user_password FROM users WHERE username = :username");
            $get_pwd->bindValue("username",$username);
            $get_pwd->execute();

            if($get_pwd->rowCount() > 0){
                $_SESSION['user'] = $username;
                $user_password = $get_pwd->fetch();
                if($user_password->user_password == "123"){
                    header("Location: ../view/change_password.php");
                }else{
                    $hashedPwd = $user_password->user_password;
                    $check_pwd = password_verify($password, $hashedPwd);

                    if($check_pwd == false){
                        $_SESSION['error'] = "Error! Wrong Password";
                        header("Location: ../index.php");
                    }else{
                        $get_user = $this->connectdb()->prepare("SELECT * FROM users WHERE username = :username AND user_password = :user_password AND status = 0");
                        $get_user->bindValue("username", $username);
                        $get_user->bindValue("user_password", $hashedPwd);
                        $get_user->execute();

                        if($get_user->rowCount() > 0){
                            $_SESSION['user'] = $username;
                            header("Location: ../view/users.php");
                        }else{
                            $_SESSION['error'] = "User Deactivated";
                            header("Location: ../index.php");
                        }
                    }
                }
            }else{
                $_SESSION['error'] = "Error! Invalid username or password";
                header("Location: ../index.php");
            }
        }

    }