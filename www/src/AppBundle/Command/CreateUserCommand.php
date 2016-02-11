<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\User;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:create_user')
            ->setDescription('This command creates new user')
            ->addArgument('firstname', InputArgument::REQUIRED, 'First name')
            ->addArgument('lastname', InputArgument::REQUIRED, 'Last name')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('password', InputArgument::REQUIRED, 'Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $factory = $container->get('security.encoder_factory');
        $validator = $container->get('validator');
        $orm = $container->get('doctrine.orm.entity_manager');
        
        $user = new User();
        $encoder = $factory->getEncoder($user);                
        
        $salt = $user->generateNewSalt();
        $user->setFirstname($input->getArgument('firstname'))
             ->setLastname($input->getArgument('lastname'))
             ->setEmail($input->getArgument('email'))           
             ->setPassword($encoder->encodePassword($input->getArgument('password'), $salt))
             ->setGroup(User::GROUP_USER);
        
        $errors = $validator->validate($user);
        
        if (count($errors) > 0) {
            $output->writeln('Got errors: ' . (string)$errors);
            return;
        }                
        
        $orm->persist($user);
        $orm->flush();
        
        $output->writeln('User created sucessfully.');
    }

}
