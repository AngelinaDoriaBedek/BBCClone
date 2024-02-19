<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BBC News | Preview article</title>

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
            $span_style = '';
            $form_category = '';
            $form_image = '';

            if (isset($_POST['news_submit'])) {
                
                $form_author = $_POST['news_author'];
                $form_date = $_POST['news_date'];
                $form_title = $_POST['news_title'];
                $form_summary = $_POST['news_summary'];
                $form_story = $_POST['news_story'];
                $form_category = $_POST['news_category_select'];
                $form_image = $_FILES['news_image']['name'];
                $form_archive = isset($_POST['news_archive']) ? 1 : 0;
            

                function category_style($form_category) {
                    if($form_category == "News") {
                        return "background-color:#8B0000; color: #F5F5F5;";
                    }elseif($form_category == "Sport") {
                        return "background-color:#FFD230;";
                    }
                }

                $span_style = category_style($form_category);
            
            }

            include 'connect.php';
           
            if($dbc) {
                $query = "INSERT INTO article (date, author, title, summary, content, image, category, archive) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($dbc, $query);
                mysqli_stmt_bind_param($stmt, 'sssssssi', $form_date, $form_author, $form_title, $form_summary, $form_story, $form_image, $form_category, $form_archive);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

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
                    <li><a href="administracija.php" target="_self">Administration</a></li>
                    <li><a href="unos.php" target="_self">Insert new story</a></li>
                </ul>
            </nav>
        </header>

        <span class="title" style="<?php echo $span_style; ?>">
            <h1 style="margin-left: 10%;"><?php echo $form_category; ?></h1>
        </span>

        <main>
            <h2><?php echo $form_title; ?></h2>
            <p>Written by: <b><u><?php echo $form_author; ?></u></b></p>
            <p>Published: <?php echo $form_date; ?></p>
            <br />

            <?php echo "<img src='images/$form_image' width='100%'>"; ?>

            <section class="story">
                <h3><?php echo $form_summary; ?></h3>
                <p><?php echo $form_story; ?></p>
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