<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function ($i) {
            $user = new User();
            $user
                ->setEmail(sprintf('spacebar%d@wp.pl', $i))
                ->setFirstName($this->faker->firstName)
                ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'qwerty'
                ));

            return $user;
        });

        $this->createMany(3, 'admin_users', function ($i) {
            $user = new User();
            $user
                ->setEmail(sprintf('admin%d@wp.pl', $i))
                ->setFirstName($this->faker->firstName)
                ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'qwerty'
                ))
                ->setRoles(['ROLE_ADMIN']);

            return $user;
        });

        $manager->flush();
    }
}
