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

// These variables hold SQL queries 
    $countHolder = "SELECT count FROM account_information"; 

    $increment = "UPDATE account_information SET count = count + 1"; 

// If the button is clicked do this  
// Does the URL contain an increment parameter 
if (isset($_GET["increment"])) {

    // Add to the number in the database 
    mysqli_query(

        // Use the Database 
        $connection,

        // Run this line of code on the database 
        $increment
    );

    // Reload the current page without the previous GET parameters 
    header("Location: " . $_SERVER["PHP_SELF"]);

    // Stop PHP 
    exit();
} 

// $result holds the result of this database query 
$result = mysqli_query($connection, $countHolder); 

// End of PHP code 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3</title>
    <!-- <meta name="description" content="A brief description of your webpage content."> --> 
    <!-- External CSS Stylesheet -->
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
            height: 834px; 
            color: #407DFF; 
            /*overflow-y: hidden; */ 
        }

        span{
            font-size: 200px; 
            margin-bottom: 0; 
        }

        button{
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

        button:hover{
            transition: 0.5s;
            background-color: #b1caff;
        }

        button:active{
            transition: 0.5s;
            transform: scale(0.98);
        }

        #signOutButton{
            position: relative; 
            left: 240px; 
            top: 300px; 
        }

        footer{
            font-size: 50px;
            font-family: 'Brush Script MT', 'Times New Roman', Times, serif;
            align-self: start;
            justify-self: end;
            margin-left: 10px;
            position: relative; 
            top: 200px; 
        }
    </style>
    <!-- <script>
        var incrementButton; 
        

        function init(){
            incrementButton = document.getElementById("increment"); 
            incrementButton.addEventListener("click", addOne)
        }

        function addOne(){

        }

        window.addEventListener("load", init); 
     </script>  --> 
</head>
<body>
    <?php
// Find the value of username and password variables and save it in these variables 
        $user = $_REQUEST["username"]; 
        $pass = $_REQUEST["password"];  
    if(isset($_GET["createAccount"])){
        // This holds an SQL query that reads select everything from the table where the username equals the ?
        $stmt = $connection->prepare("SELECT * FROM account_information where username = ?"); 
        // ? is equal to whatever the user input for username 
        $stmt->bind_param("s", $user); 
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
            $stmt->bind_param("ss", $user, $pass); 
            // Run the query and give the result to this variable 
            // the result will be true or false meaning 
            // was the query executed effectively 
            $resultIns = $stmt->execute(); 
            // If the username and password were not 
            // successfully added to the database 
           /* if($resultIns !== true){
                print "Insert failed"; 
            }
            else {
                print "User $user added to the database"; 
            }  */ 
        } 
    }
    // Need to also check for password too 
    if(isset($_GET["login"])) {
        // This holds an SQL query that reads select everything from the table where the username equals the ?
        $stmt = $connection->prepare("SELECT * FROM account_information where username = ?"); 
        // ? is equal to whatever the user input for username 
        $stmt->bind_param("s", $user); 
        // Run the SQL Query 
        $stmt->execute(); 

        

        // The result of the SQL query is help in the userinfo_results variable
        $userinfo_result = $stmt->get_result(); 
        // If there is at least one user that already has this username
        if($userinfo_result->num_rows > 0){
            // Here we should send you back to the previous page
            // with a message reading that this username is already 
            // in use  
            // print("Someone already has this username"); 
        }
        else {
        header("Location: index.php"); 
    }
    }
        $connection->close(); 
?> 

    <!-- <header>
        <h1>Welcome to My Website</h1>

    </header> --> 
    <main>
        <?php
            // Contains one row of the data 
            $account_information = mysqli_fetch_assoc($result); 
            // Look inside the row. Find the count value and display it
            echo "<span>" . $account_information["count"] . "</span>";
        ?>
        <br>
        <br>
    </main>
    <form action="#" method="get"> 
        <button id="increment" name="increment">
            + Increment
        </button>
    </form>
    <br>
    <a href="index.php">
    <button id="signOutButton">
        Sign Out
    </button> 
    </a>
    <!-- Footer Section -->
   <footer>
            <p>
                Incremental
            </p>
    </footer> 
    <!-- External JavaScript File (Placed at bottom for optimized page loading) -->
   <!-- <script src="script.js"></script> --> 
</body>
</html>

