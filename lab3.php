<?php
//  This is the start of PHP code 
// Connect to mySQL database
$connection = new mysqli("localhost", "root", "root", "incremental_account");

// If we were not able to connect to the database do this 
if($connection->connect_error){

    // The period does string concatenation (like + in Javascript)
    print("Error is: " . $connection->connect_error); 

    // Stop executing the PHP 
    exit(); // or die() 
}

// Start the session 
session_start(); 

// If the username doesnt exist make this equal to null 
$user = $_REQUEST["username"] ?? null; 
$pass = $_REQUEST["password"] ?? null; 

// Check if the username has already been saved 
 if(isset($_SESSION["user"])){
 // If it has save that value in a variable 
    $session_user = $_SESSION["user"]; 
}
// If the username hasn't been saved 
else{
    // Save the usewrname in theb session  
    $_SESSION["user"] = $user;
    // Save the username in a variable 
    $session_user = $_SESSION["user"];  
}  

    print("Welcome Back, ". $_SESSION["user"]); 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3</title>
    <style>
        body{
            background-image: url("Lab 3 Image.png");
            background-size: cover;
            background-position: center;
            background-position-y: center; 
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Times New Roman', Times, serif;
            display: flex; 
            flex-direction: column;
            align-items: center; 
            justify-content: center;
            border: 15px solid #93B6FF; 
            margin: 0; 
            height: 835px; 
            color: #407DFF; 
            overflow: hidden; 
        }

        span{
            font-size: 200px; 
            margin-bottom: 0; 
        }

        input[type="submit"]{
            margin-top: -10px; 
            height: 70px; 
            width: 200px; 
            cursor: pointer;
            font-size: 24px;
            font-family: 'Times New Roman', Times, serif;
            background-color: #CFDEFF;
            border: none; 
            border-radius: 10px;
        }

        input[type="submit"]:hover{
            transition: 0.5s;
            background-color: #b1caff;
        }

       input[type="submit"]:active{
            transition: 0.5s;
            transform: scale(0.98);
        }

        #signOutButton{
            align-self: flex-end;
            position: fixed; 
            right: 20px; 
            bottom: 20px; 
        }

        footer{
            font-size: 50px;
            font-family: 'Brush Script MT', 'Times New Roman', Times, serif;
            position: fixed; 
            left: 20px; 
            bottom: -40px; 
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET["createAccount"])){
        // This holds an SQL query that reads select everything from the table where the username equals the ?
        $stmt = $connection->prepare("SELECT * FROM account_information where username = ?"); 
        // ? is equal to whatever the user input for username 
        $stmt->bind_param("s", $session_user); 
        // Run the SQL Query 
        $stmt->execute(); 
        // The result of the SQL query is help in the userinfo_results variable
        $userinfo_result = $stmt->get_result(); 
        // If there is at least one user that already has this username
        if($userinfo_result->num_rows > 0){
            // Here we should send you back to the previous page
            // with a message reading that this username is already 
            // in use 
            header("Location: index.php"); 
            // print("Someone already has this username"); 
            exit; 
        }
        else {
            // print "Userame was not found!";     
            // Add values to the table that are the question marks
            $stmt = $connection->prepare("INSERT INTO account_information (username, password)". "VALUES (?, ?)"); 
            // The question marks are $user and $pass 
            $stmt->bind_param("ss", $session_user, $pass); 
            // Run the query and give the result to this variable 
            // the result will be true or false meaning 
            // was the query executed effectively 
            $resultIns = $stmt->execute(); 
        } 
    }
    // Need to also check for password too 
    if(isset($_GET["login"])) {
        // This holds an SQL query that reads select everything from the table where the username equals the ?
        $stmt = $connection->prepare("SELECT * FROM account_information where username = ? AND password = ?"); 
        // ? is equal to whatever the user input for username 
        $stmt->bind_param("ss", $session_user, $pass); 
        // Run the SQL Query 
        $stmt->execute(); 
        // The result of the SQL query is help in the userinfo_results variable
        $userinfo_result = $stmt->get_result(); 
        // If there is at least one user that already has this username
        if($userinfo_result->num_rows > 0){
            // Here we should send you back to the previous page
            // with a message reading that this username is already 
            // in use  
        }
        else {
        header("Location: index.php"); 
    }
    }

    $increment_stmt = $connection->prepare("UPDATE account_information SET count = count + 1 WHERE username = ?"); 
    $increment_stmt->bind_param("s", $session_user); 

    // This says if increment=# exist in the URL which isnt what I want
    // I onlt want this to happen when you click the button 
    if(isset($_GET["increment"])){

        $increment_stmt->execute(); 

        // Server is an array, so we need to use square brackets 
        header("Location: ". $_SERVER["PHP_SELF"]); 
    } 

    $num_stmt = $connection->prepare("SELECT count FROM account_information WHERE username = ?"); 
    $num_stmt->bind_param("s", $session_user); 
    $num_stmt->execute(); 
    $num_result = $num_stmt->get_result(); 
    $connection->close(); 

    if(isset($_GET["signOut"])){
        session_destroy();
        header("Location: index.php");  
    }
?> 

    <main>
        <?php
        $account_information = mysqli_fetch_assoc($num_result); 
        echo "<span>". $account_information["count"]. "</span>"; 
        ?> 
        <br>
        <br>
    </main>
    <form action="#" method="get"> 
        <input id="increment" name="increment" value="+ Increment" type="submit"> 
    </form>
    <br>
    <form>
    <a href="index.php">
    <input type="submit" value="Sign Out" id="signOutButton" name="signOut"> 
    </a>
    </form>
    <!-- Footer Section -->
   <footer>
            <p>
                Incremental
            </p>
    </footer> 
</body>
</html>

