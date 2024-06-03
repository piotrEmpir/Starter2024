<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="oh">

<header class="header is-layout-constrained">
	<div class="alignfull">
		<a href="<?php echo home_url(); ?>" class="logo" title="<?php echo get_bloginfo('name'); ?>">
			<svg id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1">
                    <defs>
                        <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">
                            <stop id="stop1" stop-color="rgba(55, 244.186, 248, 1)" offset="0%"></stop>
                            <stop id="stop2" stop-color="rgba(31, 143.549, 251, 1)" offset="100%"></stop>
                        </linearGradient>
                    </defs>
                <path fill="url(#sw-gradient)" d="M18.9,-33.3C23.8,-29.8,26.8,-23.5,31.4,-17.5C36,-11.5,42.3,-5.7,43.4,0.6C44.4,6.9,40.3,13.9,36.1,20.7C31.9,27.5,27.7,34.1,21.7,36.8C15.7,39.4,7.8,38.2,1,36.5C-5.9,34.8,-11.8,32.7,-16.9,29.5C-22,26.3,-26.3,22,-28.5,16.9C-30.8,11.8,-30.9,5.9,-32.9,-1.1C-34.9,-8.2,-38.7,-16.4,-37.3,-22.8C-35.8,-29.2,-29,-33.8,-21.9,-36.1C-14.8,-38.3,-7.4,-38.2,-0.2,-37.9C6.9,-37.5,13.9,-36.8,18.9,-33.3Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)"></path>
              </svg>
		</a>


		<button class="menu-open" aria-expanded="false">
			<span class="label"><?php echo __('Menu', 'wbdvpl');?></span>
			<span class="ico"><i></i></span>
		</button>


		<div class="nav-wrap">
			<?php
				wp_nav_menu( array(
					'container'         => 'nav',
					'theme_location'    => 'primary',
					'walker'         => new WBDV_Custom_Walker_Nav_Menu(),
				) );
			?>

			<?php if ( is_active_sidebar( 'header' ) ) : ?>
				<?php dynamic_sidebar( 'header' ); ?>
			<?php endif; ?>

			<button class="menu-close" aria-expanded="false">
				<span class="label"><?php echo __('Close', 'wbdvpl');?></span>
				<span class="ico"><i></i></span>
			</button>
		</div>

	</div>
</header>
