<div class="popularArtciles">
  <p class="popularArtciles__title">Популярные статьи по теме:</p>
  <div class="popularArtciles__list">
      <?php
      global $post; // не обязательно
      $tags = get_tags( $args );
      $tag = $tags[0] -> slug;

      // 5 записей из рубрики 9
      $myposts = get_posts( array(
        'post_type' => 'articles',
        'tag' => $tag,
      ) );

      foreach( $myposts as $post ):
        setup_postdata( $post ); ?>
        <article class="popularArtciles__item">
          <div class="popularArtciles__meta">
            <div class="popularArtciles__tags">
              <div class="tags">
                <?php get_template_part( 'tags') ?>
              </div>
            </div>
            <p class="popularArtciles__info"><span>Опубликовано: <?php echo get_the_date('d.m.Y'); ?></span> <span>Просмотрено: <?php if(function_exists('the_views')) { the_views(); } ?></span></p>
          </div><a class="popularArtciles__tail" href="<?php the_permalink() ?>">
            <p class="popularArtciles__caption"><?php the_title() ?></p>
            <p class="popularArtciles__excerpt"><?php echo get_the_excerpt() ?></p></a>
        </article>
      <?php
      endforeach;

      wp_reset_postdata(); // сбрасываем переменную $post
      ?>
  </div>
</div>