<?php 
$get_theme_file_uri = get_theme_file_uri();
?>

<!DOCTYPE html>
<html>
  <head>
    <base href="<?php echo site_url() ?>">
    <meta charset="utf-8">
    <title><?php the_title() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?php echo $get_theme_file_uri ?>/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,800,900">
    <?php wp_head(); ?>
  </head>
  <body>
    <?php get_template_part( 'popups' ) ?>
    <div class="w-page">
      <section class="search">
        <div class="search__inner">
          <p class="search__title">Поиск</p>
          <button class="search__close"></button>
          <div class="search__field">
            <input type="search" placeholder="Искать">
          </div>
        </div>
      </section>
      <?php get_template_part( 'mobile-header') ?>
      <header class="header">
        <div class="header__main">
          <div class="container">
            <div class="header__inner"><a class="header__logo logo" href="/"><?php get_template_part( 'logo-top') ?></a>
              <div class="header__top">
                <p class="header__address">г. <?php the_field('city', 'option'); ?>, <?php the_field('address', 'option'); ?><a class="header__email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></p>
                <div class="header__contacts"><a class="header__phone" href="tel:<?php the_field('phone', 'option'); ?>"><?php the_field('phone', 'option'); ?></a>
                  <button class="header__openpopup js-openpopup" data-popup-id="callback">Заказать звонок</button>
                </div>
              </div>
              <div class="header__bottom">
                <nav class="header__nav">
                  <?php wp_nav_menu( array('menu' => 'Главное меню', 'container' => false)); ?>
                </nav>
                <button class="header__search"></button>
                <nav class="header__socials">
                  <?php get_template_part( 'socials') ?>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <section class="header__services">
          <div class="container">
            <?php get_template_part( 'servicesmenu') ?>
          </div>
        </section>
      </header>