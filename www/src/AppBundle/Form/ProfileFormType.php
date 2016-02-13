<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileFormType extends AbstractType
{
    /**
     * @var \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface 
     */
    private $auth_checker;
    
    private $rolesHierarchy;

    public function __construct(AuthorizationCheckerInterface $auth_checker, $rolesHierarchy)
    {
        $this->auth_checker = $auth_checker;        
        $this->rolesHierarchy = $rolesHierarchy;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')
                ->add('lastname')
                ->add('phone');        
        
        if ($this->auth_checker->isGranted('ROLE_SUPER_ADMIN')) {
            $roles = [];
            foreach (array_keys((array)$this->rolesHierarchy) as $role) {
                $roles[ucwords(strtolower(str_replace("_", ' ', substr($role, 5))))] = $role;
            }
            $builder->add('roles' , ChoiceType::class, [
                'choices' => $roles,
                'expanded' => true,
                'multiple' => true
            ]);
        }
        
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile_edit';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
