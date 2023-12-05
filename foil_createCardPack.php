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
    echo "<h1>Add CardPack to Foil Addicts Database</h1>";
echo "</header>";

echo "<br><br> Enter the information for a new CardPack in the database below!<br>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ItemNum: <input type="text" name="itemNum" />
    CardsContained: <input type="text" name="cardsContained" />
    ExpansionNumber: <input type="text" name="expansionNumber" />
    OnHand: <input type="text" name="onHand" />
    Price: <input type="text" name="price" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

//ask about this
if(isset($_POST['cardsContained']))
{
    //inserting the post data into the database
    $sql = "INSERT INTO CardPack (ItemNum, CardsContained, ExpansionNumber, OnHand, Price)
    VALUES
    ('$_POST[itemNum]', '$_POST[cardsContained]', '$_POST[expansionNumber]', '$_POST[onHand]', '$_POST[price]')";

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
