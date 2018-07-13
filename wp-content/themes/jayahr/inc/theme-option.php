<?php
if ( ! class_exists( 'jayahr_options' ) ) {
	class jayahr_options {
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		/* Load Redux Framework */
		public function __construct() {		 
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}

		}

		public function initSettings() {			
    		// Set the default arguments
			$this->setArguments();

		    // Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

		    // Create the sections and fields
			$this->setSections();

		    if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
		    	return;
		    }

		    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		//setup theme option
		public function setArguments() {
			$theme = wp_get_theme();
			$this->args = array(
				'opt_name'  => 'jayahr_option', 
				'display_name' => $theme->get( 'Name' ), 
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => __( 'Jay Ahr Options', 'jayahr' ),
				'page_title'         => __( 'Jay Ahr Options', 'jayahr' ),
				'dev_mode' => false,
				'customizer' => true,
				'menu_icon' => '',
				'hints'              => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
						),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
						),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
							),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
							),
						),
		        ) // end Hints
				);
		}

		//setup helper tab
		public function setHelpTabs() {
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'jayahr' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'jayahr' )
				);

			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'jayahr' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'jayahr' )
				);
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'jayahr' );
		}

		//setup area
		public function setSections() {			
	    	// Header Section
			$this->sections[] = array(
				'title'  => __( 'Header', 'jayahr' ),
				'desc'   => __( 'All of settings for header on this theme.', 'jayahr' ),
				'icon'   => 'el-icon-home',
				'fields' => array(					
					array(
						'id'       => 'logo-image',
						'type'     => 'media',
						'title'    => __( 'Logo image', 'jayahr' ),
						'desc'     => __( 'Image that you want to use as logo', 'jayahr' ),
					),
					array(
						'id'       => 'favicon',
						'type'     => 'media',
						'title'    => __( 'Favicon image', 'jayahr' ),
						'desc'     => __( 'Image that you want to use as favicon', 'jayahr' ),
					),
					array(
						'id'       => 'lang_name',
						'type'     => 'text',
						'title'    => __( 'global Name', 'jayahr' ),
						'desc'     => __( 'The name use to translate language', 'jayahr' ),
					)
				)
	    	); 	
	    	// Infor Section
			$this->sections[] = array(
				'title'  => __( 'Information', 'jayahr' ),
				'desc'   => __( 'All of settings for information on this theme.', 'jayahr' ),
				'icon'   => 'el-icon-home',
				'fields' => array(		
					array(
						'id'       => 'fax',
						'type'     => 'text',
						'title'    => __( 'Fax', 'jayahr' ),
						'desc'     => __( 'Fax company', 'jayahr' ),
					),array(
						'id'       => 'phone',
						'type'     => 'text',
						'title'    => __( 'Phone', 'jayahr' ),
						'desc'     => __( 'Phone company', 'jayahr' ),
					),			
					array(
						'id'       => 'address',
						'type'     => 'text',
						'title'    => __( 'Address', 'jayahr' ),
						'desc'     => __( 'Address company', 'jayahr' ),
					),					
					array(
						'id'       => 'email',
						'type'     => 'text',
						'title'    => __( 'Email', 'jayahr' ),
						'desc'     => __( 'Email company', 'jayahr' ),
					),
				)
	    	); 	
	    	//socail links
	    	$this->sections[] = array(
				'title'  => __( 'Socical Links', 'jayahr' ),
				'desc'   => __( '', 'jayahr' ),
				'icon'   => 'el-icon-share-alt',
				'fields' => array(					
					array(
						'id'       => 'facebook',
						'type'     => 'text',
						'title'    => __( 'Facebook', 'jayahr' ),
					),
                    array(
						'id'       => 'instagram',
						'type'     => 'text',
						'title'    => __( 'Instagram', 'jayahr' ),					
                    ),
                    array(
						'id'       => 'social-email',
						'type'     => 'text',
						'title'    => __( 'Email', 'jayahr' ),					
                    )
				)
	    	);
           
			//Footer
	    	$this->sections[] = array(
				'title'  => __( 'Footer', 'jayahr' ),
				'desc'   => __( '', 'jayahr' ),
				'icon'   => 'el-icon-website',
				'fields' => array(					
					array(
						'id'       => 'copyright',
						'type'     => 'textarea',
						'title'    => __( 'Copyright', 'jayahr' ),
						'hint'     => array(
		                    'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
		                )
					)
				)
	    	);

		}
	}
	global $reduxConfig;
	$reduxConfig = new jayahr_options();
}