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

//header for page title
echo "<header>";
    echo "<style>h3 {text-decoration: underline; padding-top: 25px;} h4 {color:b3b3b3;}</style>";
    echo "<body style='background-color:282828; font-family: Arial; color: white; padding: 25px;'>";
    echo "<h1>Foil Addicts Database</h1>";
echo "</header>";

//header and buttons for creation/deletion of database
echo "<br>If this is your first time using the Foil Addicts Database, please click the button below to generate a blank database!";
print <<<_HTML_
    <FORM action="/foil_create.php" method="post">
    <INPUT type="submit" value="Create the Database"/>
    </FORM>
    _HTML_;

echo "If you'd like to delete the Foil Addicts Database and all data contained within, click the button below!";
print <<<_HTML_
    <FORM action="/foil_delete.php" method="post">
    <INPUT type="submit" value="Delete the Database"/>
    </FORM>
    _HTML_;

//all forms
echo "<header>";
    echo "<h2>Forms</h2>";
    echo "<h3>Customer Forms</h3>";
    echo "<h4>Create Customer for Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_createCustomer.php" method="post">
    <INPUT type="submit" value="Create Customer"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Modify Customer in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_modifyCustomer.php" method="post">
    <INPUT type="submit" value="Modify Customer"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Delete Customer from Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_deleteCustomer.php" method="post">
    <INPUT type="submit" value="Delete Customer"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card Forms</h3>";
    echo "<h4>Create Card for Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_createCard.php" method="post">
    <INPUT type="submit" value="Create Card"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Modify Card in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_modifyCard.php" method="post">
    <INPUT type="submit" value="Modify Card"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card Pack Forms</h3>";
    echo "<h4>Create Card Pack for Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_createCardPack.php" method="post">
    <INPUT type="submit" value="Create Card Pack"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Modify Card Pack in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_modifyCardPack.php" method="post">
    <INPUT type="submit" value="Modify Card Pack"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Delete Card Pack in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_deleteCardPack.php" method="post">
    <INPUT type="submit" value="Delete Card Pack"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Order Forms</h3>";
    echo "<h4>Create Order from Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_createOrder.php" method="post">
    <INPUT type="submit" value="Create Order"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Delete Order from Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_deleteOrder.php" method="post">
    <INPUT type="submit" value="Delete Order"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Expansion Forms</h3>";
    echo "<h4>Create Expansion in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_createExpansion.php" method="post">
    <INPUT type="submit" value="Create Expansion"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Modify Expansion in Foil Addicts:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_modifyExpansion.php" method="post">
    <INPUT type="submit" value="Modify Expansion"/>
    </FORM>
    _HTML_;
echo "<br>";

//all reports
echo "<header>";
    echo "<h2>Reports</h2>";
    echo "<h3>Customer</h3>";
    echo "<h4>Generate Foil Addicts Customer Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_customerReport.php" method="post">
    <INPUT type="submit" value="Generate Customer Report"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card</h3>";
    echo "<h4>Generate Foil Addicts Card Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_cardReport.php" method="post">
    <INPUT type="submit" value="Generate Card Report"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card Pack</h3>";
    echo "<h4>Generate Foil Addicts Card Pack Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_cardPackReport.php" method="post">
    <INPUT type="submit" value="Generate Card Pack Report"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Order</h3>";
    echo "<h4>Generate Foil Addicts Order Information Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_orderReport.php" method="post">
    <INPUT type="submit" value="Generate Order Information Report"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Expansion</h3>";
    echo "<h4>Generate Foil Addicts Expansion Information Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_expansionReport.php" method="post">
    <INPUT type="submit" value="Generate Expansion Information Report"/>
    </FORM>
    _HTML_;
echo "<br>";

//queries
echo "<header>";
    echo "<h2>Queries</h2>";
    echo "<h3>Customer</h3>";
    echo "<h4>Find Customer By Name:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_customerQuery.php" method="post">
    <INPUT type="submit" value="Find Customer by Name"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card</h3>";
    echo "<h4>Find Cards By Expansion:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_cardExpansionQuery.php" method="post">
    <INPUT type="submit" value="Find Cards by Expansion"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Find Cards By Rarity:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_cardRarityQuery.php" method="post">
    <INPUT type="submit" value="Find Cards by Rarity"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Card Pack</h3>";
    echo "<h4>Find Card Packs by Expansion:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_cardPackExpansionQuery.php" method="post">
    <INPUT type="submit" value="Find Card Packs by Expansion"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Finance</h3>";
    echo "<h4>Find Revenue By Customer:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_customerRevenueQuery.php" method="post">
    <INPUT type="submit" value="Find Revenue by Customer"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Find Revenue by Expansion:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_expansionRevenueQuery.php" method="post">
    <INPUT type="submit" value="Find Revenue by Expansion"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h3>Order</h3>";
    echo "<h4>Find details of Order:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_orderQuery.php" method="post">
    <INPUT type="submit" value="Find Order Details"/>
    </FORM>
    _HTML_;
echo "<header>";
    echo "<h4>Find Orders by Customer:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_orderCustomerQuery.php" method="post">
    <INPUT type="submit" value="Find Orders by Customer"/>
    </FORM>
    _HTML_;

//selecting the database
mysqli_select_db($conn, 'foil_addicts');

if(isset($_POST['customerNum']))
{
    //inserting the post data into the database
    $sql = "INSERT INTO Customer (CustomerNum, CustomerName, Street, City, Province, Zipcode)
    VALUES
    ('$_POST[customerNum]', '$_POST[customerName]', '$_POST[street]', '$_POST[city]', '$_POST[province]', '$_POST[zipcode]')";

    if (!mysqli_query($conn, $sql))
        {
        die('Could not connect: ' . mysqli_error());
        }
    echo "1 record added";

    $_POST = array();
}

print <<<_HTML_
<form action="/foil_addicts.php">
  <label for="cars">Choose a rarity:</label>
  <select name="cars" id="cars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>
_HTML_;

//formatting the current table and displaying it
mysqli_select_db($conn, 'foil_addicts');
$result= mysqli_query($conn, "SELECT * FROM Customer");
echo "<table border='1'>
<tr>
<th> CustomerNum </th>
<th> CustomerName </th>
<th> Street</th>
<th> City</th>
<th> State</th>
<th> Zipcode</th>
</tr>";
while($row = mysqli_fetch_array($result))
{ echo "<tr>";
echo "<td>" . $row["CustomerNum"] . "</td>";
echo "<td>" . $row["CustomerName"] . "</td>";
echo "<td>" . $row["Street"] . "</td>";
echo "<td>" . $row["City"] . "</td>";
echo "<td>" . $row["Province"] . "</td>";
echo "<td>" . $row["Zipcode"] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
exit;
?>
