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
define('DB_NAME', 'jay_ahr');

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
define('AUTH_KEY',         '%:U->~Q|M8~2>z?-5A;k6{dl-OSW`sr::_[?` *JZL`fn81=Qhqk6NdpAEi2yn!u');
define('SECURE_AUTH_KEY',  '?1Ml4u ~F#yFtjMje[F+#^VgkE,43hxeGYhcvY_vIf)[WA=&e.<lnRA.||7 D*|F');
define('LOGGED_IN_KEY',    'O8PK6!fT]oWsiwetr^+*<&MU[SZ-L!s}iNY0Jf#(0oK+f0GMHfh2LlPqiz2:K(XM');
define('NONCE_KEY',        '(a=>.DJw6h_V3l? [W=m+%2I3i>/iRW9j8&nus4~=zs99^2Ga,Mn,hmi#0I(wk7=');
define('AUTH_SALT',        '#3av|Mi}Tsd)L8#W& (H~qkU-B<TE~mT#9 8S$R8nO7j=zAx4Ag0Um<St>wDO;-V');
define('SECURE_AUTH_SALT', 'CEDk/)6MGNy%kAW??[!G1GOl(#i,Yi56w.MD;PdEtqd0kJGS]-c:xUONj)& bGRp');
define('LOGGED_IN_SALT',   'FGTnqP[eUX$UA@Ax%xPPcM+xv77vIO-N$b*aV*66Y:=Ap->$4; 1s=De0_;K(Ru:');
define('NONCE_SALT',       'C}k038sY)=5cRQP{3=ICxt5!;#M*%b;a()b*i*M|_BtP0ssj7q$P %`M-.!|^um2');

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
