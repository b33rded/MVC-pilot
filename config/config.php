<?php
define('DEBUG', true);
define('DEFAULT_CONTROLLER', getenv('DEFAULT_CONTROLLER')); //default controller of absent in url
define('DEFAULT_LAYOUT', getenv('DEFAULT_LAYOUT')); // if no layout is set in da controller
define('GROOT', getenv('GROOT')); // set dat to '/' in live
define('SITE_TITLE', getenv('SITE_TITLE')); // this is used if no site title is set
define('CURRENT_USER_SESSION_NAME', getenv('CURRENT_USER_SESSION_NAME')); // session name
define('REMEMBER_ME_COOKIE_NAME', getenv('REMEMBER_ME_COOKIE_NAME')); // cookie for REMEMBER ME
define('REMEMBER_ME_COOKIE_EXPIRY', getenv('REMEMBER_ME_COOKIE_EXPIRY')); // time in secs for REMEMBER ME