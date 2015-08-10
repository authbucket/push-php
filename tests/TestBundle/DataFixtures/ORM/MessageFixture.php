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
        $model->setMessageId('4ac2842c963da2983a83e91c2a59f0b1')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setScope(array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
            ))
            ->setPayload(array(
                'alert' => 'demoalert1',
                'sound' => 'default',
                'badge' => '1',
                'democustomkey1' => 'democustomvalue1',
            ));
        $manager->persist($model);

        $model = new Message();
        $model->setMessageId('c555754aebec3ce37585ff784348662f')
            ->setClientId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setUsername('demousername1')
            ->setScope(array(
                'demoscope1',
                'demoscope2',
                'demoscope3',
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
