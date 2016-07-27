<?php
define('WP_HOME', 'http://test.cnlsi.com:8888');
define('WP_SITEURL', 'http://test.cnlsi.com:8888');

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
//define('DB_NAME', 'langsheng');
define('DB_NAME', 'langsheng');

/** MySQL database username */
//define('DB_USER', 'langsheng');
define('DB_USER', 'langsheng');

/** MySQL database password */
//define('DB_PASSWORD', 'Langsheng2016!');
define('DB_PASSWORD', 'Langsheng2016!');

/** MySQL hostname */
//define('DB_HOST', '10.25.52.6');
define('DB_HOST', '10.25.52.6');

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
define('AUTH_KEY',         'AHF^vJ2VUwpn8y0|#8;6t]qk,e-q_w2h ^D((vFPQ;f3w`3$E|x/($iWp0#lcbzm');
define('SECURE_AUTH_KEY',  '$9M&p#?hU461jJsr``,l+f-VM^+O}b+D7*l|Yd/TFI{k7e+f+L]Z0,-G`AiJ=PH}');
define('LOGGED_IN_KEY',    'L:d$;juN=]?3HedWCn^+++XiJK<zP+BGeKI~vte];F[&hH;!.BDZ-Q|@o|Z-/56T');
define('NONCE_KEY',        'y-Xoi-XNg<jDHq70i&ggQX{`` @ 0e3Bq(ykSt:e^633|g&zj$|Imv>`kLV}q!7e');
define('AUTH_SALT',        'bTzN7U(-sX^A+2*sJdmOpU%-oy-q=Uz43:(=F^,Gkpz9:+Q(;Q`.CkeJ:&?6^E1~');
define('SECURE_AUTH_SALT', 'u^93Q2^++[0Frg/Lv++uW1?Vu[sjzm(3&Jj&0cJC|is?+~2rsuYaE!(t?W~@pZm3');
define('LOGGED_IN_SALT',   '+O[&[2En}$pe^RPgl6rJf ?_f`kk*+i@4F,cb;vxFhb6p6u~p>%n-z[)S,(RU$o/');
define('NONCE_SALT',       'V|P#4R2VW#Z,XN67E<zBOAQDb$ieNS@.Dcusc1nJ|$0~cCbJ(qpi{djH`:Qjp8Z>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpls_';

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
