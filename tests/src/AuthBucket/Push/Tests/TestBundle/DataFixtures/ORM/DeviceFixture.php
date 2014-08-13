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

use AuthBucket\Push\Tests\TestBundle\Entity\Device;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DeviceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Device();
        $model->setDeviceId('eeb5aa92bbb4b56373b9e0d00bc02d93')
            ->setServiceType('apns')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceId('7be07f1e5e1737f2aec000a0cc82da06')
            ->setServiceType('gcm')
            ->setClientId('http://democlient2.com/')
            ->setUsername('demousername2')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $manager->flush();
    }
}
