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

use AuthBucket\Push\Tests\TestBundle\Entity\Device;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DeviceFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Device();
        $model->setDeviceToken('569b74819e2e16f52c9f00d293aefcf78ffa45942dbbdbdc3dcd31369b485a2f')
            ->setServiceType('apns')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('APA91bFwYKY0qonK0xg_lHMe-zcwaoeNsjGBMKDND-HspWOgbfsMYJyNqAlhSBbcc9WmxmVOyJk_jYJKUzwg22NFnK44w5f0PvC_ugXJR9MnBgvl5sgbPP9VeMIVAr9gH-3xz09ObfORaBTYfwQ7YrJuZ0CIAfHyvMmxNLu_hxtzXCMXx3xtdY8')
            ->setServiceType('gcm')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('0027956241e3ca5090de548fe468334d')
            ->setServiceType('apns')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('-7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('9e0d8519fc205595bd895fbf70addcad')
            ->setServiceType('gcm')
            ->setClientId('http://democlient1.com/')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('-7 days'));
        $manager->persist($model);

        $manager->flush();
    }
}
