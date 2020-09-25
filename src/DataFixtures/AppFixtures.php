<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Participant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * processus d'encodage par objet de mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encodage;
    public function __construct(UserPasswordEncoderInterface $encodage)
    {
        $this->encodage=$encodage;
    }

    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');

        //Génération de données aléatoires
        //User
        for($u=0;$u< 5;$u++){
            $user =new User();

            $encodepassword=$this->encodage->encodePassword($user,"password");
            $user ->setNom($faker->firstName())
                  ->setPrenom($faker->lastName)
                  ->setEmail($faker->email)
                  ->setPassword($encodepassword);

            //Persistance des données d'utlisateurs'
            $manager->persist($user);
        //Evenements
        for($e=0;$e< 20;$e++) {
            $evenement = new Event();
            $evenement->setNomEvent($faker->company)
                ->setStatus($faker->boolean)
                ->setDatedebutEvent($faker->dateTimeBetween('-6 months'))
                ->setDatefinEvent($faker->dateTimeBetween('-4 months'))
                ->setCreatedAt($faker->dateTime())
                ->setEventUser($user);

            //Persistance des données d'évènements'
            $manager->persist($evenement);

            //Participant
            for ($p = 0; $p < mt_rand(2,4); $p++) {
                $participant = new Participant();
                $participant->setNom($faker->firstName())
                    ->setPrenom($faker->lastName)
                    ->setEmail($faker->email)
                    ->setTelephone($faker->randomDigit)
                    ->addEvent($evenement);

                //Persistance des données de participants
                $manager->persist($participant);

            }
        }

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
