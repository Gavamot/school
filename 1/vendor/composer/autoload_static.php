<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite81de22d6f52fdcda45860aa43588268
{
    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInite81de22d6f52fdcda45860aa43588268::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
