<?php

namespace App\DataFixtures;

use App\Entity\Utilizzatore;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UtilizzatoreFixtures extends Fixture
{
    //1) ingetto nel costruttore obj $passwordHasher
    //2) aggiungo use-> use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    //3) creo in 'load' i miei fakers
    public function load(ObjectManager $manager): void
    {
        //1) creare gli Utilizzatore
        for ($i = 0; $i < 6 ; $i++){
            $user = new Utilizzatore();
            $user->setNome('nome'.$i);  
            $user->setCognome('cognome'.$i);
            $user->setEmail ('user'.$i.'@gmail.com');   //es: user1@gmail.com
        //per accedere QUI' all' obj ingettato nel constructor,($passwordHasher = service) 
        //devo richiamarlo cosi': $this->passwordHasher
        //e poi di $passwordHasher chiamo la function (ossia method) hashPassword
        //hashPassword ha bisogno di 2 parametri: $objRef ($user), stringPSW ('pass'.$i)
            $user->setPassword($this->passwordHasher->hashPassword($user,'pass'.$i));       // es: pass1
        //se ho bisogno di diversi ruoli: RICORDA CHE é UNA tab
            $user->setRoles(['ROLE_CLIENTE']);
        //2) ingettare ogni utilizzatore
            $manager->persist ($user);
        }

        $user = new Utilizzatore();
            $user->setNome('admin');  
            $user->setCognome('admin');
            $user->setEmail ('user'.$i.'@gmail.com');
            $user->setPassword($this->passwordHasher->hashPassword($user,'admin'));
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist ($user);


        //3) stoccare gli Utilizzatore in DB
        $manager->flush();
    }
}
