
<?php
//konekcija bez fetch-a
$serverBaze = "localhost";
$username = "root";
$password = "";
$bazaPodataka = "teretana";
try {
$konekcija = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka",$username, $password);

$konekcija ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
echo "Greska sa konekcijom: " . $e->getMessage();
}
?>