<?php

class XirSys
{
    // Please fill in your XirSys credentials here
    // Make sure it matches your dashboard credentials exactly
    private $domain        = $_ENV["XIRSYS_DOMAIN"];
    private $application   = 'default';
    private $ident         = $_ENV["XIRSYS_APPLICATION"];
    private $secret        = $_ENV["XIRSYS_IDENT"];
    // Forces getIceServers to return compatible URLs for STUNS and TURNS 
    private $secure        = '1';
    // Enable cross-origin resource sharing
    // For more information, visit: http://enable-cors.org
    private $enableCors    = '0';

    // The XirSys POST request URLs
    const SERVICE_ENDPOINT = 'https://api.xirsys.com/';
    const GET_ICE_SERVERS  = 'getIceServers';
    const GET_TOKEN        = 'getToken';
    const ADD_ROOM         = 'addRoom';
    const ADD_APPLICATION  = 'addApplication';
    const ADD_DOMAIN       = 'addDomain';

    // Prepares a POST request to get XirSys ICE servers
    public function getIceServers($room, $username) {
        $url = self::SERVICE_ENDPOINT.self::GET_ICE_SERVERS;
        $fields_string = '';
        $fields = array(
            'domain'      => urlencode($this->domain),
            'application' => urlencode($this->application),
            'room'        => urlencode($room),
            'username'    => urlencode($username),
            'ident'       => urlencode($this->ident),
            'secret'      => urlencode($this->secret),
            'secure'      => urlencode($this->secure)
        );
      
        // Executes the request
        return $this->executeRequest($url, $fields);
    }

    // Prepares a POST request to get a XirSys security token
    public function getToken($room, $username) {
        $url = self::SERVICE_ENDPOINT.self::GET_TOKEN;
        $fields_string = '';
        $fields = array(
            'domain'      => urlencode($this->domain),
            'application' => urlencode($this->application),
            'room'        => urlencode($room),
            'username'    => urlencode($username),
            'ident'       => urlencode($this->ident),
            'secret'      => urlencode($this->secret),
            'secure'      => urlencode($this->secure)
        );
      
        return $this->executeRequest($url, $fields);
    }
  
    // Prepares a POST request to add a XirSys room
    // Username is not needed here
    public function addRoom($room) {
        $url = self::SERVICE_ENDPOINT.self::ADD_ROOM;
        $fields_string = '';
        $fields = array(
            'domain'      => urlencode($this->domain),
            'application' => urlencode($this->application),
            'room'        => urlencode($room),
            'ident'       => urlencode($this->ident),
            'secret'      => urlencode($this->secret),
            'secure'      => urlencode($this->secure)
        );
      
        return $this->executeRequest($url, $fields);
    }
  
    // Prepares a POST request to add a XirSys application
    // Room or username are not needed here
    public function addApplication($application) {
        $url = self::SERVICE_ENDPOINT.self::ADD_APPLICATION;
        $fields_string = '';
        $fields = array(
            'domain'      => urlencode($this->domain),
            'application' => urlencode($application),
            'ident'       => urlencode($this->ident),
            'secret'      => urlencode($this->secret),
            'secure'      => urlencode($this->secure)
        );
      
        return $this->executeRequest($url, $fields);
    }
  
    // Prepares a POST request to add a XirSys domain
    // Application, room, or username are not needed here
    public function addDomain($domain) {
        $url = self::SERVICE_ENDPOINT.self::ADD_DOMAIN;
        $fields_string = '';
        $fields = array(
            'domain' => urlencode($domain),
            'ident'  => urlencode($this->ident),
            'secret' => urlencode($this->secret),
            'secure' => urlencode($this->secure)
        );
      
        return $this->executeRequest($url, $fields);
    }
  
    // Executes the POST request
    public function executeRequest($url, $fields) {
        // Use key 'http' even when sending the request to https
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                // URLify the POST data
                'content' => http_build_query($fields),
            ),
        );

        // Prepares the POST request to be executed
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    // If CORS is enabled, sets proper headers
    public function checkForCors() {
        if ($this->enableCors === '1') {
            header("Access-Control-Allow-Origin: *");
        }
    }
}

?>