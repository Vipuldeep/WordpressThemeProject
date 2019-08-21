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
define( 'DB_NAME', 'projectwordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.p|AElWYoIzU#YYCN{CecOM3`OlMRmW=)Z9obD[l5D#zF3]0P&o;K>qY<d)<p:A`' );
define( 'SECURE_AUTH_KEY',  'lczTNtDE:-Z<C}i2MU)Kjo2Z8go(87Rm[:^]6wLjzw0L2.x{I}x^[8:ItAT4!O=<' );
define( 'LOGGED_IN_KEY',    '*YtJrhWC]!x8&$[!3PFqq.GkU6}cDt+dP0$v|1JEL$xM2Q3^>AzGm9,nX=UP_g.7' );
define( 'NONCE_KEY',        'L>$.i^?|z}T6*LJm7[P[=d;Ood~{_?#:fNXD=C$PpT034V1--@)T{@Rr_8Dr-*6~' );
define( 'AUTH_SALT',        'J; 6p;pO&Y?8Z7enWtN<d`~l%Z8SV:6%~HGaB=gpQ<LE39-Fi/k~1?A(Z,!;=g*s' );
define( 'SECURE_AUTH_SALT', '.h.#]Oe|Hh9y]sp(~m&fT&Xo^>(4)XeDMt,Z+RPRE:tYQq`l)8(v|<JoUi^VQX,|' );
define( 'LOGGED_IN_SALT',   'f}JWp+f~!){B$N|k!)D|w:_jJh1tnB[4eKjPssB+6owuOB+cN`1{5cF- v;B?dp#' );
define( 'NONCE_SALT',       '-Yk$#NnomXg_FrD{EK^7P*XcQssT|d[we0mH(]<~rF2RfUd;[6yV#<_>Z+ER82o6' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
