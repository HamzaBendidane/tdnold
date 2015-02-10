<?php

/* DocumentBundle:Page:equipeTDN.html.twig */
class __TwigTemplate_6fb62bb2296d52099a9aa28760ae2b43 extends Twig_Template
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
        echo "L’équipe de Trucdenana.com";
    }

    // line 5
    public function block_local_stylesheets($context, array $blocks = array())
    {
    }

    // line 8
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 9
        echo "<div class=\"postit-contenu\">
   <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/web-tdn_titre_299x70.png"), "html", null, true);
        echo "\" />
</div>
<article id=\"article-wrapper\" class=\"main article-redaction\">

  <!-- Contenu de l'article -->
   <section class=\"contenu main-section\">

      <!-- Bloc pour l'affichage des métadonnées de l'article -->
      <div id=\"metadata\" class=\"metadata\">
         <p class=\"auteur\"><span class=\"standardEtiquette\">Ecrit par </span><span class=\"nom-auteur\"> TDN</span></p>
         <p>
      </div>

      <!-- Bloc pour l'affichage du contenu de l'article -->
      <div id=\"corps\" class=\"corps\">
        <h1 class=\"titre-document titre-tdn\">L'équipe TDN</h1>
        <div id=\"tabsEquipe\">
          <ul class=\"tabsRole\">
            <li class=\"onglet\"><a  href=\"#tabsEquipe-1\">Journalistes</a></li>
            <li class=\"onglet\"><a  href=\"#tabsEquipe-2\">Experts</a></li>
            <li class=\"onglet\"><a  href=\"#tabsEquipe-3\">Technique</a></li>
          </ul>

          <div id=\"tabsEquipe-1\">
            <h2>La rédaction</h2>
            ";
        // line 35
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "admins"));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 36
            echo "            <div class=\"cartouche\">
              <p class=\"nom\">";
            // line 37
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "j"), "prenom") . " ") . $this->getAttribute($this->getContext($context, "j"), "nom")), "html", null, true);
            echo "</p>
                <figure class=\"avatar\">
                  <img src=\"";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "j")), "html", null, true);
            echo "\" alt=\"Avatar de j.username\" />
                  <figcaption>Journaliste</figcaption>
                </figure>
              ";
            // line 42
            echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getContext($context, "j"), "popularite"));
            echo "
              <a class=\"lienStandard solid\" href=\"";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "j"), "idNana"))), "html", null, true);
            echo "\">Voir son profil</a>
              <a class=\"lienStandard solid\" href=\"mailto:";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "j"), "email"), "html", null, true);
            echo "\">Lui écrire</a>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 47
        echo "            ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "journalistes"));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 48
            echo "            <div class=\"cartouche\">
              <p class=\"nom\">";
            // line 49
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "j"), "prenom") . " ") . $this->getAttribute($this->getContext($context, "j"), "nom")), "html", null, true);
            echo "</p>
                <figure class=\"avatar\">
                  <img src=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "j")), "html", null, true);
            echo "\" alt=\"Avatar de j.username\" />
                  <figcaption>Journaliste</figcaption>
                </figure>
              ";
            // line 54
            echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getContext($context, "j"), "popularite"));
            echo "
              <a class=\"lienStandard solid\" href=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "j"), "idNana"))), "html", null, true);
            echo "\">Voir son profil</a>
              <a class=\"lienStandard solid\" href=\"mailto:";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "j"), "email"), "html", null, true);
            echo "\">Lui écrire</a>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 59
        echo "          </div>

          <div id=\"tabsEquipe-2\">
            <h2>Les experts</h2>
            ";
        // line 63
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "experts"));
        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
            // line 64
            echo "            <div class=\"cartouche\">
              <p class=\"nom\">";
            // line 65
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "j"), "prenom") . " ") . $this->getAttribute($this->getContext($context, "j"), "nom")), "html", null, true);
            echo "</p>
              <figure class=\"avatar\">
                <img src=\"";
            // line 67
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->avatarFunction($this->getContext($context, "j")), "html", null, true);
            echo "\" alt=\"Avatar de j.username\" />
                <figcaption>
                <p>";
            // line 69
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "j"), "setExpertises"));
            foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
                echo "<span class=\"domaineExpertise\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "e"), "domaine"), "html", null, true);
                echo "</span>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            echo "</p>
                <p>";
            // line 70
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "j"), "setExpertises"));
            foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
                echo "<span class=\"sticker-expertise puce-";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "rubrique"), "slug"), "html", null, true);
                echo "\"></span>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            echo "</p>
                </figcaption>
              </figure>
              ";
            // line 73
            echo $this->env->getExtension('nana_extension')->stilettoFilter($this->getAttribute($this->getContext($context, "j"), "popularite"));
            echo "
              <a class=\"lienStandard solid\" href=\"";
            // line 74
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getContext($context, "j"), "idNana"))), "html", null, true);
            echo "\">Voir son profil</a>
              <a class=\"lienStandard solid\" href=\"mailto:";
            // line 75
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "j"), "email"), "html", null, true);
            echo "\">Lui écrire</a>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 78
        echo "          </div>

          <div  id=\"tabsEquipe-3\">
            <h2>La technique</h2>
          </div>

      </div>
    </section>
</article>
<script type=\"text/javascript\">
  \$(document).ready(function() {
    \$('#tabsEquipe').tabs();
  })
</script>

";
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Page:equipeTDN.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  214 => 78,  205 => 75,  201 => 74,  197 => 73,  182 => 70,  169 => 69,  164 => 67,  159 => 65,  156 => 64,  152 => 63,  146 => 59,  137 => 56,  133 => 55,  129 => 54,  123 => 51,  118 => 49,  115 => 48,  110 => 47,  101 => 44,  97 => 43,  93 => 42,  87 => 39,  82 => 37,  79 => 36,  75 => 35,  47 => 10,  44 => 9,  41 => 8,  36 => 5,  30 => 3,);
    }
}
