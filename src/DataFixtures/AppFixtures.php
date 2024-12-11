<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Projet;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('tom@email.com')->setMotDePasse('1234')->setRole('Utilisateur');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('jerry@email.com')->setMotDePasse('1234')->setRole('Admin');
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('spikee@email.com')->setMotDePasse('1234')->setRole('Contributeur');
        $manager->persist($user3);

        $projet1 = new Projet();
        $projet1->setUserId($user1)
                ->setTitre('Pokémonstre')
                ->setDescription('Voici un projet commun sur l\'univers de pokémon version monstre')
                ->setMontantObjectif(10000.99)->setMontantActuel(150.00)
                ->setDateLimite(new DateTime('+14 days'))
                ->setStatut('en cours');
        $manager->persist($projet1);

        $projet2 = new Projet();
        $projet2->setUserId($user2)
                ->setTitre('Patisserie numérique')
                ->setDescription('Voici une patisserie numérique pour permettre a l\'intelligence artificielle de pouvoir commander des petites patisseries et reprendre des forces.')
                ->setMontantObjectif(100000.99)->setMontantActuel(489.99)
                ->setDateLimite(new DateTime('+30 days'))
                ->setStatut('en cours');
        $manager->persist($projet2);

        $projet3 = new Projet();
        $projet3->setUserId($user3)
                ->setTitre('Digicoin')
                ->setDescription('Voici un projet consistant a créer une nouvelle cryptomonnaie, soutenu par Elon Musk.')
                ->setMontantObjectif(2500000.99)->setMontantActuel(0.00)
                ->setDateLimite(new DateTime('+1 year'))
                ->setStatut('en préparation');
        $manager->persist($projet3);

        $manager->flush();
    }
}
