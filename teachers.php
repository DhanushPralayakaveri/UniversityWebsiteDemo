<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve teacher information from the database
$sql = "SELECT id, name, image, branch FROM teachers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
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

    <!-- ... (your header and navigation HTML) ... -->

    <div class="probootstrap-search" id="probootstrap-search">
      <a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
      <form action="#">
        <input type="search" name="s" id="search" placeholder="Search a keyword and hit enter...">
      </form>
    </div>
    
    <div class="probootstrap-page-wrapper">
      <!-- Fixed navbar -->
      
      <div class="probootstrap-header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
              <span><i class="icon-location2"></i>Near Vijayawada, 522241
                Andhra Pradesh</span>
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
            <a class="navbar-brand" href="index.html" title="uiCookies:VITAP"><img src="./img/logo.png" height="75px" width="150px" style="margin-top: -20px;"></a>
          </div>

          <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li ><a href="index.html">Home</a></li>
              <li><a href="courses.html">Courses</a></li>
              <li class="active"><a href="teachers.html">Teachers</a></li>
              <li><a href="events.html">Events</a></li>
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">More</a>
                <ul class="dropdown-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="courses.html">Courses</a></li>
                  <li><a href="course-single.html">Special Courses</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                  <li><a href="news.html">News</a></li>
                </ul>
              </li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
      
      <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-left section-heading probootstrap-animate">
              <h1>Our Teachers</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="probootstrap-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="probootstrap-flex-block">
                <div class="probootstrap-text probootstrap-animate">
                  <h3>We Hired Certified Teachers For Our Students</h3>
                  <p>Our commitment to academic excellence is reflected in our decision to hire certified teachers who bring a wealth of knowledge and expertise to our students. These dedicated educators not only possess the necessary qualifications but also have a passion for teaching</p>
                  <p><a href="#" class="btn btn-primary">Learn More</a></p>
                </div>
                <div class="probootstrap-image probootstrap-animate" style="background-image: url(img/slider_3.jpg)">
                  <a href="https://www.youtube.com/watch?v=mJx6l65frqY" class="btn-video popup-vimeo"><i class="icon-play3"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


    <section class="probootstrap-section">
        <div class="container">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $teacherName = $row["name"];
                        $teacherImage = $row["image"];
                        $teacherBranch = $row["branch"];
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="probootstrap-teacher text-center probootstrap-animate">
                        <figure class="media">
                            <img src="<?php echo $teacherImage; ?>" class="img-responsive">
                        </figure>
                        <div class="text">
                            <h3><?php echo $teacherName; ?></h3>
                            <p><?php echo $teacherBranch; ?></p>
                            <!-- Add social links here if needed -->
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "No teachers found in the database.";
                }
                ?>
            </div>
        </div>
    </section>

    <section class="probootstrap-cta">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Get your admission now!</h2>
              <a href="#" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate" data-animate-effect="fadeInLeft">Enroll</a>
            </div>
          </div>
        </div>
      </section>
      <footer class="probootstrap-footer probootstrap-bg">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>About VIT-AP</h3>
                <p>With a history of 37 years of innovation in educational and research domain, VIT  has been a forerunner in delivering quality education. Consistently ranked among the top educational institutes in the country, the VIT group of institutions have had a proud tradition of pursuing knowledge and excellence</p>
                <h3>Social</h3>
                <ul class="probootstrap-footer-social">
                <li><a href="https://twitter.com/VITAPuniversity"><i class="icon-twitter"></i></a></li>
                <li><a href="https://www.facebook.com/vitap.university/"><i class="icon-facebook2"></i></a></li>
                <li><a href="https://www.instagram.com/vitap.university/"><i class="icon-instagram2"></i></a></li>
                <li><a href="https://www.youtube.com/c/VITAP"><i class="icon-youtube"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-md-push-1">
              <div class="probootstrap-footer-widget">
                <h3>Links</h3>
                <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="./courses.html">Courses</a></li>
                  <li><a href="./teachers.html">Teachers</a></li>
                  <li><a href="./news.html">News</a></li>
                  <li><a href="./contact.html">Contact</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="probootstrap-footer-widget">
                <h3>Contact Info</h3>
                <ul class="probootstrap-contact-info">
                  <li><i class="icon-location2"></i> <span>Near Vijayawada, 522241
                    Andhra Pradesh</span></li>
                  <li><i class="icon-mail"></i><span>info@vitap.ac.in</span></li>
                  <li><i class="icon-phone2"></i><span>+91-7901091283</span></li>
                </ul>
              </div>
            </div>
           
          </div>
          <!-- END row -->
          
        </div>

        <div class="probootstrap-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8 text-left">
              </div>
              <div class="col-md-4 probootstrap-back-to-top">
                <p><a href="#" class="js-backtotop">Back to top <i class="icon-arrow-long-up"></i></a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
    <!-- END wrapper -->
    

    <script src="js/scripts.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>
<?php
// Close the database connection
$conn->close();
?>
