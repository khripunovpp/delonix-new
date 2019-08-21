<?php
/*
Template Name: Услуга
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>    
<?php wp_enqueue_script( 'slick' ); ?>
<?php wp_enqueue_script( 'lightgallery' ); ?>
<?php wp_enqueue_style( 'slick' ); ?>
<?php wp_enqueue_style( 'lightgallery' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
      <script>
        $(function() {
          $('.wp-block-gallery').children().each(function(index, el) {
            $(this).attr('data-src', $(this).find('img').attr('src'))
          });
          $('.wp-block-image').children().each(function(index, el) {
            $(this).attr('data-src', $(this).attr('src'))
          });
          $('.form--service .form__submit, .form--collapsed .form__submit').text($('#buttonsgin').text())
          $('.wp-block-image').lightGallery()
          $('.wp-block-gallery').lightGallery()
          $('.wp-block-gallery').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            adaptiveHeight: true,
            infinite: false,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
          })
          $('.slideShow').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false
          })
        });
      </script>
      <article class="main main--article">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content"><a class="main__back" href="/">Назад</a>
              <div class="main__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="main__title"><?php the_title() ?></h1>
              <div class="main__meta">
                <p class="main__info"><span>Опубликовано: <?php the_date('d.m.Y'); ?></span> <span>Просмотрено: <?php if(function_exists('the_views')) { the_views(); } ?></span></p>
                <div class="main__tags">
                  <?php get_template_part( 'tags') ?>
                </div>
              </div>
              <div class="content">
                <?php the_content() ?>
              </div>
              <section class="main__popular">
                <?php get_template_part( 'populararticles') ?>
              </section>
            </div>
            <aside class="main__sidebar">
              <?php get_template_part( 'lastarticles') ?>
              <?php get_template_part( 'slideshow') ?>
            </aside>
          </section>
        </div>
      </article>
     <?php endwhile; ?>
<?php get_footer(); ?>
