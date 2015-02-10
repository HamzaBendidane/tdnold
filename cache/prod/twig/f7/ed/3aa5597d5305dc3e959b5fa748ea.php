<?php

/* TwigBundle::layout.html.twig */
class __TwigTemplate_f7ed3aa5597d5305dc3e959b5fa748ea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\"/>
        <meta name=\"robots\" content=\"noindex,nofollow\" />
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/css/exception_layout.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
        <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/css/exception.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t\t<style type='text/css'>
\t@font-face { font-family: Droid Sans; src: url('/assets/css/fonts/DroidSans.ttf'); } 

\tbody {
\t\tbackground-color: #EFF9FD;
\t}
\t.page-erreur {
\t\tbackground: url(/assets/images/theme/erreurs/404.png) no-repeat scroll 0 0 #EFF9FD;
\t\tfont-family: \"Droid Sans\", Helvetica, Verdana, sans-serif;
\t}
\t.oups {
\t\tfont-weight: 700;
\t\tcolor: #6B2A65;
\t\tfont-size: 4em;
\t\tfont-style: italic;
\t\tmargin-left: 280px;
\t\tpadding-top: 54px;
\t}
\t.message {
\t\tposition: absolute;
\t\tmargin: 400px 0 100px 600px;
\t}
\t.message .texte {
\t\tfont-size: 1.5rem;
\t}
\t.message .redirection {
\t\tfont-size: 0.9rem;
\t}
\t</style>
    </head>
    <body>
        <div id=\"content\">
            ";
        // line 41
        $this->displayBlock('body', $context, $blocks);
        // line 42
        echo "        </div>
    </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "";
    }

    // line 41
    public function block_body($context, array $blocks = array())
    {
        echo "";
    }

    public function getTemplateName()
    {
        return "TwigBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 41,  84 => 6,  77 => 42,  75 => 41,  39 => 8,  35 => 7,  31 => 6,  26 => 4,  21 => 1,  46 => 8,  43 => 7,  32 => 4,  29 => 3,);
    }
}
