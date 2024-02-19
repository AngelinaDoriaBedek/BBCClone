<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BBC News | Read Article</title>

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
        
    </head>

    <body>
        <?php
            include 'connect.php';
           
            if($dbc) {
                $article_id = $_GET['id'];
                $query = "SELECT * FROM article WHERE archive = 0 AND id = $article_id";
                $result = mysqli_query($dbc, $query) or die("Unable to query database.");

                if($result) {
                    while($row = mysqli_fetch_array($result)) {
                        $date = $row['date'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $summary = $row['summary'];
                        $content = $row['content'];
                        $image = $row['image'];
                        $category = $row['category'];
                        $archive = $row['archive'];
                    }
                }

                function category_style($category) {
                    if($category == "News") {
                        return "background-color:#8B0000; color: #F5F5F5;";
                    }elseif($category == "Sport") {
                        return "background-color:#FFD230;";
                    }
                }

                $span_style = category_style($category);

                mysqli_close($dbc);
            }
        ?>

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

        <span class="title" style="<?php echo $span_style; ?>">
            <h1 style="margin-left: 10%;"><?php echo $category; ?></h1>
        </span>

        <main>
            <h2><?php echo $title; ?></h2>
            <p>Written by: <b><u><?php echo $author; ?></u></b></p>
            <p>Published: <?php echo $date; ?></p>
            <br />

            <?php echo "<img src='images/$image' width='100%'>"; ?>

            <section class="story">
                <h3><?php echo $summary; ?></h3>

                <p><?php echo $content; ?></p>
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