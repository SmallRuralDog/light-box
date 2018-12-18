<?php


namespace SmallRuralDog\LightBox;


use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

class LightboxDisplayer extends AbstractDisplayer
{
    public $options = [
        'type' => 'image'
    ];

    protected function script()
    {
        $options = json_encode($this->options);
        return <<<SCRIPT
$('.grid-popup-link').magnificPopup($options);
SCRIPT;
    }

    public function zooming()
    {
        $this->options = array_merge($this->options, [
            'mainClass' => 'mfp-with-zoom',
            'zoom' => [
                'enabled' => true,
                'duration' => 300,
                'easing' => 'ease-in-out',
            ]
        ]);
    }

    public function display(array $options = [])
    {
        if (empty($this->value)) {
            return '';
        }
        $server = array_get($options, 'server');
        $width = array_get($options, 'width', 200);
        $height = array_get($options, 'height', 200);
        if (array_get($options, 'zooming')) {
            $this->zooming();
        }
        Admin::script($this->script());

        if (is_array($this->value)) {

            return collect($this->value)->map(function ($url) use ($height, $width, $server) {
                $src = $this->getSrc($url, $server);
                return $this->getImgDom($src, $width, $height);
            })->implode('');

        } else {
            $src = $this->getSrc($this->value, $server);
            return $this->getImgDom($src, $width, $height);
        }
    }


    private function getSrc($url, $server)
    {
        if (url()->isValidUrl($url)) {
            $src = $url;
        } elseif ($server) {
            $src = rtrim($server, '/') . '/' . ltrim($url, '/');
        } else {
            $src = \Storage::disk(config('admin.upload.disk'))->url($url);
        }

        return $src;
    }


    private function getImgDom($src, $width, $height)
    {
        return <<<HTML
<a href="$src" class="grid-popup-link">
    <img src='$src' style='max-width:{$width}px;max-height:{$height}px' class='img img-thumbnail' />
</a>
HTML;
    }
}