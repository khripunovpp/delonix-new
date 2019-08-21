<div class="services">
	 <?php 
        $subMenu = wp_get_nav_menu_object('Услуги');
				$submenu = wp_get_nav_menu_items($subMenu);

				$i = 0;
				$length = count($submenu);

				foreach ($submenu as $submenuitem) : ?>
					<?php if ($submenuitem -> menu_item_parent == 0) : /*если навзание категории*/ ?>
						</ul>
						<ul>
							<li class="services__groupCaption" style="background-image: url(<?php the_field( 'icon', $submenuitem -> ID ) ?>)"><a href="<?php echo $submenuitem -> url; ?>"><?php echo $submenuitem -> title; ?></a></li>
					<?php else : ?>
							<li><a href="<?php echo $submenuitem -> url; ?>"><?php echo $submenuitem -> title; ?></a></li>
					<?php endif; ?>
				<?php $i++; endforeach; ?>
			</ul>
</div>