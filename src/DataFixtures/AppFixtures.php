<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Role;
use App\Entity\Status;
use App\Entity\Type;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $this->loadRoles($manager);
        $this->loadStatus($manager);
        $this->loadType($manager);
        $manager->flush();
    }

    public function loadRoles(ObjectManager $manager)
    {
        $roleList = [
            'ROLE_USER',
            'ROLE_ADMIN'
        ];

        foreach ($roleList as $roleLabel) {
            $role = new Role();
            $role->setLabel($roleLabel);
            $manager->persist($role);
        }
    }

    public function loadStatus(ObjectManager $manager)
    {
        $statusList = [
            'Upcoming',
            'Ongoing',
            'Past'
        ];

        foreach ($statusList as $statusLabel) {
            $status = new Status();
            $status->setLabel($statusLabel);
            $manager->persist($status);
        }
    }

    public function loadType(ObjectManager $manager)
    {
        $typeList = [
            [
                'label'=>'League',
                'description'=>'A competition in which each contestant meets all other contestants in turn.'
            ],[
                'label'=>'Knockout',
                'description'=>'An elimination tournament'
            ],[
                'label'=>'Multistage',
                'description'=>'A competition with Groupstage and finals'
            ] 
        ];

        foreach ($typeList as $typeArray) {
            $type = new Type();
            $type->setLabel($typeArray['label']);
            $type->setDescription($typeArray['description']);
            $manager->persist($type);
        }
    }
    
}

