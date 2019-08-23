<?php
/*
Template Name: Главная
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>    
      
      <?php wp_enqueue_script( 'slick' ); ?>
      <?php wp_enqueue_script( 'lightgallery' ); ?>
      <?php wp_enqueue_style( 'slick' ); ?>
      <?php wp_enqueue_style( 'lightgallery' ); ?>

      <div class="main main--index">
        <section class="slider">
          <article class="slider__item" style="background-image:url(<?php echo $get_theme_file_uri ?>/img/slide-1.png)">
            <div class="slider__item-inner">
              <div class="slider__item-content">
                <h1>Полноценное проектирование и разработка всех визуальных элементов компании от</h1><img src="<?php echo $get_theme_file_uri ?>/img/logo2.png" alt="">
                <ul>
                  <li>Разработка фирменного стиля</li>
                  <li>Разработка брендбука</li>
                  <li>Дизайн любой продукции</li>
                  <li>Подбор фирменных цветов</li>
                </ul><a class="btn btn--shadow" href="">Перейти в раздел</a><a class="pdfLink" href="">Презентация нашей компании&nbsp;<small class="fileType">.pdf</small></a>
              </div>
            </div>
          </article>
        </section>
        <section class="servicesMain">
          <div class="container">
            <article class="servicesMain__inner">
              <h2 class="servicesMain__title"><?php the_field('caption'); ?></h2>
              <p class="servicesMain__subtitle"><?php the_field('subcaption'); ?></p>
              <section class="servicesMain__box">
                <?php get_template_part( 'servicesmenu') ?>
              </section>
              <?php echo do_shortcode('[contact-form-7 id="5" title="Главная (под услугами)" html_class="servicesMain__form form form--horizontal"]'); ?>
            </article>
          </div>
        </section>
        <section class="portfolioMain">
          <div class="container">
            <article class="portfolioMain__inner">
              <h2 class="portfolioMain__title">Портфолио</h2>
              <ul class="portfolioMain__list">
                <?php 
                $picsString = trim(get_field('pics'));
                $picsArr = explode("|", $picsString);
                array_pop($picsArr);

                foreach ($picsArr as &$item) : ?> 
                    <li class="portfolioMain__item" data-src="<?php echo $item ?>"><img src="<?php echo $item ?>" alt=""></li>
                <?php endforeach; ?>
              </ul>
            </article>
          </div>
        </section>
        <script>
          $(function() {
           $('.portfolioMain__list').slick({
             slidesToShow: 4,
             slidesToScroll: 1,
             responsive: [{
               breakpoint: 992,
               settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1
               }
             }]
           })
           $('.clientsMain__list').slick({
             slidesToShow: 5,
             slidesToScroll: 1,
             responsive: [{
                 breakpoint: 992,
                 settings: {
                   slidesToShow: 3,
                   slidesToScroll: 3
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
           $('.slider').slick({
             dots: true
           })
           $('.opinionMain__list').slick({
             slidesToShow: 4,
             slidesToScroll: 1,
             responsive: [{
                 breakpoint: 992,
                 settings: {
                   slidesToShow: 2,
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
           $('.portfolioMain__list').lightGallery({ selector: '.portfolioMain__item' })
          });
        </script>
        <div class="clientsMain">
          <div class="container">
            <div class="clientsMain__inner">
              <h2 class="clientsMain__title">Наши клиенты</h2>
              <ul class="clientsMain__list">
                <?php 
                $picsString = trim(get_field('logos'));
                $picsArr = explode("|", $picsString);
                array_pop($picsArr);

                foreach ($picsArr as &$item) : ?> 
                    <li class="clientsMain__item"><img src="<?php echo $item ?>" alt=""></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
        <section class="orderMain">
          <div class="container">
            <article class="orderMain__inner">
              <h2 class="orderMain__title">Получите бесплатную консультацию специалиста</h2>
              <p class="orderMain__text">Заполните форму и наш специалист свяжется с Вами и ответит на все интересующие вопросы</p>
              <?php echo do_shortcode('[contact-form-7 id="753" title="Главная (под клиентами)" html_class="orderMain__form form"]'); ?>
            </article>
          </div>
        </section>
        <section class="advantagesMain">
          <div class="container">
            <div class="advantagesMain__inner">
              <article class="advantagesMain__top">
                <h2 class="advantagesMain__title"><?php the_field('title'); ?></h2>
                <ul class="advantagesMain__list">
                  <?php
                  if( have_rows('list') ):
                      while ( have_rows('list') ) : the_row();?>
                        <li class="advantagesMain__item" style="background-image: url(<?php the_sub_field('icon'); ?>)"><?php the_sub_field('advtext'); ?></li>
                   <?php endwhile;
                  endif;
                  ?>
                </ul>
              </article>
              <article class="advantagesMain__bottom">
                <h2 class="advantagesMain__title"><?php the_field('joinustitle'); ?></h2>
                <?php the_field('joinustext'); ?>
              </article>
            </div>
          </div>
        </section>
        <section class="opinionMain">
          <div class="container">
            <article class="opinionMain__inner">
              <h2 class="opinionMain__title"><?php the_field('articlestitle'); ?></h2>
              <p class="opinionMain__subtitle"><?php the_field('articlessubtitle'); ?></p>
              <div class="opinionMain__list">
                <?php $posts = get_field('articles'); ?>
                <?php foreach( $posts as $post):  ?>
                  <?php setup_postdata($post); ?>
                  <div class="opinionMain__item" style="background-image: url(<?php echo get_the_post_thumbnail_url()  ?>)">
                    <div class="opinionMain__info">
                      <div class="opinionMain__tags">
                        <?php get_template_part( 'tags') ?>
                      </div>
                      <a href="<?php the_permalink() ?>" class="opinionMain__theme"><?php the_title() ?></a>
                    </div>
                  </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata();?></div>
            </article>
          </div>
        </section>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
        <?php wp_enqueue_script( 'map' ); ?>
        <section class="contactsMain">
          <div class="container">
            <article class="contactsMain__inner">
              <h2 class="contactsMain__title"><?php the_field('contactstitle'); ?></h2>
              <p class="contactsMain__subtitle"><?php the_field('contactstext'); ?></p>
              <div class="contactsMain__box">
                <section class="contactsMain__map" id="map" style="width:100%;"></section>
                <section class="contactsMain__info">
                  <div class="contactsMain__company">
                    <p class="contactsMain__name"><?php the_field('company', 'option'); ?></p>
                    <p class="contactsMain__address">г. <?php the_field('city', 'option'); ?>, <?php the_field('address', 'option'); ?></p>
                    <p class="contactsMain__hours"><?php the_field('hours', 'option'); ?></p>
                  </div>
                  <div class="contactsMain__contacts"><a class="contactsMain__phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a><a class="contactsMain__email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></div>
                </section>
              </div>
            </article>
          </div>
        </section>
      </div>

<?php get_footer(); ?>