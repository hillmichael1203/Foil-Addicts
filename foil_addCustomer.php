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

echo "<header>";
    echo "<h1>Add Customer to Foil Addicts Database</h1>";
echo "</header>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
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
    //inserting the post data into the database
    $sql = "INSERT INTO Customer (CustomerName, Street, City, Province, Zipcode)
    VALUES
    ('$_POST[customerName]', '$_POST[street]', '$_POST[city]', '$_POST[province]', '$_POST[zipcode]')";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record added";

    $_POST = array();
}

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
