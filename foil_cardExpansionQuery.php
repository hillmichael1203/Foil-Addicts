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
    echo "<h1>See all cards by expansion in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the expansion's ExpansionNumber get the card's data.<br>";

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ExpansionNumber: <input type="text" name="expansionNumber" />
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

if(isset($_POST['expansionNumber']))
{
    //formatting the current table and displaying it
    mysqli_select_db($conn, 'foil_addicts');
    $result= mysqli_query($conn, "SELECT * FROM Ind_Card WHERE ExpansionNumber = '$_POST[expansionNumber]'");
    echo "<table border='1'>
    <tr>
    <th> Index Number</th>
    <th> Card Name</th>
    <th> Expansion Number</th>
    <th> Rarity</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["IndexNum"] . "</td>";
    echo "<td>" . $row["CardName"] . "</td>";
    echo "<td>" . $row["ExpansionNumber"] . "</td>";
    echo "<td>" . $row["Rarity"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

}

echo "<br>";



mysqli_close($conn);
exit;
?>
