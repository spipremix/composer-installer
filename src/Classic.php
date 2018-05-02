<?php

namespace Spip\Composer;

use Composer\Script\Event;
use Composer\Util\Filesystem;

/**
 * Script for post-install-cmd and post-install-cmd.
 */
class Classic
{
    /**
     * To move spip/classic after download to the root of the project.
     *
     * @param $event 
     *
     * @return void
     */
    public static function postInstall(Event $event)
    {
        $filesystem = new Filesystem();
        $rootDir = realpath($event->getComposer()->getConfig()->get('vendor-dir') . '/..');

        $filesystem->remove($rootDir . 'tmp/__spip_classic__/composer.json');
        $filesystem->remove($rootDir . 'tmp/__spip_classic__/composer.lock');
        $filesystem->copy($rootDir . 'tmp/__spip_classic__', $rootDir);
        $filesystem->remove($rootDir . 'tmp/__spip_classic__');
    }

    public static function postUpdate(Event $event)
    {
        static::postInstall($event);
    }
}
