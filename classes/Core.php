<?php

class Core {
	public $production = false;

	function __construct() {

		global $config;


		if ( strpos( $config['env'], 'prod' ) !== false ) {
			$this->production = true;
		} else {
			$this->production = false;

		}

	}

	/**
	 * Simple debug, saves time writing out debug code each time.
	 * Should not be used in a production environment.
	 *
	 * @param mixed $data - the data you would like to debug
	 */
	public function debug( $data ) {
		echo "<pre>";
		print_r( $data );
		echo "</pre>";
	}

	/**
	 * Responsible for building every single MySQL interaction.
	 *
	 * @throws string - on PDO will kill page and output an error
	 * @return PDO|false $sql - returns true if the score has been added
	 */
	public function sqlSetup() {
		global $config;

		$configDB = $config['db'];
		try {
			$sql = new PDO( 'mysql:host=' . $configDB['host'] . ';dbname=' . $configDB['data'], $configDB['user'], $configDB['pass'] );
			$sql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			return $sql;
		} catch ( PDOException $e ) {
			die( "Error setting up PDO:<hr>" . $e );
		}
	}

	/**
	 * Currently used for outputting straight errors.
	 *
	 * @param string $message - The string to output
	 * @param boolean $severity - Color coding based off of bootstraps colour
	 */
	public function message( $message, $severity = false ) {
		// TODO: Place messages inside of session and output with another function like displayMessage() which clears message session on display
		$this->debug( "MESSAGE: " . $message );
	}

	/**
	 * Redirects users with the PHP header.
	 * Builds redirection URL from the config and adds the input on the end.
	 *
	 * @param string $page - the page you would like to send the user to
	 */
	public function redirect( $page = "index" ) {
		global $config;
		$actual_link = rtrim( $config['homepage'], "/" ) . "/" . $page . ".php";
		header( "Refresh:0; url=" . $actual_link );
	}

	/**
	 * Checks if this project is running on localhost.
	 *
	 * @return true|false - returns true if running on localhost
	 */
	public function is_localhost() {

		$local = array( '127.0.0.1', '::1' );

		if ( in_array( $_SERVER['REMOTE_ADDR'], $local ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Checks if the visitor is logged in.
	 *
	 * @return true|false - true if PHP session is set and user_email is present
	 */
	public function is_logged_in() {
		if ( isset( $_SESSION ) && isset( $_SESSION["user_email"] ) && ! empty( $_SESSION["user_email"] ) ) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Returns the dynamic nav content based on the user been logged in
	 *
	 * @return string - content to display
	 */
	public function navLogin() {
		if ( $this->is_logged_in() ) {
			return '
				<li class="dropdown">               
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="' . $_SESSION["user_picture"] . '" class="user-img"> ' . $_SESSION["user_name"] . ' <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="no-hover">Logged in via ' . $_SESSION["user_social_type"] . ' </a></li>
                        <li><a href="#">Your History</a></li>
                        <li><a href="#">Your Account</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?logout">Logout</a></li>
                    </ul>
                </li>';
		} else {
			return false; //"<a class='animate' href='login.php'>Login to Play</a>";
		}
	}

	public function socialIcons() {

		global $config;
		$final = "";

		$brands = array(
			"android",
			"angellist",
			"apple",
			"behance",
			"bitbucket",
			"bitcoin",
			"bitcoin-alt",
			"blacktie",
			"blacktie-alt",
			"buysellads",
			"buysellads-alt",
			"cc-amex",
			"cc-discover",
			"cc-mastercard",
			"cc-paypal",
			"cc-stripe",
			"cc-visa",
			"codepen",
			"codiepie",
			"connectdevelop",
			"css3",
			"dashcube",
			"delicious",
			"deviantart",
			"digg",
			"dribbble",
			"dropbox",
			"drupal",
			"empire",
			"facebook",
			"facebook-alt",
			"flickr",
			"flickr-alt",
			"fonticons",
			"fonticons-alt",
			"forumbee",
			"foursquare",
			"git",
			"github",
			"github-alt",
			"gittip (alias)",
			"google",
			"google-alt",
			"google-wallet",
			"googleplus",
			"googleplus-alt",
			"gratipay",
			"hackernews",
			"hackernews-alt",
			"html5",
			"instagram",
			"ioxhost",
			"joomla",
			"jsfiddle",
			"lastfm",
			"leanpub",
			"linkedin",
			"linkedin-alt",
			"linux",
			"maxcdn",
			"meanpath",
			"meanpath-alt",
			"medium",
			"openid",
			"pagelines",
			"paypal",
			"piedpiper",
			"piedpiper-alt",
			"pinterest",
			"pinterest-alt",
			"qq",
			"queue",
			"queue-alt",
			"rebel",
			"reddit",
			"renren",
			"sellsy",
			"shirtsinbulk",
			"simplybuilt",
			"skyatlas",
			"skype",
			"slack",
			"slideshare",
			"soundcloud",
			"spotify",
			"stackexchange",
			"stackoverflow",
			"steam",
			"steam-alt",
			"stumbleupon",
			"stumbleupon-alt",
			"tencent-weibo",
			"trello",
			"tumblr",
			"tumblr-alt",
			"twitch",
			"twitter",
			"viacoin",
			"vimeo",
			"vimeo-alt",
			"vine",
			"vk",
			"wechat (alias)",
			"weibo",
			"weixin",
			"whatsapp",
			"windows",
			"wordpress",
			"wordpress-alt",
			"xing",
			"yahoo",
			"yahoo-alt",
			"yelp",
			"youtube",
		);

		foreach ( $config['navIcons'] as $icon => $link ) {

			if ( ! in_array( $icon, $brands ) ) {
				$iconString = "btl bt-" . $icon;
			} else {
				$iconString = "fab fab-" . $icon;
			}

			$final .= "<li><a class='animate' target='_blank' href='" . $link . "'><i class='" . $iconString . "'></i></a></li>";
		}

		return $final;
	}

	public function instagramFeed() {

		global $config;

		$url     = 'https://www.instagram.com/' . $config['instagramUser'] . '/media/';
		$content = file_get_contents( $url );
		$json    = json_decode( $content, true )['items'];

		$data = array();

		$i = 0;
		foreach ( $json as $photo ) {
			$data['code']         = $photo['code'];
			$data['image']        = $photo['images']['standard_resolution']['url'];
			$data['likes']        = $photo['likes']['count'];
			$data['comments']     = $photo['comments']['count'];
			$data['created_time'] = $photo['created_time'];

			echo "
			<div class='col-md-3'>
				<div class='instagram-tile' onclick='linkToPhoto(" . $photo['code'] . ")' style='background: url(" . $data['image'] . "); background-size:cover;'>
					<div class='instagram-hover'>
						<div class='instagram-likes'><i class='btl bt-thumbs-up'></i> " . $photo['likes']['count'] . "</div>
						<div class='instagram-comments'><i class='btl bt-quote-left'></i> " . $photo['comments']['count'] . "</div>
					</div>
				</div>
			</div>
			";

			if ( $i >= 3 ) {
				break;
			}
			$i ++;
		}
	}

	public function loadProjects() {

		$i = 0;

		while ( $i < 4 ) {
			$this->loadProject();
			$i ++;
		}
	}

	private function loadProject() {
		echo "
			<div class='project-tile'>
				<div class='container'>		
					<div class='row'>
						<div class='col-md-6'>
							<h2>Project Title</h2>
						</div>
						<div class='col-md-6'>
							<img src='assets/img/ps.png' class='icon' alt=''>
							<img src='assets/img/pr.png' class='icon' alt=''>
						</div>
					</div>
				</div>
				
				<div class='row' style='margin:0;'>
					";
		for ( $x = 0; $x < 4; $x ++ ) {
			echo "<div class='col-md-3'>
			<img class='img-responsive photo' src='https://unsplash.it/320/?image=" . rand( 0, 1084 ) . "'>
			</div>";
		}
		echo "
				</div>
			</div>
		";
	}

	/**
	 * Sort an array by rank (used for usort)
	 *
	 * @param array $a
	 * @param array $b
	 *
	 * @return array
	 */
	public function sortByOrder( $a, $b ) {
		return $a['rank'] - $b['rank'];
	}

}