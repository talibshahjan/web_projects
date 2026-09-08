<?php

$message = "";
$messageType = "";

// Connect to wis_lab database
$conn = new mysqli("localhost", "root", "", "wis_lab");

// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

// Create students table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    department VARCHAR(80) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute query
if ($conn->query($sql) === TRUE) {

    $message = "Students table created successfully.";
    $messageType = "success";

} else {

    $message = "Error creating table: " . $conn->error;
    $messageType = "danger";

}

// Close connection
$conn->close();

?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Create Students Table</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">
```

</head>

<body class="bg-light">

<div class="container mt-5">

```
<div class="row justify-content-center">

    <div class="col-md-7">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h3 class="mb-0">
                    Create Students Table
                </h3>

            </div>

            <div class="card-body">

                <div class="alert alert-<?php echo $messageType; ?>">

                    <?php echo htmlspecialchars($message); ?>

                </div>

                <a
                    href="insert_student.php"
                    class="btn btn-primary">

                    Add Student

                </a>

            </div>

        </div>

    </div>

</div>
```

</div>

</body>
</html>
