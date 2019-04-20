<?php

// // Allow from any origin
// if(isset($_SERVER["HTTP_ORIGIN"]))
// {
//     // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
//     header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
// }
// else
// {
//     //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
//     header("Access-Control-Allow-Origin: *");
// }

// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Max-Age: 600");    // cache for 10 minutes

// if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
// {
//     if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
//         header("Access-Control-Allow-Methods: POST, OPTIONS"); //Make sure you remove those you do not want to support

//     if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
//         header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

//     //Just exit with 200 OK with the above headers for OPTIONS method
//     exit(0);
// }
// //From here, handle the request as it is ok

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

if (empty($_POST['fname']) && empty($_POST['email'])) die();

if ($_POST)
	{

	// set response code - 200 OK

	http_response_code(200);
	$subject = $_POST['fname'];
	$to = "mykdsn@gmail.com";
	$from = $_POST['email'];

	// data

	$msg = $_POST['number'] . $_POST['message'];

	// Headers

	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=UTF-8\r\n";
	$headers.= "From: <" . $from . ">";
	mail($to, $subject, $msg, $headers);

	// echo json_encode( $_POST );

	echojson_encode(array(
		"sent" => true
	));
	}
  else
	{

	// tell the user about error

	echojson_encode(["sent" => false, "message" => "Something went wrong"]);
	}

?>