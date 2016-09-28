<?php get_header(); ?>
<h3 class="post__title text-center [ no-margin ]">FIND RESOURCES BY</h3>

<div class="open_contribution">
	

	<h5 class="sub-title-centre text-center">Participate on resources open to contribution</h5>

	<div class="[ posts-centre ]">

		<?php $resources_args = array('post_type' => 'resource','posts_per_page' => 3,'meta_key' => '_open_contribution_meta','meta_value' => 'yes');

		$query_resources = new WP_Query( $resources_args );
		if ( $query_resources->have_posts()) : 
			$count = 1;
			while ( $query_resources->have_posts() ) : $query_resources->the_post(); 
				$class = $count == 3 ? 'ultimo' : ''; 
				$working_group = wp_get_post_terms($post->ID, 'working_group', array("fields" => "all"));
				$sector = wp_get_post_terms($post->ID, 'sector', array("fields" => "all"));
				$resource_type = wp_get_post_terms($post->ID, 'resource_type', array("fields" => "all"));
				$link_contribution = get_post_meta( $post->ID, 'link_contribution', true );?>
				
				<div class="[ sc_column_item ][ post-centre <?php echo $class; ?> ]">
					<a class="[ post__card ]" href="<?php echo $link_contribution; ?>">
						<img class="circle-img" src="<?php echo THEMEPATH.'/images/circle-azul.jpg' ?>" alt="">
						<h4 class="[ post__title ]"><?php echo get_the_title() ?></h4>
						<p class="[ post__author ]">Author: <?php the_author(); ?></p>
						<hr>
						<div class="[ cajita ][ working ] ">
							<p class="[ taxonomy ]">Working Group</p>
							<p class="[ term ]"><?php echo $working_group[0]->name; ?></p>
						</div>
						<div class="[ cajita ][ sector ] ">
							<p class="[ taxonomy ]">Sector</p>
							<p class="[ term ]"><?php echo $sector[0]->name; ?></p>
						</div>
						<div class="[ cajita ][ type ] ">
							<p class="[ taxonomy ]">Type</p>
							<p class="[ term ]"><?php echo $resource_type[0]->name; ?></p>
						</div>
						<hr>
						<div class="[ cajita ][ working ] ">
							<p class="[ taxonomy ]">Open untill</p>
							<p class="[ date ]">July 5</p>
						</div>
					
					</a>
				</div>
			
				<?php $count++; 
			endwhile; 
		endif; ?>
		
	</div>
</div>

<h5 class="sub-title-centre">Working Group</h5>

<div class="[ posts-centre ]">

	<?php $resources_args = array('post_type' => 'resource', 'posts_per_page' => 3, 'meta_key' => '_open_contribution_meta', 'meta_value' => 'no', 'offset' => 0);
	$workins = new WP_Query( $resources_args );
	if ( $workins->have_posts()) : 
		$count = 1;
		while ( $workins->have_posts() ) : $workins->the_post(); 
			$class = $count == 3 ? 'ultimo' : ''; 
			$working_group = wp_get_post_terms($post->ID, 'working_group', array("fields" => "all"));
			$sector = wp_get_post_terms($post->ID, 'sector', array("fields" => "all"));
			$resource_type = wp_get_post_terms($post->ID, 'resource_type', array("fields" => "all"));?>
			
			<div class="[ sc_column_item ][ post-centre <?php echo $class; ?> ]">
				<p class="name-term"><?php echo $working_group[0]->name; ?></p>
				<a class="[ post__card ]" href="<?php the_permalink(); ?>">
					<h4 class="[ post__title ]"><?php the_title(); ?></h4>
					<p class="[ post__author ]">Author: <?php the_author(); ?></p>
					<hr>
					<div class="[ cajita ][ working ] ">
						<p class="[ taxonomy ]">Working Group</p>
						<p class="[ term ]"><?php echo $working_group[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ sector ] ">
						<p class="[ taxonomy ]">Sector</p>
						<p class="[ term ]"><?php echo $sector[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ type ] ">
						<p class="[ taxonomy ]">Type</p>
						<p class="[ term ]"><?php echo $resource_type[0]->name; ?></p>
					</div>
				</a>
			</div>
			<?php $count++; 
		endwhile; 
	endif; ?>
	
</div>
<?php $resources_args = array('post_type' => 'resource', 'posts_per_page' => 3, 'meta_key' => '_open_contribution_meta', 'meta_value' => 'no', 'offset' => 3);
$workins = new WP_Query( $resources_args );
if ( $workins->have_posts()) : ?>
	<h5 class="sub-title-centre">SECTOR</h5>

	<div class="[ posts-centre ]">

		<?php $count = 1;
		while ( $workins->have_posts() ) : $workins->the_post(); 
			$class = $count == 3 ? 'ultimo' : ''; 
			$working_group = wp_get_post_terms($post->ID, 'working_group', array("fields" => "all"));
			$sector = wp_get_post_terms($post->ID, 'sector', array("fields" => "all"));
			$resource_type = wp_get_post_terms($post->ID, 'resource_type', array("fields" => "all"));?>
			
			<div class="[ sc_column_item ][ post-centre <?php echo $class; ?> ]">
				<p class="name-term"><?php echo $sector[0]->name; ?></p>
				<a class="[ post__card ]" href="<?php the_permalink(); ?>">
					<h4 class="[ post__title ]"><?php the_title(); ?></h4>
					<p class="[ post__author ]">Author: <?php the_author(); ?></p>
					<hr>
					<div class="[ cajita ][ working ] ">
						<p class="[ taxonomy ]">Working Group</p>
						<p class="[ term ]"><?php echo $working_group[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ sector ] ">
						<p class="[ taxonomy ]">Sector</p>
						<p class="[ term ]"><?php echo $sector[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ type ] ">
						<p class="[ taxonomy ]">Type</p>
						<p class="[ term ]"><?php echo $resource_type[0]->name; ?></p>
					</div>
				</a>
			</div>
			<?php $count++; 
		endwhile; ?>
		
	</div>
<?php endif; ?>

<?php $resources_args = array('post_type' => 'resource', 'posts_per_page' => 3, 'meta_key' => '_open_contribution_meta', 'meta_value' => 'no', 'offset' => 3);
$workins = new WP_Query( $resources_args );
if ( $workins->have_posts()) : ?>
	<h5 class="sub-title-centre">TYPE</h5>

	<div class="[ posts-centre ]">

		<?php $count = 1;
		while ( $workins->have_posts() ) : $workins->the_post(); 
			$class = $count == 3 ? 'ultimo' : ''; 
			$working_group = wp_get_post_terms($post->ID, 'working_group', array("fields" => "all"));
			$sector = wp_get_post_terms($post->ID, 'sector', array("fields" => "all"));
			$resource_type = wp_get_post_terms($post->ID, 'resource_type', array("fields" => "all"));?>
			
			<div class="[ sc_column_item ][ post-centre <?php echo $class; ?> ]">
				<p class="name-term"><?php echo $sector[0]->name; ?></p>
				<a class="[ post__card ]" href="<?php echo the_permalink(); ?>">
					<h4 class="[ post__title ]"><?php echo the_title(); ?></h4>
					<p class="[ post__author ]">Author: <?php the_author(); ?></p>
					<hr>
					<div class="[ cajita ][ working ] ">
						<p class="[ taxonomy ]">Working Group</p>
						<p class="[ term ]"><?php echo $working_group[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ sector ] ">
						<p class="[ taxonomy ]">Sector</p>
						<p class="[ term ]"><?php echo $sector[0]->name; ?></p>
					</div>
					<div class="[ cajita ][ type ] ">
						<p class="[ taxonomy ]">Type</p>
						<p class="[ term ]"><?php echo $resource_type[0]->name; ?></p>
					</div>
				</a>
			</div>
			<?php $count++; 
		endwhile; ?>
		
	</div>
<?php endif; ?>

<?php get_footer(); ?>