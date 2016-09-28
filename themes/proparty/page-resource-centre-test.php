<?php get_header(); ?>

<div class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ margin-bottom--large ]">

	<div class="[ column-6_12 column-centered sc_column_item ]">
		<h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">
			<span style="font-weight: 400;">Search resources</span>
		</h5>
		<div class="[ search_wrap search_wrap--large search_style_regular search_ajax inited search_opened ][ width-100 ]" title="Open/close search form">
			<div class="[ search_form_wrap ]">
				<form role="search" method="post" class="[ search_form ]" action="<?php echo site_url() . '/resource-centre-results' ?>">
					<button type="submit" class="[ search_submit icon-search-1 ][ right-0 ]" title="Start search"></button>
					<input type="text" class="[ search_field search_field--large ][ width-100 ]" placeholder="" value="" name="search-resources" title="">
				</form>
			</div>
		</div>

	</div>

</div>

<h5 class="sc_title sc_title_regular sc_align_center [ no-margin ][ text-center ]">
	<span style="font-weight: 400;">Working groups</span>
</h5>
<div class="[ wg-filters ][ text-center ]">
	<?php show_filters( 'working-group-centre' ); ?>
</div>

<h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">
	<span style="font-weight: 400;">Resources opened to contribution</span>
</h5>

<div class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ posts-container ]">


	<?php
	$resources_args = array(
		'post_type' 		=> 'resource',
		'posts_per_page' 	=> -1,
		'meta_key'			=> '_open_contribution_meta',
		'meta_value'		=> 'yes'
	);

	$query_resources = new WP_Query( $resources_args );
	if ( $query_resources->have_posts()) : while ( $query_resources->have_posts() ) : $query_resources->the_post(); ?>
		<div class="[ column-4_12 sc_column_item ][ post ]">
			<a class="[ post__card ]" href="<?php echo the_permalink(); ?>">
				<h4 class="[ post__title ]">
					<?php echo get_the_title() ?>
				</h4>
				<?php the_post_thumbnail( 'medium', array( 'class' => '[ post__image ][ image-responsive ]' ) ); ?>
				<p class="[ post__excerpt ]"><?php echo  get_the_excerpt(); ?></p>
				<p class="[ post__info ]">Sector: <?php echo get_sector( $post->ID ); ?></p>
				<p class="[ post__info post__country ][ hidden ]"><?php echo get_country( $post->ID ); ?></p>
				<p class="[ post__info post__date ][ hidden ]" ><?php echo get_the_time('U') ?></p>
				<p class="[ post__info  ]" >by: <span class="[ post__author ]"><?php echo get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); ?></span></p>
			</a>
		</div>
	<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>