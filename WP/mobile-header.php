<section class="mobile">
  <header class="mobileHeader">
    <div class="mobileHeader__inner">
      <div class="mobileHeader__socials">
        <nav class="socials"><a class="socials__item socials__item--whatsapp" href=""></a><a class="socials__item socials__item--viber" href=""></a></nav>
      </div><a class="mobileHeader__link mobileHeader__link--phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a><a class="mobileHeader__link mobileHeader__link--email" href="mailtop:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
    </div>
  </header>
  <nav class="mobileNav">
    <button class="mobileNav__search"></button><a class="mobileNav__logo logo" href="/"><?php get_template_part( 'logo-top') ?></a>
    <button class="mobileNav__burger"></button>
    <section class="mobileNav__menu mobileMenu">
      <div class="mobileMenu__inner">
        <p class="mobileMenu__title">Меню</p>
        <button class="mobileMenu__close"></button>
        <?php wp_nav_menu( array('menu' => 'Главное меню', 'container' => false , 'menu_class' => 'menu__list')); ?>
        <div class="mobileMenu__socials">
          <nav class="socials"><a class="socials__item socials__item--instagram" href=""></a><a class="socials__item socials__item--whatsapp" href=""></a><a class="socials__item socials__item--viber" href=""></a></nav>
        </div><a class="mobileMenu__address" href=""><?php the_field('address', 'option'); ?></a><a class="mobileMenu__email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a><a class="mobileMenu__phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a>
        <button class="mobileMenu__openpopup js-openpopup" data-popup-id="callback">Заказать звонок</button>
      </div>
    </section>
  </nav>
</section>