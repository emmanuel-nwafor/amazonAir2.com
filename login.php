<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon air.com</title>
    <link rel="stylesheet" href="login&signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>



<body>
    <div class="formBody" id='formBody'>
        <div class="formSplit" id='formSplit'>
            <h1>Login</h1>
            
            <a href="signup.php">
                <button type="submit">Sign-up</button>
            </a>
        </div>

        <form action="" method="post">
            <h3>Amazon air</h3>    

            <center>
                <?php

                session_start();

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "user_system";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    if (empty($username| $password)) {
                        header('Location: ./login.php');
                    }

                    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($hashed_password);
                    
                    if ($stmt->num_rows > 0) {
                        $stmt->fetch();
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION['username'] = $username;

                            // echo "<p id='alert2'>Login successful!</p>";
                            echo '<div><h1>Login successful<h1></div>';
                            header("Location: ./index.html");
                        } else {
                            echo "<p id='alert'>Invalid username or password</p>";

                        }
                    } else {
                        echo "<p id='alert'>Invalid username or password</p>";
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </center>

            <label for="username"><i class='bx bxs-user' class="users" style="margin: 10px"></i>Username</label>
            <input type="text" name="username" placeholder="username">
    
            <label for="password"><i class='bx bxs-envelope' class="envelope" style="margin: 10px"></i>
            Password</label>
            <input type="password" name="password" placeholder="password" style="margin: 10px" required>

            <button type="submit">Login</button>

            <br>

            <p class="haveAcc">Don't have an account ? <a href="signup.php">Sign-up</a></p>

            <br><br>
            <div>
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-whatsapp"></i>
            <i class="bx bxl-instagram"></i>
            </div>
        </form>
    </div>
</body>
</html>