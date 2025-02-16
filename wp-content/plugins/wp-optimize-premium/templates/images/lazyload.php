<?php if (!defined('WPO_VERSION')) die('No direct access allowed'); ?>
<?php

$default_options = array(
	'images' => false,
	'backgrounds' => false,
	'iframes' => false,
	'skip_classes' => '',
);

$lazyload_options = wp_parse_args($options->get_option('lazyload'), $default_options);

$read_more_link = 'https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/';

?>

<div id="wpo_lazy_load_settings">
	<h3 class="wpo-first-child"><?php esc_html_e('Lazy-load images'); ?></h3>
	<div class="wpo-fieldgroup">
		<p>
			<?php
			esc_html_e('Lazy-loading is technique that defers loading of non-critical resources (images, video) at page load time.', 'wp-optimize');
			echo "&nbsp;";
			esc_html_e('Instead, these non-critical resources are loaded at the point they are needed (e.g. the user scrolls down to them).', 'wp-optimize');
			?>
			<br>
			<?php $wp_optimize->wp_optimize_url($read_more_link, __('Follow this link to read more about lazy-loading images and video', 'wp-optimize')); ?>
		</p>

		<?php if ($lazyload_already_provided_by) { ?>
			<div class="notice notice-warning below-h2">
				<p><?php printf(esc_html__('We have detected an already-active component that provides lazy-loading (%s). Having several lazy-loading plugins is likely to cause conflicts.', 'wp-optimize'), esc_html($lazyload_already_provided_by)); ?></p>
			</div>
		<?php } ?>

		<ul>
			<li><label><input type="checkbox" name="lazyload[images]" <?php checked($lazyload_options['images']); ?> /><?php esc_html_e('Images', 'wp-optimize'); ?></label></li>
			<li><label><input type="checkbox" name="lazyload[backgrounds]" <?php checked($lazyload_options['backgrounds']); ?> /><?php esc_html_e('Background images', 'wp-optimize'); ?></label></li>
			<li><label><input type="checkbox" name="lazyload[iframes]" <?php checked($lazyload_options['iframes']); ?> /><?php esc_html_e('Iframes and Videos', 'wp-optimize'); ?></label></li>
		</ul>

		<p>
			<?php esc_html_e('Skip image classes', 'wp-optimize');?><br>
			<input type="text" name="lazyload[skip_classes]" id="wpo_lazyload_skip_classes" value="<?php echo esc_attr($lazyload_options['skip_classes']); ?>" /><br>
			<small>
				<?php
				esc_html_e('Enter the image class or classes comma-separated.', 'wp-optimize');
				echo "&nbsp;";
				esc_html_e('Supports wildcards.', 'wp-optimize');
				echo "&nbsp;";
				esc_html_e('Example: image-class1, image-class2, thumbnail*, ...', 'wp-optimize');

				?>
			</small>
		</p>

		<input type="button" class="button-primary wp-optimize-settings-save" value="<?php esc_attr_e('Save settings', 'wp-optimize'); ?>" />
		<img class="wpo_spinner display-none" src="<?php echo esc_url(admin_url('images/spinner-2x.gif')); ?>" alt="...">
		<span class="dashicons dashicons-yes display-none save-done"></span>
	</div>
</div>
