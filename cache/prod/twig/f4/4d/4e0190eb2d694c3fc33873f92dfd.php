<?php

/* DocumentBundle:Admin:documentListe.html.twig */
class __TwigTemplate_f44d4e0190eb2d694c3fc33873f92dfd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("DocumentBundle:Default:TDNAdmin.html.twig");

        $this->blocks = array(
            'local_stylesheets' => array($this, 'block_local_stylesheets'),
            'local_header_scripts' => array($this, 'block_local_header_scripts'),
            'contenu_principal' => array($this, 'block_contenu_principal'),
            'displayContent' => array($this, 'block_displayContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "DocumentBundle:Default:TDNAdmin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_local_stylesheets($context, array $blocks = array())
    {
    }

    // line 6
    public function block_local_header_scripts($context, array $blocks = array())
    {
    }

    // line 11
    public function block_contenu_principal($context, array $blocks = array())
    {
        // line 12
        echo "<div class=\"postit-contenu\">
 <img src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/titres/administration_titre.png"), "html", null, true);
        echo "\" />
</div>

<h1 class=\"titrePage\">";
        // line 16
        echo twig_escape_filter($this->env, $this->getContext($context, "titrePage"), "html", null, true);
        echo "</h1>

";
        // line 18
        if ((!twig_test_empty($this->getContext($context, "selectList")))) {
            // line 19
            echo "<form action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getContext($context, "referer")), "html", null, true);
            echo "\" method=\"post\" name=\"form_selectionConseil\" id=\"form_selectionConseil\" class=\"formSelection\">
  <label for=\"selectField\">Champ</label>
  <select name=\"selectField\" id=\"selectField\" class=\"selectInput\">
    ";
            // line 22
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "selectList"));
            foreach ($context['_seq'] as $context["_key"] => $context["critere"]) {
                // line 23
                echo "    <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "critere"), "value"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "critere"), "texte"), "html", null, true);
                echo "</option>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['critere'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 25
            echo "  </select>
  <label for=\"selectValeur\">Valeur</label>
  <input type=\"text\" name=\"selectValeur\" id=\"selectValeur\" class=\"textInput\" size=\"30\" />
  <input type=\"submit\" name=\"selectSubmitter\" class=\"selectSubmitter\" value=\"Chercher\" />
</form>
";
        }
        // line 31
        echo "
";
        // line 32
        if (array_key_exists("isSelectedField", $context)) {
            // line 33
            echo "<p class=\"rappelSelection\"> ";
            echo twig_escape_filter($this->env, $this->getContext($context, "isSelectedField"), "html", null, true);
            echo " = ";
            echo twig_escape_filter($this->env, $this->getContext($context, "isSelectedValeur"), "html", null, true);
            echo "</p>
";
        }
        // line 35
        echo "
<table class=\"adminLog\">
  <thead>
    <tr>
      <th class=\"colonneId\">Id</th>
      ";
        // line 40
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "colonnesList"));
        foreach ($context['_seq'] as $context["_key"] => $context["colonne"]) {
            // line 41
            echo "      <th> 
        <a href='";
            // line 42
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getContext($context, "referer"), array("ordre" => $this->getContext($context, "colonne"))), "html", null, true);
            echo "'>";
            echo twig_escape_filter($this->env, $this->getContext($context, "colonne"), "html", null, true);
            echo " </a>
      </th>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colonne'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 45
        echo "      ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "actionsList"));
        foreach ($context['_seq'] as $context["clef"] => $context["action"]) {
            // line 46
            echo "      <th> ";
            echo twig_escape_filter($this->env, $this->getContext($context, "clef"), "html", null, true);
            echo " </th>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['clef'], $context['action'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 48
        echo "    </tr>
  </thead>
  ";
        // line 50
        if ($this->getContext($context, "documentListe")) {
            // line 51
            echo "  ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "documentListe"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["doc"]) {
                // line 52
                echo "  <tr class=\"TDNDoc-";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "doc"), "statut"), "html", null, true);
                echo "\">
    ";
                // line 53
                $this->displayBlock('displayContent', $context, $blocks);
                // line 54
                echo "    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "actionsList"));
                foreach ($context['_seq'] as $context["clef"] => $context["action"]) {
                    // line 55
                    echo "    ";
                    if (((!$this->getAttribute($this->getContext($context, "action", true), "role", array(), "array", true, true)) || $this->env->getExtension('security')->isGranted($this->getAttribute($this->getContext($context, "action"), "role", array(), "array")))) {
                        // line 56
                        echo "    ";
                        if ($this->getAttribute($this->getContext($context, "action", true), "class", array(), "array", true, true)) {
                            $context["style"] = $this->getAttribute($this->getContext($context, "action"), "class", array(), "array");
                        } else {
                            $context["style"] = "";
                        }
                        // line 57
                        echo "    <td>
      <a href='";
                        // line 58
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getAttribute($this->getContext($context, "action"), "controleur", array(), "array"), array("id" => $this->getAttribute($this->getContext($context, "doc"), "idDocument"))), "html", null, true);
                        echo "' class='";
                        echo twig_escape_filter($this->env, $this->getContext($context, "style"), "html", null, true);
                        echo "'>
      ";
                        // line 59
                        if (twig_test_iterable($this->getAttribute($this->getContext($context, "action"), "action", array(), "array"))) {
                            // line 60
                            echo "      ";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "action"), "action", array(), "array"), $this->getAttribute($this->getContext($context, "doc"), "statut"), array(), "array"), "html", null, true);
                            echo "
      ";
                        } else {
                            // line 62
                            echo "      ";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "action"), "action", array(), "array"), "html", null, true);
                            echo "
      ";
                        }
                        // line 64
                        echo "      </a>
    </td>
    ";
                    }
                    // line 67
                    echo "    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['clef'], $context['action'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 68
                echo "  </tr>
  ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['doc'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 70
            echo "  ";
        } else {
            // line 71
            echo "  <tr>
    <td colspan='3' class='no-content'>Aucune document de ce type n'est enregistré</td>
  </tr>
  ";
        }
        // line 75
        echo "</table>
";
    }

    // line 53
    public function block_displayContent($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Admin:documentListe.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  251 => 53,  246 => 75,  240 => 71,  237 => 70,  222 => 68,  216 => 67,  211 => 64,  205 => 62,  199 => 60,  197 => 59,  191 => 58,  188 => 57,  181 => 56,  178 => 55,  173 => 54,  171 => 53,  166 => 52,  148 => 51,  146 => 50,  142 => 48,  133 => 46,  128 => 45,  117 => 42,  114 => 41,  110 => 40,  103 => 35,  95 => 33,  93 => 32,  90 => 31,  82 => 25,  71 => 23,  67 => 22,  60 => 19,  58 => 18,  53 => 16,  47 => 13,  41 => 11,  36 => 6,  69 => 19,  65 => 17,  61 => 16,  55 => 13,  50 => 10,  44 => 12,  40 => 8,  34 => 5,  31 => 3,  28 => 3,);
    }
}
