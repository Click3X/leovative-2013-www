<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

define('EMAIL_FROM','noreply@click3x.com');
define('EMAIL_TO','cfmdev@icloud.com');
// define('EMAIL_TO','ohsiwon@gmail.com');

define('EMAIL_SUBJECT','#leovative');
define('EMAIL_MESSAGE','Here\'s a new image from Click 3x.');

//Test account
define('TWITTER_CONSUMER_KEY','0Lq12FPHlTgvl2Q5gnHBQ');
define('TWITTER_CONSUMER_SECRET', 'vjda2nMXZIfCDoSqFcvQIhlUl3CwKq2XvYwHuIo8');
define('TWITTER_TOKEN', '396970137-aHRyebmtXzaBMWCKBHrZiF9qVR67RfYIbqS9guZw');
define('TWITTER_TOKEN_SECRET', 'zu9vOlkp0DAjRg1W3G6NfyPnaoNs4JeB8Ag3n6E5cQs51');

//Live account
// define('TWITTER_CONSUMER_KEY','nboG5rgmh6ynsp3hmxuQA');
// define('TWITTER_CONSUMER_SECRET', 'PW4PofEMgMzdojgkaSTGpOhQ8H372jCjwwZ0snXc8Q');
// define('TWITTER_TOKEN', '28368165-AnqlpphRaTNEahOTXTLK80M55tqdH5liBf0q2viuZ');
// define('TWITTER_TOKEN_SECRET', 'zu9vOlkp0DAjRg1W3G6NfyPnaoNs4JeB8Ag3n6E5cQs51');

define('TWITTER_MENTION_MESSAGE_1', 'Check out all of the #leovative #click3x photos, and visit us at www.clickfiremedia.com');
define('TWITTER_MENTION_MESSAGE_2', 'Check out all of the Leovative #click3x photos, and visit us at www.clickfiremedia.com');

define('GA_ACCOUNT', "UA-XXXXX-X");

define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */