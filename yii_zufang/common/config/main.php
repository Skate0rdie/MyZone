<?php
return [
    'language'=>'ZH-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [

            'class' => 'yii\caching\FileCache',
        ],
    ],
];
