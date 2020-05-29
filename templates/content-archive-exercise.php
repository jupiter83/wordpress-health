<?php
/**
 * Template used to display post content on widgets and archive pages.
 *
 * @package lsx-health-plan
 */
global $shortcode_args;
?>

<?php lsx_entry_before(); ?>

<?php
$column_class = '4';
// Check for shortcode overrides.
if ( null !== $shortcode_args ) {
	if ( isset( $shortcode_args['columns'] ) ) {
		$column_class = $shortcode_args['columns'];
		$column_class = \lsx_health_plan\functions\column_class( $column_class );
	}
}
?>

<div class="col-xs-12 col-sm-6 col-md-<?php echo esc_attr( $column_class ); ?>">
	<article class="lsx-slot box-shadow">
		<?php lsx_entry_top(); ?>

		<div class="exercise-feature-img">
			<a href="<?php echo esc_url( get_permalink() ); ?>">
			<?php
			$featured_image = get_the_post_thumbnail();
			if ( ! empty( $featured_image ) && '' !== $featured_image ) {
				the_post_thumbnail( 'lsx-thumbnail-square', array(
					'class' => 'aligncenter',
				) );
			} else {
				?>
				<img src="<?php echo esc_attr( plugin_dir_url( __FILE__ ) . '../assets/images/placeholder.jpg' ); ?>">
				<?php
			}
			?>
			</a>
		</div>
		<div class="content-box exercise-content-box white-bg">
			<div class="title-lined">
				<?php lsx_health_plan_exercise_title( '<h3 class="exercise-title">', '</h3>' ); ?>
				<?php lsx_health_plan_exercise_data(); ?>
			</div>
			<?php
			if ( ! has_excerpt() ) {
				$content = wp_trim_words( get_the_content(), 20 );
				$content = '<p>' . $content . '</p>';
			} else {
				$content = apply_filters( 'the_excerpt', get_the_excerpt() );
			}
			echo wp_kses_post( $content );
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn border-btn"><?php esc_html_e( 'See exercise', 'lsx-health-plan' ); ?></a>
		</div>
		<?php lsx_entry_bottom(); ?>
	</article>
</div>

<?php
lsx_entry_after();
