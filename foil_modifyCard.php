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
    echo "<h1>Modify a Card in the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the card's Index Number and updated information to modify its data.<br>";


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
    //updating the customer with the corresponding ID
    $sql = "UPDATE Ind_Card
    SET CardName = '$_POST[cardName]', 
    ExpansionNumber = '$_POST[expansionNumber]', 
    Rarity = '$_POST[rarity]'
    WHERE IndexNum = $_POST[indexNum]";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record modified";

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
