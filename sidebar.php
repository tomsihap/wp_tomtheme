<aside class="col-md-4 blog-sidebar">

    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus
            sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>

    <?php if ( is_active_sidebar( 'primary' ) ) : ?>
        <?php dynamic_sidebar( 'primary' ); ?>
    <?php endif; ?>

</aside><!-- /.blog-sidebar -->