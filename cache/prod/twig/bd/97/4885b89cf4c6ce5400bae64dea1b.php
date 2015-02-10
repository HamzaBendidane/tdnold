<?php

/* NanaBundle:Security:blocLogin.html.twig */
class __TwigTemplate_bd974885b89cf4c6ce5400bae64dea1b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 3
        if ($this->getContext($context, "error")) {
            // line 4
            echo "    <div>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "error"), "message"), "html", null, true);
            echo "</div>
";
        }
        // line 6
        echo "<form action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("login_check"), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"loginFields\">
\t    <label for=\"username\">Pseudo </label>
        <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getContext($context, "last_username"), "html", null, true);
        echo "\" style=\"height:18px\"/>
     
        <label for=\"password\">Mot de passe </label>
        <input type=\"password\" id=\"password\" name=\"_password\" style=\"height:18px\" />

\t   <input id=\"envoyer\" type=\"submit\"  name=\"envoyer\" value=\"\" class=\"loginSubmit\">
    </div>
\t<div class=\"loginFields rememberField\">
\t\t<input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" checked />
\t    <label for=\"remember_me\">Conserver la connexion ouverte</label>
    </div>


    ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "_token"), 'row');
        echo "

    ";
        // line 25
        echo "    ";
        if (array_key_exists("redirect_path", $context)) {
            // line 26
            echo "        ";
            if (array_key_exists("redirect_params", $context)) {
                // line 27
                echo "            <input type=\"hidden\" name=\"_target_path\" value=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getContext($context, "redirect_url"), $this->getContext($context, "redirect_params")), "html", null, true);
                echo "\" />
        ";
            } else {
                // line 29
                echo "            <input type=\"hidden\" name=\"_target_path\" value=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getContext($context, "redirect_url")), "html", null, true);
                echo "\" />
        ";
            }
            // line 31
            echo "    ";
        }
        // line 32
        echo "
</form>

";
    }

    public function getTemplateName()
    {
        return "NanaBundle:Security:blocLogin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 31,  61 => 26,  58 => 25,  37 => 9,  22 => 3,  19 => 2,  608 => 144,  604 => 65,  601 => 64,  591 => 38,  588 => 37,  584 => 33,  581 => 32,  576 => 4,  526 => 302,  519 => 297,  513 => 295,  507 => 293,  505 => 292,  501 => 290,  498 => 289,  496 => 288,  436 => 231,  432 => 230,  428 => 229,  382 => 186,  377 => 184,  373 => 183,  351 => 164,  343 => 158,  340 => 157,  335 => 155,  326 => 148,  324 => 147,  320 => 145,  318 => 144,  309 => 142,  299 => 135,  296 => 134,  294 => 133,  288 => 130,  276 => 124,  270 => 121,  262 => 115,  260 => 114,  254 => 111,  246 => 108,  232 => 98,  225 => 95,  216 => 92,  208 => 90,  205 => 89,  202 => 88,  193 => 85,  190 => 84,  185 => 83,  183 => 82,  180 => 81,  169 => 74,  153 => 68,  151 => 67,  148 => 66,  146 => 64,  125 => 45,  123 => 37,  118 => 35,  115 => 34,  109 => 31,  105 => 30,  101 => 29,  93 => 27,  89 => 26,  85 => 25,  81 => 24,  73 => 22,  68 => 21,  64 => 27,  62 => 14,  55 => 13,  49 => 12,  41 => 8,  35 => 6,  33 => 5,  29 => 4,  24 => 4,  348 => 143,  344 => 141,  342 => 140,  339 => 139,  337 => 156,  331 => 134,  329 => 133,  312 => 118,  310 => 117,  304 => 113,  298 => 111,  293 => 108,  282 => 127,  279 => 104,  275 => 103,  271 => 101,  269 => 100,  266 => 99,  259 => 95,  255 => 94,  252 => 93,  250 => 110,  244 => 107,  235 => 86,  231 => 85,  228 => 96,  226 => 83,  222 => 81,  213 => 91,  209 => 78,  203 => 77,  196 => 73,  192 => 72,  184 => 67,  179 => 66,  170 => 62,  166 => 61,  163 => 60,  161 => 70,  152 => 57,  143 => 51,  139 => 50,  136 => 49,  134 => 48,  128 => 45,  121 => 43,  113 => 32,  102 => 34,  97 => 28,  92 => 32,  84 => 29,  79 => 32,  77 => 23,  70 => 29,  56 => 12,  53 => 22,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 6,);
    }
}
