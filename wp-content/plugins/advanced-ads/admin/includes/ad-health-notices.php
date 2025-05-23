<?php
/**
 * Array with ad health messages
 *
 * Attribute: type
 * - "notice" (default, recommendation, etc.)
 * - "problem" (critical)
 *
 * attribute: can_hide
 * (user can see a button to hide this warning, default: true)
 *
 * attribute: hide
 * (how to handle click on "hide" button)
 * - true (default, hide the item)
 * - false (remove the item completely from list of notifications)
 *
 * attribute: timeout
 * (for how long to hide/ignore the message in seconds.)
 * - default: empty
 *
 * attribute: get_help_link
 * (enter URL, if exists, will add a link after the message)
 *
 * @package AdvancedAds
 * @author  Advanced Ads <info@wpadvancedads.com>
 * @since   1.x.x
 */

$advanced_ads_ad_health_notices = apply_filters(
	'advanced-ads-ad-health-notices',
	[
		// old PHP version
		// checked using Advanced_Ads_Checks::php_version_minimum().
		'old_php'                                       => [
			'text' => sprintf(
				/* translators: %1$s is a version number */
				__( 'Your <strong>PHP version (%1$s) is too low</strong>. Advanced Ads is built for PHP %2$s and higher. It might work, but updating PHP is highly recommended. Please ask your hosting provider for more information.', 'advanced-ads' ),
				phpversion(),
				Advanced_Ads_Checks::MINIMUM_PHP_VERSION
			),
			'type' => 'problem',
		],
		// conflicting plugins found
		// Advanced_Ads_Checks::conflicting_plugins().
		'conflicting_plugins'                           => [
			'text' => sprintf(
				/* translators: %1$s is a list of plugin names; %2$s is a target URL */
				__( 'Plugins that are known to cause (partial) problems: <strong>%1$s</strong>. <a href="%2$s" target="_blank">Learn more</a>.', 'advanced-ads' ),
				implode( ', ', Advanced_Ads_Checks::conflicting_plugins() ),
				'https://wpadvancedads.com/manual/known-plugin-conflicts/?utm_source=advanced-ads&utm_medium=link&utm_campaign=error-plugin-conflicts'
			),
			'type' => 'problem',
		],
		// PHP extensions missing
		// Advanced_Ads_Checks::php_extensions().
		'php_extensions_missing'                        => [
			'text' => sprintf(
				/* translators: %s is a list of PHP extensions */
				__( 'Missing PHP extensions could cause issues. Please ask your hosting provider to enable them: %s', 'advanced-ads' ),
				implode( ', ', Advanced_Ads_Checks::php_extensions() )
			),
			'type' => 'problem',
		],
		// ads are disabled
		// Advanced_Ads_Checks::ads_disabled().
		'ads_disabled'                                  => [
			'text' => sprintf(
				/* translators: %s is a target URL */
				__( 'Ads are disabled for all or some pages. See "disabled ads" in <a href="%s">settings</a>.', 'advanced-ads' ),
				admin_url( 'admin.php?page=advanced-ads-settings#top#general' )
			),
			'type' => 'problem',
		],
		// check if Advanced Ads related constants are enabled
		// Advanced_Ads_Checks::get_defined_constants().
		'constants_enabled'                             => [
			'text' => '<a href="' . admin_url( 'admin.php?page=advanced-ads-settings#top#support' ) . '">' . esc_html__( 'Advanced Ads related constants enabled', 'advanced-ads' ) . '</a>',
			'type' => 'notice',
		],
		// adblocker assets expired
		// Advanced_Ads_Checks::assets_expired().
		'assets_expired'                                => [
			'text' => sprintf(
				/* translators: %s is a target URL */
				__( 'Some assets were changed. Please <strong>rebuild the asset folder</strong> in the <a href="%s">Advanced Ads settings</a> to update the ad blocker disguise.', 'advanced-ads' ),
				admin_url( 'admin.php?page=advanced-ads-settings' )
			),
			'type' => 'problem',
			'hide' => true,
		],
		// missing license codes
		// Advanced_Ads_Checks::license_invalid().
		'license_invalid'                               => [
			'text'    => __( 'One or more license keys for <strong>Advanced Ads add-ons are invalid or missing</strong>.', 'advanced-ads' ) . ' '
				. sprintf(
					/* translators: %s is a target URL. */
					__( 'Please add valid license keys <a href="%s">here</a>.', 'advanced-ads' ),
					get_admin_url( null, 'admin.php?page=advanced-ads-settings#top#licenses' )
				),
			'type'    => 'problem',
			'hide'    => false,
			'timeout' => WEEK_IN_SECONDS,
		],
		// an individual ad expired.
		'ad_expired'                                    => [
			'text' => __( 'Ad expired', 'advanced-ads' ) . ': ',
			'type' => 'notice',
			'hide' => false,
		],
		// a visible ad is used in <head> tags
		// is checked in the frontend by Ad Health in Advanced_Ads_Frontend_Checks::can_use_head_placement().
		'ad_with_output_in_head'                        => [
			// we keep the %s here and replace it with an empty string, because we use it somewhere else and don’t want to create a new string that is basically the same.
			'text'          => sprintf(
				/* translators: %s is empty here, but the string will be followed by a name of an ad unit. */
				__( 'Visible ads should not use the Header placement: %s', 'advanced-ads' ),
				''
			),
			'type'          => 'notice',
			'hide'          => false,
			'get_help_link' => 'https://wpadvancedads.com/manual/ad-health/?utm_source=advanced-ads&utm_medium=link&utm_campaign=error-visible-ad-in-header#header-ads',
			'timeout'       => YEAR_IN_SECONDS,
		],
		// Ad has HTTP, but site uses HTTPS
		// check in Ad Health in frontend.
		'ad_has_http'                                   => [
			'text'          => __( 'Your website is using HTTPS, but the ad code contains HTTP and might not work.', 'advanced-ads' ),
			'type'          => 'notice',
			'hide'          => false,
			'get_help_link' => 'https://wpadvancedads.com/manual/ad-health/?utm_source=advanced-ads&utm_medium=link&utm_campaign=error-https-ads#https-ads',
		],
		// dummy text for general AdSense issue.
		'adsense_issue'                                 => [
			// we keep the %s here and replace it with an empty string, because we use it somewhere else and don’t want to create a new string that is basically the same.
			'text' => __( 'AdSense issue', 'advanced-ads' ),
			'type' => 'problem',
		],
		// AdSense connection error: disapproved account.
		'adsense_connect_disapprovedAccount'            => [
			'text' => __( 'Last AdSense account connection attempt failed.', 'advanced-ads' ) . '&nbsp;' . __( 'Your account was not approved by AdSense.', 'advanced-ads' ) . ' ' . Advanced_Ads_Ad_Health_Notices::get_adsense_error_link( 'disapprovedAccount' ),
			'type' => 'problem',
			'hide' => false,
		],
		// AdSense connection error: no adsense account.
		'adsense_connect_noAdSenseAccount'              => [
			'text' => sprintf(
				__( 'Last AdSense account connection attempt failed.', 'advanced-ads' ) . '&nbsp;' .
				/* translators: %1$s is the opening a tag and %2$s the closing one. */
				__( 'Create a new AdSense account %1$shere%2$s.', 'advanced-ads' ) . ' ' . Advanced_Ads_Ad_Health_Notices::get_adsense_error_link( 'noAdSenseAccount' ),
				'<a href="https://www.google.com/adsense/start/?utm_source=AdvancedAdsPlugIn&utm_medium=partnerships&utm_campaign=AdvancedAdsPartner1" target="_blank">',
				'</a>'
			),
			'type' => 'problem',
			'hide' => false,
		],
		// AdSense account alert. Missing ads.txt – version 1.
		'adsense_alert_ALERT_TYPE_ADS_TXT_UNAUTHORIZED' => [
			'text' => sprintf(
				__( 'One of your sites is missing the AdSense publisher ID in the ads.txt file.', 'advanced-ads' )
				. ' <a class="advads-settings-link" href="%s">'
				. _x( 'Create one now.', 'related to ads.txt file', 'advanced-ads' ) . '</a>',
				admin_url( 'admin.php?page=advanced-ads-settings#general__advads-ads-txt' )
			) . ' ' . Advanced_Ads_Ad_Health_Notices::get_adsense_error_link( 'ALERT_TYPE_ADS_TXT_UNAUTHORIZED' ),
			'type' => 'problem',
		],
		// AdSense account alert. . Missing ads.txt – version 2.
		'adsense_alert_ADS_TXT_MISSING'                 => [
			'text' => sprintf(
				__( 'One of your sites is missing the AdSense publisher ID in the ads.txt file.', 'advanced-ads' )
				. ' <a class="advads-settings-link" href="%s">'
				. _x( 'Create one now.', 'related to ads.txt file', 'advanced-ads' ) . '</a>',
				admin_url( 'admin.php?page=advanced-ads-settings#general__advads-ads-txt' )
			) . ' ' . Advanced_Ads_Ad_Health_Notices::get_adsense_error_link( 'ADS_TXT_MISSING' ),
			'type' => 'problem',
		],
		// AdSense account alert. . Missing ads.txt – version 3.
		'adsense_alert_ADS_TXT_ISSUES'                  => [
			'text' => sprintf(
				__( 'One of your sites is missing the AdSense publisher ID in the ads.txt file.', 'advanced-ads' )
				. ' <a class="advads-settings-link" href="%s">'
				. _x( 'Create one now.', 'related to ads.txt file', 'advanced-ads' ) . '</a>',
				admin_url( 'admin.php?page=advanced-ads-settings#general__advads-ads-txt' )
			) . ' ' . Advanced_Ads_Ad_Health_Notices::get_adsense_error_link( 'ADS_TXT_ISSUES' ),
			'type' => 'problem',
		],

		// AdSense deprecated link units.
		'adsense_link_units_deprecated'                 => [
			'text' => __( 'Google AdSense deprecated Link Units. Please choose another format.', 'advanced-ads' )
				. ' <a href="https://wpadvancedads.com/adsense-link-units/" target="_blank" rel="noopener">'
				. esc_html__( 'Learn more', 'advanced-ads' )
				. '</a>',
			'type' => 'problem',
		],
		'nested_the_content_filters'                    => [
			'text'          => sprintf(
				/* translators: %s is a filter hook, here `the_content`. */
				__( '<strong>%s</strong> filter found multiple times.', 'advanced-ads' ),
				'the_content'
			) . '&nbsp;' . __( 'Advanced Ads uses the outermost of them.', 'advanced-ads' ),
			'get_help_link' => 'https://wpadvancedads.com/manual/ad-health/?utm_source=advanced-ads&utm_medium=link&utm_campaign=error-multiple-the-content#the_content_filter_found_multiple_times',
			'type'          => 'notice',
			'hide'          => false,
		],
		// BuddyPress installed.
		'buddypress_no_pro'                             => [
			'text' => sprintf(
			/* translators: %1$s is a plugin name, %2$s is the opening a tag and %3$s the closing one. */
				__( 'Learn how to integrate %1$s with Advanced Ads %2$shere%3$s.', 'advanced-ads' ),
				'<strong>BuddyPress</strong>',
				'<a href="https://wpadvancedads.com/ads-on-buddypress-pages/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-buddypress" target="_blank">',
				'</a>'
			),
			'type' => 'notice',
		],
		// BuddyBoss installed.
		'buddyboss_no_pro'                              => [
			'text' => sprintf(
			/* translators: %1$s is a plugin name, %2$s is the opening a tag and %3$s the closing one. */
				__( 'Learn how to integrate %1$s with Advanced Ads %2$shere%3$s.', 'advanced-ads' ),
				'<strong>BuddyBoss</strong>',
				'<a href="https://wpadvancedads.com/manual/buddyboss-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-buddyboss" target="_blank">',
				'</a>'
			),
			'type' => 'pitch',
		],
		// bbPress installed.
		'bbpress_no_pro'                                => [
			'text' => sprintf(
				/* translators: %1$s is a plugin name, %2$s is the opening a tag and %3$s the closing one. */
				__( 'Learn how to integrate %1$s with Advanced Ads %2$shere%3$s.', 'advanced-ads' ),
				'<strong>bbPress</strong>',
				'<a href="https://wpadvancedads.com/ads-in-bbpress/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-bbpress" target="_blank">',
				'</a>'
			),
			'type' => 'notice',
		],
		// WPML plugin activated.
		'WPML_active'                                   => [
			'text'    => sprintf(
				/* translators: %1$s is a plugin name, %2$s is the opening a tag and %3$s the closing one. */
				__( 'Learn how to integrate %1$s with Advanced Ads %2$shere%3$s.', 'advanced-ads' ),
				'<strong>WPML</strong>',
				'<a href="https://wpadvancedads.com/translating-ads-wpml/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-WPML" target="_blank">',
				'</a>'
			),
			'type'    => 'notice',
			'hide'    => false,
			'timeout' => YEAR_IN_SECONDS,
		],
		// AMP and Accelerated Mobile Pages plugins.
		'AMP_active'                                    => [
			'text'    => sprintf(
				/* translators: %1$s is a plugin name, %2$s is the opening a tag and %3$s the closing one. */
				__( 'Learn how to integrate %1$s with Advanced Ads %2$shere%3$s.', 'advanced-ads' ),
				'<strong>AMP</strong>',
				'<a href="https://wpadvancedads.com/manual/ads-on-amp-pages/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-amp" target="_blank">',
				'</a>'
			),
			'type'    => 'notice',
			'hide'    => false,
			'timeout' => YEAR_IN_SECONDS,
		],
		// Hosting on WP Engine
		// Advanced_Ads_Checks::wp_engine_hosting().
		'wpengine'                                      => [
			'text'    => sprintf(
				/* translators: %s is a service or plugin name */
				'<strong>' . __( '%s detected.', 'advanced-ads' ) . '</strong>'
				. ' <a href="https://wpadvancedads.com/wp-engine-and-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-wpengine">' . __( 'Learn how this might impact your ad setup.', 'advanced-ads' ) . '</a>',
				'WP Engine'
			),
			'type'    => 'notice',
			'hide'    => false,
			'timeout' => YEAR_IN_SECONDS,
		],
		// Notice about existing ads.txt plugins.
		// Advanced_Ads_Checks::ads_txt_plugins().
		'ads_txt_plugins_enabled'                       => [
			'text'    => sprintf(
				/* translators: %s removable ads.txt plugins */
				__( 'Advanced Ads handles your ads.txt file automatically. You might be able to <strong>remove %1$s</strong>.', 'advanced-ads' ),
				implode( ', ', Advanced_Ads_Checks::ads_txt_plugins() )
			),
			'type'    => 'notice',
			'hide'    => false,
			'timeout' => YEAR_IN_SECONDS,
		],
		// Notice about plugins that add header or footer code.
		// Advanced_Ads_Checks::header_footer_plugins().
		'header_footer_plugins_enabled'                 => [
			'text'    =>
				__( 'Advanced Ads handles header and footer codes.', 'advanced-ads' ) . '&nbsp;' .
				sprintf(
					/* translators: %s removable header and footer plugins */
					__( 'You might be able to <strong>remove %1$s</strong>.', 'advanced-ads' ),
					implode( ', ', Advanced_Ads_Checks::header_footer_plugins() )
				) . '&nbsp;' .
				'<a href="https://wpadvancedads.com/add-header-and-footer-code-wordpress/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-header-footer" target="_blank">' . __( 'Learn how.', 'advanced-ads' ) . '</a>',
			'type'    => 'notice',
			'hide'    => false,
			'timeout' => YEAR_IN_SECONDS,
		],
		// GamiPress.
		'gamipress_no_pro'                              => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to target ads on GamiPress websites %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/manual/gamipress-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-gamipres" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Paid Membership Pro.
		'pmp_no_pro'                                    => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to manage ads on membership sites running Paid Memberships Pro %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/paid-memberships-pro/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-pmp" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Members plugin.
		'members_no_pro'                                => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to target ads to specific user roles created with the Members plugin %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/members-plugin-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-members" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Members plugin.
		'translatepress_no_pro'                         => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to target ads to multiple languages in TranslatePress %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/translatepress/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-translatepress" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Weglot.
		'weglot_no_pro'                                 => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to target ads to multiple languages in Weglot %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/weglot/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-weglot" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// LearnDash.
		'learndash'                                     => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to integrate ads into LearnDash %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/learndash-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-learndash" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// AAWP.
		'aawp'                                          => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to auto-inject Amazon Ads with AAWP and Advanced Ads %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/aawp-amazon/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-aawp" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Polylang.
		'polylang'                                      => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to target ads to multiple languages in Polylang %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/polylang/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-polylang" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// MailPoet.
		'mailpoet'                                      => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to integrate Advanced Ads in MailPoet Newsletters %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/mailpoet-newsletters/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-mailpoet" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// WP Rocket.
		'wp_rocket'                                     => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to use WP Rocket with Advanced Ads %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/wp-rocket-adsense/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-wprocket" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Quiz plugins.
		'quiz_plugins_no_pro'                           => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to embed Ads into a Quiz %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/quiz-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-quiz" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Elementor.
		'elementor'                                     => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to create and implement ads in Elementor %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/elementor-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-elementor" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// SiteOrigin.
		'siteorigin'                                    => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to embed ads into a website built with the SiteOrigin page builder %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/siteorigin-page-builder/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-siteorigin" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Divi Theme or Divi builder plugin.
		'divi_no_pro'                                   => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to integrate ads into the Divi theme and Divi builder %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/divi-theme-builder/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-divi" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Divi Theme or Divi builder plugin.
		'beaver_builder'                                => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to embed ads into your Beaver Builder website %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/beaver-builder-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-beaverbuilder" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Pagelayer plugin.
		'pagelayer'                                     => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to embed ads into a website built with Pagelayer %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/pagelayer/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-pagelayer" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// WPBakery Page Builder.
		'wpb'                                           => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn more about displaying Ads with WPBakery Page Builder %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/visual-composer-ads/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-wpbakery" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
		// Newspaper theme.
		'newspaper'                                     => [
			'text' => sprintf(
			/* translators: 1 opening anchor tag, 2 closing tag, 3 icon */
				__( 'Learn how to integrate ads into the tagDiv Newspaper theme %1$shere%2$s %3$s', 'advanced-ads' ),
				'<a href="https://wpadvancedads.com/tagdiv-newspaper-theme/?utm_source=advanced-ads&utm_medium=link&utm_campaign=notice-newspaper" target="_blank">',
				'</a>',
				'<i class="dashicons dashicons-external"></i>'
			),
			'type' => 'pitch',
		],
	]
);
