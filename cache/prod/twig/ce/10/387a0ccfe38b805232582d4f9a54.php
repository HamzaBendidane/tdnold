<?php

/* RedactionBundle:Admin:selectionShoppingContentListe.html.twig */
class __TwigTemplate_ce10387a0ccfe38b805232582d4f9a54 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Admin:documentListe.html.twig");

        $this->blocks = array(
            'displayContent' => array($this, 'block_displayContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DocumentBundle:Admin:documentListe.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_displayContent($context, array $blocks = array())
    {
        // line 4
        echo "    <td>
      ";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "doc"), "idDocument"), "html", null, true);
        echo "
    </td>
    <td>
      <a href='";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Redaction_modifierSelection", array("id" => $this->getAttribute($this->getContext($context, "doc"), "idDocument"))), "html", null, true);
        echo "'>
        ";
        // line 9
        if ((!twig_test_empty($this->getAttribute($this->getContext($context, "doc"), "titre")))) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "doc"), "titre"), "html", null, true);
        } else {
            echo "Sans titre";
        }
        // line 10
        echo "      </a>
    </td>
    <td>
      ";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "doc"), "statut"), "html", null, true);
        echo "
    </td>
    <td>
      ";
        // line 16
        if ((!(null === $this->getAttribute($this->getContext($context, "doc"), "lnAuteur")))) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "doc"), "lnAuteur"), "username"), "html", null, true);
        }
        // line 17
        echo "    </td>
    <td>
      ";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('age_extension')->lapsFilter($this->getAttribute($this->getContext($context, "doc"), "datePublication")), "html", null, true);
        echo "
    </td>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Admin:selectionShoppingContentListe.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 19,  65 => 17,  61 => 16,  55 => 13,  50 => 10,  44 => 9,  40 => 8,  34 => 5,  31 => 4,  28 => 3,);
    }
}
