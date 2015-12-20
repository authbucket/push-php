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
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('9e0d8519fc205595bd895fbf70addcad')
            ->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('d288ad9899d0e0fecaac1083d46121feba27b15b3d57cd0d666799168bc03639')
            ->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('APA91bE-hRR6MJ60PkTKLr-8x4u7nEV_R9aZSfqV4k4ceuOKw5Pr9sHsmBtgEg0OjFZAyZqFepel6goRrfUZfsR3Desr2Tea_tEnimT8y4qoPeJVLuFPbyS2Rs7qY35thHoZJjiM0eVrClPPVx5zAP_XlzavnDjsYW8VXDfiaUF6MNELmfWLMlw')
            ->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $manager->flush();
    }
}
