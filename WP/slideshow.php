<script>
  $(function() {
    $('.slideShow').slick({
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: false
    })
  });
</script>
<div class="slideShow">
	<?php
  if( have_rows('sideslides', 'options') ):
      while ( have_rows('sideslides', 'options') ) : the_row();?>
      	<a href="<?php the_sub_field('link'); ?>" style="background-image: url(<?php the_sub_field('pic'); ?>)"></a>
   <?php endwhile;
  endif;
  ?>
</div>