<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite1cd5c28fd9ac30b1bd91b4275e16bf9
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite1cd5c28fd9ac30b1bd91b4275e16bf9::$classMap;

        }, null, ClassLoader::class);
    }
}
