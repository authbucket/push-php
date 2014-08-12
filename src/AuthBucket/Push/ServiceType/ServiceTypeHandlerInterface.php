<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Push service type handler interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ServiceTypeHandlerInterface
{
    /**
     * Handle corresponding service type logic.
     *
     * @param SecurityContextInterface         $securityContext         The security object that hold the current live token.
     * @param Request                          $request                 Incoming request object.
     * @param ModelManagerFactoryInterface     $modelManagerFactory     Model manager factory for compare with database record.
     *
     * @return RedirectResponse The redirect service object for authorize endpoint.
     */
    public function handle(
        SecurityContextInterface $securityContext,
        Request $request,
        ModelManagerFactoryInterface $modelManagerFactory
    );
}
