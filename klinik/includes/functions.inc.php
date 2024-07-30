<?php
    function nameexist($conn,$ic)
    {
        
        $sql ="SELECT * FROM pesakit WHERE ic=?; ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("location: ../signup.php?error=stmtfailed");
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

    
    function createuser($conn,$name,$kelas,$ic,$nombortelefon,$age)
    {
        $sql ="INSERT INTO `pesakit` (`nama`,`kelas`,`ic`,`phone_number`,`age`) VALUES(?,?,?,?,?); ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

                               
        mysqli_stmt_bind_param($stmt,"sssss", $name,$kelas,$ic,$nombortelefon,$age);        
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);


        header("location: ../signup.php?error=none");
        

    }
    
   
    function loginUser($conn, $ic)
    {
        $emailExists = nameexist($conn, $ic);

        if ($emailExists === false) {
            header("location: ../loginpage.php?error=emaildoesntexist");
            exit();
        }
        $sql="SELECT * FROM pesakit WHERE ic=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("location: ../loginpage.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"s",$id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            
        }
        

        $id =$emailExists["ic"];
        $name=$emailExists["nama"];
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["nama"]=$name;
        $_SESSION["nombortelefon"]=$row["phone_number"];
        $_SESSION["age"]=$row["age"];
        
        header("location: ../index.php");
        exit();
    }





    

