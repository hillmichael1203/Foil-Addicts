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
    echo "<h1>Delete a CardPack from the Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Please enter the itemNum of the CardPack to be removed.<br>";
echo "<br><br> Please note that you cannot delete the first record.";


//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ItemNum: <input type="text" name="itemNum" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['itemNum']))
{
    //removing the data from the database
    $sql = "DELETE FROM CardPack 
    WHERE ItemNum = '$_POST[itemNum]'";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record deleted";

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
$result= mysqli_query($conn, "SELECT * FROM CardPack");
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

mysqli_close($conn);
exit;
?>
