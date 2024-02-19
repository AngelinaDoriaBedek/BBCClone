<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
    <head>
        <title>BBC | Login</title>

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
                    <li><a href="login.php" target="_self">Administration</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <form enctype="multipart/form-data" name="login" action="" method="POST" style="padding-top: 2%;">
                <div class="form-content">
                    <!-- username -->
                    <label for="username">Username</label><br />
                    <input type="text" name="username" id="username" class="input"><br />
                    <span id="username_msg" class="error"></span>
                    <br /><br />

                    <!-- password -->
                    <label for="password">Password</label><br />
                    <input type="password" name="password" id="password" class="input"><br />
                    <span id="password_msg" class="error"></span>
                    <br /><br />

                    <!-- buttons -->
                    <input type="submit" name="submit" id="submit" class="button" value="Submit">
                    <input type="reset" name="reset" id="reset" class="button" value="Reset">
                    <br /><br />

                    <p>Don't have an account? <a href='registration.php' style="color: #333333;"><u><b>Register here</b></u></a></p>
                </div>
            </form>


            <?php
                include 'connect.php';

                if ($dbc) {
                    if (isset($_POST["submit"])) {
            
                        $user = $_POST['username'];
                        $pass = $_POST['password'];

                        $sql = "SELECT username FROM user WHERE username = ?;";
                        $stmt = mysqli_stmt_init($dbc);
                        if(mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, 's', $user);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            mysqli_stmt_bind_result($stmt, $user_db);
                            mysqli_stmt_fetch($stmt);
                        }
                        
                        $sql = "SELECT username, password, level FROM user WHERE username = ?";
                        $stmt = mysqli_stmt_init($dbc);
                        if(mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, 's', $user_db);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            mysqli_stmt_bind_result($stmt, $user_db, $password_db, $level_db);
                            mysqli_stmt_fetch($stmt);
                        }

                        if(password_verify($pass, $password_db)) {
                            $_SESSION['user'] = $user_db;
                            $_SESSION['level'] = $level_db;

                            //redirect after successful login
                            header("Location: administracija.php");
                            exit;
                        }else {
                            echo "You have entered wrong username or password";
                        }
                    }
                }
                mysqli_close($dbc);
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