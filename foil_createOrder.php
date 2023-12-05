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
    echo "<h1>Add Order to Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Enter the information for a new order in the database below!<br>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="foil_createOrder2.php" method="post">
    CustomerNum: <input type="text" name="customerNum" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');


if(isset($_POST['customerNum']))
{
    //inserting the post data into the database
    $sql = "INSERT INTO Purchase (OrderDate, CustomerNum)
    VALUES (CURRENT_DATE(), '$_POST[customerNum]')";
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
$result= mysqli_query($conn, "SELECT * FROM Purchase");
echo "<table border='1'>
<tr>
<th> Order Num</th>
<th> Order Date</th>
<th> Customer Number</th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["OrderNum"] . "</td>";
echo "<td>" . $row["OrderDate"] . "</td>";
echo "<td>" . $row["CustomerNum"] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
exit;
?>