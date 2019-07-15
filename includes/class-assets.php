<?php
namespace App;

/**
 * Scripts and Styles Class
 */
class Assets
{

    public function __construct()
    {

        if (is_admin()) {
            add_action('admin_enqueue_scripts', [$this, 'register'], 5);
        } else {
            add_action('wp_enqueue_scripts', [$this, 'register'], 5);
        }
    }

    /**
     * Register our app scripts and styles
     *
     * @return void
     */
    public function register()
    {
        $this->__register_scripts($this->get_scripts());
        $this->register_styles($this->get_styles());
    }

    /**
     * Register scripts
     *
     * @param  array $scripts
     *
     * @return void
     */
    private function __register_scripts($scripts)
    {
        foreach ($scripts as $handle => $script) {
            $deps      = isset($script['deps']) ? $script['deps'] : false;
            $in_footer = isset($script['in_footer']) ? $script['in_footer'] : false;
            $version   = isset($script['version']) ? $script['version'] : THISTLE_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, $in_footer);
        }
    }

    /**
     * Register styles
     *
     * @param  array $styles
     *
     * @return void
     */
    public function register_styles($styles)
    {
        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, THISTLE_VERSION);
        }
    }

    /**
     * Get all registered scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        $prefix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.min' : '';

        $scripts = [
            'baseplugin-vendor'   => [
                'src'       => THISTLE_ASSETS . '/js/vendor.js',
                'version'   => filemtime(THISTLE_PATH . '/assets/js/vendor.js'),
                'in_footer' => true,
            ],
            'baseplugin-frontend' => [
                'src'       => THISTLE_ASSETS . '/js/frontend.js',
                'deps'      => ['jquery', 'baseplugin-vendor'],
                'version'   => filemtime(THISTLE_PATH . '/assets/js/frontend.js'),
                'in_footer' => true,
            ],
            'baseplugin-admin'    => [
                'src'       => THISTLE_ASSETS . '/js/admin.js',
                'deps'      => ['jquery', 'baseplugin-vendor'],
                'version'   => filemtime(THISTLE_PATH . '/assets/js/admin.js'),
                'in_footer' => true,
            ],
        ];

        $scripts_prod = [
            'baseplugin-vendor'   => [
                'src'       => THISTLE_ASSETS . '/js/vendor.min.js',
                'version'   => filemtime(THISTLE_PATH . '/assets/js/vendor.min.js'),
                'in_footer' => true,
            ],
            'baseplugin-frontend' => [
                'src'       => THISTLE_ASSETS . '/js/frontend.min.js',
                'deps'      => ['jquery', 'baseplugin-vendor'],
                'version'   => filemtime(THISTLE_PATH . '/assets/js/frontend.min.js'),
                'in_footer' => true,
            ],
            'baseplugin-admin'    => [
                'src'       => THISTLE_ASSETS . '/js/admin.min.js',
                'deps'      => ['jquery', 'baseplugin-vendor'],
                'version'   => filemtime(THISTLE_PATH . '/assets/js/admin.min.js'),
                'in_footer' => true,
            ],
        ];

        return $scripts;
    }

    /**
     * Get registered styles
     *
     * @return array
     */
    public function get_styles()
    {

        $styles = [
            'baseplugin-style'    => [
                'src' => THISTLE_ASSETS . '/css/style.css',
            ],
            'baseplugin-frontend' => [
                'src' => THISTLE_ASSETS . '/css/frontend.css',
            ],
            'baseplugin-admin'    => [
                'src' => THISTLE_ASSETS . '/css/admin.css',
            ],
        ];

        return $styles;
    }

}
