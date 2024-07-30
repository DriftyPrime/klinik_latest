<?php
    include 'includes/dbh.inc.php';

    $id=$_GET['id'];
    
    function nameexist($conn,$ic)
    {
        
        $sql ="SELECT * FROM pesakit WHERE ic=?; ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("location: signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s" , $ic);  
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($resultData) > 0)
        {
            $row = mysqli_fetch_assoc($resultData);
            return $row;
        }
        else
        {
            return false;
        }
        
        mysqli_stmt_close($stmt);
    }

    function loginUser($conn, $ic)
    {
        $emailExists = nameexist($conn, $ic);

        if ($emailExists === false) {
            header("location: loginpage.php?error=emaildoesntexist");
            exit();
        }
        $sql="SELECT * FROM pesakit WHERE ic=?";
        // to be added
        

        $id =$emailExists["ic"];
        $name=$emailExists["nama"];
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["nama"]=$name;
        header("location: index.php");
        exit();
    }
    echo $id;

   loginUser($conn, $id);
