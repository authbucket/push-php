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

use AuthBucket\Push\Tests\TestBundle\Entity\Message;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MessageFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Message();
        $model->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setVariantId(array(
                'f2ee1d163e9c9b633efca95fb9733f35',
            ))
            ->setAlias(array(
                'demousername1',
            ))
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ))
            ->setPayload(array(
                'alert' => 'demoalert1',
                'sound' => 'default',
                'badge' => '1',
                'democustomkey1' => 'democustomvalue1',
            ));
        $manager->persist($model);

        $model = new Message();
        $model->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setVariantId(array(
                '78b67c04bfd60ddfc8c90895d36e1e05',
            ))
            ->setAlias(array(
                'demousername1',
            ))
            ->setCategory(array(
                'democategory1',
                'democategory2',
                'democategory3',
            ))
            ->setPayload(array(
                'alert' => 'demoalert2',
                'sound' => 'default',
                'badge' => '2',
                'democustomkey2' => 'democustomvalue2',
            ));
        $manager->persist($model);

        $manager->flush();
    }
}
