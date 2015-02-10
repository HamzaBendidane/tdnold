<?php

/* RedactionBundle:Default:shopping.html.twig */
class __TwigTemplate_b339b1be36e4a9802d09bb87456585ac extends Twig_Template
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
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "selection"), "titre") . " | Sélection shopping ") . $this->getAttribute($this->getAttribute($this->getContext($context, "selection"), "lnThematique"), "titre")), "html", null, true);
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/commentaire.css"), "html", null, true);
        echo "\" type=\"text/css\">
";
    }

    // line 9
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 10
        echo "<div class=\"postit-contenu\">
   <img src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/selection-shopping_titre_299x80.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"article-wrapper\" class=\"main selection-shopping\">

  <!-- Contenu de la sélection -->
   <section class=\"contenu main-section\">

      <!-- Bloc pour l'affichage des métadonnées de la sélection -->
      <div id=\"metadata\" class=\"metadata\">
         <p class=\"auteur\">
            <span class=\"standardEtiquette\">Ecrit par </span> 
            <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "selection"), "lnAuteur"), "idNana"))), "html", null, true);
        echo "\" class=\"nom-auteur\">";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "selection"), "lnAuteur"), "prenom") . " ") . $this->getAttribute($this->getAttribute($this->getContext($context, "selection"), "lnAuteur"), "nom")), "html", null, true);
        echo " (";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getContext($context, "selection"), "lnAuteur"), "roles"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "name"), "html", null, true);
            echo " ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo ")</a> le  
            <span class=\"date-publication\">";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "selection"), "datePublication"), "d m Y"), "html", null, true);
        echo "</span>
         </p>
         <p>
          <span class=\"label\">Rubrique :</span> 
          ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "selection"), "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo "<span class=\"rubrique-";
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "r")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "titre"), "html", null, true);
            echo "</span>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 28
        echo "         </p>
      </div>

      <!-- Bloc pour l'affichage du contenu de la  sélection -->
      <div id=\"corps\" class=\"corps\">
         <h1>";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "selection"), "titre"), "html", null, true);
        echo "</h1>
         <div id=\"selectionAbstract\">
          ";
        // line 35
        echo $this->getAttribute($this->getContext($context, "selection"), "abstract");
        echo "
         </div>

         ";
        // line 38
        $context["i"] = 1;
        // line 39
        echo "         ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "selection"), "setProduit"));
        foreach ($context['_seq'] as $context["_key"] => $context["produit"]) {
            // line 40
            echo "         <div class=\"diapoProduit ";
            if (($this->getContext($context, "i") == 1)) {
                echo "diapoActive";
            } else {
                echo "diapoMasquee";
            }
            echo "\" id=\"selection_";
            echo twig_escape_filter($this->env, $this->getContext($context, "i"), "html", null, true);
            echo "\">
          <div class=\"colonneImage\">
            <div class=\"imageProduit ombreCentree\">
               <img src=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "produit")), "html", null, true);
            echo "\" />
            </div>
          </div>
          <div class=\"ficheProduit\">
            <h2>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "titre"), "html", null, true);
            echo "</h2>
            ";
            // line 48
            if ($this->getAttribute($this->getContext($context, "produit"), "favori")) {
                // line 49
                echo "            <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/shopping/coup2coeurShopping.png"), "html", null, true);
                echo "\" class=\"coupDeCoeur\" />
            ";
            }
            // line 51
            echo "            ";
            if ((!(null === $this->getAttribute($this->getContext($context, "produit"), "citation")))) {
                // line 52
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getAttribute($this->getContext($context, "produit"), "citation")), "html", null, true);
                echo "\">
            <img src=\"";
                // line 53
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/shopping/citationArticle.png"), "html", null, true);
                echo "\" class=\"coupDeCoeur\" />
            </a>
            ";
            }
            // line 56
            echo "            <div class=\"produitAbstract\">";
            echo $this->getAttribute($this->getContext($context, "produit"), "abstract");
            echo "</div>
            <h3>L’avis de TDN</h3>
            <div class=\"produitAvis\">";
            // line 58
            echo $this->getAttribute($this->getContext($context, "produit"), "critique");
            echo "</div>
            <p class=\"produitPrix\"><span class=\"standardEtiquette\">Prix&nbsp;</span>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "prix"), "html", null, true);
            echo "&nbsp;€</p>
            <p class=\"produitPrix\">
              <span class=\"standardEtiquette\">Marque&nbsp;</span>
              <a href=\"";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "url"), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "produit"), "marque"), "html", null, true);
            echo "</a>
            </p>
          </div>
         </div>
         ";
            // line 66
            $context["i"] = ($this->getContext($context, "i") + 1);
            // line 67
            echo "         ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['produit'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 68
        echo "
         ";
        // line 69
        $context["i"] = 1;
        // line 70
        echo "         <nav id=\"paginationSelectionShopping\">
            <button id=\"boutonSelectionPrecedent\" class=\"boutonPrecedent\"></button>
            ";
        // line 72
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "selection"), "setProduit"))));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 73
            echo "            <a href=\"#selection_";
            echo twig_escape_filter($this->env, $this->getContext($context, "i"), "html", null, true);
            echo "\" class=\"boutonDiapo ";
            if (($this->getContext($context, "i") == 1)) {
                echo "boutonActif";
            } else {
                echo "boutonInactif";
            }
            echo "\">";
            echo twig_escape_filter($this->env, $this->getContext($context, "i"), "html", null, true);
            echo "</a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 75
        echo "            <button id=\"boutonSelectionSuivant\" class=\"boutonSuivant\"></button>
         </nav>
      </div>

      <!-- Bloc pour les boutons sociaux -->
      ";
        // line 80
        $this->env->loadTemplate("DocumentBundle:Bloc:socialTDNLinks.html.twig")->display(array_merge($context, array("id" => $this->getAttribute($this->getContext($context, "selection"), "idDocument"), "likes" => $this->getAttribute($this->getContext($context, "selection"), "likes"))));
        // line 81
        echo "
      <!-- Bloc pour les commentaires -->
      ";
        // line 83
        echo $this->env->getExtension('actions')->renderAction("CommentaireBundle:Public:flux", array("id" => $this->getAttribute($this->getContext($context, "selection"), "idDocument")), array());
        // line 84
        echo "  </section>

  <!-- Publications en rapport avec ce sujet -->
  ";
        // line 87
        if ((array_key_exists("similaires", $context) && (!twig_test_empty($this->getContext($context, "similaires"))))) {
            // line 88
            echo "  <section id=\"more\">
    ";
            // line 89
            $this->env->loadTemplate("DocumentBundle:Bloc:documentsSimilaires.html.twig")->display(array_merge($context, array("similaires" => $this->getContext($context, "similaires"), "type" => "Article")));
            // line 90
            echo "  </section>
  ";
        }
        // line 92
        echo "</article>
  <script type=\"text/javascript\">
    \$(document).ready(function () {
      var diapoActive = 1;
      var nbDiapos = ";
        // line 96
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "selection"), "setProduit")), "html", null, true);
        echo ";
      \$(\".boutonDiapo\").click(function (e) {
        e.preventDefault();
        target = \$(this).prop('href').split('_');
        diapoActive = target[1];
        diapoID = '#selection_'+diapoActive;
        \$('.diapoActive').toggleClass('diapoActive diapoMasquee');
        \$(diapoID).toggleClass('diapoActive diapoMasquee');
        \$('.boutonActif').toggleClass('boutonActif boutonInactif');
        \$(this).toggleClass('boutonActif boutonInactif');
      });
      \$(\"#boutonSelectionPrecedent\").click(function (e) {
        diapoActive -= 1;
        if (diapoActive < 1) { diapoActive = nbDiapos };
        diapoID = '#selection_'+diapoActive;
        \$('.diapoActive').toggleClass('diapoActive diapoMasquee');
        \$(diapoID).toggleClass('diapoActive diapoMasquee');
        \$('.boutonActif').toggleClass('boutonActif boutonInactif');
        \$('a[href=\"'+diapoID+'\"]').toggleClass('boutonActif boutonInactif');
      });
      \$(\"#boutonSelectionSuivant\").click(function (e) {
        diapoActive += 1;
        if (diapoActive > nbDiapos) { diapoActive = 1 };
        diapoID = '#selection_'+diapoActive;
        \$('.diapoActive').toggleClass('diapoActive diapoMasquee');
        \$(diapoID).toggleClass('diapoActive diapoMasquee');
        \$('.boutonActif').toggleClass('boutonActif boutonInactif');
        \$('a[href=\"'+diapoID+'\"]').toggleClass('boutonActif boutonInactif');
      })

    })
  </script>
<script type=\"text/javascript\">
\$(document).ready( function () {
    window._ttf = window._ttf || [];
    _ttf.push({
      format:     'inpicture'
      ,pid:     22267
      ,bgColor :    '#FFFFFF'
      ,slot:      '#corps'
      ,AdBreaks:    ['%3']
      ,vast: 'http://ad4.liverail.com/?LR_ADMAP=in::0&LR_VIDEO_POSITION=0&LR_SCHEMA=vast2&LR_AUTOPLAY=0&LR_PUBLISHER_ID=29358&LR_VERTICALS=trucsdenana_fr_inpicture&LR_TITLE=TrucsDeNana_title&LR_VIDEO_ID=TrucsDeNana_videoID&LR_CONTENT=6&LR_PARTNERS=&LR_CATEGORIES=1900&CACHEBUSTER='+(+new Date())
      ,handlers:    {
        change: ['#paginationSelectionShopping a', '#paginationSelectionShopping button']
      }
    });
    (function(d){
      var js, s = d.getElementsByTagName('script')[0];
      js = d.createElement('script'); js.async = true;
      js.src = \"http://cdn.teads.tv/js/all-v1.js\";
      s.parentNode.insertBefore(js, s);
    })(window.document);
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Default:shopping.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 96,  267 => 92,  263 => 90,  261 => 89,  258 => 88,  256 => 87,  251 => 84,  249 => 83,  245 => 81,  243 => 80,  236 => 75,  219 => 73,  215 => 72,  211 => 70,  209 => 69,  206 => 68,  200 => 67,  198 => 66,  189 => 62,  183 => 59,  179 => 58,  173 => 56,  167 => 53,  162 => 52,  159 => 51,  153 => 49,  151 => 48,  147 => 47,  140 => 43,  127 => 40,  122 => 39,  120 => 38,  114 => 35,  109 => 33,  102 => 28,  89 => 27,  82 => 23,  66 => 22,  52 => 11,  49 => 10,  46 => 9,  39 => 6,  36 => 5,  30 => 3,);
    }
}
