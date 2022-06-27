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
define('WP_HOME','http://thietkewebsite.io/');
define('WP_SITEURL','http://thietkewebsite.io/');
/** The name of the database for WordPress */
define( 'DB_NAME', 'u263279622_wordpress' );

/** Database username */
define( 'DB_USER', 'u263279622_wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'Pphamhuuphuoc123' );

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
define( 'AUTH_KEY',         '2l.1(EiwU@dSyJ`o?[T&wK#p7<u0^x/%ur{u6h*ArCKXc3lh*qk5](w2.zLx{m=w' );
define( 'SECURE_AUTH_KEY',  'Zc-/?wB,QZ2+$?yIK)4XzeXzc}VFw0;Y=o.TfuQx<q/J8*!u:L{_>0|),F<k:+DX' );
define( 'LOGGED_IN_KEY',    ')#@,$8Twcr%)@q|1c3qHclCy}&50vM!` &]xTc=ziUEZZcZDWjw]kI~!3oH[Insd' );
define( 'NONCE_KEY',        'L>G4Lp$ M8b`(SHo%th:jN&KvT?|8CtpQS3Fnx~rL]eVw;o~&FeH<q,`7PXP;0(7' );
define( 'AUTH_SALT',        'ea3%0QgE$Nh-;.0v&,#+Ui H!#L2bNT+d6R7!%Y6`}RKMLM%Kq2K%o{1G1(L.@jj' );
define( 'SECURE_AUTH_SALT', '=Gaxkg.Y^owB_|a}M)VM;QV+9k&?@p~n-&H8$.gly:}$)Hu<5m0>+s$k!&o=[T(b' );
define( 'LOGGED_IN_SALT',   '~- [nHOOti-=Hde9~My}Xh4#({wBqk`xN&:bxS8Ugp<aYYzLlZauWzYN<]2UHeS6' );
define( 'NONCE_SALT',       '6TxPF=<u?K>P+;poTnv7MiOyFNZxGK)L4wKr;q1@#TiEZ]bNGT|/5k%TVZvV-PW]' );

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
