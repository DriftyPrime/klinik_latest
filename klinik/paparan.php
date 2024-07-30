<?php include 'header.php'?>
<section>   
    
    <body>
        <div class="form" style="width: 1100px; overflow-y:auto; max-height: 550px;margin-top: 20px;padding-top: 70px; position: absolute; z-index: 999;" >
            

            <h1 style="color: white; font-size: 30px; text-align: center;">Senarai Pesakit</h1>
            <form class="searchbar" action="" method="post">
                <input type="text" name="search" placeholder="Cari Nama Murid">
                <button type="submit" name="submit-search">search</button>
            </form>
            <style>
                table, th, td {
                    border: 1px solid white;
                    border-collapse: collapse;
                    text-align: center;
                    width: 1000px;
                    background-color: #333;
                    font-size: large;
                    margin: auto;
                }
                .table-link{
                    color: white;
                }
                .searchbar {
                    display: flex;
                    justify-content: center;
                }
                .searchbar input{
                    width: 500px;
                    height: 30px;
                    border-radius: 5px;
                    border: white 1px solid;
                    padding: 5px;
                    color: white;
                    margin-right: 10px;
                }
                .searchbar button{
                    width: 100px;
                    margin-left: 10px;
                }
            </style>
            <?php 
                include 'includes/dbh.inc.php';

                // Get sorting parameters
                $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'kelas';
                $sort_order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

                // SQL query with sorting
                if (isset($_POST['submit-search'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    $sql = "SELECT * FROM pesakit WHERE nama LIKE '%$search%' ORDER BY $sort_column $sort_order";
                } else {
                    $sql = "SELECT * FROM pesakit ORDER BY $sort_column $sort_order";
                }

                $result = mysqli_query($conn, $sql);
                $resultcheck = mysqli_num_rows($result);

                // Determine the next sort order
                $next_order = $sort_order == 'ASC' ? 'desc' : 'asc';

                if($resultcheck > 0){
                    $i = 1;
                    echo "<table id='patientTable'>";
                    echo "<tr>
                            <th>No.</th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=nama&order=$next_order'>Nama</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=kelas&order=$next_order'>Kelas</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=tinggi&order=$next_order'>Tinggi (cm)</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=berat&order=$next_order'>Berat (kg)</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=bmi&order=$next_order'>BMI</th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=blood_pressure&order=$next_order'>Tekanan Darah</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=blood_type&order=$next_order'>Jenis Darah</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=blood_sugar&order=$next_order'>Blood Sugar Level</a></th>
                            <th><a class='table-link' style='color: white; text-decoration: underline;' href='?sort=oxygen_level&order=$next_order'>Tahap Oksigen</a></th>
                          </tr>";
                    while($row = mysqli_fetch_assoc($result)){
                        $tinggi=$row['tinggi']*100;
                        $bmi=$row['bmi'];
                        echo "<tr>";
                        echo "<td>".$i++."</td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['nama']) ? $row['nama'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['kelas']) ? $row['kelas'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['tinggi']) ? $tinggi : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['berat']) ? $row['berat'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($bmi) ? $bmi : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['blood_pressure']) ? $row['blood_pressure'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['blood_type']) ? $row['blood_type'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['blood_sugar']) ? $row['blood_sugar'] : '-')."</a></td>";
                        echo "<td><a class='table-link' style='color: white;' href='sendtoindex.php?id=".$row['ic']."'>".(isset($row['oxygen_level']) ? $row['oxygen_level'] : '-')."</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            ?>
            <br>
            <button onclick="printTable()">Cetak</button>
        </div>
        <script> 
            function printTable() {
                var printContents = document.getElementById('patientTable').outerHTML;
                var printWindow = window.open('', '', 'height=500,width=800');
                printWindow.document.write('<!DOCTYPE html>');
                printWindow.document.write('<html><head><title>Print Table</title>');
                printWindow.document.write('<img src="image/smksbslogo.png" alt="Kad Kesihtan Logo" style="width: 50px; height: 50px;">');
                printWindow.document.write('<img src="image/ts25logo.png" alt="Kad Kesihtan Logo" style="width: 50px; height: 50px;">');
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
