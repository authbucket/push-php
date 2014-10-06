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
        $model->setDeviceToken('b55d6e3322b5bf00de15a622246d24492d3668e08aa919a74cfeeb1ee16b4d42')
            ->setVariantType('apns')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('e0f948405a1566ed46fde8daa51aa2c05cf925d7d7cca10bcff4e002657be1d6')
            ->setVariantType('apns')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('APA91bFwYKY0qonK0xg_lHMe-zcwaoeNsjGBMKDND-HspWOgbfsMYJyNqAlhSBbcc9WmxmVOyJk_jYJKUzwg22NFnK44w5f0PvC_ugXJR9MnBgvl5sgbPP9VeMIVAr9gH-3xz09ObfORaBTYfwQ7YrJuZ0CIAfHyvMmxNLu_hxtzXCMXx3xtdY8')
            ->setVariantType('gcm')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('+7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('0027956241e3ca5090de548fe468334d')
            ->setVariantType('apns')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('-7 days'));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('9e0d8519fc205595bd895fbf70addcad')
            ->setVariantType('gcm')
            ->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setExpires(new \DateTime('-7 days'));
        $manager->persist($model);

        $manager->flush();
    }
}
