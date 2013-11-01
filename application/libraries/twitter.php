<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitter
{
  protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	public function retweet($image_path,$screen_name)
	{				
		//Load helper
		$this->CI->load->helper('TwitterAPIExchange');
	
		$settings = array(
		    'oauth_access_token' => TWITTER_TOKEN,
		    'oauth_access_token_secret' => TWITTER_TOKEN_SECRET,
		    'consumer_key' => TWITTER_CONSUMER_KEY,
		    'consumer_secret' => TWITTER_CONSUMER_SECRET
		);

		//TWITTER REST API
		$url = 'https://api.twitter.com/1.1/statuses/update_with_media.json';
		$requestMethod = 'POST';
		
		$status = '@' . $screen_name . ' ' . TWITTER_MENTION_MESSAGE;

		$postfields = array(
    		'media[]' => "@{$image_path}",
    		'status' => "{$status}"
		);

		$twitter = new TwitterAPIExchange($settings);
		echo $twitter->buildOauth($url, $requestMethod)
         			 ->setPostfields($postfields)
         			 ->performRequest();
	}
	
}