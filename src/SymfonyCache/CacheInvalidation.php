<?php

/*
 * This file is part of the FOSHttpCache package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\HttpCache\SymfonyCache;

use Symfony\Component\HttpKernel\HttpKernelInterface;

use function class_alias;
use function class_exists;

if (! interface_exists(CacheInvalidation::class) && 
    class_exists('Symfony\Component\HttpKernel\Kernel') &&
    \Symfony\Component\HttpKernel\Kernel::MAJOR_VERSION >= 6) {
    // Load class for Symfony >=6.0
    class_alias(
        Compatibility\CacheInvalidationS6::class,
        CacheInvalidation::class
    );
} else {
    // Load class for any other cases
    class_alias(
        Compatibility\CacheInvalidationLegacy::class,
        CacheInvalidation::class
    );
}

if (! interface_exists(CacheInvalidation::class)) {
    /**
     * Provide an empty interface for code scanners
     */
    interface SearchHandler extends HttpKernelInterface
    {
    }
}
