<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'axiom_template_accordion_theme_setup' ) ) {
	add_action( 'axiom_action_before_init_theme', 'axiom_template_accordion_theme_setup', 1 );
	function axiom_template_accordion_theme_setup() {
		axiom_add_template(array(
			'layout' => 'accordion-1',
			'template' => 'accordion',
			'container_classes' => 'sc_accordion sc_accordion_style_1',
			'mode'   => 'blogger',
			'title'  => __('Blogger layout: Accordion (Style 1)', 'axiom')
			));
		axiom_add_template(array(
			'layout' => 'accordion-2',
			'template' => 'accordion',
			'container_classes' => 'sc_accordion sc_accordion_style_2',
			'mode'   => 'blogger',
			'title'  => __('Blogger layout: Accordion (Style 2)', 'axiom')
			));
		// Add template specific scripts
		add_action('axiom_action_blog_scripts', 'axiom_template_accordion_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('axiom_template_accordion_add_scripts')) {
	//add_action('axiom_action_blog_scripts', 'axiom_template_accordion_add_scripts');
	function axiom_template_accordion_add_scripts($style) {
		if (axiom_substr($style, 0, 10) == 'accordion_') {
			axiom_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
		}
	}
}

// Template output
if ( !function_exists( 'axiom_template_accordion_output' ) ) {
	function axiom_template_accordion_output($post_options, $post_data) {
		?>
		<div class="post_item sc_blogger_item sc_accordion_item<?php echo ($post_options['number'] == $post_options['posts_on_page'] && !axiom_sc_param_is_on($post_options['loadmore']) ? ' sc_blogger_item_last' : ''); ?>">
			
			<h5 class="post_title sc_title sc_blogger_title sc_accordion_title"><span class="sc_accordion_icon sc_accordion_icon_closed icon-plus-1"></span><span class="sc_accordion_icon sc_accordion_icon_opened icon-minus-1"></span><?php echo ($post_data['post_title']); ?></h5>
			
			<div class="post_content sc_accordion_content">
				<?php
				if (axiom_sc_param_is_on($post_options['info'])) {
					?>
					<div class="post_info">
						<span class="post_info_item post_info_posted_by"><?php _e('Posted by', 'axiom'); ?> <a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_info_author"><?php echo esc_html($post_data['post_author']); ?></a></span>
						<span class="post_info_item post_info_counters">
							<?php echo ($post_options['orderby']=='comments' || $post_options['counters']=='comments' ? __('Comments', 'axiom') : __('Views', 'axiom')); ?>
							<span class="post_info_counters_number"><?php echo ($post_options['orderby']=='comments' || $post_options['counters']=='comments' ? $post_data['post_comments'] : $post_data['post_views']); ?></span>
						</span>
					</div>
					<?php
				}
				if ($post_options['descr'] >= 0) {
					?>
					<div class="post_descr">
					<?php
					if (!in_array($post_data['post_format'], array('quote', 'link', 'chat')) && $post_options['descr'] > 0 && axiom_strlen($post_data['post_excerpt']) > $post_options['descr']) {
						$post_data['post_excerpt'] = axiom_strshort($post_data['post_excerpt'], $post_options['descr'], $post_options['readmore'] ? '' : '...');
					}
					echo ($post_data['post_excerpt']);
					?>
					</div>
					<?php
				}
				if (empty($post_options['readmore'])) $post_options['readmore'] = __('READ MORE', 'axiom');
				if (!axiom_sc_param_is_off($post_options['readmore']) && !in_array($post_data['post_format'], array('quote', 'link', 'chat', 'aside', 'status'))) {
					echo do_shortcode('[trx_button link="'.esc_url($post_data['post_link']).'"]'.($post_options['readmore']).'[/trx_button]');
				}
				?>
			
			</div>	<!-- /.post_content -->

		</div>		<!-- /.post_item -->

		<?php
	}
}
?>