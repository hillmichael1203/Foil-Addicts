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
    echo "<h1>Add Expansion to Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Enter the information for a new expansion in the database below!<br>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ExpansionName: <input type="text" name="ExpansionName" />
    NumberOfCards: <input type="text" name="NumberOfCards" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['ExpansionName']))
{
    //inserting the post data into the database
    $sql = "INSERT INTO Expansion (ExpansionName, ReleaseDate, NumberOfCards)
    VALUES
    ('$_POST[ExpansionName]', CURRENT_DATE(), '$_POST[NumberOfCards]')";

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

mysqli_close($conn);
exit;
?>
