<?php
/*
Template Name: Портфолио
*/

get_header();

$get_theme_file_uri = get_theme_file_uri();
?>    
      <?php wp_enqueue_script( 'lightgallery' ); ?>
      <?php wp_enqueue_script( 'imagesloaded' ); ?>
      <?php wp_enqueue_script( 'isotope' ); ?>
      <?php wp_enqueue_script( 'portfolio' ); ?>
      <?php wp_enqueue_style( 'lightgallery' ); ?>
      <article class="main main--portfolio">
        <div class="container">
          <section class="main__wrapper">
            <div class="main__content"><a class="main__back" href="/">Назад</a>
              <div class="main__breadcrumbs">
                <?php get_template_part( 'breadcrumbs') ?>
              </div>
              <h1 class="main__title">Портфолио</h1>
              <div class="content">
                <div class="portfolio">
                  <div class="portfolio__meta">
                    <div class="portfolio__disclamer"><?php the_field('disclamer', false, false); ?></div>
                    <div class="portfolio__filters filter"></div>
                  </div>
                  <script src="<?php echo $get_theme_file_uri ?>/js/lodash.min.js"></script>
                  <?php
                  $json = '[';
                  if( have_rows('pics') ):
                      while ( have_rows('pics') ) : the_row();

                        $picsString = trim(get_sub_field('photos'));
                        $picsArr = explode("|", $picsString);
                        array_pop($picsArr);
                        foreach ($picsArr as &$item) {
                          $json .= '{"type":"'.get_sub_field('cat').'", "link":"'.$item.'"}, ';
                        }

                      endwhile;
                  endif;
                  $json = substr($json, 0, -2);
                  $json .= ']';
                  ?>
                  <div class="portfolio__list" data-json='<?php echo $json; ?>'></div>
                  <button class="portfolio__more">Загрузить еще</button>
                </div>
              </div>
            </div>
          </section>
        </div>
      </article>

<?php get_footer(); ?>