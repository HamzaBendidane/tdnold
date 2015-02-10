<?php

/* DocumentBundle:Slider:sliderPlayer.html.twig */
class __TwigTemplate_4617e9af6ac320f2edfb15c6c7931bd5 extends Twig_Template
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
        if ((!twig_test_empty($this->getContext($context, "slider")))) {
            // line 2
            echo "<div id=\"scene\">
\t<div class=\"slides step_1\">
\t\t<div class=\"c_slider\"></div>
\t\t";
            // line 5
            $context["i"] = 0;
            // line 6
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "slider"));
            foreach ($context['_seq'] as $context["_key"] => $context["slide"]) {
                // line 7
                echo "\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "routes"), $this->getContext($context, "i"), array(), "array"), "html", null, true);
                echo "\">
\t\t\t<figure class=\"slideEnveloppe\">
\t\t\t\t";
                // line 9
                $context["y"] = twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "slide"), "lnCover"), "datePublication"), "Y");
                // line 10
                echo "\t\t\t\t";
                $context["m"] = twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "slide"), "lnCover"), "datePublication"), "m");
                // line 11
                echo "\t\t\t\t<img  class=\"slideImage\" src=\"/uploads/documents/public/";
                echo twig_escape_filter($this->env, $this->getContext($context, "y"), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getContext($context, "m"), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "slide"), "lnCover"), "fichier"), "html", null, true);
                echo "\" />
\t\t\t\t<figcaption>
\t\t\t\t\t<p class=\"titre\">";
                // line 13
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "slide"), "lnSource"), "titre"), 0, 140), "html", null, true);
                echo "</p>
\t\t\t\t\t<p class=\"pitch\">";
                // line 14
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "slide"), "pitch"), "html", null, true);
                echo "</p>
\t\t\t\t</figcation>
\t\t\t</figure>
\t\t</a>
\t\t";
                // line 18
                $context["i"] = ($this->getContext($context, "i") + 1);
                // line 19
                echo "\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slide'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 20
            echo "\t</div>
</div>
<div id=\"commande\"> 
\t<div class=\"controles\">
\t\t";
            // line 24
            $context["debut"] = true;
            // line 25
            echo "\t\t";
            $context["i"] = 1;
            // line 26
            echo "\t\t";
            $context["etat"] = "controleActif";
            // line 27
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "slider"));
            foreach ($context['_seq'] as $context["_key"] => $context["slide"]) {
                // line 28
                echo "\t\t<div class=\"slideSwitchEnveloppe\">
\t\t\t<button id=\"bs_push_";
                // line 29
                echo twig_escape_filter($this->env, $this->getContext($context, "i"), "html", null, true);
                echo "\" class=\"";
                echo twig_escape_filter($this->env, $this->getContext($context, "etat"), "html", null, true);
                echo " slideSwitch\" type=\"button\"></button>
\t\t\t<span class=\"slideCartouche hiddenCartouche\">";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "slide"), "lnSource"), "titre"), "html", null, true);
                echo "</span>
\t\t</div>
\t\t";
                // line 32
                if (($this->getContext($context, "etat") == "controleActif")) {
                    // line 33
                    echo "\t\t";
                    $context["etat"] = "controleInactif";
                    // line 34
                    echo "\t\t";
                }
                // line 35
                echo "\t\t";
                $context["i"] = ($this->getContext($context, "i") + 1);
                // line 36
                echo "\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slide'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 37
            echo "\t</div>
</div>
<div id=\"nextSlide\">
\t<img class=\"slideNextButton\" src=\"/assets/images/theme/sommaire/slider/bt_play.png\" />
</div>
<script type=\"text/javascript\">

\$(document).ready(function () {
\t\$('.slideNextButton').on('click', function (event) {
\t\tevent.stopPropagation();
\t\tvar presentId = \$('.controleActif').prop('id');
\t\tvar elements = presentId.split('_');
\t\tif (elements[2] == 6) {
\t\t\tnext = 1;
\t\t} else {
\t\t\tnext = parseInt(elements[2]) + 1;
\t\t}
\t\tvar id = '#bs_push_'+next;
\t\t\$(id).click();
\t});
\t\$('.slideSwitch').on('click', function () {
\t\tvar \$scene = \$('#scene .slides');
\t\tvar id = \$(this).prop('id');
\t\tvar elements = id.split('_');
\t\tvar classe = 'step_'+elements[2];
\t\tfor (var i = 1; i <= 6; i++) {
\t\t\tif (\$scene.hasClass('step_'+i)) {
\t\t\t\t\$scene.removeClass('step_'+i)
\t\t\t}
\t\t}
\t\t\$scene.addClass(classe);
\t\t\$('.controleActif').toggleClass('controleActif controleInactif');
\t\t\$(this).toggleClass('controleActif controleInactif');
\t});
\t\$('.slideSwitch').on('mouseenter mouseleave', function () {
\t\t\$(this).parent().children('.slideCartouche').toggleClass('visibleCartouche hiddenCartouche');
\t});
\tvar refreshSlider = setInterval(function () {
\t\tvar presentId = \$('.controleActif').prop('id');
\t\tvar elements = presentId.split('_');
\t\tif (elements[2] == 6) {
\t\t\tnext = 1;
\t\t} else {
\t\t\tnext = parseInt(elements[2]) + 1;
\t\t}
\t\tvar id = '#bs_push_'+next;
\t\t\$(id).click();
\t\t}, 5000);
})

</script>
";
        } else {
        }
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Slider:sliderPlayer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 37,  117 => 36,  114 => 35,  111 => 34,  108 => 33,  106 => 32,  101 => 30,  95 => 29,  92 => 28,  87 => 27,  84 => 26,  81 => 25,  79 => 24,  67 => 19,  65 => 18,  58 => 14,  44 => 11,  41 => 10,  33 => 7,  28 => 6,  26 => 5,  21 => 2,  19 => 1,  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 46,  124 => 43,  118 => 40,  113 => 39,  107 => 36,  102 => 35,  100 => 34,  96 => 32,  86 => 29,  78 => 26,  75 => 25,  73 => 20,  66 => 19,  63 => 18,  60 => 17,  56 => 14,  54 => 13,  49 => 10,  46 => 9,  39 => 9,  36 => 5,  30 => 3,);
    }
}
