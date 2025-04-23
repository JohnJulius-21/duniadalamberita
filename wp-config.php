<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'duniadalamberita' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3307' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'Xx43Qp2etPKSOW4w3Fdal3u43g8gHTOI94zqjz0pAzuoUMbfHCtRKWyIiMdHWCQx' );
define( 'SECURE_AUTH_KEY',  'oaZIlKP79nP6mOppP5kN491UAC8v0WZz18QJ2cT2afWMF3QEUVarQSLGsf3YCXpr' );
define( 'LOGGED_IN_KEY',    'FEe2RRqVxEXi5AAbnrGA3RzviiePkYPOOJ8tL8G3J0Mjlt8rrZDEn1vTozMjSG4c' );
define( 'NONCE_KEY',        '5rPDXzpA0yEURfIrIrgQC5uwGwsujPlWhjbg5OexjtI9GYTJIsGLyz2vjBYNSjft' );
define( 'AUTH_SALT',        'JTaNfr8WbHuhOEHGFGf5mh9noPVLVicS3LTby1k1UENwmBGXvHVG243Xc70BmHxM' );
define( 'SECURE_AUTH_SALT', 'uOwaJgmUoOvq5HoOY0Uoy8wOCyKMUn3Z3FcEd21PwUsCiv7z6v72eC8tOUaMUhYX' );
define( 'LOGGED_IN_SALT',   'ipyG2nijHejMScybbrFs2H7Wax9XNQeyRyV0GV5T9S0R4Xgoy1AjgUAHUzqxPicp' );
define( 'NONCE_SALT',       'OrPK8xHh182udxKaYJqZtlYuK2BZGKxTDfc4rI667rYNk8RdFVlR4Al5P6CPIKn6' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
