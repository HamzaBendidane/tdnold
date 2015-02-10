<?php
namespace TDN\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tdn:whois')
            ->setDescription('Envoyer la lettre d’information aux personnes inscrites')
            ->addArgument(
                'pseudo',
                InputArgument::OPTIONAL,
                'Qui ?'
            )        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');      

        $rep = $em->getRepository('TDN\NanaBundle\Entity\Nana');
        $pseudo = $input->getArgument('pseudo');
        if ($pseudo) {
            $qui = $rep->findByUsername($pseudo);
            print_r(get_class($qui[0]));
            $text = 'Bonjour '.$qui[0]->getPrenom().' '.$qui[0]->getNom();
        } else {
            $text = 'Hello';
        }
 
       $output->writeln($text);
     }
}