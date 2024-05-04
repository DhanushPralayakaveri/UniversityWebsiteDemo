<?php
// Include authentication logic here to ensure the user is an admin

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "test";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$teacherName = $teacherImage = $teacherBranch = "";
$update = false;

// Handle the form submissions
if (isset($_POST['save'])) {
    $teacherName = $_POST['name'];
    $teacherImage = $_POST['image'];
    $teacherBranch = $_POST['branch'];

    // Insert new teacher record into the database
    $sql = "INSERT INTO teachers (name, image, branch) VALUES ('$teacherName', '$teacherImage', '$teacherBranch')";
    $conn->query($sql);

    header('location: admin.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;

    // Fetch teacher record for editing
    $result = $conn->query("SELECT * FROM teachers WHERE id=$id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_array();
        $teacherName = $row['name'];
        $teacherImage = $row['image'];
        $teacherBranch = $row['branch'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $teacherName = $_POST['name'];
    $teacherImage = $_POST['image'];
    $teacherBranch = $_POST['branch'];

    // Update the teacher record in the database
    $conn->query("UPDATE teachers SET name='$teacherName', image='$teacherImage', branch='$teacherBranch' WHERE id=$id");

    header('location: admin.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete the teacher record from the database
    $conn->query("DELETE FROM teachers WHERE id=$id");

    header('location: admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>21MIC7134-VITAP</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<div class="probootstrap-header-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                <span><i class="icon-location2"></i>Near Vijayawada, 522241 Andhra Pradesh</span>
                <span><i class="icon-phone2"></i>+91-7901091283</span>
                <span><i class="icon-mail"></i>info@vitap.ac.in</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
                <ul>
                    <li><a href="https://twitter.com/VITAPuniversity"><i class="icon-twitter"></i></a></li>
                    <li><a href="https://www.facebook.com/vitap.university/"><i class="icon-facebook2"></i></a></li>
                    <li><a href="https://www.instagram.com/vitap.university/"><i class="icon-instagram2"></i></a></li>
                    <li><a href="https://www.youtube.com/c/VITAP"><i class="icon-youtube"></i></a></li>
                    <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i class="icon-search"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-default probootstrap-navbar">
    <div class="container">
        <div class="navbar-header">
            <div class="btn-more js-btn-more visible-xs">
                <a href="#"><i class="icon-dots-three-vertical "></i></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php" title="uiCookies:VITAP"><img src="./img/logo.png" height="75px" width="150px" style="margin-top: -20px;"></a>
        </div>

        <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>

    <!-- ... (your admin header and navigation HTML) ... -->

    <div class="container">
        <form method="post" action="admin.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $teacherName; ?>">
            </div>
            <div class="form-group">
                <label>Image URL:</label>
                <input type="text" name="image" value="<?php echo $teacherImage; ?>">
            </div>
            <div class="form-group">
                <label>Branch:</label>
                <input type="text" name="branch" value="<?php echo $teacherBranch; ?>">
            </div>
            <?php if ($update == true): ?>
                <button type="submit" name="update">Update</button>
            <?php else: ?>
                <button type="submit" name="save">Save</button>
            <?php endif ?>
        </form>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM teachers");
                while ($row = $result->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['image']; ?></td>
                    <td><?php echo $row['branch']; ?></td>
                    <td>
                        <a href="admin.php?edit=<?php echo $row['id']; ?>">Edit</a>
                        <a href="admin.php?delete=<?php echo $row['id'];?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- ... (rest of your HTML content) ... -->

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
