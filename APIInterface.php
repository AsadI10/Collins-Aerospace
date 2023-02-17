<?php
require_once("./ProductData.php");
require_once("./CacheDB.php");
require_once("./FootprintData.php");
require_once("./ErrorHandler.php");

// The class will be responsible for communication with the API, as well as caching data for faster access.
class APIInterface{

	private $_APIDomain;
	private $_AccessToken;
	private $_IsLoggedIn;

	function __construct($apiDomain, $username, $password){
		// Set the domain this object will use.
		$this->_APIDomain = $apiDomain;
		// Aquire access token:

		/* Instantiate $curlInstance (curl object).

		 This object will be used for all
		 calls back and forth to the API.
		 The object can also take many extra
		 'body's', 'headers', 'POST' fields
		 for certain requests.

		 read this for basics to POST &
		 Header fields:

		 https://reqbin.com/Article/HttpPost

		 also refer to this to demonstrate
		 CURL_OPT functions:
		 https://stackoverflow.com/questions/61266770/how-to-get-oauth-2-0-using-php-curl-with-client-credentials-as-grant-type
		 */
		$curlInstance = curl_init();

		curl_setopt($curlInstance, CURLOPT_URL, $this->_APIDomain."/api/v1/token"); //set API URL
		curl_setopt($curlInstance, CURLOPT_POST, true);
		curl_setopt($curlInstance, CURLOPT_RETURNTRANSFER, true); //enables returned JSON from execution
		curl_setopt($curlInstance, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
		curl_setopt($curlInstance, CURLOPT_SSL_VERIFYHOST, false); // **

		//setting header variables for API call. (So API reaches correct Endpoint)
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'Accept: */*',
			'Host: localhost' //return address
		);
		curl_setopt($curlInstance, CURLOPT_HTTPHEADER, $headers); //provides the CURLOPT_HTTPHEADER with the $header array for the curl request

		//same as header except POST
		$post = "grant_type=password&username=".$username."&password=".$password;
		curl_setopt($curlInstance, CURLOPT_POSTFIELDS, $post); //same as header except POST

		//set the <CLIENTID>:<CLIENTSECRET> for the API's communication with us... the client.
		$username = "sci-toolset";
		$password = "st";
		curl_setopt($curlInstance,CURLOPT_USERPWD, "$username:$password"); //same as setting an option for the header except its for <USERNAME>:<PASSWORD> and takes a string

		//executes the curl request and gets the status code (200) being success
		$requestReturn = curl_exec($curlInstance);
		//ALWAYS CLOSE CONNECTIONS!
		curl_close($curlInstance);

		// Check if a response was given
		if($requestReturn == false){
			$this->_IsLoggedIn = false;
			RaiseFatalError("API Interface","No response from \"".$apiDomain."\". The site may be down, or the username or password may be incorrect.");
			return;
		}

		//To get the Access token specifically from OAuth Json obj.
		$at = "access_token";
		$this->_AccessToken = json_decode($requestReturn)->$at;
		$this->_IsLoggedIn = true;
	}

	public function IsLoggedIn(){
		return $this->_IsLoggedIn;
	}

	// Directly calls the API to get a list of all product identifiers.
	public function GetAllProductIdentifiers($documentType = null, $missionID = null){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->_APIDomain."/discover/api/v1/products/search"); //set API URL
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
		curl_setopt($ch, CURLOPT_TCP_FASTOPEN, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // **

		$headers = array(
			'Accept: */*',
			'Authorization: Bearer '.$this->_AccessToken,
			'Content-Type: application/json',
			'Host: localhost' //return address
		);

		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

		$keywords = array();

		if($documentType != null){
			array_push($keywords, $documentType);
		}
		if($missionID != null){
			array_push($keywords, $missionID);
		}

		$keywords = join(",", $keywords);

		//returning small bits of data with pagination.
		$post = '{"size":300, "keywords":"'.$keywords.'"}';

		curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

		$results = curl_exec($ch);
		curl_close($ch);
		$results = json_decode($results);

		$paginationID = $results->paginationId;
		$result = array();
		
		// This loop can be multi-threaded
		do{
			$results = $results->results->searchresults;
			$shouldExit = count($results) <= 0;

			foreach($results as $element){
				array_push($result, $element->id);
			}

			$results = $this->GetNextPage($paginationID);
			$results = json_decode($results);
		} while(!$shouldExit);

		return $result;
	}

	public function NormalizeResults($results){
		$set = json_decode($results);

		$_SESSION['Pagination_id'] = $set->paginationId;
		$results = $set->results->searchresults;

		$result = array();
		foreach($results as $element){
			array_push($result, $element->id);
		}

		return $result;
	}

	public function GetNextPage($paginationID){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->_APIDomain."/discover/api/v1/products/page/".$paginationID); //set API URL
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
		curl_setopt($ch, CURLOPT_TCP_FASTOPEN, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // **

		$headers = array(
			'Accept: */*',
			'Authorization: Bearer '.$this->_AccessToken,
		);

		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

		$results = curl_exec($ch);
		curl_close($ch); 

		return $results;

	}
	public function GetRawData($identifer){
		//-----------------------------------
		//MULTITHREADED PRODUCT DATA RETRIVAL
		//-----------------------------------
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $this->_APIDomain."/discover/api/v1/products/".$identifier); //set API URL			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //**
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // This is needed to stop it printing to screen
		
		$headers = array(
			'Accept: */*',
			'Authorization: Bearer '.$this->_AccessToken,
			'Content-Type: application/json',
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);
		$result = $result->product->result;

		return $result;
	}

	public function GetData($identifier){
		$result = $this->GetRawData($identifier);

		$p = new ProductData($identifier,$result->viewname,$result->centre);
		$p->DocumentType = $result->documentType;
		$p->DateCreated = date("d-m-Y H:i:s", $result->datecreated/1000);
		$p->DateModified = date("d-m-Y H:i:s", $result->datemodified/1000);
		$p->Footprint = new FootprintData($result->footprint->type, $result->footprint->coordinates);
		$p->ProductURL = $result->producturl;
		$p->Thumbnail = $result->thumbnail;
		$p->MissionID = $result->missionid;
		$p->Creator = $result->creator;
		return $p;
	}

	// Just echos the raw JSON and does nothing else.
	public function echojson($identifier){
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $this->_APIDomain."/discover/api/v1/products/".$identifier); //set API URL			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //**
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // This is needed to stop it printing to screen
		
		$headers = array(
			'Accept: */*',
			'Authorization: Bearer '.$this->_AccessToken,
			'Content-Type: application/json',
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);
		$result = $result->product->result;
		echo json_encode($result);
	}
}
?>