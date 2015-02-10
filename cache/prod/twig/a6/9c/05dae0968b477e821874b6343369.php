<?php

/* CoreBundle:Bloc:sommaireContent.html.twig */
class __TwigTemplate_a69c05dae0968b477e821874b6343369 extends Twig_Template
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
        if (array_key_exists("titrePage", $context)) {
            echo twig_escape_filter($this->env, $this->getContext($context, "titrePage"), "html", null, true);
        }
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/sommaire.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/fil.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/form.css"), "html", null, true);
        echo "\" />
";
    }

    // line 11
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 12
        echo "<div class=\"postitSommaire\">
\t";
        // line 13
        if (array_key_exists("rubriqueEntity", $context)) {
            // line 14
            echo "\t\t";
            $context["rubriquePrincipale"] = $this->getAttribute($this->getContext($context, "rubriqueEntity"), "slug");
            // line 15
            echo "\t";
        } else {
            // line 16
            echo "\t\t";
            $context["rubriquePrincipale"] = $this->getContext($context, "rubrique");
            // line 17
            echo "\t";
        }
        // line 18
        echo "\t<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getContext($context, "rubriquePrincipale"))), "html", null, true);
        echo "\">
\t\t<img src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("assets/images/theme/centre/titres/" . $this->getContext($context, "rubriquePrincipale")) . "_titre_299x80.png")), "html", null, true);
        echo "\" />
\t</a>
</div>

<div id=\"sommaire-rubrique\">
\t<div id=\"redaction\">
\t\t<div id=\"derniers-contenus\">
\t\t\t";
        // line 26
        echo $this->env->getExtension('actions')->renderAction("RedactionBundle:Partial:articlesRecents", array("limite" => 40, "panel" => $this->getContext($context, "panel")), array());
        // line 27
        echo "\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("ConseilExpertBundle:Partial:conseilsRecents", array("limite" => 40, "panel" => $this->getContext($context, "panel")), array());
        // line 28
        echo "\t\t</div>
\t</div>
\t<div id=\"social\">
\t\t<div id=\"teaserQuestion\">
\t\t\t";
        // line 32
        if (array_key_exists("question", $context)) {
            // line 33
            echo "\t\t\t<p class=\"titre\">
\t\t\t\t<a href=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_conversation", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "question"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "question"), "slug"), "id" => $this->getAttribute($this->getContext($context, "question"), "idDocument"))), "html", null, true);
            echo "\">&nbsp;";
            echo $this->env->getExtension('document_extension')->glueSpacesFilter($this->getAttribute($this->getContext($context, "question"), "titre"));
            echo "&nbsp;</a>
\t\t\t</p>
\t\t\t<p class=\"auteur\">
\t\t\t\t<a href=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "idNana"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "username"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getContext($context, "ageAuteurDerniereQuestion"), "html", null, true);
            echo "</a>
\t\t\t</p>
\t\t\t";
        }
        // line 40
        echo "\t\t</div>

\t\t";
        // line 42
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 43
            echo "\t\t<a class=\"linkQuestion\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_creer"), "html", null, true);
            echo "\">
\t\t\t<img class=\"boutonRetractable\" src=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/social/question_button.png"), "html", null, true);
            echo "\" alt=\"Questionne les nanas !\" />
\t\t</a>
\t\t";
        } else {
            // line 47
            echo "\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_registerForm"), "html", null, true);
            echo "\" class=\"linkQuestionNoFollow lienFleche popin\">
\t\t\t<img class=\"boutonRetractable\" src=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/social/question_button.png"), "html", null, true);
            echo "\" alt=\"Questionne les nanas !\" />
\t\t</a>
\t\t";
        }
        // line 51
        echo "\t\t\t

\t\t<div id=\"fil-info\">
\t\t\t<div id=\"fil-info-header\">
\t\t\t\t";
        // line 55
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            echo " 
\t\t\t\t<form >
\t\t\t\t\t<input id=\"fakeInfoForm\" type=\"text\" value=\"Poste ton info ...\" />
\t\t\t\t</form>
\t\t\t\t<div class=\"fantomeInfoForm\">
\t\t\t\t\t<form action=\"";
            // line 60
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_poster"), "html", null, true);
            echo "\" method=\"post\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "formBreve"), 'enctype');
            echo ">
\t\t\t\t\t\t<button class=\"closeBreve\" style=\"background-image:url(/assets/images/theme/inscription/picto_closed.png); border:0;height:20px;position:absolute;right:10px;top:10px;width:20px\"></button>
\t    \t\t\t\t";
            // line 62
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "message"), 'row');
            echo "
\t    \t\t\t\t<p><span id=\"signesBreve\">0</span> (sur 250 car. maximum)</p>
\t    \t\t\t\t";
            // line 64
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "url"), 'row');
            echo "
\t    \t\t\t\t";
            // line 65
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formBreve"), "lnRubrique"), 'row');
            echo "
\t    \t\t\t\t";
            // line 66
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "formBreve"), 'rest');
            echo "
\t    \t\t\t\t<input type=\"submit\" />
\t\t\t\t\t\t<img src=\"";
            // line 68
            echo "\" class=\"\" style=\"width:58px\" />
\t    \t\t\t</form>
\t\t\t\t</div>
\t\t\t\t";
        } else {
            // line 72
            echo "\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_registerForm"), "html", null, true);
            echo "\" id=\"fakeInfoForm\" class=\"blurPrompt popin\">
\t\t\t\tConnecte-toi pour poster une info
\t\t\t\t</a>
    \t\t\t";
        }
        // line 76
        echo "\t\t\t</div>
\t\t\t<div id=\"fil-info-next\"></div>
\t\t\t<div id=\"fil-home\" class=\"masqueContenu nano\">
\t\t\t\t<div class=\"content\">
\t\t\t\t";
        // line 80
        if (twig_test_empty($this->getContext($context, "filInfo"))) {
            // line 81
            echo "\t\t\t\t\t<p class=\"warning\">Aucune info sur TDN</p>
\t\t\t\t";
        } else {
            // line 83
            echo "\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "filInfo"));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 84
                echo "\t\t\t\t\t<p class=\"rubriqueFilInfo ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "slug"), "html", null, true);
                echo "_texte\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "titre"), "html", null, true);
                echo "</p>
\t\t\t\t\t<div class=\"blocInfo\">
\t\t\t\t\t\t";
                // line 86
                if (false) {
                    // line 87
                    echo "\t\t\t\t\t    ";
                    $context["sourceAvatar"] = ((("/uploads/documents/profils/" . $this->getAttribute($this->getContext($context, "me"), "idNana")) . "/") . $this->getAttribute($this->getAttribute($this->getContext($context, "me"), "lnAvatar"), "fichier"));
                    // line 88
                    echo "\t\t\t\t\t    ";
                } else {
                    // line 89
                    echo "\t\t\t\t\t    ";
                    $context["sourceAvatar"] = "assets/images/theme/centre/avatar_profil/avatar5%2080x95.png";
                    // line 90
                    echo "\t\t\t\t\t    ";
                }
                // line 91
                echo "\t\t\t\t\t    <img class=\"avatarInfo\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceAvatar")), "html", null, true);
                echo "\" />
\t\t\t\t\t    <p class=\"auteurInfo ";
                // line 92
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnRubrique"), "slug"), "html", null, true);
                echo "_texte\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnAuteur"), "username"), "html", null, true);
                echo ", ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "datePublication"), "d/m H:i"), "html", null, true);
                echo "</p>
\t\t\t\t\t    <p class=\"auteurRole etiquetteStandard\" >";
                // line 93
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "i"), "lnAuteur"), "roles"), 0, array(), "array"), "name"), "html", null, true);
                echo "</p>
\t\t\t\t\t    <p class=\"texteInfo\">";
                // line 94
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "message"), "html", null, true);
                echo "</p>
\t\t\t\t\t    ";
                // line 95
                if ((!(null === $this->getAttribute($this->getContext($context, "i"), "url")))) {
                    // line 96
                    echo "\t\t\t\t\t    <a class=\"urlInfo\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "tinyURL"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "i"), "tinyURL"), "html", null, true);
                    echo "</a>
\t\t\t\t\t    ";
                }
                // line 98
                echo "\t\t\t\t\t</div>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 100
            echo "\t\t\t\t";
        }
        // line 101
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"fil-info-previous\"></div>
\t\t\t<div id=\"fil-info-footer\"> <a href=\"";
        // line 104
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_fil", array("rubrique" => $this->getContext($context, "rubrique"))), "html", null, true);
        echo "\">Voir le fil entier <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/forms/bt_fleche_droite_small.png"), "html", null, true);
        echo "\"style=\"border:0px; margin-left:5px\" align=\"absmiddle\"/> </a> </div>
\t\t</div>
\t</div>
</div>
<div id=\"teaserVideos\" class=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->getContext($context, "rubrique"), "html", null, true);
        echo "_secondaire\">
\t<img class=\"twist pinned\" src=\"";
        // line 109
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/videos/icone_video.png"), "html", null, true);
        echo "\" />
\t<div class='videoColumns'>
\t\t<div class=\"sommaire\">
\t\t\t<h2>Vidéos</h2>
\t\t\t";
        // line 113
        if ((!(null === $this->getContext($context, "video")))) {
            // line 114
            echo "\t\t\t<h3>
\t\t\t\t<a href=\"";
            // line 115
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_video", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "video"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "video"), "slug"), "id" => $this->getAttribute($this->getContext($context, "video"), "idDocument"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "video"), "titre"), "html", null, true);
            echo "</a>
\t\t\t</h3>
\t\t\t<p class=\"videoAbstract\">";
            // line 117
            echo $this->getContext($context, "videoAbstract");
            echo "</p>
\t\t\t";
        }
        // line 119
        echo "\t\t\t<!-- form>
\t\t\t\t<input type=\"text\" value=\"Ton commentaire ...\" style=\"width:300px; height:22px; margin-bottom:8px\">
\t\t\t</form -->
\t\t\t<div class=\"videosRecentes\">
\t\t\t";
        // line 123
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "videosRecentes"));
        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
            // line 124
            echo "\t\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_video", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "v"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "v"), "slug"), "id" => $this->getAttribute($this->getContext($context, "v"), "idDocument"))), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 125
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "v"), "vignette")))) {
                // line 126
                echo "              \t\t<img class=\"snapshot\" src=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "v"), "vignette"), "html", null, true);
                echo "\" class=\"\" style=\"width:58px\" />
            \t";
            } else {
                // line 128
                echo "              \t\t<img class=\"snapshot\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "v")), "html", null, true);
                echo "\" class=\"\" style=\"width:58px\" />
            \t";
            }
            // line 130
            echo "\t\t\t\t</a>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 132
        echo "\t\t\t</div>
\t\t\t<div class=\"videosToutes\">
\t\t\t\t<a href=\"";
        // line 134
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("VideoBundle_sommaire"), "html", null, true);
        echo "\">Toutes les vidéos <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/forms/bt_fleche_droite_small.png"), "html", null, true);
        echo "\"style=\"border:0px; margin-left:5px\" align=\"absmiddle\"/></a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"scene\">
\t\t";
        // line 138
        if (array_key_exists("codeIntegration", $context)) {
            echo $this->getContext($context, "codeIntegration");
        }
        // line 139
        echo "\t\t</div>
\t</div>
</div>
<div id=\"hotplaces\">
\t";
        // line 143
        echo $this->env->getExtension('actions')->renderAction("RedactionBundle:Partial:articlesPlusLus", array("limite" => 3, "panel" => $this->getContext($context, "panel")), array());
        // line 144
        echo "\t";
        echo $this->env->getExtension('actions')->renderAction("ConseilExpertBundle:Partial:conseilsPlusLus", array("limite" => 3, "panel" => $this->getContext($context, "panel")), array());
        // line 145
        echo "</div>

";
        // line 147
        echo $this->env->getExtension('actions')->renderAction("ProduitBundle:Partial:panoramaCoupsDeCoeur", array("limite" => 8), array());
        // line 148
        echo "
<script type=\"text/javascript\">
\t\$(document).ready(function () {
\t\t\$(\"#fakeInfoForm\").on('focus', function (e) {
\t\t\t\$(\".fantomeInfoForm\").css('display', 'block');
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
\t})

</script>
";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Bloc:sommaireContent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  398 => 148,  396 => 147,  392 => 145,  389 => 144,  387 => 143,  381 => 139,  377 => 138,  368 => 134,  364 => 132,  357 => 130,  351 => 128,  345 => 126,  343 => 125,  338 => 124,  334 => 123,  328 => 119,  323 => 117,  316 => 115,  313 => 114,  311 => 113,  304 => 109,  300 => 108,  291 => 104,  286 => 101,  283 => 100,  276 => 98,  268 => 96,  266 => 95,  262 => 94,  258 => 93,  250 => 92,  245 => 91,  242 => 90,  239 => 89,  236 => 88,  233 => 87,  231 => 86,  223 => 84,  218 => 83,  214 => 81,  212 => 80,  206 => 76,  198 => 72,  192 => 68,  187 => 66,  183 => 65,  179 => 64,  174 => 62,  167 => 60,  159 => 55,  153 => 51,  147 => 48,  142 => 47,  136 => 44,  131 => 43,  129 => 42,  125 => 40,  115 => 37,  107 => 34,  104 => 33,  102 => 32,  96 => 28,  93 => 27,  91 => 26,  81 => 19,  76 => 18,  73 => 17,  70 => 16,  67 => 15,  64 => 14,  62 => 13,  59 => 12,  56 => 11,  50 => 8,  46 => 7,  41 => 6,  38 => 5,  30 => 3,);
    }
}
