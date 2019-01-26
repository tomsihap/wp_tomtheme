This repository is a tutorial on how to create a Wordpress theme from the Bootstrap example "Blog".
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
> Documentation de style.css : https://developer.wordpress.org/themes/basics/main-stylesheet-style-css/

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