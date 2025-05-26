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
define( 'DB_NAME', 'wpptest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'W:#[aiQs/o5B2.9b$ )O_>L([A1>F2tC;x<v0tH&<j:n|Ri5q|ce`4ve(++`0^YR' );
define( 'SECURE_AUTH_KEY',  'tC9Ee-r<_935bQ=Qs6wAQdze8`(ZENaF=cK@2W][_MQ6w2{1A<~f&bb*!tBV67.*' );
define( 'LOGGED_IN_KEY',    '.E{P_1fdJV7tdbZ10S:-i/M)x(_ELP{g8CD?{4GD/3SWZu}.N]qQhIN%n#dLyO[p' );
define( 'NONCE_KEY',        't>dL^K~gDw{+R*i=q@P[$</$tuprUQ~F7hd3nGmDTd>gjX-kQy>VW(w2Pr{~N];O' );
define( 'AUTH_SALT',        '+.B4>HE *uHw/i:/nVZ>(B3UtwSP}lTzIEYz{qr]M&e0<#s>>U{y}&@F{[Yk>^X.' );
define( 'SECURE_AUTH_SALT', 'gO7HUOd}-`lGSnvV?)?Pxb(&s7JD<|ksG)G9s|D:_.:NOA<VR_nf,K_>K-su%1pW' );
define( 'LOGGED_IN_SALT',   '3 DB3Ir4ALPI7$0/@h-2[Ct76vznMax?XM,f,bPX[9o4G:bzSWMA-7Ns`OPX_;1p' );
define( 'NONCE_SALT',       'iMqwm0|s= {fy)WNPt{ewbm=Un;`20f_K%FUp^CQ>@ 5p[H8,3an.*FR3<Ry`Nt-' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
