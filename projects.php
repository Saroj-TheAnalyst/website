<?php
session_start();
include 'db_connect.php';

// Set the number of projects per page
$projects_per_page = 4;

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $projects_per_page;

// Fetch Projects from the database with LIMIT and OFFSET for pagination
$projects_query = "SELECT * FROM projects ORDER BY created_at DESC LIMIT $projects_per_page OFFSET $offset";  
$projects_result = mysqli_query($conn, $projects_query);

// Fetch total number of projects to calculate total pages
$total_projects_query = "SELECT COUNT(*) as total FROM projects";
$total_projects_result = mysqli_query($conn, $total_projects_query);
$total_projects_row = mysqli_fetch_assoc($total_projects_result);
$total_projects = $total_projects_row['total'];
$total_pages = ceil($total_projects / $projects_per_page);
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Projects - Saroj Pokhrel</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>
    <body class="is-preload">

        <div id="wrapper">

            <header id="header">
                <a href="index.php" class="logo">Saroj Pokhrel</a>
            </header>

            <nav id="nav">
                <ul class="links">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="projects.php">Projects</a></li>
                    <li><a href="blogs.php">Blogs</a></li>
                </ul>
                <ul class="icons">
                    <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                </ul>
            </nav>

            <div id="main">

                <!-- Skills Section with Two Columns -->
<section class="skills">
    <header class="major">
        <h3>Skills</h3>
    </header>
    <div class="skills-container">
        <?php while ($skill_row = mysqli_fetch_assoc($skills_result)) : ?>
            <div class="skill-item">
                <span class="arrow">➤</span> <!-- Arrow or bullet point -->
                <p><?php echo nl2br(htmlspecialchars($skill_row['skill_name'])); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Terminologies Section -->
<section class="terminologies">
    <header class="major">
        <h3>Terminologies</h3>
    </header>
    <div class="terminology-slider">
        <div class="terminology-slide">
            <?php
            $terminologies = [];
            while ($terminology_row = mysqli_fetch_assoc($terminologies_result)) {
                $terminologies[] = nl2br(htmlspecialchars($terminology_row['term']));
            }
            ?>
            <div class="terminology-item active">
                <p><?php echo $terminologies[0]; ?></p>
            </div>
            <?php for ($i = 1; $i < count($terminologies); $i++): ?>
                <div class="terminology-item">
                    <p><?php echo $terminologies[$i]; ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>


                <!-- Pagination -->
                <footer>
                    <div class="pagination">
                        <?php if ($current_page > 1): ?>
                            <a href="?page=<?php echo $current_page - 1; ?>" class="previous">Prev</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="page <?php if ($i == $current_page) echo 'active'; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages): ?>
                            <a href="?page=<?php echo $current_page + 1; ?>" class="next">Next</a>
                        <?php endif; ?>
                    </div>
                </footer>

            </div>
 <!-- Include footer -->
 <?php include 'footer.php'; ?>

           

        </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrollex.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/browser.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

    </body>
</html>
