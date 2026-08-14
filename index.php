<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3</title>
        <!-- <meta name="description" content="A brief description of your webpage content."> --> 
    <!-- Link to your external stylesheet -->
    <!-- <link rel="stylesheet" href="style.css"> -->  
     <style>
        body{
            padding-right: 100px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 25px;
        }

        #wrapper{
            display: flex; 
            flex-direction: column;
            align-items: end;             
            justify-content: center; 
            position: relative;
            top: 100px; 
            /* position: relative; */ 
           /*  position: absolute;*/ 
            /*z-index: 1; 
            height: 840px; */ 
            /* padding-right: 200px;  */ 
            /*border-left: 2px solid #407DFF; */ 
            /* width: 300px; */ 
           /* margin-left: 350px; */ 
        }

        /* header{
            display: flex; 
            flex-direction: column;
            gap: -50px; 
        } */ 

        h1{
            color: #407DFF; 
            font-family: 'Brush Script MT', 'Times New Roman', Times, serif;
            font-size: 90px;
            display: inline; 
        }

        h2{
            font-size: 20px; 
            font-style: italic;
            color: #7BA5FB; 
            text-align: center;
            margin-top: -10px; 
        }

        main{
            background-color: #CFDEFF;
            padding: 60px; 
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #CFDEFF;
            border-radius: 5px; 
            border: 0px;  
            font-size: 22px;
            padding: 18px; 
            /* width: 160px; */ 
            font-family: 'Times New Roman', Times, serif;
            cursor: pointer;
        }

        /*button:hover {
             transition: 0.5s;
            background-color: #93B6FF;
        } */ 

        input[type="submit"]{
            background-color: #93B6FF;
        }

        input[type="submit"]:hover{
             transition: 0.5s;
             background-color: #76a1ff;
        }

        input[type="text"], input[type="password"]{
            width: 210px; 
            height: 20px;
        }

        input[type="submit"]:active{
            transition: 0.5s;
            transform: scale(0.98);
        }

        div{
            display: flex; 
            flex-direction: row;
            column-gap: 75px; 
        }

        img{
            height: 1000px; 
            position: absolute; 
            left: -10px; 
            top: 360px; 
            transform: translateY(-50%);
            display: block; 
        }

        label{
            font-size: 22px; 
        }

        div header, div main {
            position: relative; 
        }  

        div main{
            left: -10%; 
        }

        div header{
            left: -13%; 
        }

        @media screen and (max-width: 1185px){
            img{
                display: none; 
            }

         /*   #wrapper{
                left: -50%; 
            } */ 
        }

     </style>
     <!-- <script>
        var submitButton; 
        var loginButton; 
        var createAccountButton; 

        function init(){
            submitButton = document.getElementById("submit"); 
            loginButton = document.getElementById("login"); 
            createAccountButton = document.getElementById("createAccount"); 
        }

        window.addEventListener("load", init); 
     </script> --> 
</head>
<body>
 <div id="wrapper">
    <header>
        <h1>Incremental</h1>
        <h2>The Counting Website</h2>
    <!--<div>
        <button id="login">Login</button> 
        <button id="createAccount">Create Account</button>  
        </div>-->
    </header>
    <br>
    <main>
        <!-- Add action and method attributes -->
        <form action="lab3.php" method="get">
            <label for="username">Username:</label> 
            <br>
            <input type="text" id="username" name="username"> 
            <br>
            <br>
            <label for="password">Password:</label> 
            <br> 
            <input type="password" id="password" name="password"> 
            <br> 
            <br> 
            <input type="submit" value="Login" name="login">
            <input type="submit" value="Create Account" name="createAccount">
           <!-- <input type="submit" value="Submit" id="submit"> --> 
        </form>
    </main>
    <img src="Sign In Image.png"> 
</div>
    <!--<footer>
        <p>&copy; 2026 My Website</p>
    </footer> --> 

    <!-- Scripts placed at the bottom for faster loading -->
    <!-- <script src="script.js"></script> --> 
</body>
</html>