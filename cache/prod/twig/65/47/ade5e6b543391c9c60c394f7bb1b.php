<?php

/* DocumentBundle:Default:TDNAdmin.html.twig */
class __TwigTemplate_6547ade5e6b543391c9c60c394f7bb1b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'webfonts' => array($this, 'block_webfonts'),
            'header_scripts' => array($this, 'block_header_scripts'),
            'local_header_scripts' => array($this, 'block_local_header_scripts'),
            'header_pub' => array($this, 'block_header_pub'),
            'contenu_principal' => array($this, 'block_contenu_principal'),
            'footer_scripts' => array($this, 'block_footer_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
\t<meta name=\"google-site-verification\" content=\"fq8zrWpv2MoWmc3miAE5MecQa2oy6F9gjj2OFRU0zEk\" />
\t<!-- <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmedemo/css/demo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" /> -->
\t<title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo " | Truc de nana</title>
\t<!-- <link rel=\"shortcut icon\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/favicon.ico"), "html", null, true);
        echo "\" /> -->
\t";
        // line 9
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 21
        echo "\t";
        $this->displayBlock('local_stylesheets', $context, $blocks);
        // line 22
        echo "\t
\t
\t";
        // line 24
        $this->displayBlock('webfonts', $context, $blocks);
        // line 32
        echo "
\t";
        // line 33
        $this->displayBlock('header_scripts', $context, $blocks);
        // line 41
        echo "\t";
        $this->displayBlock('local_header_scripts', $context, $blocks);
        // line 42
        echo "\t

</head>
<body class=\"theme-deco\">
\t<div class=\"messages_systeme latentSystemMessages\">
\t";
        // line 47
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "hasFlash", array(0 => "success"), "method")) {
            // line 48
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "success"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 49
                echo "\t    <div class=\"flash-success\">
\t        ";
                // line 50
                echo $this->getContext($context, "flashMessage");
                echo "
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 53
            echo "\t";
        }
        // line 54
        echo "\t";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "hasFlash", array(0 => "warning"), "method")) {
            // line 55
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "warning"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 56
                echo "\t    <div class=\"flash-warning\">
\t        ";
                // line 57
                echo $this->getContext($context, "flashMessage");
                echo "
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 60
            echo "\t";
        }
        // line 61
        echo "\t";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "hasFlash", array(0 => "fail"), "method")) {
            // line 62
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "fail"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 63
                echo "\t    <div class=\"flash-fail\">
\t        ";
                // line 64
                echo $this->getContext($context, "flashMessage");
                echo "
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 67
            echo "\t";
        }
        // line 68
        echo "\t</div>
\t<div id=\"top-border\"></div>
\t<div id=\"social-clipper\">
\t\t<h2 class=\"vertical\"><span class=\"emeraude\">News</span> <span class=\"rose\">Communauté</span></h2>
\t</div>
\t<div id=\"tdn-wrapper\">
\t\t<div id=\"mytdn-wrapper\">
\t\t\t<div id=\"mytdn\" class=\"mytdn-closed\">
\t\t\t";
        // line 76
        echo $this->env->getExtension('actions')->renderAction("CoreBundle:Header:display", array(), array());
        // line 77
        echo "\t\t\t</div>
\t\t</div>
\t\t<div id=\"logo-wrapper\">
\t\t\t<a href=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_home"), "html", null, true);
        echo "\">
\t\t\t\t<img id=\"logo-wrapper\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/logo_TDN.png"), "html", null, true);
        echo "\" alt=\"Logo - Lien vers la page d'accueil\" />
\t\t\t</a>
\t\t</div>
\t\t<div id=\"tdn-header\">
\t\t\t<div id=\"header-pub\">
\t\t\t\t";
        // line 86
        $this->displayBlock('header_pub', $context, $blocks);
        // line 87
        echo "\t\t\t</div>
\t\t</div>
\t\t
\t\t<div id=\"menu-principal\">
\t\t\t<div id=\"fonctions-sociales\">
\t\t\t\t<a href=\"http://www.facebook.com/trucdenana\">
\t\t\t\t\t<img src=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_facebook.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"https://twitter.com/TrucdeNana\">
\t\t\t\t\t<img src=\"";
        // line 96
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_twitter.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"http://www.hellocoton.fr/mapage/trucdenana\">
\t\t\t\t\t<img src=\"";
        // line 99
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_hellocoton.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"https://itunes.apple.com/fr/app/truc-de-nana/id369735750\">
\t\t\t\t\t<img src=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_app-store.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t</div>
\t\t\t";
        // line 105
        echo $this->env->getExtension('actions')->renderAction("DocumentBundle:Rubrique:mainNavigation", array(), array());
        // line 106
        echo "\t\t\t<div id=\"recherche-rapide\">
\t\t\t\t<form name=\"recherche\" id=\"recherche\" action=\"";
        // line 107
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_rechercheForm"), "html", null, true);
        echo "\" method=\"post\" enctype=\"\">
\t\t\t\t\t<input type=\"text\" size=\"15\" name=\"seed\" />
\t\t\t\t\t<input type=\"submit\" name=\"quicksearch\" class=\"submitter\" value=\">\" />
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>

\t\t<section id=\"contenu-principal\">
\t\t\t<div id=\"contenu\">
\t\t\t\t";
        // line 116
        $this->displayBlock('contenu_principal', $context, $blocks);
        // line 117
        echo "\t\t\t</div>
\t\t\t<div id=\"admin_sidebar\" class=\"adminSidebar\">
\t\t\t\t<h2><a href=\"";
        // line 119
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_adminDashboard"), "html", null, true);
        echo "\">Administration TDN</a></h2>
\t\t\t\t<ul class=\"adminActions\">
\t\t\t\t\t";
        // line 121
        if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
            // line 122
            echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Articles</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 125
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("RedactionBundle_articleAdd"), "html", null, true);
            echo "\">Ecrire</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 127
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("RedactionBundle_articleBrouillons"), "html", null, true);
            echo "\">Mes articles en cours</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 129
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("RedactionBundle_articleIndex"), "html", null, true);
            echo "\">Tous mes articles</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 132
        echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Conseils</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t";
        // line 134
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 135
            echo "\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 136
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_logStatut", array("statut" => "1")), "html", null, true);
            echo "\">En attente de délégation</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 139
        echo "\t\t\t\t\t\t";
        if ($this->env->getExtension('security')->isGranted("ROLE_EXPERT")) {
            // line 140
            echo "\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 141
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_logStatut", array("statut" => "2")), "html", null, true);
            echo "\">En attente de réponse</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 144
        echo "\t\t\t\t\t\t";
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 145
            echo "\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 146
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_logStatut", array("statut" => "3")), "html", null, true);
            echo "\">En attente de validation</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 149
        echo "
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
        // line 151
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpertBundle_index"), "html", null, true);
        echo "\">Mes conseils</a></li>
\t\t\t\t\t</ul>

\t\t\t\t\t";
        // line 154
        if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
            // line 155
            echo "\t\t\t\t\t<!-- Questions de nanas -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Questions de nanas</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t";
            // line 159
            if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
                // line 160
                echo "\t\t\t\t\t\t\t<a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_pending"), "html", null, true);
                echo "\">En attente de validation</a></li>
\t\t\t\t\t\t";
            }
            // line 162
            echo "\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 163
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_index"), "html", null, true);
            echo "\">Lister les questions</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 166
        echo "
\t\t\t\t\t";
        // line 167
        if ($this->env->getExtension('security')->isGranted("ROLE_EXPERT")) {
            // line 168
            echo "\t\t\t\t\t<!-- Vidéos -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Vidéos</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 172
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Video_enAttente"), "html", null, true);
            echo "\">En attente</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 174
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Video_ajouter"), "html", null, true);
            echo "\">Ajouter une vidéo</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 176
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Video_index"), "html", null, true);
            echo "\">Lister les vidéos</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 179
        echo "
\t\t\t\t\t";
        // line 180
        if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
            // line 181
            echo "\t\t\t\t\t<!-- Dossiers de la rédaction -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Dossiers</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 185
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_creer"), "html", null, true);
            echo "\">Créer un dossier</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 187
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_index"), "html", null, true);
            echo "\">Liste des dossiers</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 190
        echo "
\t\t\t\t\t";
        // line 191
        if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
            // line 192
            echo "\t\t\t\t\t<!-- Sélection shopping -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Sélections shopping</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 196
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Redaction_ajouterSelection"), "html", null, true);
            echo "\">Créer une sélection</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 198
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Redaction_selectionShoppingIndex"), "html", null, true);
            echo "\">Liste des sélections</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Quiz</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">Liste des quiz</li>
\t\t\t\t\t\t<li class=\"elementAction\">Créer un quiz</li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 206
        echo "
\t\t\t\t\t";
        // line 207
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 208
            echo "\t\t\t\t\t<!-- Jeux-concours -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Jeux-concours</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 212
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConcoursBundle_add"), "html", null, true);
            echo "\">Créer un jeu-concours</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 214
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConcoursBundle_index"), "html", null, true);
            echo "\">Index des concours</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 217
        echo "
\t\t\t\t\t";
        // line 218
        if ($this->env->getExtension('security')->isGranted("ROLE_JOURNALISTE")) {
            // line 219
            echo "\t\t\t\t\t<!-- Brèves -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Infos brèves</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 223
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Breve_ajouter"), "html", null, true);
            echo "\">Poster une info</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 225
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_breveLog"), "html", null, true);
            echo "\">Index des infos</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 228
        echo "\t\t\t\t</ul>

\t\t\t\t<ul class=\"adminActions\">

\t\t\t\t\t";
        // line 232
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 233
            echo "\t\t\t\t\t<!-- Gestion des iamges -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Images</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 237
            echo "\">Insérer une image</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 239
            echo "\">Catalogue d’images</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 242
        echo "
\t\t\t\t\t";
        // line 243
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 244
            echo "\t\t\t\t\t<!-- Gestion du slider de une -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Une</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 248
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DocumentBundle_sliderIndex"), "html", null, true);
            echo "\">Etat de la une</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 251
        echo "
\t\t\t\t\t";
        // line 252
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 253
            echo "\t\t\t\t\t<!-- Gestion de la newsletter -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">La lettre de TDN</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 257
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Newsletter_preparation"), "html", null, true);
            echo "\">Préparer une lettre</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 259
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Newsletter_preparation"), "html", null, true);
            echo "\">Programmer l'envoi</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 261
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Newsletter_index"), "html", null, true);
            echo "\">Index des lettres d’info</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 264
        echo "
\t\t\t\t\t";
        // line 265
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 266
            echo "\t\t\t\t\t<!-- Gestion des  produits -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Boutique</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">Préparer une newsletter</li>
\t\t\t\t\t\t<li class=\"elementAction\">Programmer l'envoi</li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 273
        echo "
\t\t\t\t\t";
        // line 274
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 275
            echo "\t\t\t\t\t<!-- Gestion de la pub -->
\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Publicité</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">Préparer une newsletter</li>
\t\t\t\t\t\t<li class=\"elementAction\">Programmer l'envoi</li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 282
        echo "\t\t\t\t</ul>
\t\t\t\t<ul class=\"adminActions\">
\t\t\t\t\t";
        // line 284
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 285
            echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Utilisateurs</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">Liste des inscrits</li>
\t\t\t\t\t\t<li class=\"elementAction\">Programmer l'envoi</li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 291
        echo "
\t\t\t\t\t";
        // line 292
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 293
            echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Commentaires</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">Quarantaine</li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 298
        echo "\t\t\t\t</ul>
\t\t\t\t<ul class=\"adminActions\">
\t\t\t\t\t";
        // line 300
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 301
            echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Rôles</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 304
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_rolesIndex"), "html", null, true);
            echo "\">Liste des rôles</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 306
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_roleAdd"), "html", null, true);
            echo "\">Ajouter un rôle</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 309
        echo "
\t\t\t\t\t";
        // line 310
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            // line 311
            echo "\t\t\t\t\t<li class=\"domainActions\"><a href=\"#\">Rubriques</a></li>
\t\t\t\t\t<ul class=\"setAction hiddenContent\">
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 314
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DocumentRubrique_Index"), "html", null, true);
            echo "\">Liste des rubriques</a></li>
\t\t\t\t\t\t<li class=\"elementAction\">
\t\t\t\t\t\t\t<a href=\"";
            // line 316
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DocumentRubrique_Creer"), "html", null, true);
            echo "\">Ajouter une rubrique</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        // line 319
        echo "\t\t\t\t</ul>
\t\t\t\t</ul>
\t\t\t</div>
\t\t</section>
\t\t
\t\t<section id=\"communaute\">
\t\t<div id=\"communaute\">
\t\t\t<h3 class=\"titre vertical titre-communaute\">Actus <span class=\"strong\">Communauté</span></h3>
\t\t\t<div id=\"actus-communaute\">
\t\t\t\t";
        // line 328
        echo $this->env->getExtension('actions')->renderAction("CoreBundle:Journal:display", array(), array());
        // line 329
        echo "\t\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("NanaBundle:Partial:showSelectionNanas", array(), array());
        // line 330
        echo "\t\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("CauseuseBundle:Partial:showFooterWidget", array("limite" => 10), array());
        // line 331
        echo "\t\t\t</div>
\t\t</section>
\t\t
\t\t<footer>
\t\t\t<div id=\"trucdenana\">
\t\t\t\t<p>&copy; TRUCDENANA 2008-2012 &ndash; Tous droits réservés</p>
\t\t\t\t<img class=\"solide\" src=\"";
        // line 337
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/footer/logo_aufeminin.png"), "html", null, true);
        echo "\" />
\t\t\t\t<p>Ce e-zine est commercialisé par aufeminin.com</p>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Communautés</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>Facebook</li>
\t\t\t\t\t<li>Twitter</li>
\t\t\t\t\t<li>Instagram</li>
\t\t\t\t\t<li>Hellocoton</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Site TDN</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li><a href=\"";
        // line 352
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_equipeTDN"), "html", null, true);
        echo "\">Qui sommes-nous ?</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 353
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_mentionsLegales"), "html", null, true);
        echo "\">Mentions légales</a></li>
\t\t\t\t\t<li>Mobile</li>
\t\t\t\t\t<li>Vos suggestions</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Partenaires</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>Blouson cuir sur Fashion-Cuir</li>
\t\t\t\t\t<li>Pourelles</li>
\t\t\t\t\t<li>Jeuxconcours</li>
\t\t\t\t\t<li>Concours gratuits</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Liens sponsorisés</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>Chemise homme cravate costume</li>
\t\t\t\t\t<li>monstylemoinscheer.com</li>
\t\t\t\t\t<li>Job étudiant</li>
\t\t\t\t\t<li>Boîte rangement vêtements</li>
\t\t\t\t\t<li>Tonvoyage.fr</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t
\t\t</footer>
\t</div>

\t<script src=\"";
        // line 381
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/ckeditor/ckeditor.js"), "html", null, true);
        echo "\"></script>
\t<script src=\"";
        // line 382
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/ckeditor/adapters/jquery.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\">
    \$(document).ready(function () {
      \$(\".domainActions a\").click(function (event) {
        event.preventDefault();
        \$(this).parent().next().toggleClass('hiddenContent shownContent');
      });

      var alerte = \$('.messages_systeme:not(:empty)');
      function alerteFlash () {
      \talerte.each(function() {
      \t\t\$(this).toggleClass('latentSystemMessages alerteSystemMessages');
      \t});
      }
      if (alerte.children().length >= 1) {
\t      alerteFlash();
\t      setTimeout(alerteFlash, 10000);
      }
     });

   \tfunction confirmeDelete(theAction) {
\t\t// Confirmation is not required in the configuration file
\t\t// or browser is Opera (crappy js implementation)
\t\tif (typeof(window.opera) != 'undefined') {
\t\t\treturn true;
\t\t}

\t\tvar is_confirmed = confirm(theAction);

\t\treturn is_confirmed;
\t}

\t</script>
\t
\t";
        // line 416
        $this->displayBlock('footer_scripts', $context, $blocks);
        // line 451
        echo "</body>
</html>
";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/marylin.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/color.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/form.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/header.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/teaser.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/sommaire.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/admin.css"), "html", null, true);
        echo "\" type=\"text/css\">
\t<link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/jquery-ui-1.10.2.custom.min.css"), "html", null, true);
        echo "\" type=\"text/css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/colorbox.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/nanoscroller.css"), "html", null, true);
        echo "\" />
\t";
    }

    // line 21
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 22
        echo "\t";
    }

    // line 24
    public function block_webfonts($context, array $blocks = array())
    {
        // line 25
        echo "\t<!--link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css' />
\t<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'-->
\t<style>
\t\t/*@font-face { font-family: 'Droid Sans'; src: url('fonts/DroidSans.ttf'); } */
\t\t/*@font-face { font-family: 'Questrial'; src: url('fonts/Questrial-Regular.ttf'); } */
\t</style>
\t";
    }

    // line 33
    public function block_header_scripts($context, array $blocks = array())
    {
        // line 34
        echo "\t<script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>
\t<script src=\"http://code.jquery.com/jquery-migrate-1.1.1.min.js\"></script>
\t<script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery-ui-1.10.2.custom.min.js"), "html", null, true);
        echo "\"></script>
\t<script src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.colorbox-min.js"), "html", null, true);
        echo "\"></script>
\t<script src=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.nanoscroller.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\" ></script>
\t";
    }

    // line 41
    public function block_local_header_scripts($context, array $blocks = array())
    {
        // line 42
        echo "\t";
    }

    // line 86
    public function block_header_pub($context, array $blocks = array())
    {
    }

    // line 116
    public function block_contenu_principal($context, array $blocks = array())
    {
    }

    // line 416
    public function block_footer_scripts($context, array $blocks = array())
    {
        // line 417
        echo "\t<script type=\"text/javascript\">
\t\$(document).ready(function () {
\t\t\$('#mytdn-grip').on('click', function () {
\t\t\t\$(this).closest('#mytdn').toggleClass('mytdn-closed mytdn-open');
\t\t});
\t\t\$('#mainNavigation').on('mouseenter', '.mainMenuLabel', function () {
\t\t\t\$(this).closest('#mainNavigation').find('.subMenuAffiche').each(function () { 
\t\t\t\t\$(this).toggleClass('subMenuMasque subMenuAffiche');
\t\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\t\tvar rubrique = menu.data('rubrique');
\t\t\t\tmenu.toggleClass('menu'+rubrique+\"Selected\");
\t\t\t});
\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\tvar rubrique = menu.data('rubrique');
\t\t\tmenu.toggleClass('menu'+rubrique+\"Selected\");
\t\t\t\$(this).parent().find('.subMenuMasque').toggleClass('subMenuMasque subMenuAffiche')
\t\t});
\t\t\$('#mainNavigation').on('mouseleave', function () {
\t\t\t\$(this).closest('#mainNavigation').find('.subMenuAffiche').each(function () { 
\t\t\t\t\$(this).toggleClass('subMenuMasque subMenuAffiche')
\t\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\t\tvar rubrique = menu.data('rubrique');
\t\t\t\tmenu.toggleClass('menu'+rubrique+\"Selected\");
\t\t\t});
\t\t});
\t\t\$('.deleteConfirm').click(function () {
\t\t\treturn confirmeDelete(\"Voulez-vous vraiment faire cela ? La suppression sera irréversible.\")
\t\t});
\t\t\$('a.popin').colorbox();
\t\t// \$(\".nano\").nanoScroller();
\t})
\t</script>
\t<!-- Google Analytics -->
\t";
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Default:TDNAdmin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  855 => 417,  852 => 416,  847 => 116,  842 => 86,  838 => 42,  835 => 41,  828 => 38,  824 => 37,  820 => 36,  816 => 34,  813 => 33,  803 => 25,  800 => 24,  796 => 22,  793 => 21,  787 => 19,  783 => 18,  779 => 17,  775 => 16,  771 => 15,  767 => 14,  763 => 13,  759 => 12,  755 => 11,  750 => 10,  747 => 9,  742 => 7,  736 => 451,  734 => 416,  697 => 382,  693 => 381,  662 => 353,  658 => 352,  640 => 337,  632 => 331,  629 => 330,  626 => 329,  624 => 328,  613 => 319,  607 => 316,  602 => 314,  597 => 311,  595 => 310,  592 => 309,  586 => 306,  581 => 304,  576 => 301,  574 => 300,  570 => 298,  563 => 293,  561 => 292,  558 => 291,  550 => 285,  548 => 284,  544 => 282,  535 => 275,  533 => 274,  530 => 273,  521 => 266,  519 => 265,  516 => 264,  510 => 261,  505 => 259,  500 => 257,  494 => 253,  492 => 252,  489 => 251,  483 => 248,  477 => 244,  475 => 243,  472 => 242,  467 => 239,  463 => 237,  457 => 233,  455 => 232,  449 => 228,  443 => 225,  438 => 223,  432 => 219,  430 => 218,  427 => 217,  421 => 214,  416 => 212,  410 => 208,  408 => 207,  405 => 206,  394 => 198,  389 => 196,  383 => 192,  381 => 191,  378 => 190,  372 => 187,  367 => 185,  361 => 181,  359 => 180,  356 => 179,  350 => 176,  345 => 174,  340 => 172,  334 => 168,  332 => 167,  329 => 166,  323 => 163,  320 => 162,  314 => 160,  312 => 159,  306 => 155,  304 => 154,  298 => 151,  294 => 149,  288 => 146,  285 => 145,  282 => 144,  276 => 141,  273 => 140,  270 => 139,  264 => 136,  261 => 135,  259 => 134,  255 => 132,  249 => 129,  244 => 127,  239 => 125,  234 => 122,  232 => 121,  227 => 119,  223 => 117,  221 => 116,  209 => 107,  206 => 106,  204 => 105,  198 => 102,  192 => 99,  186 => 96,  180 => 93,  172 => 87,  170 => 86,  162 => 81,  158 => 80,  153 => 77,  151 => 76,  141 => 68,  138 => 67,  129 => 64,  126 => 63,  121 => 62,  118 => 61,  115 => 60,  106 => 57,  98 => 55,  92 => 53,  83 => 50,  80 => 49,  75 => 48,  73 => 47,  66 => 42,  63 => 41,  56 => 24,  52 => 22,  49 => 21,  43 => 8,  39 => 7,  35 => 6,  251 => 53,  246 => 75,  240 => 71,  237 => 70,  222 => 68,  216 => 67,  211 => 64,  205 => 62,  199 => 60,  197 => 59,  191 => 58,  188 => 57,  181 => 56,  178 => 55,  173 => 54,  171 => 53,  166 => 52,  148 => 51,  146 => 50,  142 => 48,  133 => 46,  128 => 45,  117 => 42,  114 => 41,  110 => 40,  103 => 56,  95 => 54,  93 => 32,  90 => 31,  82 => 25,  71 => 23,  67 => 22,  60 => 19,  58 => 32,  53 => 16,  47 => 9,  41 => 11,  36 => 6,  69 => 19,  65 => 17,  61 => 33,  55 => 13,  50 => 10,  44 => 12,  40 => 8,  34 => 5,  31 => 3,  28 => 1,);
    }
}
