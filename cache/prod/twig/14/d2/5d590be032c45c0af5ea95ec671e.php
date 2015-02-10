<?php

/* ConseilExpertBundle:Bloc:conseilsRecents.html.twig */
class __TwigTemplate_14d25d590be032c45c0af5ea95ec671e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"conseils\">
\t<h3 class=\"titreBicolore\"><span class=\"strong\">Conseils</span> d’experts</h3>
\t<div class=\"masqueContenu nano\">
\t<!--[if gte IE 9]>
   <style type=\"text/css\">
   .gradient {
    filter: none;
   }
  </style>
  <![endif]-->
\t";
        // line 11
        if (twig_test_empty($this->getContext($context, "conseilsRecents"))) {
            // line 12
            echo "\t<p class=\"warning\">Aucun conseil publié sur TDN</p>
\t";
        } else {
            // line 14
            echo "\t\t<div class=\"content\">
\t\t";
            // line 15
            $context["i"] = 0;
            // line 16
            echo "\t\t";
            if ((!twig_test_empty($this->getContext($context, "conseilsRecents")))) {
                // line 17
                echo "\t\t";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "conseilsRecents"));
                foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                    // line 18
                    echo "\t\t<div class=\"blocConseil\">
\t\t";
                    // line 19
                    if (twig_test_empty($this->getAttribute($this->getContext($context, "c"), "lnIllustration"))) {
                        // line 20
                        echo "\t\t    ";
                        $context["alt"] = "Vignette par défaut pour les conseils";
                        // line 21
                        echo "\t\t    ";
                        $context["cartouche"] = "";
                        // line 22
                        echo "\t\t";
                    } else {
                        // line 23
                        echo "\t\t    ";
                        $context["cartouche"] = $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnIllustration"), "alt");
                        // line 24
                        echo "\t\t    ";
                        $context["alt"] = $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnIllustration"), "alt");
                        // line 25
                        echo "\t\t";
                    }
                    // line 26
                    echo "\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "c")), "html", null, true);
                    echo "\">
\t\t\t<img class=\"iconex60\" src=\"";
                    // line 27
                    echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "c"), "SQUARE"), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getContext($context, "alt"), "html", null, true);
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getContext($context, "cartouche"), "html", null, true);
                    echo "\" />
\t\t\t<h4 class=\"apercuTexte\">";
                    // line 28
                    echo $this->getAttribute($this->getContext($context, "c"), "titre");
                    echo "</h4>
\t\t</a>
\t\t<p style=\"margin-top:8px;\">
\t\t";
                    // line 31
                    if ((!(null === $this->getAttribute($this->getContext($context, "c"), "lnAuteur")))) {
                        // line 32
                        echo "\t\t<span style=\"color:#999\">de</span> <a class=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "c"), "lnThematique")), "html", null, true);
                        echo "_texte\" href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnAuteur"), "idNana"))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnAuteur"), "username"), "html", null, true);
                        echo "</a> 
\t\t";
                    }
                    // line 34
                    echo "\t\t";
                    if ((!(null === $this->getAttribute($this->getContext($context, "c"), "lnExpert")))) {
                        // line 35
                        echo "\t\t<span style=\"color:#999\">Réponse de</span> <a class=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "c"), "lnThematique")), "html", null, true);
                        echo "_texte\" href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnExpert"), "idNana"))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnExpert"), "prenom") . ", ") . $this->getAttribute($this->getAttribute($this->getContext($context, "c"), "lnExpert"), "occupation")), "html", null, true);
                        echo "</a>
\t\t";
                    }
                    // line 37
                    echo "\t\t</p>
\t\t</div>
\t\t";
                    // line 39
                    $context["i"] = ($this->getContext($context, "i") + 1);
                    // line 40
                    echo "\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 41
                echo "\t\t";
            }
            // line 42
            echo "\t\t</div>
\t";
        }
        // line 44
        echo "\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ConseilExpertBundle:Bloc:conseilsRecents.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 44,  132 => 42,  121 => 39,  104 => 34,  94 => 32,  53 => 19,  50 => 18,  45 => 17,  42 => 16,  74 => 27,  70 => 25,  64 => 23,  61 => 22,  55 => 20,  52 => 19,  47 => 17,  40 => 15,  37 => 14,  31 => 11,  123 => 40,  117 => 37,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 30,  95 => 29,  92 => 31,  87 => 27,  84 => 26,  81 => 25,  79 => 24,  67 => 24,  65 => 18,  58 => 21,  44 => 16,  41 => 10,  33 => 12,  28 => 6,  26 => 5,  21 => 2,  19 => 1,  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 41,  124 => 43,  118 => 40,  113 => 39,  107 => 35,  102 => 35,  100 => 34,  96 => 32,  86 => 28,  78 => 27,  75 => 25,  73 => 26,  66 => 19,  63 => 18,  60 => 17,  56 => 14,  54 => 13,  49 => 18,  46 => 9,  39 => 9,  36 => 5,  30 => 3,);
    }
}
