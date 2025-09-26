<?php
/**
 * Custom Walker_Nav_Menu for Tailwind CSS navigation styling
 * @package    LB25
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 * @version    1.0.0
 * @since      1.0.0
 * @created    Date created
 * @modified   Last modified date
 * @license    MIT License
 */

class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Start Level
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"ml-10 flex items-baseline space-x-4\">";
    }

    /**
     * End Level
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }

    /**
     * Start Element
     */
    function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors';
        if ($item->object_id === 'contacto' || $item->title === 'Contacto') {
            $classes = 'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors';
        }
        $output .= '<a href="' . esc_url($item->url) . '" class="' . $classes . '">' . esc_html($item->title) . '</a>';
    }

    /**
     * End Element
     */
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        // No closing tag needed for <a>
    }
}
