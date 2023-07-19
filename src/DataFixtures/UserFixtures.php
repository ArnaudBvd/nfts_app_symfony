<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;
 
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $testUser = new User();
        $testUser->setLastname("user");
        $testUser->setFirstname("user");
        $testUser->setEmail("user@user.fr");
        $encodedPassword = $this->hasher->hashPassword($testUser, "user");
        $testUser->setPassword($encodedPassword);

        $testAdmin = new User();
        $testAdmin->setLastname("admin");
        $testAdmin->setFirstname("admin");
        $testAdmin->setEmail("admin@admin.fr");
        $encodedPassword = $this->hasher->hashPassword($testUser, "admin");
        $testAdmin->setPassword($encodedPassword);
        $testAdmin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($testUser);
        $manager->persist($testAdmin);

        $manager->flush();
    }
}
