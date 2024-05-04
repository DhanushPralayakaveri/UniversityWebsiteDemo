<?php
// Include authentication logic here to ensure the user is an ad

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "mydatabase";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$teacherName = $teacherSubject = "";
$update = false;

// Handle the form submissions
if (isset($_POST['save'])) {
    $teacherName = $_POST['name'];
    $teacherSubject = $_POST['subject'];

    // File upload logic
    $imageFile = file_get_contents($_FILES['imageFile']['tmp_name']);

    // Insert new teacher record into the database
    $stmt = $conn->prepare("INSERT INTO teachers_info (name, subject, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $teacherName, $teacherSubject, $imageFile);
    $stmt->execute();
    $stmt->close();

    header('location: ad.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;

    // Fetch teacher record for editing
    $result = $conn->query("SELECT * FROM teachers_info WHERE id=$id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_array();
        $teacherName = $row['name'];
        $teacherSubject = $row['subject'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $teacherName = $_POST['name'];
    $teacherSubject = $_POST['subject'];

    // File upload logic (if needed for updates)
    // ...

    // Update the teacher record in the database
    $stmt = $conn->prepare("UPDATE teachers_info SET name=?, subject=? WHERE id=?");
    $stmt->bind_param("ssi", $teacherName, $teacherSubject, $id);
    $stmt->execute();
    $stmt->close();

    header('location: ad.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete the teacher record from the database
    $conn->query("DELETE FROM teachers_info WHERE id=$id");

    header('location: ad.php');
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

    <!-- Your ad panel HTML content goes here -->

    <form method="post" action="ad.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $teacherName; ?>">
        </div>
        <div>
            <label>Subject:</label>
            <input type="text" name="subject" value="<?php echo $teacherSubject; ?>">
        </div>
        <div>
            <label>Image File:</label>
            <input type="file" name="imageFile">
        </div>
        <?php if ($update == true): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="save">Save</button>
        <?php endif ?>
    </form>

    <!-- Display existing teacher records in a table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT id, name, subject FROM teachers_info");
            while ($row = $result->fetch_array()) {
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td>
                    <a href="ad.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    <a href="ad.php?delete=<?php echo $row['id'];?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Include your JavaScript files here -->

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
