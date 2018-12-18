laravel-admin 列表图片浏览扩展
======
- 单图浏览
- 多图浏览

#### 安装
```
composer require smallruraldog/light-box
```

#### 发布资源
```$xslt
php artisan vendor:publish --provider=SmallRuralDog\LightBox\LightBoxServiceProvider
```

#### 配置
```$xslt
'extensions' => [
    'light-box' => [
        // Set to `false` if you want to disable this extension
        'enable' => true,
    ]
 ]
```
#### 使用方法
```$xslt
// simple lightbox
$grid->picture()->lightbox();

//gallery
$grid->picture()->gallery();

//zoom effect
$grid->picture()->lightbox(['zooming' => true]);
$grid->picture()->gallery(['zooming' => true]);

//width & height properties
$grid->picture()->lightbox(['width' => 50, 'height' => 50]);
$grid->picture()->gallery(['width' => 50, 'height' => 50]);
```
>当字段为数组时为多图浏览

#### 预览
![image](https://user-images.githubusercontent.com/5151848/50127265-6f363f00-02ab-11e9-8386-b7cecc044e42.png)

![image](https://user-images.githubusercontent.com/5151848/50127285-85dc9600-02ab-11e9-939a-19aefae98da5.png)

#### License

Licensed under The [MIT License (MIT). ](https://github.com/SmallRuralDog/light-box/blob/master/LICENSE)