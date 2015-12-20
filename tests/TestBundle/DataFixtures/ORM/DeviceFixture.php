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
        $model->setDeviceToken('3ab8eddd7005833619a733e9fb9d85698fc17c3549de3584099454559ba5b9bd')
            ->setServiceId('f2ee1d163e9c9b633efca95fb9733f35')
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $model = new Device();
        $model->setDeviceToken('APA91bHXkb3ZrIe1mTx-WJrM1ZokLIT-qhd_uKS1opvctnx8MiUi_i8GskNp0mfkvNwrwbUoswcEvo03KK6KqNcSlgdfKSN5eKhIIl5_kWcuXe7bd58G15tB_-oO9G9X3fDPXGoT1_YQ')
            ->setServiceId('78b67c04bfd60ddfc8c90895d36e1e05')
            ->setUsername('')
            ->setScope([]);
        $manager->persist($model);

        $manager->flush();
    }
}
