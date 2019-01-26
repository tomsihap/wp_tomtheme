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
