<?php
return [
    'language'=>'zh-CN',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
        'uploadDir' => '@webroot/path/to/uploadfolder',
        'uploadUrl' => '@web/path/to/uploadfolder',
        'imageAllowExtensions'=>['jpg','png','gif']
    ],
];
