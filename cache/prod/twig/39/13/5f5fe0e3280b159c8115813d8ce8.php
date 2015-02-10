<?php

/* CommentaireBundle:Flux:flux.html.twig */
class __TwigTemplate_39135f5fe0e3280b159c8115813d8ce8 extends Twig_Template
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
        echo "<div id=\"avis\">
\t<h2 class=\"titreFormContribution\">Ajoute un commentaire</h2>
<form id=\"formCommentaire\" class=\"formUser formCommentaire\" name=\"formCommentaire\" action=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Commentaire_add"), "html", null, true);
        echo "\" class=\"table-content\" method=\"post\">

\t<figure class=\"avatar\">
\t\t<img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "app"), "user")), "html", null, true);
        echo "\" class=\"avatar-image\" alt=\"Avatar ";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user", array(), "any", false, true), "username", array(), "any", true, true)) {
            echo "de ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "username"), "html", null, true);
        }
        echo "\" title=\"";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app", true), "user", array(), "any", false, true), "username", array(), "any", true, true)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "username"), "html", null, true);
        } else {
            echo "Commentateur anonyme";
        }
        echo "\" />
\t</figure>
\t<div id=\"fields\">
\t\t";
        // line 9
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "_token"), 'row');
        echo "
\t\t";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "idThread"), 'row');
        echo "
\t\t<input type=\"hidden\" name=\"idDocument\" id=\"idDocument\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->getContext($context, "idDocument"), "html", null, true);
        echo "\" />
\t\t<div class=\"form-element\">
\t\t\t";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "texteCommentaire"), 'row', array("attr" => array("class" => "texteContribution")));
        echo "
\t\t</div>
\t\t<div class=\"form-element formCellFollow\">
\t\t\t";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "abonne"), 'row');
        echo "
\t\t</div>
\t\t<div class=\"form-element formCellAntispam\">
\t\t\t<label for=\"antispam\" class=\"inline-label\" required><strong>1 + 1 vaut ?</strong> (question anti-spam)</label>
\t\t\t<input type=\"text\" name=\"antispam\" id=\"antispam\" size=\"8\" required />
\t\t</div>
\t</div>
\t
\t\t<input type=\"submit\" name=\"envoiCommentaire\" value=\"Publier\" style=\"float:right; margin-top:10px; margin-right:20px\"/> 
\t
</form>
</div>

";
        // line 29
        if (array_key_exists("commentaires", $context)) {
            // line 30
            echo "<h2 style=\"margin-left:10px; color:#488C8C\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "commentaires")), "html", null, true);
            echo " commentaire";
            if ((twig_length_filter($this->env, $this->getContext($context, "commentaires")) > 1)) {
                echo "s";
            }
            echo "</h2>
<div id=\"flux-commentaires\">
\t";
            // line 32
            if ((!twig_test_empty($this->getContext($context, "commentaires")))) {
                // line 33
                echo "\t\t";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "commentaires"));
                foreach ($context['_seq'] as $context["_key"] => $context["thread"]) {
                    // line 34
                    echo "\t\t\t<div class=\"commentaire-reponses\" data-thread=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "thread"), 0, array(), "array"), 0, array(), "array"), "idThread"), "html", null, true);
                    echo "\">
\t\t\t";
                    // line 35
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable(range(0, 1));
                    foreach ($context['_seq'] as $context["_key"] => $context["parts"]) {
                        // line 36
                        echo "\t\t\t\t";
                        if ($this->getAttribute($this->getContext($context, "thread", true), $this->getContext($context, "parts"), array(), "array", true, true)) {
                            // line 37
                            echo "\t\t\t\t";
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "thread"), $this->getContext($context, "parts"), array(), "array"));
                            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                                // line 38
                                echo "\t\t\t\t";
                                if (($this->getContext($context, "parts") == 0)) {
                                    // line 39
                                    echo "\t\t\t\t\t";
                                    $context["commentClass"] = "isMain";
                                    // line 40
                                    echo "\t\t\t\t\t";
                                    $context["style"] = "visible";
                                    // line 41
                                    echo "\t\t\t\t";
                                } else {
                                    // line 42
                                    echo "\t\t\t\t\t";
                                    $context["commentClass"] = "isReponse";
                                    // line 43
                                    echo "\t\t\t\t\t";
                                    $context["style"] = "stalled";
                                    // line 44
                                    echo "\t\t\t\t";
                                }
                                // line 45
                                echo "\t\t\t\t";
                                $context["auteur"] = $this->getAttribute($this->getContext($context, "c"), "filAuteur");
                                // line 46
                                echo "\t\t\t\t";
                                if ((!(null === $this->getContext($context, "auteur")))) {
                                    // line 47
                                    echo "\t\t\t\t\t";
                                    $context["alias"] = ("de " . $this->getAttribute($this->getContext($context, "auteur"), "username"));
                                    // line 48
                                    echo "\t\t\t\t";
                                } else {
                                    // line 49
                                    echo "\t\t\t\t\t";
                                    $context["alias"] = "anonyme";
                                    // line 50
                                    echo "\t\t\t\t";
                                }
                                // line 51
                                echo "
\t\t\t\t<!-- Bloc du commentaire -->
\t\t\t\t<div class=\"commentaire-wrapper ";
                                // line 53
                                echo twig_escape_filter($this->env, $this->getContext($context, "style"), "html", null, true);
                                echo " ";
                                echo twig_escape_filter($this->env, $this->getContext($context, "commentClass"), "html", null, true);
                                echo "\">
\t\t\t\t\t<figure class=\"avatar\">
\t\t\t\t\t\t";
                                // line 55
                                if ((!(null === $this->getContext($context, "auteur")))) {
                                    echo "<a href=\"/profil/";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "auteur"), "idNana"), "html", null, true);
                                    echo "\">";
                                }
                                // line 56
                                echo "\t\t\t\t\t\t<img src=\"";
                                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "auteur"), "sqr_"), "html", null, true);
                                echo "\" class=\"avatar-image\" alt=\"Avatar ";
                                echo twig_escape_filter($this->env, $this->getContext($context, "alias"), "html", null, true);
                                echo "\" title=\"";
                                echo twig_escape_filter($this->env, $this->getContext($context, "alias"), "html", null, true);
                                echo "\" />
\t\t\t\t\t\t";
                                // line 57
                                if ((!(null === $this->getContext($context, "auteur")))) {
                                    echo "</a>";
                                }
                                // line 58
                                echo "\t\t\t\t\t</figure>
\t\t\t\t\t<div class=\"commentaire\">
\t\t\t\t\t\t<p class=\"metadata\">
\t\t\t\t\t\t\t<span class=\"auteur\">
\t\t\t\t\t\t\t\t";
                                // line 62
                                if ((!(null === $this->getContext($context, "auteur")))) {
                                    // line 63
                                    echo "\t\t\t\t\t\t\t\t<a href=\"/profil/";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "auteur"), "idNana"), "html", null, true);
                                    echo "\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "auteur"), "username"), "html", null, true);
                                    echo "</a>
\t\t\t\t\t\t\t\t";
                                } else {
                                    // line 65
                                    echo "\t\t\t\t\t\t\t\tAnonyme
\t\t\t\t\t\t\t\t";
                                }
                                // line 67
                                echo "\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t";
                                // line 68
                                if ((!(null === $this->getContext($context, "auteur")))) {
                                    // line 69
                                    echo "\t\t\t\t\t\t\t<span class=\"statut-tdn\">
\t\t\t\t\t\t\t\t";
                                    // line 70
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "auteur"), "roles"), 0, array(), "array"), "name"), "html", null, true);
                                    echo "
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t";
                                }
                                // line 73
                                echo "\t\t\t\t\t\t\t<span class=\"date-publication\">
\t\t\t\t\t\t\t\t";
                                // line 74
                                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "c"), "datePublication"), "d/m/Y"), "html", null, true);
                                echo "
\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t</p>
\t\t\t\t\t\t<p class=\"texte\">
\t\t\t\t\t\t\t";
                                // line 78
                                echo $this->getAttribute($this->getContext($context, "c"), "texteCommentaire");
                                echo "
\t\t\t\t\t\t</p>
\t\t\t\t\t\t<p class=\"actions-commentaires\">
\t\t\t\t\t        <a href=\"";
                                // line 81
                                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("commentaireBundle_voteFor", array("id" => $this->getAttribute($this->getContext($context, "c"), "idCommentaire"))), "html", null, true);
                                echo "\" class=\"bottomTextLink\">J'aime
\t\t\t\t\t\t\t<span style=\"color:#159993\">
\t\t\t\t\t\t\t";
                                // line 83
                                if (($this->getAttribute($this->getContext($context, "c"), "like") > 0)) {
                                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "c"), "like"), "html", null, true);
                                    echo " ";
                                    if (($this->getAttribute($this->getContext($context, "c"), "like") > 1)) {
                                    }
                                }
                                // line 84
                                echo "\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t<img src=\"";
                                // line 85
                                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/commentaire/jaime.png"), "html", null, true);
                                echo "\" align=\"absmiddle\" title=\"J’aime\"/>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t";
                                // line 87
                                if (($this->getContext($context, "commentClass") == "isMain")) {
                                    // line 88
                                    echo "\t\t\t\t\t\t\t<a href=\"#\" id=\"responseCommentaire\" class=\"bottomTextLink boutonReponse\"> Répondre à ce commentaire </a>
\t\t\t\t\t\t\t";
                                    // line 89
                                    if ((twig_length_filter($this->env, $this->getContext($context, "thread")) > 1)) {
                                        // line 90
                                        echo "\t\t\t\t\t\t\t\t";
                                        if ((twig_length_filter($this->env, $this->getContext($context, "thread")) == 2)) {
                                            // line 91
                                            echo "\t\t\t\t\t\t\t\t";
                                            $context["labelReponses"] = "la réponse";
                                            // line 92
                                            echo "\t\t\t\t\t\t\t\t";
                                        } else {
                                            // line 93
                                            echo "\t\t\t\t\t\t\t\t";
                                            $context["labelReponses"] = (("les " . (twig_length_filter($this->env, $this->getContext($context, "thread")) - 1)) . " réponses");
                                            // line 94
                                            echo "\t\t\t\t\t\t\t\t";
                                        }
                                        // line 95
                                        echo "\t\t\t\t\t\t\t\t<a class=\"switchReponses unstall\">Afficher ";
                                        echo twig_escape_filter($this->env, $this->getContext($context, "labelReponses"), "html", null, true);
                                        echo " à ce commentaire</a>
\t\t\t\t\t\t\t\t<a class=\"switchReponses stalled\">Masquer ";
                                        // line 96
                                        echo twig_escape_filter($this->env, $this->getContext($context, "labelReponses"), "html", null, true);
                                        echo "</a>
\t\t\t\t\t\t\t";
                                    }
                                    // line 98
                                    echo "\t\t\t\t\t\t\t";
                                }
                                // line 99
                                echo "\t\t\t\t\t\t</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<!-- Fin du bloc commentaire -->
\t\t\t\t";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
                            $context = array_merge($_parent, array_intersect_key($context, $_parent));
                            // line 104
                            echo "\t\t\t\t";
                        }
                        // line 105
                        echo "\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parts'], $context['_parent'], $context['loop']);
                    $context = array_merge($_parent, array_intersect_key($context, $_parent));
                    // line 106
                    echo "\t\t\t</div>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['thread'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 108
                echo "\t";
            } else {
                // line 109
                echo "\t\t<p>Aucun commentaire pour ce contenu</p>
\t";
            }
            // line 111
            echo "</div>

<script type=\"text/javascript\">
\t\$(document).ready(function () {
\t\t\$('.switchReponses').on('click', function () {
\t\t\t\$(this).parents('.commentaire-reponses').find('.switchReponses').toggleClass('stalled unstall');
\t\t\t\$(this).parents('.commentaire-reponses').find('.isReponse').toggleClass('stalled unstall');
\t\t\t//\$(this).toggleClass('unstall restall');
\t\t});
\t\t\$(\".boutonReponse\").click(function (e) {
\t\t\te.preventDefault();
\t\t\tvar target = \$(this).parents(\".commentaire-reponses\");
\t\t\tvar thread= \$(target).data(\"thread\");
\t\t\ttop = \$(target).scrollTop();
\t\t\tconsole.log(top);
\t\t\t\$(\"#avis\").appendTo(target);
\t\t\tvar formReponse = \$(target).children(\"#avis\");
\t\t\tvar inviteAvis = \$(formReponse).find(\".invite-avis\");
\t\t\t\$(inviteAvis).html('Ecris ta réponse');
\t\t\tvar threadInput =\$(formReponse).find('input#tdn3_commentaire_simple_idThread');
\t\t\t\$(threadInput).val(thread);
\t\t\tvar texte = \$(formReponse);
\t\t\t\$(texte).focus();
\t\t\treturn false;
\t\t});
\t});\t\t
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "CommentaireBundle:Flux:flux.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  317 => 108,  301 => 104,  291 => 99,  283 => 96,  263 => 90,  261 => 89,  251 => 85,  230 => 78,  214 => 70,  211 => 69,  206 => 67,  194 => 63,  186 => 58,  173 => 56,  167 => 55,  160 => 53,  150 => 49,  147 => 48,  138 => 45,  135 => 44,  132 => 43,  120 => 39,  117 => 38,  112 => 37,  100 => 34,  95 => 33,  83 => 30,  65 => 16,  59 => 13,  54 => 11,  46 => 9,  23 => 3,  28 => 5,  1176 => 331,  1170 => 330,  1164 => 329,  1158 => 328,  1152 => 327,  1146 => 326,  1140 => 325,  1134 => 324,  1128 => 323,  1112 => 317,  1105 => 316,  1103 => 315,  1100 => 314,  1077 => 310,  1052 => 309,  1050 => 308,  1047 => 307,  1035 => 302,  1030 => 301,  1028 => 300,  1025 => 299,  1016 => 293,  1010 => 291,  1007 => 290,  1002 => 289,  1000 => 288,  997 => 287,  990 => 282,  983 => 280,  980 => 276,  976 => 275,  973 => 274,  970 => 273,  968 => 272,  965 => 271,  957 => 267,  955 => 266,  952 => 265,  945 => 260,  942 => 259,  934 => 254,  930 => 253,  926 => 252,  923 => 251,  921 => 250,  918 => 249,  910 => 245,  908 => 241,  906 => 240,  903 => 239,  882 => 233,  879 => 232,  876 => 231,  873 => 230,  870 => 229,  867 => 228,  864 => 227,  861 => 226,  858 => 225,  855 => 224,  853 => 223,  850 => 222,  842 => 216,  839 => 215,  837 => 214,  834 => 213,  826 => 209,  823 => 208,  821 => 207,  818 => 206,  810 => 202,  807 => 201,  805 => 200,  802 => 199,  794 => 195,  791 => 194,  789 => 193,  786 => 192,  778 => 188,  775 => 187,  773 => 186,  770 => 185,  762 => 181,  759 => 180,  757 => 179,  754 => 178,  746 => 174,  744 => 173,  741 => 172,  733 => 168,  730 => 167,  728 => 166,  725 => 165,  717 => 161,  714 => 160,  712 => 159,  710 => 158,  707 => 157,  700 => 152,  692 => 151,  687 => 150,  681 => 148,  678 => 147,  676 => 146,  673 => 145,  665 => 139,  663 => 138,  662 => 137,  661 => 136,  660 => 135,  655 => 134,  649 => 132,  646 => 131,  644 => 130,  641 => 129,  632 => 123,  628 => 122,  624 => 121,  620 => 120,  615 => 119,  609 => 117,  606 => 116,  585 => 110,  583 => 109,  580 => 108,  564 => 104,  562 => 103,  559 => 102,  542 => 98,  530 => 96,  523 => 93,  521 => 92,  516 => 91,  495 => 89,  493 => 88,  490 => 87,  481 => 82,  478 => 81,  475 => 80,  469 => 78,  467 => 77,  462 => 76,  459 => 75,  456 => 74,  450 => 72,  448 => 71,  440 => 70,  438 => 69,  435 => 68,  429 => 64,  421 => 62,  416 => 61,  412 => 60,  407 => 59,  405 => 58,  402 => 57,  393 => 52,  387 => 50,  384 => 49,  379 => 47,  369 => 43,  367 => 42,  364 => 41,  356 => 37,  353 => 36,  350 => 35,  347 => 34,  345 => 33,  334 => 27,  323 => 24,  321 => 23,  316 => 22,  314 => 21,  311 => 20,  295 => 16,  292 => 15,  290 => 14,  287 => 13,  278 => 95,  272 => 93,  267 => 4,  264 => 3,  258 => 88,  256 => 87,  248 => 84,  241 => 83,  238 => 320,  236 => 81,  233 => 313,  223 => 74,  220 => 73,  218 => 287,  215 => 286,  210 => 270,  200 => 259,  197 => 258,  195 => 249,  187 => 238,  182 => 57,  176 => 219,  174 => 213,  171 => 212,  164 => 199,  159 => 192,  156 => 51,  154 => 185,  149 => 178,  144 => 47,  141 => 46,  131 => 156,  129 => 42,  126 => 41,  124 => 129,  119 => 114,  116 => 113,  114 => 108,  111 => 107,  106 => 101,  104 => 87,  99 => 68,  96 => 67,  94 => 57,  91 => 56,  86 => 46,  74 => 20,  71 => 19,  69 => 13,  66 => 12,  76 => 31,  61 => 2,  58 => 25,  37 => 9,  22 => 3,  19 => 1,  608 => 144,  604 => 115,  601 => 114,  591 => 38,  588 => 37,  584 => 33,  581 => 32,  576 => 4,  526 => 302,  519 => 297,  513 => 90,  507 => 293,  505 => 292,  501 => 290,  498 => 289,  496 => 288,  436 => 231,  432 => 230,  428 => 229,  382 => 48,  377 => 184,  373 => 183,  351 => 164,  343 => 158,  340 => 157,  335 => 155,  326 => 148,  324 => 111,  320 => 109,  318 => 144,  309 => 142,  299 => 135,  296 => 134,  294 => 133,  288 => 98,  276 => 124,  270 => 121,  262 => 115,  260 => 331,  254 => 328,  246 => 324,  232 => 98,  225 => 95,  216 => 92,  208 => 265,  205 => 264,  202 => 65,  193 => 85,  190 => 239,  185 => 83,  183 => 82,  180 => 81,  169 => 206,  153 => 50,  151 => 184,  148 => 66,  146 => 177,  125 => 45,  123 => 40,  118 => 35,  115 => 34,  109 => 36,  105 => 35,  101 => 86,  93 => 32,  89 => 47,  85 => 25,  81 => 29,  73 => 22,  68 => 21,  64 => 3,  62 => 14,  55 => 13,  49 => 12,  41 => 8,  35 => 6,  33 => 7,  29 => 6,  24 => 4,  348 => 143,  344 => 141,  342 => 32,  339 => 139,  337 => 156,  331 => 134,  329 => 26,  312 => 118,  310 => 106,  304 => 105,  298 => 111,  293 => 108,  282 => 127,  279 => 104,  275 => 94,  271 => 101,  269 => 92,  266 => 91,  259 => 95,  255 => 94,  252 => 327,  250 => 326,  244 => 323,  235 => 86,  231 => 307,  228 => 306,  226 => 299,  222 => 81,  213 => 271,  209 => 68,  203 => 77,  196 => 73,  192 => 62,  184 => 236,  179 => 221,  170 => 62,  166 => 205,  163 => 60,  161 => 198,  152 => 57,  143 => 51,  139 => 165,  136 => 164,  134 => 157,  128 => 45,  121 => 128,  113 => 32,  102 => 34,  97 => 28,  92 => 32,  84 => 41,  79 => 32,  77 => 23,  70 => 29,  56 => 12,  53 => 22,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 6,);
    }
}
