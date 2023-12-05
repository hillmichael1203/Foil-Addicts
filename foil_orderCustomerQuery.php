<?php
//creating the connection to the server
$conn = mysqli_connect("localhost","test", "test", "");
if(!$conn)
{
    echo "Cannot connect" . mysqli_error() ;
}
else
{
    echo "Connection Created\n";
}

//header things
echo "<header>";
    echo "<h1>See specific customer orders in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the customer's CustomerNum to get the customer's data.<br>";

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    CustomerNum: <input type="text" name="CustomerNum" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
date_default_timezone_set("America/New_York");
mysqli_select_db($conn, 'Foil_Addicts');


if(isset($_POST['CustomerNum']))
{
    //formatting the current table and displaying it
    mysqli_select_db($conn, 'foil_addicts');

    // Stack Overflow
    $customerNum = $_POST['CustomerNum'];
    $sql = "
    SELECT CustomerNum, OrderDate
    FROM Purchase
    WHERE Purchase.CustomerNum = '$customerNum'
    ";

    $result= mysqli_query($conn, $sql);
    echo "<table border='1'>
    <tr>
    <th> Order Date</th>
    <th> Customer Number</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["OrderDate"] . "</td>";
    echo "<td>" . $row["CustomerNum"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

}

echo "<br>";

//back button
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;

mysqli_close($conn);
exit;
?>