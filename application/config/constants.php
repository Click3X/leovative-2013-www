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

define('EMAIL_FROM','jaytord@mac.com');
define('EMAIL_SUBJECT','#leovative');
define('EMAIL_MESSAGE','Here\'s a new image from Click 3x.');

//Test account
define('EMAIL_TO','jaytord@mac.com');

define('TWITTER_CONSUMER_KEY','Xg1ScFBuDZGgdK7b5rhQ');
define('TWITTER_CONSUMER_SECRET', 'Ufinbnul3tD432XuJFudGmDP2fIESwSyoNndz8P5ng');
define('TWITTER_TOKEN', '2177078402-Ndal317Y69MDJU1SF51jpHNgKJQwoGtBJQJig6q');
define('TWITTER_TOKEN_SECRET', 'MjJqv5p2VqK2INCBi2ZyKXHcBFHgTrZyiqMNDG93loS3n');

define('TWITTER_PHOTOBOOTH_MESSAGE', 'Check out all of the #leovative_dev photos, and visit us at www.clickfiremedia.com');
define('TWITTER_RETWEET_MESSAGE', 'Check out all of the #leovative_dev photos, and visit us at www.clickfiremedia.com');

//Live account
//define('EMAIL_TO','cfmdev@icloud.com');

// define('TWITTER_CONSUMER_KEY','7tHnp6M1AJMgkazPhpaqYQ');
// define('TWITTER_CONSUMER_SECRET', 'dRZTWMy3gomxgsQKqrs73srL2hC7zz5tNxmvQa3xK0');
// define('TWITTER_TOKEN', '28368165-fDel2ufE958elGmNk73UHib7RjDpQPSm4i6aDj9DU');
// define('TWITTER_TOKEN_SECRET', 'CzVGueFzGSYQ4zxkwrDOyRAP0t96WEwPf5bQ5vcAceWOL');

//define('TWITTER_PHOTOBOOTH_MESSAGE', 'Check out all of the #leovative photos, and visit us at www.clickfiremedia.com');
//define('TWITTER_RETWEET_MESSAGE', 'Check out all of the #leovative photos, and visit us at www.clickfiremedia.com');

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