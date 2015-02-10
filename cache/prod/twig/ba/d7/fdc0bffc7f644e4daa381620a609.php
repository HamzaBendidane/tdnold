<?php

/* RedactionBundle:Bloc:articlesRecents.html.twig */
class __TwigTemplate_bad7fdc0bffc7f644e4daa381620a609 extends Twig_Template
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
        echo "<div id=\"articles\">
\t<h3 class=\"titreBicolore\"><span class=\"strong\">Articles</span> de la Rédac’</h3>
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
        if (twig_test_empty($this->getContext($context, "articlesRecents"))) {
            // line 12
            echo "\t<p class=\"warning\">Pas d'article publié à l'heure actuelle</p>
\t";
        } else {
            // line 14
            echo "\t\t<div class=\"content\">
\t\t";
            // line 15
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articlesRecents"));
            foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                // line 16
                echo "\t\t\t<div class=\"blocArticle\">
\t\t\t\t";
                // line 17
                if (($this->getAttribute($this->getContext($context, "a"), "statut") == "ARTICLE_PUBLIE")) {
                    // line 18
                    echo "\t\t\t\t";
                    $context["controleur"] = "RedactionBundle_article";
                    // line 19
                    echo "\t\t\t\t";
                } else {
                    // line 20
                    echo "\t\t\t\t";
                    $context["controleur"] = "Redaction_showSelection";
                    // line 21
                    echo "\t\t\t\t";
                }
                // line 22
                echo "\t\t\t\t";
                if (true) {
                    // line 23
                    echo "\t\t\t\t<a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "a")), "html", null, true);
                    echo "\">
\t\t\t\t";
                } else {
                    // line 25
                    echo "\t\t\t\t<a href=\"#\">
\t\t\t\t";
                }
                // line 27
                echo "\t\t \t\t\t<img class=\"iconex200\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "a"), "SQUARE"), "html", null, true);
                echo "\"";
                if ((!twig_test_empty($this->getAttribute($this->getContext($context, "a"), "lnIllustration")))) {
                    echo " alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnIllustration"), "alt"), "html", null, true);
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnIllustration"), "alt"), "html", null, true);
                }
                echo "\" />
\t \t\t\t\t<p class=\"apercuTitre\">";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                echo "</p>
\t\t\t\t</a>
 \t\t\t</div>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 32
            echo "\t\t</div>
\t";
        }
        // line 34
        echo "\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Bloc:articlesRecents.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 27,  70 => 25,  64 => 23,  61 => 22,  55 => 20,  52 => 19,  47 => 17,  40 => 15,  37 => 14,  31 => 11,  123 => 37,  117 => 36,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 30,  95 => 29,  92 => 28,  87 => 27,  84 => 26,  81 => 25,  79 => 24,  67 => 19,  65 => 18,  58 => 21,  44 => 16,  41 => 10,  33 => 12,  28 => 6,  26 => 5,  21 => 2,  19 => 1,  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 46,  124 => 43,  118 => 40,  113 => 39,  107 => 36,  102 => 35,  100 => 34,  96 => 32,  86 => 28,  78 => 26,  75 => 25,  73 => 20,  66 => 19,  63 => 18,  60 => 17,  56 => 14,  54 => 13,  49 => 18,  46 => 9,  39 => 9,  36 => 5,  30 => 3,);
    }
}
