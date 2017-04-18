<?php 
error_reporting(E_ALL); 
ini_set('display_errors', true); 
$url = "https://menu.yancey.io/api/v1/2017-04-17/collins/dinner/all";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch); 

if ($result === FALSE){
	echo "cURL Error: " . curl_error($ch); 
}

curl_close($ch); 
$menu_array = json_decode($result, true);

$host = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "Menu"; 

$conn = mysqli_connect("$host", "$username", "$password", "$database"); 

if (!$conn){
	die("Connection Failed: " . mysqli_connect_error()); 
}
echo "Connected Successfully" . "<br>";


for ($i=0; $i < count($menu_array) ; $i++) { 
	for ($j=0; $j < count($menu_array[$i]['items']); $j++) { 
		$spot = $menu_array{$i}['name']; 
		$name = $menu_array[$i]['items'][$j]['name'];
		$desc = $menu_array[$i]['items'][$j]['description'];

		echo $spot . "-" . $name . "- " . $desc;
		echo "<br>";  

		$sql = "INSERT INTO Items (meal, description, spot) VALUES ('$name', '$desc', '$spot')"; 
		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		} 
	}
}


$conn->close(); 

print_r($result); 


?>