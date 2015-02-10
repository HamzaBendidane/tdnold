<?php

/* CauseuseBundle:Page:questionNanas.html.twig */
class __TwigTemplate_d62fffb3e4b8fa9444a1495e79747edb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Default:TDNDocument.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'local_header_scripts' => array($this, 'block_local_header_scripts'),
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
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "question"), "titre") . " | Question de nanas ") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "question"), "rubriques"), 0, array(), "array"), "titre")), "html", null, true);
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/aloha/css/aloha.css"), "html", null, true);
        echo "\" type=\"text/css\">
<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/form.css"), "html", null, true);
        echo "\" type=\"text/css\">
<link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/question-nanas.css"), "html", null, true);
        echo "\" type=\"text/css\">
<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/conseil.css"), "html", null, true);
        echo "\" type=\"text/css\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/commentaire.css"), "html", null, true);
        echo "\" type=\"text/css\">
";
    }

    // line 13
    public function block_local_header_scripts($context, array $blocks = array())
    {
        // line 14
        echo "<script>
  Aloha = window.Aloha || {};
  Aloha.settings = Aloha.settings || {};
  // Restore the global \$ and jQuery variables of your project's jQuery
  Aloha.settings.jQuery = window.jQuery;
</script>
<script src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/aloha/lib/require.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/js/aloha/lib/aloha.js"), "html", null, true);
        echo "\" data-aloha-plugins=\"common/ui,common/format,common/highlighteditables,common/link,common/list,common/table\"></script>
";
    }

    // line 25
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 26
        echo "<div class=\"postit-contenu\">
  <a href= \"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_sommaire"), "html", null, true);
        echo "\">
   <img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/questions-nanas_titre.png"), "html", null, true);
        echo "\" />
  </a>
</div>

<article id=\"article-wrapper\" class=\"main question-de-nana\">

  <!-- Contenu de l'article -->
  <section class=\"contenu main-section\">

    <!-- Bloc pour l'affichage des métadonnées de l'article -->
    <div id=\"metadata\" class=\"metadata\">
     <p class=\"auteur\">
      <span class=\"standardEtiquette\">Question posée le  </span>   
      <span class=\"date-publication\">";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('age_extension')->lapsFilter($this->getAttribute($this->getContext($context, "question"), "datePublication")), "html", null, true);
        echo "</span>
    </p>
     <p class=\"liste-rubriques\">
      <span class=\"standardEtiquette\">Rubrique :</span> 
      ";
        // line 45
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "question"), "rubriques"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            // line 46
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_sommaire", array("slug" => $this->getAttribute($this->getContext($context, "r"), "slug"))), "html", null, true);
            echo "\">
          <span class=\"rubrique-";
            // line 47
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
        // line 50
        echo "      </span>
     </p>
  </div>

  <!-- Bloc pour l'affichage du contenu de l'article -->
  <div id=\"corps\" class=\"corps\">
    <h1 class=\"titre-document titre-";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getAttribute($this->getContext($context, "question"), "rubriques"), 0, array(), "array")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "question"), "titre"), "html", null, true);
        echo "</h1>
    <div id=\"question\">
      <div class=\"col-1\">
        <img src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "question"), "lnAuteur")), "html", null, true);
        echo "\" class=\"\" alt=\"\" />
        <div class=\"statistiques\">
          <p class=\"reponses\"><span class=\"cardinal\">";
        // line 61
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "question"), "filReponses")), "html", null, true);
        echo "</span> réponses</p>
          <p class=\"votes\"><span class=\"cardinal\">";
        // line 62
        echo twig_escape_filter($this->env, $this->getContext($context, "totalVotes"), "html", null, true);
        echo "</span> votes</p>
        </div>
      </div>
      <div class=\"col-2\">
        <p class=\"auteur-question\"><span class=\"standardEtiquette\">Question de :</span> <span class=\"pseudo\">";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "username"), "html", null, true);
        echo "</span></p>
        <p class=\"auteur-age\"><span class=\"standardEtiquette\">Statut :</span> ";
        // line 67
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "roles"));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "role"), "name"), "html", null, true);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "<span class=\"standardEtiquette\">Age : </span> ";
        echo twig_escape_filter($this->env, $this->getContext($context, "ageAuteur"), "html", null, true);
        echo " ans</p>
        <div class=\"question\">";
        // line 68
        echo $this->getAttribute($this->getContext($context, "question"), "question");
        echo "</div>
        ";
        // line 69
        if ((!(null === $this->getAttribute($this->getContext($context, "question"), "lnIllustration")))) {
            // line 70
            echo "        ";
            $context["Y"] = twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnIllustration"), "datePublication"), "Y");
            // line 71
            echo "        ";
            $context["m"] = twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnIllustration"), "datePublication"), "m");
            // line 72
            echo "        ";
            $context["source"] = ((((((("/uploads/documents/public/" . $this->getContext($context, "Y")) . "/") . $this->getContext($context, "m")) . "/n_/") . $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "idNana")) . "/") . $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnIllustration"), "fichier"));
            // line 73
            echo "        <a class=\"popin\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "source"), "html", null, true);
            echo "\">
          <img class=\"vignette-causeuse\" src=\"";
            // line 74
            echo twig_escape_filter($this->env, $this->getContext($context, "source"), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnIllustration"), "alt"), "html", null, true);
            echo "\" />
        </a>
        ";
        }
        // line 76
        echo " 
      </div>
    </div>
  </div>

  <!-- Formulaire pour la réponse -->
  <div id=\"avis\" style=\"margin-top:20px\">
    <h2 class=\"titreFormContribution\">Ose, donne ton avis !</h2>
    ";
        // line 84
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 85
            echo "    <form name=\"form-reponse-de-nana\" id=\"form-reponse-de-nana\" class=\"formUser form-reponse-de-nana constraintFile\" method=\"post\" action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_postReponse"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "formReponse"), 'enctype');
            echo " class=\"table-content\">
      <figure class=\"avatar\">
        <img src=\"";
            // line 87
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "app"), "user")), "html", null, true);
            echo "\" alt=\"Avatar de ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "username"), "html", null, true);
            echo "\" />
      </figure>
      <fieldset class=\"no-border\">
        <input type=\"hidden\" name='idQuestion' id=\"idQuestion\" value=\"";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "question"), "idDocument"), "html", null, true);
            echo "\" />
        <a href=\"";
            // line 91
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_contact", array("type" => "ABUS")), "html", null, true);
            echo "\" class=\"abuse-warning\">Signaler un abus à la rédaction</a>
        ";
            // line 92
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formReponse"), "reponse"), 'widget', array("attr" => array("class" => "texteContribution")));
            echo "
        ";
            // line 93
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formReponse"), "lnIllustration"), 'row');
            echo "
        ";
            // line 94
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formReponse"), "_token"), 'row');
            echo "

        <input type=\"submit\" name=\"envoyer\" id=\"envoyer\" value=\"Publie ta réponse\"  style=\"float:right; margin-top:10px; margin-right:20px\"/> 
      </fieldset>

    </form>
    ";
        } else {
            // line 101
            echo "    <p>Connecte-toi ou inscris-toi pour échanger sur TDN</p>
    ";
        }
        // line 102
        echo "\t\t
  </div>

  <!-- Les réponses -->
  ";
        // line 106
        if (($this->getContext($context, "nbReponses") == 0)) {
            // line 107
            echo "  <p class=\"warning\">Aucune réponse à cette question pour le moment</p>
  ";
        } else {
            // line 109
            echo "  ";
            $context["a"] = 0;
            // line 110
            echo "  ";
            if ($this->getAttribute($this->getContext($context, "question"), "reponseAcceptee")) {
                // line 111
                echo "  ";
                $context["a"] = 1;
                // line 112
                echo "  ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "question"), "filReponses"));
                foreach ($context['_seq'] as $context["_key"] => $context["rep"]) {
                    // line 113
                    echo "  ";
                    if (($this->getAttribute($this->getContext($context, "question"), "reponseAcceptee") == $this->getAttribute($this->getContext($context, "rep"), "idDocument"))) {
                        // line 114
                        echo "  <h2 style=\"margin-left:10px; color:#488C8C\">La réponse préférée</h2>
  <div id=\"reponse\">
    <div style=\"display:table\">
      <div class=\"col-1\">
        <a href=\"";
                        // line 118
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"))), "html", null, true);
                        echo "\">
          <img src=\"";
                        // line 119
                        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "rep"), "lnAuteur")), "html", null, true);
                        echo "\" />
        </a>
      </div>
      <div class=\"col-2\">
        ";
                        // line 123
                        $context["classePopularite"] = 0;
                        // line 124
                        echo "        <p class=\"bandeau-nana\">
          ";
                        // line 125
                        echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "popularite"));
                        echo "
          <span class=\"auteur-reponse\">";
                        // line 126
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "username"), "html", null, true);
                        echo "</span>
          <span class=\"publication-reponse\">";
                        // line 127
                        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "rep"), "datePublication"), "d/m/y H:i"), "html", null, true);
                        echo "</span>
        </p>
        <div class=\"texte-reponse\">
          ";
                        // line 130
                        echo $this->getAttribute($this->getContext($context, "rep"), "reponse");
                        echo "
        </div>
      </div>
      <div class=\"col-3\">
        <p class=\"approuve\">
          <a href=\"";
                        // line 135
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_voteReponse", array("id" => $this->getAttribute($this->getContext($context, "rep"), "idDocument"))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "rep"), "likes"), "html", null, true);
                        echo " vote";
                        if (($this->getAttribute($this->getContext($context, "rep"), "likes") > 1)) {
                            echo "s";
                        }
                        echo "</a>
        </p>
      </div>
    </div>
    ";
                        // line 139
                        if ((!(null === $this->getAttribute($this->getContext($context, "rep"), "lnIllustration")))) {
                            // line 140
                            echo "    <figure class=\"icone-reponse\">
      <a href=\"";
                            // line 141
                            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "rep"), null, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana")), "html", null, true);
                            echo "\" class='popin'>
       <img src=\"";
                            // line 142
                            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "rep"), "SQUARE", $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana")), "html", null, true);
                            echo "\" style=\"width:80px\" alt=\"Avatar de ";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"), "html", null, true);
                            echo "\" title=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"), "html", null, true);
                            echo "\" />
     </a>
     <figcaption></figcaption>
   </figure>
   ";
                        }
                        // line 147
                        echo " </div>      
 ";
                    }
                    // line 149
                    echo " ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rep'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 150
                echo " ";
            }
            // line 151
            echo "
 <h2 style=\"margin-left:10px; color:#488C8C\">Réponses de nanas (";
            // line 152
            echo twig_escape_filter($this->env, ($this->getContext($context, "nbReponses") - $this->getContext($context, "a")), "html", null, true);
            echo ")</h2>
 ";
            // line 153
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "question"), "filReponses"));
            foreach ($context['_seq'] as $context["_key"] => $context["rep"]) {
                // line 154
                echo " ";
                if (($this->getAttribute($this->getContext($context, "question"), "reponseAcceptee") != $this->getAttribute($this->getContext($context, "rep"), "idDocument"))) {
                    // line 155
                    echo " <div id=\"reponse\">
  <div style=\"display:table\">
    <div class=\"col-1\">
     <a href=\"";
                    // line 158
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"))), "html", null, true);
                    echo "\">
      <img src=\"";
                    // line 159
                    echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getAttribute($this->getContext($context, "rep"), "lnAuteur")), "html", null, true);
                    echo "\" />
    </a>
  </div>

  <div class=\"col-2\">
    ";
                    // line 164
                    $context["classePopularite"] = 0;
                    // line 165
                    echo "    <p class=\"bandeau-nana\">
      ";
                    // line 166
                    echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "popularite"));
                    echo "
      <span class=\"auteur-reponse\">";
                    // line 167
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "username"), "html", null, true);
                    echo "</span>
      <span class=\"publication-reponse\">";
                    // line 168
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "rep"), "datePublication"), "d/m/y H:i"), "html", null, true);
                    echo "</span>
    </p>
    <div class=\"texte-reponse\">
      ";
                    // line 171
                    echo $this->getAttribute($this->getContext($context, "rep"), "reponse");
                    echo "
    </div>
    ";
                    // line 173
                    if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
                        // line 174
                        echo "    ";
                        if (((null === $this->getAttribute($this->getContext($context, "question"), "reponseAcceptee")) && ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "idNana") == $this->getAttribute($this->getAttribute($this->getContext($context, "question"), "lnAuteur"), "idNana")))) {
                            // line 175
                            echo "    <p class=\"choixMeilleureReponse\">
      <a class=\"lien-mince\" href=\"";
                            // line 176
                            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_accepteReponse", array("idQuestion" => $this->getAttribute($this->getContext($context, "question"), "idDocument"), "idReponse" => $this->getAttribute($this->getContext($context, "rep"), "idDocument"))), "html", null, true);
                            echo "\">C'est ma réponse préférée</a>
    </p>
    ";
                        }
                        // line 179
                        echo "    ";
                    }
                    // line 180
                    echo "  </div>

  <div class=\"col-3\">
    <p class=\"approuve\">
      <a href=\"";
                    // line 184
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("CauseuseBundle_voteReponse", array("id" => $this->getAttribute($this->getContext($context, "rep"), "idDocument"))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "rep"), "likes"), "html", null, true);
                    echo " vote";
                    if (($this->getAttribute($this->getContext($context, "rep"), "likes") > 1)) {
                        echo "s";
                    }
                    echo "</a>
    </p>
    ";
                    // line 186
                    if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
                        // line 187
                        echo "    <p class=\"lien-admin\">
      <a class=\"actionValidation\" href=\"";
                        // line 188
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Causeuse_reponseSupprimer", array("id" => $this->getAttribute($this->getContext($context, "rep"), "idDocument"))), "html", null, true);
                        echo "\">Supprimer</a>
    </p>
    ";
                    }
                    // line 191
                    echo "  </div>
</div>
";
                    // line 193
                    if ((!(null === $this->getAttribute($this->getContext($context, "rep"), "lnIllustration")))) {
                        // line 194
                        echo "<figure class=\"icone-reponse\">
  <a href=\"";
                        // line 195
                        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "rep"), null, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana")), "html", null, true);
                        echo "\" class='popin'>
       <img src=\"";
                        // line 196
                        echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->illustrationFunction($this->getContext($context, "rep"), "SQUARE", $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana")), "html", null, true);
                        echo "\" style=\"width:80px\" alt=\"Avatar de ";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"), "html", null, true);
                        echo "\" title=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "rep"), "lnAuteur"), "idNana"), "html", null, true);
                        echo "\" />
  </a>
  <figcaption></figcaption>
</figure>
";
                    }
                    // line 201
                    echo "</div>
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['rep'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        }
        // line 205
        echo "       <!-- Bloc pour les boutons sociaux -->
      ";
        // line 206
        $this->env->loadTemplate("DocumentBundle:Bloc:socialTDNLinks.html.twig")->display(array_merge($context, array("id" => $this->getAttribute($this->getContext($context, "question"), "idDocument"), "likes" => $this->getAttribute($this->getContext($context, "question"), "likes"))));
        // line 207
        echo "
</section>

  <!-- Publications en rapport avec ce sujet -->
  ";
        // line 211
        if ((array_key_exists("similaires", $context) && (!twig_test_empty($this->getContext($context, "similaires"))))) {
            // line 212
            echo "  <section id=\"more\">
    ";
            // line 213
            $this->env->loadTemplate("DocumentBundle:Bloc:documentsSimilaires.html.twig")->display(array_merge($context, array("similaires" => $this->getContext($context, "similaires"), "type" => "Article")));
            // line 214
            echo "  </section>
  ";
        }
        // line 216
        echo "
</article>
<script type=\"text/javascript\">
  Aloha.ready( function() {
    Aloha.jQuery('#source-reponse').aloha();
});
\$(document).ready(function () {
  \$(\"#source-reponse\").blur(function () {
  \$(\"#tdn3_causeuse_reponse_reponse\").html(\$(\"#source-reponse\").html());
  \$(\".actionValidation\").click(function() {
    return confirmeDelete(\"Voulez-vous vraiment exécuter cette action ?\")
  })
});
})
</script>
<script type=\"text/javascript\">

  \$(document).ready(function () {
    \$(\".constraintFile\").submit(function(event) {
      var obj = \$(this).find('[type=\"file\"]');
      var fichier = obj['0'].files[0];
      console.log(fichier);
      if (fichier.size > 2*1024*1024) {
        event.preventDefault();
        alert(\"Ton image est trop volumineuse\");
      } else {
        var mimeType = fichier.type;
        var types = mimeType.match(/(\\w+)\\/(\\w+)/);
        console.log(types);
        if (types[1] !== 'image') {
          event.preventDefault();
          alert('Ce fichier n’est pas une image');
        } else if (['png','gif','jpeg','jpg','svg'].indexOf(types[2]) === -1) {
          event.preventDefault();
          alert('Ce fichier n’est pas un dans un format lisible : '+types[2]);
        }
      }
    });

  });
</script>

";
    }

    public function getTemplateName()
    {
        return "CauseuseBundle:Page:questionNanas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  548 => 216,  544 => 214,  542 => 213,  539 => 212,  537 => 211,  531 => 207,  529 => 206,  526 => 205,  517 => 201,  505 => 196,  501 => 195,  498 => 194,  496 => 193,  492 => 191,  486 => 188,  483 => 187,  481 => 186,  470 => 184,  464 => 180,  461 => 179,  455 => 176,  452 => 175,  449 => 174,  447 => 173,  442 => 171,  436 => 168,  432 => 167,  428 => 166,  425 => 165,  423 => 164,  415 => 159,  411 => 158,  406 => 155,  403 => 154,  399 => 153,  395 => 152,  392 => 151,  389 => 150,  383 => 149,  379 => 147,  367 => 142,  363 => 141,  360 => 140,  358 => 139,  345 => 135,  337 => 130,  331 => 127,  327 => 126,  323 => 125,  320 => 124,  318 => 123,  311 => 119,  307 => 118,  301 => 114,  298 => 113,  293 => 112,  290 => 111,  287 => 110,  284 => 109,  280 => 107,  278 => 106,  272 => 102,  268 => 101,  258 => 94,  254 => 93,  250 => 92,  246 => 91,  242 => 90,  234 => 87,  226 => 85,  224 => 84,  214 => 76,  206 => 74,  201 => 73,  198 => 72,  195 => 71,  192 => 70,  190 => 69,  186 => 68,  173 => 67,  169 => 66,  162 => 62,  158 => 61,  153 => 59,  145 => 56,  137 => 50,  126 => 47,  121 => 46,  117 => 45,  110 => 41,  94 => 28,  90 => 27,  87 => 26,  84 => 25,  78 => 21,  74 => 20,  66 => 14,  63 => 13,  57 => 10,  53 => 9,  49 => 8,  45 => 7,  40 => 6,  37 => 5,  31 => 3,);
    }
}
