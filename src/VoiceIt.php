<?php
    namespace VoiceIt;

    /**
     * Class VoiceIt
     *
     * @package VoiceIt
     */
    class VoiceIt {

        /** @var string */
        public $developerId;
        /** @var string */
        public $platformId = "6";

        /**
         * VoiceIt constructor.
         *
         * @param string $devId
         */
        function __construct ($devId) {
            $this->developerId = $devId;
        }

        /**
         * This REST API call is used to authenticate the specified user profile within the Voiceprint Developer Portal (VPDP) service.
         *
         * It authenticates the specified user profile in the VPDP service database and returns success or failure.
         *
         * Please note: The Voiceprint Phrase's (VPP's) are Text-Dependent. The Minimum length of a VPP is 1.5 second.
         * Please note: You cannot use enrollment sound file for authentication. This is because of our anti- spoofing technology.
         *
         * To manage the VPPs associated with your DeveloperID, please login to the developer portal and navigate to Voiceprint Phrases section.
         * We recommend starting with 85% for the confidence parameter during testing.
         * After becoming familiar with the API, you can tweak the confidence parameter (with a maximum around 91) in order to decrease false positives.
         *
         * Please note: You can use DetectedVoiceprintText and DetectedTextConfidence to help decide which authentication to keep or throw out
         * and have the user record again based on speech text detected and its confidence.
         *
         * HTTP Method: POST
         * URL: https://siv.voiceprintportal.com/sivservice/api/authentications
         *
         * @param string $mail                    The user's valid email address. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $password                The user's password. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $pathToAuthenticationWav File path to PCM Wave Data, 44.1 kHz, 22.05 kHz 16-bit, Stereo. This is a required parameter and cannot be null.
         * @param int    $confidence              This is used to set an acceptable confidence level needed for successful authentication. The values are 85-100. 85 being most lax and 100 being most strict. This is a required parameter and cannot be null.
         * @param string $contentLanguage         The content language for the phrase. This is an optional parameter and defaults to the default Language for the DeveloperId that can be set in the billing section of the developer portal.
         *
         * @return mixed
         */
        public function authentication ($mail, $password, $pathToAuthenticationWav, $confidence, $contentLanguage = "") {
            $data     = file_get_contents($pathToAuthenticationWav);
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/authentications';
            $header   = array();
            $header[] = 'X-Requested-With: JSONHttpRequest';
            $header[] = 'Content-Type: audio/wav';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'VsitConfidence: ' . $confidence;
            $header[] = 'ContentLanguage: ' . $contentLanguage;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
            $reply = curl_exec($crl);

            return $reply;
        }

        public function authenticationByWavURL ($mail, $password, $urlToAuthenticationWav, $confidence, $contentLanguage = "") {

            $url      = 'https://siv.voiceprintportal.com/sivservice/api/authentications/bywavurl';
            $header   = array();
            $header[] = 'X-Requested-With: JSONHttpRequest';
            $header[] = 'Content-Type: audio/wav';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'VsitConfidence: ' . $confidence;
            $header[] = 'ContentLanguage: ' . $contentLanguage;
            $header[] = 'VsitwavURL: ' . $urlToAuthenticationWav;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
            $reply = curl_exec($crl);

            return $reply;
        }

        /**
         * This REST API call is used to create a new enrollment template for the specified user profile within the Voiceprint Developer Portal (VPDP) service.
         *
         * It creates a new enrollment template for the specified user profile in the VPDP service database and returns true or false.
         * We recommend a minimum of three (3) enrollment templates per Voiceprint Phrase (VPP).
         *
         * Please note: The Voiceprint Phrase's (VPP's) are Text-Dependent. The Minimum length of a VPP is 1.2 second.
         * Please note: You cannot use enrollment sound file for authentication. This is because of our anti- spoofing technology.
         *
         * To manage the VPPs associated with your DeveloperID, please login to the developer portal and navigate to Voiceprint Phrases section.
         *
         * Please note: You can use DetectedVoiceprintText and DetectedTextConfidence to help decide which enrollmentID to keep or throw out and have the user record again based on text detected and its confidence.
         *
         * HTTP Method: POST
         * URL: https://siv.voiceprintportal.com/sivservice/api/enrollments
         *
         * @param string $mail                The user's valid email address. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $password            The user's password. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $pathToEnrollmentWav File path to PCM Wave Data, 44.1 kHz, 22.05 kHz 16-bit, Stereo. This is a required parameter and cannot be null.
         * @param string $contentLanguage     The content language for the phrase. This is an optional parameter and defaults to the default Language for the DeveloperId that can be set in the billing section of the developer portal.
         *
         * @return mixed
         */
        public function createEnrollment ($mail, $password, $pathToEnrollmentWav, $contentLanguage = "") {
            $data     = file_get_contents($pathToEnrollmentWav);
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
            $header   = array();
            $header[] = 'X-Requested-With: JSONHttpRequest';
            $header[] = 'Content-Type: audio/wav';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'ContentLanguage: ' . $contentLanguage;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
            $reply = curl_exec($crl);

            return $reply;
        }

        public function createEnrollmentByWavURL ($mail, $password, $urlToEnrollmentWav, $contentLanguage = "") {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/enrollments/bywavurl';
            $header   = array();
            $header[] = 'X-Requested-With: JSONHttpRequest';
            $header[] = 'Content-Type: audio/wav';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'ContentLanguage: ' . $contentLanguage;
            $header[] = 'VsitwavURL: ' . $urlToEnrollmentWav;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
            $reply = curl_exec($crl);

            return $reply;
        }

        /**
         * Registers a new user profile within the Voiceprint Developer Portal (VPDP) service.
         *
         * Creates a new user profile record in the VPDP service database and returns true or false.
         * Newly registered user profiles are enabled by default.
         * Your DeveloperID is in the Welcome email you received when you registered.
         *
         * HTTP Method: POST
         * URL: https://siv.voiceprintportal.com/sivservice/api/users
         *
         * @param string $mail      The user's valid email address. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $password  The user's password. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $firstName The user's first name. This is a required parameter and cannot be null.
         * @param string $lastName  The user's last name. This is a required parameter and cannot be null.
         * @param string $phone1    The user's phone1.
         * @param string $phone2    The user's phone2.
         * @param string $phone3    The user's phone3.
         *
         * @return mixed
         */
        public function createUser ($mail, $password, $firstName, $lastName, $phone1 = "", $phone2 = "", $phone3 = "") {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/users';
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'VsitFirstName: ' . $firstName;
            $header[] = 'VsitLastName: ' . $lastName;
            $header[] = 'VsitPhone1: ' . $phone1;
            $header[] = 'VsitPhone2: ' . $phone2;
            $header[] = 'VsitPhone3: ' . $phone3;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_POST, true);
            $reply = curl_exec($crl);

            return $reply;
        }

        public function deleteEnrollment ($mail, $password, $enrollmentId) {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/enrollments' . '/' . $enrollmentId;
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

            $reply = curl_exec($crl);

            return $reply;
        }

        /**
         * This REST API call is used to delete an existing user profile within the Voiceprint Developer Portal (VPDP) service.
         *
         * Deletes an existing user profile record from the VPDP service database and returns true or false.
         *
         * HTTP Method: DELETE
         * URL: https://siv.voiceprintportal.com/sivservice/api/users
         *
         * @param string $mail     The user's valid email address. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $password The user's password. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         *
         * @return mixed
         */
        public function deleteUser ($mail, $password) {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/users';
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

            $reply = curl_exec($crl);

            return $reply;
        }

        public function getEnrollments ($mail, $password) {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/enrollments';
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_HTTPGET, true);
            $reply = curl_exec($crl);

            return $reply;
        }

        /**
         * This REST API call is used to retrieve an existing user profile within the Voiceprint Developer Portal (VPDP) service.
         *
         * It retrieves an existing user profile record from the VPDP service database and returns true or false.
         *
         * HTTP Method: GET
         * URL: https://siv.voiceprintportal.com/sivservice/api/users
         *
         * @param string $mail     The user's valid email address. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         * @param string $password The user's password. Provided as part of the REST API Access Credentials. This is a required parameter and cannot be null.
         *
         * @return mixed
         */
        public function getUser ($mail, $password) {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/users';
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_HTTPGET, true);
            $reply = curl_exec($crl);

            return $reply;
        }

        public function setUser ($mail, $password, $firstName, $lastName, $phone1 = "", $phone2 = "", $phone3 = "") {
            $url      = 'https://siv.voiceprintportal.com/sivservice/api/users';
            $header   = array();
            $header[] = 'Accept: application/json';
            $header[] = 'VsitEmail: ' . $mail;
            $header[] = 'VsitPassword: ' . hash('sha256', $password);
            $header[] = 'VsitDeveloperId: ' . $this->developerId;
            $header[] = 'VsitFirstName: ' . $firstName;
            $header[] = 'VsitLastName: ' . $lastName;
            $header[] = 'VsitPhone1: ' . $phone1;
            $header[] = 'VsitPhone2: ' . $phone2;
            $header[] = 'VsitPhone3: ' . $phone3;
            $header[] = 'PlatformID: ' . $this->platformId;

            //cURL starts
            $crl = curl_init();
            curl_setopt($crl, CURLOPT_URL, $url);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($crl, CURLOPT_PUT, true);
            $reply = curl_exec($crl);

            return $reply;
        }
    }
