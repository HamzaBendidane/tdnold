<?php

namespace TDN\ConcoursBundle\Participation;

use TDN\NanaBundle\Entity\Nana;

class Participant
{
  protected $mailer;
  protected $renderer;

  public function __construct($mailer, $renderer)
  {
    $this->mailer = $mailer;
    $this->renderer = $renderer;
  }

  /**
   * Construit et associe à un document les objets Tag issus de la liste
   * des mots-clefs donnés dans le cham de formulaire
   *
   * @param ConcoursParticipant $participant
   */
  public function forwardConcours($participant) {

    $adresses = json_decode($participant->getInvitations());
    if (!empty($adresses)) {

      // Setup des variables du gabarit Twig
      $corps['expediteur'] = "Justine";
      $corps['role'] = "Rédaction";
      $corps['destinataire'] = "";
      $corps['dateEnvoi'] = date(' d m Y - H:i:s');
      $corps['id'] = $participant->getLnConcours()->getIdDocument();
      $corps['slug'] = $participant->getLnConcours()->getSlug();
      $corps['titre'] = $participant->getLnConcours()->getTitre();
      // Scan des adresses données par le joueur
      foreach ($adresses as $a) {
        $destinataire = trim($a, '"');
        if ($participant->getLnParticipant() instanceof Nana) {
          $prenom = $participant->getLnParticipant()->getPrenom();
          if (is_null($prenom)) {
            $corps['sender'] = $participant->getLnParticipant()->getEmail();
          } else {
            $corps['sender'] = $prenom.' '.$participant->getLnParticipant()->getNom();
          }
        } else {
            $corps['sender'] = 'Un(e) ami(e)';
        }

        $message = \Swift_Message::newInstance();

        $message->setSubject('[Trucsdenana.com] Un(e) ami(e) te signale un jeu-concours')
                ->setContentType('text/html')
                ->setFrom('postmaster@trucdenana.com')
                ->setTo($destinataire)
                // ->setTo('michel.cadennes@sens-commun.fr')
                ->setBody($this->renderer->render('ConcoursBundle:Mail:forwardInvitation.html.twig', $corps));
        $this->mailer->send($message);
      }
    }
    return true;
  }
}