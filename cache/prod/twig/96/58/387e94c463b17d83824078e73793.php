<?php

/* ProduitBundle:Page:pageProduits.html.twig */
class __TwigTemplate_9658387e94c463b17d83824078e73793 extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "titre"), "html", null, true);
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/concours.css"), "html", null, true);
        echo "\" type=\"text/css\">
<script type=\"text/javascript\" src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/custom-form-elements.js"), "html", null, true);
        echo "\"></script>
";
    }

    // line 10
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 11
        echo "<div class=\"postit-contenu\">
\t<img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/selection-shopping_titre_299x80.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"article-wrapper\" class=\"main sommaire-produits\">

\t<!-- Contenu de l'article -->

\t<!-- Bloc pour l'affichage des métadonnées de l'article -->
\t<div id=\"search\">
\t\t<div id=\"metadata\" class=\"metadata\">
\t\t\t<p class=\"auteur\"><span class=\"standardEtiquette\">Fiche produit</span> </p>
\t\t     <p class=\"liste-rubriques\">
\t\t      <span class=\"standardEtiquette\">Rubrique :</span> 
\t\t      ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "vedette"), "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 25
            echo "\t\t        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getAttribute($this->getContext($context, "r"), "slug"))), "html", null, true);
            echo "\">
\t\t          <span class=\"rubrique-";
            // line 26
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "r")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "titre"), "html", null, true);
            echo "
\t\t        </a>
\t\t      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 29
        echo "\t\t      </span>
\t\t     </p>
\t\t</div>
\t</div>

\t<!-- Bloc pour l'affichage du contenu de l'article -->
\t<section class=\"vedette catalogueProduit\">
\t\t<img src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "vedette")), "html", null, true);
        echo "\"/>
\t\t<div id=\"data-gondole\">
\t\t\t<h1>";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "titre"), "html", null, true);
        echo "</h1>
\t\t\t<p class=\"marque\"><span class=\"standardEtiquette\">Marque :</span> ";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "marque"), "html", null, true);
        echo "</p>
\t\t\t<p class=\"prix\"><span class=\"standardEtiquette\">Prix :</span> ";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "prix"), "html", null, true);
        echo "</p>
\t\t\t<h3>Le produit</h3>
\t\t\t<div class=\"description\">";
        // line 42
        echo $this->getAttribute($this->getContext($context, "vedette"), "abstract");
        echo "</div>
\t\t\t<h3>L'avis de TDN</h3>
\t\t\t<div class=\"critique\">";
        // line 44
        echo $this->getAttribute($this->getContext($context, "vedette"), "critique");
        echo "</div>
\t\t\t";
        // line 45
        if ((!(null === $this->getAttribute($this->getContext($context, "vedette"), "codePromoTDN")))) {
            // line 46
            echo "\t\t\t<p class=\"codePromo\">Code Promo TDN : ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "codePromoTDN"), "html", null, true);
            echo "</p>
\t\t\t";
        }
        // line 48
        echo "
\t\t\t";
        // line 49
        if (((!(null === $this->getAttribute($this->getContext($context, "vedette"), "lnSelection"))) && ($this->getAttribute($this->getAttribute($this->getContext($context, "vedette"), "lnSelection"), "statut") == "SELECTION_PUBLIEE"))) {
            // line 50
            echo "\t\t\t<p class=\"selectionShopping\">
\t\t\t\t<a href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getAttribute($this->getContext($context, "vedette"), "lnSelection")), "html", null, true);
            echo "\">Toute la sélection shopping</a>
\t\t\t</p>
\t\t\t";
        }
        // line 54
        echo "
\t\t\t";
        // line 55
        if ((!(null === $this->getAttribute($this->getContext($context, "vedette"), "citation")))) {
            // line 56
            echo "\t\t\t<p class=\"lienArticle\">
\t\t\t\t<a href=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getAttribute($this->getContext($context, "vedette"), "citation")), "html", null, true);
            echo "\">Lire l'article qui en parle</a>
\t\t\t</p>
\t\t\t";
        }
        // line 60
        echo "
\t\t\t<div class=\"bouton\"><a href=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "vedette"), "url"), "html", null, true);
        echo "\" target=\"_blank\">Découvrir</a></div>
\t\t</div>

\t</section>
\t<!-- Catalogue des produits -->
\t<section id=\"corps\" class=\"table-content\">  
\t\t<div id=\"more\">
\t\t\t<h1>Catalogue de TDN</h1>
\t\t\t<div class=\"moteur\">
\t\t\t\t<form name=\"triTag\" id=\"triRubrique\" action=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_catalogue"), "html", null, true);
        echo "\" method=\"post\">
\t\t\t\t\t<input type=\"text\" name=\"tag\" id=\"tag\" placeholder=\"Cherche par mot-clef\" />
\t\t\t\t</form>
\t\t\t\t<a class=\"lien-mince\" style=\"display:block; margin:10px 0 5px 0;\" href=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_catalogue", array("set" => "tout")), "html", null, true);
        echo "\">Tout voir</a>
\t\t\t</div>

\t\t\t<div style=\"clear:both; height:10px\"> </div>
\t\t\t";
        // line 77
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "produits"));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 78
            echo "\t\t\t<div class=\"snapshot-wrapper\">
\t\t\t\t<div class=\"vignette-video-wrapper\">
\t\t\t\t\t<div class=\"vignette-video cornered-";
            // line 80
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "p"), "lnThematique")), "html", null, true);
            echo "\">
\t\t\t\t\t\t<img src=\"";
            // line 81
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "p")), "html", null, true);
            echo "\" class=\"\" />
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<h3 class=\"titre-resume\">
\t\t\t\t\t<a href=\"";
            // line 85
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_showProduit", array("id" => $this->getAttribute($this->getContext($context, "p"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "p"), "slug"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "titre"), "html", null, true);
            echo "</a>
\t\t\t\t</h3>
\t\t\t\t<p class=\"pop\">";
            // line 87
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "marque"), "html", null, true);
            echo "</p>
\t\t\t\t";
            // line 88
            if (($this->getAttribute($this->getContext($context, "p"), "critique") != "")) {
                // line 89
                echo "\t            <h3>L’avis de TDN</h3>
    \t        <div class=\"produitAvis\">";
                // line 90
                echo $this->getAttribute($this->getContext($context, "p"), "critique");
                echo "</div>
\t\t\t\t";
            }
            // line 92
            echo "\t\t\t\t<p class=\"lien-standard\"><a href=\"http://";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "url"), "html", null, true);
            echo "\" target=\"_blank\">Découvrir</a></p>
\t\t\t\t</div>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 95
        echo "\t\t\t";
        if (($this->getContext($context, "derniere") > 1)) {
            // line 96
            echo "\t\t\t<form name=\"pager\" id=\"pagerForm\" action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Produit_showProduit", array("id" => $this->getAttribute($this->getContext($context, "vedette"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "vedette"), "slug"))), "html", null, true);
            echo "\" method=\"get\">
\t\t\t\tPage : <input type=\"text\" name=\"page\" id=\"page\" size=\"2\" style=\"border: 0; color: #000; font-weight: bold;\" /> <span class=\"totalSlides\">(sur ";
            // line 97
            echo twig_escape_filter($this->env, $this->getContext($context, "derniere"), "html", null, true);
            echo ")</span>
\t\t\t\t<div id=\"pageSlider\" style=\"display:inline-block;width:160px;position:relative;top:3px\"></div>
\t\t\t</form>
\t\t\t<script>
\t\t\t\$(document).ready(function() {
\t\t\t\t\$( \"#pageSlider\" ).slider({
\t\t\t\t\tvalue:";
            // line 103
            echo twig_escape_filter($this->env, $this->getContext($context, "page"), "html", null, true);
            echo ",
\t\t\t\t\tmin: 1,
\t\t\t\t\tmax: ";
            // line 105
            echo twig_escape_filter($this->env, $this->getContext($context, "derniere"), "html", null, true);
            echo ",
\t\t\t\t\tstep: 1,
\t\t\t\t\tslide: function(event, ui) {
\t\t\t\t\t\t\$(\"#page\").val(ui.value );
\t\t\t\t\t},
\t\t\t\t\tstop: function(event, ui) {
\t\t\t\t\t\t\$(\"#page\").val(ui.value );
\t\t\t\t\t\t\$(\"#pagerForm\").submit();
\t\t\t\t\t}
\t\t\t\t});
\t\t\t\t\$( \"#page\" ).val(\$( \"#pageSlider\" ).slider( \"value\" ) );
\t\t\t});
\t\t\t</script>
\t\t\t";
        }
        // line 119
        echo "\t\t</div>
\t</section>
</article>
";
    }

    public function getTemplateName()
    {
        return "ProduitBundle:Page:pageProduits.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  280 => 119,  263 => 105,  258 => 103,  249 => 97,  244 => 96,  241 => 95,  231 => 92,  226 => 90,  223 => 89,  221 => 88,  217 => 87,  210 => 85,  203 => 81,  199 => 80,  195 => 78,  191 => 77,  184 => 73,  178 => 70,  166 => 61,  163 => 60,  157 => 57,  154 => 56,  152 => 55,  149 => 54,  143 => 51,  140 => 50,  138 => 49,  135 => 48,  129 => 46,  127 => 45,  123 => 44,  118 => 42,  113 => 40,  109 => 39,  105 => 38,  100 => 36,  91 => 29,  80 => 26,  75 => 25,  71 => 24,  56 => 12,  53 => 11,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 3,);
    }
}
