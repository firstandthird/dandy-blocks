<?php
/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop, or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

$superheader = get_field( 'superheader' );
$header      = get_field( 'header' );
$subheader   = get_field( 'subheader' );
$prescript   = get_field( 'prescript' );
$content     = get_field( 'content' );
$button_1    = get_field( 'button_1_text' );
$link_1      = get_field( 'button_1_link' );
$button_2    = get_field( 'button_2_text' );
$link_2      = get_field( 'button_2_link' );
$bg_image    = wp_get_attachment_image_url( get_field( 'bg_image' ), 'full' );
$bg_x        = get_field( 'background_position' )['x'];
$bg_y        = get_field( 'background_position' )['y'];

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'ft-hero-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

$has_any_button = ( $button_1 && $link_1 ) || ( $button_2 && $link_2 );

?>

<section
  <?= esc_attr($anchor); ?>
  class="<?= esc_attr($class_name); ?>"
>
  <div class="flex w-full items-center justify-center" style="background-image: url(<?php echo esc_url( $bg_image ); ?>); background-position: <?php echo esc_attr( $bg_x . '% ' . $bg_y . '%' ); ?>;">
    <div class="w-full max-w-4xl p-5 min-h-[25vh]">
      <?php if ( $superheader ) : ?>
        <p class="text-sm leading-tight"><?php echo esc_html( $superheader ); ?></p>
      <?php endif; ?>
      <?php if ( $header ) : ?>
        <h1 class="text-5xl leading-snug"><?php echo esc_html( $header ); ?></h1>
      <?php endif; ?>
      <?php if ( $subheader ) : ?>
        <p class="text-sm leading-tight">
          <?php echo esc_html( $subheader ); ?>
        </p>
      <?php endif; ?>
      <?php if ( $content ) : ?>
        <p class="text-base leading-normal mt-4">
          <?php echo esc_html( $content ); ?>
        </p>
      <?php endif; ?>
      <?php if ( $has_any_button ) : ?>
        <div class="mt-4 flex flex-row gap-x-5 gap-y-2">
          <?php if ( $button_1 && $link_1 ) : ?>
          <a class="bg-black text-white px-5 py-3 leading-none">
            <?php echo esc_html( $button_1 ); ?>
          </a>
          <?php endif; ?>
          <?php if ( $button_2 && $link_2 ) : ?>
          <a class="bg-black text-white px-5 py-3 leading-none">
            <?php echo esc_html( $button_2 ); ?>
          </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
