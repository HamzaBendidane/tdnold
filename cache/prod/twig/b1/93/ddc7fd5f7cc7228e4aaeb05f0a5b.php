<?php

/* CoreBundle:Mail:notification.html.twig */
class __TwigTemplate_b193ddc7fd5f7cc7228e4aaeb05f0a5b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'corps' => array($this, 'block_corps'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>Trucs de Nanas</title>
<style type=\"text/css\">
<!--
body {
\tmargin-left: 0px;
\tmargin-top: 0px;
\tmargin-right: 0px;
\tmargin-bottom: 0px;
}
-->
</style></head>

<body text=\"#000000\" link=\"#752670\" vlink=\"#752670\" alink=\"#752670\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">
<table width=\"526\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
  <tr>
    <td colspan=\"2\" rowspan=\"3\" align=\"left\" valign=\"bottom\">
      <table width=\"126\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td width=\"17\" align=\"left\" valign=\"bottom\">
            <img src=\"http://www.trucdenana.com";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/bord_gauche_avatar.gif"), "html", null, true);
        echo "\" width=\"17\" height=\"105\" />
          </td>
          <td width=\"107\" align=\"center\" valign=\"middle\" bgcolor=\"#FFCCFF\">
            ";
        // line 26
        if (array_key_exists("sender", $context)) {
            // line 27
            echo "            <img src=\"http://www.trucdenana.com";
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->mailAvatarFunction($this->getContext($context, "sender"), "sqr_"), "html", null, true);
            echo "\" width=\"102\" height=\"102\" alt=\"avatar\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            ";
        } else {
            // line 29
            echo "            <img src=\"http://www.trucdenana.com";
            echo twig_escape_filter($this->env, $this->env->getExtension('remplacement_extension')->mailAvatarFunction(""), "html", null, true);
            echo "\" width=\"102\" height=\"102\" alt=\"avatar\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            ";
        }
        // line 31
        echo "          </td>
        </tr>
      </table>
    </td>
    <td height=\"123\" colspan=\"4\"  align=\"left\" valign=\"top\">
      <a href=\"http://www.trucdenana.com\" target=\"_blank\">
        <img src=\"http://www.trucdenana.com";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/top.jpg"), "html", null, true);
        echo "\" width=\"516\" height=\"128\" alt=\"Trucs De Nanas\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
      </a>
    </td>
  </tr>
  <tr>
    <td width=\"14\" height=\"29\">&nbsp;</td>
    <td width=\"367\" align=\"left\" valign=\"middle\" style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;\">
      <strong>De ";
        // line 44
        echo twig_escape_filter($this->env, $this->getContext($context, "expediteur"), "html", null, true);
        echo "</strong><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; color:#666666;\"> / ";
        echo twig_escape_filter($this->env, $this->getContext($context, "role"), "html", null, true);
        echo "</span>
    </td>
    <td width=\"128\" align=\"right\" valign=\"middle\" style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; color:#666666;\">";
        // line 46
        echo twig_escape_filter($this->env, $this->getContext($context, "dateEnvoi"), "html", null, true);
        echo "</td>
    <td width=\"11\">&nbsp;</td>
  </tr>
  <tr>
    <td height=\"19\" colspan=\"4\" align=\"left\" valign=\"bottom\">
      <img src=\"http://www.trucdenana.com";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/ligne.gif"), "html", null, true);
        echo "\" width=\"516\" height=\"19\" /></td>
  </tr>
  <tr>
    <td width=\"17\" height=\"40\" bgcolor=\"#F3F8FC\">&nbsp;</td>
    <td width=\"109\" bgcolor=\"#F3F8FC\">&nbsp;</td>
    <td colspan=\"4\" align=\"right\" valign=\"top\" bgcolor=\"#F3F8FC\">
      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td align=\"left\" valign=\"top\">
            <a href=\"https://www.facebook.com/trucdenana\" target=\"_blank\">
              <img src=\"http://www.trucdenana.com";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/facebook.gif"), "html", null, true);
        echo "\" width=\"36\" height=\"32\" alt=\"Groupe Facebook TDN\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            </a>
          </td>
          <td align=\"left\" valign=\"top\">
            <a href=\"http://www.twitter.com/Trucdenana\" target=\"_blank\">
              <img src=\"http://www.trucdenana.com";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/twitter.gif"), "html", null, true);
        echo "\" width=\"35\" height=\"32\" alt=\"Suivre sur Twitter\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            </a>
          </td>
          <td align=\"left\" valign=\"top\">
            <a href=\"http://www.hellocoton.fr/mapage/trucdenana\">
              <img src=\"http://www.trucdenana.com";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/com.gif"), "html", null, true);
        echo "\" width=\"36\" height=\"32\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            </a>
          </td>
          <td align=\"left\" valign=\"top\">
            <a href=\"http://www.instagram.com/justine_trucsdenana\">
              <img src=\"http://www.trucdenana.com";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/instagram.gif"), "html", null, true);
        echo "\" width=\"36\" height=\"32\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
            </a>
          </td>
          <td align=\"left\" valign=\"top\">
            <a href=\"itms://itunes.apple.com/fr/app/truc-de-nana/id369735750?mt=8\" target=\"_blank\">
              <img src=\"http://www.trucdenana.com";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/appli.gif"), "html", null, true);
        echo "\" width=\"54\" height=\"32\" alt=\"Appli TDN Apple store\"  style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\"/>
            </a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height=\"104\" bgcolor=\"#F3F8FC\">&nbsp;</td>
    <td colspan=\"4\" align=\"center\" valign=\"top\" bgcolor=\"#F3F8FC\">
      <table width=\"574\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family:Arial,Helvetica,sans-serif;font-size:14px; color:#000;\">
        <tr>
          <td height=\"24\" colspan=\"2\" align=\"left\" valign=\"top\">Bonjour <strong>";
        // line 93
        echo twig_escape_filter($this->env, $this->getContext($context, "destinataire"), "html", null, true);
        echo "</strong>,</td>
        </tr>
        <tr>
          <td width=\"53\">&nbsp;</td>
          <td width=\"521\" align=\"left\" valign=\"top\">
            ";
        // line 98
        $this->displayBlock('corps', $context, $blocks);
        // line 99
        echo "          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align=\"right\" valign=\"top\" style=\"padding-top:14px;font-style:italic\">Bien à toi, L'équipe TDN</td>
        </tr>
      </table>
    </td>
    <td bgcolor=\"#F3F8FC\">&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"6\">
      <a href=\"http://www.trucsdenana.com";
        // line 111
        if (array_key_exists("mailTargetPage", $context)) {
            echo "/";
            echo twig_escape_filter($this->env, $this->getContext($context, "mailtargetPage"), "html", null, true);
        }
        echo "\">
        <img src=\"http://www.trucdenana.com";
        // line 112
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/mytdn.jpg"), "html", null, true);
        echo "\" width=\"640\" height=\"69\" alt=\"MyTDN\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; display: block;\" />
      </a>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan=\"4\" align=\"right\" valign=\"top\">
      <img src=\"http://www.trucdenana.com";
        // line 120
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("assets/images/theme/mails/aufeminin.gif"), "html", null, true);
        echo "\" width=\"293\" height=\"52\" alt=\"AuFeminin.com\" style=\"outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;\" />
    </td>
  </tr>
</table>
</body>
</html>
";
    }

    // line 98
    public function block_corps($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "CoreBundle:Mail:notification.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 98,  199 => 120,  188 => 112,  181 => 111,  167 => 99,  165 => 98,  157 => 93,  142 => 81,  134 => 76,  126 => 71,  118 => 66,  110 => 61,  97 => 51,  89 => 46,  82 => 44,  72 => 37,  64 => 31,  52 => 27,  50 => 26,  44 => 23,  20 => 1,  58 => 29,  49 => 9,  45 => 8,  40 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
