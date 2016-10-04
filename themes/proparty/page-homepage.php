<?php get_header(); the_post();?>
	</div>
</div>
<div class="sc_gap_home">
	<div class="content_wrap content_home">
		<h1 style="margin-top:25px;margin-bottom:25px;">Principles</h1>

		<!-- Principales nuevos -->

		<div class="caja-principal">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="candado" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/unlock-278x300.png" alt="">
		   		<h5>1. Open by Default</h5>
		   	</a>
		</div>
		<div class="caja-principal">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="reloj" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/clock-278x300.png" alt="" />
		   		<h5>2. Timely and Comprehensive</h5>
		   	</a>
		</div>
		<div class="caja-principal ultimo">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="llave" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/key-278x300.png" alt="" />
		   		<h5>3. Accessible and Usable</h5>
		   	</a>
		</div>
		<div class="caja-principal">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="join" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/overlap-278x300.png" alt="" />
		   		<h5>4. Comparable and Interoperable</h5>
		   	</a>
		</div>
		<div class="caja-principal">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="estructura" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/bank-278x300.png" alt="" />
		   		<h5>5. For Improved Governance and Citizen Engagement</h5>
		   	</a>
		</div>
		<div class="caja-principal ultimo">
		   	<a href="<?php echo site_url('/'); ?>principles/">
		   		<img class="foco" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/bulb-278x300.png" alt="" />
		   		<h5>6. For Inclusive Development and Innovation</h5>
		   	</a>
		</div>
	</div>
	<div style="text-align: center;">
		<a class="btn btn-resource-centre" href="/adopt-the-charter/">ADOPT THE CHARTER</a>
	</div>
</div>
<div class="sc_resources_home">
	<div class="content_wrap content_home">
		<h1>
			Resource Centre
			<span>beta</span>
		</h1>

		<section class="[ column-12_12 column sc_column_item ][ resource-centre-results__section ]">
	        <?php $group_active = isset($_POST['group']) ? $_POST['group'] : 'ninguno'; ?>
	        <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ]">
	            <?php $args = array(
	                'posts_per_page'   => 3,
	                'category'         => '',
	                'category_name'    => '',
	                'orderby'          => 'date',
	                'order'            => 'DESC',
									'meta_key'         => 'meta-featured',
									'meta_value'       => 'yes',
	                'post_type'        => 'resource',
	                'post_status'      => 'publish',
	                'suppress_filters' => true
	            );

	            $posts_array = query_posts( $args );
	            if ( !empty($posts_array) ) :
	                $i  = j;
	                foreach ( $posts_array as  $post ) :
	                    setup_postdata( $post );
	                    $meta = get_post_meta( $post->ID, '_open_contribution_meta', true );
	                    $class_contri = $meta == 'yes' ?  $meta.'-contribution ' : 'no-contribution ';
	                    $resource_info = get_resource_info( $post->ID );
	                    $resource_filter_classes = $class_contri;
	                    foreach ( $resource_info as $key => $value ) :
	                        $resource_filter_classes .= $value . ' ';
	                    endforeach;?>
	                    <div class="[ column-4_12 sc_column_item ][ resource-result ][ <?php echo $resource_filter_classes; ?>]">
	                        <div class="inner">
	                            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => '[ wp-post-image ]' ) ); ?></a>
	                            <h4 class="[ post__title ]">
	                                <a href="<?php echo the_permalink(); ?>"><?php echo get_the_title(); ?></a>
	                                <span class="resource-date"><?php echo get_the_date('n/j/y'); ?></span>
	                            </h4>
	                            <p class="resource-author">by <?php echo get_post_meta( get_the_ID(), 'meta-author', true ); ?></p>
	                            <div class="metadata">
	                                <div class="info">
	                                    <p class="info-title">Description</p>
	                                    <p class="info-data"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ) ?></p>
	                                    <p class="info-link"><a href="<?php echo the_permalink(); ?>">Read more</a></p>
	                                </div>
	                            </div>
	                            <span class="contribution-tag">Open<br />for<br />comments</span>
	                        </div>
	                    </div>
	                    <?php if ( ++$j % 3 == 0 ) : ?>
	                        </article>
	                        <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ]">
	                    <?php endif; ?>
	                <?php endforeach; ?>
	            <?php endif; ?>
	        </article>
					<div style="text-align: center;">
							<a class="btn btn-resource-centre" href="resource-centre/">RESOURCE CENTRE</a>
					</div>
	    </section>
    </div>
</div>
<div class="sc_gap_home">
	<div class="content_wrap">
		<h1 style="margin-top:25px;margin-bottom:25px;">Newsfeed</h1>
		<?php $news = new WP_Query(array( 'posts_per_page' => 3, 'post_type' => array('post'), 'cat' => 30 ) );
		if ( $news->have_posts() ) :
			while( $news->have_posts() ) : $news->the_post();
				$date = getDateTransform($post->post_date); ?>
				<div class="content_home_newsfeed">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ):
							the_post_thumbnail('news-home');
						else:
							echo '<img src="http://placehold.it/443x240" />';
						endif; ?>
						<h3><?php the_title(); ?></h3>
						<p><?php echo wp_trim_words( get_the_excerpt(), 16 ) ?></p>
						<span class="date-news"><?php echo $date[5].' '.$date[4]; ?><span> | <?php echo $date[2]; ?> </span></span>

					</a>
				</div>
				<?php $postCounter++;
			endwhile;
		endif;
		wp_reset_query(); ?>
	</div>
</div>
<div class="content_wrap">
	<h1 style="margin-top:25px;margin-bottom:25px;">Mission</h1>
	<p class="text-mision">The overarching goal is to foster greater coherence and collaboration for the increased adoption and implementation of shared open data principles, standards and good practices across sectors around the world.</p>
</div>

<?php $html = do_shortcode(
		'[vc_row]'
		.'[vc_column]'
		.'[trx_gap]'
		.'[trx_section dedicated="no" pan="no" scroll="no" bg_color="#f6f6f6" bg_overlay="0" bg_texture="0" css="padding-bottom: 40px;"][trx_content][trx_columns fluid="no" count="2" top="55"]'
		.'[trx_column_item]'
		.'[trx_quote cite="#" title="Sir Tim Berners-Lee, inventor of the World Wide Web" bottom="0"]The international Open Data Charter has the potential to accelerate progress by placing actionable data in the hands of people.[/trx_quote]'
		.'[/trx_column_item]'
		.'[trx_column_item]'
		.'[trx_video url="https://youtu.be/dEa-hi44grY" ratio="16:9" autoplay="off" align="center" height="309"]'
		.'[/trx_column_item]'
		.'[/trx_columns]'
		.'[/trx_content][/trx_section]'
		.'[/trx_gap]'
		.'[/vc_column]'
		.'[vc_row][vc_column][trx_gap][trx_block bg_tint="dark" bg_color="#33ccff" bg_overlay="0.75" top="0" bottom="0"][trx_content top="3em" bottom="3em"][trx_section dedicated="no" align="center" pan="no" scroll="no" color="#ffffff" bg_overlay="0" bg_texture="0" font_size="18" font_weight="400" bottom="40" css="font-family: Montserrat;"][trx_image url="http://odcharter.staging.wpengine.com/wp-content/uploads/2015/01/testimonials_header.png" top="0"][/trx_section][trx_testimonials align="center" autoheight="yes" custom="no" width="70%"][vc_column_text]'
		.'[/vc_column_text][/trx_testimonials][/trx_content][/trx_block][/trx_gap][/vc_column][/vc_row]'
	);

echo ($html);

get_footer(); ?>
