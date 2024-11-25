<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); // Added exit() to stop further execution
} elseif ($_SESSION['usertype'] == 'student') {
    header("location:login.php");
    exit(); // Added exit() to stop further execution
}

// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$db = "bcaproject";
$conn = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select data from table
$sql = "SELECT * FROM `admission`"; // Removed unnecessary space after table name
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 20px;
        }
        
        th,
        td {
            border: 1px solid;
            padding: 8px;
            text-align: left;
            background-color: lightblue;
            border-color: black;
        }
        
        th {
            background-color: skyblue;
            font-weight: bold;
        }
        
        h1 {
            font-style: normal;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="">
    <div>
        <?php include 'Admincss.php'; ?>
        <?php include 'adminsidebar.php'; ?>
    </div>
</head>

<body>
    <center>
        <div class="content">
            <h1 style="text-align:center"> Admission Details</h1>
            <?php
                echo "<table>";
                echo "<tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    

                    echo "<tr><td>" . $row["firstname"] . "</td><td>" . $row["middlename"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["DOB"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Address"] . "</td></tr>";
                }
                echo "</table>";
            ?>

        </div>
    </center>
</body>

</html>

<?php
// Close connection
mysqli_close($conn);
?>
