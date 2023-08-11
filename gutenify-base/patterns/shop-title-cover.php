<?php
 /**
  * Title: Shop Title Cover
  * Slug: gutenify-base/cover-with-shop-title
  * Categories: gutenify-base
  */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() );?>/images/inner-banner.jpg","id":766,"dimRatio":50,"overlayColor":"black","focalPoint":{"x":0.47,"y":0.65},"minHeight":274,"minHeightUnit":"px","isDark":false,"align":"full"} -->
<div class="wp-block-cover alignfull is-light" style="min-height:274px"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span><img class="wp-block-cover__image-background wp-image-766" alt="" src="<?php echo esc_url( get_template_directory_uri() );?>/images/inner-banner.jpg" style="object-position:47% 65%" data-object-fit="cover" data-object-position="47% 65%"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"background"} -->
<h1 class="wp-block-heading has-text-align-center has-background-color has-text-color"><?php echo esc_html__( 'Shop', 'gutenify-base' ); ?></h1>
<!-- /wp:heading --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->