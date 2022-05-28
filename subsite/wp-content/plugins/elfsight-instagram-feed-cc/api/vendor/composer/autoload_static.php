<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3781ac001ea51b933bfbff5b6e03d86f
{
    public static $classMap = array (
        'ElfsightInstagramFeedApi\\Core\\Api' => __DIR__ . '/..' . '/elfsight/Api.php',
        'ElfsightInstagramFeedApi\\Core\\Cache' => __DIR__ . '/..' . '/elfsight/Cache.php',
        'ElfsightInstagramFeedApi\\Core\\Debug' => __DIR__ . '/..' . '/elfsight/Debug.php',
        'ElfsightInstagramFeedApi\\Core\\Helper' => __DIR__ . '/..' . '/elfsight/Helper.php',
        'ElfsightInstagramFeedApi\\Core\\Options' => __DIR__ . '/..' . '/elfsight/Options.php',
        'ElfsightInstagramFeedApi\\Core\\Throttle' => __DIR__ . '/..' . '/elfsight/Throttle.php',
        'ElfsightInstagramFeedApi\\Core\\Url' => __DIR__ . '/..' . '/elfsight/Url.php',
        'ElfsightInstagramFeedApi\\Core\\User' => __DIR__ . '/..' . '/elfsight/User.php',
        'ElfsightInstagramFeedApi\\Options' => __DIR__ . '/../..' . '/api-options.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit3781ac001ea51b933bfbff5b6e03d86f::$classMap;

        }, null, ClassLoader::class);
    }
}
