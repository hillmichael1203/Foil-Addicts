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

//header stuff
echo "<header>";
    echo "<body style='background-color:282828; font-family: Arial; color: white; padding: 25px;'>";
    echo "<h1>Delete a Customer from the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the customerNum of the Customer to be removed.<br>";


//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    CustomerNum: <input type="text" name="customerNum" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['customerNum']))
{
    //removing the data from the database
    $sql = "DELETE FROM Customer 
    WHERE CustomerNum = '$_POST[customerNum]'";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record deleted";

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
<th> Customer Number</th>
<th> Customer Name</th>
<th> Street</th>
<th> City</th>
<th> State</th>
<th> Zip Code</th>
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
