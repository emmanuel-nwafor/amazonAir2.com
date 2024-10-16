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
            <h1>Sign-up</h1>
            
            <a href="login.php">
                <button type="submit">Login</button>
            </a>
        </div>

        <form action="" method="post">
        <h3>Amazon air</h3>    
        <center>
                <?php
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
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                    $stmt->bind_param("ss", $username, $password);

                    if ($stmt->execute() || $stmt->connect_error() ) {
                        echo "<p id='alert2'>Signup successful!</p>";
                    } else {
                        echo "Username or Password already taken" ;
                        die();
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </center>


            <label for="username"><i class='bx bxs-user' class="users" style="margin: 10px"></i>Username</label>
            <input type="text" name="username" placeholder="username">
    
            <label for="email" class="email"><i class='bx bxs-envelope' class="envelope" style="margin: 10px"></i>Email</label>
            <input type="email" name="email" placeholder="example@gmail.com" required>
    
            <label for="password"><i class='bx bxs-show' class="users" style="margin: 10px"></i>Password</label>
            <input type="password" name="password" placeholder="password" required>

            <button type="submit">Signup</button>

            <br>

            <p class="haveAcc">Already have an account ? <a href="login.php">Login</a></p>

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