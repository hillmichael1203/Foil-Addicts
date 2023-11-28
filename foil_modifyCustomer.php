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
    echo "<h1>Modify a Customer in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the customer's CustomerNum and updated information to modify their data.<br>";


//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    CustomerNum: <input type="text" name="customerNum" />
    CustomerName: <input type="text" name="customerName" />
    Street: <input type="text" name="street" />
    City: <input type="text" name="city" />
    Province: <input type="text" name="province" />
    Zipcode: <input type="text" name="zipcode" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['customerName']))
{
    //updating the customer with the corresponding ID
    $sql = "UPDATE Customer 
    SET CustomerName = '$_POST[customerName]', 
    Street = '$_POST[street]', 
    City = '$_POST[city]', 
    Province = '$_POST[province]', 
    Zipcode = '$_POST[zipcode]'
    WHERE CustomerNum = $_POST[customerNum]";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record added";

    $_POST = array();
}

//back button
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;

//formatting the current table and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM Customer");
echo "<table border='1'>
<tr>
<th> CustomerNum </th>
<th> CustomerName </th>
<th> Street</th>
<th> City</th>
<th> State</th>
<th> Zipcode</th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["CustomerNum"] . "</td>";
echo "<td>" . $row["CustomerName"] . "</td>";
echo "<td>" . $row["Street"] . "</td>";
echo "<td>" . $row["City"] . "</td>";
echo "<td>" . $row["Province"] . "</td>";
echo "<td>" . $row["Zipcode"] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
exit;
?>
