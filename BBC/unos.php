<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BBC | Insert new story</title>

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
        <header>
            <nav>
                <ul>
                    <li><img src="images/logo.png" id="logo"></li>
                    <li><a href="index.php" target="_self">Home</a></li>
                    <li><a href="kategorija.php?id=News" target="_self">News</a></li>
                    <li><a href="kategorija.php?id=Sport" target="_self">Sport</a></li>
                    <li><a href="administracija.php" target="_self">Administration</a></li>
                    <li><a href="unos.php" target="_self">Insert new story</a></li>
                    <li><a href="logout.php" target="_self">Log out</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <form enctype="multipart/form-data" name="news_input_form" action="skripta.php" method="POST" style="padding-top: 2%;">
                <div class="form-content">
                    <!-- author input -->
                    <label for="news_author">Author: </label><br />
                    <input type="text" name="news_author" id="news_author" class="input" autocomplete autofocus><br />
                    <span id="news_author_msg" class="error"></span>
                    <br /><br />

                    <!-- date input -->
                    <label for="news_date">Date (Monday, 1 January): </label><br />
                    <input type="text" name="news_date" id="news_date" class="input" autocomplete><br />
                    <span id="news_date_msg" class="error"></span>
                    <br /><br />

                    <!-- title input -->
                    <label for="news_title">Title: </label><br />
                    <input type="text" name="news_title" id="news_title" class="input" autocomplete><br />
                    <span id="news_title_msg" class="error"></span>
                    <br /><br />

                    <!-- summary input -->
                    <label for="news_summary">Summary: </label><br />
                    <textarea name="news_summary" id="news_summary" class="input"></textarea><br />
                    <span id="news_summary_msg" class="error"></span>
                    <br /><br />

                    <!-- content input -->
                    <label for="news_story">Content: </label><br />
                    <textarea name="news_story" id="news_story" class="input"></textarea><br />
                    <span id="news_story_msg" class="error"></span>
                    <br /><br />

                    <!-- category select -->
                    <label for="news_category_select">Select a news category: </label><br />
                    <select name="news_category_select" id="news_category_select" class="input" style="padding: 2px;">
                        <option value="default" selected>Choose a category</option>
                        <option value="News" name="news_category" id="news_category">News</option>
                        <option value="Sport" name="news_category" id="news_category">Sport</option>
                    </select>
                    <br />
                    <span id="news_category_select_msg" class="error"></span>
                    <br /><br />

                    <!-- cover image select -->
                    <label for="news_image">Cover image: </label><br />
                    <input type="file" accept="image/jpg, image/png, image/gif" name="news_image" id="news_image" class="input" value="Choose file" ><br />
                    <span id="news_image_msg" class="error"></span>
                    <br /><br />

                    <!-- archive -->
                    <label for="news_archive">Archive article? </label>
                    <input type="checkbox" name="news_archive" id="news_archive" value="1">
                    <br /><br />

                    <!-- buttons -->
                    <input type="submit" name="news_submit" id="news_submit" class="button" value="Submit">
                    <input type="reset" name="news_reset" id="news_reset" class="button" value="Reset">
                </div>
            </form>

            <script type="text/javascript">
                document.getElementById("news_submit").onclick = function(event) {
                    var send = true;

                    var date = document.getElementById("news_date").value;
                    var author = document.getElementById("news_author").value;
                    var title = document.getElementById("news_title").value;
                    var summary = document.getElementById("news_summary").value;
                    var story = document.getElementById("news_story").value;
                    var category = document.getElementById("news_category_select").value;
                    var image = document.getElementById("news_image").files;

                    // author validation
                    if(author.length < 2 || author.length > 30) {
                        send = false;
                        document.getElementById("news_author_msg").innerHTML = "Author name must be between 2 and 30 characters!";
                        document.getElementById("news_author").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_author_msg").innerHTML = ""      
                        document.getElementById("news_author").style = "";
                    };
                    
                    // title validation
                    if(title.length < 5 || title.length > 30) {
                        send = false;
                        document.getElementById("news_title_msg").innerHTML = "News title must be between 5 and 30 characters!";
                        document.getElementById("news_title").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_author_msg").innerHTML = ""      
                        document.getElementById("news_author").style = "";
                    };

                    // summary validation
                    if(summary.length < 10 || summary.length > 100) {
                        send = false;
                        document.getElementById("news_summary_msg").innerHTML = "News summary must be between 10 and 100 characters!";
                        document.getElementById("news_summary").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_summary_msg").innerHTML = ""      
                        document.getElementById("news_summary").style = "";
                    };

                    // story validation
                    if(story == "") {
                        send = false;
                        document.getElementById("news_story_msg").innerHTML = "Story cannot be empty!";
                        document.getElementById("news_story").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_story_msg").innerHTML = ""      
                        document.getElementById("news_story").style = "";
                    };

                    // category validation
                    if(category == "") {
                        send = false;
                        document.getElementById("news_category_select_msg").innerHTML = "Category cannot be empty!";
                        document.getElementById("news_category_select").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_category_select_msg").innerHTML = ""      
                        document.getElementById("news_category_select").style = "";
                    };

                    // date validation
                    if(date == "") {
                        send = false;
                        document.getElementById("news_date_msg").innerHTML = "Date cannot be empty!";
                        document.getElementById("news_date").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_date_msg").innerHTML = ""      
                        document.getElementById("news_date").style = "";
                    };

                    // image validation
                    if(image.length <= 0) {
                        send = false;
                        document.getElementById("news_image_msg").innerHTML = "Image must be selected!";
                        document.getElementById("news_image").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("news_image_msg").innerHTML = ""      
                        document.getElementById("news_image").style = "";
                    };

                    // check if can send
                    if(send != true) {
                        event.preventDefault();
                    }

                }
            </script>
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