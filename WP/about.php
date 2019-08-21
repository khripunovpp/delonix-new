<?php
/*
Template Name: О нас
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>    
<?php wp_enqueue_script( 'slick' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
      <article class="main main--article">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content"><a class="main__back" href="/">Назад</a>
              <div class="main__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="main__title"><?php the_title() ?></h1>
              <div class="content">
                <?php the_content() ?>
              </div>
              <section class="main__reviews reviews">
                <p class="reviews__title">«Что говорят наши клиенты»</p>
                <button class="reviews__addnew js-openpopup" data-popup-id="review">Оставить отзыв</button>
                <div class="reviews__list">
                  <?php
                  if( have_rows('reviews') ):
                      $i = 0;
                      while ( have_rows('reviews') ) : the_row();
                        $i++; ?>
                        <article class="reviews__item">
                          <p class="reviews__company"><?php the_sub_field('company'); ?></p>
                          <p class="reviews__name"><?php the_sub_field('name'); ?></p>
                          <div class="reviews__text"> 
                           <?php the_sub_field('text'); ?>
                          </div>
                          <p class="reviews__date">Опубликовано: <?php the_sub_field('date'); ?></p>
                        </article>
                   <?php endwhile;
                  endif;
                  ?>
                </div>
                <div class="reviews__hidden">
                  <?php
                  if( have_rows('reviews') ):
                     $j = 0;
                      while ( have_rows('reviews') ) : the_row(); ?>
                        <article class="reviews__item">
                          <p class="reviews__company"><?php the_sub_field('company'); ?></p>
                          <p class="reviews__name"><?php the_sub_field('name'); ?></p>
                          <div class="reviews__text"> 
                           <?php the_sub_field('text'); ?>
                          </div>
                          <p class="reviews__date">Опубликовано: <?php the_sub_field('date'); ?></p>
                        </article>
                   <?php endwhile;
                  endif;
                  ?>
                </div>
                <!-- <button class="reviews__more">Загрузить еще</button> -->
              </section>
              <section class="requisites">
                <div class="requisites__wrapper">
                  <div class="requisites__table">
                    <?php the_field('reqs') ?>
                    </div>
                </div>
                <div class="requisites__disclamer"><?php the_field('reqssub') ?></div>
              </section>
            </div>
            <aside class="main__sidebar">
              <p class="main__sideTitle">Наши услуги</p>
              <?php get_template_part( 'servicesmenu') ?>
              <?php get_template_part( 'lastarticles') ?>
              <?php get_template_part( 'slideshow') ?>
            </aside>
          </section>
        </div>
      </article>
<?php endwhile; ?>
<?php get_footer(); ?>