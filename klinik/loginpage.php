<?php include 'header.php'?>

<section>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

       .form{
        width: 500px;
        height: 340px;
        color: #fff;
        background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        border-radius: 10px;
        padding: 40px 25px;
       }
       .form h1
       {
           width: 500px;
           text-align: center;
           padding-left: 11px;
           margin-bottom: 20px;
           font-size: 35px;
           color: white;
       }

       .form input
       {
        width: 100%;
        height: 25px;
        padding-top: 10px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        background: transparent;
        border-bottom: 1px solid #fff;
        border-top: none;
        border-right: none;
        border-left: none;
        color: #fff;
        font-size: 15px;
        outline: none;
       }

       .form button
       {
        width: 100%;
        height: 40px;
        background-color: green;
        font-size: 18px;
        border-radius: 10px;
        border: none;
        outline: none;
        color: white;
        cursor: pointer;
        margin-bottom: 25px;
       }
       
       .form button:hover
       {
        color: grey;
       }

       .form p
       {
        color: white;
        padding-top: 10px;
       }
       .form a 
       {
        text-decoration: none;

        color: cyan;
       }
       .form a:hover
       {
        color: purple;
       }

    </style>
    <body>

        <div class="form">
            <h1>Pesakit</h1>
            <form action="includes/login.inc.php" method="POST">
                
               
                <input type="text" class="form-control mb-2" placeholder="IC Pesakit" name="ic"required/>
                <button type="submit" name="submit" class="btn btn-primary">Masuk</button><br>
                <label>Belum Daftar?</label>
                <a href="signup.php" style="text-decoration:none">Daftar</a>
    
                <?php
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"]== "emptyinput")
                        {
                            echo"<p>Fill In all fields!</p>";
                        }else if($_GET["error"]== "wronglogin")
                        {
                            echo"<p>incorrect login information</p>";
                        }else if($_GET["error"]== "invalidemail")
                        {
                            echo"<p style=\"color:red\">invalid email</p>";
                        }else if($_GET["error"]== "emaildoesntexist")
                        {
                            echo"<p style=\"color:red\">ic doesn't exist</p>";
                        }
                        
                    }
                ?>
            </form> 
            
        </div>
    </body>



</section>
<?php
    require  'includes/dbh.inc.php';
?>
<?php include 'footer.php'?>