<?php

/* CoreBundle:Bloc:journal.html.twig */
class __TwigTemplate_e1b4c672657147ed3bab033cc742f3fa extends Twig_Template
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
        // line 1
        echo "<div id=\"tdnEnDirect\">
\t<h4>TDN en direct</h4>
\t";
        // line 3
        if (twig_test_empty($this->getContext($context, "entrees"))) {
            // line 4
            echo "\t<p>Aucune activité sur TDN</p>
\t";
        } else {
            // line 6
            echo "\t<div style=\"display:block\">
\t<div class=\"nano\" style=\"height:520px\">
\t\t<div class=\"content journal\">
\t\t\t";
            // line 9
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "entrees"));
            foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
                // line 10
                echo "\t\t\t<div class=\"entreeJournal\">
\t\t\t\t<div class=\"dateEntree\">
\t\t\t\t";
                // line 12
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "e"), "dateEntree"), "d/m/Y H:i:s"), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t\t<div class=\"avatarEntree partEntreeDirect\">
\t\t\t\t";
                // line 15
                if (((null === $this->getAttribute($this->getContext($context, "e"), "lnActeur")) || (null === $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "lnActeur"), "lnAvatar")))) {
                    // line 16
                    echo "\t\t         <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/centre/avatar_profil/avatar5%2080x95.png"), "html", null, true);
                    echo "\" style=\"width:40px\" />
\t\t\t\t";
                } else {
                    // line 18
                    echo "\t\t         <img src=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl(((("/uploads/documents/profils/" . $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "lnActeur"), "idNana")) . "/sqr_") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "e"), "lnActeur"), "lnAvatar"), "fichier"))), "html", null, true);
                    echo "\" style=\"width:40px\" />
\t\t\t\t";
                }
                // line 20
                echo "\t\t\t\t</div>
\t\t\t\t<div class=\"texteEntree partEntreeDirect\">
\t\t\t\t";
                // line 22
                if ((!twig_test_empty($this->getAttribute($this->getContext($context, "e"), "url")))) {
                    // line 23
                    echo "\t\t\t\t";
                    $context["url"] = (((("<a class=\"url\" href=\"" . $this->getAttribute($this->getContext($context, "e"), "url")) . "\">") . twig_slice($this->env, $this->getAttribute($this->getContext($context, "e"), "titre"), 0, 100)) . "</a>");
                    // line 24
                    echo "\t\t\t\t";
                } else {
                    // line 25
                    echo "\t\t\t\t";
                    $context["url"] = twig_slice($this->env, $this->getAttribute($this->getContext($context, "e"), "titre"), 0, 100);
                    // line 26
                    echo "\t\t\t\t";
                }
                // line 27
                echo "\t\t\t\t";
                if ((null === $this->getAttribute($this->getContext($context, "e"), "lnActeur"))) {
                    // line 28
                    echo "\t\t\t\t";
                    $context["who"] = "anonyme";
                    // line 29
                    echo "\t\t\t\t";
                } else {
                    // line 30
                    echo "\t\t\t\t";
                    $context["who"] = (((("<a class=\"acteur\" href=" . $this->env->getExtension('routing')->getPath("NanaBundle_profil", array("id" => $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "lnActeur"), "idNana")))) . ">") . $this->getAttribute($this->getAttribute($this->getContext($context, "e"), "lnActeur"), "username")) . "</a>");
                    // line 31
                    echo "\t\t\t\t";
                }
                // line 32
                echo "\t\t\t\t";
                echo $this->getContext($context, "who");
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "e"), "texte"), "html", null, true);
                echo " ";
                echo $this->getContext($context, "url");
                echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['e'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 36
            echo "\t\t</div>
\t\t</div>
\t</div>
\t";
        }
        // line 40
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "CoreBundle:Bloc:journal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 40,  89 => 30,  86 => 29,  77 => 26,  74 => 25,  62 => 20,  42 => 12,  38 => 10,  29 => 6,  51 => 10,  23 => 3,  355 => 146,  351 => 144,  343 => 141,  336 => 138,  330 => 136,  328 => 135,  325 => 134,  321 => 132,  315 => 130,  313 => 129,  310 => 128,  300 => 124,  290 => 119,  278 => 114,  266 => 109,  258 => 106,  247 => 100,  245 => 99,  236 => 94,  231 => 92,  226 => 91,  224 => 90,  218 => 86,  210 => 83,  201 => 80,  196 => 78,  193 => 77,  189 => 75,  183 => 72,  177 => 70,  168 => 66,  165 => 65,  159 => 62,  156 => 61,  154 => 60,  150 => 58,  144 => 56,  137 => 53,  135 => 52,  131 => 50,  125 => 47,  119 => 44,  113 => 41,  107 => 38,  104 => 37,  102 => 36,  96 => 33,  85 => 27,  81 => 26,  68 => 23,  59 => 17,  54 => 11,  48 => 15,  46 => 13,  33 => 6,  30 => 5,  27 => 4,  25 => 4,  19 => 1,  855 => 417,  852 => 416,  847 => 116,  842 => 86,  838 => 42,  835 => 41,  828 => 38,  824 => 37,  820 => 36,  816 => 34,  813 => 33,  803 => 25,  800 => 24,  796 => 22,  793 => 21,  787 => 19,  783 => 18,  779 => 17,  775 => 16,  771 => 15,  767 => 14,  763 => 13,  759 => 12,  755 => 11,  750 => 10,  747 => 9,  742 => 7,  736 => 451,  734 => 416,  697 => 382,  693 => 381,  662 => 353,  658 => 352,  640 => 337,  632 => 331,  629 => 330,  626 => 329,  624 => 328,  613 => 319,  607 => 316,  602 => 314,  597 => 311,  595 => 310,  592 => 309,  586 => 306,  581 => 304,  576 => 301,  574 => 300,  570 => 298,  563 => 293,  561 => 292,  558 => 291,  550 => 285,  548 => 284,  544 => 282,  535 => 275,  533 => 274,  530 => 273,  521 => 266,  519 => 265,  516 => 264,  510 => 261,  505 => 259,  500 => 257,  494 => 253,  492 => 252,  489 => 251,  483 => 248,  477 => 244,  475 => 243,  472 => 242,  467 => 239,  463 => 237,  457 => 233,  455 => 232,  449 => 228,  443 => 225,  438 => 223,  432 => 219,  430 => 218,  427 => 217,  421 => 214,  416 => 212,  410 => 208,  408 => 207,  405 => 206,  394 => 198,  389 => 196,  383 => 192,  381 => 191,  378 => 190,  372 => 187,  367 => 185,  361 => 181,  359 => 148,  356 => 179,  350 => 176,  345 => 142,  340 => 140,  334 => 168,  332 => 167,  329 => 166,  323 => 163,  320 => 162,  314 => 160,  312 => 159,  306 => 126,  304 => 154,  298 => 123,  294 => 121,  288 => 118,  285 => 117,  282 => 116,  276 => 113,  273 => 112,  270 => 111,  264 => 108,  261 => 107,  259 => 134,  255 => 132,  249 => 129,  244 => 127,  239 => 125,  234 => 122,  232 => 121,  227 => 119,  223 => 117,  221 => 116,  209 => 107,  206 => 106,  204 => 105,  198 => 79,  192 => 99,  186 => 96,  180 => 71,  172 => 87,  170 => 86,  162 => 81,  158 => 80,  153 => 77,  151 => 76,  141 => 55,  138 => 67,  129 => 64,  126 => 63,  121 => 62,  118 => 61,  115 => 60,  106 => 57,  98 => 34,  92 => 31,  83 => 28,  80 => 27,  75 => 23,  73 => 17,  66 => 22,  63 => 41,  56 => 18,  52 => 22,  49 => 21,  43 => 8,  39 => 10,  35 => 6,  251 => 102,  246 => 75,  240 => 96,  237 => 70,  222 => 68,  216 => 67,  211 => 64,  205 => 81,  199 => 60,  197 => 59,  191 => 58,  188 => 57,  181 => 56,  178 => 55,  173 => 54,  171 => 67,  166 => 52,  148 => 51,  146 => 50,  142 => 48,  133 => 46,  128 => 45,  117 => 42,  114 => 41,  110 => 36,  103 => 56,  95 => 32,  93 => 32,  90 => 29,  82 => 25,  71 => 24,  67 => 22,  60 => 19,  58 => 32,  53 => 16,  47 => 9,  41 => 11,  36 => 9,  69 => 19,  65 => 14,  61 => 18,  55 => 13,  50 => 16,  44 => 12,  40 => 7,  34 => 9,  31 => 3,  28 => 1,);
    }
}
