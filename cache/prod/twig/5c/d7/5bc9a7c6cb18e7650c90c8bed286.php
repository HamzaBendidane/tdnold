<?php

/* CoreBundle:Admin:dashboard.html.twig */
class __TwigTemplate_5cd75bc9a7c6cb18e7650c90c8bed286 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Default:TDNAdmin.html.twig");

        $this->blocks = array(
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'local_header_scripts' => array($this, 'block_local_header_scripts'),
            'title' => array($this, 'block_title'),
            'contenu_principal' => array($this, 'block_contenu_principal'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DocumentBundle:Default:TDNAdmin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/admin.css"), "html", null, true);
        echo "\" type=\"text/css\">
";
    }

    // line 7
    public function block_local_header_scripts($context, array $blocks = array())
    {
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        echo "Tableau de bord";
    }

    // line 12
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 13
        echo "<div class=\"postit-contenu\">
   <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/administration_titre.png"), "html", null, true);
        echo "\" />
</div>

<h1 class=\"titrePage\">Tableau de bord</h1>

<!-- Brouillons d’articles -->
";
        // line 20
        if (array_key_exists("articlesBrouillons", $context)) {
            // line 21
            echo "\t<h2>Articles à l'état de brouillons</h2>
\t";
            // line 22
            if (twig_test_empty($this->getContext($context, "articlesBrouillons"))) {
                // line 23
                echo "\t<p>Aucun</p>
\t";
            } else {
                // line 25
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 26
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "articlesBrouillons")), "html", null, true);
                echo " en attente d'être publiés</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre de l'article</th>
\t\t\t\t<th>Auteur</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 34
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articlesBrouillons"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 35
                    echo "\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<a href=\"";
                    // line 37
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("RedactionBundle_articleModifier", array("id" => $this->getAttribute($this->getContext($context, "a"), "idDocument"))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    echo "</a>
\t\t\t\t</td>
\t\t\t\t<td>";
                    // line 39
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "prenom") . " ") . $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "nom")), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 42
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 46
        echo "
<!-- Conseils à répartir -->
";
        // line 48
        if (array_key_exists("conseilsDispatch", $context)) {
            // line 49
            echo "\t<h2>Conseils à répartir</h2>
\t";
            // line 50
            if (twig_test_empty($this->getContext($context, "conseilsDispatch"))) {
                // line 51
                echo "\t<p>Aucun</p>
\t";
            } else {
                // line 53
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 54
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "conseilsDispatch")), "html", null, true);
                echo " demandes de conseil en attente</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Auteur</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 63
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "conseilsDispatch"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 64
                    echo "\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<a href='";
                    // line 66
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpertBundle_deleguer", array("id" => $this->getAttribute($this->getContext($context, "a"), "idDocument"))), "html", null, true);
                    echo "'>
\t\t      \t\t\t";
                    // line 67
                    if ((!twig_test_empty($this->getAttribute($this->getContext($context, "a"), "titre")))) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    } else {
                        echo twig_slice($this->env, $this->getAttribute($this->getContext($context, "a"), "question"), 0, 100);
                    }
                    // line 68
                    echo "\t\t      \t\t</a>
\t\t\t\t</td>
\t\t\t\t<td>";
                    // line 70
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "username"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 71
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "dateSoumission"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 74
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 78
        echo "
<!-- Conseils en attente de réponse -->
";
        // line 80
        if ((!twig_test_empty($this->getContext($context, "conseilsRepondre")))) {
            // line 81
            echo "\t<h2>Conseils en attente de réponse</h2>
\t";
            // line 82
            if (twig_test_empty($this->getContext($context, "conseilsRepondre"))) {
                // line 83
                echo "\t<p>Aucun</p>
\t";
            } else {
                // line 85
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 86
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "conseilsRepondre")), "html", null, true);
                echo " en attente</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Expert</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 95
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "conseilsRepondre"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 96
                    echo "\t\t\t<tr>
\t\t\t\t<td>
\t\t      \t\t<a href='";
                    // line 98
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpertBundle_repondre", array("id" => $this->getAttribute($this->getContext($context, "a"), "idDocument"))), "html", null, true);
                    echo "'>
\t\t      \t\t\t";
                    // line 99
                    if ((!twig_test_empty($this->getAttribute($this->getContext($context, "a"), "titre")))) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    } else {
                        echo twig_slice($this->env, $this->getAttribute($this->getContext($context, "a"), "question"), 0, 100);
                    }
                    // line 100
                    echo "\t\t      \t\t</a>
\t\t\t\t</td>
\t\t\t\t";
                    // line 102
                    if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
                        // line 103
                        echo "\t\t\t\t<td>";
                        if ((!(null === $this->getAttribute($this->getContext($context, "a"), "lnExpert")))) {
                            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnExpert"), "prenom") . " ") . $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnExpert"), "nom")), "html", null, true);
                        }
                        echo "</td>
\t\t\t\t";
                    }
                    // line 105
                    echo "\t\t\t\t<td>";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "dateSoumission"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 108
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 112
        echo "
<!-- Conseils en attente de publication -->
";
        // line 114
        if (array_key_exists("conseilsPublier", $context)) {
            // line 115
            echo "\t<h2>Conseils en attente de publication</h2>
\t";
            // line 116
            if (twig_test_empty($this->getContext($context, "conseilsPublier"))) {
                // line 117
                echo "\t<p>Aucun</p>
\t";
            } else {
                // line 119
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 120
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "conseilsPublier")), "html", null, true);
                echo " en attente</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Auteur</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 129
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "conseilsPublier"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 130
                    echo "\t\t\t<tr>
\t\t\t\t<td>
\t\t\t\t\t<a href='";
                    // line 132
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpertBundle_relire", array("id" => $this->getAttribute($this->getContext($context, "a"), "idDocument"))), "html", null, true);
                    echo "'>
\t\t      \t\t\t";
                    // line 133
                    if ((!twig_test_empty($this->getAttribute($this->getContext($context, "a"), "titre")))) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    } else {
                        echo twig_slice($this->env, $this->getAttribute($this->getContext($context, "a"), "question"), 0, 100);
                    }
                    // line 134
                    echo "\t\t      \t\t</a>
\t\t\t\t</td>
\t\t\t\t<td>";
                    // line 136
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "username"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 137
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "dateSoumission"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 140
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 144
        echo "
<!-- Vidéos en attente de publication -->
";
        // line 146
        if (array_key_exists("videosPublier", $context)) {
            // line 147
            echo "\t<h2>Vidéos en attente de validation</h2>
\t";
            // line 148
            if (twig_test_empty($this->getContext($context, "videosPublier"))) {
                // line 149
                echo "\t<p>Aucune</p>
\t";
            } else {
                // line 151
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 152
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "videosPublier")), "html", null, true);
                echo " vidéos en attente de validation</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Proposition</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 161
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "videosPublier"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 162
                    echo "\t\t\t<tr>
\t\t\t\t<td>";
                    // line 163
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 164
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "username"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 165
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "datePublication"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 168
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 172
        echo "
<!-- Questions de nanas à valider -->
";
        // line 174
        if (array_key_exists("questionsValider", $context)) {
            // line 175
            echo "\t<h2>Conseils en attente de réponse</h2>
\t";
            // line 176
            if (twig_test_empty($this->getContext($context, "questionsValider"))) {
                // line 177
                echo "\t<p>Aucune</p>
\t";
            } else {
                // line 179
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 180
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "questionsValider")), "html", null, true);
                echo " en attente</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Auteur</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 189
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articlesBrouillons"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 190
                    echo "\t\t\t<tr>
\t\t\t\t<td>";
                    // line 191
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 192
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "lnAuteur"), "username"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 193
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "datePublication"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 196
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 200
        echo "
<!-- Commentaires à modérer -->
";
        // line 202
        if (array_key_exists("commentairesModerer", $context)) {
            // line 203
            echo "\t<h2>Conseils en attente de réponse</h2>
\t";
            // line 204
            if (twig_test_empty($this->getContext($context, "commentairesModerer"))) {
                // line 205
                echo "\t<p>Aucun</p>
\t";
            } else {
                // line 207
                echo "\t<table class=\"adminLog\">
\t\t<caption>";
                // line 208
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "commentairesModerer")), "html", null, true);
                echo " en attente</caption>
\t\t<thead>
\t\t\t<tr>
\t\t\t\t<th>Titre</th>
\t\t\t\t<th>Commentateur</th>
\t\t\t\t<th>Date de soumission</th>
\t\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t\t";
                // line 217
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "articlesBrouillons"));
                foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
                    // line 218
                    echo "\t\t\t<tr>
\t\t\t\t<td>";
                    // line 219
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "titre"), "html", null, true);
                    echo "</td>
\t\t\t\t<td>";
                    // line 220
                    if ((!twig_test_empty($this->getContext($context, "filAuteur")))) {
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "a"), "filAuteur"), "username"), "html", null, true);
                    } else {
                        echo "Anonyme";
                    }
                    echo "</td>
\t\t\t\t<td>";
                    // line 221
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "a"), "datePublication"), "d/m/y"), "html", null, true);
                    echo "</td>
\t\t\t</tr>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 224
                echo "\t\t</tbody>
\t</table>
\t";
            }
        }
        // line 228
        echo "
";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Admin:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  526 => 228,  520 => 224,  511 => 221,  503 => 220,  499 => 219,  496 => 218,  492 => 217,  480 => 208,  477 => 207,  473 => 205,  471 => 204,  468 => 203,  466 => 202,  462 => 200,  456 => 196,  447 => 193,  443 => 192,  439 => 191,  436 => 190,  432 => 189,  420 => 180,  417 => 179,  413 => 177,  411 => 176,  408 => 175,  406 => 174,  402 => 172,  396 => 168,  387 => 165,  383 => 164,  379 => 163,  376 => 162,  372 => 161,  360 => 152,  357 => 151,  353 => 149,  351 => 148,  348 => 147,  346 => 146,  342 => 144,  336 => 140,  327 => 137,  323 => 136,  319 => 134,  313 => 133,  309 => 132,  305 => 130,  301 => 129,  289 => 120,  286 => 119,  282 => 117,  280 => 116,  277 => 115,  275 => 114,  271 => 112,  265 => 108,  255 => 105,  247 => 103,  245 => 102,  241 => 100,  235 => 99,  231 => 98,  227 => 96,  223 => 95,  211 => 86,  208 => 85,  204 => 83,  202 => 82,  199 => 81,  197 => 80,  193 => 78,  187 => 74,  178 => 71,  174 => 70,  170 => 68,  164 => 67,  160 => 66,  156 => 64,  152 => 63,  140 => 54,  137 => 53,  133 => 51,  131 => 50,  128 => 49,  126 => 48,  122 => 46,  116 => 42,  107 => 39,  100 => 37,  96 => 35,  92 => 34,  81 => 26,  78 => 25,  74 => 23,  72 => 22,  69 => 21,  67 => 20,  58 => 14,  55 => 13,  52 => 12,  46 => 10,  41 => 7,  34 => 4,  31 => 3,);
    }
}
