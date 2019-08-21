<?php
/*
Template Name: Контакты
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>
<?php while ( have_posts() ) : the_post(); ?>
      <article class="main main--contacts">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content">
              <div class="main__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="main__title"><?php the_title(); ?></h1>
              <div class="content">
                <div class="contacts">
                  <p class="contacts__text">Мы всегда рады поделиться своим опытом лично. <br>Ниже контакты, по которым вы можете с нами связаться.</p>
                  <p class="contacts__address">г. <?php the_field('city', 'option'); ?>, <?php the_field('address', 'option'); ?></p><a class="contacts__phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a>
                  <div class="contacts__socials">
                    <?php get_template_part( 'socials') ?>
                  </div><a class="contacts__email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
                  <div class="contacts__location">
                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
                    <?php wp_enqueue_script( 'map' ); ?>
                    <div class="contacts__map" id="map"></div>
                    <div class="contacts__form contactsForm">
                      <h2 class="contactsForm__title">Получите бесплатную консультацию специалиста</h2>
                      <p class="contactsForm__text">Заполните форму и наш специалист свяжется с Вами и ответит на все интересующие вопросы</p>
                      <section class="contactsForm__form form">
                        <input class="form__field" type="text" placeholder="Имя">
                        <input class="form__field" type="text" placeholder="+7 (___) ___-__-__" name="phone">
                        <button class="form__submit btn" type="submit">Заказать звонок</button>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </article>
<?php endwhile; ?>
<?php get_footer(); ?>