<aside class="popup popup--callback" id="callback">
  <table class="popup__wrapper">
    <tr>
      <td class="popup__container">
        <div class="popup__inner">
          <button class="popup__close"></button>
          <p class="popup__title">Оставить заявку</p>
          <?php echo do_shortcode('[contact-form-7 id="750" title="Попап - Обратный звонок" html_class="popup__form form form--popup"]'); ?>
        </div>
      </td>
    </tr>
  </table>
</aside>
<aside class="popup popup--callback" id="order">
  <table class="popup__wrapper">
    <tr>
      <td class="popup__container">
        <div class="popup__inner">
          <button class="popup__close"></button>
          <p class="popup__title">Заказать звонок</p>
          <?php echo do_shortcode('[contact-form-7 id="751" title="Попап - Заказ" html_class="popup__form form form--popup"]'); ?>
        </div>
      </td>
    </tr>
  </table>
</aside>
<aside class="popup popup--review" id="review">
  <table class="popup__wrapper">
    <tr>
      <td class="popup__container">
        <div class="popup__inner">
          <button class="popup__close"></button>
          <p class="popup__title">Оставить отзыв</p>
          <?php echo do_shortcode('[contact-form-7 id="752" title="Попап - Новый отзыв" html_class="popup__form form form--popup"]'); ?>
        </div>
      </td>
    </tr>
  </table>
</aside>