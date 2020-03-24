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

        $permissions = ['canManageUsers', 'canManageProducts', 'canManageGroups', 'canManageStock'];
        $members = $entity->getEmployees();
        $request = $this->requestStack->getCurrentRequest();

        $change = $request->query->get('property');
        $value = $request->query->get('newValue');

        if (in_array($change,$permissions)) {

            $role = $this->getRole($change);

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
    


    
    private function getRole($change) {
        switch($change){
            case 'canManageUsers':
                $role = 'ROLE_USER';
            break;
            case 'canManageProducts':
                $role = 'ROLE_ADMIN';
            break;
            case 'canManageGroups':
                $role = 'ROLE_MOD_S';
            break;
            case 'canManageStock':
                $role = 'ROLE_GES_STOCK';
            break;
        }
        return $role;
    }
}