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
    echo "<body style='background-color:282828; font-family: Arial; color: white; padding: 25px;'>";
    echo "<h1>Foil Addicts November Report for Sales of CardPacks in Expansion 1</h1>";
echo "</header>";

//the time the report was generated
echo "Report generated at " . date("h:i:sa m/d/Y") . "<br>";


//selecting the database
date_default_timezone_set("America/New_York");
mysqli_select_db($conn, 'Foil_Addicts');

//formatting the report and displaying it
mysqli_select_db($conn, 'foil_addicts');
$sql = "
SELECT Customer.CustomerName, Customer.Zipcode, CardPack.ItemNum, Purchase.OrderDate
FROM Customer 
LEFT JOIN Purchase ON Customer.CustomerNum = Purchase.CustomerNum
LEFT JOIN OrderLine ON Purchase.OrderNum = OrderLine.OrderNum
LEFT JOIN CardPack ON OrderLine.ItemNum = CardPack.ItemNum
LEFT JOIN Expansion ON CardPack.ExpansionNumber = Expansion.ExpansionNumber
WHERE Expansion.ExpansionNumber = '1' AND Purchase.OrderDate BETWEEN '2023-11-01' and '2023-11-30'
GROUP BY Customer.CustomerName, Customer.Zipcode, CardPack.ItemNum, Purchase.OrderDate
";

$result= mysqli_query($conn, $sql);
echo "<table border='1'>
<tr>
<th> Customer Name </th>
<th> Zip Code</th>
<th> Item Num</th>
<th> Order Date</th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["CustomerName"] . "</td>";
echo "<td>" . $row["Zipcode"] . "</td>";
echo "<td>" . $row["ItemNum"] . "</td>";
echo "<td>" . $row["OrderDate"] . "</td>";
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
