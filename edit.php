<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];
    $doctor_assigned = $_POST['doctor_assigned'];

    $stmt = $conn->prepare("UPDATE patients SET name = ?, age = ?, gender = ?, disease = ?, doctor_assigned = ? WHERE id = ?");
    $stmt->bind_param("sisssi", $name, $age, $gender, $disease, $doctor_assigned, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// Fetch existing patient data
$stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Patient not found.";
    exit();
}

$patient = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Patient</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; max-width: 400px; border-radius: 8px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 20px; background: #2196F3; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <a class="back" href="index.php">&larr; Back to list</a>
    <h1>Edit Patient</h1>
    <form method="POST" action="edit.php?id=<?php echo $patient['id']; ?>">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required>

        <label>Age</label>
        <input type="number" name="age" value="<?php echo $patient['age']; ?>" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="Male" <?php if ($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($patient['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>

        <label>Disease</label>
        <input type="text" name="disease" value="<?php echo htmlspecialchars($patient['disease']); ?>" required>

        <label>Doctor Assigned</label>
        <input type="text" name="doctor_assigned" value="<?php echo htmlspecialchars($patient['doctor_assigned']); ?>" required>

        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>
