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

//$sql="DROP DATABASE MH_HW4";

//creating the database
$sql="CREATE DATABASE Foil_Addicts";
try{
    if(mysqli_query($conn, $sql));
    {
        echo "Database Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

//selecting the database
mysqli_select_db($conn, 'Foil_Addicts');

//creating the table
$sql = "CREATE TABLE Customer
(CustomerNum int NOT NULL,
PRIMARY KEY (CustomerNum), 
CustomerName varchar(20), 
Street varchar(20),
City varchar(20),
Province varchar(2),
Zipcode int NOT NULL)";

//test query
try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

//creating the table
$sql = "CREATE TABLE Purchase
(OrderNum int NOT NULL,
PRIMARY KEY (OrderNum), 
OrderDate varchar(20),
CustomerNum int NOT NULL, 
FOREIGN KEY (CustomerNum) REFERENCES Customer(CustomerNum))";

//test query
try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}


//creating the table
$sql = "CREATE TABLE Expansion
(ExpansionNum int NOT NULL,
PRIMARY KEY (ExpansionNum),
ExpansionName varchar(20),
ReleaseDate varchar(20),
NumberOfCards int NOT NULL)";
;

//test query
try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

//creating the table
$sql = "CREATE TABLE Ind_Card
(IndexNum int NOT NULL,
PRIMARY KEY (IndexNum),
CardName varchar(20),
ExpansionNum int NOT NULL,
Rarity int NOT NULL,
FOREIGN KEY (ExpansionNum) REFERENCES Expansion(ExpansionNum))";

//test query
try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

//creating the table
$sql = "CREATE TABLE CardPack
(ItemNum int NOT NULL,
PRIMARY KEY (ItemNum),
CardsContained int NOT NULL,
ExpansionNum int NOT NULL,
OnHand int NOT NULL,
Price decimal(10,2),
FOREIGN KEY (ExpansionNum) REFERENCES Expansion(ExpansionNum))";

//test query

try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

//creating the table
$sql = "CREATE TABLE OrderLine
(OrderNum int NOT NULL,
ItemNum int NOT NULL,
NumOrdered int NOT NULL,
Price decimal(10,2),
FOREIGN KEY (ItemNum) REFERENCES CardPack(ItemNum),
FOREIGN KEY (OrderNum) REFERENCES Purchase(OrderNum))"
;

//test query
try{
    if(mysqli_query($conn, $sql))
    {
        echo "Table Created\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}


//calling the post function method
getInput();

//the post function method
function getInput(){
    print <<<_HTML_
    <FORM action="" method="post">
    CustomerNum: <input type="text" name="customerNum" />
    CustomerName: <input type="text" name="customerName" />
    Street: <input type="text" name="street" />
    City: <input type="text" name="city" />
    Province: <input type="text" name="province" />
    Zipcode: <input type="text" name="zipcode" />
    <INPUT type="submit" />
    </FORM>
    _HTML_;
}

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
