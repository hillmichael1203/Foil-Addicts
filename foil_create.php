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
        echo "Database Created Successfully!\n";
    }
}
catch (exception $e)
{
    echo $e->getmessage() . "\n";
}

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
