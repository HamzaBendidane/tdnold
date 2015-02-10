<?php

/* ConseilExpertBundle:Page:conseil.html.twig */
class __TwigTemplate_019c9b179d80286d5e25603a47ecacbe extends Twig_Template
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
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "conseil"), "titre") . " | Conseil d’expert ") . $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnThematique"), "titre")), "html", null, true);
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/conseil.css"), "html", null, true);
        echo "\" type=\"text/css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/commentaire.css"), "html", null, true);
        echo "\" type=\"text/css\">
";
    }

    // line 10
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 11
        echo "<div class=\"postit-contenu\">
   <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/conseils-experts_titre_299x80.png"), "html", null, true);
        echo "\" />
</div>

<article id=\"article-wrapper\" class=\"main article-redaction\">

  <!-- Contenu du conseil -->
  <section class=\"contenu main-section\">

    <!-- Bloc pour l'affichage des métadonnées de l'article -->
  
  <div id=\"metadata\" class=\"metadata\">
     <p class=\"auteur\"><span class=\"standardEtiquette\">Question posée le :</span> ";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "conseil"), "datePublication"), "d/m/Y"), "html", null, true);
        echo "
   </p>
      <p class=\"liste-rubriques\">
        <span class=\"standardEtiquette\">Rubrique :</span>
          ";
        // line 27
        if ($this->getContext($context, "istheme")) {
            // line 28
            echo "          <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getAttribute($this->getContext($context, "rubriquePrincipale"), "slug"))), "html", null, true);
            echo "\">
            <span class=\"rubrique-";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getContext($context, "rubriquePrincipale")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "rubriquePrincipale"), "titre"), "html", null, true);
            echo "
          </a>
          ";
        }
        // line 32
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "conseil"), "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 33
            echo "          <a href=\"";
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
        echo "        </span>
    </p>
    </div>

    <!-- Bloc pour l'affichage du contenu de l'article -->
    <div id=\"corps\" class=\"corps\">
      <h1 class=\"titre-document titre-";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "conseil"), "lnThematique")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "conseil"), "titre"), "html", null, true);
        echo "</h1>
      <div class=\"chapo\">
      ";
        // line 45
        echo $this->getAttribute($this->getContext($context, "conseil"), "abstract");
        echo "
      </div>
      <div id=\"question\">
        ";
        // line 48
        $context["auteur"] = $this->getAttribute($this->getContext($context, "conseil"), "lnAuteur");
        // line 49
        echo "        <div class=\"col-1\">
          <a href=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnAuteur"), "idNana"))), "html", null, true);
        echo "\">
            <img src=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "auteur")), "html", null, true);
        echo "\" />
          </a>
        </div>
        <div class=\"col-2\">
          <p class=\"auteur-question\">
            La question de </span> 
            <a href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "auteur"), "idNana"))), "html", null, true);
        echo "\"><span class=\"pseudo\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "auteur"), "username"), "html", null, true);
        echo "</span></a>, ";
        echo twig_escape_filter($this->env, $this->env->getExtension('age_extension')->ageFilter($this->getAttribute($this->getContext($context, "auteur"), "dateNaissance")), "html", null, true);
        echo "
          </p>
          ";
        // line 59
        if ((!(null === $this->getAttribute($this->getContext($context, "conseil"), "lnImage")))) {
            // line 60
            echo "          <div class=\"illustration-conseil\" style=\"margin-top: 20px;max-width:150px;\">
            <a class=\"popin\" href=\"";
            // line 61
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->documentImageFunction($this->getAttribute($this->getContext($context, "conseil"), "lnImage"), null, $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnAuteur"), "idNana")), "html", null, true);
            echo "\" >
              <img class=\"imageNana\" src=\"";
            // line 62
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->documentImageFunction($this->getAttribute($this->getContext($context, "conseil"), "lnImage"), null, $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnAuteur"), "idNana")), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnImage"), "alt"), "html", null, true);
            echo "\" />
            </a>
          </div>
          ";
        } else {
            // line 66
            echo "          ";
        }
        echo "  
          <div class=\"question\">";
        // line 67
        echo $this->getAttribute($this->getContext($context, "conseil"), "question");
        echo "</div>
        </div>
      </div>
      <div id=\"reponse\">
        <div class=\"col-1\">
          <a href=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "idNana"))), "html", null, true);
        echo "\">
            <img src=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "conseil"), "lnExpert")), "html", null, true);
        echo "\" />
          </a>
        </div>
        <div class=\"col-2\">
          <p class=\"bandeau\">La réponse de <a href=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "idNana"))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "userName"), "html", null, true);
        echo "</a>
          ";
        // line 78
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "setExpertises"));
        foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
            // line 79
            echo "          <span class=\"sticker-expertise puce-";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "rubrique"), "slug"), "html", null, true);
            echo "\"></span>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 81
        echo "          </p>
          <div class=\"reponse\">
            ";
        // line 83
        if (twig_in_filter($this->getAttribute($this->getContext($context, "conseil"), "lnIllustration"), (!null))) {
            // line 84
            echo "            <div class=\"illustration-conseil\" style=\"float:right\">
              <a class=\"popin\" href=\"";
            // line 85
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "conseil")), "html", null, true);
            echo "\" >
                <img class=\"imageNana\" src=\"";
            // line 86
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "conseil")), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnIllustration"), "alt"), "html", null, true);
            echo "\" />
              </a>
            </div>
            ";
        }
        // line 90
        echo "          ";
        echo $this->getAttribute($this->getContext($context, "conseil"), "reponse");
        echo "
          </div>
          ";
        // line 92
        if (($this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "biographie") != "")) {
            // line 93
            echo "          <div class=\"biographieExpert\">
            <a href=\"";
            // line 94
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "idNana"))), "html", null, true);
            echo "\">           
              ";
            // line 95
            echo $this->getAttribute($this->getAttribute($this->getContext($context, "conseil"), "lnExpert"), "biographie");
            echo "
            </a>
          </div>
          ";
        }
        // line 99
        echo "        </div>
        ";
        // line 100
        if ((!twig_test_empty($this->getAttribute($this->getContext($context, "conseil"), "filTags")))) {
            // line 101
            echo "         <div class=\"tags\">
           <ul class=\"tagBag\">
           ";
            // line 103
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "conseil"), "filTags"));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 104
                echo "            <li class=\"tag\">
              <a href=\"/recherche/";
                // line 105
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
            // line 108
            echo "           </ul>
         </div>
         ";
        } else {
            // line 111
            echo "         <div class=\"tags\">";
            echo $this->env->getExtension('document_extension')->tagsFilter($this->getAttribute($this->getContext($context, "conseil"), "tags"));
            echo "</div>
         ";
        }
        // line 113
        echo "     </div>
    </div>

    <!-- Bloc pour les boutons sociaux -->
    ";
        // line 117
        $this->env->loadTemplate("DocumentBundle:Bloc:socialTDNLinks.html.twig")->display(array_merge($context, array("id" => $this->getAttribute($this->getContext($context, "conseil"), "idDocument"), "likes" => $this->getAttribute($this->getContext($context, "conseil"), "likes"))));
        // line 118
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
        // line 133
        echo $this->env->getExtension('actions')->renderAction("CommentaireBundle:Public:flux", array("id" => $this->getAttribute($this->getContext($context, "conseil"), "idDocument")), array());
        // line 134
        echo "  </section>


  <!-- Publications en rapport avec ce sujet -->
  ";
        // line 138
        if ((array_key_exists("similaires", $context) && (!twig_test_empty($this->getContext($context, "similaires"))))) {
            // line 139
            echo "  <section id=\"more\">
    ";
            // line 140
            $this->env->loadTemplate("DocumentBundle:Bloc:documentsSimilaires.html.twig")->display(array_merge($context, array("similaires" => $this->getContext($context, "similaires"), "type" => "Article")));
            // line 141
            echo "  </section>
  ";
        }
        // line 143
        echo "  
</article>
";
    }

    public function getTemplateName()
    {
        return "ConseilExpertBundle:Page:conseil.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  348 => 143,  344 => 141,  342 => 140,  339 => 139,  337 => 138,  331 => 134,  329 => 133,  312 => 118,  310 => 117,  304 => 113,  298 => 111,  293 => 108,  282 => 105,  279 => 104,  275 => 103,  271 => 101,  269 => 100,  266 => 99,  259 => 95,  255 => 94,  252 => 93,  250 => 92,  244 => 90,  235 => 86,  231 => 85,  228 => 84,  226 => 83,  222 => 81,  213 => 79,  209 => 78,  203 => 77,  196 => 73,  192 => 72,  184 => 67,  179 => 66,  170 => 62,  166 => 61,  163 => 60,  161 => 59,  152 => 57,  143 => 51,  139 => 50,  136 => 49,  134 => 48,  128 => 45,  121 => 43,  113 => 37,  102 => 34,  97 => 33,  92 => 32,  84 => 29,  79 => 28,  77 => 27,  70 => 23,  56 => 12,  53 => 11,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 3,);
    }
}
