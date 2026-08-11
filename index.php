<?php

// Connect to mySQL database 
$connection = mysqli_connect (
    "localhost", 
    "root", 
    "root", 
    "incremental_account"
); 

// This is a line of SQL helped in a variable
$sql = "SELECT count FROM account_information"; 

// Result holds the count variable from the table
$result = mysqli_query($connection, $sql); 

?> 

<!DOCTYPE html>
<html>
<head>
    <title>Lab 3</title>
</head>

<body>

<h1>Incremental</h1>

<?php

while ($account_information = mysqli_fetch_assoc($result)) {

    echo "<h2>" . $account_information["count"] . "</h2>";

}

?>

</body>