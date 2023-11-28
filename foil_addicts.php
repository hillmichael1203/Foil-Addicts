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
    echo "<h1>Foil Addicts Database</h1>";
echo "</header>";

//header and buttons for each of customer's forms
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
    echo "<h2>Reports</h2>";
    echo "<h4>Generate Foil Addicts Customer Report:</h4>";
echo "</header>";
print <<<_HTML_
    <FORM action="/foil_customerReport.php" method="post">
    <INPUT type="submit" value="Generate Customer Report"/>
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
