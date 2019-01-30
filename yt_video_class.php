<?php
//namespace DevII;

class youtube_video{

	/* ------------------------------------- *\
			private
	\* ------------------------------------- */

	/* --- Variable ---*/
	private $url;
	private $id;

	/* --- function --- */

	private function get_info(){ // Renvoie un tableau avec des informations sur la video depuis un fichier Json
 		$youtube = "http://www.youtube.com/oembed?url=". $this->url ."&format=json";
	 	$curl = curl_init($youtube);
	 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	 	$return = curl_exec($curl);
	 	curl_close($curl);
	 	return json_decode($return, true);
 	}

	/* ------------------------------------- *\
			public
	\* ------------------------------------- */

	/* --- Variable ---*/

	// --- Parametre pour l'iframe :

	/**
	 * $iframe_param Array containing the main parameters of a Youtube iframe
	 * @var array
	 */
	public $iframe_param = [
		'width'          => '560px', // width (or indicator css like "%")
		// Default value : 560px
		'height'         => '315px', // height (or indicateur css comme les "%")
		// Default value : 315px
		"rel"            => '1',     // Displays video suggestions (or 0 for don't display)
		// Default value : 1
		"controls"       => '1',     // Shows the controls (or 0 for don't display)
		// Default value : 1
		"showinfo"       => '1',     // Displays information (or 0 for don't display)
		// Default value : 1
		"cookies"        => '1',     // Mode using cookies (or 0 for don't use cookies)
		// Default value : 1
		"autoplay"       => '0',     // The video doesn't start alone (1 to start alone)
		// Default value : 0
		"color"          => 'red',   // Player color (red or white)
		// Default value : red
		"start"          => '0',     // Start the video at 0 seconds (or start at 20 seconds by putting 20)
		// Default value : 0
		"modestbranding" => '0',     // Displays the YouTube logo on the control banner (or 1 to don't display it)
		// Default value : 0
		"fs"             => '1',     // Present the full screen button (or 0 to don't display it)
		// Default value : 1
		"cc_load_policy" => "1"      // Display subtitles, even if the user has disabled them
		// Default value : 1
	];
	

	/* --- function --- */

	/**
	 * __construct description
	 * @param [type] $url [description]
	 */
	public function __construct($url) {
		if (isset($url) && !empty($url)) {
			$this->url = $url;
			if (preg_match("/^(http|https):\/\/(www\.)?youtube\.com\/watch\?v=([\w-]+).*$/i", $url)) {
				parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
				$this->id = $my_array_of_vars['v'];
			} elseif(preg_match("/^(http|https):\/\/youtu\.be\/([\w-]+)$/i", $url)) {
				$this->id = str_replace("https://youtu.be/", '', $url);
			}
		} else {
			echo 'Erreur : url is not difined or empty';
		}
	}


	public static function Is_vYT(string $url) { // Returns a boolean (true or false) if it is a YotuTube url or not
		if (preg_match("/^(http|https):\/\/(www\.)?youtube\.com\/watch\?v=([\w-]+).*$/i", $url)) {
			return True;
		} elseif(preg_match("/^(http|https):\/\/youtu\.be\/([\w-]+)$/i", $url)) {
			return True;
		} else {
			return false;
		}
	}

	public function get_url () { // Return the url video
		return $this->url;
	}

	public function get_id () { // Return the id vidoe
		return $this->id;
	}

	public function get_title () { // Return the video title
		return $this->get_info()['title'];
	}

	public function get_urlChannel () { // Return the youtube channel url
		return $this->get_info()['author_url'];
	}

	public function get_nameChannel () { // Return the youtube channel name
		return $this->get_info()['author_name'];
	}

	public function get_description () { // Return the youtube video description
		$content = file_get_contents($this->url);
		$regex = preg_match('/<p id="eow-description" class="" >(.*)<\/p>/i', $content, $matches);
		return $matches[1];
	}
	
	public function get_Thumbnail () { // Returns an array of different image of the video (tumbail)
		$id = $this->id;
		// Some images may not exist according to the resolution
		return array(
			0 => "http://img.youtube.com/vi/".$id."/maxresdefault.jpg", // High Definition (1920×1080 pixels)
			1 => "http://img.youtube.com/vi/".$id."/hqdefault.jpg",     // Standard Definition (640×480 pixels)
			
			2 => "http://img.youtube.com/vi/".$id."/0.jpg",             // Thumbnail (480×360 pixels)
			
			3 => "http://img.youtube.com/vi/".$id."/mqdefault.jpg",     // Medium quality (320×180 pixels)
			4 => "http://img.youtube.com/vi/".$id."/default.jpg",       // Normal quality (120×90 pixels)
			
			5 => "http://img.youtube.com/vi/".$id."/1.jpg",             // First image (120×90 pixels)
			6 => "http://img.youtube.com/vi/".$id."/2.jpg",             // 2nd image (120×90 pixels)
			7 => "http://img.youtube.com/vi/".$id."/3.jpg",             // Last image (120×90 pixels)
		);
	}

	public function Iframe () { // Return a video iframe
		$id = $this->id;
		$cookie_or_not = 'www.youtube.com';
		if($this->iframe_param["cookies"] == 0 || $this->iframe_param["cookies"] == false) {
			$cookie_or_not = "www.youtube-nocookie.com";
		}
		return '<iframe style="width:'.$this->iframe_param["width"].'; height:'.$this->iframe_param["height"].';" src="https://'.$cookie_or_not.'/embed/'.$id.'?rel='.$this->iframe_param["rel"].'&controls='.$this->iframe_param["controls"].'&showinfo='.$this->iframe_param["showinfo"].'&autoplay='.$this->iframe_param["autoplay"].'&color='.$this->iframe_param["color"].'&start='.$this->iframe_param["start"].'&modestbranding='.$this->iframe_param["modestbranding"].'&fs='.$this->iframe_param["fs"].'&cc_load_policy'.$this->iframe_param["cc_load_policy"].'" frameborder="0" allowfullscreen></iframe>';
	}

}

?>
