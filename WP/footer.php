      <footer class="footer">
        <div class="container">
          <div class="footer__inner">
            <section class="footer__contacts">
              <p><?php the_field('company', 'option'); ?></p>
              <p><?php the_field('address', 'option'); ?></p>
              <p><?php the_field('hours', 'option'); ?></p><a class="footer__email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
              <div class="footer__phones">
                <div class="footer__socials">
                  <?php get_template_part( 'socials') ?>
                </div><a class="footer__phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a>
              </div>
            </section>
            <section class="footer__links">
              <?php wp_nav_menu( array('menu' => 'Главное меню', 'container' => false , 'menu_class' => 'menu__list')); ?>
            </section><a class="footer__sitemap" href="">Карта сайта</a><small class="footer__copyright"><span class="footer__name">© Delonix 2016	</span>по всем вопросам работы сайта обращаться <a href="">its@delonix.su</a></small>
          </div>
        </div>
      </footer>
    </div>
    <script>
      document.addEventListener('wpcf7mailsent', function(event) {
        var inputs = event.detail.inputs;
        for (var i = 0; i < inputs.length; i++) {
            if ('formslug' == inputs[i].name) {
              yaCounter<?php echo $all_options['yametrikaid']; ?>.reachGoal(inputs[i].value);
              ga('send', 'event', inputs[i].value, 'send');
              break;
            }
        }
      }, false);
    </script>
    <?php wp_footer(); ?>
  </body>
</html>
