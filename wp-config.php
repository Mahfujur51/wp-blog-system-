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
define( 'DB_NAME', 'wp_blog' );

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
define( 'AUTH_KEY',         'WzlM mkTcoT=kv#roX0WQpIjqEW0>W}?Xx~I,RZ}XGIM=ax?S?*Os>3n6dYYPUIQ' );
define( 'SECURE_AUTH_KEY',  '}/8:xK{&$ )_^Fi$u2*<rgM%FfY7-<.8%zLKgy[xo87oNf[PX{5((Ea?ed }p0w{' );
define( 'LOGGED_IN_KEY',    'V$;2?e:{0vF^*xRU&O.P/[DDf0-4Noxz`EDr,,ZW&#hIq/It`DLaK`mNy1TG}@g.' );
define( 'NONCE_KEY',        '.&OyV@OC(x}k[?TJyA4GWUa[wyN QrfX Va <2Df7u@gVtJbQp5*>N{#Kv5F=ea)' );
define( 'AUTH_SALT',        'fs~}Wby0u-drQf`4>2zM#g:nOxZO2oUl*39BK}fl3+|?e Z(-i3rbI<6Z2n[g!-r' );
define( 'SECURE_AUTH_SALT', '9+K>w(D,Nn-)SXB.8J}wO2GDrx=GB>G{ah/`s3X,Qk`VcN-x2n i;rwMq,$wbMA%' );
define( 'LOGGED_IN_SALT',   'N4XFO~W&_#.@>z|K1`dY:z!<?+at,uz5h@SKrTfFfPM]0azr)kx_U2cmZ*JAo792' );
define( 'NONCE_SALT',       'o9?r-A}V?cetno7:F)s=gu|5~gG[{6zYU:m^2W;X!kjBE<jj%~PY,)716mF%Ev*5' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
