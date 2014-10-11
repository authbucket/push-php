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
        $model->setDeviceToken('0027956241e3ca5090de548fe468334d')
            ->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setAlias('demousername1')
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('9e0d8519fc205595bd895fbf70addcad')
            ->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setAlias('demousername1')
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('b55d6e3322b5bf00de15a622246d24492d3668e08aa919a74cfeeb1ee16b4d42')
            ->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setAlias('demousername1')
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('e0f948405a1566ed46fde8daa51aa2c05cf925d7d7cca10bcff4e002657be1d6')
            ->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setAlias('demousername1')
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ));
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('APA91bFwYKY0qonK0xg_lHMe-zcwaoeNsjGBMKDND-HspWOgbfsMYJyNqAlhSBbcc9WmxmVOyJk_jYJKUzwg22NFnK44w5f0PvC_ugXJR9MnBgvl5sgbPP9VeMIVAr9gH-3xz09ObfORaBTYfwQ7YrJuZ0CIAfHyvMmxNLu_hxtzXCMXx3xtdY8')
            ->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setAlias('demousername1')
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ));
        $manager->persist($model);

        $manager->flush();
    }
}
