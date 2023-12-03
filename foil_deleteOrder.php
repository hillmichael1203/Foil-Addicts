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
    echo "<h1>Delete an Order from the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the OrderNum of the Order to be removed.<br>";


//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    OrderNum: <input type="text" name="orderNum" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['orderNum']))
{
    //removing the data from the database
    $sql = "DELETE FROM Purchase
    WHERE OrderNum = '$_POST[orderNum]'";

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

//formatting the report and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM Purchase");
echo "<table border='1'>
<tr>
<th> Order Num </th>
<th> Order Date </th>
<th> Customer Number </th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
    echo "<td>" . $row["OrderNum"] . "</td>";
echo "<td>" . $row["OrderDate"] . "</td>";
echo "<td>" . $row["CustomerNum"] . "</td>";
echo "</tr>";
}
echo "</table>";

echo "<br>";
