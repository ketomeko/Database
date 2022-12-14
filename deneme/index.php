<?php
    session_start();
    $_SESSION;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section id = "header">
        <nav>
            <img src="logo.png">
        </nav>
    </section>
    <div class="container my-5">
        <h2>List of Contents</h2>
        <a class="btn btn-primary" href="/deneme/create.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "tablo";
                //create connection
                $connection = new mysqli($servername,$username,$password,$database);
                //check connection
                if ($connection -> connect_error) {
                    die("Connection Failed: ". $connection -> connect_error);
                }
                $sql = "SELECT * FROM employees";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query". $connection->error);
                }
                while($row = $result -> fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[first_name]</td>
                        <td>$row[last_name]</td>
                        <td>$row[age]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/deneme/edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/deneme/delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
<!--
                <tr>
                    <td>1</td>
                    <td>Kerem</td>
                    <td>Peker</td>
                    <td>21</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/deneme/edit.php">Edit</a>
                        <a class="btn btn-danger btn-sm" href="/deneme/delete.php">Delete</a>
                    </td>
                </tr>
                -->
            </tbody>
        </table>
    </div>
</body>
</html>