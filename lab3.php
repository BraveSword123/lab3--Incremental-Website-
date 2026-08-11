<?php
// Connect to mySQL database 
/* $connection = mysqli_connect (
    "localhost", 
    "root", 
    "root", 
    "incremental_account"
); */ 

// Connect to mySQL database
$connection = new mysqli("localhost", "root", "root", "incremental_account");

// Error check
if($connection->connect_error){
    print("Error is: " . $connection->connect_error); 
    exit(); // or die() 
}

// $sql holds the database query 
$sql = "SELECT count FROM account_information"; 

// $increment = UPDATE account_information SET count = count + 1; 

// If we reached this page by pressing the increment button add 1 
/* if (isset($_POST["increment"])) {
    mysqli_query(
        $connection,
        "UPDATE account_information
         SET count = count + 1"
    );
} */ 

    // $result holds the result of this database query 
$result = mysqli_query($connection, $sql); 

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
            overflow-y: hidden; 
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

        footer{
            font-size: 50px;
            font-family: 'Brush Script MT', 'Times New Roman', Times, serif;
            align-self: start;
            justify-self: end;
            margin-left: 10px;
            position: relative; 
            top: 230px; 
        }
    </style>
     <script>
        var incrementButton; 
        

        function init(){
            incrementButton = document.getElementById("increment"); 
            incrementButton.addEventListener("click", addOne)
        }

        function addOne(){
        <?php
            mysqli_query(
            $connection,
            "UPDATE account_information
            SET count = count + 1"
            );
        ?> 
        }

        window.addEventListener("load", init); 
     </script>  
</head>
<body>
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
    <!-- action="#" method="post"--> 
    <form action="#" method="post"> 
        <button id="increment" name="increment">
            + Increment
        </button>
    </form>
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