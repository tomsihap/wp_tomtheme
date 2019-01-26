<?php


$original_query = $wp_query;
$wp_query = null;

$args=array('posts_per_page'=>1, 'tag' => 'featured');
$wp_query = new WP_Query( $args );
if ( have_posts() ) :
    while (have_posts()) : the_post(); ?>
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
          <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic"><?php the_title(); ?></h1>
            <p class="lead my-3"><?php echo get_the_excerpt(); ?></p>
            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold"><?php the_shortlink('Lire plus...'); ?></a></p>
          </div>
        </div>
<?php  endwhile;
endif;

$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();
?>

