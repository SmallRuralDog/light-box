<?php

namespace SmallRuralDog\GridLightBox;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Column;
use Illuminate\Support\ServiceProvider;

class GridLightBoxServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(GridLightBox $extension)
    {
        if (! GridLightBox::boot()) {
            return ;
        }



        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/grid-light-box')],
                'grid-light-box'
            );
        }
        Admin::booting(function () {
            Admin::css('vendor/laravel-admin-ext/grid-lightbox/magnific-popup.css');
            Admin::js('vendor/laravel-admin-ext/grid-lightbox/jquery.magnific-popup.min.js');
            Column::extend('light_box', LightboxDisplayer::class);
            Column::extend('gallery', GalleryDisplayer::class);
        });
    }
}