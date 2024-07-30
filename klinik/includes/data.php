<?php
if (isset($_POST["submit"])) {
    require_once 'dbh.inc.php';

    // Retrieve and validate inputs
    $height = isset($_POST["tinggi"]) ? $_POST["tinggi"] : null;
    $weight = isset($_POST["berat"]) ? $_POST["berat"] : null;
    $bp = isset($_POST["tekanan_darah"]) ? $_POST["tekanan_darah"] : null;
    if (empty($_POST["blood_sugar"])) {
        $bloodsugar = null;
    } else {
        $bloodsugar = $_POST["blood_sugar"];
    }

    $bloodtype = isset($_POST["blood_type"]) ? $_POST["blood_type"] : null;
    $ic = $_POST["ic"];
    $oxygenlevel=isset($_POST["oxygenlevel"]) ? $_POST["oxygenlevel"] : null;
    if(empty($_POST["oxygenlevel"]))
    {
        $oxygenlevel = null;
    }else
    {
        $oxygenlevel = $_POST["oxygenlevel"];
    }
    

    $bmi = null;

    if (empty($_POST["tekanan_darah"])) {
        $sql = "SELECT * FROM pesakit WHERE nama = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $bp = $row["blood_pressure"];
        }
    }else{
        $bp = $_POST["tekanan_darah"];
    }

    // Convert height and weight to float
    $height = is_numeric($height) ? floatval($height) / 100 : null;
    $weight = is_numeric($weight) ? floatval($weight) : null;
    if($height !== null && $weight !== null)
    {   
        
        $bmi = round($weight / ($height * $height), 2);
    }
    // Build SQL query dynamically based on provided fields
    $sql = "UPDATE pesakit SET ";
    $params = [];
    $types = "";

    if ($height !== null) {
        $sql .= "tinggi = ?, ";
        $params[] = $height;
        $types .= "d";
    }
    if ($weight !== null) {
        $sql .= "berat = ?, ";
        $params[] = $weight;
        $types .= "d";
    }
    if ($bp !== null) {
        $sql .= "blood_pressure = ?, ";
        $params[] = $bp;
        $types .= "s";
    }
    if ($bmi !== null) {
        $sql .= "bmi = ?, ";
        $params[] = $bmi;
        $types .= "d";
    }
    if ($bloodsugar !== null) {
        $sql .= "blood_sugar = ?, ";
        $params[] = $bloodsugar;
        $types .= "d";
    }
    if ($bloodtype !== null) {
        $sql .= "blood_type = ?, ";
        $params[] = $bloodtype;
        $types .= "s";
    }
    if($oxygenlevel !== null){
        $sql .= "oxygen_level = ?, ";
        $params[] = $oxygenlevel;
        $types .= "d";
    }

    // Remove the last comma and space
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE ic = ?";
    $params[] = $ic;
    $types .= "s";

    // Prepare and execute SQL statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../index.php?error=none");
    exit();
}else
{
    header("Location: ../index.php");
    exit();
}
?>
