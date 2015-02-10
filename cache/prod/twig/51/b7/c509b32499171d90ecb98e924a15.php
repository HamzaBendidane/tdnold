<?php

/* RedactionBundle:Mail:nouvelleSelectionShopping.html.twig */
class __TwigTemplate_51b7c509b32499171d90ecb98e924a15 extends Twig_Template
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
        echo "<p>";
        echo twig_escape_filter($this->env, $this->getContext($context, "pseudo"), "html", null, true);
        echo " à créé une nouvelle sélection shopping :</p>
<p>";
        // line 5
        echo $this->getContext($context, "titre");
        echo "</p>
<p>Cette sélection contient ";
        // line 6
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "selection")), "html", null, true);
        echo " produit(s) :</p>
<ul>
\t";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "selection"));
        foreach ($context['_seq'] as $context["_key"] => $context["produit"]) {
            // line 9
            echo "\t<li>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "titre"), "html", null, true);
            echo "</li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['produit'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 11
        echo "</ul>

<p>L'article a pour le moment le statut de brouillon.</p>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Mail:nouvelleSelectionShopping.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 11,  49 => 9,  45 => 8,  40 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
