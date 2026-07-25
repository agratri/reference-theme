<?php

$offcanvas_gallery = get_theme_mod('offcanvas_gallery');
$offcanvas_info = get_theme_mod('offcanvas_info');
$offcanvas_title = get_theme_mod('offcanvas_title',__('Hello There!','kindaid'));
$offcanvas_desc = get_theme_mod('offcanvas_desc',__('Lorem ipsum dolor sit amet, consect etur adipiscing elit.','kindaid'));


// var_dump($offcanvas_gallery);

?>
  
  <!-- tp-offcanvas start -->
   <div class="tp-offcanvas">
      <div class="tp-offcanvas-header mb-50">
         <div class="tp-offcanvas-logo">
            <?php kindaid_offcanvas_logo(); ?>
         </div>
         <div class="tp-offcanvas-close">
            <button class="tp-offcanvas-close-button"><i class="fal fa-times"></i></button>
         </div>
      </div>
      <div class="tp-offcanvas-menu mb-50">
         <nav> 

         </nav>
      </div>
      <?php if(!empty($offcanvas_title)): ?>
      <div class="tp-offcanvas-content mb-40">
         <h3 class="tp-offcanvas-title"> <?php echo esc_html($offcanvas_title); ?></h3>

         <?php if(!empty($offcanvas_desc)): ?>   
         <p><?php echo esc_html($offcanvas_desc); ?> </p>
         <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if(!empty($offcanvas_gallery)): ?>
      <div class="tp-offcanvas-gallery mb-50">
         <?php foreach($offcanvas_gallery as $item): ?>    
         <a class="popup-image" href="<?php echo esc_url($item['offcanvas_image']); ?>"><img src="<?php echo esc_url($item['offcanvas_image']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if(!empty($offcanvas_info)): ?>
      <div class="tp-offcanvas-info mb-50">
         <h3 class="tp-offcanvas-title"><?php echo esc_html__('Information','kindaid'); ?></h3>
         <?php foreach($offcanvas_info as $item): ?> 
         <span><a href="<?php echo esc_url($item['offcanvas_info_url']); ?>"><?php echo esc_html($item['offcanvas_info_name']); ?></a></span>
         <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div class="tp-offcanvas-social">
         <h3 class="tp-offcanvas-title"> <?php echo esc_html__('Follow Us','kindaid'); ?> </h3>
         <?php kindaid_social(); ?>
      </div>
   </div>
   <div class="tp-offcanvas-overlay"></div>
   <!-- tp-offcanvas end -->