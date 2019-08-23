<?php
/*
Template Name: Карта сайта
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>    
      <?php wp_enqueue_script( 'slick' ); ?>
      <?php wp_enqueue_style( 'slick' ); ?>
      <article class="main main--services">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content"><a class="main__back" href="/">Назад</a>
              <div class="main__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="main__title"><?php the_title() ?></h1>
              <div class="content">
                <div class="sitemap"><?php wp_nav_menu( array('menu' => 'Карта сайта', 'container' => false )); ?></div>
              </div>
            </div>
            <aside class="main__sidebar">
              <?php get_template_part( 'slideshow') ?>
            </aside>
          </section>
        </div>
      </article>

<?php get_footer(); ?>