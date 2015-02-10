<?php

/* CoreBundle:Bloc:homeContent.html.twig */
class __TwigTemplate_6eb044f73e03b46e65c8e5950bea084d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Default:TDNDocument.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'contenu_principal' => array($this, 'block_contenu_principal'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DocumentBundle:Default:TDNDocument.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Webzine participatif d'actualité beauté, mode, déco, psycho, forme";
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/fil.css"), "html", null, true);
        echo "\" />
";
    }

    // line 9
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 10
        echo "<div id=\"sommaire-home\">
\t<div id=\"redaction\">
\t\t<div id=\"slider\">
\t\t";
        // line 13
        echo $this->env->getExtension('actions')->renderAction("DocumentBundle:Slider:show", array("limite" => 6), array());
        // line 14
        echo "\t\t</div>
\t\t<div id=\"derniers-contenus\">
\t\t\t";
        // line 17
        echo "\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("RedactionBundle:Partial:articlesRecents", array("limite" => 40), array());
        // line 18
        echo "\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("ConseilExpertBundle:Partial:conseilsRecents", array("limite" => 40), array());
        // line 19
        echo "\t\t</div>
\t</div>

\t<div id=\"social\">
\t\t<div id=\"teaserQuestion\">
\t\t\t";
        // line 24
        if (array_key_exists("question", $context)) {
            // line 25
            echo "\t\t\t<p class=\"titre\">
\t\t\t\t<a href=\"";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_conversation", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "question"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "question"), "slug"), "id" => $this->getAttribute($this->getContext($context, "question"), "idDocument"))), "html", null, true);
            echo "\">&nbsp;";
            echo $this->env->getExtension('document_extension')->glueSpacesFilter($this->getAttribute($this->getContext($context, "question"), "titre"));
            echo "&nbsp;</a>
\t\t\t</p>
\t\t\t<p class=\"auteur\">
\t\t\t\t<a href=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "idNana"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "username"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getContext($context, "ageAuteurDerniereQuestion"), "html", null, true);
            echo "</a>
\t\t\t</p>
\t\t\t";
        }
        // line 32
        echo "\t\t\t
\t\t</div>
\t\t";
        // line 34
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 35
            echo "\t\t<a class=\"linkQuestion\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_creer"), "html", null, true);
            echo "\">
\t\t\t<img class=\"boutonRetractable\" src=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/social/question_button.png"), "html", null, true);
            echo "\" alt=\"Questionne les nanas !\" />
\t\t</a>
\t\t";
        } else {
            // line 39
            echo "\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_registerForm"), "html", null, true);
            echo "\" class=\"linkQuestionNoFollow lienFleche popin\">
\t\t\t<img class=\"boutonRetractable\" src=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/social/question_button.png"), "html", null, true);
            echo "\" alt=\"Questionne les nanas !\" />
\t\t</a>
\t\t";
        }
        // line 43
        echo "\t\t\t
\t\t<div id=\"fil-info\">
\t\t\t<div id=\"fil-info-header\">
\t\t\t\t";
        // line 46
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 47
            echo "\t\t\t\t<form >
\t\t\t\t\t<input id=\"fakeInfoForm\" type=\"text\" value=\"Poste ton info ...\" />
\t\t\t\t</form>
\t\t\t\t<div class=\"fantomeInfoForm\">
\t\t\t\t\t<form action=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_poster"), "html", null, true);
            echo "\" method=\"post\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "formBreve"), 'enctype');
            echo ">
\t\t\t\t\t\t<button class=\"closeBreve\" style=\"background-image:url(/assets/images/theme/inscription/picto_closed.png); border:0;height:20px;position:absolute;right:10px;top:10px;width:20px\"></button>
\t    \t\t\t\t";
            // line 53
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "message"), 'row');
            echo "
\t    \t\t\t\t<p><span id=\"signesBreve\">0</span> (sur 250 car. maximum)</p>
\t    \t\t\t\t";
            // line 55
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "url"), 'row');
            echo "
\t    \t\t\t\t";
            // line 56
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "lnRubrique"), 'row');
            echo "
\t    \t\t\t\t";
            // line 57
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "formBreve"), 'rest');
            echo "
\t    \t\t\t\t<input type=\"submit\" />
\t\t\t\t\t\t<img src=\"";
            // line 59
            echo "\" class=\"\" style=\"width:58px\" />
\t    \t\t\t</form>
\t\t\t\t</div>
\t\t\t\t";
        } else {
            // line 63
            echo "\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_registerForm"), "html", null, true);
            echo "\" id=\"fakeInfoForm\" class=\"blurPrompt popin\">
\t\t\t\tConnecte-toi pour poster une info
\t\t\t\t</a>
\t\t\t\t";
        }
        // line 67
        echo "\t\t\t</div>
\t\t\t<div id=\"fil-info-next\"></div>
\t\t\t<div id=\"fil-home\" class=\"masqueContenu nano\">
\t\t\t\t<div class=\"content\">
\t\t\t\t";
        // line 71
        if (twig_test_empty($this->getContext($context, "filInfo"))) {
            // line 72
            echo "\t\t\t\t\t<p class=\"warning\">Aucune info sur TDN</p>
\t\t\t\t";
        } else {
            // line 74
            echo "\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "filInfo"));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 75
                echo "\t\t\t\t\t<p class=\"rubriqueFilInfo ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "slug"), "html", null, true);
                echo "_texte\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "titre"), "html", null, true);
                echo "</p>
\t\t\t\t\t<div class=\"blocInfo\">
\t\t\t\t\t    <img class=\"avatarInfo\" src=\"";
                // line 77
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "i"), "lnAuteur"), "sqr_"), "html", null, true);
                echo "\" />
\t\t\t\t\t    <p class=\"auteurInfo\">
\t\t\t\t\t    \t<span class=\"";
                // line 79
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "slug"), "html", null, true);
                echo "_texte\" style=\"color: #888\">
\t\t\t\t\t    \t\t<strong>";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnAuteur"), "username"), "html", null, true);
                echo "</strong>
\t\t\t\t\t    \t</span>, ";
                // line 81
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "datePublication"), "d/m H:i"), "html", null, true);
                echo "</p>
\t\t\t\t\t    <p class=\"auteurRole etiquetteStandard\" style=\"color: #72B6B6;\">";
                // line 82
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnAuteur"), "roles"), 0, array(), "array"), "name"), "html", null, true);
                echo "</p>
\t\t\t\t\t    <p class=\"texteInfo\">";
                // line 83
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "message"), "html", null, true);
                echo "</p>
\t\t\t\t\t    ";
                // line 84
                if ((!(null === $this->getAttribute($this->getContext($context, "i"), "url")))) {
                    // line 85
                    echo "\t\t\t\t\t    <a class=\"urlInfo\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "tinyURL"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "tinyURL"), "html", null, true);
                    echo "</a>
\t\t\t\t\t    ";
                }
                // line 87
                echo "\t\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 89
            echo "\t\t\t\t";
        }
        // line 90
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"fil-info-previous\"></div>
\t\t\t<div id=\"fil-info-footer\"> <a href=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_fil"), "html", null, true);
        echo "\">Voir le fil entier <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/forms/bt_fleche_droite_small.png"), "html", null, true);
        echo "\"style=\"border:0px; margin-left:5px\" align=\"absmiddle\"/> </a> </div>
\t\t</div>
\t</div>
</div>
<div id=\"teaserVideos\" class=\"home_secondaire\">
\t<img class=\"twist pinned\" src=\"";
        // line 98
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/videos/icone_video.png"), "html", null, true);
        echo "\" />
\t<div class='videoColumns'>
\t\t<div class=\"sommaire\">
\t\t\t<h2>Vidéos</h2>
\t\t\t";
        // line 102
        if ((!twig_test_empty($this->getContext($context, "video")))) {
            // line 103
            echo "\t\t\t<h3>
\t\t\t\t<a href=\"";
            // line 104
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_video", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "video"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "video"), "slug"), "id" => $this->getAttribute($this->getContext($context, "video"), "idDocument"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "video"), "titre"), "html", null, true);
            echo "</a>
\t\t\t</h3>
\t\t\t<p class=\"videoAbstract\">";
            // line 106
            echo $this->getContext($context, "videoAbstract");
            echo "</p>
\t\t\t<!-- form>
\t\t\t\t<input type=\"text\" value=\"Ton commentaire ...\" style=\"width:300px; height:22px; margin-bottom:8px\">
\t\t\t</form -->
\t\t\t";
        }
        // line 111
        echo "\t\t\t<div class=\"videosRecentes\">
\t\t\t";
        // line 112
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "videosRecentes"));
        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
            // line 113
            echo "\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_video", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "v"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "v"), "slug"), "id" => $this->getAttribute($this->getContext($context, "v"), "idDocument"))), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 114
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "v"), "vignette")))) {
                // line 115
                echo "              \t\t<img class=\"snapshot\" src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "v"), "vignette"), "html", null, true);
                echo "\" class=\"\" style=\"width:58px\" />
            \t";
            } else {
                // line 117
                echo "              \t\t<img class=\"snapshot\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "v")), "html", null, true);
                echo "\" class=\"\" style=\"width:58px\" />
            \t";
            }
            // line 119
            echo "\t\t\t\t</a>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 121
        echo "\t\t\t</div>
\t\t\t<div class=\"videosToutes\">
\t\t\t\t<a href=\"";
        // line 123
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_sommaire"), "html", null, true);
        echo "\">Toutes les vidéos <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/forms/bt_fleche_droite_small.png"), "html", null, true);
        echo "\"style=\"border:0px; margin-left:5px\" align=\"absmiddle\"/></a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"scene\">
\t\t";
        // line 127
        if (array_key_exists("codeIntegration", $context)) {
            // line 128
            echo "\t\t";
            echo $this->getContext($context, "codeIntegration");
            echo "
\t\t";
        }
        // line 130
        echo "\t\t</div>
\t</div>
</div>
<div id=\"hotplaces\">
\t";
        // line 134
        echo $this->env->getExtension('actions')->renderAction("RedactionBundle:Partial:articlesPlusLus", array("limite" => 3), array());
        // line 135
        echo "\t";
        echo $this->env->getExtension('actions')->renderAction("ConseilExpertBundle:Partial:conseilsPlusLus", array("limite" => 3), array());
        // line 136
        echo "</div>

";
        // line 138
        echo $this->env->getExtension('actions')->renderAction("ProduitBundle:Partial:panoramaCoupsDeCoeur", array("limite" => 8), array());
        // line 139
        echo "
<script type=\"text/javascript\">
\t\$(document).ready(function () {
\t\t\$(\"#fakeInfoForm\").on('focus', function (e) {
\t\t\t\$(\".fantomeInfoForm\").css('display', 'block');
\t\t\t\$(\"#tdn3_breve_message\").focus();
\t\t});
\t\t\$(\".closeBreve\").on('click', function () {
\t\t\t\$(\"#tdn3_breve_message\").blur();
\t\t\t\$(\".fantomeInfoForm\").css('display', 'none');
\t\t});
\t\t\$(\"#tdn3_breve_message\").keydown(function () {
\t\t\tif (\$(this).val().length > 250) \$(this).val(\$(this).val().substr(0,250));\t
\t\t});
\t\t\$(\"#tdn3_breve_message\").keyup(function () {
\t\t\t\$(\"#signesBreve\").html(\$(this).val().length);
\t\t\tif (\$(this).val().length > 225) \$(\"#signesBreve\").css(\"color\", \"#600\")
\t\t\telse  \$(\"#signesBreve\").css(\"color\", \"#060\");
\t\t});
\t});

</script>
";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Bloc:homeContent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  359 => 139,  357 => 138,  353 => 136,  350 => 135,  348 => 134,  342 => 130,  336 => 128,  334 => 127,  325 => 123,  321 => 121,  314 => 119,  308 => 117,  302 => 115,  300 => 114,  295 => 113,  291 => 112,  288 => 111,  280 => 106,  273 => 104,  270 => 103,  268 => 102,  261 => 98,  251 => 93,  246 => 90,  243 => 89,  236 => 87,  228 => 85,  226 => 84,  222 => 83,  218 => 82,  214 => 81,  210 => 80,  206 => 79,  201 => 77,  193 => 75,  188 => 74,  184 => 72,  182 => 71,  176 => 67,  168 => 63,  162 => 59,  157 => 57,  153 => 56,  149 => 55,  144 => 53,  137 => 51,  131 => 47,  129 => 46,  124 => 43,  118 => 40,  113 => 39,  107 => 36,  102 => 35,  100 => 34,  96 => 32,  86 => 29,  78 => 26,  75 => 25,  73 => 24,  66 => 19,  63 => 18,  60 => 17,  56 => 14,  54 => 13,  49 => 10,  46 => 9,  39 => 6,  36 => 5,  30 => 3,);
    }
}
