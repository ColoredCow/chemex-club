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
define('DB_NAME', 'chemex_club');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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

define('AUTH_KEY',         'c 7(FDMlqp&,;Zw4H2?_HFO(IaiH03=MCY6~80%z|_G*CW(@-({5r[TFv[4!<Sew');
define('SECURE_AUTH_KEY',  'Ud^/&wzq0f3|hy6PGGbyp3,mUQ*>*<K6N-]7H+v9LH`y<ItL6v517M;<~qtpq}O(');
define('LOGGED_IN_KEY',    '9z&u[A6iuC4j pR$IK~u0)/#*v:+v`>?1TSQ%_a&&mi2M|D!WAEdF@=^-;a+<-V9');
define('NONCE_KEY',        'ZiYG+=SuS>0{ww|5_y~v-hQdsjHwQRdP]T~iks1++*-bKg~_MY6$ZEmE8/LSPhg0');
define('AUTH_SALT',        '/]{$J|K.@l4RcN-108U$R3fvICwL[CFsG6JTc-9u49xR65[^HJ~ZWP >MCP{18M;');
define('SECURE_AUTH_SALT', 'p(C6VqnEmkk!nI3_J1|]jV<Y^@ueH~IEi ~K,*08~oH)o{z|EuN#Lk~C!K) JDvz');
define('LOGGED_IN_SALT',   'E2GTHQh|]cF2,4{)h6tw=Yj!5B}xs@}7d$D`4dy:>j9OP+T<A0Un#!k+o2wntw:^');
define('NONCE_SALT',       '.Ieq%<zPcImQ-dKj~X{C*=)f(MZ86h0a97_V[~6|vq[M*Hm^1<{4}JRIr~02aiEq');

/**#@-*/
/**
 * Updated Path for Wordpress Core Files and Content
 *
 * Because the wp-content directory isn’t in the same place as the core WordPress files ,
 * we need to tell the config file where it actually is.
 * The same with the core WordPress files.
 */

define('WP_ENVIRONMENT', 'Development');

if (WP_ENVIRONMENT == 'Production') {
	define('WP_ROOT', '');
} elseif (WP_ENVIRONMENT == 'Development') {
	define('WP_ROOT', '/put_your_project_name_here/public');
}

define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', 'https://' . $_SERVER['SERVER_NAME'] . WP_ROOT . '/wp-content');
define('WP_SITEURL', 'https://' . $_SERVER['SERVER_NAME'] . WP_ROOT . '/wp');
define('WP_HOME', 'https://' . $_SERVER['SERVER_NAME'] . WP_ROOT);

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

/**
 * Default Theme
 */

define('WP_DEFAULT_THEME', 'The Chemex Club Theme');

$table_prefix  = 'chem_cc';

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
