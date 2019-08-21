<span class="tags">
  <?php 
  $tags = wp_get_post_tags( $post->ID );

  foreach ($tags as &$item) : ?>
    <a class="tags__item" href="<?php echo get_tag_link($item -> term_id); ?>"><?php echo $item -> name ?></a>
  <?php endforeach; ?>
</span>