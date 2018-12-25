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
define('DB_NAME', 'littlestar');

/** MySQL database username */
define('DB_USER', '');

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
define('AUTH_KEY',         '<8O}?R$@fLQha%,e8]xzKx~D;(%zx@!DH7rv^$LTddS>#YQ<lmLJ+0/`O Y^K0l5');
define('SECURE_AUTH_KEY',  '.R-~8JF`-^si}3fqcc,:g7)7B&SE(JHccU_Q5s?:9]`#?kf/z@Hzr*<D#AR$V9p*');
define('LOGGED_IN_KEY',    '7GYt|aSH}x5]3HO;|GyWSo4W]I0=fVU,|.#M4@!aa-Bkvw,lYmHnv{2`mMwJ~hK.');
define('NONCE_KEY',        '[g7G+3v-FrY{${32Xe`am}zU`/C.Q-g,^nQ8YY4<Nwyqo#P$&12u%IcwdE>gNew!');
define('AUTH_SALT',        '}!XW3xOZw.FL>8b7FTN@cKN{V-|=>DrUn+@2F/xciqwy} 5=J%?K1dhFn#2^i=Ov');
define('SECURE_AUTH_SALT', 'y:$K)/.*bUCVq29HV!]E!<=@9I9v}|h4,!W(ghx.{LPMC[_NXt^e}y1flw#V}yH5');
define('LOGGED_IN_SALT',   'DsyIJ.B]dN Wp,p>`U!q)(8eu6.#BIq1B}EJ8db=&fUeM*wJd,cy=E +8)4KVh,s');
define('NONCE_SALT',       'B}A*oAL&T1#~xfXw]}Bb&W}O[.Ew9}~_%-{s<B*EtP:+zxa]LT|nfbwK(qd%7..V');

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
