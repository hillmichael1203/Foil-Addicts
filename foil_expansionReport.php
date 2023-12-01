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
    echo "<h1>Foil Addicts Expansion Report</h1>";
echo "</header>";

//the time the report was generated
echo "Report generated at " . date("h:i:sa m/d/Y") . "<br>";


//selecting the database
date_default_timezone_set("America/New_York");
mysqli_select_db($conn, 'Foil_Addicts');

//formatting the report and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM Expansion");
echo "<table border='1'>
<tr>
<th> Expansion Number</th>
<th> Expansion Name</th>
<th> Release Date</th>
<th> Number of Cards</th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["ExpansionNumber"] . "</td>";
echo "<td>" . $row["ExpansionName"] . "</td>";
echo "<td>" . $row["ReleaseDate"] . "</td>";
echo "<td>" . $row["NumberOfCards"] . "</td>";
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
