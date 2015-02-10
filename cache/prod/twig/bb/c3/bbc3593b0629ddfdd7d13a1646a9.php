<?php

/* CommentaireBundle:Mail:nouveauCommentaire.html.twig */
class __TwigTemplate_bbc3bbc3593b0629ddfdd7d13a1646a9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("CoreBundle:Mail:notification.html.twig");

        $this->blocks = array(
            'corps' => array($this, 'block_corps'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "CoreBundle:Mail:notification.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_corps($context, array $blocks = array())
    {
        // line 4
        echo "<p>Un commentaire a été publié par ";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user", array(), "any", false, true), "username", array(), "any", true, true)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "username"), "html", null, true);
        } else {
            echo "un lecteur anonyme";
        }
        echo " sur la page suivante :</p>
<p><a href=\"http://www.trucdenana.com";
        // line 5
        echo twig_escape_filter($this->env, $this->getContext($context, "url"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getContext($context, "titre"), "html", null, true);
        echo "</a></p>
<hr/>
<div>";
        // line 7
        echo $this->getContext($context, "commentaire");
        echo "</div>
";
        // line 8
        if ($this->getContext($context, "isSuspect")) {
            // line 9
            echo "<p>Ce commentaire est soupçonné d'être un spam. Si ce n'est pas le cas, vous pouvez le <a href=\"http://www.trucdenana.com";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Commentaire_publier", array("id" => $this->getContext($context, "idCommentaire"))), "html", null, true);
            echo "\">publier</a></p>
<p>Traces : ";
            // line 10
            echo $this->getContext($context, "isSpam");
            echo "</p>
";
        } else {
            // line 12
            echo "<p>Si ce commentaire est un spam, vous pouvez le <a href=\"http://www.trucdenana.com";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Commentaire_effacer", array("id" => $this->getContext($context, "idCommentaire"))), "html", null, true);
            echo "\">supprimer</a></p>
";
        }
        // line 14
        echo "<p>Adresse de l'expéditeur : ";
        echo twig_escape_filter($this->env, $this->getContext($context, "IP"), "html", null, true);
        echo "</p>
";
    }

    public function getTemplateName()
    {
        return "CommentaireBundle:Mail:nouveauCommentaire.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 14,  63 => 12,  58 => 10,  53 => 9,  51 => 8,  47 => 7,  40 => 5,  31 => 4,  28 => 3,);
    }
}
