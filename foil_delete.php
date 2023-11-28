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

mysqli_select_db($conn, 'Foil_Addicts');

if(mysqli_query($conn, "Drop DATABASE Foil_Addicts"))
{
    printf("<br>Database dropped successfully. <br>");
}

echo "<br><br> The Foil Addicts Database has been successfully deleted!<br>";
echo "If you want to create a new empty Foil Addicts Database, click the 'CREATE THE DATABASE' button on the main screen.<br><br>";
print <<<_HTML_
    <FORM action="/foil_addicts.php" method="post">
    <INPUT type="submit" value="Back to Main Screen"/>
    </FORM>
    _HTML_;


mysqli_close($conn);
exit;
?>
