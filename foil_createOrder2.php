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
    echo "<h1>Add Items to Foil Addicts Order</h1>";
echo "</header>";

echo "<br><br> Enter the information for a product to add to the order!<br>";

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    ItemNum: <input type="text" name="itemNum" />
    Quantity Purchased: <input type="text" name="quantity" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

//selecting the database
mysqli_select_db($conn, 'foil_addicts');


if(isset($_POST['itemNum']) && isset($_POST['quantity'])) {
    $result = mysqli_query($conn, "SELECT Price FROM CardPack WHERE ItemNum = '$_POST[itemNum]'");
    $row = mysqli_fetch_array($result);
    $price = intval($row['Price']);
    $totalPrice = $price * intval($_POST['quantity']);

    $sql = "INSERT INTO OrderLine (OrderNum, ItemNum, NumOrdered, Price) VALUES ((SELECT MAX(OrderNum) FROM Purchase), '$_POST[itemNum]', '$_POST[quantity]', '$totalPrice')";
    
    if (!mysqli_query($conn, $sql)) {
        die('Could not connect: ' . mysqli_error());
    }
    echo "1 record added";
}

//back button
print <<<_HTML_
    <FORM action="/foil_createOrder.php" method="post">
    <INPUT type="submit" value="Back to Orders Screen"/>
    </FORM>
_HTML_;

//formatting the current table and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM OrderLine WHERE OrderNum = (SELECT MAX(OrderNum) FROM Purchase)");
echo "<table border='1'>
<tr>
<th> Order Num</th>
<th> Item Number</th>
<th> Quantity</th>
<th> Price</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row["OrderNum"] . "</td>";
    echo "<td>" . $row["ItemNum"] . "</td>";
    echo "<td>" . $row["NumOrdered"] . "</td>";
    echo "<td>" . $row["Price"] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
exit;
?>