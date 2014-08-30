<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\DataFixtures\ORM;

use AuthBucket\Push\Tests\TestBundle\Entity\Service;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Service();
        $model->setServiceType('apns')
            ->setClientId('http://democlient1.com/')
            ->setOptions(array(
                'host' => 'gateway.sandbox.push.apple.com',
                'port' => '2195',
                'pem' => 'example.pem',
                'pass' => 'demopassword1',
            ));
        $manager->persist($model);

        $model = new Service();
        $model->setServiceType('gcm')
            ->setClientId('http://democlient1.com/')
            ->setOptions(array(
                'host' => 'https://android.googleapis.com/gcm/send',
                'key' => 'demokey1',
            ));
        $manager->persist($model);

        $manager->flush();
    }
}
