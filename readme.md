This repository is a tutorial on how to create a Wordpress theme from the Bootstrap v4.1 example "Blog".
This tutorial is written in French: **Feel free to contribute for a translated version !**

# Créer un thème Worpress

## Création du dossier

> Que vous copiez un thème ou créiez un thème de zéro, il va falloir créer un nouveau dossier contenant le thème en question. En effet, si vous modifiez un thème existant, les modifications seraient écrasées par une mise à jour du thème !

> Nous allons parcourir le Wordpress Theme Handbook : https://developer.wordpress.org/themes/

### Fichiers à créer au minimum :
```
- /wp-content/themes/[nomDuTheme]/index.php
- /wp-content/themes/[nomDuTheme]/style.css
```

## Projet: adapter l'exemple Bootstrap "Blog"

> Vous pouvez retrouver l'exemple au lien suivant: https://getbootstrap.com/docs/4.1/examples/blog/

### 1. Déclaration du thème dans style.css
> Documentation: [Main Stylesheet](https://developer.wordpress.org/themes/basics/main-stylesheet-style-css/)

Le thème doit être déclaré dans le header de `style.css` :
```
/*
Theme Name: Tom Theme
Theme URI: https://github.com/tomsihap/tomtheme
Author: Thomas Sihapanya
Author URI: https://tomsihap.fr
Description: This is a tutorial theme on how to create a Wordpress Theme from Bootstrap's "Blog" example
Version: 0.1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: tomtheme
Tags: one-column, two-columns, right-sidebar, flexible-header, accessibility-ready, custom-colors, custom-header, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, post-formats, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, bootstrap, bootstrap-blog
This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
```

### 2. Copie du thème et partials
> Documentation : [Template Files](https://developer.wordpress.org/themes/basics/template-files/)
> Documentation : [Partial and Miscellaneous Template Files](https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/)
Nous allons copier le thème depuis l'example Bootstrap et le découper en partials pour avoir une meilleure lisibilité fichiers par fichiers.

C'est à vous de trouver la découpe la plus pratique possible, par exemple ici :
```
- header.php    // En tête et top-menu
- partials/featured-post.php    // Post en grand en haut
- partials/highlight-posts.php  // Deux posts "featured"
- footer.php    // Pied de page
- main.php      // Contenu principal (articles)
- sidebar.php   // Menu de droite (inclus dans main.php)
```
Lien vers le commit correspondant à la découpe à l'état actuel : [fd4aa78](https://github.com/tomsihap/wp_tomtheme/commit/fd4aa78415374527a754eb0085cf994d20e6d3a3)

### 3. Importer le CSS, afficher le titre
Rien ne doit être écrit en dur dans un thème ! Nous allons utiliser les fonctions natives de Wordpress nous permettant d'importer nos assets et d'afficher le titre du blog.

#### Affichage du titre
> Documentation: [Template Tags](https://developer.wordpress.org/themes/basics/template-tags/)

On peut afficher le titre du blog dans le header et dans le titre de la page grâce à :

```html
<title>
    <?php bloginfo('name'); ?>
</title>
...
<div class="col-4 text-center">
    <a class="blog-header-logo text-dark" href="#"><?php bloginfo('name'); ?></a>
</div>
```
Par défaut, `bloginfo()` sans paramètres retournera la valeur de `bloginfo('name')`.

On va pouvoir rendre cliquable le titre pour retourner à la page d'accueil :

```php
...
<a class="blog-header-logo text-dark" href="<?php bloginfo('wpurl'); ?>"><?php bloginfo('name'); ?></a>
...
```

#### Import du CSS
> Documentation: [Including CSS & JavaScript](https://developer.wordpress.org/themes/basics/including-css-javascript/)
Nous ne pouvons pas importer le CSS directement depuis le dossier du thème: il va falloir utiliser un *hook*, afin d'importer nos thèmes au moment opportun par Wordpress.

Pour cela, nous allons créer un fichier `functions.php` à la racine du thème et le remplir ainsi : 

```php

/**
 * Fonction qui empilera nos styles
 */
function tt_enqueue_styles() {
    wp_enqueue_style( 'tt-main', get_template_directory_uri() . '/style.css');
}

/**
 * Déclanchement de tt_enqueue_styles lors du hook "wp_enqueue_styles"
 */
add_action('wp_enqueue_scripts', 'tt_enqueue_styles');
```
> Pensez à préfixer (ici "tt" pour tomtheme) vos fonctions !

Enfin, nous pouvons modifier style.css et insérer le contenu du style par défaut de l'example "Blog" (fichier complet à retrouver dans le code source de l'exemple !) :

```css
...

.blog-header {
    line-height: 1;
    border-bottom: 1px solid #e5e5e5;
}

.blog-header-logo {
    font-family: "Playfair Display", Georgia, "Times New Roman", serif;
    font-size: 2.25rem;
}
...
```

Il faudra également indiquer à Wordpress où insérer les données de header grâce à la fonction `wp_head()` à mettre *à la fin de* header.php :
```html
<head>
    ...
    <?php wp_head(); ?>
</head>
```

Enfin pour terminer avec les dépendances, n'oubliez pas de modifier `footer.php` afin d'enlever les liens relatifs et plutôt mettre des liens vers des CDN :
```html
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.6/holder.min.js" integrity="sha256-yF/YjmNnXHBdym5nuQyBNU62sCUN9Hx5awMkApzhZR0=" crossorigin="anonymous"></script>
    
```

### 4. Dynamiser le thème

Maintenant que les dépendances sont terminées, nous pouvons dynamiser le thème, c'est à dire utiliser les fonctions Wordpress afin d'afficher les données du blog !

> Avant de commencer, veillez à écrire plusieurs articles et plusieurs catégories différents, afin d'avoir du contenu à afficher. Pour rappel, l'admin panel se trouve à [url_du_wordpress]/wp-admin.
> PRO TIP : Utilisez l'extension FakerPress : générateur de faux posts !

#### Main: "The Loop"
> Documentation: [The Loop](https://developer.wordpress.org/themes/basics/the-loop/)

Commençons par le main : la partie sous "From The Firehose" qui affichera nos posts. Nous allons utiliser le principe de wordpress **The Loop** : *s'il y a des articles à afficher, et tant qu'il y a des articles, nous instantions un pointeur vers l'article pour afficher l'article*.

Dans main.php, à l'endroit où nous affichons les articles :

```php
<?php if ( have_posts() ) : /* S'il y a des articles */ ?> 
    <?php while ( have_posts() ) : the_post(); /* Tant qu'il y a des articles : j'instancie le pointeur d'articles (the_post()) sur le post en question */ ?>
        ... Display post content
    <?php endwhile; ?>
<?php endif; ?>
```

A la place de "... Display post content", nous allons modéliser **un article**. Vous pouvez donc supprimer les autres articles écrits en dur dans le fichier !

```php
<?php if ( have_posts() ) : ?> 
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="blog-post">
            <h2 class="blog-post-title"><?php the_title(); ?></h2>
            <p class="blog-post-meta">Le <?php the_date(); ?> par <a href="#"><?php the_author(); ?></a></p>

            <p><?php the_excerpt(); ?></<p>
        </div><!-- /.blog-post -->
    <?php endwhile; ?>
<?php endif; ?>
```

Le fichier est considérablement plus petit ! Grâce aux fonctions de The Loop (voir "What The Loop Can Display"), nous avons pu facilement afficher les informations des articles dans notre template.

Nous ne verrons pas la pagination ici, plusieurs façons de faire sont possibles (pages d'articles, flux infini avec AJAX...).

#### Featured Post: afficher 1 seul post en haut

Pour afficher dans "Featured Post" un seul post, nous allons faire une requête personnalisée afin de n'afficher que les articles ayant le tag "featured". Bien sûr avec ce système, un seul article ne pourra être en tag Featured.

Pour cela, nous allons mettre dans featured-post.php :

```php

$original_query = $wp_query;
$wp_query = null;

$args=array('posts_per_page'=>1, 'tag' => 'featured');
$wp_query = new WP_Query( $args );
if ( have_posts() ) :
    while (have_posts()) : the_post();
        // ... Contenu du post
    endwhile;
endif;

$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();

```

Nous créeons une sous-loop qui n'ira chercher qu'un post dans featured. Nous enregistrons la requête du Loop wordpress habituelle dans une variable avant de faire notre requête personnalisée grâce à WP_Query et $args.

Ensuite, nous affichons dans le loop (affichant 1 article, celui avec le tag "featured") le contenu du post (**ce loop est facile, à remplir par vous même !**). Enfin, nous réinitialisons les données de la requête pour retrouver le Loop qui affichera tous les articles plus bas (dans main.php).

### Highlight Posts : afficher 2 posts dans les carrés

Le principe est le même: nous ajoutons le tag "highlight" à deux articles, lesquels s'afficheront dans les 2 cadres. Voici l'exemple de ce loop (dans highlight-posts.php) :

```html
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
                                <a href="#">Lire plus</a>
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
```

### Ajout d'une sidebar

La sidebar est un élément dynamique géré par Wordpress: en effet, on doit être capable de détecter cette zone afin d'y ajouter des widgets via le back-office. Pour cela, dans `functions.php`, on déclare la zone Sidebar :

```
function tt_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div class="p-3 widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="font-italic">',
            'after_title'   => '</h4>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}
add_action( 'widgets_init', 'tt_register_sidebars' );
```

Ici, on a adapté les éléments `before/after_widget` et `before/after_title` de telle sorte que nous collions au plus près à la sidebar d'exemple !

Le fichier `sidebar.php`, auquel on enlève les faux widgets, va appeler la sidebar dynamique (nommée "primary" lors de la déclaration) :

```html
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
```

Pour tester les widgets, on peut aller dans le back-office Wordpress et ajouter à la sidebar le widget "Archives". Néanmoins la liste des mois s'affichera dans une ul/li classique (liste à points + padding), on peut éditer le style de `.widget-archive` pour corriger cela dans `style.css`: 

```css
.widget_archive > ul {
    padding: 0;
    list-style-type: none;
}
```

## 5. Gestion des pages Articles

> Documentation: [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

On va ajouter les liens dynamiques aux articles afin de rediriger vers une page d'articles.
Les pages d'articles retombent (*fallback*) vers la page `single.php` si elle existe, on va donc la créer afin d'afficher les articles.

### Ajout des liens

#### main.php
Pour ajouter le lien d'un article quand on est dans une Loop, on peut utiliser `the_shortlink()`. Il va le nom du lien en paramètre à cette fonction car par défaut, elle affiche "This is the short link." , on peut faire par exemple dans main.php :

```php
...
<h2 class="blog-post-title"><?php the_shortlink(get_the_title()); ?></a></h2>
...
```

#### featured-post.php et highlight-posts.php

Pour ces deux fichiers, on va faire de même avec le lien "Lire plus" :

```php
// featured-post.php
...
<p class="lead mb-0"><a href="#" class="text-white font-weight-bold"><?php the_shortlink('Lire plus...'); ?></a></p>
...
```

```php
// highlight-posts.php
...
<p class="card-text mb-auto"><?php echo strlen(get_the_excerpt()) > 50 ? substr(get_the_excerpt(), 0, 50) . '...' : get_the_excerpt(); ?></p>
<?php the_shortlink('Lire plus'); ?>
...
```


### Page d'article

Dans `single.php`, on va prendre le template de index.php qu'on adaptera (nous retirerons les parties *featured-post* et *highlight-posts* et la sidebar par exemple) :

```php
<?php get_header(); ?>

    <main role="main" class="container">
    <div class="row">
        <div class="col-md-12 blog-main">

            <?php if ( have_posts() ) : /* S'il y a des articles */ ?> 
                <?php while ( have_posts() ) : the_post(); /* Tant qu'il y a des articles : j'instancie le pointeur d'articles (the_post()) sur le post en question */ ?>
                    <div class="blog-post">
                    
                        <h2 class="blog-post-title"><?php the_shortlink(get_the_title()); ?></a></h2>
                        <p class="blog-post-meta">Le <?php the_date(); ?> par <a href="#"><?php the_author(); ?></a></p>

                        <p><?php echo get_the_content(); ?></p>
                    </div><!-- /.blog-post -->
                <?php endwhile; ?>
            <?php endif; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php get_footer(); ?>

```

## Autres développements

Maintenant que vous avez un thème basique qui fonctionne, vous pouvez parcourir la documentation (et Google !) pour ajouter d'autres features propres à vos besoins.