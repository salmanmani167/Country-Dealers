<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b881694ce43e0836f1cef64a3f996b7
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Apps\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Apps\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Apps\\Database\\Seeders\\AppsDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/AppsDatabaseSeeder.php',
        'Modules\\Apps\\Database\\factories\\EventFactory' => __DIR__ . '/../..' . '/Database/factories/EventFactory.php',
        'Modules\\Apps\\Entities\\Event' => __DIR__ . '/../..' . '/Entities/Event.php',
        'Modules\\Apps\\Http\\Controllers\\AppsController' => __DIR__ . '/../..' . '/Http/Controllers/AppsController.php',
        'Modules\\Apps\\Http\\Livewire\\Apps\\Calendar' => __DIR__ . '/../..' . '/Http/Livewire/Apps/Calendar.php',
        'Modules\\Apps\\Providers\\AppsServiceProvider' => __DIR__ . '/../..' . '/Providers/AppsServiceProvider.php',
        'Modules\\Apps\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b881694ce43e0836f1cef64a3f996b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b881694ce43e0836f1cef64a3f996b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2b881694ce43e0836f1cef64a3f996b7::$classMap;

        }, null, ClassLoader::class);
    }
}
