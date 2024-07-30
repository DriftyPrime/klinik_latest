<?php 

if(isset($_POST["submit"]))
{
   
    $name = $_POST["name"];
    if(empty($_POST["tingkatan"])&&empty($_POST["class"]))
    {
        $kelas=null;
    }else{
        $kelas = $_POST["tingkatan"].$_POST["class"];
    }
    $nombortelefon = $_POST["nombor_telefon"];
    $nombortelefon = preg_replace("/[^0-9]/", "", $nombortelefon);
    $ic=$_POST["ic"];
    $ic = preg_replace("/[^0-9]/", "", $ic);
    $age=$_POST["umur"];



    

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
 
    
    
    if(nameexist($conn,$ic)!==false)
    {   

        header("location: ../signup.php?error=emailalreadyexist");
        exit();
    }else{
        createuser($conn,$name,$kelas,$ic,$nombortelefon,$age);

        loginUser($conn, $ic);
    
    }
    

}