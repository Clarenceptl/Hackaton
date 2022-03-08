<?php

namespace App\DataFixtures;

use Faker\Factory as Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    const USER_ADMIN = 'admin';
    const USER_USER = 'user';

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher){}
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        $admin = (new User())
            ->setEmail('admin@admin')
            ->setNom($faker->lastName)
            ->setPrenom($faker->firstName)
            ->setIsVerified(true)
            ->setRoles(['ROLE_ADMIN'])
        ;
        $admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'test'));
        $manager->persist($admin);
        $this->setReference(self::USER_ADMIN, $admin);

        $user = (new User())
            ->setEmail('user@user')
            ->setNom($faker->lastName)
            ->setPrenom($faker->firstName)
            ->setIsVerified(true)
            ->setRoles(['ROLE_USER'])
        ;
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'test'));
        $manager->persist($user);
        $this->setReference(self::USER_USER, $user);


        $manager->flush();
    }
}
