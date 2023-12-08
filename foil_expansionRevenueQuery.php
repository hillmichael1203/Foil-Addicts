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
    echo "<h1>See specific expansion revenue in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the expansion's ExpansionNumber get the expansion's data.<br>";

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ExpansionNumber: <input type="text" name="ExpansionNumber" />
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

if(isset($_POST['ExpansionNumber']))
{
    //formatting the current table and displaying it
    mysqli_select_db($conn, 'foil_addicts');

    // Stack Overflow
    $expansionNum = $_POST['ExpansionNumber'];
    $sql = "
    SELECT Expansion.ExpansionNumber, Expansion.ExpansionName, Expansion.ReleaseDate, Expansion.NumberOfCards, COALESCE(SUM(OrderLine.Price), 0) AS Revenue
    FROM Expansion
    LEFT JOIN CardPack ON Expansion.ExpansionNumber = CardPack.ExpansionNumber
    LEFT JOIN OrderLine ON CardPack.ItemNum = OrderLine.ItemNum
    WHERE Expansion.ExpansionNumber = '$expansionNum'
    GROUP BY Expansion.ExpansionNumber, Expansion.ExpansionName, Expansion.ReleaseDate, Expansion.NumberOfCards
    ";

    $result= mysqli_query($conn, $sql);
    echo "<table border='1'>
    <tr>
    <th> Expansion Number</th>
    <th> Expansion Name</th>
    <th> Release Date</th>
    <th> Number of Cards</th>
    <th> Revenue</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    { echo "<tr>";
    echo "<td>" . $row["ExpansionNumber"] . "</td>";
    echo "<td>" . $row["ExpansionName"] . "</td>";
    echo "<td>" . $row["ReleaseDate"] . "</td>";
    echo "<td>" . $row["NumberOfCards"] . "</td>";
    echo "<td>" . $row["Revenue"] . "</td>";
    echo "</tr>";
    }
    echo "</table>";

}

echo "<br>";



mysqli_close($conn);
exit;
?>
