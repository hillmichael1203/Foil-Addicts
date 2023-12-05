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

//header of the report
echo "<header>";
    echo "<h1>Foil Addicts Order Report</h1>";
echo "</header>";

//the time the report was generated
echo "Reports generated at " . date("h:i:sa m/d/Y") . "<br>";


//selecting the database
date_default_timezone_set("America/New_York");
mysqli_select_db($conn, 'Foil_Addicts');

//header of the report
echo "<header>";
    echo "<h2>Orders</h2>";
echo "</header>";

//formatting the report and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM Purchase");
echo "<table border='1'>
<tr>
<th> Order Number </th>
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

//header of the report
echo "<header>";
    echo "<h2>Order Line</h2>";
echo "</header>";

//formatting the report and displaying it again
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM OrderLine");
echo "<table border='1'>
<tr>
<th> Order Number </th>
<th> Item Number </th>
<th> Number Ordered </th>
<th> Price </th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["OrderNum"] . "</td>";
echo "<td>" . $row["ItemNum"] . "</td>";
echo "<td>" . $row["NumOrdered"] . "</td>";
echo "<td>" . $row["Price"] . "</td>";
echo "</tr>";
}
echo "</table>";

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