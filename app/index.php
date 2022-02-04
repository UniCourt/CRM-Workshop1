<html>
<head>
    <title>App</title>
    <style>
        * {
            margin: 5px;
            text-align: center;
        }
        table{
            margin-left: auto;
            margin-right: auto;
        }
        .results{
            margin-top: 5%;
        }
    </style>
</head>
<body>
<?php
    require('database.php');
    $conn = new database();

    echo "<h1>Hello World</h1>";
    echo "<h2>Enter your information:</h2>";
    echo "<table>";
    echo "<form action='?action=display' method='POST'>
            <tr><td><label>First Name:</label></td><td><input type='text' name='fname'></td></tr>
            <tr><td><label>Last Name:</label></td><td><input type='text' name='lname'></td></tr>
            <tr><td><label>Phone:</label></td><td><input type='tel' name='phone'></td></tr>
            <tr><td><input type='reset'></td><td><input type='submit' value='Submit' name='submit-btn'></td></tr>
        </form>";
        echo "</table>";
    echo "<div class='results'>";
    $sql = "SELECT * FROM user_info";
    $result = $conn->run_queries($sql);
    if ($result->num_rows > 0) {
        echo "<table border=1>";
        echo "<tr>";
        echo "<th>First Name</th><th>Last Name</th><th>Phone</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['phone']."</td></tr>";
        }
        echo "</table>";
    } 
    echo "</div>";

    if(isset($_GET['action'])=='display') {
        display();
    }

    function display(){
        if(isset($_POST['submit-btn'])){
            try{
                $conn = new database();
                $sql = "INSERT INTO user_info (first_name,last_name,phone) VALUES ('{$_POST['fname']}', '{$_POST['lname']}', {$_POST['phone']})";
                $result = $conn->run_queries($sql);
                if($result){
                    echo "<script> window.alert('Successfully inserted!'); window.location.href='index.php';</script>";
                }
                else{
                    throw new Exception("oops! user_info table does not exists");
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
?>