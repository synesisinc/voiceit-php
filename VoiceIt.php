<?php
class VoiceIt{
	public $developerId;

	function __construct($devId) {
				  print "Constructor Called\n";
				  $this->developerId = $devId;
				  print "Variables Initialized\n";
	          }

	public function createUser($mail, $passwd,$firstName, $lastName, $phone1 = "",$phone2 = "", $phone3 = "")
		  	{
		  		$url = 'https://siv.voiceprintportal.com/sivservice/api/users';
		  		    $headr = array();
		  		    $headr[] = 'Accept: application/json';
		  		    $headr[] = 'VsitEmail: '.$mail;
		  			$headr[] = 'VsitPassword: '.hash('sha256',$passwd);
		  			$headr[] = 'VsitDeveloperId: '.$this->developerId;
		  			$headr[] = 'VsitFirstName: '.$firstName;
		  			$headr[] = 'VsitLastName: '.$lastName;
		  			$headr[] = 'VsitPhone1: '.$phone1;
		  			$headr[] = 'VsitPhone2: '.$phone2;
		  			$headr[] = 'VsitPhone3: '.$phone3;

		  		    //cURL starts
		  		    $crl = curl_init();
		  		    curl_setopt($crl, CURLOPT_URL, $url);
		  		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		  		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		  		    curl_setopt($crl, CURLOPT_POST,true);
		  		    $reply = curl_exec($crl);
		  			return $reply;
	}

	public function getUser($mail, $passwd)
	{
		$url = 'https://siv.voiceprintportal.com/sivservice/api/users';
		    $headr = array();
		    $headr[] = 'Accept: application/json';
		    $headr[] = 'VsitEmail: '.$mail;
			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			$headr[] = 'VsitDeveloperId: '.$this->developerId;

		    //cURL starts
		    $crl = curl_init();
		    curl_setopt($crl, CURLOPT_URL, $url);
		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($crl, CURLOPT_HTTPGET,true);
		    $reply = curl_exec($crl);
			return $reply;
	}

	public function setUser($mail, $passwd,$firstName, $lastName, $phone1 = "",$phone2 = "", $phone3 = "")
	{
		$url = 'https://siv.voiceprintportal.com/sivservice/api/users';
		    $headr = array();
		    $headr[] = 'Accept: application/json';
		    $headr[] = 'VsitEmail: '.$mail;
			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			$headr[] = 'VsitDeveloperId: '.$this->developerId;
			$headr[] = 'VsitFirstName: '.$firstName;
			$headr[] = 'VsitLastName: '.$lastName;
			$headr[] = 'VsitPhone1: '.$phone1;
			$headr[] = 'VsitPhone2: '.$phone2;
			$headr[] = 'VsitPhone3: '.$phone3;

		    //cURL starts
		    $crl = curl_init();
		    curl_setopt($crl, CURLOPT_URL, $url);
		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($crl, CURLOPT_PUT,true);
		    $reply = curl_exec($crl);
			return $reply;
	}

	public function deleteUser($mail, $passwd)
	{
		$url = 'https://siv.voiceprintportal.com/sivservice/api/users';
		    $headr = array();
		    $headr[] = 'Accept: application/json';
		    $headr[] = 'VsitEmail: '.$mail;
			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			$headr[] = 'VsitDeveloperId: '.$this->developerId;

		    //cURL starts
		    $crl = curl_init();
		    curl_setopt($crl, CURLOPT_URL, $url);
			curl_setopt($crl, CURLOPT_CUSTOMREQUEST,"DELETE");
		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

		    $reply = curl_exec($crl);
			return $reply;
	}

	public function createEnrollment($mail, $passwd,$pathToEnrollmentWav)
		  	{
				    $data = file_get_contents($pathToEnrollmentWav);
		  		    $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
		  		    $headr = array();
					$headr[] = 'X-Requested-With: JSONHttpRequest';
		  		    $headr[] = 'Content-Type: audio/wav';
		  		    $headr[] = 'VsitEmail: '.$mail;
		  			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
		  			$headr[] = 'VsitDeveloperId: '.$this->developerId;
		  			$headr[] = 'VsitFirstName: '.$firstName;
		  			$headr[] = 'VsitLastName: '.$lastName;
		  			$headr[] = 'VsitPhone1: '.$phone1;
		  			$headr[] = 'VsitPhone2: '.$phone2;
		  			$headr[] = 'VsitPhone3: '.$phone3;

		  		    //cURL starts
		  		    $crl = curl_init();
		  		    curl_setopt($crl, CURLOPT_URL, $url);
		  		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		  		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		  		    curl_setopt($crl, CURLOPT_POST,true);
					curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
					curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
		  		    $reply = curl_exec($crl);
		  			return $reply;
	}

	public function createEnrollmentByWavURL($mail, $passwd,$urlToEnrollmentWav)
		  	{
		  		    $url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments/bywavurl';
		  		    $headr = array();
					$headr[] = 'X-Requested-With: JSONHttpRequest';
		  		    $headr[] = 'Content-Type: audio/wav';
		  		    $headr[] = 'VsitEmail: '.$mail;
		  			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
		  			$headr[] = 'VsitDeveloperId: '.$this->developerId;
					$headr[] = 'VsitwavURL: '.$urlToEnrollmentWav;


		  		    //cURL starts
		  		    $crl = curl_init();
		  		    curl_setopt($crl, CURLOPT_URL, $url);
		  		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		  		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		  		    curl_setopt($crl, CURLOPT_POST,true);
					curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
					curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
		  		    $reply = curl_exec($crl);
		  			return $reply;
	}

	public function deleteEnrollment($mail, $passwd,$enrollmentId)
	{
		$url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments'.'/'.$enrollmentId;
		    $headr = array();
		    $headr[] = 'Accept: application/json';
		    $headr[] = 'VsitEmail: '.$mail;
			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			$headr[] = 'VsitDeveloperId: '.$this->developerId;

		    //cURL starts
		    $crl = curl_init();
		    curl_setopt($crl, CURLOPT_URL, $url);
			curl_setopt($crl, CURLOPT_CUSTOMREQUEST,"DELETE");
		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

		    $reply = curl_exec($crl);
			return $reply;
	}

	public function getEnrollments($mail, $passwd)
	{
		$url = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
		    $headr = array();
		    $headr[] = 'Accept: application/json';
		    $headr[] = 'VsitEmail: '.$mail;
			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			$headr[] = 'VsitDeveloperId: '.$this->developerId;

		    //cURL starts
		    $crl = curl_init();
		    curl_setopt($crl, CURLOPT_URL, $url);
		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($crl, CURLOPT_HTTPGET,true);
		    $reply = curl_exec($crl);
			return $reply;
	}

	public function authentication($mail, $passwd,$pathToAuthenticationWav,$accuracy,$accuracyPasses, $accuracyPassIncrement,$confidence)
		  	{
				    $data = file_get_contents($pathToAuthenticationWav);
		  		    $url = 'https://siv.voiceprintportal.com/sivservice/api/authentications';
		  		    $headr = array();
					$headr[] = 'X-Requested-With: JSONHttpRequest';
		  		    $headr[] = 'Content-Type: audio/wav';
		  		    $headr[] = 'VsitEmail: '.$mail;
		  			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
		  			$headr[] = 'VsitDeveloperId: '.$this->developerId;
		  			$headr[] = 'VsitAccuracy: '.$accuracy;
		  			$headr[] = 'VsitAccuracyPasses: '.$accuracyPasses;
		  			$headr[] = 'VsitAccuracyPassIncrement: '.$accuracyPassIncrement;
		  			$headr[] = 'VsitConfidence: '.$confidence;

		  		    //cURL starts
		  		    $crl = curl_init();
		  		    curl_setopt($crl, CURLOPT_URL, $url);
		  		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		  		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		  		    curl_setopt($crl, CURLOPT_POST,true);
					curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
					curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
		  		    $reply = curl_exec($crl);
		  			return $reply;
	}

	public function authenticationByWavURL($mail, $passwd,$urlToAuthenticationWav,$accuracy,$accuracyPasses, $accuracyPassIncrement,$confidence)
		  	{

		  		    $url = 'https://siv.voiceprintportal.com/sivservice/api/authentications/bywavurl';
		  		    $headr = array();
						  $headr[] = 'X-Requested-With: JSONHttpRequest';
			  		  $headr[] = 'Content-Type: audio/wav';
			  		  $headr[] = 'VsitEmail: '.$mail;
			  			$headr[] = 'VsitPassword: '.hash('sha256', $passwd);
			  			$headr[] = 'VsitDeveloperId: '.$this->developerId;
			  			$headr[] = 'VsitAccuracy: '.$accuracy;
			  			$headr[] = 'VsitAccuracyPasses: '.$accuracyPasses;
			  			$headr[] = 'VsitAccuracyPassIncrement: '.$accuracyPassIncrement;
			  			$headr[] = 'VsitConfidence: '.$confidence;
						  $headr[] = 'VsitwavURL: '.$urlToAuthenticationWav;

		  		    //cURL starts
							$crl = curl_init();
		  		    curl_setopt($crl, CURLOPT_URL, $url);
		  		    curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
		  		    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
		  		    curl_setopt($crl, CURLOPT_POST,true);
					curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
					curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
		  		    $reply = curl_exec($crl);
		  			return $reply;
	}
}

?>
