<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];
    $doctor_assigned = $_POST['doctor_assigned'];

    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, disease, doctor_assigned) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $age, $gender, $disease, $doctor_assigned);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Patient</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; max-width: 400px; border-radius: 8px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 20px; background: #00b894; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <a class="back" href="index.php">&larr; Back to list</a>
    <h1>Add New Patient</h1>
    <form method="POST" action="create.php">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Age</label>
        <input type="number" name="age" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Disease</label>
        <input type="text" name="disease" required>

        <label>Doctor Assigned</label>
        <input type="text" name="doctor_assigned" required>

        <button type="submit">Add Patient</button>
    </form>
</body>
</html>
