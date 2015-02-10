<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // slider_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\SliderBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'slider_homepage'));
        }

        // login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::loginAction',  '_route' => 'login',);
        }

        // login_check
        if ($pathinfo === '/login_check') {
            return array('_route' => 'login_check');
        }

        // logout
        if ($pathinfo === '/logout') {
            return array('_route' => 'logout');
        }

        // advertise_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\AdvertiseBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'advertise_homepage'));
        }

        // Newsletter_simpleInscription
        if ($pathinfo === '/newsletter/inscription') {
            return array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\PublicController::simpleInscriptionAction',  '_route' => 'Newsletter_simpleInscription',);
        }

        // Newsletter_desinscription
        if (0 === strpos($pathinfo, '/newsletter/desinscription') && preg_match('#^/newsletter/desinscription/(?<clef>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\PublicController::desinscriptionAction',)), array('_route' => 'Newsletter_desinscription'));
        }

        // Newsletter_index
        if ($pathinfo === '/admin/newsletter/index') {
            return array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::indexAction',  '_route' => 'Newsletter_index',);
        }

        // Newsletter_preparation
        if ($pathinfo === '/admin/newsletter/preparation') {
            return array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::preparationAction',  '_route' => 'Newsletter_preparation',);
        }

        // Newsletter_preview
        if (0 === strpos($pathinfo, '/admin/newsletter/preview') && preg_match('#^/admin/newsletter/preview/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::previewAction',)), array('_route' => 'Newsletter_preview'));
        }

        // Newsletter_apercu
        if (0 === strpos($pathinfo, '/newsletter/apercu') && preg_match('#^/newsletter/apercu/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::previewAction',)), array('_route' => 'Newsletter_apercu'));
        }

        // Newsletter_reviser
        if (0 === strpos($pathinfo, '/admin/newsletter/revision') && preg_match('#^/admin/newsletter/revision/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::reviserAction',)), array('_route' => 'Newsletter_reviser'));
        }

        // Newsletter_programmer
        if (0 === strpos($pathinfo, '/admin/newsletter/programmation') && preg_match('#^/admin/newsletter/programmation/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::programmerAction',)), array('_route' => 'Newsletter_programmer'));
        }

        // Newsletter_envoyerAbonnesAnonymes
        if (0 === strpos($pathinfo, '/admin/newsletter/envoi/anonyme') && preg_match('#^/admin/newsletter/envoi/anonyme/(?<debut>[^/]+)/(?<fin>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::envoyerAbonnesAnonymesAction',)), array('_route' => 'Newsletter_envoyerAbonnesAnonymes'));
        }

        // Newsletter_envoyerNanas
        if (0 === strpos($pathinfo, '/admin/newsletter/envoi/nanas') && preg_match('#^/admin/newsletter/envoi/nanas/(?<debut>[^/]+)/(?<lot>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::envoyerNanasAction',)), array('_route' => 'Newsletter_envoyerNanas'));
        }

        // Newsletter_envoyer
        if ($pathinfo === '/cron/newsletter/envoi') {
            return array (  '_controller' => 'TDN\\NewsletterBundle\\Controller\\AdminController::envoyerAction',  '_route' => 'Newsletter_envoyer',);
        }

        // Newsletter_v2Index
        if (0 === strpos($pathinfo, '/newsletter') && preg_match('#^/newsletter\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',)), array('_route' => 'Newsletter_v2Index'));
        }

        // Nana_choixNanaDeLaSemaine
        if ($pathinfo === '/cron/nana-de-la-semaine/choisir') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::choixNanaDeLaSemaineAction',  '_route' => 'Nana_choixNanaDeLaSemaine',);
        }

        // Nana_choixNanaEscarpins
        if ($pathinfo === '/cron/tirage-escarpins') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::choixEscarpinsMensuelAction',  '_route' => 'Nana_choixNanaEscarpins',);
        }

        // Nana_preChoixNanaEscarpins
        if ($pathinfo === '/cron/pre-tirage-escarpins') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::preEscarpinsMensuelAction',  '_route' => 'Nana_preChoixNanaEscarpins',);
        }

        // Nana_resetPopularite
        if (0 === strpos($pathinfo, '/cron/reset-popularite') && preg_match('#^/cron/reset\\-popularite/(?<debut>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\MigrationController::resetPopulariteAction',)), array('_route' => 'Nana_resetPopularite'));
        }

        // NanaBundle_login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::loginAction',  '_route' => 'NanaBundle_login',);
        }

        // NanaBundle_popinLogin
        if ($pathinfo === '/popinlogin') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::popinLoginAction',  '_route' => 'NanaBundle_popinLogin',);
        }

        // NanaBundle_logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::loginAction',  '_route' => 'NanaBundle_logout',);
        }

        // NanaBundle_registerForm
        if ($pathinfo === '/inscription') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::registerAction',  '_route' => 'NanaBundle_registerForm',);
        }

        // NanaBundle_registerFormConcours
        if ($pathinfo === '/inscription/concours') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::registerConcoursAction',  '_route' => 'NanaBundle_registerFormConcours',);
        }

        // NanaBundle_registerCheck
        if ($pathinfo === '/registerCheck') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::registerCheckAction',  '_route' => 'NanaBundle_registerCheck',);
        }

        // NanaBundle_myProfil
        if ($pathinfo === '/my-tdn/profil') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::showMyProfilAction',  '_route' => 'NanaBundle_myProfil',);
        }

        // NanaBundle_myProfilUpdate
        if ($pathinfo === '/my-tdn/profil/update') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::updateProfilAction',  '_route' => 'NanaBundle_myProfilUpdate',);
        }

        // NanaBundle_myAvatarUpdate
        if ($pathinfo === '/my-tdn/profil/update-avatar') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::updateAvatarAction',  '_route' => 'NanaBundle_myAvatarUpdate',);
        }

        // NanaBundle_myGalerieUpdate
        if ($pathinfo === '/my-tdn/profil/update-galerie') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::updateGalerieAction',  '_route' => 'NanaBundle_myGalerieUpdate',);
        }

        // Nana_supprimerElementGalerie
        if (0 === strpos($pathinfo, '/my-tdn/profil/galerie/enlever-image') && preg_match('#^/my\\-tdn/profil/galerie/enlever\\-image/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::supprimerElementGalerieAction',)), array('_route' => 'Nana_supprimerElementGalerie'));
        }

        // NanaBundle_myProfilClose
        if ($pathinfo === '/my-tdn/profil/close') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::closeProfilAction',  '_route' => 'NanaBundle_myProfilClose',);
        }

        // NanaBundle_profil
        if (0 === strpos($pathinfo, '/profil') && preg_match('#^/profil/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::showProfilAction',)), array('_route' => 'NanaBundle_profil'));
        }

        // NanaBundle_follow
        if (0 === strpos($pathinfo, '/follow') && preg_match('#^/follow/(?<nana>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::followAction',)), array('_route' => 'NanaBundle_follow'));
        }

        // NanaBundle_rechercheNanas
        if ($pathinfo === '/recherche/nanas') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::rechercheNanasAction',  '_route' => 'NanaBundle_rechercheNanas',);
        }

        // Nana_messagePriveShow
        if (0 === strpos($pathinfo, '/message-prive') && preg_match('#^/message\\-prive/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::messagePriveAction',)), array('_route' => 'Nana_messagePriveShow'));
        }

        // Nana_messagePriveSend
        if ($pathinfo === '/message-prive') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::messagePriveAction',  '_route' => 'Nana_messagePriveSend',);
        }

        // Nana_partage
        if (0 === strpos($pathinfo, '/partage/contenu') && preg_match('#^/partage/contenu/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::partageAction',)), array('_route' => 'Nana_partage'));
        }

        // Nana_partageSend
        if ($pathinfo === '/partage/envoi') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\PublicController::partageAction',  '_route' => 'Nana_partageSend',);
        }

        // NanaBundle_myHobbyAdd
        if ($pathinfo === '/my-tdn/profil/hobby/add') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\HobbyController::addAction',  '_route' => 'NanaBundle_myHobbyAdd',);
        }

        // NanaBundle_myHobbyModifier
        if ($pathinfo === '/my-tdn/profil/hobby/modifier') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\HobbyController::modifierAction',  '_route' => 'NanaBundle_myHobbyModifier',);
        }

        // Nana_ajouterImageHobby
        if ($pathinfo === '/my-tdn/profil/hobby/ajouter-image') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\HobbyController::ajouterImageAction',  '_route' => 'Nana_ajouterImageHobby',);
        }

        // Nana_supprimerImageHobby
        if (0 === strpos($pathinfo, '/my-tdn/profil/hobby/supprimer-image') && preg_match('#^/my\\-tdn/profil/hobby/supprimer\\-image/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\HobbyController::supprimerImageAction',)), array('_route' => 'Nana_supprimerImageHobby'));
        }

        // Nana_passwordResetS1
        if ($pathinfo === '/mot-de-passe-oublie') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::passwordResetS1Action',  '_route' => 'Nana_passwordResetS1',);
        }

        // Nana_passwordResetS2
        if ($pathinfo === '/mot-de-passe/confirmer') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::passwordResetS2Action',  '_route' => 'Nana_passwordResetS2',);
        }

        // Nana_passwordResetS3
        if ($pathinfo === '/mot-de-passe/restaurer') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::passwordResetS3Action',  '_route' => 'Nana_passwordResetS3',);
        }

        // Nana_passwordResetFinal
        if ($pathinfo === '/mot-de-passe/valider') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\SecurityController::passwordResetFinalAction',  '_route' => 'Nana_passwordResetFinal',);
        }

        // NanaBundle_log
        if ($pathinfo === '/admin/profils/log') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::logAction',  '_route' => 'NanaBundle_log',);
        }

        // NanaBundle_creer
        if ($pathinfo === '/admin/profil/new') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::newProfilAction',  '_route' => 'NanaBundle_creer',);
        }

        // NanaBundle_editer
        if (0 === strpos($pathinfo, '/admin/profil/editer') && preg_match('#^/admin/profil/editer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::editerAction',)), array('_route' => 'NanaBundle_editer'));
        }

        // NanaBundle_manage
        if (0 === strpos($pathinfo, '/admin/profil/manage') && preg_match('#^/admin/profil/manage/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::manageAction',)), array('_route' => 'NanaBundle_manage'));
        }

        // NanaBundle_supprimer
        if (0 === strpos($pathinfo, '/admin/profil/supprimer') && preg_match('#^/admin/profil/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'NanaBundle_supprimer'));
        }

        // NanaBundle_addBlacklist
        if (0 === strpos($pathinfo, '/admin/profil/blacklist/add') && preg_match('#^/admin/profil/blacklist/add/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::blacklistAddAction',)), array('_route' => 'NanaBundle_addBlacklist'));
        }

        // NanaBundle_regsiterNewsletter
        if ($pathinfo === '/admin/profil/newsletter/register') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::newsletterRegisterAction',  '_route' => 'NanaBundle_regsiterNewsletter',);
        }

        // NanaBundle_unregisterNewsletter
        if ($pathinfo === '/admin/profil/newsletter/unregister') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminController::newsletterUnregisterAction',  '_route' => 'NanaBundle_unregisterNewsletter',);
        }

        // NanaBundle_rolesIndex
        if ($pathinfo === '/admin/roles/index') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::rolesIndexAction',  '_route' => 'NanaBundle_rolesIndex',);
        }

        // NanaBundle_roleAccredites
        if (0 === strpos($pathinfo, '/admin/roles') && preg_match('#^/admin/roles/(?<role>[^/]+)/accredites$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::roleAccreditesAction',)), array('_route' => 'NanaBundle_roleAccredites'));
        }

        // NanaBundle_roleAdd
        if ($pathinfo === '/admin/role/creer') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::roleAddAction',  '_route' => 'NanaBundle_roleAdd',);
        }

        // NanaBundle_roleSupprimer
        if (0 === strpos($pathinfo, '/admin/role/supprimer') && preg_match('#^/admin/role/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::roleSupprimerAction',)), array('_route' => 'NanaBundle_roleSupprimer'));
        }

        // NanaRole_ajouterCredit
        if ($pathinfo === '/admin/credit/ajouter') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::ajouteCreditrAction',  '_route' => 'NanaRole_ajouterCredit',);
        }

        // NanaRole_supprimerCredit
        if (0 === strpos($pathinfo, '/admin/credit') && preg_match('#^/admin/credit/(?<role_id>[^/]+)/supprimer/(?<nana_id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AdminRolesController::supprimerCreditAction',)), array('_route' => 'NanaRole_supprimerCredit'));
        }

        // Nana_migration
        if (0 === strpos($pathinfo, '/migration/nanas') && preg_match('#^/migration/nanas/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Nana_migration'));
        }

        // Nana_makeAvatars
        if (0 === strpos($pathinfo, '/migration/make-avatars') && preg_match('#^/migration/make\\-avatars/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\MigrationController::makeAvatarsAction',)), array('_route' => 'Nana_makeAvatars'));
        }

        // Nana_usernamechecker
        if (0 === strpos($pathinfo, '/usernamechecker') && preg_match('#^/usernamechecker\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AjaxController::usernameCheckerAction',)), array('_route' => 'Nana_usernamechecker'));
        }

        // Nana_mailchecker
        if (0 === strpos($pathinfo, '/mailchecker') && preg_match('#^/mailchecker\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\AjaxController::mailCheckerAction',)), array('_route' => 'Nana_mailchecker'));
        }

        // Nana_iOSTestRegister
        if ($pathinfo === '/ios/test/inscription') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::testRegisterAction',  '_route' => 'Nana_iOSTestRegister',);
        }

        // Nana_iOSRegister
        if ($pathinfo === '/ios/my-tdn/profil/creer') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::registerCheckAction',  '_route' => 'Nana_iOSRegister',);
        }

        // Nana_iOSRegisterJSON
        if (0 === strpos($pathinfo, '/ios/my-tdn/profil/creer') && preg_match('#^/ios/my\\-tdn/profil/creer\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::registerCheckAction',)), array('_route' => 'Nana_iOSRegisterJSON'));
        }

        // Nana_iOSMyProfilUpdate
        if ($pathinfo === '/ios/my-tdn/profil/update') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::updateProfilAction',  '_route' => 'Nana_iOSMyProfilUpdate',);
        }

        // Nana_iOSConnect
        if ($pathinfo === '/ios/connect') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::connectAction',  '_route' => 'Nana_iOSConnect',);
        }

        // Nana_iOSLogin
        if ($pathinfo === '/ios/login') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::loginAction',  '_route' => 'Nana_iOSLogin',);
        }

        // Nana_iOSPasswordReset
        if ($pathinfo === '/ios/mot-de-passe-oublie') {
            return array (  '_controller' => 'TDN\\NanaBundle\\Controller\\IOSController::passwordResetAction',  '_route' => 'Nana_iOSPasswordReset',);
        }

        // profil_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProfilBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'profil_homepage'));
        }

        // DossierLegacy_orphan1
        if (0 === strpos($pathinfo, '/dossier/fil') && preg_match('#^/dossier/fil/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',)), array('_route' => 'DossierLegacy_orphan1'));
        }

        // DossierLegacy_orphan2
        if (0 === strpos($pathinfo, '/dossier') && preg_match('#^/dossier/(?<slug>[^/,]+),(?<id>[^,\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',)), array('_route' => 'DossierLegacy_orphan2'));
        }

        // DossierLegacy_orphan3
        if (preg_match('#^/(?<slug>[^/,]+),dos\\-(?<id>[^\\-]+)\\-(?<ordre>[^\\-\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',)), array('_route' => 'DossierLegacy_orphan3'));
        }

        // DossierLegacy_orphanBancEssai
        if (preg_match('#^/(?<slug>[^/,]+),ban\\-(?<id>[^\\-]+)\\-(?<ordre>[^\\-\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',)), array('_route' => 'DossierLegacy_orphanBancEssai'));
        }

        // DossierLegacy_orphan4
        if (preg_match('#^/(?<rubrique>[^/]+)/dossierdumois/node/(?<slug>[^/,]+),(?<id>[^,]+),(?<ordre>[^,\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',)), array('_route' => 'DossierLegacy_orphan4'));
        }

        // DossierRedaction_sommaire
        if ($pathinfo === '/dossiers-de-la-redaction') {
            return array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::sommaireAction',  '_route' => 'DossierRedaction_sommaire',);
        }

        // DossierRedaction_dossier
        if (preg_match('#^/(?<rubrique>[^/]+)/dossier/(?<id>[^/]+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::dossierAction',)), array('_route' => 'DossierRedaction_dossier'));
        }

        // DossierRedaction_feuillet
        if (preg_match('#^/(?<rubrique>[^/]+)/dossier/feuillet/(?<id>[^/]+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\PublicationController::feuilletAction',)), array('_route' => 'DossierRedaction_feuillet'));
        }

        // DossierRedaction_index
        if ($pathinfo === '/admin/dossiers-de-la-redaction/index') {
            return array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\AdminDossierController::indexAction',  '_route' => 'DossierRedaction_index',);
        }

        // DossierRedaction_creer
        if ($pathinfo === '/admin/dossiers-de-la-redaction/creer') {
            return array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\AdminDossierController::creerAction',  '_route' => 'DossierRedaction_creer',);
        }

        // DossierRedaction_relire
        if (0 === strpos($pathinfo, '/admin/dossiers-de-la-redaction/reviser') && preg_match('#^/admin/dossiers\\-de\\-la\\-redaction/reviser/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\AdminDossierController::reviserAction',)), array('_route' => 'DossierRedaction_relire'));
        }

        // DossierRedaction_publier
        if (0 === strpos($pathinfo, '/admin/dossiers-de-la-redaction/publier') && preg_match('#^/admin/dossiers\\-de\\-la\\-redaction/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\AdminDossierController::publierAction',)), array('_route' => 'DossierRedaction_publier'));
        }

        // DossierRedaction_supprimer
        if (0 === strpos($pathinfo, '/admin/dossiers-de-la-redaction/supprimer') && preg_match('#^/admin/dossiers\\-de\\-la\\-redaction/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\AdminDossierController::supprimerAction',)), array('_route' => 'DossierRedaction_supprimer'));
        }

        // DossierRedaction_migration
        if (0 === strpos($pathinfo, '/migration/dossiers-de-la-redaction/dossiers') && preg_match('#^/migration/dossiers\\-de\\-la\\-redaction/dossiers/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\DossierMigrationController::migrationAction',)), array('_route' => 'DossierRedaction_migration'));
        }

        // DossierRedaction_migrationFeuillets
        if (0 === strpos($pathinfo, '/migration/dossiers-de-la-redaction/feuillets') && preg_match('#^/migration/dossiers\\-de\\-la\\-redaction/feuillets/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DossierRedactionBundle\\Controller\\DossierMigrationController::migrationFeuilletsAction',)), array('_route' => 'DossierRedaction_migrationFeuillets'));
        }

        // BreveBundle_proposer
        if ($pathinfo === '/info/proposer') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\PublicController::breveProposerAction',  '_route' => 'BreveBundle_proposer',);
        }

        // BreveBundle_poster
        if ($pathinfo === '/info/poster') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\PublicController::brevePosterAction',  '_route' => 'BreveBundle_poster',);
        }

        // BreveBundle_fil
        if ($pathinfo === '/info/fil') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\PublicController::filAction',  '_route' => 'BreveBundle_fil',);
        }

        // BreveBundle_filPerso
        if (0 === strpos($pathinfo, '/info/fil/perso') && preg_match('#^/info/fil/perso/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\PublicController::filPersoAction',)), array('_route' => 'BreveBundle_filPerso'));
        }

        // BreveBundle_breveLog
        if ($pathinfo === '/admin/info/index') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::logAction',  '_route' => 'BreveBundle_breveLog',);
        }

        // Breve_ajouter
        if ($pathinfo === '/admin/info/ajouter') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::ajouterAction',  '_route' => 'Breve_ajouter',);
        }

        // BreveBundle_adminEnregistrer
        if ($pathinfo === '/admin/info/enregistrer') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::enregistrerAction',  '_route' => 'BreveBundle_adminEnregistrer',);
        }

        // BreveBundle_editer
        if (0 === strpos($pathinfo, '/admin/info/editer') && preg_match('#^/admin/info/editer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::editerAction',)), array('_route' => 'BreveBundle_editer'));
        }

        // BreveBundle_supprimer
        if (0 === strpos($pathinfo, '/admin/info/supprimer') && preg_match('#^/admin/info/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'BreveBundle_supprimer'));
        }

        // BreveBundle_publier
        if (0 === strpos($pathinfo, '/admin/info/publier') && preg_match('#^/admin/info/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::publierAction',)), array('_route' => 'BreveBundle_publier'));
        }

        // BreveBundle_addBlacklist
        if (0 === strpos($pathinfo, '/admin/info/blacklist') && preg_match('#^/admin/info/blacklist/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\AdminController::blacklistAction',)), array('_route' => 'BreveBundle_addBlacklist'));
        }

        // Breve_migration
        if (0 === strpos($pathinfo, '/migration/breves') && preg_match('#^/migration/breves/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Breve_migration'));
        }

        // Breve_import
        if ($pathinfo === '/import/breves') {
            return array (  '_controller' => 'TDN\\BreveBundle\\Controller\\MigrationController::importAction',  '_route' => 'Breve_import',);
        }

        // Breve_sommaireLegacy
        if (preg_match('#^/(?<rubrique>[^/]+)/infos/fil/index\\.(?<_format>html|php)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\BreveBundle\\Controller\\LegacyController::indexAction',)), array('_route' => 'Breve_sommaireLegacy'));
        }

        // CauseuseBundle_index
        if ($pathinfo === '/admin/question-de-nanas/index') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::indexAction',  '_route' => 'CauseuseBundle_index',);
        }

        // CauseuseBundle_pending
        if ($pathinfo === '/admin/question-de-nanas/attente') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::pendingAction',  '_route' => 'CauseuseBundle_pending',);
        }

        // CauseuseBundle_editer
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/modifier') && preg_match('#^/admin/question\\-de\\-nanas/modifier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::modifierAction',)), array('_route' => 'CauseuseBundle_editer'));
        }

        // CauseuseBundle_publier
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/publier') && preg_match('#^/admin/question\\-de\\-nanas/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::publierAction',)), array('_route' => 'CauseuseBundle_publier'));
        }

        // CauseuseBundle_transferer
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/transferer') && preg_match('#^/admin/question\\-de\\-nanas/transferer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::transfererAction',)), array('_route' => 'CauseuseBundle_transferer'));
        }

        // CauseuseBundle_repondre
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/repondre') && preg_match('#^/admin/question\\-de\\-nanas/repondre/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::repondreAction',)), array('_route' => 'CauseuseBundle_repondre'));
        }

        // CauseuseBundle_supprimer
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/supprimer') && preg_match('#^/admin/question\\-de\\-nanas/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'CauseuseBundle_supprimer'));
        }

        // Causeuse_reponseSupprimer
        if (0 === strpos($pathinfo, '/admin/question-de-nanas/reponse/supprimer') && preg_match('#^/admin/question\\-de\\-nanas/reponse/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\ReponseAdminController::reponseSupprimerAction',)), array('_route' => 'Causeuse_reponseSupprimer'));
        }

        // CauseuseBundle_sommaire
        if ($pathinfo === '/questions-de-nanas') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::sommaireAction',  '_route' => 'CauseuseBundle_sommaire',);
        }

        // CauseuseBundle_conversation
        if (preg_match('#^/(?<rubrique>[^/]+)/question\\-de\\-nanas/(?<id>[^/]+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::questionAction',)), array('_route' => 'CauseuseBundle_conversation'));
        }

        // CauseuseBundle_creer
        if ($pathinfo === '/demande/question-de-nanas') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::questionDemandeAction',  '_route' => 'CauseuseBundle_creer',);
        }

        // CauseuseBundle_postReponse
        if ($pathinfo === '/question-de-nanas/repondre') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::reponsePosterAction',  '_route' => 'CauseuseBundle_postReponse',);
        }

        // CauseuseBundle_voteReponse
        if (0 === strpos($pathinfo, '/question-de-nanas/voter') && preg_match('#^/question\\-de\\-nanas/voter/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::reponseVoterAction',)), array('_route' => 'CauseuseBundle_voteReponse'));
        }

        // CauseuseBundle_accepteReponse
        if (0 === strpos($pathinfo, '/question-de-nanas/accepter') && preg_match('#^/question\\-de\\-nanas/accepter/(?<idQuestion>[^/,]+),(?<idReponse>[^,]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::reponseAccepterAction',)), array('_route' => 'CauseuseBundle_accepteReponse'));
        }

        // CauseuseBundle_recherche
        if ($pathinfo === '/rechercher/question-de-nanas') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\PublicationController::rechercheAction',  '_route' => 'CauseuseBundle_recherche',);
        }

        // Causeuse_IOSCreer
        if ($pathinfo === '/demande/question-de-nanas') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\IOSController::questionDemandeAction',  '_route' => 'Causeuse_IOSCreer',);
        }

        // Causeuse_IOSReponse
        if ($pathinfo === '/question-de-nanas/repondre') {
            return array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\IOSController::reponsePosterAction',  '_route' => 'Causeuse_IOSReponse',);
        }

        // Causeuse_IOSVoteReponse
        if (0 === strpos($pathinfo, '/question-de-nanas/voter') && preg_match('#^/question\\-de\\-nanas/voter/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\IOSController::reponseVoterAction',)), array('_route' => 'Causeuse_IOSVoteReponse'));
        }

        // Causeuse_IOSAccepteReponse
        if (0 === strpos($pathinfo, '/question-de-nanas/accepter') && preg_match('#^/question\\-de\\-nanas/accepter/(?<idQuestion>[^/,]+),(?<idReponse>[^,]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CauseuseBundle\\Controller\\IOSController::reponseAccepterAction',)), array('_route' => 'Causeuse_IOSAccepteReponse'));
        }

        // ConseilExpert_journalExpert
        if ($pathinfo === '/cron/journal-expert') {
            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::journalExpertAction',  '_route' => 'ConseilExpert_journalExpert',);
        }

        // ConseilExpert_conseil
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil\\-expert/(?<id>\\d+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\PublicationController::conseilAction',)), array('_route' => 'ConseilExpert_conseil'));
        }

        // ConseilExpertLegacy_conseil
        if (0 === strpos($pathinfo, '/conseil/node') && preg_match('#^/conseil/node/(?<slug>[^/,]+),(?<id>\\d+),(?<page>[^,\\.]+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilExpertLegacy_conseil'));
        }

        // ConseilExpert_conseiByID
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil\\-expert/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\PublicationController::conseilAction',)), array('_route' => 'ConseilExpert_conseiByID'));
        }

        // ConseilExpert_creer
        if ($pathinfo === '/conseil-expert/demande') {
            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\PublicationController::conseilDemandeAction',  '_route' => 'ConseilExpert_creer',);
        }

        // ConseilExpert_filPerso
        if (0 === strpos($pathinfo, '/conseil-expert/liste-personnelle') && preg_match('#^/conseil\\-expert/liste\\-personnelle/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\PublicationController::filPersoAction',)), array('_route' => 'ConseilExpert_filPerso'));
        }

        // ConseilExpertBundle_index
        if ($pathinfo === '/admin/conseils/index') {
            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::indexAction',  '_route' => 'ConseilExpertBundle_index',);
        }

        // ConseilExpertBundle_logTri
        if (0 === strpos($pathinfo, '/admin/conseils/index') && preg_match('#^/admin/conseils/index/(?<ordre>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::logTriAction',)), array('_route' => 'ConseilExpertBundle_logTri'));
        }

        // ConseilExpert_logStatut
        if (0 === strpos($pathinfo, '/admin/conseils/workflow') && preg_match('#^/admin/conseils/workflow/(?<statut>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::logStatutAction',)), array('_route' => 'ConseilExpert_logStatut'));
        }

        // ConseilExpertBundle_deleguer
        if (0 === strpos($pathinfo, '/admin/conseil/deleguer') && preg_match('#^/admin/conseil/deleguer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilDispatchAction',)), array('_route' => 'ConseilExpertBundle_deleguer'));
        }

        // ConseilExpertBundle_flowDeleguer
        if (rtrim($pathinfo, '/') === '/admin/conseil/deleguer') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'ConseilExpertBundle_flowDeleguer');
            }

            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilFlowDispatchAction',  '_route' => 'ConseilExpertBundle_flowDeleguer',);
        }

        // ConseilExpertBundle_repondre
        if (0 === strpos($pathinfo, '/admin/conseil/repondre') && preg_match('#^/admin/conseil/repondre/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilRepondreAction',)), array('_route' => 'ConseilExpertBundle_repondre'));
        }

        // ConseilExpertBundle_flowRepondre
        if ($pathinfo === '/admin/conseil/flow/repondre') {
            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilFlowRepondreAction',  '_route' => 'ConseilExpertBundle_flowRepondre',);
        }

        // ConseilExpertBundle_relire
        if (0 === strpos($pathinfo, '/admin/conseil/relire') && preg_match('#^/admin/conseil/relire/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilRelireAction',)), array('_route' => 'ConseilExpertBundle_relire'));
        }

        // ConseilExpertBundle_flowEnd
        if ($pathinfo === '/admin/conseil/flow/end') {
            return array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::conseilFlowEndAction',  '_route' => 'ConseilExpertBundle_flowEnd',);
        }

        // ConseilExpertBundle_editer
        if (0 === strpos($pathinfo, '/admin/conseil/editer') && preg_match('#^/admin/conseil/editer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::editerAction',)), array('_route' => 'ConseilExpertBundle_editer'));
        }

        // ConseilExpertBundle_publier
        if (0 === strpos($pathinfo, '/admin/conseil/publier') && preg_match('#^/admin/conseil/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::publierAction',)), array('_route' => 'ConseilExpertBundle_publier'));
        }

        // ConseilExpertBundle_supprimer
        if (0 === strpos($pathinfo, '/admin/conseil/supprimer') && preg_match('#^/admin/conseil/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'ConseilExpertBundle_supprimer'));
        }

        // Conseil_migration
        if (0 === strpos($pathinfo, '/migration/conseils') && preg_match('#^/migration/conseils/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Conseil_migration'));
        }

        // Conseil_migrationV1ID
        if (0 === strpos($pathinfo, '/migration/conseils/v1') && preg_match('#^/migration/conseils/v1/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\MigrationController::migrationV1IDAction',)), array('_route' => 'Conseil_migrationV1ID'));
        }

        // ConseilLegacy_conseilSimpleNode
        if (0 === strpos($pathinfo, '/conseil/node') && preg_match('#^/conseil/node/(?<slug>[^/,]+),(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilLegacy_conseilSimpleNode'));
        }

        // ConseilLegacy_conseilSimpleNodeNoSlug
        if (0 === strpos($pathinfo, '/conseil/node/') && preg_match('#^/conseil/node/,(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilLegacy_conseilSimpleNodeNoSlug'));
        }

        // ConseilLegacy_conseilNode
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil/node/(?<slug>[^/,]+),(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilLegacy_conseilNode'));
        }

        // ConseilLegacy_conseilNodeNoSlug
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil/node/,(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilLegacy_conseilNodeNoSlug'));
        }

        // ConseilLegacy_conseil
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil/(?<slug>[^/,]+),(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilAction',)), array('_route' => 'ConseilLegacy_conseil'));
        }

        // ConseilExpertLegacy_rubriquePrincipaleSommaire
        if (preg_match('#^/(?<rubrique>[^/]+)/conseil/(?<level>sommaire|node)/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::sommaireRubriqueAction',)), array('_route' => 'ConseilExpertLegacy_rubriquePrincipaleSommaire'));
        }

        // ConseilLegacy_conseilV1
        if (preg_match('#^/(?<slug>[^/,]+),con\\-(?<id>\\d+)\\-(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::conseilV1Action',)), array('_route' => 'ConseilLegacy_conseilV1'));
        }

        // ConseilLegacy_conseilV1NoID
        if (preg_match('#^/(?<slug>[^/,]+),con\\-\\-(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConseilExpertBundle\\Controller\\LegacyController::goneAction',)), array('_route' => 'ConseilLegacy_conseilV1NoID'));
        }

        // Concours_sommaireLegacy_1
        if (0 === strpos($pathinfo, '/concours/tools/index') && preg_match('#^/concours/tools/index\\.(?<_format>html|php)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\LegacyController::sommaireConcoursAction',)), array('_route' => 'Concours_sommaireLegacy_1'));
        }

        // Concours_sommaireLegacy_2
        if (0 === strpos($pathinfo, '/tools/concours/index') && preg_match('#^/tools/concours/index\\.(?<_format>html|php)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\LegacyController::sommaireConcoursAction',)), array('_route' => 'Concours_sommaireLegacy_2'));
        }

        // Concours_legacy
        if (0 === strpos($pathinfo, '/concours/tools') && preg_match('#^/concours/tools/(?<slug>[^/,]+),(?<id>\\d+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\LegacyController::sommaireConcoursAction',)), array('_route' => 'Concours_legacy'));
        }

        // Concours_sommaire
        if ($pathinfo === '/concours/sommaire') {
            return array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\PublicController::concoursSommaireAction',  '_route' => 'Concours_sommaire',);
        }

        // Concours_participer
        if (0 === strpos($pathinfo, '/concours/participer') && preg_match('#^/concours/participer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\PublicController::concoursParticiperAction',)), array('_route' => 'Concours_participer'));
        }

        // Concours_voter
        if (0 === strpos($pathinfo, '/concours/voter') && preg_match('#^/concours/voter/(?<participant>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\PublicController::concoursVoterAction',)), array('_route' => 'Concours_voter'));
        }

        // Concours_show
        if (0 === strpos($pathinfo, '/concours') && preg_match('#^/concours/(?<id>[^/]+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\PublicController::concoursShowAction',)), array('_route' => 'Concours_show'));
        }

        // ConcoursBundle_index
        if ($pathinfo === '/admin/concours/index') {
            return array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::concoursIndexAction',  '_route' => 'ConcoursBundle_index',);
        }

        // ConcoursBundle_add
        if ($pathinfo === '/admin/concours/add') {
            return array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::AddAction',  '_route' => 'ConcoursBundle_add',);
        }

        // Concours_reviser
        if (0 === strpos($pathinfo, '/admin/concours/reviser') && preg_match('#^/admin/concours/reviser/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::reviserAction',)), array('_route' => 'Concours_reviser'));
        }

        // Concours_tirageGagnants
        if (0 === strpos($pathinfo, '/admin/concours/tirer') && preg_match('#^/admin/concours/tirer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::tirageGagnantsAction',)), array('_route' => 'Concours_tirageGagnants'));
        }

        // Concours_notificationGagnants
        if (0 === strpos($pathinfo, '/admin/concours/notifier') && preg_match('#^/admin/concours/notifier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::notificationGagnantsAction',)), array('_route' => 'Concours_notificationGagnants'));
        }

        // ConcoursBundle_publier
        if ($pathinfo === '/admin/concours/publier') {
            return array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\AdminController::concoursPublicationAction',  '_route' => 'ConcoursBundle_publier',);
        }

        // Concours_migration
        if (0 === strpos($pathinfo, '/migration/concours') && preg_match('#^/migration/concours/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Concours_migration'));
        }

        // Concours_cronTirage
        if ($pathinfo === '/cron/concours/tirages-a-effectuer') {
            return array (  '_controller' => 'TDN\\ConcoursBundle\\Controller\\CronController::tiragesAction',  '_route' => 'Concours_cronTirage',);
        }

        // Core_TestPolices
        if ($pathinfo === '/test-polices') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\TestsController::policesAction',  '_route' => 'Core_TestPolices',);
        }

        // Core_TestColorbox
        if ($pathinfo === '/test-colorbox') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\TestsController::colorboxAction',  '_route' => 'Core_TestColorbox',);
        }

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }

            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::homeAction',  '_route' => '_welcome',);
        }

        // core_homepage
        if ($pathinfo === '/core/rubriques/dashboard') {
            return array (  '_controller' => 'CoreBundle:Rubrique:dashboard',  '_route' => 'core_homepage',);
        }

        // Core_home
        if ($pathinfo === '/home') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::homeAction',  '_route' => 'Core_home',);
        }

        // Core_sommaireGeneral
        if ($pathinfo === '/sommaire') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::homeAction',  '_route' => 'Core_sommaireGeneral',);
        }

        // Core_sommaire
        if (0 === strpos($pathinfo, '/sommaire') && preg_match('#^/sommaire/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::sommaireRubriqueAction',)), array('_route' => 'Core_sommaire'));
        }

        // Core_sommaire_slashed
        if (0 === strpos($pathinfo, '/sommaire') && preg_match('#^/sommaire/(?<slug>[^/]+)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'Core_sommaire_slashed');
            }

            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::sommaireRubriqueAction',)), array('_route' => 'Core_sommaire_slashed'));
        }

        // Core_contact
        if ($pathinfo === '/contact') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::contactAction',  '_route' => 'Core_contact',);
        }

        // Core_adminDashboard
        if ($pathinfo === '/admin/tableau-de-bord') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AdminController::dashboardAction',  '_route' => 'Core_adminDashboard',);
        }

        // Core_sendmail
        if (0 === strpos($pathinfo, '/cron/sendmail') && preg_match('#^/cron/sendmail/(?<message_limit>[^/]+)/(?<time_limit>[^/]+)/(?<recover>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\SpoolerController::flushQueueAction',)), array('_route' => 'Core_sendmail'));
        }

        // Journal_razAlertes
        if ($pathinfo === '/alertes/raz') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\JournalController::razAlertesAction',  '_route' => 'Journal_razAlertes',);
        }

        // Spooler_flush
        if ($pathinfo === '/spool/flush') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\SpoolerController::flushQueueAction',  '_route' => 'Spooler_flush',);
        }

        // Core_RSSFeed
        if (0 === strpos($pathinfo, '/feeds/tdn') && preg_match('#^/feeds/tdn\\.(?<_format>rss)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\RSSController::feedAction',)), array('_route' => 'Core_RSSFeed'));
        }

        // Core_RSSFeedByType
        if (0 === strpos($pathinfo, '/feeds') && preg_match('#^/feeds/(?<type>[^/\\.]+)\\.(?<_format>rss)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\RSSController::feedByContenuAction',)), array('_route' => 'Core_RSSFeedByType'));
        }

        // Core_RSSFeedByRubrique
        if (0 === strpos($pathinfo, '/feeds') && preg_match('#^/feeds/(?<type>[^/]+)/(?<rubrique>[^/\\.]+)\\.(?<_format>rss)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\RSSController::feedByRubriqueAction',)), array('_route' => 'Core_RSSFeedByRubrique'));
        }

        // Core_equipeLegacy
        if (preg_match('#^/(?<equipe>equipe|quisommesnous)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::equipeAction',)), array('_route' => 'Core_equipeLegacy'));
        }

        // Core_infolegalLegacy
        if ($pathinfo === '/infolegal.html') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::infolegalAction',  '_route' => 'Core_infolegalLegacy',);
        }

        // Core_rubriquePrincipaleSommaireLegacy
        if (preg_match('#^/(?<rubrique>[^/]+)/sommaire/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::sommaireRubriqueAction',)), array('_route' => 'Core_rubriquePrincipaleSommaireLegacy'));
        }

        // Core_rrechercheLegacy
        if ($pathinfo === '/all/all/requete/index.html') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::rechercheAction',  '_route' => 'Core_rrechercheLegacy',);
        }

        // Core_pageLegacy
        if (0 === strpos($pathinfo, '/page') && preg_match('#^/page/(?<titre>[^/\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::pageAction',)), array('_route' => 'Core_pageLegacy'));
        }

        // Core_oldImageError
        if (preg_match('#^/(?<slug>[^/,]+),(?<id>\\d+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::nakedURLAction',)), array('_route' => 'Core_oldImageError'));
        }

        // Core_oldIndex
        if (0 === strpos($pathinfo, '/index') && preg_match('#^/index\\.(?<suffixe>php|html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',)), array('_route' => 'Core_oldIndex'));
        }

        // Core_OldRSSArticles
        if ($pathinfo === '/rss_articles.xml') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::articlesRSSAction',  '_route' => 'Core_OldRSSArticles',);
        }

        // Core_OldRSSFeedByType
        if (0 === strpos($pathinfo, '/rss_tdn') && preg_match('#^/rss_tdn_(?<type>[^_\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::feedByContenuAction',)), array('_route' => 'Core_OldRSSFeedByType'));
        }

        // Core_sommaireError
        if ($pathinfo === '/sommaire') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::goneAction',  '_route' => 'Core_sommaireError',);
        }

        // Core_oldSuggestions
        if ($pathinfo === '/suggestions.html') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\DefaultController::contactAction',  '_route' => 'Core_oldSuggestions',);
        }

        // oldies
        if ($pathinfo === '/version_mobile.html') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',  '_route' => 'oldies',);
        }

        // Core_iPhoneLegacy
        if ($pathinfo === '/lib/rss/json_tdn.php') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iPhoneFluxAction',  '_route' => 'Core_iPhoneLegacy',);
        }

        // Core_iPhone
        if ($pathinfo === '/lib/rss/v3/json_tdn.php') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iPhoneFluxAction',  '_route' => 'Core_iPhone',);
        }

        // Core_iOS
        if (0 === strpos($pathinfo, '/ios/feed') && preg_match('#^/ios/feed\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\IOSController::iOSFluxAction',)), array('_route' => 'Core_iOS'));
        }

        // Core_iOSArticle
        if (0 === strpos($pathinfo, '/ios/article') && preg_match('#^/ios/article\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\IOSController::iOSArticleAction',)), array('_route' => 'Core_iOSArticle'));
        }

        // Core_iOSVideo
        if (0 === strpos($pathinfo, '/ios/video') && preg_match('#^/ios/video\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\IOSController::iOSArticleAction',)), array('_route' => 'Core_iOSVideo'));
        }

        // Core_iOSAFeatured
        if (0 === strpos($pathinfo, '/ios/featured') && preg_match('#^/ios/featured\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iOSFeaturedAction',)), array('_route' => 'Core_iOSAFeatured'));
        }

        // Core_iOSDerniersArticles
        if (0 === strpos($pathinfo, '/ios/derniers-articles') && preg_match('#^/ios/derniers\\-articles\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iOSDerniersArticlesAction',)), array('_route' => 'Core_iOSDerniersArticles'));
        }

        // Core_iOSDernieresVideos
        if (0 === strpos($pathinfo, '/ios/dernieres-videos') && preg_match('#^/ios/dernieres\\-videos\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iOSVideosAction',)), array('_route' => 'Core_iOSDernieresVideos'));
        }

        // Core_articlesRSSLegacy
        if (0 === strpos($pathinfo, '/lib/rss/articles_tdn') && preg_match('#^/lib/rss/articles_tdn\\.(?<_format>json)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::iPhoneFluxAction',)), array('_route' => 'Core_articlesRSSLegacy'));
        }

        // Core_articlesRSS
        if (0 === strpos($pathinfo, '/articles/feed') && preg_match('#^/articles/feed\\.(?<_format>rss)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::articlesRSSAction',)), array('_route' => 'Core_articlesRSS'));
        }

        // Core_articlesFeed
        if ($pathinfo === '/articles/feed') {
            return array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::articlesRSSAction',  '_route' => 'Core_articlesFeed',);
        }

        // Core_conseilsRSS
        if (0 === strpos($pathinfo, '/conseils-experts/feed') && preg_match('#^/conseils\\-experts/feed\\.(?<_format>rss)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\AppsController::conseilsRSSAction',)), array('_route' => 'Core_conseilsRSS'));
        }

        // Core_fakes
        if (preg_match('#^/(?<fake>uetcqtunm|xpipcjaanedujc|hkfkqzedt|ipgoxffnxekqy|iuaqshkfepl|pbrxefzmp|twedkynsl)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',)), array('_route' => 'Core_fakes'));
        }

        // produit_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'produit_homepage'));
        }

        // Produit_catalogue
        if ($pathinfo === '/produits') {
            return array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\PublicController::catalogueAction',  '_route' => 'Produit_catalogue',);
        }

        // Produit_showProduit
        if (0 === strpos($pathinfo, '/produit') && preg_match('#^/produit/(?<id>\\d+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\PublicController::showProduitAction',)), array('_route' => 'Produit_showProduit'));
        }

        // Produit_catalogueRubrique
        if (preg_match('#^/(?<rubrique>[^/]+)/produits/(?<id>\\d+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\PublicController::showRubriqueAction',)), array('_route' => 'Produit_catalogueRubrique'));
        }

        // Produit_migration
        if (0 === strpos($pathinfo, '/migration/produits') && preg_match('#^/migration/produits/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Produit_migration'));
        }

        // Produit_showLegacy
        if (0 === strpos($pathinfo, '/shopping') && preg_match('#^/shopping/(?<slug>[^/,]+),(?<id>\\d+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::showDefaultAction',)), array('_route' => 'Produit_showLegacy'));
        }

        // Produit_showLegacyDoubleComma
        if (0 === strpos($pathinfo, '/shopping') && preg_match('#^/shopping/(?<slug>[^/,]+),,(?<id>\\d+)\\.php$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::showDefaultAction',)), array('_route' => 'Produit_showLegacyDoubleComma'));
        }

        // Produit_showLegacyDoubleCommaNoHeader
        if (preg_match('#^/(?<slug>[^/,]+),,(?<id>\\d+)\\.php$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::showDefaultAction',)), array('_route' => 'Produit_showLegacyDoubleCommaNoHeader'));
        }

        // Produit_showLegacyTools
        if (preg_match('#^/(?<rubrique>[^/]+)/shopping/tools/(?<slug>[^/,]+),(?<id>\\d+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::showDefaultAction',)), array('_route' => 'Produit_showLegacyTools'));
        }

        // Core_oldBoutiqueError
        if (preg_match('#^/(?<titre>([a-z]*\\-)+)acheter(?<id>\\-\\d+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::goneAction',)), array('_route' => 'Core_oldBoutiqueError'));
        }

        // ProduitLegacy_boutique
        if (preg_match('#^/(?<slug>[^/,]+),bou\\-(?<id>\\d+)\\-(?<page>\\d)\\.(?<_format>[^\\.]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ProduitBundle\\Controller\\LegacyController::goneAction',)), array('_route' => 'ProduitLegacy_boutique'));
        }

        // VideoLegacy_video
        if (0 === strpos($pathinfo, '/video') && preg_match('#^/video/(?<slug>[^/,]+),(?<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoAction',)), array('_route' => 'VideoLegacy_video'));
        }

        // VideoLegacy_videoTxt
        if (0 === strpos($pathinfo, '/video.txt') && preg_match('#^/video\\.txt/(?<slug>[^/,]+),(?<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoAction',)), array('_route' => 'VideoLegacy_videoTxt'));
        }

        // VideoLegacy_videoTools
        if (0 === strpos($pathinfo, '/video/tools') && preg_match('#^/video/tools/(?<slug>[^/,]+),(?<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoAction',)), array('_route' => 'VideoLegacy_videoTools'));
        }

        // VideoLegacy_videoRubriqueToolsIndex
        if (preg_match('#^/(?<rubrique>[^/]+)/video/tools/index\\.php$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoRubriqueIndexAction',)), array('_route' => 'VideoLegacy_videoRubriqueToolsIndex'));
        }

        // VideoLegacy_videoRubriqueIndex
        if (preg_match('#^/(?<rubrique>[^/]+)/video/index\\.php$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoRubriqueIndexAction',)), array('_route' => 'VideoLegacy_videoRubriqueIndex'));
        }

        // VideoLegacy_videoRubriqueIndex_page
        if (preg_match('#^/(?<rubrique>[^/\\-]+)\\-videos\\-(?<page>[^\\-\\.]+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoRubriqueIndexAction',)), array('_route' => 'VideoLegacy_videoRubriqueIndex_page'));
        }

        // VideoLegacy_videoLong
        if (preg_match('#^/(?<rubrique>alaune|deco|beaute|recettes|bienetre|hightech|sexo|mode)/video/tools/(?<slug>[^/,]+),(?<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoAction',)), array('_route' => 'VideoLegacy_videoLong'));
        }

        // VideoLegacy_videoRubrique
        if (preg_match('#^/(?<rubrique>alaune|deco|beaute|recettes|bienetre|hightech|sexo|mode)/video/(?<slug>[^/,]+),(?<id>\\d+)\\.html$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\LegacyController::videoAction',)), array('_route' => 'VideoLegacy_videoRubrique'));
        }

        // VideoBundle_sommaire
        if ($pathinfo === '/videos') {
            return array (  '_controller' => 'TDN\\VideoBundle\\Controller\\PublicationController::videoSommaireAction',  '_route' => 'VideoBundle_sommaire',);
        }

        // VideoBundle_sommaireRubrique
        if (preg_match('#^/(?<rubrique>[^/]+)/videos$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\PublicationController::videoSommaireAction',)), array('_route' => 'VideoBundle_sommaireRubrique'));
        }

        // VideoBundle_video
        if (preg_match('#^/(?<rubrique>[^/]+)/video/(?<id>\\d+)/(?<slug>[0-9|a-z|-]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\PublicationController::videoAction',)), array('_route' => 'VideoBundle_video'));
        }

        // Video_proposer
        if ($pathinfo === '/videos/proposer') {
            return array (  '_controller' => 'TDN\\VideoBundle\\Controller\\PublicationController::videoProposerAction',  '_route' => 'Video_proposer',);
        }

        // Video_index
        if ($pathinfo === '/admin/video/index') {
            return array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::indexAction',  '_route' => 'Video_index',);
        }

        // Video_enAttente
        if ($pathinfo === '/admin/video/en-attente') {
            return array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::enAttenteAction',  '_route' => 'Video_enAttente',);
        }

        // Video_ajouter
        if ($pathinfo === '/admin/video/ajouter') {
            return array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::ajouterAction',  '_route' => 'Video_ajouter',);
        }

        // Video_inspecter
        if (0 === strpos($pathinfo, '/admin/video/inspecter') && preg_match('#^/admin/video/inspecter/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::inspecterAction',)), array('_route' => 'Video_inspecter'));
        }

        // Video_publier
        if (0 === strpos($pathinfo, '/admin/video/publier') && preg_match('#^/admin/video/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::publierAction',)), array('_route' => 'Video_publier'));
        }

        // Video_supprimer
        if (0 === strpos($pathinfo, '/admin/video/supprimer') && preg_match('#^/admin/video/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'Video_supprimer'));
        }

        // Video_migration
        if (0 === strpos($pathinfo, '/migration/videos') && preg_match('#^/migration/videos/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Video_migration'));
        }

        // Video_updateTags
        if (0 === strpos($pathinfo, '/migration/videos/update-tags') && preg_match('#^/migration/videos/update\\-tags/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\MigrationController::updateTagsAction',)), array('_route' => 'Video_updateTags'));
        }

        // Video_IOSPage
        if (0 === strpos($pathinfo, '/ios/video') && preg_match('#^/ios/video/(?<id>\\d+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\VideoBundle\\Controller\\IOSController::videoAction',)), array('_route' => 'Video_IOSPage'));
        }

        // Commentaire_flux
        if (0 === strpos($pathinfo, '/commentaire/flux') && preg_match('#^/commentaire/flux/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\PublicController::fluxAction',)), array('_route' => 'Commentaire_flux'));
        }

        // Commentaire_add
        if ($pathinfo === '/commentaire/add') {
            return array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\PublicController::addAction',  '_route' => 'Commentaire_add',);
        }

        // commentaireBundle_voteFor
        if ($pathinfo === '/commentaire/vote') {
            return array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\PublicController::voteForAction',  '_route' => 'commentaireBundle_voteFor',);
        }

        // Commentaire_effacer
        if (0 === strpos($pathinfo, '/commentaire/effacer') && preg_match('#^/commentaire/effacer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\AdminController::effacerAction',)), array('_route' => 'Commentaire_effacer'));
        }

        // Commentaire_publier
        if (0 === strpos($pathinfo, '/commentaire/publier') && preg_match('#^/commentaire/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\AdminController::publierAction',)), array('_route' => 'Commentaire_publier'));
        }

        // Commentaire_migration
        if (0 === strpos($pathinfo, '/migration/commentaires') && preg_match('#^/migration/commentaires/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Commentaire_migration'));
        }

        // Commentaire_IOSFlux
        if (0 === strpos($pathinfo, '/ios/commentaire/flux') && preg_match('#^/ios/commentaire/flux/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\IOSController::fluxAction',)), array('_route' => 'Commentaire_IOSFlux'));
        }

        // Commentaire_IOSAdd
        if ($pathinfo === '/ios/commentaire/add') {
            return array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\IOSController::addAction',  '_route' => 'Commentaire_IOSAdd',);
        }

        // Commentaire_IOSVote
        if ($pathinfo === '/ios/commentaire/vote') {
            return array (  '_controller' => 'TDN\\CommentaireBundle\\Controller\\IOSController::voteForAction',  '_route' => 'Commentaire_IOSVote',);
        }

        // image_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ImageBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'image_homepage'));
        }

        // Image_migration
        if (0 === strpos($pathinfo, '/migration/images') && preg_match('#^/migration/images/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\ImageBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Image_migration'));
        }

        // Image_fichierCorrectionNom
        if ($pathinfo === '/legacy/images/fichier/correction') {
            return array (  '_controller' => 'TDN\\ImageBundle\\Controller\\LegacyController::fichierCorrectionNomAction',  '_route' => 'Image_fichierCorrectionNom',);
        }

        // Image_avatarCorrectionNom
        if ($pathinfo === '/legacy/images/avatar/correction') {
            return array (  '_controller' => 'TDN\\ImageBundle\\Controller\\LegacyController::avatarCorrectionNomAction',  '_route' => 'Image_avatarCorrectionNom',);
        }

        // Quiz_sommaire
        if (0 === strpos($pathinfo, '/quiz') && preg_match('#^/quiz/(?<rubrique>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\PublicController::quizSommaireAction',)), array('_route' => 'Quiz_sommaire'));
        }

        // Quiz_show
        if (0 === strpos($pathinfo, '/quiz') && preg_match('#^/quiz/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\PublicController::showAction',)), array('_route' => 'Quiz_show'));
        }

        // quiz_expose
        if (0 === strpos($pathinfo, '/quiz') && preg_match('#^/quiz/(?<slug>[^/,]+),(?<id>[^,]+),(?<question>[^,]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\PublicController::quizQuestionAction',)), array('_route' => 'quiz_expose'));
        }

        // quiz_profil
        if (0 === strpos($pathinfo, '/quiz/statistiques') && preg_match('#^/quiz/statistiques/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\PublicController::quizStatsAction',)), array('_route' => 'quiz_profil'));
        }

        // quiz_list
        if ($pathinfo === '/admin/quiz') {
            return array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizListeAction',  '_route' => 'quiz_list',);
        }

        // quiz_nouveau
        if ($pathinfo === '/admin/quiz/creer') {
            return array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizCreerAction',  '_route' => 'quiz_nouveau',);
        }

        // quiz_mofidier
        if (0 === strpos($pathinfo, '/admin/quiz/editer') && preg_match('#^/admin/quiz/editer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizModifierAction',)), array('_route' => 'quiz_mofidier'));
        }

        // quiz_supprimer
        if (0 === strpos($pathinfo, '/admin/quiz/supprimer') && preg_match('#^/admin/quiz/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizSupprimerAction',)), array('_route' => 'quiz_supprimer'));
        }

        // quiz_enregistrer
        if ($pathinfo === '/admin/quiz/enregistrer') {
            return array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizEnregistrerAction',  '_route' => 'quiz_enregistrer',);
        }

        // quiz_enregistrer_profils
        if (0 === strpos($pathinfo, '/admin/quiz') && preg_match('#^/admin/quiz/(?<id>[^/]+)/profils/enregistrer$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizEnregistrerProfilsAction',)), array('_route' => 'quiz_enregistrer_profils'));
        }

        // quiz_enregistrer_questions
        if ($pathinfo === '/admin/quiz/questions/enregistrer') {
            return array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizEnregistrerQuestionsAction',  '_route' => 'quiz_enregistrer_questions',);
        }

        // quiz_recherche
        if ($pathinfo === '/admin/quiz/recherche') {
            return array (  '_controller' => 'TDN\\QuizBundle\\Controller\\AdminController::quizRechercheAction',  '_route' => 'quiz_recherche',);
        }

        // DocumentRubrique_Index
        if ($pathinfo === '/admin/rubriques/index') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::indexAction',  '_route' => 'DocumentRubrique_Index',);
        }

        // DocumentRubrique_Creer
        if ($pathinfo === '/admin/rubrique/creer') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::creerAction',  '_route' => 'DocumentRubrique_Creer',);
        }

        // DocumentBundle_add
        if ($pathinfo === '/admin/rubrique/add') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::addAction',  '_route' => 'DocumentBundle_add',);
        }

        // DocumentRubrique_modifier
        if (0 === strpos($pathinfo, '/admin/rubrique/modifier') && preg_match('#^/admin/rubrique/modifier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::modifierAction',)), array('_route' => 'DocumentRubrique_modifier'));
        }

        // DocumentBundle_saveRubrique
        if (0 === strpos($pathinfo, '/admin/rubrique/save') && preg_match('#^/admin/rubrique/save/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::saveAction',)), array('_route' => 'DocumentBundle_saveRubrique'));
        }

        // DocumentBundle_suppressionRubrique
        if (0 === strpos($pathinfo, '/admin/rubrique/supprimer') && preg_match('#^/admin/rubrique/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\RubriqueController::supprimerAction',)), array('_route' => 'DocumentBundle_suppressionRubrique'));
        }

        // Document_recherche
        if (0 === strpos($pathinfo, '/recherche') && preg_match('#^/recherche/(?<seed>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::rechercheAction',)), array('_route' => 'Document_recherche'));
        }

        // Document_rechercheForm
        if ($pathinfo === '/recherche') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::rechercheAction',  '_route' => 'Document_rechercheForm',);
        }

        // Document_mentionsLegales
        if ($pathinfo === '/mentions-legales') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::mentionsLegalesAction',  '_route' => 'Document_mentionsLegales',);
        }

        // Document_equipeTDN
        if ($pathinfo === '/quisommesnous.php') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::equipeTDNAction',  '_route' => 'Document_equipeTDN',);
        }

        // Document_aime
        if (0 === strpos($pathinfo, '/aime') && preg_match('#^/aime/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::aimeAction',)), array('_route' => 'Document_aime'));
        }

        // Document_sitemap
        if (0 === strpos($pathinfo, '/sitemap/make') && preg_match('#^/sitemap/make/(?<docType>[^/]+)(?:/(?<annee>[^/]+))?$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\SitemapController::makeAction',  'annee' => '',)), array('_route' => 'Document_sitemap'));
        }

        // DocumentBundle_sliderIndex
        if ($pathinfo === '/admin/slider/index') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\SliderController::indexAction',  '_route' => 'DocumentBundle_sliderIndex',);
        }

        // Document_sliderInspecteur
        if (0 === strpos($pathinfo, '/admin/slide/inspect') && preg_match('#^/admin/slide/inspect/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\SliderController::inspectAction',)), array('_route' => 'Document_sliderInspecteur'));
        }

        // DocumentBundle_sliderSupprimer
        if (0 === strpos($pathinfo, '/admin/slider/supprimer') && preg_match('#^/admin/slider/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\SliderController::supprimerAction',)), array('_route' => 'DocumentBundle_sliderSupprimer'));
        }

        // Document_IOSRecherche
        if ($pathinfo === '/ios/recherche') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\IOSController::rechercheAction',  '_route' => 'Document_IOSRecherche',);
        }

        // Document_rechercheLegacy
        if (preg_match('#^/(?<seed>[^/,]+),search\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\PublicController::rechercheAction',)), array('_route' => 'Document_rechercheLegacy'));
        }

        // Document_rechercheLegacyQuery
        if (0 === strpos($pathinfo, '/all/all/requete/fil/index') && preg_match('#^/all/all/requete/fil/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::rechercheAction',)), array('_route' => 'Document_rechercheLegacyQuery'));
        }

        // Document_rechercheLegacyGeneral
        if (0 === strpos($pathinfo, '/tdn/recherche/index') && preg_match('#^/tdn/recherche/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::rechercheAction',)), array('_route' => 'Document_rechercheLegacyGeneral'));
        }

        // Documnt_rebuildThematique
        if (preg_match('#^/(?<type>articles|conseils|videos)/rebuild/thematique$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\LegacyController::rebuildThematiqueAction',)), array('_route' => 'Documnt_rebuildThematique'));
        }

        // Document_tagBuilder
        if ($pathinfo === '/tag/build') {
            return array (  '_controller' => 'TDN\\DocumentBundle\\Controller\\DefaultMigrationController::indexBuildAction',  '_route' => 'Document_tagBuilder',);
        }

        // RedactionBundle_article
        if (preg_match('#^/(?<rubrique>[^/]+)/article/(?<id>\\d+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\DefaultController::articleAction',)), array('_route' => 'RedactionBundle_article'));
        }

        // Redaction_showSelection
        if (preg_match('#^/(?<rubrique>[^/]+)/selection\\-shopping/(?<id>\\d+)/(?<slug>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\ShoppingController::showAction',)), array('_route' => 'Redaction_showSelection'));
        }

        // RedactionBundle_articleIndex
        if ($pathinfo === '/admin/article/index') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::articleIndexAction',  '_route' => 'RedactionBundle_articleIndex',);
        }

        // RedactionBundle_articleBrouillons
        if ($pathinfo === '/admin/article/mes-brouillons') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::articleBrouillonsAction',  '_route' => 'RedactionBundle_articleBrouillons',);
        }

        // RedactionBundle_articleAdd
        if ($pathinfo === '/admin/article/add') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::articleAddAction',  '_route' => 'RedactionBundle_articleAdd',);
        }

        // RedactionBundle_articleModifier
        if (0 === strpos($pathinfo, '/admin/article/modifier') && preg_match('#^/admin/article/modifier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::articleModifierAction',)), array('_route' => 'RedactionBundle_articleModifier'));
        }

        // Redaction_articlePublier
        if (0 === strpos($pathinfo, '/admin/article/publier') && preg_match('#^/admin/article/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::articlePublierAction',)), array('_route' => 'Redaction_articlePublier'));
        }

        // Redaction_articleSupprimer
        if (0 === strpos($pathinfo, '/admin/article/supprimer') && preg_match('#^/admin/article/supprimer/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminController::supprimerAction',)), array('_route' => 'Redaction_articleSupprimer'));
        }

        // Redaction_selectionShoppingIndex
        if ($pathinfo === '/admin/selection-shopping/index') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminShoppingController::indexAction',  '_route' => 'Redaction_selectionShoppingIndex',);
        }

        // Redaction_ajouterSelection
        if ($pathinfo === '/admin/selection-shopping/ajouter') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminShoppingController::ajouterAction',  '_route' => 'Redaction_ajouterSelection',);
        }

        // Redaction_modifierSelection
        if (0 === strpos($pathinfo, '/admin/selection-shopping/modifier') && preg_match('#^/admin/selection\\-shopping/modifier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminShoppingController::modifierAction',)), array('_route' => 'Redaction_modifierSelection'));
        }

        // Redaction_selectionShoppingPublier
        if (0 === strpos($pathinfo, '/admin/selection-shopping/publier') && preg_match('#^/admin/selection\\-shopping/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminShoppingController::publierAction',)), array('_route' => 'Redaction_selectionShoppingPublier'));
        }

        // Redaction_selectionShoppingSupprimer
        if (0 === strpos($pathinfo, '/admin/selection-shopping/publier') && preg_match('#^/admin/selection\\-shopping/publier/(?<id>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\AdminShoppingController::supprimerAction',)), array('_route' => 'Redaction_selectionShoppingSupprimer'));
        }

        // Redaction_IOSBonsPlans
        if ($pathinfo === '/ios/bons-plans') {
            return array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\IOSController::getBonsPlansAction',  '_route' => 'Redaction_IOSBonsPlans',);
        }

        // Article_migration
        if (0 === strpos($pathinfo, '/migration/articles') && preg_match('#^/migration/articles/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\MigrationController::migrationAction',)), array('_route' => 'Article_migration'));
        }

        // Article_migrationV1ID
        if (0 === strpos($pathinfo, '/migration/articles/v1') && preg_match('#^/migration/articles/v1/(?<fichier>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\MigrationController::migrationV1IDAction',)), array('_route' => 'Article_migrationV1ID'));
        }

        // RedactionLegacy_articleSimpleNode
        if (0 === strpos($pathinfo, '/article/node') && preg_match('#^/article/node/(?<slug>[^/,]+),(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::articleAction',)), array('_route' => 'RedactionLegacy_articleSimpleNode'));
        }

        // RedactionLegacy_articleNode
        if (preg_match('#^/(?<rubrique>[^/]+)/article/node/(?<slug>[^/,]+),(?<id>\\d+),(?<page>a|\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::articleAction',)), array('_route' => 'RedactionLegacy_articleNode'));
        }

        // RedactionLegacy_articleNodeNoSlug
        if (preg_match('#^/(?<rubrique>[^/]+)/article/node/,(?<id>\\d+),(?<page>a|\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::articleAction',)), array('_route' => 'RedactionLegacy_articleNodeNoSlug'));
        }

        // RedactionLegacy_article
        if (preg_match('#^/(?<rubrique>[^/]+)/article/(?<slug>[^/,]+),(?<id>\\d+),(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::articleAction',)), array('_route' => 'RedactionLegacy_article'));
        }

        // RedactionLegacy_articleSommaire
        if (preg_match('#^/(?<rubrique>[^/]+)/(?<sousRubrique>[^/]+)/article/sommaire/(?<slug>[^/\\.]+)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::sommaireSousRubriqueAction',)), array('_route' => 'RedactionLegacy_articleSommaire'));
        }

        // RedactionLegacy_rubriquePrincipaleSommaire
        if (preg_match('#^/(?<rubrique>[^/]+)/article/(?<level>sommaire|node)/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::sommaireRubriqueAction',)), array('_route' => 'RedactionLegacy_rubriquePrincipaleSommaire'));
        }

        // RedactionLegacy_rubriquePrincipaleSommaireDomaine
        if (preg_match('#^/(?<domaine>trucdenana|www\\.trucdenana)\\.com/(?<rubrique>[^/]+)/article/(?<level>sommaire|node)/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::sommaireRubriqueAction',)), array('_route' => 'RedactionLegacy_rubriquePrincipaleSommaireDomaine'));
        }

        // RedactionLegacy_articleV1
        if (preg_match('#^/(?<slug>[^/,]+),art\\-(?<id>\\d+)\\-(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::articleV1Action',)), array('_route' => 'RedactionLegacy_articleV1'));
        }

        // RedactionLegacy_tendanceV1
        if (preg_match('#^/(?<slug>[^/,]+),ten\\-(?<id>\\d+)\\-(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::tendanceV1Action',)), array('_route' => 'RedactionLegacy_tendanceV1'));
        }

        // RedactionLegacy_rubriqueV1
        if (preg_match('#^/(?<slug>[^/,]+),(?<rubrique>hig)\\-(?<id>\\d+)\\-(?<page>\\d)\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\RedactionBundle\\Controller\\LegacyController::rubriqueV1Action',)), array('_route' => 'RedactionLegacy_rubriqueV1'));
        }

        // RedactionDummy_1
        if (preg_match('#^/(?<lettre>[A-Z])/article/node/(?<expression>[^/]+)/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',)), array('_route' => 'RedactionDummy_1'));
        }

        // RedactionDummy_2
        if (preg_match('#^/(?<lettre>[A-Z])/article/node/index\\.(?<_format>html)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'TDN\\CoreBundle\\Controller\\LegacyController::homeAction',)), array('_route' => 'RedactionDummy_2'));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
