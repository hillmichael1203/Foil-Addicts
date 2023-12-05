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
    echo "<h1>See All CardPacks by Expansion number in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the Cardpack's ExpansionNum get the cardpack's data.<br>";

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
    $result= mysqli_query($conn, "SELECT * FROM CardPack WHERE ExpansionNumber = '$_POST[expansionNumber]'");
    echo "<table border='1'>
    <tr>
    <th> Item Number</th>
    <th> Cards Contained</th>
    <th> Expansion Number</th>
    <th> On Hand</th>
    <th> Price</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["ItemNum"] . "</td>";
    echo "<td>" . $row["CardsContained"] . "</td>";
    echo "<td>" . $row["ExpansionNumber"] . "</td>";
    echo "<td>" . $row["OnHand"] . "</td>";
    echo "<td>" . $row["Price"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

}

echo "<br>";



mysqli_close($conn);
exit;
?>
