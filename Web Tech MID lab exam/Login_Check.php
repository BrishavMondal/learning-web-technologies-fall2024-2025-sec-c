<?php
    session_start();
    $username;
    $password;
    $name;
    $id;
    $email;
    $date;
    $bg;


    if(isset($_REQUEST['register']))
    {
        header('location:form.html');
    
    if(isset($_REQUEST['submitf'])){
       
        $username = trim($_POST['username']);
        $password = trim($_REQUEST['password']);
        $name=trim($_REQUEST['name']);
        $id=trim($_REQUEST['id']);
        $email=trim($_REQUEST['email']);
        $date=trim($_REQUEST['date']);
        $bg=trim($_REQUEST['bg']);
        }
    }




    elseif(isset($_REQUEST['submit']))
    {
        $usernamel = trim($_POST['usernamel']);
        $passwordl = trim($_REQUEST['passwordl']);
        if($usernamel == null || empty($passwordl))
        {header('location: login.html');}

        elseif(strcmp($usernamel,$username)==0 && strcmp($password,$passwordl)==0){
          echo "your username is: {$username}";
          echo "Password is     : {$password}";
          echo "Your Name       : {$name}";
          echo "Your Id         : {$id}";
          echo "Your email      : {$email}";
          echo "Your DOB        : {$date}";
          echo "Your Blood Group: {$bg}";
        }
    }

    
   else

    {
        header('location: login.html');
    }

?>