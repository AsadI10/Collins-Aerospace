<?php
require_once("ProductData.php");
require_once("CacheDB.php");

// The class will be responsible for communication with the API, as well as caching data for faster access.
class APIInterface{

	private $_APIDomain;
	private $_AccessToken;

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

		//To get the Access token specifically from OAuth Json obj.
		$at = "access_token";
		$this->_AccessToken = json_decode($requestReturn)->$at;

	}

	// This function shouldn't be used as everything that needs it should be in this class.
	// However, it's here just in case.
	public function GetAccessToken(){
		return $this->_AccessToken;
	}

	// Directly calls the API to get a list of all product identifiers.
	public function GetAllProductIdentifiers(){
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

		//returning small bits of data with pagination.
		$post = '{"size":10, "keywords":""}';


		curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

		$results = curl_exec($ch);

		$sr = "searchresults";
		$r = "results";
		$id = "id";
		$pid = "paginationId";
		$results = json_decode($results);

		$paginationID = $pid;
		$results = $results->$r->$sr;

		$result = array();
		foreach($results as $element){
			array_push($result, $element->id);
		}

		return $result;
	}

	// Query the API and cache everything!
	public function UpdateAllProducts(){

		$identifiers = $this->GetAllProductIdentifiers();

		foreach($identifiers as &$product){
			$this->GetData($product)->SaveToCache();
		}

	}

	public function GetData($identifier){
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
		

		$p = new ProductData($identifier);
		$p->Centre = $result->centre;
		return $p;
	}
}
?>