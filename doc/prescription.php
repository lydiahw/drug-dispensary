<?php

include "connection.php";

$doc_name = $_POST['doctor-name'];
$patient_name = $_POST['patient-name'];
$drug_name = $_POST['drug-name'];
$quantity = $_POST['quantity'];
$frequency = $_POST['frequency'];

// Retrieve the DrugID using prepared statement
$stmt1 = $conn->prepare("SELECT DrugID FROM drug WHERE Name = ?");
$stmt1->bind_param("s", $drug_name);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $drug_id = $row1['DrugID'];
} else {
    echo "Prescribed drug not found in the database.";
    exit();
}

// Retrieve the PatientID using prepared statement
$stmt2 = $conn->prepare("SELECT UserID FROM doc_pat WHERE Name = ?");
$stmt2->bind_param("s", $patient_name);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $patient_id = $row2['UserID'];
} else {
    echo "Patient not found in the database.";
    exit();
}

// Retrieve the DoctorID using prepared statement
$stmt3 = $conn->prepare("SELECT UserID FROM doc_pat WHERE Name = ?");
$stmt3->bind_param("s", $doc_name);
$stmt3->execute();
$result3 = $stmt3->get_result();

if ($result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    $doctor_id = $row3['UserID'];
} else {
    echo "Doctor not found in the database.";
    exit();
}

// Calculate the total price
$prescribedDrugName = $_POST['drug-name'];
$stmt4 = $conn->prepare("SELECT price FROM drug WHERE name = ?");
$stmt4->bind_param("s", $prescribedDrugName);
$stmt4->execute();
$result4 = $stmt4->get_result();

if ($result4->num_rows > 0) {
    $row4 = $result4->fetch_assoc();
    $prescribedDrugPrice = $row4['price'];

    $prescribedQuantity = $_POST['quantity'];

    // Calculate the total price
    $totalPrice = $prescribedDrugPrice * $prescribedQuantity;

} else {
    echo "Prescribed drug not found in the database.";
    exit();
}

// Insert the prescription into the prescriptions table
$stmt = $conn->prepare("INSERT INTO prescription(DoctorID, PatientID, DrugID, Quantity, Frequency, Total) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiisd", $doctor_id, $patient_id, $drug_id, $quantity, $frequency, $totalPrice);
$stmt->execute();
$prescription_id = $stmt->insert_id;
$stmt->close();
$conn->close();

// Redirect the user to the different page with the prescription ID
header("Location: patient.php?prescription_id=" . $prescription_id);
exit();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Result</title>
    <style>
        body {
             background-color:#547b84;
    font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        .result-container {
            background-color: #eaf2f5;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h2 {
            color: #333;
        }
        
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Prescription Submitted Successfully!</h2>
        <p><strong>Doctor:</strong> <?php echo $doc_name; ?></p>
        <p><strong>Patient:</strong> <?php echo $patient_name; ?></p>
        <p><strong>Drug:</strong> <?php echo $drug_name; ?></p>
        <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
        <p><strong>Frequency:</strong> <?php echo $frequency; ?></p>
        <p><strong>Total Price:</strong> $<?php echo $totalPrice; ?></p>
    </div>
</body>
</html>
