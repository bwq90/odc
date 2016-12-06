<?php

/*
Template Name: Anticorruption
*/

?>

<?php

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    if( in_array('current_page_item', $classes) ){
        $classes[] = 'active ';
    }
return $classes;
}

?>

<?php get_header(); ?>
<?php get_template_part( 'templates/parts/anticorruption', 'top' ); ?>
<section id="anticorruption">
<section class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ anticorruption ]">
    <div class="[ column-3_12 sc_column_item ][ anticorruption-sidebar ]">

<?php

        if ( has_children() OR $post->
post_parent > 0 ) { ?>
    <ul>
    <li <?php if(is_page($post->post_parent )) {?> class="active" <?php }?>><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>">Home</a></li>

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
            <p class="sponsor-label">Sponsored By</p>
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_ocp.png" alt="" />
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_transparencia.png" alt="" />
            <p class="sponsor-label">Collaborative product of:</p>
            <img src="<?php bloginfo('template_directory'); ?>/images/logos/logo_open_data.png" alt="" />
        </div>
    </div>
    <div class="[ column-9_12 sc_column_item ][ anticorruption-content ]">
        <div class="inner">

<?php echo get_post_field('post_content', $post->ID); ?>


           <?php paginate_parent_children(); ?>

        </div>
    </div>

</section>
</section>

<?php get_footer(); ?>

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

    ?>
    <?php
        if ( empty( $prev ) && ! is_page( $parent ) ) :
    ?>
    <p class="previous-section top-margin-big"><span class="text-left">PREVIOUS</span></p>
    <div class="previous-section"><span class="text-previous"><a href="<?php echo get_permalink( $parent ); ?>" title="<?php echo esc_attr( get_the_title( $parent ) ) ?>"><?php echo get_the_title( $parent ) ?></a></span></div>
    <?php
        elseif ( ! empty( $prev ) ) :
    ?>
    <p class="previous-section top-margin-big"><span class="text-left">PREVIOUS</span></p>
    <div class="previous-section"><span class="text-left"><a href="<?php echo get_permalink( $prev ); ?>" title="<?php echo esc_attr( get_the_title( $prev ) ) ?>"><?php echo get_the_title( $prev ) ?></a></span></div>
    <?php
        endif;
        if( ! empty( $next ) ) :
    ?>
    <p class="next-section top-margin-big"><span class="text-right">NEXT</span></p>
    <div class="next-section"><span class="text-right"><a href="<?php echo get_permalink( $next ); ?>" title="<?php echo esc_attr( get_the_title( $next ) ) ?>"><?php echo get_the_title( $next ) ?></a></span></div>
    <?php
        endif;
    ?>
<?php }
?>


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