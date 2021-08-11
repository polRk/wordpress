<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

function fromenv($key, $default = null) {
  $value = getenv($key);
  if ($value === false) {
    $value = $default;
  }
  return $value;
}

$DSN = parse_url(fromenv('DATABASE_URL', 'mysql://username_here:password_here@localhost:3306/database_name_here'));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', substr($DSN['path'], 1));

/** MySQL database username */
define('DB_USER', $DSN['user']);

/** MySQL database password */
define('DB_PASSWORD', $DSN['pass']);

/** MySQL hostname */
define('DB_HOST', $DSN['host']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         fromenv('AUTH_KEY', 'put your unique phrase here'));
define('SECURE_AUTH_KEY',  fromenv('SECURE_AUTH_KEY', 'put your unique phrase here'));
define('LOGGED_IN_KEY',    fromenv('LOGGED_IN_KEY', 'put your unique phrase here'));
define('NONCE_KEY',        fromenv('NONCE_KEY', 'put your unique phrase here'));
define('AUTH_SALT',        fromenv('AUTH_SALT', 'put your unique phrase here'));
define('SECURE_AUTH_SALT', fromenv('SECURE_AUTH_SALT', 'put your unique phrase here'));
define('LOGGED_IN_SALT',   fromenv('LOGGED_IN_SALT', 'put your unique phrase here'));
define('NONCE_SALT',       fromenv('NONCE_SALT', 'put your unique phrase here'));

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = fromenv('TABLE_PREFIX', 'wp_');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', !!fromenv('WP_DEBUG', false));

/* Add any custom values between this line and the "stop editing" line. */

define('AUTOMATIC_UPDATER_DISABLED', true);

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
