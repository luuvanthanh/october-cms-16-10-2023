<?php namespace Leabio\Patient;

use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            'Leabio\Patient\Components\CategoryList' => 'categoryList',
            'Leabio\Patient\Components\ContactForm' => 'contactForm'
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Leabio\Patient\FormWidgets\MyWidget' => [
                'lable' => 'Category field',
                'code' => 'mywidget'
            ]
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }
}
