<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Model;

/**
 * Push client manager interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ClientManagerInterface extends ModelManagerInterface
{
    public function createClient();

    public function deleteClient(ClientInterface $client);

    public function reloadClient(ClientInterface $client);

    public function updateClient(ClientInterface $client);

    public function findClientByClientId($clientId);
}
