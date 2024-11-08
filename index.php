<?php
session_start();
include 'db_connect.php';

// Fetch Projects from the database
$projects_query = "SELECT * FROM projects ORDER BY created_at DESC LIMIT 6";  // Adjust limit as needed
$projects_result = mysqli_query($conn, $projects_query);

// Fetch Blogs from the database
$blogs_query = "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 6";  // Adjust limit as needed
$blogs_result = mysqli_query($conn, $blogs_query);

// Fetch skills from the database
$skills_query = "SELECT * FROM skills ORDER BY created_at DESC LIMIT 6";  // Fetching all relevant fields
$skills_result = mysqli_query($conn, $skills_query);

// Fetch terminologies from the database
$terminologies_query = "SELECT * FROM terminologies ORDER BY created_at DESC LIMIT 6";  // Fetching all relevant fields
$terminologies_result = mysqli_query($conn, $terminologies_query);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Saroj Pokhrel - Data Analyst</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">




<script>
    let currentTerminologyIndex = 0;
    const terminologyItems = document.querySelectorAll('.terminology-item');
    const totalTerminologies = terminologyItems.length;

    // Function to show the current terminology
    function showTerminology(index) {
        terminologyItems.forEach((item, i) => {
            item.style.display = (i === index) ? 'block' : 'none';
        });
    }

    // Show the first terminology
    showTerminology(currentTerminologyIndex);

    function changeTerminology(direction) {
        currentTerminologyIndex = (currentTerminologyIndex + direction + totalTerminologies) % totalTerminologies;
        showTerminology(currentTerminologyIndex);
    }
</script>









<!-- Wrapper -->
<div id="wrapper" class="fade-in">

    <!-- Intro -->
    <div id="intro">
        <h1>Saroj Pokhrel</h1>
        <p>Data Analyst | Sydney, Australia | +61 414 027 070 | <a href="mailto:sarojpokhrel41@gmail.com">sarojpokhrel41@gmail.com</a></p>
        <ul class="actions">
            <li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
        </ul>
    </div>

    <!-- Header -->
    <header id="header">
        <a href="index.php" class="logo">Saroj Pokhrel</a>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul class="links">
            <li class="active"><a href="index.php">Projects</a></li>
            <li><a href="projects.php">Portfolio</a></li>
        </ul>
        <ul class="icons">
            <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
            <li><a href="admin/index.php" aria-label="Login">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    class="feather feather-log-in">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
            </a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">

        <!-- Featured Project -->
        <?php if ($projects_row = mysqli_fetch_assoc($projects_result)) : ?>
            <section class="post featured">
                <header class="major">
                    <h2><a href="project.php?id=<?php echo $projects_row['id']; ?>"><?php echo $projects_row['title']; ?></a></h2>
                    <p><?php echo $projects_row['description']; ?></p>
                </header>
                <a href="project.php?id=<?php echo $projects_row['id']; ?>" class="image main">
                    <img src="images/<?php echo $projects_row['image_url']; ?>" alt="<?php echo $projects_row['title']; ?>" />
                </a>
                <ul class="actions special">
                    <li><a href="project.php?id=<?php echo $projects_row['id']; ?>" class="button large">Full Projects</a></li>
                </ul>
            </section>

            <section class="posts">
                    <?php while ($projects_row = mysqli_fetch_assoc($projects_result)) : ?>
                        <article>
                            <header>
                                <span class="date"><?php echo date("F j, Y", strtotime($projects_row['created_at'])); ?></span>
                                <h2><a href="project.php?id=<?php echo $projects_row['id']; ?>"><?php echo $projects_row['title']; ?></a></h2>
                            </header>
                            <a href="project.php?id=<?php echo $projects_row['id']; ?>" class="image fit"><img src="images/<?php echo $projects_row['image']; ?>" alt="<?php echo $projects_row['title']; ?>" /></a>
                            <p><?php echo $projects_row['short_description']; ?></p>
                            <ul class="actions special">
                                <li><a href="project.php?id=<?php echo $projects_row['id']; ?>" class="button">Full Story</a></li>
                            </ul>
                        </article>
                    <?php endwhile; ?>
                </section>


         



        <?php endif; ?>

    </div>

    <!-- Include footer -->
    <?php include 'footer.php'; ?>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
