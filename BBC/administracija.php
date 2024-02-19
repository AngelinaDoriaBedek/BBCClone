<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
    <head>
        <title>BBC News | Administration</title>

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

        <?php include 'connect.php'; ?>
        
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li><img src="images/logo.png" id="logo"></li>
                    <li><a href="index.php" target="_self">Home</a></li>
                    <li><a href="kategorija.php?id=News" target="_self">News</a></li>
                    <li><a href="kategorija.php?id=Sport" target="_self">Sport</a></li>
                    <li><a href="administracija.php" target="_self">Administration</a></li>
                    <?php 
                        if($_SESSION['level'] == 1) {
                            echo "<li><a href='unos.php' target='_self'>Insert new story</a></li>";
                        }
                    ?>
                    <li><a href="logout.php" target="_self">Log out</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <?php
            // introduction
            if($_SESSION['level'] == 0) {
                echo "<p>Hello, <b>". $_SESSION['user'] ."</b>! You are logged in but you're not an administrator.<p>";
            }else {
                echo "<p>Hello, <b>". $_SESSION['user'] ."</b>! You are logged in as an administrator.<p>";

            if($dbc) {
                $query = "SELECT * FROM article;";
                $result = mysqli_query($dbc, $query) or die("Unable to query database: " . mysqli_error($dbc));

                if($result) {
                    define('UPLPATH', 'images/');
                    while($row = mysqli_fetch_array($result)) {
                        $id_db = $row['id'] ;
                        $date = $row['date'];
                        $author = $row['author'];
                        $title = $row['title'];
                        $summary = $row['summary'];
                        $content = $row['content'];
                        $image = $row['image'];
                        $category = $row['category'];
                        $archive = $row['archive'];
        ?>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-content">
                    <!-- hidden id -->
                    <input type="hidden" name="id" class="form-field-textual" value="<?php echo $id_db; ?>">

                    <!-- author input -->
                    <label for="author">Author: </label>
                    <input type="text" name="author" id="author" value="<?php echo $author; ?>">
                    <br /><br />

                    <!-- date input -->
                    <label for="date">Date: </label>
                    <input type="text" name="date_publish" id="date_publish" value="<?php echo $date; ?>">
                    <br /><br />

                    <!-- title input -->
                    <label for="title">Title: </label>
                    <input type="text" name="title" id="title" value="<?php echo $title; ?>" style="width:40%;">
                    <br /><br />

                    <!-- summary input -->
                    <label for="summary">Summary: </label>
                    <br />
                    <textarea name="summary" id="summary"><?php echo $summary; ?></textarea>
                    <br /><br />
                    
                    <!-- story input -->
                    <label for="content">Content: </label> 
                    <br />
                    <textarea name="content" id="content"><?php echo $content; ?></textarea>
                    <br /><br />

                    <!-- category select -->
                    <label for="category_select">Select a news category: </label>
                    <select name="category_select" id="category_select" style="padding: 2px;">
                        <option value="News" name="category" id="category" <?php echo ($category == 'News') ? 'selected' : ''; ?> >News</option>
                        <option value="Sport" name="category" id="category" <?php echo ($category == 'Sport') ? 'selected' : ''; ?> >Sport</option>
                    </select>
                    <br /><br />

                    <!-- cover image upload -->
                    <label for="image">Cover image: </label>
                    <input type="file" accept="image/jpg, image/png, image/gif" name="image" id="image">
                    <br />
                    <?php echo "<img src='" . UPLPATH . $image . "' width='20%' style='padding-top: 2%;'>"; ?>
                    <br /><br />

                    <!-- archive check -->
                    <label for="archive">Archive article? </label>
                    <?php 
                        if($archive == 0) {
                            echo "<input type='checkbox' name='archive' id='archive'>";
                        }else {
                            echo "<input type='checkbox' name='archive' id='archive' checked>";
                        }
                    ?>
                    <br /><br />

                    <!-- buttons -->
                    <input type="reset" name="reset" id="reset" class="button" value="Reset">
                    <input type="submit" name="update" id="update" class="button" value="Update">
                    <input type="submit" name="delete" id="delete" class="button" value="Delete">
                </div>
            </form>
        

        <?php
            
            //delete
            if(isset($_POST['delete'])){
                $id=$_POST['id'];
                $query_del = "DELETE FROM article WHERE id = $id ";
                $result_del = mysqli_query($dbc, $query_del) or die("Unable to query: " . mysqli_error($dbc));
                echo '<meta http-equiv="refresh" content="1;url=administracija.php">';
            }

            //update
            if(isset($_POST['update'])){
                $id_form = $_POST['id'];
                $date_form = $_POST['date_publish'];
                $author_form = $_POST['author'];
                $title_form = $_POST['title'];
                $summary_form = $_POST['summary'];
                $content_form = $_POST['content'];
                $category_form = $_POST['category_select'];
                
                //check if article should be archived or not
                if(isset($_POST['archive'])){
                    $archive_form=1;
                }else{
                    $archive_form=0;
                }

                //check if new image has been uploaded
                if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $image_form = $_FILES['image']['name'];
                    $target_dir = 'images/'.$image_form;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir);

                }else {

                    $query_img = "SELECT image FROM article WHERE id = ?";
                    $stmt_img = mysqli_prepare($dbc, $query_img);
                    mysqli_stmt_bind_param($stmt_img, 'i', $id_form);
                    mysqli_stmt_execute($stmt_img);
                    mysqli_stmt_bind_result($stmt_img, $existing_image);
                    mysqli_stmt_fetch($stmt_img);
                    $image_form = $existing_image;
                    mysqli_stmt_close($stmt_img);
                }
                
                $query_up = "UPDATE article SET date=?, author=?, title=?, summary=?, content=?, image=?, category=?, archive=? WHERE id=?";
                $stmt = mysqli_prepare($dbc, $query_up);
                mysqli_stmt_bind_param($stmt, 'sssssssii', $date_form, $author_form, $title_form, $summary_form, $content_form, $image_form, $category_form, $archive_form, $id_form);
                $result_up = mysqli_stmt_execute($stmt);

                if($result_up) {
                    echo '<meta http-equiv="refresh" content="1;url=administracija.php">';
                }

            }

        } } }
        }; 
        ?>
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