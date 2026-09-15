<?php

require_once "db.php";

$programs = ["Information Systems", "Software Engineering", "Computer Science"];
$errors   = [];
$old      = ["full_name" => "", "father_name" => "", "email" => "", "phone" => "", "program" => ""];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

   
    $full_name   = trim($_POST["full_name"]   ?? "");
    $father_name = trim($_POST["father_name"] ?? "");
    $email       = trim($_POST["email"]       ?? "");
    $phone       = trim($_POST["phone"]       ?? "");
    $program     = trim($_POST["program"]     ?? "");

    $old = compact("full_name", "father_name", "email", "phone", "program");

    if ($full_name === "")   { $errors[] = "Full name is required."; }
    if ($father_name === "") { $errors[] = "Father's name is required."; }
    if ($email === "")       { $errors[] = "Email is required."; }
    if ($phone === "")       { $errors[] = "Phone is required."; }
    if ($program === "")     { $errors[] = "Program is required."; }


    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }


    if ($program !== "" && !in_array($program, $programs, true)) {
        $errors[] = "Please select a valid program.";
    }

    // Insert with a prepared statement
    if (empty($errors)) {
        $stmt = $conn->prepare(
            "INSERT INTO applications (full_name, father_name, email, phone, program)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $full_name, $father_name, $email, $phone, $program);

        if ($stmt->execute()) {
            $stmt->close();
            // Redirect before any HTML output (prevents duplicate insert on refresh)
            header("Location: admission.php?saved=1");
            exit;
        } else {
            $errors[] = "Could not save the application: " . $stmt->error;
            $stmt->close();
        }
    }
}

// Task 4: SELECT is outside the POST check, so records show every time the page opens
$result = $conn->query("SELECT id, full_name, father_name, email, phone, program
                        FROM applications ORDER BY id DESC");

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Admission Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #eef2f7; }
        .page-header { background: #1f3b64; color: #fff; }
        .form-card { border-top: 4px solid #1f3b64; }
        .btn-submit { background: #1f3b64; border-color: #1f3b64; }
        .btn-submit:hover { background: #162c4b; border-color: #162c4b; }
    </style>
</head>
<body>

<header class="page-header py-4 mb-4">
    <div class="container">
        <h1 class="h3 mb-1">Kabul University</h1>
        <p class="mb-0">Faculty of Computer Science</p>
    </div>
</header>

<main class="container pb-5">

    <!-- Task 2: Admission form -->
    <div class="card shadow-sm form-card mb-5">
        <div class="card-body p-4">
            <h2 class="h4 mb-4">Student Admission Application</h2>

            <?php if (isset($_GET["saved"])): ?>
                <div class="alert alert-success">Application submitted successfully.</div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= e($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="admission.php">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"
                               value="<?= e($old["full_name"]) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name"
                               value="<?= e($old["father_name"]) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= e($old["email"]) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                               placeholder="+93 7XX XXX XXX" value="<?= e($old["phone"]) ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="program" class="form-label">Program</label>
                        <select class="form-select" id="program" name="program" required>
                            <option value="">-- Select a program --</option>
                            <?php foreach ($programs as $p): ?>
                                <option value="<?= e($p) ?>" <?= $old["program"] === $p ? "selected" : "" ?>>
                                    <?= e($p) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-submit px-4">Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Task 4: Applicants table -->
    <h2 class="h4 mb-3">Submitted Applications</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Father's Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Program</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= (int)$row["id"] ?></td>
                            <td><?= e($row["full_name"]) ?></td>
                            <td><?= e($row["father_name"]) ?></td>
                            <td><?= e($row["email"]) ?></td>
                            <td><?= e($row["phone"]) ?></td>
                            <td><?= e($row["program"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No applications yet. Submit the form above to add one.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
<?php
if ($result) { $result->free(); }
$conn->close();
?>
