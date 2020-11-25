<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'android_api');

//connecting to database and getting the connection object
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Checking if any error occured while connecting
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}

//creating a query
$stmt = $conn->prepare("SELECT product_ID, Product_Name, Description, image FROM product;");

//executing the query 
$stmt->execute();

//binding results to the query 
$stmt->bind_result($product_ID, $Product_Name, $Description, $image);

$products = array(); 

//traversing through all the result 
while($stmt->fetch()){
$temp = array();
$temp['product_ID'] = $product_ID; 
$temp['Product_Name'] = $Product_Name; 
$temp['Description'] = $Description; 
$temp['image']=$image;
array_push($products, $temp);
}

//displaying the result in json format 
echo json_encode($products);
?>


