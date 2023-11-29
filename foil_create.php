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
(CustomerNum int NOT NULL AUTO_INCREMENT,
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
(OrderNum int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (OrderNum), 
OrderDate DATE NOT NULL,
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
(ExpansionNumber int NOT NULL,
PRIMARY KEY (ExpansionNumber),
ExpansionName varchar(20),
ReleaseDate DATE NOT NULL,
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
ExpansionNumber int NOT NULL,
Rarity int NOT NULL,
FOREIGN KEY (ExpansionNumber) REFERENCES Expansion(ExpansionNumber))";

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
ExpansionNumber int NOT NULL,
OnHand int NOT NULL,
Price decimal(10,2),
FOREIGN KEY (ExpansionNumber) REFERENCES Expansion(ExpansionNumber))";

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
        echo "Database Created Successfully!\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

mysqli_select_db($conn, 'foil_addicts');

//adding test data for customers
$sql = "INSERT INTO Customer (CustomerName, Street, City, Province, Zipcode)
VALUES('Joe Gatto', '15 E. Creston Ave.', 'New York City', 'NY', '10001')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Customer (CustomerName, Street, City, Province, Zipcode)
VALUES('Brian Quinn', '921 3rd St N', 'Wisconsin Rapids', 'WI', '54494')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Customer (CustomerName, Street, City, Province, Zipcode)
VALUES('James Murray', '417 E Huston St', 'West Burlington', 'IA', '52655')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Customer (CustomerName, Street, City, Province, Zipcode)
VALUES('Sal Vulcano', '4554 Darlow Ave', 'Rosemead', 'CA', '91016')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

//adding test data for expansions
$sql = "INSERT INTO Expansion (ExpansionNumber, ExpansionName, ReleaseDate, NumberOfCards)
VALUES('1', 'Season 1', CURRENT_DATE(), '4')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

//adding test data for cards
$sql = "INSERT INTO Ind_Card (IndexNum, CardName, ExpansionNumber, Rarity)
VALUES('1', 'Cranjus McBasketball', '1', '2')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Ind_Card (IndexNum, CardName, ExpansionNumber, Rarity)
VALUES('2', 'Jaden Smith Tattoo', '1', '1')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Ind_Card (IndexNum, CardName, ExpansionNumber, Rarity)
VALUES('3', 'JaCrispy', '1', '3')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";
$sql = "INSERT INTO Ind_Card (IndexNum, CardName, ExpansionNumber, Rarity)
VALUES('4', 'Ferret Head', '1', '4')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

//test data for card packs
$sql = "INSERT INTO CardPack (ItemNum, CardsContained, ExpansionNumber, OnHand, Price)
VALUES('1', '10', '1', '200', '5.25')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

//test data for purchase
$sql = "INSERT INTO Purchase (OrderDate, CustomerNum)
VALUES(CURRENT_DATE(), '2')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

//test data for orderline
$sql = "INSERT INTO OrderLine (OrderNum, ItemNum, NumOrdered, Price)
VALUES('1', '1', '2', '10.50')";
if (!mysqli_query($conn, $sql))
{
die('Could not connect: ' . mysqli_error());
}
echo "1 record added";

echo "<br><br> The Foil Addicts Database has been successfully created!<br>";
echo "If you want to clear the database, please use the 'DELETE DATABASE' button from the main screen.<br><br>";
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;


mysqli_close($conn);
exit;
?>
