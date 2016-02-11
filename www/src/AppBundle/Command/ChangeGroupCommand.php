<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class ChangeGroupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:change_group')
            ->setDescription('Change group for user')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
            ->addArgument('group', InputArgument::REQUIRED, 'Group');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {        
        $container = $this->getContainer();
        $orm = $container->get('doctrine.orm.entity_manager');
        $repository = $orm->getRepository('AppBundle:User');
        
        $user = $repository->findByEmail($input->getArgument('email'));
        if ($user === null) {
            $output->writeln('User not found');
            return;
        }
        
        switch (strtolower($input->getArgument('group'))) {
            case 'user':
                $user->setGroup(User::GROUP_USER);
            break;
            case 'admin':
                $user->setGroup(User::GROUP_ADMIN);
            break;
            default:
                $output->writeln('Group not found');
            return;
        }                

        $orm->persist($user);
        $orm->flush();
        
        $output->writeln('Group updated sucessfully.');
    }

}
