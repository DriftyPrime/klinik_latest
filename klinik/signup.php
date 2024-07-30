<?php include'header.php'?>

<section>
   
    <style>

        .form{
        width: 550px;
        height: auto;   
        color: #fff;
        background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 50px;
        transform: translate(-50%,-50%);
        border-radius: 10px;
        padding: 40px 25px;
       }
       .form h1
       {
           width: 550px;
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
        padding-left: 3px;
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
       .form select
       {
        width: 100%;
        background: transparent;
        background-color: grey;
        color: #fff;
        font-size: 15px;
        border-radius: 4px;
        height: 25px;
        color: white;
        border: none;
        padding-bottom: 10px;
        margin-bottom: 15px;
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

       .form a 
       {
        text-decoration: none;

        color: cyan;
       }
       .form a:hover
       {
        color: purple;
       }
       .form p
       {
        color : red;
       }

    </style>
    <script>
        function validateForm() {
            var input=document.getElementById("number").value;
            if(isNaN(input) || input.trim()== ""){
                alert("Sila hanya masuk nombor bagi umur, nombor_telefon dan nombor kad pengenalan");   
                return false;// prevent from submission
            }
            return true;
        }
        function alreadydaftar()
        {
            alert("Pesakit sudah daftar");
        }
    </script></script>
    <div class="form">
        <h1>Daftar Pesakit</h1>
        <form action="includes/signup.inc.php" method="post" onsubmit="return validateForm()" >    
                <input type="text" class="form-control mb-2" placeholder="Nama Pesakit" name="name" required/>
                <input type="text" class="form-control mb-2" placeholder="Nombor Kad Pengenalan (tanpa -)" id="number" name="ic" required/>
                <input type="text" class="form-control mb-2" placeholder="Nombor Telefon (tanpa -)" id="number" name="nombor_telefon" />
                <input type="text" class="form-control mb-2" placeholder="umur" id="number" name="umur" required maxlength="2" required/>

                <p style="color:white">Tingkatan</p>
                <select name="tingkatan" aria-placeholder="Tingkatan">
                    <option value="" disabled selected style="color: grey;">Pilih Tingkatan</option>
                    <option value="" >GURU/VIP</option> 
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p style="color:white">Kelas</p>
                <select name="class">
                    <option value="" disable selected style="color:grey">PILIH KELAS</option>
                    <option value="">GURU/VIP</option>
                    <option value="A">Angsana</option>
                    <option value="B">Beringin</option>
                    <option value="C">Cendana</option>
                    <option value="D">Damar</option>
                    <option value="M">Meranti</option>
                    <option value="K">Keruing</option>
                    <option value="B">Jati</option>
                    <option value="G">Gaharu</option>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Daftar</button><br>
                <label>Pesakit sudah daftar?</label>
                <a href="loginpage.php" style="text-decoration: none">Pesakit</a>

                <?php
                    require_once 'includes/dbh.inc.php';
                    require_once 'includes/functions.inc.php';
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"]== "stmtfailed")
                        {
                            echo"<p>something went wrong,try again</p>";
                        }else if($_GET["error"]== "emailalreadyexist")
                        {
                            echo"<script>alreadydaftar()</script>";
                            
                        }else if($_GET["error"]== "none")
                        {
                            echo"<p style='color:green'>successfully signed up</p>";
                        
                        }
                    }
                ?>
        </form>  
    </div>       
</section>
<?php include 'footer.php'?>