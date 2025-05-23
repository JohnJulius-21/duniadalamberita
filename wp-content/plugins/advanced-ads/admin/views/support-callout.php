<?php
/**
 * Support callout.
 *
 * @package Advanced_Ads
 * @since   1.0.0
 */

use AdvancedAds\Utilities\Data;
?>

<div id="advads-support-callout">
	<p class="advads-notice-inline advads-idea">
	<a href="<?php echo esc_url( Data::support_url( '/?utm_source=advanced-ads&utm_medium=link&utm_campaign=overview-notices-support' ) ); ?>" target="_blank"><strong><?php esc_html_e( 'Problems or questions?', 'advanced-ads' ); ?></strong>
		<?php esc_html_e( 'Save time and get personal support.', 'advanced-ads' ); ?>&nbsp;<strong style="text-decoration: underline;"><?php esc_html_e( 'Ask your question!', 'advanced-ads' ); ?></strong>
	</a>
	</p>
</div>
