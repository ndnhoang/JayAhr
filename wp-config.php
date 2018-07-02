<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jayahr');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'VmbP3z^|a9qZTh-]48!<CzLk5VM#pvZ[<v043UyJ?;rjg#O >j%}y>w^Xe[jI7B`');
define('SECURE_AUTH_KEY',  '-Gm1dvcptMa3+ZkD*8BClA8%c8( pr/?o@/bO9[d4B#:ch%6clSLbR`M2d$b@Y;^');
define('LOGGED_IN_KEY',    '2,Bk8T}4|s8Umz^m#Z^Is}(q`7`GmaZXKem`CSNJ5?@dc3~3atIYdZ2TT<szr$7(');
define('NONCE_KEY',        '1FV;>lN#!V@N/5:J}~10o?bT7uMHbjuQa,.C~pX$[j,0/%QozqZhUZ6MK2]/5=qO');
define('AUTH_SALT',        'vUhla]zY7N9.<PvZ/0Tq6d:8|k.R(H2LSi|vA&*HXltO_9}P$_I2^&Kj*+*]-Q=+');
define('SECURE_AUTH_SALT', '3Ti:I`^2]63C*dIK&uqOR}dESEtXES8%u){:sru~o2ycP$>O/&j2HQ|bm_/F:h}i');
define('LOGGED_IN_SALT',   'DFu;g,8!feH1E}<wUBPsaOV0|e>aCcNU}la_P2deuAH`KVO<5X`ZI5R y*XQ*IJr');
define('NONCE_SALT',       'fsc5h,:atrlZcBYqN}g%=s[gvq&,F #i$t~X0/sk/UL_6#XQKeGL&wc}YV7@bD5;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
