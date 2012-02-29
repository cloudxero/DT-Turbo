<?php
	$theme_url =  $Turbo->theme_information[ 'ThemeURL' ];
	get_header();
?>

	<div class="home-top-left turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Top - Left' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-top-right turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Top - Right' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-middle-full turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Middle - Full' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-middle-left turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Middle - Left' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-middle-middle turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Middle - Middle' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-middle-right turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Middle - Right' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-bottom-left turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Bottom - Left' ) ): ?>
		<?php endif; ?>
	</div>
	<div class="home-bottom-right turbo-theme">
		<?php if( ! dynamic_sidebar( 'Home Bottom - Right' ) ): ?>
		<?php endif; ?>
	</div>

<?php
	do_action( 'genesis_after_content_sidebar_wrap' );
	get_footer();
?>
