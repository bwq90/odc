<?php get_header(); ?>
<?php
$page_size = 9;
$resources_page = ( isset( $_GET['resources_page'] ) ) ? ( int ) $_GET['resources_page'] : 1;
$search = isset($_GET['search-resources']) ? $_GET['search-resources'] : '';
$order = ( isset( $_GET['search-order'] ) && $_GET['search-order'] != '') ? $_GET['search-order'] : 'date';
$user_profiles = isset($_GET['search-user_profiles']) ? $_GET['search-user_profiles'] : '';
$data_driven_classification = isset($_GET['search-data_driven_classification']) ? $_GET['search-data_driven_classification'] : '';
$themes_and_topics = isset($_GET['search-themes_and_topics']) ? $_GET['search-themes_and_topics'] : '';
$reference_type = isset($_GET['search-reference_type']) ? $_GET['search-reference_type'] : '';
$territories = isset($_GET['search-territories']) ? $_GET['search-territories'] : '';
$principle = isset($_GET['search-principle-filter']) ? $_GET['search-principle-filter'] : '';
?>
<section id="featured-resources">
    <div class="inner">
        <section class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ resource-centre-results ]">
            <section class="[ column-12_12 column sc_column_item ][ resource-centre-results__section ]">
                <h3>Featured resources</h3>
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
                    $posts_array = get_posts( $args );
                    if ( ! empty($posts_array) ) :
                        $i  = 0;
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
                                        <span class="resource-date"><?php echo get_the_date('M.j.Y'); ?></span>
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
                            <?php if ( ++$i % 3 == 0 ) : ?>
                                </article>
                                <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ posts-container ]">
                            <?php endif;
                        endforeach;
                    endif; ?>
                </article>
            </section>
        </section>
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSf09JJtQkohtHOqaxKxeLyXSUiPDaihkWfN0Q6ZFeuQ5BH97g/viewform" class="btn btn-contribute" target="_blank">Contribute</a>
    </div>
</section>
<section class="[ column-12_12 column sc_column_item ][ resource-centre-results__section ]">
    <p class="search-resources-title">Search by</p>
    <article class="[ article ][ resource-centre__search-wrapper ][ margin-bottom ]">
        <div class="[ search_wrap search_wrap search_style_regular search_opened ][ width-100 ]" title="Open/close search form">
            <div class="[ search_form_wrap ]">
                <form role="search" id="resources-search" method="get" class="[ search_form ]" action="" value="$search">
                    <div class="search_field_container">
                        <input type="text" class="[ search_field ]" placeholder="i.e. Open data policies" value="" name="search-resources" title="">
                        <button type="submit" class="[ search_submit icon-search-1 ][ right-0 ]" title="Start search">Search</button>
                    </div>
                    <input type="hidden" name="search-order" value="<?php echo $order; ?>">
                    <input type="hidden" name="search-user_profiles" value="<?php echo $user_profiles; ?>">
                    <input type="hidden" name="search-data_driven_classification" value="<?php echo $data_driven_classification; ?>">
                    <input type="hidden" name="search-themes_and_topics" value="<?php echo $themes_and_topics; ?>">
                    <input type="hidden" name="search-reference_type" value="<?php echo $reference_type; ?>">
                    <input type="hidden" name="search-territories" value="<?php echo $territories; ?>">
                    <input type="hidden" name="search-principle-filter" value="<?php echo $principle; ?>">
                </form>
            </div>
        </div>
    </article>
    <div class="datos-busquedas-centre [ margin-bottom ]">
        <?php if ($search != '') : ?>
            <span>Search results for “<?php echo $search; ?>”<a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($user_profiles != '') : ?>
            <span><?php echo $user_profiles; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($data_driven_classification != '') : ?>
            <span><?php echo $data_driven_classification; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($themes_and_topics != '') : ?>
            <span><?php echo $themes_and_topics; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($reference_type != '') : ?>
            <span><?php echo $reference_type; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($territories != '') : ?>
            <span><?php echo $territories; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
        <?php if ($principle != '') : ?>
            <span><?php echo $principle; ?><a href="<?php echo site_url('/resource-centre-results/'); ?>"><img src="<?php echo THEMEPATH.'/images/cruz-azul-marca.png' ?>"></a></span>
        <?php endif; ?>
    </div>
    <div class="cont-filters">
        <p>Principles</p>
        <ul class="principle-filters">
            <li class="principle-filter" data-filter="open-by-default">
                <img class="candado" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/unlock-278x300.png" alt="">
                <p>Open by Default</p>
            </li>
            <li class="principle-filter" data-filter="timely-and-comprehensive">
                <img class="reloj" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/clock-278x300.png" alt="" />
                <p>Timely and Comprehensive</p>
            </li>
            <li class="principle-filter" data-filter="accesible-and-usable">
                <img class="llave" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/key-278x300.png" alt="" />
                <p>Accessible and Usable</p>
            </li>
            <li class="principle-filter" data-filter="comparable-and-interoperable">
                <img class="join" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/overlap-278x300.png" alt="" />
                <p>Comparable and Interoperable</p>
            </li>
            <li class="principle-filter" data-filter="for-improved-governance-and-citizen-engagement">
                <img class="estructura" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/bank-278x300.png" alt="" />
                <p>For Improved Governance and Citizen Engagement</p>
            </li>
            <li class="principle-filter" data-filter="inclusive-development-and-innovation">
                <img class="foco" src="<?php echo site_url('/'); ?>wp-content/uploads/2015/04/bulb-278x300.png" alt="" />
                <p>Inclusive Development and Innovation</p>
            </li>
        </ul>
    </div>
    <div class="cont-filters">
        <p>Advanced Filter<img src="<?php echo THEMEPATH.'/images/ic-filters.png' ?>"></p>
        <div class="select-filter">
            <p class="filter-label">User Profiles</p>
            <?php show_filters( 'user_profiles', $user_profiles ); ?>
        </div>
        <div class="select-filter">
            <p class="filter-label">Data-driven Classification</p>
            <?php show_filters( 'data_driven_classification', $data_driven_classification ); ?>
        </div>
        <div class="select-filter">
            <p class="filter-label">Themes and Topics</p>
            <?php show_filters( 'themes_and_topics', $themes_and_topics ); ?>
        </div>
        <div class="select-filter">
            <p class="filter-label">Reference Types</p>
            <?php show_filters( 'reference_type', $reference_type ); ?>
        </div>
        <div class="select-filter">
            <p class="filter-label">Territories</p>
            <?php show_filters( 'territories', $territories ); ?>
        </div>
    </div>
    <div class="cont-order-centre">
        <p>Order</p>
        <a href="#" class="[ js-sort ]" data-asc="1" data-sort="date"><span class="[ sc_button_iconed ][ inline-block ]">Date</span> <span class="[ sc_button_iconed icon-angle-down-1 ][ inline-block ]"></span></a>
        <a href="#" class="[ js-sort ]" data-asc="1" data-sort="title"><span class="[ sc_button_iconed ][ inline-block ]">Name</span> <span class="[ sc_button_iconed icon-angle-down-1 ][ inline-block ]"></span></a>
    </div>
</section>
<section class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ margin-bottom--large ][ resource-centre-results ]">
    <section class="[ column-12_12 column sc_column_item ][ resource-centre-results__section ]">
        <?php $group_active = isset($_POST['group']) ? $_POST['group'] : 'ninguno'; ?>
        <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ]">
            <?php $args = array(
                'posts_per_page'   => $page_size * $resources_page,
                'category'         => '',
                'category_name'    => '',
                'orderby'          => $order,
                'order'            => 'DESC',
                'post_type'        => 'resource',
                'post_status'      => 'publish',
                'suppress_filters' => true
            );

            if ( $search && $search != '' ) {
                $args['s']          = $search;
            }

            if ( $user_profiles && $user_profiles != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'user_profiles',
                        'field'     => 'slug',
                        'terms'     => $user_profiles
                    )
                );
            }

            if ( $data_driven_classification && $data_driven_classification != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'data_driven_classification',
                        'field'     => 'slug',
                        'terms'     => $data_driven_classification
                    )
                );
            }

            if ( $themes_and_topics && $themes_and_topics != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'themes_and_topics',
                        'field'     => 'slug',
                        'terms'     => $themes_and_topics
                    )
                );
            }

            if ( $reference_type && $reference_type != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'reference_type',
                        'field'     => 'slug',
                        'terms'     => $reference_type
                    )
                );
            }

            if ( $territories && $territories != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'territories',
                        'field'     => 'slug',
                        'terms'     => $territories
                    )
                );
            }

            if ( $principle && $principle != '' ) {
                $args['tax_query']  = array(
                    array(
                        'taxonomy'  => 'principles',
                        'field'     => 'slug',
                        'terms'     => $principle
                    )
                );
            }

            $posts_array = query_posts( $args );
            if ( !empty($posts_array) ) :
                $i  = j;
                foreach ( $posts_array as  $post ) :
                    setup_postdata( $post );
                    $meta           = get_post_meta( $post->ID, '_open_contribution_meta', true );
                    $upcoming       = get_post_meta( $post->ID, 'meta-upcoming', true );
                    $class_contri   = $meta == 'yes' ?  $meta.'-contribution ' : 'no-contribution ';
                    $class_contri   .= $upcoming == 'yes' ? 'upcoming-resource ' : '';
                    $resource_info  = get_resource_info( $post->ID );
                    $resource_filter_classes = $class_contri;
                    foreach ( $resource_info as $key => $value ) :
                        $resource_filter_classes .= $value . ' ';
                    endforeach;?>
                    <div class="[ column-4_12 sc_column_item ][ resource-result ][ <?php echo $resource_filter_classes; ?>]">
                        <div class="inner <?php echo ($upcoming == 'yes' ? 'upcoming-bg' : ''); ?>">
                            <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => '[ wp-post-image ]' ) ); ?></a>
                            <h4 class="[ post__title ]">
                                <a href="<?php echo the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                <div class="resource-date"><?php echo get_the_date('M.j.Y'); ?></div>
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
                            <span class="upcoming-tag">Coming<br />soon</span>
                        </div>
                    </div>
                    <?php if ( ++$j % 3 == 0 ) : ?>
                        </article>
                        <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ]">
                    <?php endif; ?>
                <?php endforeach; ?>
                <p class="load-more"><a href="<?php echo site_url('/resource-centre-results/?resources_page=' . ++$resources_page); ?>">View More</a></p>
            <?php endif; ?>
        </article>
    </section>
</section>
<?php get_footer(); ?>
