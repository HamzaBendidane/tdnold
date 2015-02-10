<?php

/* CoreBundle:Bloc:header.html.twig */
class __TwigTemplate_73cb75bb7f707d7402027ccc019c8efd extends Twig_Template
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
        echo "<div id=\"mytdn\" class=\"mytdn-closed\">
\t<div id=\"mytdn-dashboard\">
\t\t<div id=\"my-identite\">
\t\t\t<div id=\"avatar\">
\t\t\t ";
        // line 5
        if ((array_key_exists("me", $context) && (!(null === $this->getAttribute($this->getContext($context, "me"), "lnAvatar"))))) {
            // line 6
            echo "\t\t     ";
            $context["sourceAvatar"] = ((("/uploads/documents/profils/" . $this->getAttribute($this->getContext($context, "me"), "idNana")) . "/") . $this->getAttribute($this->getAttribute($this->getContext($context, "me"), "lnAvatar"), "fichier"));
            // line 7
            echo "\t\t     ";
        } else {
            // line 8
            echo "\t\t     ";
            $context["sourceAvatar"] = "assets/images/theme/centre/avatar_profil/avatar5%2080x95.png";
            // line 9
            echo "\t\t     ";
        }
        // line 10
        echo "\t\t\t\t<img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceAvatar")), "html", null, true);
        echo "\" />
\t\t\t</div>
\t\t\t<div id=\"whoami\">
\t\t\t\t";
        // line 13
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 14
            echo "\t\t\t\t<a class='headerLink' href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_myProfil"), "html", null, true);
            echo "\">
\t\t\t\t";
        }
        // line 16
        echo "\t\t\t\t<img class=\"bloc\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/mytdn/myProfil.png"), "html", null, true);
        echo "\" />
\t\t\t\t";
        // line 17
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 18
            echo "\t\t\t\t</a>
\t\t\t\t";
        }
        // line 20
        echo "\t\t\t\t";
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 21
            echo "\t\t\t\t<p id=\"username\" class=\"name\">
\t\t\t\t\t<a class='headerLink' href=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_myProfil"), "html", null, true);
            echo "\">
\t\t\t\t\t\t";
            // line 23
            echo twig_escape_filter($this->env, $this->getContext($context, "username"), "html", null, true);
            echo "
\t\t\t\t\t</a>
\t\t\t\t</p>
\t\t\t\t<p id=\"role\" class=\"role\">";
            // line 26
            echo twig_escape_filter($this->env, $this->getContext($context, "statut"), "html", null, true);
            echo "</p>
\t\t\t\t<p><a class='deconnexion' href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_logout"), "html", null, true);
            echo "\">Me déconnecter</a></p>
\t\t\t\t";
        }
        // line 29
        echo "\t\t\t</div>
\t\t</div>
\t\t<div id=\"my-options\">
\t\t
\t\t";
        // line 33
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 34
            echo "\t\t<h3> Communauté </h3>
\t\t\t<ul class=\"groupe-options\">
\t\t\t\t";
            // line 36
            if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
                // line 37
                echo "\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 38
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_creer"), "html", null, true);
                echo "\">Poser une question à un expert</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 41
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_creer"), "html", null, true);
                echo "\">Poser une question aux nanas</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 44
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Video_proposer"), "html", null, true);
                echo "\">Proposer une vidéo</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_myProfil"), "html", null, true);
                echo "\">Accéder à mon profil</a>
\t\t\t\t</li>
\t\t\t\t";
            }
            // line 50
            echo "\t\t\t</ul>
\t\t\t<ul class=\"groupe-options\">
\t\t\t\t";
            // line 52
            if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
                // line 53
                echo "\t\t\t\t<!--li class=\"granted-options\">Jouer à un quiz</li-->
\t\t\t\t";
            }
            // line 55
            echo "\t\t\t\t";
            if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
                // line 56
                echo "\t\t\t\t<li class=\"granted-options\"><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Concours_sommaire"), "html", null, true);
                echo "\">Voir les jeux-concours</a></li>
\t\t\t\t";
            }
            // line 58
            echo "\t\t\t</ul>
\t\t\t<ul class=\"groupe-options\">
\t\t\t\t";
            // line 60
            if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
                // line 61
                echo "\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 62
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("RedactionBundle_articleAdd"), "html", null, true);
                echo "\">Ecrire un article</a>
\t\t\t\t</li>
\t\t\t\t";
            }
            // line 65
            echo "\t\t\t\t";
            if ($this->env->getExtension('security')->isGranted("ROLE_EXPERT")) {
                // line 66
                echo "\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 67
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_logStatut", array("statut" => "2")), "html", null, true);
                echo "\">Mes questions en attente</a>
\t\t\t\t</li>
\t\t\t\t";
            }
            // line 70
            echo "\t\t\t\t";
            if ($this->env->getExtension('security')->isGranted("ROLE_EXPERT")) {
                // line 71
                echo "\t\t\t\t<li class=\"granted-options\">
\t\t\t\t\t<a class='headerLink' href=\"";
                // line 72
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_adminDashboard"), "html", null, true);
                echo "\">Administration</a>
\t\t\t\t</li>
\t\t\t\t";
            }
            // line 75
            echo "\t\t\t</ul>
\t\t";
        } else {
            // line 77
            echo "\t\t\t<h3>Connecte-toi sur TDN</h3>
\t\t\t";
            // line 78
            echo $this->env->getExtension('actions')->renderAction("NanaBundle:Security:blockLogin", array("redirect_url" => $this->env->getExtension('routing')->getPath("NanaBundle_myProfil")), array());
            // line 79
            echo "\t\t\t<p class=\"inviteInscription\">
\t\t\t\t<a href=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Nana_passwordResetS1"), "html", null, true);
            echo "\" class=\"lienFleche\">J'ai perdu mes identifiants ? 
\t\t\t\t\t<img  src=\"";
            // line 81
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/mytdn/bt_fleche droite.png"), "html", null, true);
            echo "\" align=\"absmiddle\"style=\"margin-right:10px\"/>
\t\t\t\t</a> 
\t\t\t\t<a href=\"";
            // line 83
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_registerForm"), "html", null, true);
            echo "\" class=\"lienFleche popin\">Inscris-toi sur Trucdenana.com <img  src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/mytdn/bt_fleche droite.png"), "html", null, true);
            echo "\" align=\"absmiddle\"/></a>
\t\t\t</p>\t\t\t\t
\t\t";
        }
        // line 86
        echo "\t\t</div>
\t</div>
\t<div id=\"mytdn-grip\">
\t\t<div id=\"bienvenue\" class=\"bienvenue\">
\t\t";
        // line 90
        if (array_key_exists("username", $context)) {
            // line 91
            echo "\t\t    Bienvenue ";
            echo twig_escape_filter($this->env, $this->getContext($context, "username"), "html", null, true);
            echo "
\t\t    <img class=\"avatar-minuscule\" src=\"";
            // line 92
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceAvatar")), "html", null, true);
            echo "\" />
\t\t";
        } else {
            // line 94
            echo "\t\t\tClique sur MyTDN pour ouvrir le tiroir
\t\t";
        }
        // line 96
        echo "\t\t</div>
\t\t<div id=\"dashboard\" class=\"dashboard\">
\t\t\t<div id=\"digest\">
\t\t\t\t";
        // line 99
        if ((array_key_exists("gain", $context) && ($this->getContext($context, "gain") > 0))) {
            // line 100
            echo "\t\t    \t<div class=\"upgradeEscarpin digest-off\">
\t\t    \t\t<p class=\"contenu annotation\">
\t\t    \t\t\t<a class=\"notifCallback\" href=\"";
            // line 102
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_myProfil"), "html", null, true);
            echo "?msg=upesc\">Bravo ! Tu as gagné un nouvel escarpin</a>
\t\t    \t\t</p>
\t\t    \t</div>
\t\t\t\t";
        }
        // line 106
        echo "\t\t\t\t";
        if ((array_key_exists("messages", $context) && (!twig_test_empty($this->getContext($context, "messages"))))) {
            // line 107
            echo "\t\t    \t<div class=\"messagesFeed digest-off\">
\t\t\t\t\t";
            // line 108
            $this->env->loadTemplate("CoreBundle:Bloc:dashboardNotification.html.twig")->display(array_merge($context, array("entrees" => $this->getContext($context, "messages"), "me" => $this->getContext($context, "me"), "actions" => "messages")));
            // line 109
            echo "\t\t    \t</div>
\t\t\t\t";
        }
        // line 111
        echo "\t\t\t\t";
        if ((array_key_exists("likes", $context) && (!twig_test_empty($this->getContext($context, "likes"))))) {
            // line 112
            echo "\t\t    \t<div class=\"likesFeed digest-off\">
\t\t\t\t\t";
            // line 113
            $this->env->loadTemplate("CoreBundle:Bloc:dashboardNotification.html.twig")->display(array_merge($context, array("entrees" => $this->getContext($context, "likes"), "me" => $this->getContext($context, "me"), "actions" => "likes")));
            // line 114
            echo "\t\t    \t</div>
\t\t\t\t";
        }
        // line 116
        echo "\t\t\t\t";
        if ((array_key_exists("follows", $context) && (!twig_test_empty($this->getContext($context, "follows"))))) {
            // line 117
            echo "\t\t    \t<div class=\"likesFeed digest-off\">
\t\t\t\t\t";
            // line 118
            $this->env->loadTemplate("CoreBundle:Bloc:dashboardNotification.html.twig")->display(array_merge($context, array("entrees" => $this->getContext($context, "follows"), "me" => $this->getContext($context, "me"), "actions" => "follows")));
            // line 119
            echo "\t\t    \t</div>
\t\t\t\t";
        }
        // line 121
        echo "\t\t\t</div>
\t\t<!-- En cas de gain de « points » -->
\t\t";
        // line 123
        if ((array_key_exists("gain", $context) && ($this->getContext($context, "gain") > 0))) {
            // line 124
            echo "\t\t    <a href=\"#\" class=\"element-on hasGain-on\">";
            echo twig_escape_filter($this->env, $this->getContext($context, "gain"), "html", null, true);
            echo "</a>
\t\t";
        } else {
            // line 126
            echo "\t\t\t<span class=\"element-on hasGain-off\"></span>
\t\t";
        }
        // line 128
        echo "\t\t<!-- En cas de nouvelles relations -->
\t\t";
        // line 129
        if ((array_key_exists("likes", $context) && (!twig_test_empty($this->getContext($context, "likes"))))) {
            // line 130
            echo "\t\t    <span class=\"element-on hasLikes-on\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "likes")), "html", null, true);
            echo "</span>
\t\t";
        } else {
            // line 132
            echo "\t\t\t<span class=\"element-on hasLikes-off\"></span>
\t\t";
        }
        // line 134
        echo "\t\t<!-- En cas d'activité sur le site -->
\t\t";
        // line 135
        if ((array_key_exists("messages", $context) && (!twig_test_empty($this->getContext($context, "messages"))))) {
            // line 136
            echo "\t\t    <a class=\"element-on hasActivite-on\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "messages")), "html", null, true);
            echo "</a>
\t\t";
        } else {
            // line 138
            echo "\t\t\t<span class=\"element-on hasActivite-off\"></span>
\t\t";
        }
        // line 140
        echo "\t\t<!-- En cas de d'activié personnelle -->
\t\t";
        // line 141
        if ((array_key_exists("follows", $context) && (!twig_test_empty($this->getContext($context, "follows"))))) {
            // line 142
            echo "\t\t    <span class=\"element-on hasFollowers-off\">";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "follows")), "html", null, true);
            echo "</span>
\t\t";
        } else {
            // line 144
            echo "\t\t\t<span class=\"element-on hasFollowers-off\"></span>
\t\t";
        }
        // line 146
        echo "\t\t</div>
\t\t<div id=\"tiroir\" class=\"tiroir\">
\t\t\t<img src=\"";
        // line 148
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/mytdn/logo_MyTDN.png"), "html", null, true);
        echo "\" />
\t\t</div>
\t</div>
</div>
<script type=\"text/javascript\">
\t\$(document).ready(function () {
\t\t\$('.hasGain-on').click(function (event) {
\t\t\tevent.preventDefault();
\t\t\t\$(\"#digest .upgradeEscarpin\").toggleClass('digest-on digest-off');
\t\t\tevent.stopPropagation();
\t\t});
\t\t\$('.hasActivite-on').click(function (event) {
\t\t\tevent.preventDefault();
\t\t\t\$(\"#digest .messagesFeed\").toggleClass('digest-on digest-off');
\t\t\tevent.stopPropagation();
\t\t});
\t\t\$('.hasLikes-on').click(function (event) {
\t\t\tevent.preventDefault();
\t\t\t\$(\"#digest .likesFeed\").toggleClass('digest-on digest-off');
\t\t\tevent.stopPropagation();
\t\t});
\t\t\$('.hasFollowers-on').click(function (event) {
\t\t\tevent.preventDefault();
\t\t\t\$(\"#digest .followersFeed\").toggleClass('digest-on digest-off');
\t\t\tevent.stopPropagation();
\t\t});
\t\t\$('.notifCallback').click(function (event) {
\t\t\tevent.stopPropagation();
\t\t})
\t\t\$('#digest').click(function (event) {
\t\t\tevent.stopPropagation();
\t\t})
\t})
</script>
";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Bloc:header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  355 => 146,  351 => 144,  343 => 141,  336 => 138,  330 => 136,  328 => 135,  325 => 134,  321 => 132,  315 => 130,  313 => 129,  310 => 128,  300 => 124,  290 => 119,  278 => 114,  266 => 109,  258 => 106,  247 => 100,  245 => 99,  236 => 94,  231 => 92,  226 => 91,  224 => 90,  218 => 86,  210 => 83,  201 => 80,  196 => 78,  193 => 77,  189 => 75,  183 => 72,  177 => 70,  168 => 66,  165 => 65,  159 => 62,  156 => 61,  154 => 60,  150 => 58,  144 => 56,  137 => 53,  135 => 52,  131 => 50,  125 => 47,  119 => 44,  113 => 41,  107 => 38,  104 => 37,  102 => 36,  96 => 33,  85 => 27,  81 => 26,  68 => 21,  59 => 17,  54 => 16,  48 => 14,  46 => 13,  33 => 8,  30 => 7,  27 => 6,  25 => 5,  19 => 1,  855 => 417,  852 => 416,  847 => 116,  842 => 86,  838 => 42,  835 => 41,  828 => 38,  824 => 37,  820 => 36,  816 => 34,  813 => 33,  803 => 25,  800 => 24,  796 => 22,  793 => 21,  787 => 19,  783 => 18,  779 => 17,  775 => 16,  771 => 15,  767 => 14,  763 => 13,  759 => 12,  755 => 11,  750 => 10,  747 => 9,  742 => 7,  736 => 451,  734 => 416,  697 => 382,  693 => 381,  662 => 353,  658 => 352,  640 => 337,  632 => 331,  629 => 330,  626 => 329,  624 => 328,  613 => 319,  607 => 316,  602 => 314,  597 => 311,  595 => 310,  592 => 309,  586 => 306,  581 => 304,  576 => 301,  574 => 300,  570 => 298,  563 => 293,  561 => 292,  558 => 291,  550 => 285,  548 => 284,  544 => 282,  535 => 275,  533 => 274,  530 => 273,  521 => 266,  519 => 265,  516 => 264,  510 => 261,  505 => 259,  500 => 257,  494 => 253,  492 => 252,  489 => 251,  483 => 248,  477 => 244,  475 => 243,  472 => 242,  467 => 239,  463 => 237,  457 => 233,  455 => 232,  449 => 228,  443 => 225,  438 => 223,  432 => 219,  430 => 218,  427 => 217,  421 => 214,  416 => 212,  410 => 208,  408 => 207,  405 => 206,  394 => 198,  389 => 196,  383 => 192,  381 => 191,  378 => 190,  372 => 187,  367 => 185,  361 => 181,  359 => 148,  356 => 179,  350 => 176,  345 => 142,  340 => 140,  334 => 168,  332 => 167,  329 => 166,  323 => 163,  320 => 162,  314 => 160,  312 => 159,  306 => 126,  304 => 154,  298 => 123,  294 => 121,  288 => 118,  285 => 117,  282 => 116,  276 => 113,  273 => 112,  270 => 111,  264 => 108,  261 => 107,  259 => 134,  255 => 132,  249 => 129,  244 => 127,  239 => 125,  234 => 122,  232 => 121,  227 => 119,  223 => 117,  221 => 116,  209 => 107,  206 => 106,  204 => 105,  198 => 79,  192 => 99,  186 => 96,  180 => 71,  172 => 87,  170 => 86,  162 => 81,  158 => 80,  153 => 77,  151 => 76,  141 => 55,  138 => 67,  129 => 64,  126 => 63,  121 => 62,  118 => 61,  115 => 60,  106 => 57,  98 => 34,  92 => 53,  83 => 50,  80 => 49,  75 => 23,  73 => 47,  66 => 42,  63 => 41,  56 => 24,  52 => 22,  49 => 21,  43 => 8,  39 => 10,  35 => 6,  251 => 102,  246 => 75,  240 => 96,  237 => 70,  222 => 68,  216 => 67,  211 => 64,  205 => 81,  199 => 60,  197 => 59,  191 => 58,  188 => 57,  181 => 56,  178 => 55,  173 => 54,  171 => 67,  166 => 52,  148 => 51,  146 => 50,  142 => 48,  133 => 46,  128 => 45,  117 => 42,  114 => 41,  110 => 40,  103 => 56,  95 => 54,  93 => 32,  90 => 29,  82 => 25,  71 => 22,  67 => 22,  60 => 19,  58 => 32,  53 => 16,  47 => 9,  41 => 11,  36 => 9,  69 => 19,  65 => 20,  61 => 18,  55 => 13,  50 => 10,  44 => 12,  40 => 8,  34 => 5,  31 => 3,  28 => 1,);
    }
}
