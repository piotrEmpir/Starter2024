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
		<a href="<?php echo home_url(); ?>" class="logo">
			<?php echo get_bloginfo('name'); ?>
		</a>

		<div class="nav-wrap">
			<?php
				wp_nav_menu( array(
					'container'         => 'nav',
					'theme_location'    => 'primary'
				) );
			?>

			<?php if ( is_active_sidebar( 'header' ) ) : ?>
				<?php dynamic_sidebar( 'header' ); ?>
			<?php endif; ?>

			<button class="menu-close">
				<span class="label"><?php echo __('Close', 'wbdvpl');?></span>
				<span class="ico"><i></i></span>
			</button>
		</div>

		<button class="menu-open">
			<span class="label"><?php echo __('Menu', 'wbdvpl');?></span>
			<span class="ico"><i></i></span>
		</button>

	</div>
</header>
