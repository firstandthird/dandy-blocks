<?php

/**
 * F+T Card Block
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$block_id = 'ft-header-' . $block['id'];
if (!empty($block['anchor'])) {
  $block_id = $block['anchor'];
}

// Create class attribute allowing for custom "className"
$class_name = 'ft-header';
if (!empty($block['className'])) {
  $class_name .= ' ' . $block['className'];
}

?>

<section id="<?= esc_attr($block_id); ?>" class="<?= esc_attr($class_name); ?>">
  Card Block
</section>
