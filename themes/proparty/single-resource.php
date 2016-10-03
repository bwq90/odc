<?php
    global $post;
    get_header();
?>
    <div class="content_wrap resource-article">
        <div class="content">
            <article class="itemscope post_item post_item_single post_featured_default post_format_standard post-3356 resource type-resource status-publish has-post-thumbnail hentry language-espanol sector-anticorruption sector-agriculture country-usa country-france country-guatemala resource_type-platforms resource_type-graphics working_group-private-sector working_group-accountability" itemscope="" itemtype="http://schema.org/Article">
                <section class="post_featured">
                    <div class="post_thumb" data-title="<?php echo get_the_title(); ?>">
                        <?php the_post_thumbnail( 'medium', array( 'class' => '[ wp-post-image ]' ) ); ?>
                    </div>
                </section>
                <section class="post_content" itemprop="articleBody">
                    <h1><?php the_title(); ?></h1>
                    <p class="resource-post-author">by <?php echo get_post_meta( get_the_ID(), 'meta-author', true ); ?></p>
                    <?php the_content(); ?>
                    <a href="<?php echo get_post_meta( get_the_ID(), 'meta-link', true ); ?>" class="doc-link" target="_blank">Go to resource</a>
                    <h3>Comments</h3>
                    <?php echo do_shortcode("[js-disqus]"); ?>
                </section>
            </article>
        </div>
        <aside class="sidebar bg_tint_light sidebar_style_light resource-sidebar [ padding--small ]" role="complementary">
            <h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">Principles</h5>
            <p><?php echo get_principles( $post->ID ); ?></p>
            <h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">Type</h5>
            <p><?php echo get_reference_type( $post->ID ); ?></p>
            <h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">Themes and Topics</h5>
            <p><?php echo get_themes_and_topics( $post->ID ); ?></p>
            <h5 class="sc_title sc_title_regular sc_align_center [ no-margin ]">Date</h5>
            <p class="resource-post-date"><?php echo get_the_date(); ?></p>
            <?php $open = get_post_meta( get_the_ID(), '_open_contribution_meta', true );
            if ( $open == 'yes' ) : ?>
                <a href="<?php echo get_post_meta( get_the_ID(), 'meta-link', true ); ?>" class="doc-link" target="_blank">Comment</a>
            <?php endif; ?>
        </aside>
        <section class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ resource-centre-results__section ]">
            <section class="[ column-12_12 column sc_column_item ][ resource-centre-results__section ]">
                <?php $group_active = isset($_POST['group']) ? $_POST['group'] : 'ninguno'; ?>
                <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ]">
                    <?php
                    $query_resources = getResources($search, 3);
                    if ( ! empty($query_resources) ) :
                        $i  = 0; ?>
                        <h3 class="resources-widget-title">Similar Resources</h3>
                        <?php foreach ( $query_resources as  $post ) :
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
                                        <span class="resource-date"><?php echo get_the_date(); ?></span>
                                    </h4>
                                    <p class="resource-author">by <?php the_author(); ?></p>
                                    <div class="metadata">
                                        <div class="info">
                                            <p class="info-title">Description</p>
                                            <p class="info-data"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ) ?></p>
                                            <p class="info-link"><a href="<?php echo the_permalink(); ?>">Read more</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ( ++$i % 3 == 0 ) : ?>
                                </article>
                                <article class="[ columns_wrap sc_columns sc_columns_count_12 columns_fluid ][ posts-container ]">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </article>
            </section>
        </section>
    </div>
<?php get_footer(); ?>
