<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\RequestStack;

class GroupController extends EasyAdminController
{

    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    
    protected function updateDepartmentEntity($entity) {

        $permissions = ['administrator', 'moderator', 'canManageUsers', 'canManageProducts', 'canManageGroups', 'canManageStock'];
        $members = $entity->getEmployees();
        $request = $this->requestStack->getCurrentRequest();

        $change = $request->query->get('property');
        $value = $request->query->get('newValue');

        if (in_array($change,$permissions)) {

            
            $role = $this->getRole($change);
            
            if ($value == 'true')
            {
                $entity->setRoles(array_merge($entity->getRoles(),[$role]));
            }
            else
            {
                $entity->setRoles(array_diff($entity->getRoles(), [$role]));
            }
            
        foreach($members as $member) {
            if ($value == 'true') {
                $member->setRoles(array_merge($member->getRoles(),[$role]));
            }
            else {
                $member->setRoles(array_diff($member->getRoles(),[$role]));
            }
        }
    }
        parent::persistEntity($entity);
    }




/*     protected function persistDepartmentEntity($entity) {

        $members = $entity->getEmployees();

        foreach($members as $member) {
            
            parent::persistEntity($member);
        
        }

    } */

    
    private function getRole($change) {
        switch($change){
            case 'administrator':
                $role = 'ROLE_ADMIN';
            break;
            case 'moderator':
                $role = 'ROLE_MOD';
            break;
            case 'canManageUsers':
                $role = 'ROLE_MOD_USERS';
            break;
            case 'canManageProducts':
                $role = 'ROLE_MOD_PRODUCTS';
            break;
            case 'canManageGroups':
                $role = 'ROLE_MOD_GROUPS';
            break;
            case 'canManageStock':
                $role = 'ROLE_GES_STOCK';
            break;
        }
        return $role;
    }
}