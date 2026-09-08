<?php
$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $databaseName = trim($_POST["database_name"]);

    // Connect to MySQL
    $conn = new mysqli("localhost", "root", "");

    //first Check connection
    if ($conn->connect_error) {
        $message = "Connection failed: " . $conn->connect_error;
        $messageType = "danger";
    } 
    else {

        // second Validate database name
        if ($databaseName == "") {

            $message = "Please enter a database name.";
            $messageType = "danger";

        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $databaseName)) {

            $message = "Invalid database name. Only letters, numbers, and underscores are allowed.";
            $messageType = "danger";

        } 
        else {

            // thirth Build CREATE DATABASE SQL
            $sql = "CREATE DATABASE `$databaseName`";

            // TODO 4: Execute query
            if ($conn->query($sql) === TRUE) {
                $message = "Database '$databaseName' created successfully.";
                $messageType = "success";
            } 
            else {
                $message = "Error creating database: " . $conn->error;
                $messageType = "danger";
            }
        }

        // fifth close connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Create Database  is Lab</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">
```

</head>

<body class="bg-light">

<div class="container mt-5">

```
<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow">

            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Create Database</h3>
            </div>

            <div class="card-body">

                <?php if ($message != ""): ?>

                    <div class="alert alert-<?php echo $messageType; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">

                        <label class="form-label">
                            Database Name
                        </label>

                        <input
                            type="text"
                            name="database_name"
                            class="form-control"
                            placeholder="Example: wis_lab"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Create Database
                    </button>

                    <button
                        type="reset"
                        class="btn btn-secondary">
                        Clear
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
```

</div>

</body>
</html>
