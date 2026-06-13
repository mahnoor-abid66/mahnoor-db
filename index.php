<?php
include 'db.php';

// Fetch all patients
$sql = "SELECT * FROM patients ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #00b894; color: white; }
        tr:hover { background: #f1f1f1; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: #fff; font-size: 14px; }
        .btn-add { background: #00b894; margin-bottom: 15px; display: inline-block; }
        .btn-edit { background: #2196F3; }
        .btn-delete { background: #f44336; }
        .actions a { margin-right: 5px; }
    </style>
</head>
<body>
    <h1>Hospital Patients</h1>
    <a class="btn btn-add" href="create.php">+ Add New Patient</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Disease</th>
            <th>Doctor Assigned</th>
            <th>Admitted On</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['disease']); ?></td>
                    <td><?php echo htmlspecialchars($row['doctor_assigned']); ?></td>
                    <td><?php echo $row['admitted_on']; ?></td>
                    <td class="actions">
                        <a class="btn btn-edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="btn btn-delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this patient record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No patients found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
