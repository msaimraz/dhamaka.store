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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dhamakas_dhamakastore' );

/** Database username */
define( 'DB_USER', 'dhamakas_dhamaka' );

/** Database password */
define( 'DB_PASSWORD', 'H35i:AV2!Bta3a' );

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
define( 'AUTH_KEY',         '8>jE#X)&`RN*r?~|1|qUJ)]e:.8q[o@*r,$JFVUaVluua^:wGMcnKV^9r _(5bCr' );
define( 'SECURE_AUTH_KEY',  'K8}A%9i|0]I0iY9:58~~KW/,kcm2HLR?yGnRBNU7fd*M^M/;nSwsrD|;4GueJ1?V' );
define( 'LOGGED_IN_KEY',    'bN]qpcp>}Nv~jU@6Zvx`|.p85rb~4S*)j!0=/1yTLOLhj_Tm{oMmNIAH |ip])P1' );
define( 'NONCE_KEY',        '~/U6g)jG;+~4R^_]b,t%ht!39i+vR`Y#jo$~~zCvBnHUQ)]d;yd&H2;^-aQr5]`n' );
define( 'AUTH_SALT',        '=hJC,ol5@M=N:mfqk+4=eJS3$l2xD}Jq3 RJ%eN#|{YG5X1}Un#opMl(I?p{L1j~' );
define( 'SECURE_AUTH_SALT', 'X.H4Vf/ZE2^/ YD#O}X/0X4B{0a }WavCGXTNuhFZ{3rOrY@P|RCk4=;OF@zt%lW' );
define( 'LOGGED_IN_SALT',   ':K9i/R4o/eI2z@4>U|DhB=d,4Myaz9S2[RKf$Oex!auoz:Vo&;!K$XY?g3c<^c*A' );
define( 'NONCE_SALT',       '}bM3Dk$:C,F{X5=Q4B5P>xTE|f[lRLck%/jM`[vszzCE9Q+s&xb6&%S$:,&e(`W@' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
