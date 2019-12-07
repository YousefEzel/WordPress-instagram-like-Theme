<!DOCTYPE html>
<html <?php  language_attributes(); ?>>
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >

    <nav class="navbar navbar-expand-lg navbar-bg navbar-light indigo">
      <div class="container" style="max-width: 70%;">
        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
          <i class="fab fa-instagram" style="font-size: 1.7rem; "></i> 
            <?php  
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            if ( has_custom_logo() ) {
                    echo '<img class="logo-img" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
            ?>
            <style type="text/css">
              i.fa-instagram{
                font-size: 1.7rem; 
                border-right: 2px solid black; 
                padding-right: 10px;
              }
            </style>
            <?php } ?>

        </a>
        <!-- Search form -->
        <div class="d-flex flex-row-reverse">
          <div class="active-pink-4">
            <i class="fas fa-search search-shit"></i>
            <input class="form-control search-form" type="text" placeholder="     Search" aria-label="Search">
          </div>
        </div>

          <?php wp_nav_menu( array(
            'theme_location'  => 'Primary',
            'menu'            => 'Primary Menu',
            'container'       => 'div',
            'container_class' => 'Menu-container d-flex flex-row-reverse ',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '<span class="text-link"><span style="display:none;">',// between <a>'Text' </a>
            'link_after'      => '</span></span>',
            'items_wrap'      => '<ul id = "navbar-setup" class = "%2$s navbar-nav">%3$s</ul>',
            'depth'           => 0,
            'walker'          => '',
          ) ); 


          ?>

      </div>
    </nav>