<?php

/*----------------------------------------------------------------------------------------------*/
/**
 * Map Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'quality_construction_map_option',
    array(
        'title' => esc_html__('Opciones de Mapa', 'quality-construction'),
        'panel' => 'quality_construction_theme_options',
        'priority' => 6,
    )
);

$wp_customize->add_setting(
    'quality_construction_gmaps_option',
    array(
        'default' => $default['quality_construction_gmaps_option'],
        'sanitize_callback' => 'sanitize_text_field',

    )
);

$wp_customize->add_control('quality_construction_gmaps_option',
    array(
        'label' => esc_html__('GMaps Code', 'quality-construction'),
        'section' => 'quality_construction_map_option',
        'type' => 'text',
        'priority' => 10
    )
);
