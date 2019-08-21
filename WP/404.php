<?php
/*
Template Name: 404
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>
      <article class="main main--404">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content">
              <div class="notFound">
                <div class="notFound__error">
                  <div class="notFound__num">404</div>
                  <div class="notFound__sign">Страница не найдена</div>
                </div>
                <div class="notFound__search">
                  <input class="notFound__field" type="text" value="Печатают ли широкоформатные принтеры пантонами?">
                  <button class="notFound__submit">Найти</button>
                </div>
              </div>
            </div>
          </section>
        </div>
      </article>
<?php get_footer(); ?>