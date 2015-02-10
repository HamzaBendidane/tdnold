<?php

/* DossierRedactionBundle:Page:dossierSommaire.html.twig */
class __TwigTemplate_ef16cce9f5b1444ea012b486510e3470 extends Twig_Template
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
        echo "Sommaire des dossiers de la rédaction ";
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/video.css"), "html", null, true);
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
   <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/dossiers-redac_titre_299x80.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"article-wrapper\">
  <!-- Bloc pour l'affichage de la recherche sommaire -->
  <div id=\"search\">
    <div id=\"moteur\">
      <form name=\"tri-rubrique\" id=\"tri-rubrique\" action=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_sommaire"), "html", null, true);
        echo "\" method=\"get\">
        <span class=\"select\">Trier par&hellip;</span>
        <select name=\"rubrique\" id=\"critere-tri\" class=\"styled\">
          <option value=\"none\" selected=\"selected\">Trier par&hellip;</option>
          <option value=\"tdn\">Toutes</option>
          ";
        // line 23
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 24
            echo "          <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "slug"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "titre"), "html", null, true);
            echo "</option>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 26
        echo "        </select>
      </form>
    </div>
  </div>


  <section id=\"corps\" class=\"table-content\">
  ";
        // line 34
        echo "  <div id=\"more\">
    <h1><span class=\"hot-number\">";
        // line 35
        echo twig_escape_filter($this->env, $this->getContext($context, "totalDossiers"), "html", null, true);
        echo "</span> <strong>dossiers </strong> / Rubrique : ";
        echo twig_escape_filter($this->env, $this->getContext($context, "nomRubrique"), "html", null, true);
        echo "</h1>
    ";
        // line 36
        if ((!twig_test_empty($this->getContext($context, "dossiersRecents")))) {
            // line 37
            echo "    <div id=\"dossiers-recents\">
      ";
            // line 38
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "dossiersRecents"));
            foreach ($context['_seq'] as $context["_key"] => $context["d"]) {
                // line 39
                echo "      <div class=\"snapshot-wrapper\">
        <div class=\"snapshot\">
          <div class=\"vignette-video-wrapper\">
            <div class=\"vignette-video cornered-";
                // line 42
                echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getAttribute($this->getContext($context, "d"), "rubriques"), 0, array(), "array")), "html", null, true);
                echo "\">
            <a href=\"";
                // line 43
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_dossier", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "d"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "d"), "slug"), "id" => $this->getAttribute($this->getContext($context, "d"), "idDocument"))), "html", null, true);
                echo "\">
              <img class=\"snapshot\" src=\"";
                // line 44
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "d")), "html", null, true);
                echo "\" class=\"\" />
            </a>
            </div>
          </div>
          <p class=\"titre\">";
                // line 48
                echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getContext($context, "d"), "titre"), 0, 240), "html", null, true);
                echo "</p>
          <p class=\"credits\">";
                // line 49
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "d"), "datePublication"), "d/m/Y"), "html", null, true);
                echo "</p>
        </div>
      </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['d'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 53
            echo "    </div>
    ";
        }
        // line 55
        echo "      ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "listeDossiers"));
        foreach ($context['_seq'] as $context["_key"] => $context["contenu"]) {
            // line 56
            echo "      <div class=\"noheight-snapshot-wrapper\">
        <div class=\"snapshot\">
          <div class=\"vignette-liste-wrapper\">
            <div class=\"cornered-";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getAttribute($this->getContext($context, "contenu"), "rubriques"), 0, array(), "array")), "html", null, true);
            echo "\">
            <a href=\"";
            // line 60
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_dossier", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "contenu"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "contenu"), "slug"), "id" => $this->getAttribute($this->getContext($context, "contenu"), "idDocument"))), "html", null, true);
            echo "\">
              <img class=\"snapshot-image\" src=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "contenu")), "html", null, true);
            echo "\" class=\"\" />
            </a>
            </div>
          </div>
          <p class=\"titre\">
            <a href=\"";
            // line 66
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_dossier", array("rubrique" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "contenu"), "rubriques"), 0, array(), "array"), "slug"), "slug" => $this->getAttribute($this->getContext($context, "contenu"), "slug"), "id" => $this->getAttribute($this->getContext($context, "contenu"), "idDocument"))), "html", null, true);
            echo "\"> 
              ";
            // line 67
            echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getContext($context, "contenu"), "titre"), 0, 240), "html", null, true);
            echo "
            </a>
          </p>
        </div>
      </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contenu'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 73
        echo "      ";
        if (($this->getContext($context, "derniere") > 1)) {
            // line 74
            echo "      <form name=\"pager\" id=\"pagerForm\" action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DossierRedaction_sommaire"), "html", null, true);
            echo "\" method=\"get\">
         Page : <input type=\"text\" name=\"page\" id=\"page\" size=\"2\" style=\"border: 0; color: #000; font-weight: bold;\" /> <span class=\"totalSlides\">(sur ";
            // line 75
            echo twig_escape_filter($this->env, $this->getContext($context, "derniere"), "html", null, true);
            echo ")</span>
        <div id=\"pageSlider\" style=\"display:inline-block;width:160px;position:relative;top:3px\"></div>
      </form>
      <script>
        \$(document).ready(function() {
          \$( \"#pageSlider\" ).slider({
            value:";
            // line 81
            echo twig_escape_filter($this->env, $this->getContext($context, "page"), "html", null, true);
            echo ",
            min: 1,
            max: ";
            // line 83
            echo twig_escape_filter($this->env, $this->getContext($context, "derniere"), "html", null, true);
            echo ",
            step: 1,
            slide: function(event, ui) {
              \$(\"#page\").val(ui.value );
            },
            stop: function(event, ui) {
              \$(\"#page\").val(ui.value );
              \$(\"#pagerForm\").submit();
            }
          });
          \$( \"#page\" ).val(\$( \"#pageSlider\" ).slider( \"value\" ) );
        });
      </script>
      ";
        }
        // line 97
        echo "  </div>
  ";
        // line 99
        echo "  
</article>
<script type=\"text/javascript\">
  \$(document).ready(function () {
    \$('#critere-tri').on('change', function () {
      \$(this).parents('form#tri-video').submit();
    })
  })
</script>
";
    }

    public function getTemplateName()
    {
        return "DossierRedactionBundle:Page:dossierSommaire.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  237 => 99,  234 => 97,  217 => 83,  212 => 81,  203 => 75,  198 => 74,  195 => 73,  183 => 67,  179 => 66,  171 => 61,  167 => 60,  163 => 59,  158 => 56,  153 => 55,  149 => 53,  139 => 49,  135 => 48,  128 => 44,  124 => 43,  120 => 42,  115 => 39,  111 => 38,  108 => 37,  106 => 36,  100 => 35,  97 => 34,  88 => 26,  77 => 24,  73 => 23,  65 => 18,  56 => 12,  53 => 11,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 3,);
    }
}
