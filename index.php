<?php

$method = $_SERVER['REQUEST_METHOD'];

//$method ='GET';

//$LanID ='sguna002';



if ($method == 'POST')

{

    $requestBody = file_get_contents('php://input');

	$json = json_decode($requestBody);

	$number = $json->queryResult->parameters->number;
	$userChoice= $json->queryResult->parameters->UserChoice;
	$userStatus= $json->queryResult->parameters->UserStatus;
	//$number='12356';
	//$userChoice='yes';

	$username = 'sguna002';

	$password = 'sguna002';
	$LanID='sguna002';

	//$URL = "http://192.168.0.9:8055/invoke/Default:new_flowservice?num1=2&num2=4";

	//$URL = "http://localhost:8055/invoke/Default:new_flowservice?num1=2&num2=4";

	//$URL = 'https://localhost:8999/rest/Default/new_rest/_get?num1=2&num2=4';

	//https://localhost:8999/rest/Default/new_rest/_get?num1=1&num2=4



    

     switch ($userChoice) {

        

        case "Yes":

		  

		       
		    // $URL="http://66.25.18.67:5555/rest/Default/new_restExp/_get?num1=12&num2=15";
        $URL="https://b2bprod01.7-eleven.com:9002/rest/Default/new_rest/_get?number=$number&userChoice=$userChoice&
		userStatus=$userStatus";
		     
	     
	 case "No":
		     $Status_MSG="Thanks for reaching 7-Eleven B2B Support.Goodbye"

$opts = array('http' =>

 array(

    //   'header'    => ['Content-type: application/json' , 'Accept: application/json', 'Authorization: Basic '.base64_encode("$username:$password")], 'method'    => 'GET',
 //'content' => http_build_query($json)));
		     
		      'header'    => ['Content-type: application/json' , 'Accept: application/json', 'Authorization: Basic '.base64_encode("$username:$password")], 'method'    => 'GET'));



$context = stream_context_create($opts);

$jsonStr = file_get_contents($URL, false, $context);

$obj = json_decode($jsonStr);

		    // $Status_MSG = $jsonStr;

$Status_MSG = $obj->{'invoiceStatus'};

// $Status_MSG = "Your Cognizant ID $LanID/boss has been validated. Thanks";



		    	  break;

            

        default:

            $Status_MSG = "Your Cognizant  ID is not valid. Thanks";

            break;

    }



	



    $response = new \stdClass();

    $response->fulfillmentText = "ulaganayagan" . $Status_MSG;

    $response->fulfillmentText = "ulaganayagan" . $Status_MSG;

    $response->source = "webhook";

    echo json_encode($response);

}

else

{

    //echo "This method not allowed here";

    $response = new \stdClass();

    $response->fulfillmentText = "This method not allowed here";

    $response->fulfillmentText = "This method not allowed here";

    $response->source = "webhook";

    echo json_encode($response);

}



?>
