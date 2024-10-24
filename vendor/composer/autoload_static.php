<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b44a7caa323e2c9431bacd55822f9d9
{
    public static $files = array (
        'ce89ac35a6c330c55f4710717db9ff78' => __DIR__ . '/..' . '/kriswallsmith/assetic/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vk\\' => 3,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vk\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Application',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'ComponentInstaller' => 
            array (
                0 => __DIR__ . '/..' . '/robloach/component-installer/src',
            ),
        ),
        'A' => 
        array (
            'Assetic' => 
            array (
                0 => __DIR__ . '/..' . '/kriswallsmith/assetic/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b44a7caa323e2c9431bacd55822f9d9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b44a7caa323e2c9431bacd55822f9d9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit3b44a7caa323e2c9431bacd55822f9d9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit3b44a7caa323e2c9431bacd55822f9d9::$classMap;

        }, null, ClassLoader::class);
    }
}
