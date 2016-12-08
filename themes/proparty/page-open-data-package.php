<?php

/*
Template Name: Open Data Package
*/

?>

<?php get_header(); ?>
<?php get_template_part( 'templates/parts/open-data-package', 'top' ); ?>
<div class="content_wrap">
<div class="content">
<section id="anticorruption">
<section class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ anticorruption ]">
    <div class="[ column-3_12 sc_column_item ][ anticorruption-sidebar ]">
      <div class="sidebar-container">
      <?php

              if ( has_children() OR $post->
      post_parent > 0 ) { ?>

          <ul>
              <li <?php if($post->post_parent == 0) echo 'class="active"' ?>>
              <a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>">
                  <?php echo get_the_title(get_top_ancestor_id()); ?>
              </a>
              </li>
              <?php

                          $args = array(
                              'child_of' =>
              get_top_ancestor_id(),
                              'title_li' => ''
                          );

                          ?>
              <?php wp_list_pages($args); ?>
          </ul>
      <?php } ?>
            <div class="anticorruption-sponsors">
            <p class="sponsor-label">Developed by</p>
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_godan.png" alt="" />
            <p class="sponsor-label">Maintained by:</p>
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_odi.png" alt="" />
            <p class="sponsor-label">Collaborative product of:</p>
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_open_data.png" alt="" />
            <a href="https://docs.google.com/document/d/1DrLlmnzsadroW16mwLyOWhNa1ABk_qeRQZ9PbmeCLzQ/edit" class="doc-link" target="_blank">Contribute</a>
	</div>
    </div>
    </div>
    <div class="[ column-9_12 sc_column_item ][ anticorruption-content ]">
        <div class="inner">

<?php echo get_post_field('post_content', $post->ID); ?>


            <?php paginate_parent_children(0); ?>

        </div>
    </div>

</section>
</section>

<?php
function paginate_parent_children( $parent = null ) {
    global $post;

    $child  = $post->ID;
    $parent = ( null !== $parent ) ? $parent : $post->post_parent;

    $children = get_pages( array(
                'sort_column' => 'menu_order',
                'sort_order'  => 'ASC',
                'child_of'    => $parent
                ) );

    $pages = array( $parent );
    foreach( $children as $page )
        $pages[] += $page->ID;

    if( ! in_array( $child, $pages ) && ! is_page( $parent ) )
        return;

    $current = array_search( $child, $pages );

    $prev = $pages[$current-1];
    $next = $pages[$current+1];
    $next_name = get_post($next)->post_name

    ?>

	<p class="next-section top-margin-big">
	<?php
        if(get_post()->post_name != 'agriculture-open-data-package') :
          if ( empty( $prev ) && ! is_page( $parent ) ) echo 'PREVIOUS';
          elseif ( ! empty( $prev ) ) echo 'PREVIOUS';
        endif;

        if( ! empty( $next ) && $next_name!='homepage') :
    ?>
    <span class="text-right">NEXT</span>
    <?php
        endif;
    ?>
	</p>


	<p class="next-section">
	<?php
        if(get_post()->post_name != 'agriculture-open-data-package') :
          if ( empty( $prev ) && ! is_page( $parent ) ) :
    ?>
    <span class="text-left"><a href="<?php echo get_permalink( $parent ); ?>" title="<?php echo esc_attr( get_the_title( $parent ) ) ?>"><?php echo get_the_title( $parent ) ?></a></span>
    <?php
          elseif ( ! empty( $prev ) ) :
    ?>
    <span class="text-left"><a href="<?php echo get_permalink( $prev ); ?>" title="<?php echo esc_attr( get_the_title( $prev ) ) ?>"><?php echo get_the_title( $prev ) ?></a></span>
    <?php
          endif;
        endif;
        if( ! empty( $next ) && $next_name!='homepage') :
    ?>
    <span class="text-right"><a href="<?php echo get_permalink( $next ); ?>" title="<?php echo esc_attr( get_the_title( $next ) ) ?>"><?php echo get_the_title( $next ) ?></a></span>
    <?php
        endif;
    ?>
	</p>

<?php }
?>

</div>
</div>
<?php get_footer(); ?>
<?php
// Get top ancestor
function get_top_ancestor_id() {
    global $post;

    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    return $post->ID;
}

// Does page have children?
function has_children() {
    global $post;
    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
}
?>
