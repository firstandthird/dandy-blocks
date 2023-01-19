<?php
/**
 * F+T Carousel Block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query *          loop, or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
  $anchor = esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'ft-carousel';
if ( ! empty( $block['className'] ) ) {
  $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
  $class_name .= ' align' . $block['align'];
}

?>

<div
 <?= esc_attr($anchor); ?>
 class="<?= esc_attr($class_name); ?>"
>
  <?php if( have_rows('carousel_items') ): ?>
    <?php while( have_rows('carousel_items') ): the_row(); ?>
      <?php if( get_row_layout() == 'image_and_text' ):
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        ?>
        <figure>
          <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
          <figcaption><?php echo $image['caption']; ?></figcaption>
        </figure>
        <h3><?= esc_html($title) ?></h3>
        <p><?= esc_html($content) ?></p>
      <?php elseif( get_row_layout() == 'text_w_image_bg' ):
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        ?>
        <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
        <h3><?= esc_html($title) ?></h3>
        <p><?= esc_html($content) ?></p>
      <?php elseif( get_row_layout() == 'full-size_image' ):
        $image = get_sub_field('image');
        ?>
        <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
