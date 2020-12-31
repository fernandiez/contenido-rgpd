<?php

/*
 * Plugin Name:       Contenido RGPD
 * Plugin URI:        https://github.com/fernandiez/contenido-rgpd
 * Description:       Contenido RGPD creates RGPD / GDPR legal pages from your own previously added information
 * Version:           1.0.3
 * Author:            Fernan Díez
 * Author URI:        https://www.fernan.com.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       contenido-rgpd
 * Domain Path:       /languages
 */

// Creates Contenido RGPD options page and custom fields

class ContenidoRGPD {
	private $contenido_rgpd_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'contenido_rgpd_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'contenido_rgpd_page_init' ) );
	}

	public function contenido_rgpd_add_plugin_page() {
		add_menu_page(
			'Contenido RGPD', // page_title
			'Contenido RGPD', // menu_title
			'manage_options', // capability
			'contenido-rgpd', // menu_slug
			array( $this, 'contenido_rgpd_create_admin_page' ), // function
			'dashicons-admin-page', // icon_url
			100 // position
		);
	}

	public function contenido_rgpd_create_admin_page() {
		$this->contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' ); ?>

		<div class="wrap">
			<h2>Contenido RGPD</h2>
			<p>Contenido RGPD</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'contenido_rgpd_option_group' );
					do_settings_sections( 'contenido-rgpd-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function contenido_rgpd_page_init() {
		register_setting(
			'contenido_rgpd_option_group', // option_group
			'contenido_rgpd_option_name', // option_name
			array( $this, 'contenido_rgpd_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'contenido_rgpd_setting_section', // id
			'Settings', // title
			array( $this, 'contenido_rgpd_section_info' ), // callback
			'contenido-rgpd-admin' // page
		);

		add_settings_field(
			'sitio_web_1', // id
			'Sitio Web', // title
			array( $this, 'sitio_web_1_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'nombre_comercial_2', // id
			'Nombre Comercial', // title
			array( $this, 'nombre_comercial_2_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'nombre_empresa_3', // id
			'Nombre Empresa', // title
			array( $this, 'nombre_empresa_3_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'cif_4', // id
			'CIF', // title
			array( $this, 'cif_4_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'registro_mercantil_5', // id
			'Registro Mercantil', // title
			array( $this, 'registro_mercantil_5_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'datos_registrales_6', // id
			'Datos Registrales', // title
			array( $this, 'datos_registrales_6_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'nombre_titular_7', // id
			'Nombre Titular', // title
			array( $this, 'nombre_titular_7_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'direccion_8', // id
			'Dirección', // title
			array( $this, 'direccion_8_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'telefono_9', // id
			'Teléfono', // title
			array( $this, 'telefono_9_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);

		add_settings_field(
			'email_10', // id
			'Email', // title
			array( $this, 'email_10_callback' ), // callback
			'contenido-rgpd-admin', // page
			'contenido_rgpd_setting_section' // section
		);
	}

	public function contenido_rgpd_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['sitio_web_1'] ) ) {
			$sanitary_values['sitio_web_1'] = sanitize_text_field( $input['sitio_web_1'] );
		}

		if ( isset( $input['nombre_comercial_2'] ) ) {
			$sanitary_values['nombre_comercial_2'] = sanitize_text_field( $input['nombre_comercial_2'] );
		}

		if ( isset( $input['nombre_empresa_3'] ) ) {
			$sanitary_values['nombre_empresa_3'] = sanitize_text_field( $input['nombre_empresa_3'] );
		}

		if ( isset( $input['cif_4'] ) ) {
			$sanitary_values['cif_4'] = sanitize_text_field( $input['cif_4'] );
		}

		if ( isset( $input['registro_mercantil_5'] ) ) {
			$sanitary_values['registro_mercantil_5'] = sanitize_text_field( $input['registro_mercantil_5'] );
		}

		if ( isset( $input['datos_registrales_6'] ) ) {
			$sanitary_values['datos_registrales_6'] = sanitize_text_field( $input['datos_registrales_6'] );
		}

		if ( isset( $input['nombre_titular_7'] ) ) {
			$sanitary_values['nombre_titular_7'] = sanitize_text_field( $input['nombre_titular_7'] );
		}

		if ( isset( $input['direccion_8'] ) ) {
			$sanitary_values['direccion_8'] = sanitize_text_field( $input['direccion_8'] );
		}

		if ( isset( $input['telefono_9'] ) ) {
			$sanitary_values['telefono_9'] = sanitize_text_field( $input['telefono_9'] );
		}

		if ( isset( $input['email_10'] ) ) {
			$sanitary_values['email_10'] = sanitize_text_field( $input['email_10'] );
		}

		return $sanitary_values;
	}

	public function contenido_rgpd_section_info() {
		
	}

	public function sitio_web_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[sitio_web_1]" id="sitio_web_1" value="%s">',
			isset( $this->contenido_rgpd_options['sitio_web_1'] ) ? esc_attr( $this->contenido_rgpd_options['sitio_web_1']) : ''
		);
	}

	public function nombre_comercial_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[nombre_comercial_2]" id="nombre_comercial_2" value="%s">',
			isset( $this->contenido_rgpd_options['nombre_comercial_2'] ) ? esc_attr( $this->contenido_rgpd_options['nombre_comercial_2']) : ''
		);
	}

	public function nombre_empresa_3_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[nombre_empresa_3]" id="nombre_empresa_3" value="%s">',
			isset( $this->contenido_rgpd_options['nombre_empresa_3'] ) ? esc_attr( $this->contenido_rgpd_options['nombre_empresa_3']) : ''
		);
	}

	public function cif_4_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[cif_4]" id="cif_4" value="%s">',
			isset( $this->contenido_rgpd_options['cif_4'] ) ? esc_attr( $this->contenido_rgpd_options['cif_4']) : ''
		);
	}

	public function registro_mercantil_5_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[registro_mercantil_5]" id="registro_mercantil_5" value="%s">',
			isset( $this->contenido_rgpd_options['registro_mercantil_5'] ) ? esc_attr( $this->contenido_rgpd_options['registro_mercantil_5']) : ''
		);
	}

	public function datos_registrales_6_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[datos_registrales_6]" id="datos_registrales_6" value="%s">',
			isset( $this->contenido_rgpd_options['datos_registrales_6'] ) ? esc_attr( $this->contenido_rgpd_options['datos_registrales_6']) : ''
		);
	}

	public function nombre_titular_7_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[nombre_titular_7]" id="nombre_titular_7" value="%s">',
			isset( $this->contenido_rgpd_options['nombre_titular_7'] ) ? esc_attr( $this->contenido_rgpd_options['nombre_titular_7']) : ''
		);
	}

	public function direccion_8_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[direccion_8]" id="direccion_8" value="%s">',
			isset( $this->contenido_rgpd_options['direccion_8'] ) ? esc_attr( $this->contenido_rgpd_options['direccion_8']) : ''
		);
	}

	public function telefono_9_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[telefono_9]" id="telefono_9" value="%s">',
			isset( $this->contenido_rgpd_options['telefono_9'] ) ? esc_attr( $this->contenido_rgpd_options['telefono_9']) : ''
		);
	}

	public function email_10_callback() {
		printf(
			'<input class="regular-text" type="text" name="contenido_rgpd_option_name[email_10]" id="email_10" value="%s">',
			isset( $this->contenido_rgpd_options['email_10'] ) ? esc_attr( $this->contenido_rgpd_options['email_10']) : ''
		);
	}

}
if ( is_admin() )
	$contenido_rgpd = new ContenidoRGPD();

/* 
 * $contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' ); // Array of All Options
 * $sitio_web_1 = $contenido_rgpd_options['sitio_web_1']; // Sitio Web
 * $nombre_comercial_2 = $contenido_rgpd_options['nombre_comercial_2']; // Nombre Comercial
 * $nombre_empresa_3 = $contenido_rgpd_options['nombre_empresa_3']; // Nombre Empresa
 * $cif_4 = $contenido_rgpd_options['cif_4']; // CIF
 * $registro_mercantil_5 = $contenido_rgpd_options['registro_mercantil_5']; // Registro Mercantil
 * $datos_registrales_6 = $contenido_rgpd_options['datos_registrales_6']; // Datos Registrales
 * $nombre_titular_7 = $contenido_rgpd_options['nombre_titular_7']; // Nombre Titular
 * $direccion_8 = $contenido_rgpd_options['direccion_8']; // Dirección
 * $telefono_9 = $contenido_rgpd_options['telefono_9']; // Teléfono
 * $email_10 = $contenido_rgpd_options['email_10']; // Email
 */

// Creates Shortcodes

// Creates Shortcode rgpd_sitio_web
function shortcode_rgpd_sitio_web ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$sitio_web_1 = $contenido_rgpd_options['sitio_web_1'];
	return $sitio_web_1;
	
}
add_shortcode( 'rgpd_sitio_web', 'shortcode_rgpd_sitio_web' );

// Creates Shortcode rgpd_nombre_comercial
function shortcode_rgpd_nombre_comercial ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$nombre_comercial_2 = $contenido_rgpd_options['nombre_comercial_2'];
	return $nombre_comercial_2;
	
}
add_shortcode( 'rgpd_nombre_comercial', 'shortcode_rgpd_nombre_comercial' );

// Creates Shortcode rgpd_nombre_empresa
function shortcode_rgpd_nombre_empresa ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$nombre_empresa_3 = $contenido_rgpd_options['nombre_empresa_3'];
	return $nombre_empresa_3;
	
}
add_shortcode( 'rgpd_nombre_empresa', 'shortcode_rgpd_nombre_empresa' );

// Creates Shortcode rgpd_cif
function shortcode_rgpd_cif ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$cif_4 = $contenido_rgpd_options['cif_4'];
	return $cif_4;
	
}
add_shortcode( 'rgpd_cif', 'shortcode_rgpd_cif' );

// Creates Shortcode rgpd_registro_mercantil
function shortcode_rgpd_registro_mercantil ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$registro_mercantil_5 = $contenido_rgpd_options['registro_mercantil_5'];
	return $registro_mercantil_5;
	
}
add_shortcode( 'rgpd_registro_mercantil', 'shortcode_rgpd_registro_mercantil' );

// Creates Shortcode rgpd_datos_registrales
function shortcode_rgpd_datos_registrales ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$datos_registrales_6 = $contenido_rgpd_options['datos_registrales_6'];
	return $datos_registrales_6;
	
}
add_shortcode( 'rgpd_datos_registrales', 'shortcode_rgpd_datos_registrales' );

// Creates Shortcode rgpd_nombre_titular
function shortcode_rgpd_nombre_titular ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$nombre_titular_7 = $contenido_rgpd_options['nombre_titular_7'];
	return $nombre_titular_7;
	
}
add_shortcode( 'rgpd_nombre_titular', 'shortcode_rgpd_nombre_titular' );

// Creates Shortcode rgpd_direccion
function shortcode_rgpd_direccion ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$direccion_8 = $contenido_rgpd_options['direccion_8'];
	return $direccion_8;
	
}
add_shortcode( 'rgpd_direccion', 'shortcode_rgpd_direccion' );

// Creates Shortcode rgpd_telefono
function shortcode_rgpd_telefono ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$telefono_9 = $contenido_rgpd_options['telefono_9'];
	return $telefono_9;
	
}
add_shortcode( 'rgpd_telefono', 'shortcode_rgpd_telefono' );

// Creates Shortcode rgpd_email
function shortcode_rgpd_email ( $atts ) {
	$contenido_rgpd_options = get_option( 'contenido_rgpd_option_name' );
	$email_10 = $contenido_rgpd_options['email_10'];
	return $email_10;
	
}
add_shortcode( 'rgpd_email', 'shortcode_rgpd_email' );

// Creates RPGD pages

// Creates Aviso Legal RGPD page
 function create_rgpd_legal_page( $user_id ) {

    $post_data = array(
        'post_title' => 'Aviso Legal',
        'post_content' => 'AVISO LEGAL Y CONDICIONES GENERALES DE USO
[rgpd_sitio_web]
I. INFORMACIÓN GENERAL
En cumplimiento con el deber de información dispuesto en la Ley 34/2002 de Servicios de la Sociedad de la Información y el Comercio Electrónico (LSSI-CE) de 11 de julio, se facilitan a continuación los siguientes datos de información general de este sitio web:

La titularidad de este sitio web, [rgpd_sitio_web], (en adelante, Sitio Web) la ostenta: [rgpd_nombre_empresa], provista de NIF: [rgpd_cif] e inscrita en: [rgpd_registro_mercantil] con los siguientes datos registrales: [rgpd_datos_registrales], cuyo representante es: [rgpd_nombre_titular], y cuyos datos de contacto son:

Dirección: [rgpd_direccion]

Teléfono de contacto: [rgpd_telefono]

Email de contacto: [rgpd_email]

II. TÉRMINOS Y CONDICIONES GENERALES DE USO
El objeto de las condiciones: El Sitio Web
El objeto de las presentes Condiciones Generales de Uso (en adelante, Condiciones) es regular el acceso y la utilización del Sitio Web. A los efectos de las presentes Condiciones se entenderá como Sitio Web: la apariencia externa de los interfaces de pantalla, tanto de forma estática como de forma dinámica, es decir, el árbol de navegación; y todos los elementos integrados tanto en los interfaces de pantalla como en el árbol de navegación (en adelante, Contenidos) y todos aquellos servicios o recursos en línea que en su caso ofrezca a los Usuarios (en adelante, Servicios).

[rgpd_nombre_comercial] se reserva la facultad de modificar, en cualquier momento, y sin aviso previo, la presentación y configuración del Sitio Web y de los Contenidos y Servicios que en él pudieran estar incorporados. El Usuario reconoce y acepta que en cualquier momento [rgpd_nombre_comercial] pueda interrumpir, desactivar y/o cancelar cualquiera de estos elementos que se integran en el Sitio Web o el acceso a los mismos.

El acceso al Sitio Web por el Usuario tiene carácter libre y, por regla general, es gratuito sin que el Usuario tenga que proporcionar una contraprestación para poder disfrutar de ello, salvo en lo relativo al coste de conexión a través de la red de telecomunicaciones suministrada por el proveedor de acceso que hubiere contratado el Usuario.

La utilización de alguno de los Contenidos o Servicios del Sitio Web podrá hacerse mediante la suscripción o registro previo del Usuario.

El Usuario
El acceso, la navegación y uso del Sitio Web, así como por los espacios habilitados para interactuar entre los Usuarios, y el Usuario y [rgpd_nombre_comercial], como los comentarios y/o espacios de blogging, confiere la condición de Usuario, por lo que se aceptan, desde que se inicia la navegación por el Sitio Web, todas las Condiciones aquí establecidas, así como sus ulteriores modificaciones, sin perjuicio de la aplicación de la correspondiente normativa legal de obligado cumplimiento según el caso. Dada la relevancia de lo anterior, se recomienda al Usuario leerlas cada vez que visite el Sitio Web.

El Sitio Web de [rgpd_nombre_comercial] proporciona gran diversidad de información, servicios y datos. El Usuario asume su responsabilidad para realizar un uso correcto del Sitio Web. Esta responsabilidad se extenderá a:

Un uso de la información, Contenidos y/o Servicios y datos ofrecidos por [rgpd_nombre_comercial] sin que sea contrario a lo dispuesto por las presentes Condiciones, la Ley, la moral o el orden público, o que de cualquier otro modo puedan suponer lesión de los derechos de terceros o del mismo funcionamiento del Sitio Web.
La veracidad y licitud de las informaciones aportadas por el Usuario en los formularios extendidos por [rgpd_nombre_comercial] para el acceso a ciertos Contenidos o Servicios ofrecidos por el Sitio Web. En todo caso, el Usuario notificará de forma inmediata a [rgpd_nombre_comercial] acerca de cualquier hecho que permita el uso indebido de la información registrada en dichos formularios, tales como, pero no sólo, el robo, extravío, o el acceso no autorizado a identificadores y/o contraseñas, con el fin de proceder a su inmediata cancelación.
[rgpd_nombre_comercial] se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren la ley, el respeto a la dignidad de la persona, que sean discriminatorios, xenófobos, racistas, pornográficos, spamming, que atenten contra la juventud o la infancia, el orden o la seguridad pública o que, a su juicio, no resultaran adecuados para su publicación.

En cualquier caso, [rgpd_nombre_comercial] no será responsable de las opiniones vertidas por los Usuarios a través de comentarios u otras herramientas de blogging o de participación que pueda haber.

El mero acceso a este Sitio Web no supone entablar ningún tipo de relación de carácter comercial entre [rgpd_nombre_comercial] y el Usuario.

El Usuario declara ser mayor de edad y disponer de la capacidad jurídica suficiente para vincularse por las presentes Condiciones. Por lo tanto, este Sitio Web de [rgpd_nombre_comercial] no se dirige a menores de edad. [rgpd_nombre_comercial] declina cualquier responsabilidad por el incumplimiento de este requisito.

El Sitio Web está dirigido principalmente a Usuarios residentes en España. [rgpd_nombre_comercial] no asegura que el Sitio Web cumpla con legislaciones de otros países, ya sea total o parcialmente. Si el Usuario reside o tiene su domiciliado en otro lugar y decide acceder y/o navegar en el Sitio Web lo hará bajo su propia responsabilidad, deberá asegurarse de que tal acceso y navegación cumple con la legislación local que le es aplicable, no asumiendo [rgpd_nombre_comercial] responsabilidad alguna que se pueda derivar de dicho acceso.

III. ACCESO Y NAVEGACIÓN EN EL SITIO WEB: EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD
[rgpd_nombre_comercial] no garantiza la continuidad, disponibilidad y utilidad del Sitio Web, ni de los Contenidos o Servicios. [rgpd_nombre_comercial] hará todo lo posible por el buen funcionamiento del Sitio Web, sin embargo, no se responsabiliza ni garantiza que el acceso a este Sitio Web no vaya a ser ininterrumpido o que esté libre de error.

Tampoco se responsabiliza o garantiza que el contenido o software al que pueda accederse a través de este Sitio Web, esté libre de error o cause un daño al sistema informático (software y hardware) del Usuario. En ningún caso [rgpd_nombre_comercial] será responsable por las pérdidas, daños o perjuicios de cualquier tipo que surjan por el acceso, navegación y el uso del Sitio Web, incluyéndose, pero no limitándose, a los ocasionados a los sistemas informáticos o los provocados por la introducción de virus.

[rgpd_nombre_comercial] tampoco se hace responsable de los daños que pudiesen ocasionarse a los usuarios por un uso inadecuado de este Sitio Web. En particular, no se hace responsable en modo alguno de las caídas, interrupciones, falta o defecto de las telecomunicaciones que pudieran ocurrir.

IV. POLÍTICA DE ENLACES
Se informa que el Sitio Web de [rgpd_nombre_comercial] pone o puede poner a disposición de los Usuarios medios de enlace (como, entre otros, links, banners, botones), directorios y motores de búsqueda que permiten a los Usuarios acceder a sitios web pertenecientes y/o gestionados por terceros.

La instalación de estos enlaces, directorios y motores de búsqueda en el Sitio Web tiene por objeto facilitar a los Usuarios la búsqueda de y acceso a la información disponible en Internet, sin que pueda considerarse una sugerencia, recomendación o invitación para la visita de los mismos.

[rgpd_nombre_comercial] no ofrece ni comercializa por sí ni por medio de terceros los productos y/o servicios disponibles en dichos sitios enlazados.

Asimismo, tampoco garantizará la disponibilidad técnica, exactitud, veracidad, validez o legalidad de sitios ajenos a su propiedad a los que se pueda acceder por medio de los enlaces.

[rgpd_nombre_comercial] en ningún caso revisará o controlará el contenido de otros sitios web, así como tampoco aprueba, examina ni hace propios los productos y servicios, contenidos, archivos y cualquier otro material existente en los referidos sitios enlazados.

[rgpd_nombre_comercial] no asume ninguna responsabilidad por los daños y perjuicios que pudieran producirse por el acceso, uso, calidad o licitud de los contenidos, comunicaciones, opiniones, productos y servicios de los sitios web no gestionados por [rgpd_nombre_comercial] y que sean enlazados en este Sitio Web.

El Usuario o tercero que realice un hipervínculo desde una página web de otro, distinto, sitio web al Sitio Web de [rgpd_nombre_comercial] deberá saber que:

No se permite la reproducción —total o parcialmente— de ninguno de los Contenidos y/o Servicios del Sitio Web sin autorización expresa de [rgpd_nombre_comercial].

No se permite tampoco ninguna manifestación falsa, inexacta o incorrecta sobre el Sitio Web de [rgpd_nombre_comercial], ni sobre los Contenidos y/o Servicios del mismo.

A excepción del hipervínculo, el sitio web en el que se establezca dicho hiperenlace no contendrá ningún elemento, de este Sitio Web, protegido como propiedad intelectual por el ordenamiento jurídico español, salvo autorización expresa de [rgpd_nombre_comercial].

El establecimiento del hipervínculo no implicará la existencia de relaciones entre [rgpd_nombre_comercial] y el titular del sitio web desde el cual se realice, ni el conocimiento y aceptación de [rgpd_nombre_comercial] de los contenidos, servicios y/o actividades ofrecidos en dicho sitio web, y viceversa.

V. PROPIEDAD INTELECTUAL E INDUSTRIAL
[rgpd_nombre_comercial] por sí o como parte cesionaria, es titular de todos los derechos de propiedad intelectual e industrial del Sitio Web, así como de los elementos contenidos en el mismo (a título enunciativo y no exhaustivo, imágenes, sonido, audio, vídeo, software o textos, marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.). Serán, por consiguiente, obras protegidas como propiedad intelectual por el ordenamiento jurídico español, siéndoles aplicables tanto la normativa española y comunitaria en este campo, como los tratados internacionales relativos a la materia y suscritos por España.

Todos los derechos reservados. En virtud de lo dispuesto en la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de [rgpd_nombre_comercial].

El Usuario se compromete a respetar los derechos de propiedad intelectual e industrial de [rgpd_nombre_comercial]. Podrá visualizar los elementos del Sitio Web o incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte físico siempre y cuando sea, exclusivamente, para su uso personal. El Usuario, sin embargo, no podrá suprimir, alterar, o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en el Sitio Web.

En caso de que el Usuario o tercero considere que cualquiera de los Contenidos del Sitio Web suponga una violación de los derechos de protección de la propiedad intelectual, deberá comunicarlo inmediatamente a [rgpd_nombre_comercial] a través de los datos de contacto del apartado de INFORMACIÓN GENERAL de este Aviso Legal y Condiciones Generales de Uso.

VI. ACCIONES LEGALES, LEGISLACIÓN APLICABLE Y JURISDICCIÓN
[rgpd_nombre_comercial] se reserva la facultad de presentar las acciones civiles o penales que considere necesarias por la utilización indebida del Sitio Web y Contenidos, o por el incumplimiento de las presentes Condiciones.

La relación entre el Usuario y [rgpd_nombre_comercial] se regirá por la normativa vigente y de aplicación en el territorio español. De surgir cualquier controversia en relación con la interpretación y/o a la aplicación de estas Condiciones las partes someterán sus conflictos a la jurisdicción ordinaria sometiéndose a los jueces y tribunales que correspondan conforme a derecho.',
        'post_status' => 'publish', // Automatically publish the post.
        'post_author' => $user_id,
        'post_name' => 'aviso-legal',
        // 'post_category' => array( 1, 3 ) // Add it two categories.
        'post_type' => 'page' // defaults to "post". Can be set to CPTs.
    );

    // Lets insert the post now.
    wp_insert_post( $post_data );

}
add_action( 'activated_plugin', 'create_rgpd_legal_page' );

// Creates Política de Privacidad RGPD page

 function create_rgpd_privacidad_page( $user_id ) {

    $post_data = array(
        'post_title' => 'Política de Privacidad',
        'post_content' => 'POLÍTICA DE PRIVACIDAD DEL SITIO WEB
[rgpd_sitio_web]
I. POLÍTICA DE PRIVACIDAD Y PROTECCIÓN DE DATOS
Respetando lo establecido en la legislación vigente, [rgpd_nombre_comercial] (en adelante, también Sitio Web) se compromete a adoptar las medidas técnicas y organizativas necesarias, según el nivel de seguridad adecuado al riesgo de los datos recogidos.

Leyes que incorpora esta política de privacidad
Esta política de privacidad está adaptada a la normativa española y europea vigente en materia de protección de datos personales en internet. En concreto, la misma respeta las siguientes normas:

El Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (RGPD).
La Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales (LOPD-GDD).
El Real Decreto 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (RDLOPD).
La Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI-CE).
Identidad del responsable del tratamiento de los datos personales
El responsable del tratamiento de los datos personales recogidos en [rgpd_nombre_comercial] es: [rgpd_nombre_empresa], provista de NIF: [rgpd_cif] e inscrito en: [rgpd_registro_mercantil] con los siguientes datos registrales: [rgpd_datos_registrales], cuyo representante es: [rgpd_nombre_titular] (en adelante, Responsable del tratamiento). Sus datos de contacto son los siguientes:

Dirección: [rgpd_direccion]

Teléfono de contacto: [rgpd_telefono]

Email de contacto: [rgpd_email]

Registro de Datos de Carácter Personal
En cumplimiento de lo establecido en el RGPD y la LOPD-GDD, le informamos que los datos personales recabados por [rgpd_nombre_comercial], mediante los formularios extendidos en sus páginas quedarán incorporados y serán tratados en nuestro fichero con el fin de poder facilitar, agilizar y cumplir los compromisos establecidos entre [rgpd_nombre_comercial] y el Usuario o el mantenimiento de la relación que se establezca en los formularios que este rellene, o para atender una solicitud o consulta del mismo. Asimismo, de conformidad con lo previsto en el RGPD y la LOPD-GDD, salvo que sea de aplicación la excepción prevista en el artículo 30.5 del RGPD, se mantine un registro de actividades de tratamiento que especifica, según sus finalidades, las actividades de tratamiento llevadas a cabo y las demás circunstancias establecidas en el RGPD.

Principios aplicables al tratamiento de los datos personales
El tratamiento de los datos personales del Usuario se someterá a los siguientes principios recogidos en el artículo 5 del RGPD y en el artículo 4 y siguientes de la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales:

Principio de licitud, lealtad y transparencia: se requerirá en todo momento el consentimiento del Usuario previa información completamente transparente de los fines para los cuales se recogen los datos personales.
Principio de limitación de la finalidad: los datos personales serán recogidos con fines determinados, explícitos y legítimos.
Principio de minimización de datos: los datos personales recogidos serán únicamente los estrictamente necesarios en relación con los fines para los que son tratados.
Principio de exactitud: los datos personales deben ser exactos y estar siempre actualizados.
Principio de limitación del plazo de conservación: los datos personales solo serán mantenidos de forma que se permita la identificación del Usuario durante el tiempo necesario para los fines de su tratamiento.
Principio de integridad y confidencialidad: los datos personales serán tratados de manera que se garantice su seguridad y confidencialidad.
Principio de responsabilidad proactiva: el Responsable del tratamiento será responsable de asegurar que los principios anteriores se cumplen.
Categorías de datos personales
Las categorías de datos que se tratan en [rgpd_nombre_comercial] son únicamente datos identificativos. En ningún caso, se tratan categorías especiales de datos personales en el sentido del artículo 9 del RGPD.

Base legal para el tratamiento de los datos personales
La base legal para el tratamiento de los datos personales es el consentimiento. [rgpd_nombre_comercial] se compromete a recabar el consentimiento expreso y verificable del Usuario para el tratamiento de sus datos personales para uno o varios fines específicos.

El Usuario tendrá derecho a retirar su consentimiento en cualquier momento. Será tan fácil retirar el consentimiento como darlo. Como regla general, la retirada del consentimiento no condicionará el uso del Sitio Web.

En las ocasiones en las que el Usuario deba o pueda facilitar sus datos a través de formularios para realizar consultas, solicitar información o por motivos relacionados con el contenido del Sitio Web, se le informará en caso de que la cumplimentación de alguno de ellos sea obligatoria debido a que los mismos sean imprescindibles para el correcto desarrollo de la operación realizada.

Fines del tratamiento a que se destinan los datos personales
Los datos personales son recabados y gestionados por [rgpd_nombre_comercial] con la finalidad de poder facilitar, agilizar y cumplir los compromisos establecidos entre el Sitio Web y el Usuario o el mantenimiento de la relación que se establezca en los formularios que este último rellene o para atender una solicitud o consulta.

Igualmente, los datos podrán ser utilizados con una finalidad comercial de personalización, operativa y estadística, y actividades propias del objeto social de [rgpd_nombre_comercial], así como para la extracción, almacenamiento de datos y estudios de marketing para adecuar el Contenido ofertado al Usuario, así como mejorar la calidad, funcionamiento y navegación por el Sitio Web.

En el momento en que se obtengan los datos personales, se informará al Usuario acerca del fin o fines específicos del tratamiento a que se destinarán los datos personales; es decir, del uso o usos que se dará a la información recopilada.

Períodos de retención de los datos personales
Los datos personales solo serán retenidos durante el tiempo mínimo necesario para los fines de su tratamiento y, en todo caso, únicamente durante el siguiente plazo: indefinidamente, o hasta que el Usuario solicite su supresión.

En el momento en que se obtengan los datos personales, se informará al Usuario acerca del plazo durante el cual se conservarán los datos personales o, cuando eso no sea posible, los criterios utilizados para determinar este plazo.

Destinatarios de los datos personales
Los datos personales del Usuario no serán compartidos con terceros.

En cualquier caso, en el momento en que se obtengan los datos personales, se informará al Usuario acerca de los destinatarios o las categorías de destinatarios de los datos personales.

Datos personales de menores de edad
Respetando lo establecido en los artículos 8 del RGPD y 7 de la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales, solo los mayores de 14 años podrán otorgar su consentimiento para el tratamiento de sus datos personales de forma lícita por [rgpd_nombre_comercial]. Si se trata de un menor de 14 años, será necesario el consentimiento de los padres o tutores para el tratamiento, y este solo se considerará lícito en la medida en la que los mismos lo hayan autorizado.

Secreto y seguridad de los datos personales
[rgpd_nombre_comercial] se compromete a adoptar las medidas técnicas y organizativas necesarias, según el nivel de seguridad adecuado al riesgo de los datos recogidos, de forma que se garantice la seguridad de los datos de carácter personal y se evite la destrucción, pérdida o alteración accidental o ilícita de datos personales transmitidos, conservados o tratados de otra forma, o la comunicación o acceso no autorizados a dichos datos.

El Sitio Web cuenta con un certificado SSL (Secure Socket Layer), que asegura que los datos personales se transmiten de forma segura y confidencial, al ser la transmisión de los datos entre el servidor y el Usuario, y en retroalimentación, totalmente cifrada o encriptada.

Sin embargo, debido a que [rgpd_nombre_comercial] no puede garantizar la inexpugabilidad de internet ni la ausencia total de hackers u otros que accedan de modo fraudulento a los datos personales, el Responsable del tratamiento se compromete a comunicar al Usuario sin dilación indebida cuando ocurra una violación de la seguridad de los datos personales que sea probable que entrañe un alto riesgo para los derechos y libertades de las personas físicas. Siguiendo lo establecido en el artículo 4 del RGPD, se entiende por violación de la seguridad de los datos personales toda violación de la seguridad que ocasione la destrucción, pérdida o alteración accidental o ilícita de datos personales transmitidos, conservados o tratados de otra forma, o la comunicación o acceso no autorizados a dichos datos.

Los datos personales serán tratados como confidenciales por el Responsable del tratamiento, quien se compromete a informar de y a garantizar por medio de una obligación legal o contractual que dicha confidencialidad sea respetada por sus empleados, asociados, y toda persona a la cual le haga accesible la información.

Derechos derivados del tratamiento de los datos personales
El Usuario tiene sobre [rgpd_nombre_comercial] y podrá, por tanto, ejercer frente al Responsable del tratamiento los siguientes derechos reconocidos en el RGPD y la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales:

Derecho de acceso: Es el derecho del Usuario a obtener confirmación de si [rgpd_nombre_comercial] está tratando o no sus datos personales y, en caso afirmativo, obtener información sobre sus datos concretos de carácter personal y del tratamiento que [rgpd_nombre_comercial] haya realizado o realice, así como, entre otra, de la información disponible sobre el origen de dichos datos y los destinatarios de las comunicaciones realizadas o previstas de los mismos.
Derecho de rectificación: Es el derecho del Usuario a que se modifiquen sus datos personales que resulten ser inexactos o, teniendo en cuenta los fines del tratamiento, incompletos.
Derecho de supresión ("el derecho al olvido"): Es el derecho del Usuario, siempre que la legislación vigente no establezca lo contrario, a obtener la supresión de sus datos personales cuando estos ya no sean necesarios para los fines para los cuales fueron recogidos o tratados; el Usuario haya retirado su consentimiento al tratamiento y este no cuente con otra base legal; el Usuario se oponga al tratamiento y no exista otro motivo legítimo para continuar con el mismo; los datos personales hayan sido tratados ilícitamentemente; los datos personales deban suprimirse en cumplimiento de una obligación legal; o los datos personales hayan sido obtenidos producto de una oferta directa de servicios de la sociedad de la información a un menor de 14 años. Además de suprimir los datos, el Responsable del tratamiento, teniendo en cuenta la tecnología disponible y el coste de su aplicación, deberá adoptar medidas razonables para informar a los responsables que estén tratando los datos personales de la solicitud del interesado de supresión de cualquier enlace a esos datos personales.
Derecho a la limitación del tratamiento: Es el derecho del Usuario a limitar el tratamiento de sus datos personales. El Usuario tiene derecho a obtener la limitación del tratamiento cuando impugne la exactitud de sus datos personales; el tratamiento sea ilícito; el Responsable del tratamiento ya no necesite los datos personales, pero el Usuario lo necesite para hacer reclamaciones; y cuando el Usuario se haya opuesto al tratamiento.
Derecho a la portabilidad de los datos: En caso de que el tratamiento se efectúe por medios automatizados, el Usuario tendrá derecho a recibir del Responsable del tratamiento sus datos personales en un formato estructurado, de uso común y lectura mecánica, y a transmitirlos a otro responsable del tratamiento. Siempre que sea técnicamente posible, el Responsable del tratamiento transmitirá directamente los datos a ese otro responsable.
Derecho de oposición: Es el derecho del Usuario a que no se lleve a cabo el tratamiento de sus datos de carácter personal o se cese el tratamiento de los mismos por parte de [rgpd_nombre_comercial].
Derecho a no ser a no ser objeto de una decisión basada únicamente en el tratamiento automatizado, incluida la elaboración de perfiles: Es el derecho del Usuario a no ser objeto de una decisión individualizada basada únicamente en el tratamiento automatizado de sus datos personales, incluida la elaboración de perfiles, existente salvo que la legislación vigente establezca lo contrario.
Así pues, el Usuario podrá ejercitar sus derechos mediante comunicación escrita dirigida al Responsable del tratamiento con la referencia "RGPD-[rgpd_sitio_web]", especificando:

Nombre, apellidos del Usuario y copia del DNI. En los casos en que se admita la representación, será también necesaria la identificación por el mismo medio de la persona que representa al Usuario, así como el documento acreditativo de la representación. La fotocopia del DNI podrá ser sustituida, por cualquier otro medio válido en derecho que acredite la identidad.
Petición con los motivos específicos de la solicitud o información a la que se quiere acceder.
Domicilio a efecto de notificaciones.
Fecha y firma del solicitante.
Todo documento que acredite la petición que formula.
Esta solicitud y todo otro documento adjunto podrá enviarse a la siguiente dirección y/o correo electrónico:

Dirección postal: [rgpd_direccion]

Correo electrónico: [rgpd_email]

Enlaces a sitios web de terceros
El Sitio Web puede incluir hipervínculos o enlaces que permiten acceder a páginas web de terceros distintos de [rgpd_nombre_comercial], y que por tanto no son operados por [rgpd_nombre_comercial]. Los titulares de dichos sitios web dispondrán de sus propias políticas de protección de datos, siendo ellos mismos, en cada caso, responsables de sus propios ficheros y de sus propias prácticas de privacidad.

Reclamaciones ante la autoridad de control
En caso de que el Usuario considere que existe un problema o infracción de la normativa vigente en la forma en la que se están tratando sus datos personales, tendrá derecho a la tutela judicial efectiva y a presentar una reclamación ante una autoridad de control, en particular, en el Estado en el que tenga su residencia habitual, lugar de trabajo o lugar de la supuesta infracción. En el caso de España, la autoridad de control es la Agencia Española de Protección de Datos (http://www.agpd.es).

II. ACEPTACIÓN Y CAMBIOS EN ESTA POLÍTICA DE PRIVACIDAD
Es necesario que el Usuario haya leído y esté conforme con las condiciones sobre la protección de datos de carácter personal contenidas en esta Política de Privacidad, así como que acepte el tratamiento de sus datos personales para que el Responsable del tratamiento pueda proceder al mismo en la forma, durante los plazos y para las finalidades indicadas. El uso del Sitio Web implicará la aceptación de la Política de Privacidad del mismo.

[rgpd_nombre_comercial] se reserva el derecho a modificar su Política de Privacidad, de acuerdo a su propio criterio, o motivado por un cambio legislativo, jurisprudencial o doctrinal de la Agencia Española de Protección de Datos. Los cambios o actualizaciones de esta Política de Privacidad no serán notificados de forma explícita al Usuario. Se recomienda al Usuario consultar esta página de forma periódica para estar al tanto de los últimos cambios o actualizaciones.

Esta Política de Privacidad fue actualizada para adaptarse al Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (RGPD) y a la Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales.',
        'post_status' => 'publish', // Automatically publish the post.
        'post_author' => $user_id,
        'post_name' => 'politica-de-privacidad',
        // 'post_category' => array( 1, 3 ) // Add it two categories.
        'post_type' => 'page' // defaults to "post". Can be set to CPTs.
    );

    // Lets insert the post now.
    wp_insert_post( $post_data );

}
add_action( 'activated_plugin', 'create_rgpd_privacidad_page' );

// Creates Política de Cookies RGPD page

 function create_rgpd_cookies_page( $user_id ) {

    $post_data = array(
        'post_title' => 'Política de Cookies',
        'post_content' => 'POLÍTICA DE COOKIES
[rgpd_sitio_web]
El acceso a este Sitio Web puede implicar la utilización de cookies. Las cookies son pequeñas cantidades de información que se almacenan en el navegador utilizado por cada Usuario —en los distintos dispositivos que pueda utilizar para navegar— para que el servidor recuerde cierta información que posteriormente y únicamente el servidor que la implementó leerá. Las cookies facilitan la navegación, la hacen más amigable, y no dañan el dispositivo de navegación.

Las cookies son procedimientos automáticos de recogida de información relativa a las preferencias determinadas por el Usuario durante su visita al Sitio Web con el fin de reconocerlo como Usuario, y personalizar su experiencia y el uso del Sitio Web, y pueden también, por ejemplo, ayudar a identificar y resolver errores.

La información recabada a través de las cookies puede incluir la fecha y hora de visitas al Sitio Web, las páginas visionadas, el tiempo que ha estado en el Sitio Web y los sitios visitados justo antes y después del mismo. Sin embargo, ninguna cookie permite que esta misma pueda contactarse con el número de teléfono del Usuario o con cualquier otro medio de contacto personal. Ninguna cookie puede extraer información del disco duro del Usuario o robar información personal. La única manera de que la información privada del Usuario forme parte del archivo Cookie es que el usuario dé personalmente esa información al servidor.

Las cookies que permiten identificar a una persona se consideran datos personales. Por tanto, a las mismas les será de aplicación la Política de Privacidad anteriormente descrita. En este sentido, para la utilización de las mismas será necesario el consentimiento del Usuario. Este consentimiento será comunicado, en base a una elección auténtica, ofrecido mediante una decisión afirmativa y positiva, antes del tratamiento inicial, removible y documentado.

Cookies propias
Son aquellas cookies que son enviadas al ordenador o dispositivo del Usuario y gestionadas exclusivamente por [rgpd_nombre_comercial] para el mejor funcionamiento del Sitio Web. La información que se recaba se emplea para mejorar la calidad del Sitio Web y su Contenido y su experiencia como Usuario. Estas cookies permiten reconocer al Usuario como visitante recurrente del Sitio Web y adaptar el contenido para ofrecerle contenidos que se ajusten a sus preferencias.

Cookies de terceros
Son cookies utilizadas y gestionadas por entidades externas que proporcionan a [rgpd_nombre_comercial] servicios solicitados por este mismo para mejorar el Sitio Web y la experiencia del usuario al navegar en el Sitio Web. Los principales objetivos para los que se utilizan cookies de terceros son la obtención de estadísticas de accesos y analizar la información de la navegación, es decir, cómo interactúa el Usuario con el Sitio Web.

La información que se obtiene se refiere, por ejemplo, al número de páginas visitadas, el idioma, el lugar a la que la dirección IP desde el que accede el Usuario, el número de Usuarios que acceden, la frecuencia y reincidencia de las visitas, el tiempo de visita, el navegador que usan, el operador o tipo de dipositivo desde el que se realiza la visita. Esta información se utiliza para mejorar el Sitio Web, y detectar nuevas necesidades para ofrecer a los Usuarios un Contenido y/o servicio de óptima calidad. En todo caso, la información se recopila de forma anónima y se elaboran informes de tendencias del Sitio Web sin identificar a usuarios individuales.

Puede obtener más información sobre las cookies, la información sobre la privacidad, o consultar la descripción del tipo de cookies que se utiliza, sus principales características, periodo de expiración, etc. en el siguiente(s) enlace(s):

Google Analytics: https://developers.google.com/analytics/; Facebook: https://www.facebook.com/policies/cookies;

La(s) entidad(es) encargada(s) del suministro de cookies podrá(n) ceder esta información a terceros, siempre y cuando lo exija la ley o sea un tercero el que procese esta información para dichas entidades.

Cookies de redes sociales
[rgpd_nombre_comercial] incorpora plugins de redes sociales, que permiten acceder a las mismas a partir del Sitio Web. Por esta razón, las cookies de redes sociales pueden almacenarse en el navegador del Usuario. Los titulares de dichas redes sociales disponen de sus propias políticas de protección de datos y de cookies, siendo ellos mismos, en cada caso, responsables de sus propios ficheros y de sus propias prácticas de privacidad. El Usuario debe referirse a las mismas para informarse acerca de dichas cookies y, en su caso, del tratamiento de sus datos personales. Únicamente a título informativo se indican a continuación los enlaces en los que se pueden consultar dichas políticas de privacidad y/o de cookies:

Facebook: https://www.facebook.com/policies/cookies/
Twitter: https://twitter.com/es/privacy
Instagram: https://help.instagram.com/1896641480634370?ref=ig
YouTube: https://policies.google.com/privacy?hl=es-419&gl=mx
Pinterest: https://policy.pinterest.com/es/privacy-policy
LinkedIn: https://www.linkedin.com/legal/cookie-policy?trk=hp-cookies
Deshabilitar, rechazar y eliminar cookies
El Usuario puede deshabilitar, rechazar y eliminar las cookies —total o parcialmente— instaladas en su dispositivo mediante la configuración de su navegador (entre los que se encuentran, por ejemplo, Chrome, Firefox, Safari, Explorer). En este sentido, los procedimientos para rechazar y eliminar las cookies pueden diferir de un navegador de Internet a otro. En consecuencia, el Usuario debe acudir a las instrucciones facilitadas por el propio navegador de Internet que esté utilizando. En el supuesto de que rechace el uso de cookies —total o parcialmente— podrá seguir usando el Sitio Web, si bien podrá tener limitada la utilización de algunas de las prestaciones del mismo.',
        'post_status' => 'publish', // Automatically publish the post.
        'post_author' => $user_id,
        'post_name' => 'politica-de-cookies',
        // 'post_category' => array( 1, 3 ) // Add it two categories.
        'post_type' => 'page' // defaults to "post". Can be set to CPTs. 
    );

    // Lets insert the post now.
    wp_insert_post( $post_data );

}
add_action( 'activated_plugin', 'create_rgpd_cookies_page' );
