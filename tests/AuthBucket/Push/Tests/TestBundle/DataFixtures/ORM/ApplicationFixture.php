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

use AuthBucket\Push\Tests\TestBundle\Entity\Application;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ApplicationFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $model = new Application();
        $model->setApplicationId('6b44c21ef7bc8ca7380bb5b8276b3f97')
            ->setApplicationSecret('27dc1c985564cd28a4074cd0384c6169');
        $manager->persist($model);

        $manager->flush();
    }
}
