<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tablo";

$connection = new mysqli($servername, $username, $password, $database);

$id ="";
$name = "";
$surname = "";
$age = "";

$errormessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])){
        header("location: /deneme/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /deneme/index.php");
        exit;
    }
    $name = $row["first_name"];
    $surname = $row["last_name"];
    $age = $row["age"];

}
else {
    //$id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $age = $_POST["age"];

    do {
        if (empty($id) || empty($name) || empty($surname) || empty($age) ){
            $errormessage = "All the fields are required";
            break;
        }
        $sql = "UPDATE employees ".
            "SET name = '$name', surname = '$surname', age = '$age'" .
            "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errormessage = "Invalid query: " . $connection->error;
            break;
        }
        $successMessage = "Client updated correctly";
        header("location: /deneme/index.php");
        exit;

    }while(false);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width,initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>
    <?php
    if (!empty($errormessage)) {
        echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errormessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
    }
    ?>
    <form method="post">
        <input type="hidden" value="<?php echo $id; ?>"
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Surname</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="surname" value="<?php echo $surname; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Age</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
            </div>
        </div>
        <?php
        if (!empty($successMessage)) {
            echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
            ";
        }
        ?>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>