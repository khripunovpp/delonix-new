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
          $('.form--service, .form--collapsed').find('.form__submit').val($('#buttonsgin').text())
          $('.form--service, .form--collapsed').find('[name="theme"]').val($('.hero__title').text())
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
          $('.hero__slider').slick({
              autoplay: true,
              autoplaySpeed: 5000,
              arrows: false,
              fade: true,
              cssEase: 'linear'
          })
        });
      </script>
      <article class="main main--service">
        <aside class="main__hero hero">
          <div id="buttonsgin" style="display: none !important"><?php the_field('buttonsign') ?></div>
          <?php echo do_shortcode('[contact-form-7 id="757" title="Страница услуг (десктоп)" html_class="hero__form form form--service"]'); ?>
          <div class="hero__slider">
            <?php 
            $picsString = trim(get_field('pics'));
            $picsArr = explode("|", $picsString);
            array_pop($picsArr);

            if($picsArr) :
              foreach ($picsArr as &$item) : ?> 
                <div class="hero__slide" style="background-image: url(<?php echo $item ?>)"></div>
              <?php endforeach; ?>
            <?php else :?>
              <div class="hero__slide hero__slide--default" style="background-image: url(<?php echo $get_theme_file_uri ?>/img/default.jpg)"></div>
            <?php endif; ?>
          </div>
          <div class="hero__container">
            <div class="hero__info">
              <div class="hero__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="hero__title"><?php the_title() ?></h1>
            </div>
          </div>
        </aside>
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content">
              <?php echo do_shortcode('[contact-form-7 id="756" title="Страница услуг (мобилка)" html_class="main__form form form--collapsed"]'); ?>
              <div class="content">
                <?php do_shortcode(the_content()) ?>
              </div>
              <section class="order">
                <article class="order__inner">
                  <p class="order__title">Оставьте заявку на услугу</p>
                  <p class="order__text">Заполните форму и наш специалист свяжется с Вами </p>
                  <?php echo do_shortcode('[contact-form-7 id="758" title="Страница услуг (нижняя)" html_class="order__form form"]'); ?>
                </article>
              </section>
            </div>
            <aside class="main__sidebar">
              <?php get_template_part( 'servicesmenu') ?>
            </aside>
          </section>
        </div>
      </article>
<?php endwhile; ?>
<?php get_footer(); ?>