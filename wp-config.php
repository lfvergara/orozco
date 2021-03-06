<?php
define( 'WPCACHEHOME', '/srv/websites/orozco/wp-content/plugins/wp-super-cache/' );
define('WP_CACHE', true);
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
//define('DB_NAME', 'u825247889_ovdb');
define('DB_NAME', 'orozco');

/** Tu nombre de usuario de MySQL */
//define('DB_USER', 'u825247889_ovur');
define('DB_USER', 'u825247889_ovur');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'QC5[7P?:gZo5t8]y4N');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
//define('DB_HOST', '144.217.5.1');
define('DB_HOST', '127.0.0.1');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'y@b4[8jK3VL3bVBQ9.*$(hz>_Y(eIVv?QH/M=.4Nm<g+`FM|m0%B+^LqhGe&sHz9');
define('SECURE_AUTH_KEY', 'OWSvRDuV&JuRc&_{XbOH[bS%qbt7+N6X.-m?BNorJ+#wFE}]d|q3R.*85G2_jpa5');
define('LOGGED_IN_KEY', '|,x9<3!+6+s7%t~W&5f6G0(!t!8}0DnYRNMIr<d|ua; 6cY&(/I{lgfS&5H8o|y`');
define('NONCE_KEY', 'X-k|(JZtCZs@tK_>a5>mr$m#u;~b24JDAsk)pZl$8,t~Q.D?SCfM23k,hI`G-JDq');
define('AUTH_SALT', 'u^h)L}.AMUz;y?1+CQVA?.OBKhD!IRT6hZ){{*z)~1^3yU2hVeX*1_!i+7Lu^f25');
define('SECURE_AUTH_SALT', 'VcDfQpEs$)Qb^-d|EUnIm5T43@@UXJ}I&wG%}#@:pU&<&0q>dbo<qL!JF2.50=G0');
define('LOGGED_IN_SALT', 'wim/Y#tiw|L%?|Rr=^rNf f{+yg9#5tR>%/CLm2Q(6&k)VQ1D9Ee)NN2*q,C>mP_');
define('NONCE_SALT', 'x(BX&91<XV*Qo]j|I$y)yU)8ykWp7ubdv[5<ri|B.>XCG7a!fA3VCH]eL0yp5@~k');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'or_';

define( 'CONCATENATE_SCRIPTS', false );


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');
