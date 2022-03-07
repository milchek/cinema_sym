<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ["Admin", "chekim","bou","chekim-92@live.fr","ROLE_ADMIN","mdp"],
            ["fou", "clopus","tuir","frae@outlook.fr","ROLE_USER","mdp"],
        ];
        
        foreach ($users as $u) {
            $user = new User();

            $password = $this->encoder->hashPassword($user,$u[5]);

            $user 
            ->setPseudo($u[0])
            ->setPrenom($u[1])
            ->setNom($u[2])
            ->setEmail($u[3])
            ->setRoles([$u[4]])
            ->setPassword($password)
     ; 
            $manager->persist($user);
        }
            $manager->flush();
        }
        
        
}
