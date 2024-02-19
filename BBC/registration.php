<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BBC | Register</title>

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
            <form enctype="multipart/form-data" name="registration" action="" method="POST" style="padding-top: 2%;">
                <div class="form-content">
                    <!-- first name -->
                    <label for="first_name">First name</label><br />
                    <input type="text" name="first_name" id="first_name" class="input"><br />
                    <span id="first_name_msg" class="error"></span>
                    <br /><br />

                    <!-- last name -->
                    <label for="last_name">Last name</label><br />
                    <input type="text" name="last_name" id="last_name" class="input"><br />
                    <span id="last_name_msg" class="error"></span>
                    <br /><br />

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

                    <!-- repeat password -->
                    <label for="password_repeat">Reapeat password</label><br />
                    <input type="password" name="password_repeat" id="password_repeat" class="input"><br />
                    <span id="password_repeat_msg" class="error"></span>
                    <br /><br />

                    <!-- level -->
                    <label for="level">Level</label><br />
                    <input type="number" name="level" id="level" class="input"><br />
                    <span id="level_msg" class="error"></span>
                    <br /><br />

                    <!-- buttons -->
                    <input type="submit" name="submit" id="submit" class="button" value="Submit">
                    <input type="reset" name="reset" id="reset" class="button" value="Reset">
                    <br /><br />

                </div>
            </form>

            <script type="text/javascript">
                document.getElementById("submit").onclick = function(event) {
                    var send = true;

                    var first_name = document.getElementById("first_name").value;
                    var last_name = document.getElementById("last_name").value;
                    var user = document.getElementById("username").value;
                    var pass = document.getElementById("password").value;
                    var pass_repeat = document.getElementById("password_repeat").value;
                    var level = document.getElementById("level").value;

                    // first name validation
                    if(first_name.length < 2 || first_name.length > 30) {
                        send = false;
                        document.getElementById("first_name_msg").innerHTML = "First name must be between 2 and 30 characters!";
                        document.getElementById("first_name").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("first_name_msg").innerHTML = ""      
                        document.getElementById("first_name").style = "";
                    };

                    // last name validation
                    if(last_name.length < 2 || last_name.length > 30) {
                        send = false;
                        document.getElementById("last_name_msg").innerHTML = "Last name must be between 2 and 30 characters!";
                        document.getElementById("last_name").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("last_name_msg").innerHTML = ""      
                        document.getElementById("last_name").style = "";
                    };
                    
                    // username validation
                    if(user.length < 5 || user.length > 30) {
                        send = false;
                        document.getElementById("username_msg").innerHTML = "Username must be between 5 and 30 characters!";
                        document.getElementById("username").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("username_msg").innerHTML = ""      
                        document.getElementById("username").style = "";
                    };

                    // password validation
                    if(pass.length < 8 || pass.length > 16) {
                        send = false;
                        document.getElementById("password_msg").innerHTML = "Password must be between 8 and 16 characters!";
                        document.getElementById("password").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("password_msg").innerHTML = ""      
                        document.getElementById("password").style = "";
                    };

                    //repeated password validation
                    if(pass != pass_repeat) {
                        send = false;
                        document.getElementById("password_repeat_msg").innerHTML = "Passwords don't match!";
                        document.getElementById("password").style = "border: 1px dashed #9B0000;"
                        document.getElementById("password_repeat").style = "border: 1px dashed #9B0000;"
                    }else {
                        document.getElementById("password_repeat_msg").innerHTML = ""      
                        document.getElementById("password").style = "";
                        document.getElementById("password_repeat").style = "";
                    }

                    //level validation
                    if(level != 0 && level != 1) {
                        send = false;
                        document.getElementById("level_msg").innerHTML = "Level invalid!";
                        document.getElementById("level").style = "border: 1px dashed #9B0000;"
                    }else if (level == 0 || level == 1) {
                        document.getElementById("level_msg").innerHTML = "";
                        document.getElementById("level").style = "";
                    }

                    // check if can send
                    if(send != true) {
                        event.preventDefault();
                    }

                }
            </script>

            <?php
                include 'connect.php';

                if ($dbc) {
                    if (isset($_POST["submit"])) {
            
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $user = $_POST['username'];
                        $pass = $_POST['password'];
                        $pass_hash = password_hash($pass, CRYPT_BLOWFISH);
                        $level = $_POST['level'];

                        $sql = "SELECT username FROM user WHERE username = ?;";
                        $stmt = mysqli_stmt_init($dbc);
                        if(mysqli_stmt_prepare($stmt, $sql)) {
                            mysqli_stmt_bind_param($stmt, 's', $user);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                        }

                        if(mysqli_stmt_num_rows($stmt) >= 1) {
                            echo "Username is already taken!";
                        }else{
                            $sql = "INSERT INTO user (first_name, last_name, username, password, level) VALUES (?, ?, ?, ?, ?);";
                            $stmt = mysqli_stmt_init($dbc);
                            if(mysqli_stmt_prepare($stmt, $sql)) {
                                mysqli_stmt_bind_param($stmt, 'ssssi', $first_name, $last_name, $user, $pass_hash, $level);
                                mysqli_stmt_execute($stmt);

                                echo "You have successfully registered.";
                                echo "<p>Go to <a href='login.php' style='color: #333333'><u><b>login</b></u></a></p>";
                            }
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