<?php

namespace SmallRuralDog\LightBox;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Column;
use Illuminate\Support\ServiceProvider;

class LightBoxServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(LightBox $extension)
    {
        if (! LightBox::boot()) {
            return ;
        }



        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/light-box')],
                'light-box'
            );
        }
        Admin::booting(function () {
            Admin::css('vendor/laravel-admin-ext/light-box/magnific-popup.css');
            Admin::js('vendor/laravel-admin-ext/light-box/jquery.magnific-popup.min.js');
            Column::extend('light_box', LightboxDisplayer::class);
            Column::extend('gallery', GalleryDisplayer::class);
        });
    }
}