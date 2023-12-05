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
    echo "<body style='background-color:282828; font-family: Arial; color: white; padding: 25px;'>";
    echo "<h1>Access a customer's data by name in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the customer's name get their data.<br>";


//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    CustomerName: <input type="text" name="customerName" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

//back button
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;

if(isset($_POST['customerName']))
{
        //formatting the current table and displaying it
    mysqli_select_db($conn, 'foil_addicts');
    $result= mysqli_query($conn, "SELECT * FROM Customer WHERE CustomerName = '$_POST[customerName]'");
    echo "<table border='1'>
    <tr>
    <th> Customer Name</th>
    <th> Customer Number</th>
    <th> Street</th>
    <th> City</th>
    <th> State</th>
    <th> Zip Code</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["CustomerName"] . "</td>";
    echo "<td>" . $row["CustomerNum"] . "</td>";
    echo "<td>" . $row["Street"] . "</td>";
    echo "<td>" . $row["City"] . "</td>";
    echo "<td>" . $row["Province"] . "</td>";
    echo "<td>" . $row["Zipcode"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
}


mysqli_close($conn);
exit;
?>
