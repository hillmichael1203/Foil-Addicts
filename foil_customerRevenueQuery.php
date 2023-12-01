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
    echo "<h1>See specific customer revenue in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the customer's CustomerNum get the customer's data.<br>";

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

//back button
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;

if(isset($_POST['CustomerNum']))
{
    //formatting the current table and displaying it
    mysqli_select_db($conn, 'foil_addicts');

    // Stack Overflow
    $customerNum = $_POST['CustomerNum'];
    $sql = "
    SELECT Customer.CustomerNum, Customer.CustomerName, Customer.Street, Customer.City, Customer.Province, Customer.Zipcode, COALESCE(SUM(OrderLine.Price), 0) AS Revenue
    FROM Customer
    LEFT JOIN Purchase ON Customer.CustomerNum = Purchase.CustomerNum
    LEFT JOIN OrderLine ON Purchase.OrderNum = OrderLine.OrderNum
    WHERE Customer.CustomerNum = '$customerNum'
    GROUP BY Customer.CustomerNum, Customer.CustomerName, Customer.Street, Customer.City, Customer.Province, Customer.Zipcode
    ";

    $result= mysqli_query($conn, $sql);
    echo "<table border='1'>
    <tr>
    <th> Customer Number</th>
    <th> Customer Name</th>
    <th> Street</th>
    <th> City</th>
    <th> State</th>
    <th> Zip Code</th>
    <th> Revenue</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["CustomerNum"] . "</td>";
    echo "<td>" . $row["CustomerName"] . "</td>";
    echo "<td>" . $row["Street"] . "</td>";
    echo "<td>" . $row["City"] . "</td>";
    echo "<td>" . $row["Province"] . "</td>";
    echo "<td>" . $row["Zipcode"] . "</td>";
    echo "<td>" . $row["Revenue"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

}

echo "<br>";



mysqli_close($conn);
exit;
?>
