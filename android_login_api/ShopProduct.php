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


 
if (isset($_POST['product_id'])) {
 
    // receiving the post params
    $product_id = $_POST['product_id'];
    number_format($product_id);

   // $product_id = (int)$product_id
 
    // get the user by email and password
    //function is here
    $stmt = $conn->prepare("SELECT * FROM shop_product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    //executing the query 
    $stmt->execute();

    //binding results to the query 
    $stmt->bind_result($Service_ID, $Price, $Available_Special_Offers, $product_id,	$Shop_ID);

    $productsbyid = array(); 

    while($stmt->fetch()){
        $temp = array();
        $temp['Service_ID'] = $Service_ID; 
        $temp['Price'] = $Price; 
        $temp['Available_Special_Offers'] = $Available_Special_Offers; 
        $temp['product_id']=$product_id;
        $temp['Shop_ID']=$Shop_ID;
        
        array_push($productsbyid, $temp);

        }
        echo json_encode($productsbyid);


    }
    else{


        $productsbyid["error_msg"] = "Required parameters ID !!!!!!";
        echo json_encode($productsbyid);


    }

   
?>