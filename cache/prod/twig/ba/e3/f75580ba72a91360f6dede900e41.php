<?php

/* ConcoursBundle:Bloc:blocConcoursSidebar.html.twig */
class __TwigTemplate_bae3f75580ba72a91360f6dede900e41 extends Twig_Template
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
        echo "<div class=\"contenu-suivre-tdn\">
\t<a href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Concours_sommaire"), "html", null, true);
        echo "\">
\t\t<img src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/sidebar/cadre_pince_concours.png"), "html", null, true);
        echo "\" />
\t</a>
\t";
        // line 5
        if ((!twig_test_empty($this->getContext($context, "concours")))) {
            // line 6
            echo "\t<ul>
\t";
            // line 7
            if (twig_test_iterable($this->getContext($context, "concours"))) {
                // line 8
                echo "\t";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getContext($context, "concours"));
                foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                    // line 9
                    echo "\t\t<li>
\t\t\t<a href=\"";
                    // line 10
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Concours_show", array("id" => $this->getAttribute($this->getContext($context, "c"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "c"), "slug"))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "c"), "titre"), "html", null, true);
                    echo "</a>
\t\t</li>
\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 13
                echo "\t";
            } else {
                // line 14
                echo "\t\t<li>
\t\t\t<a href=\"";
                // line 15
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Concours_show", array("id" => $this->getAttribute($this->getContext($context, "concours"), "idDocument"), "slug" => $this->getAttribute($this->getContext($context, "concours"), "slug"))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "concours"), "titre"), "html", null, true);
                echo "</a>
\t\t</li>
\t";
            }
            // line 18
            echo "\t</ul>
\t";
        } else {
            // line 20
            echo "\t<p>Aucun concours ouvert</p>
\t";
        }
        // line 22
        echo "\t<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Concours_sommaire"), "html", null, true);
        echo "\">Tous les concours</a>
</div>
<img src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/sidebar/foot_cadre-blanc-cadre pince.png"), "html", null, true);
        echo "\" />
";
    }

    public function getTemplateName()
    {
        return "ConcoursBundle:Bloc:blocConcoursSidebar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 20,  43 => 9,  38 => 8,  26 => 3,  110 => 62,  107 => 61,  40 => 17,  90 => 27,  82 => 24,  78 => 23,  63 => 15,  60 => 14,  57 => 13,  51 => 13,  48 => 12,  45 => 11,  42 => 10,  31 => 5,  317 => 108,  301 => 104,  291 => 99,  283 => 96,  263 => 90,  261 => 89,  251 => 85,  230 => 78,  214 => 70,  211 => 69,  206 => 67,  194 => 63,  186 => 58,  173 => 56,  167 => 55,  160 => 53,  150 => 49,  147 => 48,  138 => 45,  135 => 44,  132 => 43,  120 => 66,  117 => 38,  112 => 63,  100 => 34,  95 => 33,  83 => 30,  65 => 16,  59 => 13,  54 => 14,  46 => 10,  23 => 3,  28 => 5,  1176 => 331,  1170 => 330,  1164 => 329,  1158 => 328,  1152 => 327,  1146 => 326,  1140 => 325,  1134 => 324,  1128 => 323,  1112 => 317,  1105 => 316,  1103 => 315,  1100 => 314,  1077 => 310,  1052 => 309,  1050 => 308,  1047 => 307,  1035 => 302,  1030 => 301,  1028 => 300,  1025 => 299,  1016 => 293,  1010 => 291,  1007 => 290,  1002 => 289,  1000 => 288,  997 => 287,  990 => 282,  983 => 280,  980 => 276,  976 => 275,  973 => 274,  970 => 273,  968 => 272,  965 => 271,  957 => 267,  955 => 266,  952 => 265,  945 => 260,  942 => 259,  934 => 254,  930 => 253,  926 => 252,  923 => 251,  921 => 250,  918 => 249,  910 => 245,  908 => 241,  906 => 240,  903 => 239,  882 => 233,  879 => 232,  876 => 231,  873 => 230,  870 => 229,  867 => 228,  864 => 227,  861 => 226,  858 => 225,  855 => 224,  853 => 223,  850 => 222,  842 => 216,  839 => 215,  837 => 214,  834 => 213,  826 => 209,  823 => 208,  821 => 207,  818 => 206,  810 => 202,  807 => 201,  805 => 200,  802 => 199,  794 => 195,  791 => 194,  789 => 193,  786 => 192,  778 => 188,  775 => 187,  773 => 186,  770 => 185,  762 => 181,  759 => 180,  757 => 179,  754 => 178,  746 => 174,  744 => 173,  741 => 172,  733 => 168,  730 => 167,  728 => 166,  725 => 165,  717 => 161,  714 => 160,  712 => 159,  710 => 158,  707 => 157,  700 => 152,  692 => 151,  687 => 150,  681 => 148,  678 => 147,  676 => 146,  673 => 145,  665 => 139,  663 => 138,  662 => 137,  661 => 136,  660 => 135,  655 => 134,  649 => 132,  646 => 131,  644 => 130,  641 => 129,  632 => 123,  628 => 122,  624 => 121,  620 => 120,  615 => 119,  609 => 117,  606 => 116,  585 => 110,  583 => 109,  580 => 108,  564 => 104,  562 => 103,  559 => 102,  542 => 98,  530 => 96,  523 => 93,  521 => 92,  516 => 91,  495 => 89,  493 => 88,  490 => 87,  481 => 82,  478 => 81,  475 => 80,  469 => 78,  467 => 77,  462 => 76,  459 => 75,  456 => 74,  450 => 72,  448 => 71,  440 => 70,  438 => 69,  435 => 68,  429 => 64,  421 => 62,  416 => 61,  412 => 60,  407 => 59,  405 => 58,  402 => 57,  393 => 52,  387 => 50,  384 => 49,  379 => 47,  369 => 43,  367 => 42,  364 => 41,  356 => 37,  353 => 36,  350 => 35,  347 => 34,  345 => 33,  334 => 27,  323 => 24,  321 => 23,  316 => 22,  314 => 21,  311 => 20,  295 => 16,  292 => 15,  290 => 14,  287 => 13,  278 => 95,  272 => 93,  267 => 4,  264 => 3,  258 => 88,  256 => 87,  248 => 84,  241 => 83,  238 => 320,  236 => 81,  233 => 313,  223 => 74,  220 => 73,  218 => 287,  215 => 286,  210 => 270,  200 => 259,  197 => 258,  195 => 249,  187 => 238,  182 => 57,  176 => 219,  174 => 213,  171 => 212,  164 => 199,  159 => 192,  156 => 51,  154 => 185,  149 => 178,  144 => 47,  141 => 46,  131 => 156,  129 => 42,  126 => 69,  124 => 129,  119 => 114,  116 => 113,  114 => 108,  111 => 107,  106 => 101,  104 => 59,  99 => 68,  96 => 55,  94 => 57,  91 => 56,  86 => 46,  74 => 22,  71 => 18,  69 => 13,  66 => 28,  76 => 31,  61 => 26,  58 => 25,  37 => 8,  22 => 2,  19 => 1,  608 => 144,  604 => 115,  601 => 114,  591 => 38,  588 => 37,  584 => 33,  581 => 32,  576 => 4,  526 => 302,  519 => 297,  513 => 90,  507 => 293,  505 => 292,  501 => 290,  498 => 289,  496 => 288,  436 => 231,  432 => 230,  428 => 229,  382 => 48,  377 => 184,  373 => 183,  351 => 164,  343 => 158,  340 => 157,  335 => 155,  326 => 148,  324 => 111,  320 => 109,  318 => 144,  309 => 142,  299 => 135,  296 => 134,  294 => 133,  288 => 98,  276 => 124,  270 => 121,  262 => 115,  260 => 331,  254 => 328,  246 => 324,  232 => 98,  225 => 95,  216 => 92,  208 => 265,  205 => 264,  202 => 65,  193 => 85,  190 => 239,  185 => 83,  183 => 82,  180 => 81,  169 => 206,  153 => 50,  151 => 184,  148 => 66,  146 => 177,  125 => 45,  123 => 42,  118 => 35,  115 => 64,  109 => 36,  105 => 35,  101 => 86,  93 => 32,  89 => 47,  85 => 24,  81 => 29,  73 => 22,  68 => 21,  64 => 3,  62 => 14,  55 => 13,  49 => 20,  41 => 8,  35 => 6,  33 => 6,  29 => 6,  24 => 4,  348 => 143,  344 => 141,  342 => 32,  339 => 139,  337 => 156,  331 => 134,  329 => 26,  312 => 118,  310 => 106,  304 => 105,  298 => 111,  293 => 108,  282 => 127,  279 => 104,  275 => 94,  271 => 101,  269 => 92,  266 => 91,  259 => 95,  255 => 94,  252 => 327,  250 => 326,  244 => 323,  235 => 86,  231 => 307,  228 => 306,  226 => 299,  222 => 81,  213 => 271,  209 => 68,  203 => 77,  196 => 73,  192 => 62,  184 => 236,  179 => 221,  170 => 62,  166 => 205,  163 => 60,  161 => 198,  152 => 57,  143 => 51,  139 => 165,  136 => 164,  134 => 157,  128 => 45,  121 => 128,  113 => 32,  102 => 58,  97 => 28,  92 => 32,  84 => 25,  79 => 22,  77 => 23,  70 => 29,  56 => 16,  53 => 21,  50 => 14,  44 => 18,  39 => 9,  36 => 7,  30 => 6,);
    }
}
