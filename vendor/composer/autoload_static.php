<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb532ec8b5d08156264074e274f34ecba
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Simresults' => 
            array (
                0 => __DIR__ . '/..' . '/mauserrifle/simresults/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitb532ec8b5d08156264074e274f34ecba::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitb532ec8b5d08156264074e274f34ecba::$classMap;

        }, null, ClassLoader::class);
    }
}
