<?php

# Here you can include the 'model' and 'view' files - not other controllers! All controllers are loaded automatically.

class _OWPST_jdvu__FrontSocialTabs {

	private $optionsPanelSlug;

	private $options = array(
		'main_settings' 	=> '',
		'social_links' 		=> ''
	);

	private function __construct( $params ) {
		global $_OWPST_jdvu__InitData;

		$this->optionsPanelSlug 			= $_OWPST_jdvu__InitData->plugin_short_slug . '_options';
		$this->options[ 'main_settings' ] 	= get_option( $this->optionsPanelSlug . '_main_settings' );
		$this->options[ 'social_links' ] 	= get_option( $this->optionsPanelSlug . '_social_links' );

		if ( isset( $this->options[ 'main_settings' ][ 'activity_status' ] ) && $this->options[ 'main_settings' ][ 'activity_status' ] == 'on' ) {

			if ( isset( $this->options[ 'social_links' ][ 'fb' ] ) || isset( $this->options[ 'social_links' ][ 'gp' ] ) || isset( $this->options[ 'social_links' ][ 'yt' ] ) ) {
				add_action( 'wp_enqueue_scripts', array( $this , 'enqueueSocialTabsScripts' ) );
				add_action( 'wp_enqueue_scripts', array( $this , 'enqueueSocialTabsStyles' ) );
			}
		}
	}

	public static function init( $params ) {
		return new _OWPST_jdvu__FrontSocialTabs( $params );
	}

	public function enqueueSocialTabsScripts() {
		wp_enqueue_script( 'opes-wp-social-tabs' , __OWPST_jdvu__THIS_PLUGIN__FRONT_URL_ . 'assets/js/script-front.js' , array( 'jquery' ) , '1.0.0' , false );

		$social_tabs_html = '<script src="https://apis.google.com/js/platform.js" async defer>{lang: \'pl\'}</script>';

		$social_tabs_html .= '<div class="opes-wp-social-tabs" id="opes-wp-social-tabs-1" style="position: fixed; top: 120px; right: 0px;">';
			
			$social_tabs_html .= '<div class="social-tabs-content" id="social-tabs-content-1" style="position: relative;">';
				$social_tabs_html .= '<ul class="social-tabs" id="social-tabs-1" style="position: absolute; list-style-type: none; left: -35px;">';
					if ( isset( $this->options[ 'social_links' ][ 'fb' ] ) ) {
						$social_tabs_html .= '<li id="fb"><img src="'.__OWPST_jdvu__THIS_PLUGIN__FRONT_URL_.'assets/images/fb-tab.png" style="width: 35px;"></li>';
					}
					if ( isset( $this->options[ 'social_links' ][ 'gp' ] ) ) {
						$social_tabs_html .= '<li id="gp"><img src="'.__OWPST_jdvu__THIS_PLUGIN__FRONT_URL_.'assets/images/gp-tab.png" style="width: 35px;"></li>';
					}
					if ( isset( $this->options[ 'social_links' ][ 'yt' ] ) ) {
						$social_tabs_html .= '<li id="yt"><img src="'.__OWPST_jdvu__THIS_PLUGIN__FRONT_URL_.'assets/images/yt-tab.png" style="width: 35px;"></li>';
					}
				$social_tabs_html .= '</ul>';

				$social_tabs_html .= '<ul class="social-sliders" id="social-sliders-1" style="position: absolute; left: 0px; list-style-type: none; width: 360px; /*height: 630px;*/ overflow: hidden;">';
					if ( isset( $this->options[ 'social_links' ][ 'fb' ] ) ) {

						$iframe = '<iframe src="https://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F'.$this->options[ 'social_links' ][ 'fb' ].'&amp;width=360&amp;connections=36&amp;stream=false&amp;header=true&amp;height=630" scrolling="no" frameborder="0" style="border: none; background: #fff; overflow: hidden; width: 360px; height: 630px;" allowtransparency="true"></iframe>';

						$social_tabs_html .= '<li id="fb-slide" style="display: none;">'.$iframe.'</li>';
					}
					if ( isset( $this->options[ 'social_links' ][ 'gp' ] ) ) {

						$iframe = '<div class="g-person" data-width="360" data-href="https://plus.google.com/'.$this->options[ 'social_links' ][ 'gp' ].'" data-rel="author"></div>';

						$social_tabs_html .= '<li id="gp-slide" style="display: none;">'.$iframe.'</li>';
					}
					if ( isset( $this->options[ 'social_links' ][ 'yt' ] ) ) {

						$iframe = '';

						$social_tabs_html .= '<li id="yt-slide" style="display: none;">'.$iframe.'</li>';
					}
				$social_tabs_html .= '</ul>';
			$social_tabs_html .= '</div>';

		$social_tabs_html .= '</div>';

		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';
		$social_tabs_html .= '';


		wp_localize_script( 'opes-wp-social-tabs' , 'social_tabs_html' , $social_tabs_html );
	}

	public function enqueueSocialTabsStyles() {
		wp_enqueue_style( 'opes-wp-social-tabs' , __OWPST_jdvu__THIS_PLUGIN__FRONT_URL_ . 'assets/css/style-front.css' , array() , '1.0.0' , 'all' );
	}
}

_OWPST_jdvu__FrontSocialTabs::init( $params ); 
