# WP Early Hooks

Add filters and actions (`add_filter` and `add_action`) before anything in WordPress has even started (such as advanced-cache hooks) thanks to the [`WP_Hook::build_preinitialized_hooks`](https://github.com/WordPress/WordPress/blob/2fda7d7d1aba927f74a1173910b205b92ed0179e/wp-includes/class-wp-hook.php#L379-L433) method which normalizes raw shaped hooks (e.g. an array stored in `$GLOBALS['wp_filter']`).


## Usage

This package exposes two functions with the same signature than `add_filter` and `add_action`:

```php
function add_filter_early($hook_name, $callback, $priority = 10, $accepted_args = 1);
```

```php
function add_action_early($hook_name, $callback, $priority = 10, $accepted_args = 1);
```
