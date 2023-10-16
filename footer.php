<footer class="is-layout-constrained footer">

	<div class="container alignwide">
		<div class="widgets">
			<?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
				<div class="footer-widget fw1">
					<?php dynamic_sidebar( 'footer_1' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer_2' ) ) : ?>
				<div class="footer-widget fw2">
					<?php dynamic_sidebar( 'footer_2' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer_3' ) ) : ?>
				<div class="footer-widget fw3">
					<?php dynamic_sidebar( 'footer_3' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer_4' ) ) : ?>
				<div class="footer-widget fw4">
					<?php dynamic_sidebar( 'footer_4' ); ?>
				</div>
			<?php endif; ?>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>

<?php if(is_user_logged_in()){ ?>
	<div class="indicator"></div>
<?php } ?>

</body>
</html>