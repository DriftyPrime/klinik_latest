<?php
    include_once'header.php';
?>
<style>
        .form {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 40px 25px;
            border-radius: 10px;
            color: #fff;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));
        }

        .form h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 35px;
            color: white;
        }

        .form input,
        .form select {
            width: 100%;
            padding: 5px;
            margin-bottom: 15px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            color: #fff;
            font-size: 15px;
            box-sizing: border-box;
        }

        .form button {
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
        .form a:hover,
        .form button:hover {
            color: grey;
        }

        .form a {
            text-decoration: none;
            color: cyan;
        }

        .form a:hover {
            color: grey;
        }

        .form p {
            color: red;
        }
</style>
<script>
    function validateForm() 
    {
        var weight = document.getElementById("weight").value.trim();
        var height = document.getElementById("height").value.trim();

        if ((weight !== "" && height === "") || (weight === "" && height !== "")) {
            alert("Please enter both weight and height.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission

    }
</script>
<section>

    <?php   
        if($_SESSION["id"]==null)
        {
            header("location: signup.php");
        }elseif($_SESSION["id"]!=null)
        {
            echo "<div>".$_SESSION["nama"]."</div>";
            echo "<div>IC: ".$_SESSION["id"]."</div>";
        }
    ?>
    <body>

        <div class="form" style="z-index: 992;">
            <h1>Klinik Kesihatan SMK SBS</h1>
            <form action="includes/data.php" method="POST" onsubmit="return validateForm()">
                
                <p style="color: white; font-size: 30px; text-align: center;"><?php echo $_SESSION["nama"];?></p>
                <input class="input" type="text" placeholder="tinggi badan(cm)" id="height" name="tinggi">
                <input class="input" type="text" placeholder="berat badan(kg)" id="weight" name="berat">
                <select class="input" name="blood_type">
                    <option value="" disabled selected style="color: grey;">Jenis Darah</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <input class="input" type="text" placeholder="tekanan darah" name="tekanan_darah">
                <input class="input" type="text" placeholder="name" name="ic" hidden value="<?php echo $_SESSION["id"];?>">
                <input class="input" type="text" placeholder="kadar gula" name="blood_sugar">
                <input class="input" type="text" placeholder="Tahap oksigen" name="oxygenlevel">

                <button type="submit" name="submit">Submit</button>
                <button><a href="includes/logout.php" style="color: white;">Pesakit Seterusnya</a></button>
                <?php 
                    include_once 'includes/dbh.inc.php';
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"]== "none")
                        {
                            echo"<p style=\"color:lightgreen; font-size:20px\">Maklumat Pesakit Berjaya Dimasukkan!!</p>";
                        }
                    }
                    echo"<table class='table-profil' id='patientTable'>";
                    echo"<tr>";
                   
                    echo"<th>Tinggi Badan</th>";
                    echo"<th>Berat Badan</th>";
                    echo"<th>BMI</th>";
                    echo"<th>Jenis Darah</th>";
                    echo"<th>Tekanan Darah</th>";
                    echo"<th>Kadar Gula </th>";
                    echo"<th>Tahap Oksigen</th>";
                    echo"</tr>";
                    echo"<tr>";
                    
                    $sql="SELECT * FROM pesakit WHERE ic = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("location: index.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION["id"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        
                        $tinggi=0;
                        $tinggi= $row["tinggi"]*100;
                        $weight =0;
                        $weight = $row["berat"];
                        
                        
                        if($tinggi!==0 && $weight!==0)
                        {
                            $bmi = round($weight / ($row["tinggi"] * $row["tinggi"]), 2);
                            echo"<td>".$tinggi."</td>";
                            echo"<td>".$row["berat"]."</td>";
                            echo "<td>".$bmi."</td>";
                            echo"<td>".$row["blood_type"]."</td>";
                            echo"<td>".$row["blood_pressure"]."</td>";
                            echo"<td>".$row["blood_sugar"]."</td>";
                            echo"<td>". $row["oxygen_level"]."</td>";
                        }
                        else
                        {
                            $bmi = "-";
                            echo "<td>".$tinggi."</td>";
                            echo"<td>".$row["berat"]."</td>";
                            echo "<td>".$bmi."</td>";
                            echo"<td>".$row["blood_type"]."</td>";
                            echo"<td>".$row["blood_pressure"]."</td>";
                            echo"<td>".$row["blood_sugar"]."</td>";
                            echo"<td>". $row["oxygen_level"]."</td>";
                        }
                        
                    }
                    echo"</tr>";
                    echo"</table>";
                ?>
                <button  style="margin-top: 10px;height:40px;" onclick="printTable()">Cetak</button>
            </form>

        </div>   
        <script> 
            function printTable() {
                var printContents = document.getElementById('patientTable').outerHTML;
                var printWindow = window.open('', '', 'height=500,width=800');
                printWindow.document.write('<!DOCTYPE html>');
                printWindow.document.write('<html><head><title>Kad Kesihtan</title>');
                printWindow.document.write('<img src="image/smksbslogo.png" alt="Kad Kesihtan Logo" style="width: 50px; height: 50px;">');
                printWindow.document.write('<img src="image/ts25logo.png" alt="Kad Kesihtan Logo" style="width: 50px; height: 50px;">');
                printWindow.document.write('<h2 style="text-align: center;">' + '<?php echo $_SESSION["nama"]; ?>' + '</h2>');
                printWindow.document.write('<style>');
                printWindow.document.write('table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }');
                printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
                printWindow.document.write('th { background-color: #f2f2f2; }');
                printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; }');
                printWindow.document.write('@page { size: auto; margin: 15mm; }');
                printWindow.document.write('body { margin: 15mm; }');
                printWindow.document.write('</style>');
                printWindow.document.write('</head><body>');
                printContents = printContents.replace(/<a[^>]*>/g, '');
                printContents = printContents.replace(/<\/a>/g, '');
                printWindow.document.write(printContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script>
            
        
             
            
    </body>
</section>
<?php include 'footer.php'?>