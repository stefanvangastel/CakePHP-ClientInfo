<?php
class ClientInfoComponent extends Component{

	public $client_agent;

	/**
	 * Components used by DebugToolbar
	 *
	 * @var array
	 */
	public $components = array('RequestHandler', 'Session');

	public function __construct(ComponentCollection $collection, $settings = array()) {
		
		//Call info functions and fill session if not set yet, lets keep nice and clean:
		$this->client_agent = $_SERVER['HTTP_USER_AGENT']; //Set var

		//OS detection
		if( ! CakeSession::check('ClientInfo.Os') ){
			CakeSession::write( 'ClientInfo.Os',$this->osInfo() );
		}

		//Browser detection
		if( ! CakeSession::check('ClientInfo.Browser') ){
			CakeSession::write( 'ClientInfo.Browser',$this->browserInfo() );
		}			
	}


	//Function that returns OS info array
	private function osInfo(){
		
    	$os    		=   __("Unknown OS Platform");

    	$os_array   =   array(
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
     	);

	    foreach ($os_array as $regex => $value) { 
	        if ( preg_match($regex, $this->client_agent) ) {
	           $os = $value;
	        }
	    }   

	    return $os;
	}

	//Function that returns Browser info array
	private function browserInfo() {

		$browser = array();

 		$browsers = array(
				"firefox"	=>	"Firefox",
				"msie"		=>	"Internet Explorer",
				"opera"		=>	"Opera",
				"chrome"	=>	"Chrome",
				"safari"	=>	"Safari",
				"mozilla"	=>	"Mozilla",
				"seamonkey"	=>	"Seamonkey",
				"konqueror"	=>	"Konqueror",
				"netscape"	=>	"Netscape",
				"gecko"		=>	"Gecko",
				"navigator"	=>	"Navigator",
				"mosaic"	=>	"Mosaic",
				"lynx"		=>	"Lynx",
				"amaya"		=>	"Amaya",
				"omniweb"	=>	"Omniweb",
				"avant"		=>	"Avant",
				"camino"	=>	"Camino",
				"flock"		=>	"Flock",
				"aol"		=>	"Aol"
            ); 
      
        foreach($browsers as $browserkey => $browsername) 
        { 
            if (preg_match("#($browserkey)[/ ]?([0-9.]*)#", strtolower($this->client_agent), $match)) 
            { 
                $browser['name'] = $browsername; 
                $browser['version'] = $match[2]; 
                break ; 
            } 
        } 

	    return $browser;
	}

}