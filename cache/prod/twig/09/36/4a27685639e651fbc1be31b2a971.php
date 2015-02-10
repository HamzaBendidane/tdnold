<?php

/* DocumentBundle:Default:TDNDocument.html.twig */
class __TwigTemplate_09364a27685639e651fbc1be31b2a971 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'webfonts' => array($this, 'block_webfonts'),
            'local_header_scripts' => array($this, 'block_local_header_scripts'),
            'contenu_principal' => array($this, 'block_contenu_principal'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo " | Trucs De Nana</title>
";
        // line 5
        if (array_key_exists("canonical", $context)) {
            // line 6
            echo "\t<link rel=\"canonical\" http=\"http://www.trucsdanana.com";
            echo twig_escape_filter($this->env, $this->getContext($context, "canonical"), "html", null, true);
            echo "\" />
";
        }
        // line 8
        echo "\t<!-- <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/favicon.ico"), "html", null, true);
        echo "\" /> -->
\t<meta name=\"google-site-verification\" content=\"fq8zrWpv2MoWmc3miAE5MecQa2oy6F9gjj2OFRU0zEk\" />
\t<meta name=\"verification\" content=\"2f58130aa4c3936441a51b3b7d85f013\" />
\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
\t";
        // line 12
        if (array_key_exists("meta_description", $context)) {
            echo "<meta name=\"description\" content='";
            echo twig_escape_filter($this->env, $this->getContext($context, "meta_description"), "html", null, true);
            echo "' />";
        }
        // line 13
        echo "\t";
        if (array_key_exists("meta_keywords", $context)) {
            echo "<meta name=\"keywords\" content='";
            echo twig_escape_filter($this->env, $this->getContext($context, "meta_keywords"), "html", null, true);
            echo "' />";
        }
        // line 14
        echo "\t";
        // line 19
        echo "\t<!--link rel=\"stylesheet\" href=\"";
        echo "\" /-->
\t";
        // line 21
        echo "\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/marylin.min.css"), "html", null, true);
        echo "\" />
\t<!-- <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/color.css"), "html", null, true);
        echo "\" /> -->
\t<!-- <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/header.css"), "html", null, true);
        echo "\" /> -->
\t<!-- <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/teaser.css"), "html", null, true);
        echo "\" /> -->
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/sommaire.css"), "html", null, true);
        echo "\" />
\t<!-- <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/article.css"), "html", null, true);
        echo "\" /> -->
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/form.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/colorbox.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/nanoscroller.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/jquery-ui-1.10.3.custom.min.css"), "html", null, true);
        echo "\" type=\"text/css\">
\t<link rel=\"stylesheet\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/inscription.css"), "html", null, true);
        echo "\" type=\"text/css\">
\t";
        // line 32
        $this->displayBlock('local_stylesheets', $context, $blocks);
        // line 34
        echo "
\t<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/favicon.ico"), "html", null, true);
        echo "\" />
\t
\t";
        // line 37
        $this->displayBlock('webfonts', $context, $blocks);
        // line 45
        echo "
\t <!-- Affliliation aufeminin.com -->
\t<script type=\"text/javascript\">
\tsas_tmstp=Math.round(Math.random()*10000000000);
\tsas_masterflag=1;
\tfunction SmartAdServer(sas_pageid,sas_formatid,sas_target) {
\t\tif (sas_masterflag==1) {
\t\t\tsas_masterflag=0;
\t\t\tsas_master='M';
\t\t} else {
\t\t\tsas_master='S';
\t\t};
\t\tdocument.write('<scr'+'ipt src=\"http://network.aufeminin.com/call/pubj/' + sas_pageid + '/' + sas_formatid + '/' + sas_master + '/' + sas_tmstp + '/' + escape(sas_target) + '?\"></scr'+'ipt>');
\t}
\t</script>

\t<script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>
\t<script src=\"http://code.jquery.com/jquery-migrate-1.1.1.min.js\"></script>

\t";
        // line 64
        $this->displayBlock('local_header_scripts', $context, $blocks);
        // line 66
        echo "</head>
";
        // line 67
        if ((array_key_exists("rubrique", $context) && ($this->getContext($context, "rubrique") == "sponsored"))) {
            // line 68
            echo "<body class=\"theme-";
            echo twig_escape_filter($this->env, $this->getContext($context, "rubrique"), "html", null, true);
            echo "\" style=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->hasSponsorFunction($this->getContext($context, "rubriqueEntity")), "html", null, true);
            echo "\">
";
        } elseif (array_key_exists("rubriqueEntity", $context)) {
            // line 70
            echo "<body class=\"theme-";
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "rubriqueEntity")), "html", null, true);
            echo "\">
\t<!-- Affichage Sublimeskinz -->
\t<script type=\"text/javascript\" src=\"http://ads.ayads.co/ajs.php?zid=2027\"></script>
";
        } else {
            // line 74
            echo "<body class=\"theme-";
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "rubrique")), "html", null, true);
            echo "\">
\t<!-- Affichage Sublimeskinz -->
\t<script type=\"text/javascript\" src=\"http://ads.ayads.co/ajs.php?zid=2027\"></script>
\t<noscript>
\t\t<div class=\"noscript\">Attention ! Une partie des fonctions de Trucs de nana repose sur l'utilisation de JavaScript. Votre navigateur ne semble pas configuré pour exécuter ces codes.</div>
\t</noscript>
";
        }
        // line 81
        echo "\t<div class=\"messages_systeme latentSystemMessages\">
\t";
        // line 82
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "hasFlash", array(0 => "success"), "method")) {
            // line 83
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "success"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 84
                echo "\t    <div class=\"flash-success\">
\t        ";
                // line 85
                echo $this->getContext($context, "flashMessage");
                echo "
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 88
            echo "\t";
        }
        // line 89
        echo "\t";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "hasFlash", array(0 => "fail"), "method")) {
            // line 90
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flashbag"), "get", array(0 => "fail"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 91
                echo "\t    <div class=\"flash-fail\">
\t        ";
                // line 92
                echo $this->getContext($context, "flashMessage");
                echo "
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 95
            echo "\t";
        }
        // line 96
        echo "\t</div>
\t<div class=\"top-border\"></div>
\t<!--div id=\"bottom-background\" class=\"";
        // line 98
        echo twig_escape_filter($this->env, $this->getContext($context, "rubrique"), "html", null, true);
        echo "_secondaire\" style=\"position:fixed; bottom:0; width:100%; height:100px;z-index:1\"></div-->
\t<!--div id=\"social-clipper\">
\t\t<h2 class=\"vertical\">
\t\t\t<a href=\"#espaceCommunaute\"><span class=\"emeraude\">News</span> <span class=\"rose\">Communauté</span></a>
\t\t</h2>
\t</div-->
\t<div id=\"tdn-wrapper\">
\t\t<div class=\"top-border\"></div>
\t\t<div id=\"mytdn-wrapper\">
\t\t";
        // line 107
        echo $this->env->getExtension('actions')->renderAction("CoreBundle:Header:display", array(), array());
        // line 108
        echo "\t\t</div>
\t\t<div id=\"tdn-header\">
\t\t\t<a href=\"";
        // line 110
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_home"), "html", null, true);
        echo "\">
\t\t\t\t<img id=\"logo-wrapper\" src=\"";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/logo_TDN.png"), "html", null, true);
        echo "\" alt=\"Logo - Lien vers la page d'accueil\" />
\t\t\t</a>
\t\t\t<div id=\"header-pub\">
\t\t\t";
        // line 114
        $this->env->loadTemplate("AdvertiseBundle:Aufeminin:leaderboard.html.twig")->display($context);
        // line 115
        echo "\t\t\t</div>
\t\t</div>
\t\t
\t\t<div id=\"menu-principal\">
\t\t\t<div id=\"fonctions-sociales\">
\t\t\t\t<a href=\"http://www.facebook.com/trucdenana\">
\t\t\t\t\t<img src=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_facebook.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"https://twitter.com/TrucdeNana\">
\t\t\t\t\t<img src=\"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_twitter.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"http://www.hellocoton.fr/mapage/trucdenana\">
\t\t\t\t\t<img src=\"";
        // line 127
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_hellocoton.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t\t<a href=\"https://itunes.apple.com/fr/app/truc-de-nana/id369735750\">
\t\t\t\t\t<img src=\"";
        // line 130
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/tetiere/navigation/icone_app-store.png"), "html", null, true);
        echo "\">
\t\t\t\t</a>
\t\t\t</div>
\t\t\t";
        // line 133
        echo $this->env->getExtension('actions')->renderAction("DocumentBundle:Rubrique:mainNavigation", array(), array());
        // line 134
        echo "\t\t\t<div id=\"recherche-rapide\">
\t\t\t\t<form name=\"recherche\" id=\"recherche\" action=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_rechercheForm"), "html", null, true);
        echo "\" method=\"get\" enctype=\"\">
\t\t\t\t\t<input type=\"text\" size=\"15\" name=\"seed\" />
\t\t\t\t\t<input type=\"submit\" name=\"quicksearch\" class=\"submitter\" value=\">\" />
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>

\t\t<div id=\"contenu-principal\"";
        // line 142
        if (array_key_exists("isSommaire", $context)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "isSommaire"), "html", null, true);
            echo "\"";
        }
        echo ">
\t\t\t<div id=\"contenu\">
\t\t\t\t";
        // line 144
        $this->displayBlock('contenu_principal', $context, $blocks);
        // line 145
        echo "\t\t\t</div>
\t\t\t<aside id=\"sidebar\">
\t\t\t";
        // line 147
        $this->env->loadTemplate("CoreBundle:Bloc:mainSidebar.html.twig")->display($context);
        // line 148
        echo "\t\t\t</aside>
\t\t</div>
\t\t
\t\t<a name=\"espaceCommunaute\"></a>
\t\t<div id=\"communaute\">
\t\t\t<h3 class=\"titre vertical titre-communaute\">Actus <span class=\"strong\">Communauté</span></h3>
\t\t\t<div id=\"actus-communaute\">
\t\t\t\t";
        // line 155
        echo $this->env->getExtension('actions')->renderAction("CoreBundle:Journal:display", array(), array());
        // line 156
        echo "\t\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("NanaBundle:Partial:showSelectionNanas", array(), array());
        // line 157
        echo "\t\t\t\t";
        echo $this->env->getExtension('actions')->renderAction("CauseuseBundle:Partial:showFooterWidget", array("limite" => 10), array());
        // line 158
        echo "\t\t\t</div>
\t\t</div>
\t\t
\t\t<footer>
\t\t\t<div id=\"trucdenana\">
\t\t\t\t<p>&copy; TRUCDENANA 2008-2012 &ndash; Tous droits réservés</p>
\t\t\t\t<img class=\"solide\" src=\"";
        // line 164
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/footer/logo_aufeminin.png"), "html", null, true);
        echo "\" />
\t\t\t\t<p>Ce e-zine est commercialisé par aufeminin.com</p>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Communautés</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"http://www.facebook.com/trucdenana\">Facebook</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"https://twitter.com/TrucdeNana\">Twitter</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"http://instagram.com/justine_trucsdenana\">Instagram (Justine)</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"http://www.hellocoton.fr/mapage/trucdenana\">Hellocoton</a></li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Site TDN</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li><a href=\"";
        // line 183
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_equipeTDN"), "html", null, true);
        echo "\">Qui sommes-nous ?</a></li>
\t\t\t\t\t<li><a href=\"";
        // line 184
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_mentionsLegales"), "html", null, true);
        echo "\">Mentions légales</a></li>
\t\t\t\t\t<li>Mobile (à venir)</li>
\t\t\t\t\t<li><a href=\"";
        // line 186
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_contact"), "html", null, true);
        echo "\">Vos suggestions</a></li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Partenaires</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://blueberryhome.fr\">Blueberryhome, un super blog déco</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.dlabshop.com/\">D-Lab, Nutricosmétique Professionnelle</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.hairbox.fr/\">Hairbox, conseils coiffure et relooking</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.ds-relooking.com/\">DS Relooking, conseil en image</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.planet-fitness.fr/\">Planet-Fitness, vêtements fitness et accessoires</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.fitness.fr/\">Toute l'actualité fitness</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://Lucilewoodward.com/\">Le meilleur blog forme</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://cinemilie.blogspot.com/\">Toute l'actu ciné</a></li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a target=\"_blank\" href=\"http://www.best-of-voyance.com\">Astrologie, voyance et Astro Love</a></li>
\t\t\t\t\t<!--li>
\t\t\t\t\t\t<a href=\"http://www.autourdemaman.com/\">Autour de maman</a></li-->
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<div class=\"colonne-footer\">
\t\t\t\t<h4>Flux</h4>
\t\t\t\t<ul>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"http://www.trucsdenana.com/articles/feed.rss\" class=\"RSSMark\">Flux RSS des articles</a>
\t\t\t\t\t</li>
\t\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"http://www.trucsdenana.com/conseils-experts/feed.rss\" class=\"RSSMark\">Flux RSS des conseils</a>
\t\t\t\t\t</li>
\t\t\t</ul>
\t\t\t</div>
\t\t\t
\t\t</footer>
\t</div>
\t
\t<script src=\"";
        // line 229
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery-ui-1.10.3.custom.min.js"), "html", null, true);
        echo "\"></script>
\t<script src=\"";
        // line 230
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.colorbox-min.js"), "html", null, true);
        echo "\"></script>
\t<script src=\"";
        // line 231
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/jquery.nanoscroller.js"), "html", null, true);
        echo "\"></script>
\t<script type=\"text/javascript\">
\t
\t\t\$(document).ready(function () {
\t\t\t\$('.theme-sponsored').css('cursor', 'pointer'):
\t\t\t\$('.theme-sponsored *').css('cursor', 'auto'):
\t\t\t\$('#mytdn-grip').on('click', function () {
\t\t\t\t\$(this).closest('#mytdn').toggleClass('mytdn-closed mytdn-open');
\t\t\t});
\t\t\t\$('#mainNavigation').on('mouseenter', '.mainMenuLabel', function () {
\t\t\t\t\$(this).closest('#mainNavigation').find('.subMenuAffiche').each(function () { 
\t\t\t\t\t\$(this).toggleClass('subMenuMasque subMenuAffiche');
\t\t\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\t\t\tvar rubrique = menu.data('rubrique');
\t\t\t\t\tmenu.toggleClass('menu-'+rubrique+\"-selected\");
\t\t\t\t});
\t\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\t\tvar rubrique = menu.data('rubrique');
\t\t\t\tmenu.toggleClass('menu-'+rubrique+\"-selected\");
\t\t\t\t\$(this).parent().find('.subMenuMasque').toggleClass('subMenuMasque subMenuAffiche')
\t\t\t});
\t\t\t\$('#mainNavigation').on('mouseleave', function () {
\t\t\t\t\$(this).closest('#mainNavigation').find('.subMenuAffiche').each(function () { 
\t\t\t\t\t\$(this).toggleClass('subMenuMasque subMenuAffiche')
\t\t\t\t\tvar menu = \$(this).closest('.main-menu');
\t\t\t\t\tvar rubrique = menu.data('rubrique');
\t\t\t\t\tmenu.toggleClass('menu-'+rubrique+\"-selected\");
\t\t\t\t});
\t\t\t});
\t\t\t// Affichage des messages système
\t\t\tvar alerte = \$('.messages_systeme:not(:empty)');
\t      \tif (alerte.children().length >= 1) {
\t\t      alerteFlash();
\t\t      setTimeout(alerteFlash, 10000);
\t      \t};
\t\t\tfunction alerteFlash () {
\t      \t\talerte.each(function() {
\t      \t\t\t\$(this).toggleClass('latentSystemMessages alerteSystemMessages');
\t      \t\t});
\t      \t}

\t\t\t\$('a.popin').colorbox({'close': 'Fermer la fenêtre'});
\t\t\t\$(\".nano\").nanoScroller();
\t\t\t// Forcer l'ouverture des lines externes dans une nouvelle fenêtre
\t\t    \$('#article-wrapper a').each(function() {
\t\t      var target = \$(this).prop('target');
\t\t      var href =  \$(this).prop('href');
\t\t      var protocole = href.substr(0,7);
\t\t      var externe = href.indexOf('trucsdenana.com', 6);
\t\t      console.log(externe);
\t\t      if (protocole == 'http://' && externe == -1) {
\t\t        console.log(href);
\t\t        \$(this).attr('target', '_blank');
\t\t        \$(this).attr('rel', 'nofollow');
\t\t      }
\t\t    })    

\t\t\t";
        // line 288
        if ((array_key_exists("sponsorLink", $context) && ($this->getContext($context, "sponsorLink") != "#"))) {
            // line 289
            echo "\t\t\t";
            $context["extern"] = twig_slice($this->env, $this->getContext($context, "sponsorLink"), 0, 7);
            // line 290
            echo "\t\t\t\$('body.theme-sponsored').mouseup(function(e) {
\t\t\t\tconsole.log('clic détecté');
\t\t\t\t";
            // line 292
            if (($this->getContext($context, "extern") == "http://")) {
                // line 293
                echo "\t\t\t\twindow.open('";
                echo twig_escape_filter($this->env, $this->getContext($context, "sponsorLink"), "html", null, true);
                echo "','_self', 'scrollbars,resizable,width=1024,height=768');
\t\t\t\t";
            } else {
                // line 295
                echo "\t\t\t\twindow.location = 'http://www.trucsdenana.com/";
                echo twig_escape_filter($this->env, $this->getContext($context, "sponsorLink"), "html", null, true);
                echo "';
\t\t\t\t";
            }
            // line 297
            echo "\t\t\t});
\t\t\t\$('body.theme-sponsored div').mouseup(function (e) {
\t\t\t\te.stopPropagation();
\t\t\t});
\t\t\t";
        }
        // line 302
        echo "
\t\t   \tfunction confirmeDelete(theAction) {
\t\t\t\t// Confirmation is not required in the configuration file
\t\t\t\t// or browser is Opera (crappy js implementation)
\t\t\t\tif (typeof(window.opera) != 'undefined') {
\t\t\t\t\treturn true;
\t\t\t\t}
\t\t\t\tvar is_confirmed = confirm(theAction);
\t\t\t\treturn is_confirmed;
\t\t\t}
\t\t});

\t</script>
\t
\t<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1556833-29', 'trucsdenana.com');
  ga('send', 'pageview');
\t</script>
\t<script type=\"text/javascript\" src=\"http://j.clickdensity.com/cr.js\"></script>
<script type=\"text/javascript\">
//<![CDATA[
  var clickdensity_keyElement = 'logo-wrapper';
//]]>
</script>
<script type=\"text/javascript\"> 
\twindow._ttf = window._ttf || [];
\t_ttf.push({format:'maxbrand'
\t,pid:22314
\t,avoidSlot: ['#bloc-inscription > #membres-inscription > img', '#bloc-inscription', '.lienFleche', '.lienFleche .popin.cboxElement > img', '#inviteInscription']


\t}); 

\t(function(d){ 
\t\tvar js, s = d.getElementsByTagName('script')[0]; 
\t\tjs = d.createElement('script'); js.async = true; 
\t\tjs.src = \"http://cdn.teads.tv/js/all-v1.js\"; 
\t\ts.parentNode.insertBefore(js, s); 
\t})(window.document); 
</script></body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 32
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 33
        echo "\t";
    }

    // line 37
    public function block_webfonts($context, array $blocks = array())
    {
        // line 38
        echo "\t<!--link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css' />
\t<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'-->
\t<style>
\t\t@font-face { font-family: Droid Sans; src: url('/assets/css/fonts/DroidSans.ttf'); } 
\t\t@font-face { font-family: Questrial; src: url('/assets/css/fonts/Questrial-Regular.ttf'); } 
\t</style>
\t";
    }

    // line 64
    public function block_local_header_scripts($context, array $blocks = array())
    {
        // line 65
        echo "\t";
    }

    // line 144
    public function block_contenu_principal($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Default:TDNDocument.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  608 => 144,  604 => 65,  601 => 64,  591 => 38,  588 => 37,  584 => 33,  581 => 32,  576 => 4,  526 => 302,  519 => 297,  513 => 295,  507 => 293,  505 => 292,  501 => 290,  498 => 289,  496 => 288,  436 => 231,  432 => 230,  428 => 229,  382 => 186,  377 => 184,  373 => 183,  351 => 164,  343 => 158,  340 => 157,  337 => 156,  335 => 155,  326 => 148,  324 => 147,  320 => 145,  318 => 144,  309 => 142,  299 => 135,  296 => 134,  294 => 133,  288 => 130,  282 => 127,  276 => 124,  270 => 121,  262 => 115,  260 => 114,  254 => 111,  250 => 110,  246 => 108,  244 => 107,  232 => 98,  228 => 96,  225 => 95,  216 => 92,  213 => 91,  208 => 90,  205 => 89,  202 => 88,  193 => 85,  190 => 84,  185 => 83,  183 => 82,  180 => 81,  169 => 74,  161 => 70,  153 => 68,  151 => 67,  148 => 66,  146 => 64,  125 => 45,  123 => 37,  118 => 35,  115 => 34,  113 => 32,  109 => 31,  105 => 30,  101 => 29,  97 => 28,  93 => 27,  89 => 26,  85 => 25,  81 => 24,  77 => 23,  73 => 22,  68 => 21,  64 => 19,  62 => 14,  55 => 13,  49 => 12,  41 => 8,  35 => 6,  33 => 5,  29 => 4,  24 => 1,);
    }
}
