<?php

namespace App\classes;

class Users
{

    //input field value validated
    public function validationInputData( $data ){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    //email check for registration or login
    public function emailCheck( $email ){
        $sql = "SELECT email FROM users WHERE email = '$email'";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            $rowCont = mysqli_num_rows($queryResult);
            if($rowCont){
                return true;
            }else{
                return false;
            }
        }
    }
    //userRegistration method call from registration page
     public function userRegistration($data){
         $name = $this->validationInputData($data['name']);
         $userName = $this->validationInputData($data['username']);
         $email = $this->validationInputData($data['email']);
         $password = $this->validationInputData($data['password']);

         //form validation
         if( strlen($userName) < 4){
             $message = "<div class='alert alert-danger' aline='center'>Username is too short...</div>";
             return $message;
         } elseif( preg_match('/[^a-z0-9-]+/i', $userName)){
            $message = "<div class='alert alert-danger' align='center'>Username must only contain alphanumerical, dashes and underscores!</div>";
            return $message;
         }
         if( strlen($password) < 6 ){
             $message="<div class='alert alert-danger' align='center'>Password is too short...</div>";
            return $message;
         }

         //calling emailCheck function
         $result = $this->emailCheck($email);
         if($result== true){
             $message= "<div class='alert alert-danger' align='center'>Email address already exist...</div>";
            return $message;
         }
         $password = md5($password);
         $sql = "INSERT INTO `users`(`name`, `username`, `email`, `password`) VALUES ('$name','$userName','$email','$password')";
         if(mysqli_query(Database::dbConnection(),$sql)){
             $message = "<div class='alert alert-success' align='center'>Registration successfully...</div>";
             return $message;
         }else {
             die('query problem' . mysqli_error(Database::dbConnection()));
         }
     }

     public function forLogIn( $data ){
        $email = $data['email']; $password = $data['password'];

        //calling emailCheck method for email check
         $checkEmail = $this->emailCheck($email);
         if($checkEmail== false){
             $message= "<div class='alert alert-danger' align='center'>Email not exist...</div>";
             return $message;
         }
         if(strlen($password)< 6){
             $message = "<div class='alert alert-danger' align='center'>Password too short..</div>";
             return $message;
         }

        if($checkEmail){
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

            if(mysqli_query(Database::dbConnection(),$sql)){
              $queryResult = mysqli_query(Database::dbConnection(),$sql);
              $user = mysqli_fetch_array($queryResult);
              $rowCont = mysqli_num_rows($queryResult);
              if($rowCont){
                   $_SESSION['logIn'] = true;
                  $_SESSION ['id'] = $user['id'];
                   $_SESSION['name'] = $user['name'];
                  $_SESSION['userName'] = $user['username'];
                  $_SESSION['logInMassage'] = "<div class='alert alert-success' align='center'>Successfully you are login...</div>";
                 header('Location: index.php');
              }else{
                 $message = "<div class='alert alert-danger' align='center'> Email & Password not match...</div>";
                 return $message;
              }
            }
        }
     }
     //call from index page
     public function logOut(){
        session_destroy();
        session_unset();
        header('Location: login.php');
     }

     //call from index showAllUserInfo
     public function showAllUserInfo(){
        $sql = "SELECT * FROM users";
        if( mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            return $queryResult;
        }else{
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
     }

     //call from profile page showAllUserInfoById
     public function showAllUserInfoById( $id ){
        $sql = "SELECT * FROM users WHERE id = $id";
        if( mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            return $queryResult;
        }else{
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
     }
     //call from profile page for update profile info
    public function showAllUserInfoUpdateById($data){

     $id = $data['id']; $name = $data['name']; $userName = $data['user_name']; $email = $data['email'];
     echo $userName;
     echo $email;
        if( strlen($userName) < 4){
            $message = "<div class='alert alert-danger' aline='center'>Username is too short...</div>";
            return $message;
        } elseif( preg_match('/[^a-z0-9-]+/i', $userName)){
            $message = "<div class='alert alert-danger' align='center'>Username must only contain alphanumerical, dashes and underscores!</div>";
            return $message;
        }

        $sql = "UPDATE `users` SET  `name`='$name',`username`='$userName',`email`='$email' WHERE id = '$id'";
        if(mysqli_query(Database::dbConnection(),$sql)){
            $queryResult = mysqli_query(Database::dbConnection(),$sql);
            $_SESSION['userName'] = $userName;
            header('Location: index.php');
        }
        else{
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }


    public function checkPassword($data){
        $id = $data['id']; $password = $data['password'];
        $password = md5($password);
        $sql = "SELECT * FROM `users` WHERE id = '$id' AND password ='$password' ";
        if(mysqli_query(Database::dbConnection(), $sql)){
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            $rowCount = mysqli_num_rows($queryResult);
            if($rowCount){
                return true;
            }else{
                return false;
            }
        }else{
            die('query problem'.mysqli_error(Database::dbConnection()));
        }
    }
    public function changePassword($data){
        $id = $data['id']; $password = $data['password']; $newPassword = $data['new_password'];
        $result = $this->checkPassword($data);
        if($result){
            $newPassword = md5($newPassword);
            $sql = "UPDATE users SET password = '$newPassword'  WHERE id = '$id'";
            if(mysqli_query(Database::dbConnection(),$sql)){
                $queryResult = mysqli_query(Database::dbConnection(),$sql);
                $_SESSION['changePassword'] = "<div class='alert alert-success'>Password change successfully...</div>";
                return $queryResult;
            }else{
                die('query problem'.mysqli_error(Database::dbConnection()));
            }
        }else{
            $message = "<div class='alert alert-danger'>Wrong Password!</div>";
            return $message;
        }
    }
}