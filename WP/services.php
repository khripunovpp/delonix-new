<?php
/*
Template Name: Услуги
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
              <h1 class="main__title">Наши услуги</h1>
              <div class="content">
                <div class="servicesPage">
                  <div class="servicesPage__list">
                    <?php get_template_part( 'servicesmenu') ?>
                  </div>
                  <div class="servicesPage__footer">
                    <div class="servicesPage__text"><?php the_field('text') ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="754" title="Услуги" html_class="servicesPage__form form form--horizontal"]'); ?>
                  </div>
                </div>
              </div>
            </div>
            <aside class="main__sidebar">
              <?php get_template_part( 'slideshow') ?>
            </aside>
          </section>
        </div>
      </article>

<?php get_footer(); ?>