<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BBC News</title>

        <meta charset="UTF-8">
        <meta name="author" content="Angelina Doria Bedek">
        <meta name="description" content="Visit BBC News for up-to-the-minute news, breaking news, video, audio and feature stories. 
                                            BBC News provides trusted World and UK news as well as local and regional perspectives. 
                                            Also entertainment, business, science, technology and health news.">
        <meta name="keywords" content="news, breaking news, top stories, global news, current events, politics, business, technology, 
                                            sports, entertainment, world news, international news, journalism">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" type="image/x-icon" href="images/favicon.ico">
        <link rel="stylesheet" href="style.css">

        <?php include 'connect.php';?>
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li><img src="images/logo.png" id="logo"></li>
                    <li><a href="index.php" target="_self">Home</a></li>
                    <li><a href="kategorija.php?id=News" target="_self">News</a></li>
                    <li><a href="kategorija.php?id=Sport" target="_self">Sport</a></li>
                    <li><a href="login.php" target="_blank">Administration</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div id="welcome_div">
                <h1 id="welcome">Welcome to BBC.com</h1>
                <p id="date"><?php echo date('l, j F'); ?></p>
            </div>
            
            <section>
                <h2 class="type" style="border-left: 5px solid #8B0000;">
                    <a href="kategorija.php?id=News" target="_self">News</a>
                </h2>

                <div>
                    <?php 
                        if($dbc) {
                            $query = "SELECT * FROM article WHERE archive = 0 AND category = 'News' ORDER BY id DESC LIMIT 3";
                            $result = mysqli_query($dbc, $query) or die("Unable to query database.");

                            if($result) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['id'];
                                    $date = $row['date'];
                                    $title = $row['title'];
                                    $summary = $row['summary'];
                                    $content = $row['content'];
                                    $image = $row['image'];
                                    $category = $row['category'];
                                    $archive = $row['archive'];
                    ?>

                                    <article>
                                        <a href="clanak.php?id='<?php echo $id; ?>'" target="_self">
                                            <img src="images/<?php echo $image; ?>">
                                            <h3><?php echo $title; ?></h3>
                                            <p><?php echo $summary; ?></p>
                                        </a>
                                    </article>
                            
                        <?php   }
                            }
                        }?> 
                </div>
            </section>

            <section>
                <h2 class="type" style="border-left: 5px solid #FFD230;">
                    <a href="kategorija.php?id=Sport" target="_self">Sport</a>
                </h2>

                <div>
                    <?php 
                        if($dbc) {
                            $query2 = "SELECT * FROM article WHERE archive = 0 AND category = 'Sport' ORDER BY id DESC LIMIT 3";
                            $result2 = mysqli_query($dbc, $query2) or die("Unable to query database.");

                            if($result2) {
                                while ($row = mysqli_fetch_array($result2)) {
                                    $id = $row['id'];
                                    $date = $row['date'];
                                    $title = $row['title'];
                                    $summary = $row['summary'];
                                    $content = $row['content'];
                                    $image = $row['image'];
                                    $category = $row['category'];
                                    $archive = $row['archive'];
                    ?>

                                    <article>
                                    <a href="clanak.php?id='<?php echo $id; ?>'" target="_self">
                                            <img src="images/<?php echo $image; ?>">
                                            <h3><?php echo $title; ?></h3>
                                            <p><?php echo $summary; ?></p>
                                        </a>
                                    </article>
                            
                        <?php   }
                            }
                            mysqli_close($dbc); 
                        }?> 
                </div>
            </section>
            
        </main>


        <footer>
            <div>
                <hr>
                <p><b>Copyright &copy; 2023 BBC.</b> The BBC is not responsible for the context of external sites. 
                    <b><a href="#">Read about out approach to external linking.</a></b></p>
                <p>Author: Angelina Doria Bedek, adoriabed@tvz.hr; 2023.</p>
            </div>
        </footer>


    </body>
</html>