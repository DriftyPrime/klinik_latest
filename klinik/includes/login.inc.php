<?php
    if(isset($_POST["submit"]))
    {
        $nama= $_POST["ic"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        
        loginUser($conn,$nama);
    }else
    {
        header("location: ../loginpage.php");
        exit();
    }