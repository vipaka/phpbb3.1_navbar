<?php
/**
*
* Navigation Buttons Extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
* @copyright (c) 2015 Vipaka
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_NAVBAR'		=> 'Paramètres',
	'NAVBAR_PAGE'			=> 'Navigation',
	'NAVBAR_ENABLE'		=> 'Activer',
	'NAVBAR_DISABLE'		=> 'Désactiver',
	'INACTIVE'		=> 'Inactif',
	'MENU_NAV'		=> 'Bouton du menu',
	'MENU_BUTTON_ACTIVE_EXPLAIN'	=> 'Si le bouton est actif, il sera lié à une page. Si inactif, et comme la plupart du premier tiers des liens, il affichera le text du titre mais ne sera pas un lien actif.',
	'ACTIVE'	=> 'Actif',
	'MENU_BUTTON_ACTIVE'		=> 'Activer le bouton',
	'ACP_NAVBAR_TITLE'			=> 'Module des boutons de navigations',
	'ACP_NAVBAR_SETTINGS'					=> 'Paramètres de la barre de navigation',
	'ACP_NAVBAR_TITLE_LINKS'					=> 'Liens de la barre de navigation',
	'ACP_NAVBAR_ENABLE'			=> 'Activer ?',
	'ACP_MENU_ADD_BUTTON_TITLE' => 'Ajouter un lien', 
	'ACP_MENU_BUTTONS_TITLE' => 'Liens du menu', 
	'ACP_MENU_EDIT_BUTTON'	=> 'Modifier le bouton',
	'ACP_NAVBAR_LINKS' => 'Liens', 
	'ACP_NAVBAR_LINKED'	=> 'Actif',
	'ACP_NAVBAR_SETTING_SAVED'	=> 'Les paramètres ont été sauvegardés avec succès !', 
	'CREATE_BUTTON_EXPLAIN' => 'Cliquer sur le titre d’un lien pour voir tous les liens enfants qu’il contient.',
	'MENU_BUTTON_NAME' => 'Titre du lien', 
	'MENU_BUTTON_URL' => 'Adresse URL du lien', 
	'MENU_BUTTON_URL_EXPLAIN' => 'Le chemin utilisé commençe depuis le répertoire racine du forum.', 
	'MENU_BUTTON_PARENT' => 'Lien parent', 
	'MENU_BUTTON_PARENT_EXPLAIN' => 'Si ce nouveau lien est un second ou troisième lien tiers, sélectionner ici le nom du premier lien parent tiers. Laisser vide si ce lien doit être un lien parent.', 
	'MENU_BUTTON_SUB_PARENT' => 'Sous lien parent', 
	'MENU_BUTTON_SUB_PARENT_EXPLAIN' => 'Si ce nouveau lien est un troisième lien tiers, pour un menu de navigation à trois niveaux, saisir ici le nom du second lien parent tiers. Le second lien parent tiers sélectionné doit être correctement rattaché au premier lien parent tiers ci-dessus. Laisser vider pour les premiers ou seconds liens tiers.', 
	'MENU_EXTERNAL' => 'Ouvrir le lien dans un nouvel onglet', 
	'MENU_ONLY_REGISTERED' => 'Afficher le lien uniquement pour les utilisateurs enregistrés', 
	'MENU_ONLY_GUEST' => 'Afficher le lien uniquement pour les invités', 
	'PARENT_MISMATCH' 	=> 'Désolé, mais les liens parents et les sous liens parents sélectionnés ne correspondent pas, merci de s’assurer que les liens choisis sont rattachés aux liens parents sélectionnés.', 
	'MENU_DISPLAY' => 'Afficher les liens', 
	'MOVE_BUTTON_WITH_SUBS'	=> 'Le lien sélectionné pour être mis à l’intérieur d’un lien parent contient des liens enfants. Merci de déplacer ces liens parents au préalable.', 
	'BUTTON_UPDATED' => 'Le lien a été mise à jour avec succès !', 
	'BUTTON_ADDED'	=> 'Le lien a été ajouté dans le menu de navigation avec succès !',
	'DELETE_SUBBUTTONS_CONFIRM' => 'Ce lien est un lien parent d’autres liens, merci de s’assurer qu’ils soient supprimés ou déplacés au préalable.',
	'DELETE_BUTTON_CONFIRM' => 'Confirmer la suppression de ce lien ?',
	'NO_BUTTONS'	=> 'Ce lien de contient pas de liens enfants.',
	'NO_SUBBUTTONS'	=> 'Ce lien de contient pas de liens enfants.',
	'ACP_NAVBAR_PARENT' => 'Couleur d’arrière-plan des liens parents dans le menu de navigation', 
	'ACP_NAVBAR_SUB_PARENT' => 'Couleur d’arrière-plan des liens enfants dans le menu de navigation', 
	'ACP_NAVBAR_SUB_SUB' => 'Couleur d’arrière-plan des troisièmes liens tiers dans le menu de navigation', 
	'ACP_NAVBAR_FONT' => 'Police de caractère',
	'ACP_NAVBAR_COLOR' => 'Couleur de la police',
	'ACP_NAVBAR_TYPE'	=> 'Style du menu de navigation', 
	'DROPDOWN' => 'Menu déroulant', 
	'SLIDER' => 'Curseur horizontal',
	'PHPBB'	=> 'phpBB',
	));
