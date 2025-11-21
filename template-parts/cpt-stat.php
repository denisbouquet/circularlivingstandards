<?php
// Get fields
$stat_number    = get_sub_field('stat_number');
$stat_copy      = get_sub_field('stat_copy');
$wrapper_size   = get_sub_field('wrapper_size');      // md, lg, etc.
$spacing_bottom = get_sub_field('spacing_bottom');    // spacing class

// Build <evg-stat> classes
$stat_classes = [];
if ( $spacing_bottom ) {
    $stat_classes[] = esc_attr($spacing_bottom); // Already full class (ex: evg-spacing-bottom-lg)
}
$stat_classes = implode(' ', $stat_classes);
?>

<evg-wrapper size="<?php echo esc_attr($wrapper_size ?: 'md'); ?>">
    <evg-grid wrap="wrap">
        <evg-grid-item small-mobile="12" tablet="12">

            <evg-stat class="<?php echo $stat_classes; ?>" layout="row">

                <?php if ( $stat_number ) : ?>
                    <evg-stat-value>
                        <?php echo esc_html( $stat_number ); ?>
                    </evg-stat-value>
                <?php endif; ?>

                <?php if ( $stat_copy ) : ?>
                    <evg-stat-content>
                        <?php echo wp_kses_post( $stat_copy ); ?>
                    </evg-stat-content>
                <?php endif; ?>

            </evg-stat>

        </evg-grid-item>
    </evg-grid>
</evg-wrapper>