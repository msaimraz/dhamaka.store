<?php  
$theme = wp_get_theme();
if( !empty( $theme['Template'] ) ){
	$theme = wp_get_theme($theme['Template']);
}
define('THEME_NAME', $theme['Name'] );
define('THEME_SLUG', $theme['Template'] );
define( 'DS', DIRECTORY_SEPARATOR );
define('IMPORT_PATH', dirname(__FILE__));
define('THEME_DIRECTORY', get_template_directory() );
define('ROAD_SITE_URI', site_url() );
define('API_SERVER', 'roadthemes.com' ); 
define('THEME_URI', get_template_directory_uri() );
class RoadthemeSetup {
	private $tgmpa;
	function __construct() {

		add_action('admin_menu', array($this,'addMyAdminMenu'));
		add_action( 'tgmpa_register', array($this,'wendy_register_required_plugins'));
		add_action('wp_ajax_installplugin', array($this,'installplugin_function'));
		add_action('wp_ajax_nopriv_installplugin', array($this,'installplugin_function'));
		$this->tgmpa = isset($GLOBALS['tgmpa']) ? $GLOBALS['tgmpa'] : TGM_Plugin_Activation::get_instance(); 
		
	}
	function installplugin_function ()  {
		$this->wendy_register_required_plugins();	

		$json = array();
		$tgmpa_url = $this->tgmpa->get_tgmpa_url();
		$plugins = $this->get_tgmpa_plugins();
		//echo"<pre>"; print_r($plugins ); echo "</pre>";
		$loading_url = get_template_directory_uri().'/road_importdata/images/loading.gif';
		$loading_url_success = get_template_directory_uri().'/road_importdata/images/true.png';
		
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['plugin_slug'] === $slug ) {
				$json = array(
					'url'           => $tgmpa_url,
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa->menu,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( ' Activating.....', 'wendy' ),
					'loading_url' => $loading_url
				);
				break;
			}
		}

		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['plugin_slug'] === $slug ) {
				$json = array(
					'url'           => $tgmpa_url,
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa->menu,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( ' Updating......', 'wendy' ),
					'loading_url' => $loading_url
				);
				break;
			}
		}

		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['plugin_slug'] === $slug ) {
				$json = array(
					'url'           => $tgmpa_url,
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa->menu,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( ' Installing ......','wendy'),
					'loading_url' => $loading_url
				);
				break;
			}
		}
		
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) );
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( ' Success', 'wendy' ),'loading_url' => $loading_url_success ) );
		}

		exit;
		
		
	}
	
	
	
	public function addMyAdminMenu() {
         
         add_menu_page(
            'Roadthemes Setup',
            'Roadthemes Setup',
            'manage_options',
            'roadtheme-setup',
            array(
                $this,
                'roadtheme_setup'
            ),
			get_template_directory_uri().'/road_importdata/icon.png',
            '75'
        );
    }
	
	function roadtheme_setup() {
		include get_template_directory().'/road_importdata/setup_layout.php';
	}
	function wendy_register_required_plugins() {
		$http_protocol ='http://';
		if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') { 
			$http_protocol = 'https://';
		}
		
		$plugins = array(
			array(
				'name'               => 'RoadThemes Helper',
				'slug'               => 'roadthemes-helper',
				'source'             => THEME_URI . '/plugins/roadthemes-helper.zip',
				'required'           => true,
				'version'            => '1.0.0',
				'force_activation'   => false,
				'force_deactivation' => false,
				'external_url'       => '',
			),
			array(
				'name'               => 'Mega Main Menu',
				'slug'               => 'mega_main_menu',
				'source'             => $http_protocol. API_SERVER . '/plugins/mega_main_menu.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => 'Revolution Slider',
				'slug'               => 'revslider',
				'source'             => $http_protocol. API_SERVER . '/plugins/revslider.zip',
				'required'           => true,
				'external_url'       => '',
			),
			array(
				'name'               => 'WPBakery Page Builder',
				'slug'               => 'js_composer',
				'source'             => $http_protocol. API_SERVER . '/plugins/js_composer.zip',
				'required'           => true,
				'external_url'       => '',
			),
		 
			// Plugins from the WordPress Plugin Repository.
			array(
				'name'               => 'Redux Framework',
				'slug'               => 'redux-framework',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => true,
			),
			array(
				'name'      => 'MailPoet Newsletters',
				'slug'      => 'wysija-newsletters',
				'required'  => true,
			),
			array(
				'name'      => 'Shortcodes Ultimate',
				'slug'      => 'shortcodes-ultimate',
				'required'  => true,
			),
			array(
				'name'      => 'Simple Local Avatars',
				'slug'      => 'simple-local-avatars',
				'required'  => false,
			),
			array(
				'name'      => 'TinyMCE Advanced',
				'slug'      => 'tinymce-advanced',
				'required'  => false,
			),
			array(
				'name'      => 'Widget Importer & Exporter',
				'slug'      => 'widget-importer-exporter',
				'required'  => true,
			),
			array(
				'name'      => 'WooCommerce',
				'slug'      => 'woocommerce',
				'required'  => true,
			),
			array(
				'name'      => 'YITH WooCommerce Compare',
				'slug'      => 'yith-woocommerce-compare',
				'required'  => true,
			),
			array(
				'name'      => 'YITH WooCommerce Wishlist',
				'slug'      => 'yith-woocommerce-wishlist',
				'required'  => true,
			),
			array(
				'name'      => 'YITH WooCommerce Zoom Magnifier',
				'slug'      => 'yith-woocommerce-zoom-magnifier',
				'required'  => true,
			),
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
				'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
				'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
				'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( $plugins, $config );

	}   
	 
	
	function get_tgmpa_plugins()
	{
		$plugins  = array(
			'all'      => array(), // Meaning: all plugins which still have open actions.
			'install'  => array(),
			'update'   => array(),
			'activate' => array(),
		);

		foreach ( $this->tgmpa->plugins as $slug => $plugin ) {
			if ( $this->tgmpa->is_plugin_active( $slug ) && false === $this->tgmpa->does_plugin_have_update( $slug ) ) {
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if ( !$this->tgmpa->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if ( false !== $this->tgmpa->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if ( $this->tgmpa->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}

		return $plugins;
	}
	
}
$road_setup = new RoadthemeSetup() ;