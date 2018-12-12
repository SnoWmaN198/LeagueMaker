<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Role;
use App\Entity\Status;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $this->loadRoles($manager);
        $this->loadStatus($manager);
        $manager->flush();
    }
    
    public function loadRoles(ObjectManager $manager){
        $roleList = [
            'ROLE_USER',
            'ROLE_ADMIN'
        ];
        
        foreach ($roleList as $roleLabel){
            $role = new Role();
            $role->setLabel($roleLabel);
            $manager->persist($role);
        }
    }
    
    public function loadStatus(ObjectManager $manager){
        $statusList = [
            'Upcoming',
            'Ongoing',
            'Past'
        ];
        
        foreach ($statusList as $statusLabel){
            $status = new Status();
            $status->setLabel($statusLabel);
            $manager->persist($status);
        }
    }
    
    
    
    
}

