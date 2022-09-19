<?php

declare(strict_types=1);

function add_filter_early($hook_name, $callback, $priority = 10, $accepted_args = 1)
{
    $add_filter_exists = function_exists('add_filter');
    // Hooks are available or can be loadeed
    if (
        $add_filter_exists
        || (defined('ABSPATH') && defined('WP_INC') && file_exists(ABSPATH . WP_INC . '/plugin.php'))
    ) {
        if (!$add_filter_exists) {
            require_once ABSPATH . WP_INC . '/plugin.php';
        }
        return add_filter($hook_name, $callback, $priority, $accepted_args);
    }

    global $wp_filter;
    is_array($wp_filter) or $wp_filter = [];
    isset($wp_filter[$hook_name]) or $wp_filter[$hook_name] = [];
    isset($wp_filter[$hook_name][$priority]) or $wp_filter[$hook_name][$priority] = [];
    $wp_filter[$hook_name][$priority][] = [
        'function'      => $callback,
        'accepted_args' => $accepted_args,
    ];
}

function do_action_early($hook_name, $callback, $priority = 10, $accepted_args = 1)
{
    return add_filter_early($hook_name, $callback, $priority, $accepted_args);
}
