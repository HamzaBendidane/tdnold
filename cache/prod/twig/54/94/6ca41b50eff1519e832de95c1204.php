<?php

/* RedactionBundle:Default:article.html.twig */
class __TwigTemplate_54946ca41b50eff1519e832de95c1204 extends Twig_Template
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
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "article"), "titre") . " | Article ") . $this->getContext($context, "titreRubrique")), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/articles-redac_titre_299x80.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"article-wrapper\" class=\"main article-redaction\">

  <!-- Contenu de l'article -->
   <section class=\"contenu main-section\">

      <!-- Bloc pour l'affichage des métadonnées de l'article -->
      <div id=\"metadata\" class=\"metadata\">
         <p class=\"auteur\">
           <span class=\"standardEtiquette\">Ecrit par </span> 
            <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnAuteur"), "idNana"))), "html", null, true);
        echo "\" class=\"nom-auteur\">";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnAuteur"), "prenom") . " ") . $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnAuteur"), "nom")), "html", null, true);
        echo " ";
        echo "</a>,<span class=\"standardEtiquette\">le </span>  
            <span class=\"date-publication\">";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "article"), "datePublication"), "d/m/Y"), "html", null, true);
        echo "</span>
         </p>
         <p>
          <span class=\"standardEtiquette\">Rubrique :</span>
          ";
        // line 27
        if ((!(null === $this->getAttribute($this->getContext($context, "article"), "lnThematique")))) {
            // line 28
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnThematique"), "slug"))), "html", null, true);
            echo "\">
              <span class=\"rubrique-";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "article"), "lnThematique")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnThematique"), "titre"), "html", null, true);
            echo "
            </a>
          ";
        }
        // line 32
        echo "          ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "article"), "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 33
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getAttribute($this->getContext($context, "r"), "slug"))), "html", null, true);
            echo "\">
              <span class=\"rubrique-";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "r")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "titre"), "html", null, true);
            echo "
            </a>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 37
        echo "          </span>
         </p>
      </div>

      <!-- Bloc pour l'affichage du contenu de l'article -->
      <div id=\"corps\" class=\"corps\">
         <h1 class=\"titre-document titre-";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "rubriquePrincipale")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "article"), "titre"), "html", null, true);
        echo "</h1>
          ";
        // line 44
        if ((!(null === $this->getAttribute($this->getContext($context, "article"), "lnIllustration")))) {
            // line 45
            echo "            <img class=\"legacyIllustration\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "article"), "SQUARE"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "article"), "lnIllustration"), "alt"), "html", null, true);
            echo "\" />
          ";
        }
        // line 47
        echo "         <div class=\"chapo\">";
        echo $this->getAttribute($this->getContext($context, "article"), "abstract");
        echo "</div>
         <div class=\"rawTexte\">
            ";
        // line 49
        echo $this->getAttribute($this->getContext($context, "article"), "corps");
        echo "
            ";
        // line 50
        if (($this->getAttribute($this->getContext($context, "article"), "sponsor") == 1)) {
            // line 51
            echo "            <p class=\"sponsorise\">Article sponsorisé</p>
            ";
        }
        // line 53
        echo "          </div>
         ";
        // line 54
        if ((!twig_test_empty($this->getAttribute($this->getContext($context, "article"), "filTags")))) {
            // line 55
            echo "         <div class=\"tags\">
           <ul class=\"tagBag\">
           ";
            // line 57
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "article"), "filTags"));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 58
                echo "            <li class=\"tag\">
              <a href=\"/recherche/";
                // line 59
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "tag"), "expression"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "tag"), "expression"), "html", null, true);
                echo "</a>
            </li>
           ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 62
            echo "           </ul>
         </div>
         ";
        } else {
            // line 65
            echo "         <div class=\"tags\">";
            echo $this->env->getExtension('document_extension')->tagsFilter($this->getAttribute($this->getContext($context, "article"), "tags"));
            echo "</div>
         ";
        }
        // line 67
        echo "      </div>

       <!-- Bloc pour les boutons sociaux -->
      ";
        // line 70
        $this->env->loadTemplate("DocumentBundle:Bloc:socialTDNLinks.html.twig")->display(array_merge($context, array("id" => $this->getAttribute($this->getContext($context, "article"), "idDocument"), "likes" => $this->getAttribute($this->getContext($context, "article"), "likes"))));
        // line 71
        echo "
       <!-- Mediabong -->
      <div id=\"mb_container\"></div>
      <div id=\"mb_video_sponso\"></div>
      <script type=\"text/javascript\">
          (function(){
                  var sc = document.createElement('script');
                  sc.src = 'http://player.mediabong.com/se/793.js?url='+encodeURIComponent(document.location.href);
                  sc.type = 'text/javascript';
                  sc.async = true;
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sc, s);
          })();
      </script>

      <!-- Bloc pour les commentaires -->
      ";
        // line 86
        echo $this->env->getExtension('actions')->renderAction("CommentaireBundle:Public:flux", array("id" => $this->getAttribute($this->getContext($context, "article"), "idDocument")), array());
        // line 87
        echo "  </section>

  <!-- Publications en rapport avec ce sujet -->
  ";
        // line 90
        if ((array_key_exists("similaires", $context) && (!twig_test_empty($this->getContext($context, "similaires"))))) {
            // line 91
            echo "  <section id=\"more\">
    ";
            // line 92
            $this->env->loadTemplate("DocumentBundle:Bloc:documentsSimilaires.html.twig")->display(array_merge($context, array("similaires" => $this->getContext($context, "similaires"), "type" => "Article")));
            // line 93
            echo "  </section>
  ";
        }
        // line 95
        echo "
</article>
<script type=\"text/javascript\">
  \$(document).ready(function() {
    console.log('Traitement des URL images');
    \$('#article-wrapper img').each(function() {
      var source = \$(this).attr('src');
      var radix = source.substr(0,7);
      if (radix == '/photos') {
        \$(this).attr('src', 'http://www.trucsdenana.com'+source);
      }
    })
  })
</script>
";
    }

    public function getTemplateName()
    {
        return "RedactionBundle:Default:article.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  236 => 95,  232 => 93,  230 => 92,  227 => 91,  225 => 90,  220 => 87,  218 => 86,  201 => 71,  199 => 70,  194 => 67,  188 => 65,  183 => 62,  172 => 59,  169 => 58,  165 => 57,  161 => 55,  159 => 54,  156 => 53,  152 => 51,  150 => 50,  146 => 49,  140 => 47,  132 => 45,  130 => 44,  124 => 43,  116 => 37,  105 => 34,  100 => 33,  95 => 32,  87 => 29,  82 => 28,  80 => 27,  73 => 23,  66 => 22,  52 => 11,  49 => 10,  46 => 9,  39 => 6,  36 => 5,  30 => 3,);
    }
}
