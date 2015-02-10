<?php

/* RedactionBundle:Bloc:articlesPlusLus.html.twig */
class __TwigTemplate_5ff6d25aad22c448378cee17d6efe3c1 extends Twig_Template
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
        echo "<div id=\"hotarticles\">
\t<h3 class=\"titre\"><span>Articles</span> parmi les plus lus</h3>
\t";
        // line 3
        if (twig_test_empty($this->getContext($context, "articlesPlusLus"))) {
            // line 4
            echo "\t<p class=\"warning\">Pas d'article publié à l'heure actuelle</p>
\t";
        } else {
            // line 6
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articlesPlusLus"));
            foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                // line 7
                echo "\t";
                $context["princeps"] = $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "a"), "lnThematique"));
                // line 8
                echo "\t<div class=\"plusLus ";
                echo twig_escape_filter($this->env, $this->getContext($context, "princeps"), "html", null, true);
                echo "_secondaire\">
\t\t";
                // line 9
                if ((!$this->getAttribute($this->getAttribute($this->getContext($context, "a", true), "lnIllustration", array(), "any", false, true), "fichier", array(), "any", true, true))) {
                    // line 10
                    echo "\t\t    ";
                    $context["alt"] = "Vignette par défaut";
                    // line 11
                    echo "\t\t";
                } else {
                    // line 12
                    echo "\t\t    ";
                    $context["alt"] = $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnIllustration"), "alt");
                    // line 13
                    echo "\t\t";
                }
                // line 14
                echo " \t\t";
                $context["r"] = $this->getAttribute($this->getContext($context, "a"), "rubriques");
                // line 15
                echo "\t\t<div class=\"rubriqueMarqueur coin_";
                echo twig_escape_filter($this->env, $this->getContext($context, "princeps"), "html", null, true);
                echo "\">
\t\t\t<a href=\"";
                // line 16
                echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "a")), "html", null, true);
                echo "\">
\t \t\t\t<img class=\"iconex40\" src=\"";
                // line 17
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "a")), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getContext($context, "alt"), "html", null, true);
                echo "\" />
 \t\t\t</a>
 \t\t</div>
 \t\t";
                // line 20
                if (twig_test_empty($this->getAttribute($this->getContext($context, "a"), "abstract"))) {
                    // line 21
                    echo " \t\t";
                    $context["abstract"] = twig_slice($this->env, $this->getAttribute($this->getContext($context, "a"), "corps"), 0, 80);
                    // line 22
                    echo " \t\t";
                } else {
                    // line 23
                    echo " \t\t";
                    $context["abstract"] = twig_slice($this->env, $this->getAttribute($this->getContext($context, "a"), "abstract"), 0, 80);
                    // line 24
                    echo " \t\t";
                }
                // line 25
                echo "\t\t\t<p style=\"margin:0\">
\t\t\t\t<a href=\"";
                // line 26
                echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "a")), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                echo "</a>
\t\t\t</p>
\t\t\t<p class=\"credits\">Par <a href=\"";
                // line 28
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "idNana"))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "prenom") . " ") . $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "nom")), "html", null, true);
                echo "</a>, ";
                echo twig_escape_filter($this->env, $this->env->getExtension('age_extension')->lapsFilter($this->getAttribute($this->getContext($context, "a"), "datePublication")), "html", null, true);
                echo "</p>
\t</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 31
            echo "\t";
        }
        // line 32
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Bloc:articlesPlusLus.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 32,  93 => 26,  90 => 25,  76 => 20,  68 => 17,  59 => 15,  34 => 7,  29 => 6,  25 => 4,  23 => 3,  136 => 44,  132 => 42,  121 => 39,  104 => 34,  94 => 32,  53 => 13,  50 => 12,  45 => 17,  42 => 9,  74 => 27,  70 => 25,  64 => 16,  61 => 22,  55 => 20,  52 => 19,  47 => 11,  40 => 15,  37 => 8,  31 => 11,  123 => 40,  117 => 37,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 30,  95 => 29,  92 => 31,  87 => 24,  84 => 23,  81 => 22,  79 => 24,  67 => 24,  65 => 18,  58 => 21,  44 => 10,  41 => 10,  33 => 12,  28 => 6,  26 => 5,  21 => 2,  19 => 1,  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 41,  124 => 43,  118 => 40,  113 => 31,  107 => 35,  102 => 35,  100 => 28,  96 => 32,  86 => 28,  78 => 21,  75 => 25,  73 => 26,  66 => 19,  63 => 18,  60 => 17,  56 => 14,  54 => 13,  49 => 18,  46 => 9,  39 => 9,  36 => 5,  30 => 3,);
    }
}
