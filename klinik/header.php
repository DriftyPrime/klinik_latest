<?php session_start();?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/style.css">
    <head>
        <meta charset="UTF-8">
        <title> Klinik Kesihatan SMK SBS</title>
        
    </head>
    
    <style> 
        body
        {
            background-image: url("image/picturesdoctor.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        .logo-header
        {
            float: left;
            width: 75px;
            height: 75px;
            padding-top: 70px;
           
            
        }
    </style>
    <body>

        <ul class="nav">
            <!-- NOT IN USE FOR NOW !!!
             
            <div class="logo">
                <a href="index.php" style="text-decoration: none; color:#ffffff;"
                    onmouseover="this.style.color='#c1c1c1'"
                    onmouseout="this.style.color='#ffffff'">
                 HOME</a>
            </div> 
            -->
           
            <li><a href="paparan.php">Paparan</a> </li>
            <li class="dropdown" style="width: 70px;">
                <a href="javascript: void(0)" class="dropbtn">Pesakit</a>
                <div class="dropdown-content">
                   <?php   
                        if(isset($_SESSION["id"]))
                        {
                            //logged in
                            echo"<a href='includes/logout.php'>Pesakit Seterusnya</a>";
                        }else
                        {
                            //not logged in
                            echo"<a href='loginpage.php'>Pesakit</a>";
                            echo"<a href='signup.php'>Daftar</a>";
                        }
                    ?>
                </div>
               
            </li>
            
        </ul>
        
        <img src=image/smksbslogo.png class="logo-header">   
        <img src=image/ts25logo.png class="logo-header">
        
    </body>
</html>
