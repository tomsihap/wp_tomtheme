<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
                From the Firehose
            </h3>
            

            <?php if ( have_posts() ) : /* S'il y a des articles */ ?> 
                <?php while ( have_posts() ) : the_post(); /* Tant qu'il y a des articles : j'instancie le pointeur d'articles (the_post()) sur le post en question */ ?>
                    <div class="blog-post">
                    
                        <h2 class="blog-post-title"><?php the_shortlink(get_the_title()); ?></a></h2>
                        <p class="blog-post-meta">Le <?php the_date(); ?> par <a href="#"><?php the_author(); ?></a></p>

                        <p><?php echo get_the_excerpt(); ?></p>
                    </div><!-- /.blog-post -->
                <?php endwhile; ?>
            <?php endif; ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php get_sidebar(); ?>

    </div><!-- /.row -->

</main><!-- /.container -->