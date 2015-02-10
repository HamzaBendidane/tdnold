<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new TDN\RedactionBundle\RedactionBundle(),
            new TDN\DocumentBundle\DocumentBundle(),
            new TDN\QuizBundle\QuizBundle(),
            new TDN\ImageBundle\ImageBundle(),
            new TDN\CommentaireBundle\CommentaireBundle(),
            new TDN\VideoBundle\VideoBundle(),
            new TDN\ProduitBundle\ProduitBundle(),
            new TDN\CoreBundle\CoreBundle(),
            new TDN\ConcoursBundle\ConcoursBundle(),
            new TDN\ConseilExpertBundle\ConseilExpertBundle(),
            new TDN\CauseuseBundle\CauseuseBundle(),
            new TDN\BreveBundle\BreveBundle(),
            new TDN\DossierRedactionBundle\DossierRedactionBundle(),
            new TDN\ProfilBundle\ProfilBundle(),
            new TDN\NanaBundle\NanaBundle(),
            new TDN\NewsletterBundle\NewsletterBundle(),
            new TDN\AdvertiseBundle\AdvertiseBundle(),
            new TDN\SliderBundle\SliderBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
