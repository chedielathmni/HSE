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

        $members = $entity->getEmployees();
        $request = $this->requestStack->getCurrentRequest();

        $change = $request->query->get('property');
        $value = $request->query->get('newValue');

        if ( in_array($change,['canManageUsers', 'canManageProducts', 'canManageGroups', 'canManageStock'])) {

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

        foreach($members as $member) {
            if ($request->query->get('newValue') == true) {
            $member->setRoles(array_merge($member->getRoles(),[$role]));
            $entity->setDepartmentName('true');
            }
            if ($request->query->get('newValue') == false) {
            $member->setRoles(array_diff($member->getRoles(),[$role]));
            $entity->setDepartmentName('false');
        }
        }
    }
        parent::persistEntity($entity);
    }
}