<p class="main__sideTitle">Наши статьи</p>
<section class="main__sideArtciles sideArtciles">
  <?php
  global $post; // не обязательно

  // 5 записей из рубрики 9
  $myposts = get_posts( array(
    'post_type' => 'articles'
  ) );

  foreach( $myposts as $post ):
    setup_postdata( $post ); ?>
    <article class="sideArtciles__item"><a class="sideArtciles__theme" href="<?php the_permalink() ?>"><strong><?php the_title() ?></strong> <?php echo get_the_excerpt() ?></a>
      <div class="sideArtciles__tags">
        <div class="tags">
          <?php get_template_part( 'tags') ?>
        </div>
      </div>
    </article>
  <?php
  endforeach;

  wp_reset_postdata(); // сбрасываем переменную $post
  ?>
</section>