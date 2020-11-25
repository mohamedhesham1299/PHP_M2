<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'android_api');

//connecting to database and getting the connection object
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);




if (isset($_POST['Shop_ID'])){

    $Shop_ID=$_POST['Shop_ID'];
    number_format($Shop_ID);

    //creating a query
    $stmt = $conn->prepare("SELECT * FROM Shop WHERE Shop_ID = ?");
    $stmt->bind_param( "i", $Shop_ID );

    //executing the query 
    $stmt->execute();

    //binding results to the query 
    $stmt->bind_result($Shop_ID, $Shop_Name, $Latitude, $Longitude,$image);

    $shops = array(); 
    $stmt->fetch() ;
    //traversing through all the result 
    
    $shops['Shop_ID'] = $Shop_ID; 
    $shops['Shop_Name'] = $Shop_Name; 
    $shops['Latitude'] = $Latitude;
    $shops['Longitude'] = $Longitude ;
    $shops['image']=$image;

    echo json_encode($shops);
}
else{

    $shops["error_msg"] = "Required parameters ID !!!!!!";
    echo json_encode($shops);


}

//displaying the result in json format 

?>