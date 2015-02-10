<?php

/* NanaBundle:Public:completeProfil.html.twig */
class __TwigTemplate_afe3d39b7b925d3be7684f0910afc128 extends Twig_Template
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
        echo twig_escape_filter($this->env, ("Profil de " . $this->getAttribute($this->getContext($context, "me"), "username")), "html", null, true);
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/css/profil.css"), "html", null, true);
        echo "\" type=\"text/css\">
";
    }

    // line 9
    public function block_local_header_scripts($context, array $blocks = array())
    {
    }

    // line 12
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 13
        echo "<div class=\"postit-contenu\">
   <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/profil-nana_titre_299x70.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"document-wrapper\" class=\"main article-redaction\">

  <section class=\"contenu main-section\">
<!-- Bloc pour l'affichage des métadonnées de l'article -->
    <div id=\"metadata\" class=\"metadata\">
       <p class=\"auteur\">
          <span class=\"standardEtiquette\">Popularité : </span>   
          <span class=\"date-publication\">";
        // line 23
        echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getContext($context, "me"), "popularite"));
        echo "</span>
       </p>
       <p>
        <span class=\"standardEtiquette\">Statut :</span> 
        <span class=\"date-publication\">";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "me"), "roles"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo twig_escape_filter($this->env, ($this->getAttribute($this->getContext($context, "r"), "name") . " | "), "html", null, true);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "</span></p>
    </div>
    <!-- Bloc pour l'affichage du contenu du profil -->
    <div id=\"corps\" class=\"corps\" style=\"margin-top:20px\">
    <div id=\"enveloppe-avatar\">
\t <div id=\"avatar\">
      ";
        // line 33
        $context["imgAvatar"] = $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "me"), "sqr_");
        // line 34
        echo "      <a class=\"popin\" href=\"";
        echo twig_escape_filter($this->env, $this->getContext($context, "imgAvatar"), "html", null, true);
        echo "\" >
        <img src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->getContext($context, "imgAvatar"), "html", null, true);
        echo "\" />
      </a>
\t  </div>
\t   <p id=\"avatar_switcher\">
      <!--a href=\"#\">voir ses photos </a-->
    </p>
    </div>

    <div id=\"enveloppe-data\">
      <h1>";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "username"), "html", null, true);
        echo "</h1>
      <table id=\"data\">
        <tr>
          <td style=\"width:30%\"><span class=\"standardEtiquette\">Prénom/Nom</span></td>
          <td><strong>";
        // line 48
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "me"), "prenom") . " ") . $this->getAttribute($this->getContext($context, "me"), "nom")), "html", null, true);
        echo "</strong></td>
        </tr> 
        <tr>
          <td><span class=\"standardEtiquette\">Email</span></td>
          <td>
            ";
        // line 53
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 54
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Nana_messagePriveShow", array("id" => $this->getAttribute($this->getContext($context, "me"), "idNana"))), "html", null, true);
            echo "\" class=\"popin\">
              <img src=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/profil/bt_la-contacter_135x26.png"), "html", null, true);
            echo "\" alt=\"Envoie-lui un message\" />
            </a>
            ";
        }
        // line 58
        echo "          </td>
        </tr> 
        <tr>
          <td><span class=\"standardEtiquette\">Sexe</span></td>
          <td><strong>";
        // line 62
        if (($this->getAttribute($this->getContext($context, "me"), "sexe") == 1)) {
            echo "Garçon";
        } else {
            echo "Fille";
        }
        echo "</strong></td>
        </tr>
        <tr>
          <td><span class=\"standardEtiquette\">Date de naissance</span></td>
          <td><strong>";
        // line 66
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "dateNaissance"), "d m Y"), "html", null, true);
        echo "</strong></td>
        </tr>
        <tr>
            <td><span class=\"standardEtiquette\">Ville</strong></td>
            <td><strong>";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "ville"), "html", null, true);
        echo "</td>
        </tr> 
        <tr>
            <td><span class=\"standardEtiquette\">Job/Etudes</span></td>
            <td><strong>";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "occupation"), "html", null, true);
        echo "</strong></td>
        </tr>
        <!--tr>
          <td><span class=\"standardEtiquette\">Membre de </span></td>
          <td><img src=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/profil/picto_facebook_20x20.png"), "html", null, true);
        echo "\" /> <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/profil/picto_tweeter_20x20.png"), "html", null, true);
        echo "\" /> <img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/profil/picto_hellocoton_20x20.png"), "html", null, true);
        echo "\" /></td>
        </tr-->
\t\t    <tr>
          <td><span class=\"standardEtiquette\">Qui est-";
        // line 81
        if (($this->getAttribute($this->getContext($context, "me"), "sexe") == 2)) {
            echo "elle";
        } else {
            echo "il";
        }
        echo " ?</span></td><td></td></tr> 
      </table>
      <div><strong>";
        // line 83
        echo $this->getAttribute($this->getContext($context, "me"), "biographie");
        echo "</strong></div>
    </div>
    <div id=\"galerie-perso\">
      <h2>Sa galerie perso</h2>
      ";
        // line 87
        if (($this->getContext($context, "countGaleriePerso") > 0)) {
            // line 88
            echo "      ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "me"), "galeriePerso"));
            foreach ($context['_seq'] as $context["_key"] => $context["proxy"]) {
                // line 89
                echo "      ";
                $context["sourceGalerie"] = ((("/uploads/documents/profils/" . $this->getAttribute($this->getContext($context, "me"), "idNana")) . "/") . $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "fichier"));
                // line 90
                echo "      <a class=\"popin\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceGalerie")), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "titre"), "html", null, true);
                echo "\">
        <img class=\"vignette-medium\" src=\"";
                // line 91
                echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceGalerie")), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "titre"), "html", null, true);
                echo "\" />
      </a>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proxy'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 94
            echo "      ";
        } else {
            // line 95
            echo "      <p class=\"warning\">Sa galerie perso est encore vide</p>
      ";
        }
        // line 97
        echo "    </div>
\t</div>
  </section>

  <section id=\"reseau-tdn\">
    <div id=\"followers\">
      <div class=\"densite\">
        <span class=\"taille\">";
        // line 104
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "isFollowed")), "html", null, true);
        echo "</span> nana(s)
      </div>
      <h2>Elles aiment son profil</h2>
      ";
        // line 107
        if ((twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "isFollowed")) > 0)) {
            // line 108
            echo "      <div class=\"trombines\">
        ";
            // line 109
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "me"), "isFollowed"));
            foreach ($context['_seq'] as $context["_key"] => $context["nana"]) {
                // line 110
                echo "        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "nana"), "idNana"))), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "nana"), "username"), "html", null, true);
                echo "\">
          <img class=\"vignette\" src=\"";
                // line 111
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "nana")), "html", null, true);
                echo "\" />
        </a>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nana'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 114
            echo "      </div>
      ";
        }
        // line 116
        echo "      ";
        if (($this->env->getExtension('security')->isGranted("ROLE_USER") && (!$this->getContext($context, "alreadyFollowed")))) {
            // line 117
            echo "      <p>
        <a href=\"";
            // line 118
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_follow", array("nana" => $this->getAttribute($this->getContext($context, "me"), "idNana"))), "html", null, true);
            echo "\">
          <img src=\"";
            // line 119
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/profil/bt_suis-ses-activites_207x26.png"), "html", null, true);
            echo "\" alt=\"Suis son activité\" />
        </a>
      </p>
      ";
        }
        // line 123
        echo "    </div>
    <div id=\"followings\">
      <div class=\"densite2\">
        <span class=\"taille\">";
        // line 126
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "follows")), "html", null, true);
        echo "</span> nana(s)
      </div>
      <h2>Elle s'intéresse à d'autres</h2>
      ";
        // line 129
        if ((twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "me"), "follows")) > 0)) {
            // line 130
            echo "      <div class=\"trombines\">
        ";
            // line 131
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "me"), "follows"));
            foreach ($context['_seq'] as $context["_key"] => $context["nana"]) {
                // line 132
                echo "        <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "nana"), "idNana"))), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "nana"), "username"), "html", null, true);
                echo "\">
          <img class=\"vignette\" src=\"";
                // line 133
                echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "nana")), "html", null, true);
                echo "\" />
        </a>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nana'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 136
            echo "      </div>
      ";
        }
        // line 138
        echo "    </div>
    </form>
  </section>

  <section id=\"hobbies\">
    <h2>Ce qu'elle aime dans la vie</h2>
    ";
        // line 144
        if (($this->getContext($context, "countHobbies") > 0)) {
            // line 145
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "my_hobbies"));
            foreach ($context['_seq'] as $context["_key"] => $context["hobby"]) {
                // line 146
                echo "   <div class=\"hobby-wrapper\">
      <div class=\"titre-hobby\">
        <span class=\"standardEtiquette\">";
                // line 148
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "hobby"), "domaine"), "html", null, true);
                echo "</span> : <span class=\"hobby-precisions\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "hobby"), "precisions"), "html", null, true);
                echo "</span>
      </div>
      <div class=\"galerie-hobbie\">
      ";
                // line 151
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "hobby"), "galerieHobby"));
                foreach ($context['_seq'] as $context["_key"] => $context["proxy"]) {
                    // line 152
                    echo "      ";
                    $context["sourceGalerie"] = ((("/uploads/documents/profils/" . $this->getAttribute($this->getContext($context, "me"), "idNana")) . "/") . $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "fichier"));
                    // line 153
                    echo "      <a class=\"popin framedGalerie\" href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl($this->getContext($context, "sourceGalerie")), "html", null, true);
                    echo "\" title=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "titre"), "html", null, true);
                    echo "\">
        <img class=\"vignette-medium\" src=\"";
                    // line 154
                    echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->imagePersoFunction($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), $this->getAttribute($this->getContext($context, "me"), "idNana"), "sqr_"), "html", null, true);
                    echo "\" alt=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "proxy"), "lnImage"), "titre"), "html", null, true);
                    echo "\" />
      </a>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proxy'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 157
                echo "      </div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hobby'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 160
            echo "  ";
        } else {
            // line 161
            echo "    <p class=\"warning-empty\">Cette rubrique est encore vide</p>
  ";
        }
        // line 163
        echo "  </section>

  <section id=\"activite\">
    <h2>Son activité sur TDN</h2>
    ";
        // line 167
        if (twig_test_empty($this->getContext($context, "productions"))) {
            // line 168
            echo "    <p class=\"warning-empty\">Cette rubrique est encore vide</p>
    ";
        } else {
            // line 170
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "questions", array(), "array")))) {
                // line 171
                echo "      <section id=\"ses-questions\">
       <div class=\"bloc-production nano\">
         <div class=\"content\">
          <h4>Ses questions</h4>
          ";
                // line 175
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "questions", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 176
                    echo "          <p class=\"item-production\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "p")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "titre"), "html", null, true);
                    echo "</a></p>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 178
                echo "        </div>
      </div>
    </section>
    ";
            }
            // line 182
            echo "    ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "commentaires", array(), "array")))) {
                // line 183
                echo "    <section id=\"ses-commentaires\">
     <div class=\"bloc-production nano\">
       <div class=\"content\">
        <h4>Ses commentaires</h4>
        ";
                // line 187
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "commentaires", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 188
                    echo "        <p class=\"item-production\">";
                    echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getContext($context, "p"), "texteCommentaire"), 0, 100), "html", null, true);
                    echo "</p>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 190
                echo "      </div>
    </div>
  </section>
  ";
            }
            // line 194
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "reponses", array(), "array")))) {
                // line 195
                echo "      <section id=\"ses-reponses\">
        <div class=\"bloc-production nano\">
          <div class=\"content\">
           <h4>Ses réponses</h4>
           ";
                // line 199
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "reponses", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 200
                    echo "           <p class=\"item-production\"><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getAttribute($this->getContext($context, "p"), "lnConversation")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_slice($this->env, $this->getAttribute($this->getContext($context, "p"), "reponse"), 0, 100), "html", null, true);
                    echo "</a></p>
           ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 202
                echo "         </div>
       </div>
     </section>
     ";
            }
            // line 206
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "articles", array(), "array")))) {
                // line 207
                echo "      <section id=\"ses-articles\">
        <div class=\"bloc-production nano\">
          <div class=\"content\">
           <h4>Ses articles</h4>
           ";
                // line 211
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "articles", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 212
                    echo "           <p class=\"item-production\">
            <a href=\"";
                    // line 213
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "p")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "titre"), "html", null, true);
                    echo "</a>
          </p>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 216
                echo "          </div>
        </div>
      </section>
      ";
            }
            // line 220
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "demandes", array(), "array")))) {
                // line 221
                echo "      <section id=\"ses-demandes-de-conseil\">
        <div class=\"bloc-production nano\">
          <div class=\"content\">
            <h4>Ses demandes de conseil</h4>
            ";
                // line 225
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "demandes", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 226
                    echo "            <p class=\"item-production\">
              <a href=\"";
                    // line 227
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "p")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "titre"), "html", null, true);
                    echo "</a>
            </p>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 230
                echo "          </div>
        </div>
        <a class=\"lien-mince lien-bloc popin\" href=\"";
                // line 232
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("ConseilExpert_filPerso", array("id" => $this->getAttribute($this->getContext($context, "me"), "idNana"))), "html", null, true);
                echo "\">Toutes ses demandes de conseil</a>
      </section>
      ";
            }
            // line 235
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "conseils", array(), "array")))) {
                // line 236
                echo "      <section id=\"ses-conseils\">
        <div class=\"bloc-production nano\">
          <div class=\"content\">
            <h4>Ses conseils</h4>
            ";
                // line 240
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "conseils", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 241
                    echo "            <p class=\"item-production\">
              <a href=\"";
                    // line 242
                    echo twig_escape_filter($this->env, $this->env->getExtension('document_extension')->targetURLFilter($this->getContext($context, "p")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "titre"), "html", null, true);
                    echo "</a>
            </p>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 245
                echo "          </div>
        </div>
      </section>
      ";
            }
            // line 249
            echo "      ";
            if ((!twig_test_empty($this->getAttribute($this->getContext($context, "productions"), "breves", array(), "array")))) {
                // line 250
                echo "      <section id=\"ses-infos\">
        <div  class=\"bloc-production nano\">
          <div class=\"content\">
            <h4>Ses infos</h4>
            ";
                // line 254
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "productions"), "breves", array(), "array"));
                foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
                    // line 255
                    echo "            <p class=\"item-production\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "p"), "message"), "html", null, true);
                    echo "</p>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 257
                echo "          </div>
        </div>
        <a class=\"lien-mince lien-bloc\" href=\"";
                // line 259
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("BreveBundle_filPerso", array("id" => $this->getAttribute($this->getContext($context, "me"), "idNana"))), "html", null, true);
                echo "\">Toutes ses infos</a>
      </section>
      ";
            }
            // line 262
            echo "    ";
        }
        // line 263
        echo "  </section>

  <section id=\"tdn-like\">
    <h2>Ce qu'elle aime sur TDN (";
        // line 266
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getContext($context, "likes")), "html", null, true);
        echo ")</h2>
    ";
        // line 267
        if (twig_test_empty($this->getContext($context, "likes"))) {
            // line 268
            echo "    <p class=\"warning\">Cette rubrique est encore vide</p>
    ";
        } else {
            // line 270
            echo "      ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "likes"));
            foreach ($context['_seq'] as $context["_key"] => $context["isLiked"]) {
                // line 271
                echo "      <div class=\"hasLiked like-";
                echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "isLiked"), "lnRubrique")), "html", null, true);
                echo "\">
        <a href=\"";
                // line 272
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "isLiked"), "url"), "html", null, true);
                echo "\" class=\"lien-";
                echo twig_escape_filter($this->env, $this->env->getExtension('rubrique_extension')->rubriquePrincipaleFunction($this->getAttribute($this->getContext($context, "isLiked"), "lnRubrique")), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "isLiked"), "titre"), "html", null, true);
                echo "</a>
      </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['isLiked'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 275
            echo "    ";
        }
        // line 276
        echo "  </section>

</article>
<script type=\"text/javascript\">
    \$(document).ready(function () {
      \$(\".modif-bascule\").click(function (event) {
        event.preventDefault();
        \$(this).parent().parent().next().toggleClass('closed-field open-field');
      });
      \$(\"#source-biographie\").blur(function () {
        \$(\"#raw-biographie\").html(\$(\"#source-biographie\").html());
      });
      \$(\"#avatar_switcher\").click(function (event) {
        event.preventDefault();
        \$(\"#selecteur_avatar\").toggleClass('closed-field open-field');
      });
      \$(\"#galerie_switcher\").click(function (event) {
        event.preventDefault();
        \$(\"#selecteur_galerie\").toggleClass('closed-field open-field');
      });
          \$('.stiletto').click(function () {
      alerte = \$('.messages_systeme');
      alerte.html(\"Les escarpins représentent la popularite sur TDN. Pour en gagner, participe autant que tu peux à la vie de la communauté.\");
      alerte.toggleClass('latentSystemMessages alerteSystemMessages');
    });

    })
</script>
";
    }

    public function getTemplateName()
    {
        return "NanaBundle:Public:completeProfil.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  686 => 276,  683 => 275,  670 => 272,  665 => 271,  660 => 270,  656 => 268,  654 => 267,  650 => 266,  645 => 263,  642 => 262,  636 => 259,  632 => 257,  623 => 255,  619 => 254,  613 => 250,  610 => 249,  604 => 245,  593 => 242,  590 => 241,  586 => 240,  580 => 236,  577 => 235,  571 => 232,  567 => 230,  556 => 227,  553 => 226,  549 => 225,  543 => 221,  540 => 220,  534 => 216,  523 => 213,  520 => 212,  516 => 211,  510 => 207,  507 => 206,  501 => 202,  490 => 200,  486 => 199,  480 => 195,  477 => 194,  471 => 190,  462 => 188,  458 => 187,  452 => 183,  449 => 182,  443 => 178,  432 => 176,  428 => 175,  422 => 171,  419 => 170,  415 => 168,  413 => 167,  407 => 163,  403 => 161,  400 => 160,  392 => 157,  381 => 154,  374 => 153,  371 => 152,  367 => 151,  359 => 148,  355 => 146,  350 => 145,  348 => 144,  340 => 138,  336 => 136,  327 => 133,  320 => 132,  316 => 131,  313 => 130,  311 => 129,  305 => 126,  300 => 123,  293 => 119,  289 => 118,  286 => 117,  283 => 116,  279 => 114,  270 => 111,  263 => 110,  259 => 109,  256 => 108,  254 => 107,  248 => 104,  239 => 97,  235 => 95,  232 => 94,  221 => 91,  214 => 90,  211 => 89,  206 => 88,  204 => 87,  197 => 83,  188 => 81,  178 => 78,  171 => 74,  164 => 70,  157 => 66,  146 => 62,  140 => 58,  134 => 55,  129 => 54,  127 => 53,  119 => 48,  112 => 44,  100 => 35,  95 => 34,  93 => 33,  77 => 27,  70 => 23,  58 => 14,  55 => 13,  52 => 12,  47 => 9,  40 => 6,  37 => 5,  31 => 3,);
    }
}
