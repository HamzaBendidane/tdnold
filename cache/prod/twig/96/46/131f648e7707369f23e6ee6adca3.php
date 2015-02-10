<?php

/* NanaBundle:Security:formPasswordS1.html.twig */
class __TwigTemplate_9646131f648e7707369f23e6ee6adca3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Default:TDNDocument.html.twig");

        $this->blocks = array(
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

    // line 5
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 6
        if (array_key_exists("error", $context)) {
            // line 7
            echo "    <div>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "error"), "message"), "html", null, true);
            echo "</div>
";
        }
        // line 9
        echo "<form action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Nana_passwordResetS2"), "html", null, true);
        echo "\" method=\"post\">
    <p>Nous allons t'envoyer un message pour vérifier que le compte t'appartient vraiment.</p>
    <p>En suivant le lien contenu dans le mail, tu pourras définir un nouveau mot de passe.</p>
    <div>
\t    <label for=\"email\">Email </label>
        <input type=\"text\" id=\"email\" name=\"email\" value=\"\" style=\"height:18px\"/>
     
\t   <input id=\"envoyer\" type=\"submit\"  name=\"envoyer\" value=\"\">
    </div>

    ";
        // line 20
        echo "
    ";
        // line 22
        echo "    <input type=\"hidden\" name=\"_target_path\" value=\"/my-tdn/profil\" />

</form>
";
    }

    public function getTemplateName()
    {
        return "NanaBundle:Security:formPasswordS1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 22,  53 => 20,  39 => 9,  33 => 7,  31 => 6,  28 => 5,);
    }
}
