<?php

/* ProduitBundle:Bloc:panoramaCoupsDeCoeur.html.twig */
class __TwigTemplate_ffa6547925bbc23d16f619d7fffe5fda extends Twig_Template
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
        echo "<div id=\"selection-shopping\">
\t<h3 class=\"titreBicolore\"><span class=\"gris\">Nos coups de coeur</span> shopping</h3>
\t<div id=\"slider-shopping\">
\t\t<img class=\"cell left\" src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/sommaire/shopping/left.png"), "html", null, true);
        echo "\" />
\t\t<div id=\"scene-shopping\" class=\"cell\">
\t\t\t<div class=\"conteneur\">
\t\t\t\t<div class=\"flux-shopping\">
\t\t\t\t\t";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "coupsDeCoeur"));
        foreach ($context['_seq'] as $context["_key"] => $context["produit"]) {
            // line 9
            echo "\t\t\t\t\t<figure class=\"snapshotProduit\">
\t\t\t\t\t\t<a href=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_showProduit", array("id" => $this->getAttribute($this->getContext($context, "produit"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "produit"), "slug"))), "html", null, true);
            echo "\">
\t\t\t\t\t\t\t<img src=\"";
            // line 11
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "produit")), "html", null, true);
            echo "\"/>
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<figcaption>
\t\t\t\t\t\t\t<a href=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_showProduit", array("id" => $this->getAttribute($this->getContext($context, "produit"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "produit"), "slug"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "titre"), "html", null, true);
            echo "</a>\t\t\t\t\t
\t\t\t\t\t\t</figcaption>
\t\t\t\t\t</figure>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['produit'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 18
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<img class=\"cell right\" src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/sommaire/shopping/right.png"), "html", null, true);
        echo "\" />
\t</div>
</div>
<script type=\"text/javascript\">

\tvar move;
\tfunction moveleft () {
\t\tvar pos = \$('.flux-shopping').css('left');
\t\tconsole.log(pos.slice(0,-2));
\t\tif (parseInt(pos.slice(0,-2)) <= 0) {
\t\t\tclearInterval(move)
\t\t} else {
\t\t\t\$('.flux-shopping').css('left', '-=4');
\t\t}
\t}
\t
\tfunction moveright () {
\t\tvar pos = \$('.flux-shopping').css('left');
\t\tconsole.log(pos.slice(0,-2));
\t\tif (parseInt(pos.slice(0,-2)) >= 742) {
\t\t\tclearInterval(move)
\t\t} else {
\t\t\t\$('.flux-shopping').css('left', '+=4');
\t\t}
\t}

\t\$(document).ready(function() {
\t\t\$('.flux-shopping').draggable({
\t\t\t'axis': 'x',
\t\t\t'containment': 'parent',
\t\t\t'scroll': false
\t\t});
\t\t\$('#selection-shopping .right').mousedown(function () {
\t\t\tconsole.log('down');
\t\t\tmove = setInterval(moveleft, 10);
\t\t})
\t\t\$('#selection-shopping .right').mouseup(function () {
\t\t\tclearInterval(move);
\t\t})
\t\t\$('#selection-shopping .left').mousedown(function () {
\t\t\tconsole.log('down');
\t\t\tmove = setInterval(moveright, 10);
\t\t})
\t\t\$('#selection-shopping .left').mouseup(function () {
\t\t\tclearInterval(move);
\t\t})
\t});
</script>
";
    }

    public function getTemplateName()
    {
        return "ProduitBundle:Bloc:panoramaCoupsDeCoeur.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 14,  38 => 10,  35 => 9,  24 => 4,  122 => 34,  119 => 33,  109 => 30,  99 => 27,  91 => 25,  82 => 21,  43 => 10,  116 => 32,  93 => 26,  90 => 25,  76 => 20,  68 => 17,  59 => 14,  34 => 7,  29 => 6,  25 => 4,  23 => 3,  136 => 44,  132 => 42,  121 => 39,  104 => 34,  94 => 32,  53 => 13,  50 => 12,  45 => 17,  42 => 11,  74 => 27,  70 => 18,  64 => 16,  61 => 15,  55 => 20,  52 => 13,  47 => 11,  40 => 9,  37 => 8,  31 => 8,  123 => 40,  117 => 37,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 28,  95 => 29,  92 => 31,  87 => 24,  84 => 23,  81 => 22,  79 => 24,  67 => 17,  65 => 21,  58 => 21,  44 => 10,  41 => 10,  33 => 12,  28 => 6,  26 => 5,  21 => 2,  19 => 1,  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 41,  124 => 43,  118 => 40,  113 => 31,  107 => 35,  102 => 35,  100 => 28,  96 => 32,  86 => 28,  78 => 20,  75 => 25,  73 => 19,  66 => 19,  63 => 18,  60 => 18,  56 => 14,  54 => 13,  49 => 12,  46 => 11,  39 => 9,  36 => 5,  30 => 3,);
    }
}
