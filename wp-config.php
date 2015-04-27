<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'breakwat_wo5070');

/** MySQL database username */
define('DB_USER', 'breakwat_wo5070');

/** MySQL database password */
define('DB_PASSWORD', 'YiBmvUYqsJaH');

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
define('AUTH_KEY', 'kKiD|cqMhzUzDBqg[U@@qL^[=uk^;wqCH_oaL-qV-emgVV(Rs_$BraY(>_/)SOQW|Xb^&QxRniapPCPw<_DAhorlPr/^TMheXYuB]uUR&d>^LOUMLWN%lpM!}WqY%=M@');
define('SECURE_AUTH_KEY', 'S;HixQcQNhU$D*ytg$-YFhAr*^q%&HhFKaCWXOBg)hJx<A<-U<Sr)|cLrqGsIWx=!nHvC{oBW$vbr[&%A_bXg)Jz$Is-IOj>(NJcM-b>&tXFEedPrVAG(xXD=(k<CkLL');
define('LOGGED_IN_KEY', 'nC_iA[*K|@;ngynS_]d<T[?W${HP?eu[=(dZXreeDiWJKJ_sTe[Ste|HkdQuiJzuegn*x?$Z@)FyykEXUaGQDE?]tMkuXzxRa]bZ}oEMSQbz!sR[_I?=xq$?Z_oup_m-');
define('NONCE_KEY', 'nGw_j@d//XmN<bpv!+Yl}/SRHouT&qpbO+bsg@puxsuXOo*RDbFMxpTvxS?(g[]G!=bcWRJsFe[)}D{AtFBJbsY)=CZFoHTWtWR$mrOmJk?;PO%)$xYf)c&-G;bv%j^{');
define('AUTH_SALT', 'GT$e}r|RW/Hqq^mF(M&dOT-}DqaJKQuNCCI|^}PaSBb_W)Y]o=ljHAV|c+^_&+]LO}$VHsP-Vlx|?NhRH$vV>u|=f*K+?XO;b[r/fZ?peiUiVj_p|!M=T$KZnN|l?[&&');
define('SECURE_AUTH_SALT', 'pZ-${-tL^n<-U%hwBKC;XQNn>;wEpHlPMZ[}VNjhjn|Ymbha>u;JE!AT-osWLeiqK{+I(W+undMNqzynuRpnK/F>-{bS>kkzvkq<>tZ&QX=YO@VXTA?FmrWTLbXRUc>_');
define('LOGGED_IN_SALT', 'eUiMLZ<cEYWj>bT&t=NIP&{a_]@/nUgCePeUId]@keas&CnFqYJA^bAt+Dz/L_U}$og{OuzUU)y;+XMfsD;Rz$U%=;xkY>lGnhya[KmNlzuomy<Wfl_&/@]l=?%EP}f(');
define('NONCE_SALT', 'vL%D=e/kGpIpx[RZ@eO?fUSZA%]%JhF^}SLB^WNjHhbZn;N?ShTVGBb-qe>[%sVb=?*vWxTSOrITplumhzb$owSo/]u/WwHYO}YC;n]RG};Rs]K^VUrS*=z@_ytzZ%zy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_fjqa_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
