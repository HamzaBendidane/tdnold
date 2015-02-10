<?php

/* DocumentBundle:Bloc:socialTDNLinks.html.twig */
class __TwigTemplate_2a449a8d349d6aa20a0bf987bd8efdc1 extends Twig_Template
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
        echo "<!-- Bloc pour les boutons sociaux -->
<div class=\"liens-sociaux\" id=\"bloc-liens-sociaux\">
\t<div class=\"liens-tdn\">
\t\t<a href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Document_aime", array("id" => $this->getContext($context, "id"))), "html", null, true);
        echo "\">
\t\t\t<button type=\"button\" class=\"bouton-social bouton-like\" id=\"bouton-like\" onclick=\"ga('send', 'event', 'Like', 'Vote', 'Page', '1');\">";
        // line 5
        echo twig_escape_filter($this->env, $this->getContext($context, "likes"), "html", null, true);
        echo "</button>
\t\t</a>
\t\t<a class=\"popin\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("Nana_partage", array("id" => $this->getContext($context, "id"))), "html", null, true);
        echo "\">
\t\t\t<button type=\"button\" class=\"bouton-social bouton-partage\" id=\"bouton-partage\">Partage</button>
\t\t</a>
\t</div>
\t<div class=\"liens-externes\">
\t\t<div>
\t\t\t<!-- Retweet -->
\t\t\t<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"fr\" data-related=\"TrucDeNana\">Tweeter</a>
\t\t\t<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");
\t\t\t</script>

\t\t\t<!-- Emplacement pour le bouton Like de Facebook -->
\t\t\t<div class=\"fb-like\" data-send=\"false\" data-layout=\"button_count\" data-width=\"450\" data-show-faces=\"true\" data-font=\"lucida grande\" style=\"float:left\"></div>
\t\t</div>
\t\t<div style=\"text-align:left;margin-top:4px\">
\t\t\t<!-- AddThis -->
\t\t\t<!-- AddThis Button BEGIN -->
\t\t\t<a class=\"addthis_button\" href=\"http://addthis.com/bookmark.php?v=250&amp;username=ferdydurke\"><img src=\"http://s7.addthis.com/static/btn/v2/lg-share-en.gif\" width=\"125\" height=\"16\" alt=\"Bookmark and Share\" style=\"border:0\"/></a><script type=\"text/javascript\" src=\"http://s7.addthis.com/js/250/addthis_widget.js#username=ferdydurke\"></script>
\t\t\t<!-- AddThis Button END -->
\t\t</div>\t\t
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "DocumentBundle:Bloc:socialTDNLinks.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 5,  1176 => 331,  1170 => 330,  1164 => 329,  1158 => 328,  1152 => 327,  1146 => 326,  1140 => 325,  1134 => 324,  1128 => 323,  1112 => 317,  1105 => 316,  1103 => 315,  1100 => 314,  1077 => 310,  1052 => 309,  1050 => 308,  1047 => 307,  1035 => 302,  1030 => 301,  1028 => 300,  1025 => 299,  1016 => 293,  1010 => 291,  1007 => 290,  1002 => 289,  1000 => 288,  997 => 287,  990 => 282,  983 => 280,  980 => 276,  976 => 275,  973 => 274,  970 => 273,  968 => 272,  965 => 271,  957 => 267,  955 => 266,  952 => 265,  945 => 260,  942 => 259,  934 => 254,  930 => 253,  926 => 252,  923 => 251,  921 => 250,  918 => 249,  910 => 245,  908 => 241,  906 => 240,  903 => 239,  882 => 233,  879 => 232,  876 => 231,  873 => 230,  870 => 229,  867 => 228,  864 => 227,  861 => 226,  858 => 225,  855 => 224,  853 => 223,  850 => 222,  842 => 216,  839 => 215,  837 => 214,  834 => 213,  826 => 209,  823 => 208,  821 => 207,  818 => 206,  810 => 202,  807 => 201,  805 => 200,  802 => 199,  794 => 195,  791 => 194,  789 => 193,  786 => 192,  778 => 188,  775 => 187,  773 => 186,  770 => 185,  762 => 181,  759 => 180,  757 => 179,  754 => 178,  746 => 174,  744 => 173,  741 => 172,  733 => 168,  730 => 167,  728 => 166,  725 => 165,  717 => 161,  714 => 160,  712 => 159,  710 => 158,  707 => 157,  700 => 152,  692 => 151,  687 => 150,  681 => 148,  678 => 147,  676 => 146,  673 => 145,  665 => 139,  663 => 138,  662 => 137,  661 => 136,  660 => 135,  655 => 134,  649 => 132,  646 => 131,  644 => 130,  641 => 129,  632 => 123,  628 => 122,  624 => 121,  620 => 120,  615 => 119,  609 => 117,  606 => 116,  585 => 110,  583 => 109,  580 => 108,  564 => 104,  562 => 103,  559 => 102,  542 => 98,  530 => 96,  523 => 93,  521 => 92,  516 => 91,  495 => 89,  493 => 88,  490 => 87,  481 => 82,  478 => 81,  475 => 80,  469 => 78,  467 => 77,  462 => 76,  459 => 75,  456 => 74,  450 => 72,  448 => 71,  440 => 70,  438 => 69,  435 => 68,  429 => 64,  421 => 62,  416 => 61,  412 => 60,  407 => 59,  405 => 58,  402 => 57,  393 => 52,  387 => 50,  384 => 49,  379 => 47,  369 => 43,  367 => 42,  364 => 41,  356 => 37,  353 => 36,  350 => 35,  347 => 34,  345 => 33,  334 => 27,  323 => 24,  321 => 23,  316 => 22,  314 => 21,  311 => 20,  295 => 16,  292 => 15,  290 => 14,  287 => 13,  278 => 8,  272 => 6,  267 => 4,  264 => 3,  258 => 330,  256 => 329,  248 => 325,  241 => 322,  238 => 320,  236 => 314,  233 => 313,  223 => 298,  220 => 296,  218 => 287,  215 => 286,  210 => 270,  200 => 259,  197 => 258,  195 => 249,  187 => 238,  182 => 222,  176 => 219,  174 => 213,  171 => 212,  164 => 199,  159 => 192,  156 => 191,  154 => 185,  149 => 178,  144 => 172,  141 => 171,  131 => 156,  129 => 145,  126 => 144,  124 => 129,  119 => 114,  116 => 113,  114 => 108,  111 => 107,  106 => 101,  104 => 87,  99 => 68,  96 => 67,  94 => 57,  91 => 56,  86 => 46,  74 => 20,  71 => 19,  69 => 13,  66 => 12,  76 => 31,  61 => 2,  58 => 25,  37 => 9,  22 => 3,  19 => 1,  608 => 144,  604 => 115,  601 => 114,  591 => 38,  588 => 37,  584 => 33,  581 => 32,  576 => 4,  526 => 302,  519 => 297,  513 => 90,  507 => 293,  505 => 292,  501 => 290,  498 => 289,  496 => 288,  436 => 231,  432 => 230,  428 => 229,  382 => 48,  377 => 184,  373 => 183,  351 => 164,  343 => 158,  340 => 157,  335 => 155,  326 => 148,  324 => 147,  320 => 145,  318 => 144,  309 => 142,  299 => 135,  296 => 134,  294 => 133,  288 => 130,  276 => 124,  270 => 121,  262 => 115,  260 => 331,  254 => 328,  246 => 324,  232 => 98,  225 => 95,  216 => 92,  208 => 265,  205 => 264,  202 => 262,  193 => 85,  190 => 239,  185 => 83,  183 => 82,  180 => 81,  169 => 206,  153 => 68,  151 => 184,  148 => 66,  146 => 177,  125 => 45,  123 => 37,  118 => 35,  115 => 34,  109 => 102,  105 => 30,  101 => 86,  93 => 27,  89 => 47,  85 => 25,  81 => 40,  73 => 22,  68 => 21,  64 => 3,  62 => 14,  55 => 13,  49 => 12,  41 => 8,  35 => 6,  33 => 7,  29 => 4,  24 => 4,  348 => 143,  344 => 141,  342 => 32,  339 => 139,  337 => 156,  331 => 134,  329 => 26,  312 => 118,  310 => 117,  304 => 113,  298 => 111,  293 => 108,  282 => 127,  279 => 104,  275 => 103,  271 => 101,  269 => 5,  266 => 99,  259 => 95,  255 => 94,  252 => 327,  250 => 326,  244 => 323,  235 => 86,  231 => 307,  228 => 306,  226 => 299,  222 => 81,  213 => 271,  209 => 78,  203 => 77,  196 => 73,  192 => 248,  184 => 236,  179 => 221,  170 => 62,  166 => 205,  163 => 60,  161 => 198,  152 => 57,  143 => 51,  139 => 165,  136 => 164,  134 => 157,  128 => 45,  121 => 128,  113 => 32,  102 => 34,  97 => 28,  92 => 32,  84 => 41,  79 => 32,  77 => 23,  70 => 29,  56 => 12,  53 => 22,  50 => 10,  44 => 7,  39 => 6,  36 => 5,  30 => 6,);
    }
}
