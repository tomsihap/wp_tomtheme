

    <div class="row mb-2">
        <?php

        $original_query = $wp_query;
        $wp_query = null;

        $args=array('posts_per_page'=>2, 'tag' => 'highlight');
        $wp_query = new WP_Query( $args );
        if ( have_posts() ) :
            while (have_posts()) : the_post(); ?>

                <div class="col-md-6">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary"><?php the_category(' '); ?></strong>
                                <h3 class="mb-0">
                                    <a class="text-dark" href="#"><?php the_title();?></a>
                                </h3>
                                <div class="mb-1 text-muted"><?php the_date(); ?></div>
                                <p class="card-text mb-auto"><?php echo strlen(get_the_excerpt()) > 50 ? substr(get_the_excerpt(), 0, 50) . '...' : get_the_excerpt(); ?></p>
                                <?php the_shortlink('Lire plus'); ?>
                            </div>
                            <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
                        </div>
                    </div>
        <?php  endwhile;
        endif;

        $wp_query = null;
        $wp_query = $original_query;
        wp_reset_postdata();
        ?>

    </div> <!-- /div.row mb-2 -->
</div> <!-- /div.container de header.php -->