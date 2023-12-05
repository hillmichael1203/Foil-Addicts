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
    echo "<h1>Add A Card to Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Enter the information for a new card in the database below!<br>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    IndexNum: <input type="text" name="indexNum" />
    CardName: <input type="text" name="cardName" />
    ExpansionNumber: <input type="text" name="expansionNumber" />
    <label for="rarity">Choose a rarity:</label>
    <select name="rarity" id="rarity">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['cardName']))
{
    //inserting the post data into the database
    $sql = "INSERT INTO Ind_Card (IndexNum, CardName, ExpansionNumber, Rarity)
    VALUES
    ('$_POST[indexNum]', '$_POST[cardName]', '$_POST[expansionNumber]', '$_POST[rarity]')";

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
$result= mysqli_query($conn, "SELECT * FROM Ind_Card");
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

mysqli_close($conn);
exit;
?>
