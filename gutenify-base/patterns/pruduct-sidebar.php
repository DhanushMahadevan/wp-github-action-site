<?php
 /**
  * Title: Product Sidebar
  * Slug: gutenify-base/product-sidebar
  * Categories: gutenify-base-sidebar
  */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"backgroundColor":"background","textColor":"foreground","className":"has-no-hover-shadow-dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-no-hover-shadow-dark has-foreground-color has-background-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:woocommerce/filter-wrapper {"filterType":"price-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( 'Filter by price', 'gutenify-base' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/price-filter {"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-price-filter is-loading" data-showinputfields="true" data-showfilterbutton="false" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-categories__placeholder"></span></div>
<!-- /wp:woocommerce/price-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->

<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:heading {"level":3,"align":"wide","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading alignwide has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( 'Categories', 'gutenify-base' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-categories {"style":{"typography":{"lineHeight":"2.4"}}} /--></div>
<!-- /wp:group -->

<!-- wp:woocommerce/filter-wrapper {"filterType":"active-filters"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( 'Active filters', 'gutenify-base' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/active-filters {"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-active-filters is-loading" data-display-style="list" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-active-filters__placeholder"></span></div>
<!-- /wp:woocommerce/active-filters --></div>
<!-- /wp:woocommerce/filter-wrapper -->

<!-- wp:woocommerce/filter-wrapper {"filterType":"stock-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( '', 'gutenify-base' ); ?>Filter by stock status</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/stock-filter {"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-stock-filter is-loading" data-show-counts="true" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-stock-filter__placeholder"></span></div>
<!-- /wp:woocommerce/stock-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->

<!-- wp:woocommerce/filter-wrapper {"filterType":"attribute-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( 'Filter by attribute', 'gutenify-base' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/attribute-filter {"heading":"","lock":{"remove":true}} -->
<div class="wp-block-woocommerce-attribute-filter is-loading" data-attribute-id="0" data-show-counts="true" data-query-type="or" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-attribute-filter__placeholder"></span></div>
<!-- /wp:woocommerce/attribute-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->

<!-- wp:woocommerce/filter-wrapper {"filterType":"rating-filter"} -->
<div class="wp-block-woocommerce-filter-wrapper"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
<h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php echo esc_html__( 'Filter by rating', 'gutenify-base' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/rating-filter {"lock":{"remove":true}} -->
<div class="wp-block-woocommerce-rating-filter is-loading" data-show-counts="true"><span aria-hidden="true" class="wc-block-product-rating-filter__placeholder"></span></div>
<!-- /wp:woocommerce/rating-filter --></div>
<!-- /wp:woocommerce/filter-wrapper -->

<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:query {"queryId":0,"query":{"perPage":"5","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"__woocommerceStockStatus":["instock","outofstock","onbackorder"]},"displayLayout":{"type":"list","columns":2},"namespace":"woocommerce/product-query"} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:columns {"isStackedOnMobile":false} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:woocommerce/product-image {"showSaleBadge":false,"isDescendentOfQueryLoop":true} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%","layout":{"type":"default"}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.75rem","top":"0"}}},"__woocommerceNamespace":"woocommerce/product-query/product-title"} /-->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"style":{"spacing":{"margin":{"bottom":"0.75rem","top":"0"}}}} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->