<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\DataFixtures\ORM;

use AuthBucket\Push\Tests\TestBundle\Entity\Client;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Client();
        $model->setClientId('51b2d34c3a661b5e111a694dfcb4b248')
            ->setClientSecret('237ed57f218b41d07db6757afec3a41c');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('authorization_code_grant')
            ->setClientSecret('uoce8AeP');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('implicit_grant')
            ->setClientSecret('Ac1chee1');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('resource_owner_password_credentials_grant')
            ->setClientSecret('Eevahph6');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('client_credentials_grant')
            ->setClientSecret('yib6aiFe');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('http://democlient1.com/')
            ->setClientSecret('demosecret1');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('http://democlient2.com/')
            ->setClientSecret('demosecret2');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('http://democlient3.com/')
            ->setClientSecret('demosecret3');
        $manager->persist($model);

        $model = new Client();
        $model->setClientId('http://democlient4.com/')
            ->setClientSecret('demosecret4');
        $manager->persist($model);

        $manager->flush();
    }
}
