<?php
/**
 * Plugin Name: Cryptopanic.com Integration
 * Plugin URI: 
 * Description: 
 * Version: 1.0
 * Author: Stanislav Matrosov
 * Author URI: https://github.com/Matrosovdream/
*/

defined( 'ABSPATH' ) || exit;

if ( !defined( 'TDS_PLUGIN_FILE' ) ) {
	define( 'TDS_PLUGIN_FILE', __FILE__ );
}

require_once('classes/posttypes.class.php');
require_once('classes/api.class.php');
require_once('classes/posts.class.php');
require_once('classes/settings.class.php');
require_once('classes/cron.class.php');

require_once('shortcodes/frontpage_news.php');

require_once('hooks/actions.php');








