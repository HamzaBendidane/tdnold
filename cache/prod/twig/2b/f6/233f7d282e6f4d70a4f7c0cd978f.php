<?php

/* CoreBundle:Page:contact.html.twig */
class __TwigTemplate_2bf6233f7d282e6f4d70a4f7c0cd978f extends Twig_Template
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
        echo "envoie un message à TDN";
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
        <form name=\"formulaireContact\" id=\"formulaireContact\" method=\"post\" action=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Core_contact"), "html", null, true);
        echo "\">
          ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formContact"), "requete"), 'row');
        echo "
          ";
        // line 27
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 28
            echo "          ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formContact"), "email"), 'row', array("attr" => array("value" => $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "user"), "email"))));
            echo "
          ";
        } else {
            // line 30
            echo "          ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formContact"), "email"), 'row');
            echo "
          ";
        }
        // line 32
        echo "          ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formContact"), "message"), 'row');
        echo "
          ";
        // line 33
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "formContact"), "_token"), 'row');
        echo "
          <input type=\"submit\" name=\"envoyer\" value=\"Envoyer\" />
        </form>
      </div>
    </section>
</article>
";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Page:contact.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 33,  87 => 32,  81 => 30,  75 => 28,  73 => 27,  69 => 26,  65 => 25,  47 => 10,  44 => 9,  41 => 8,  36 => 5,  30 => 3,);
    }
}
