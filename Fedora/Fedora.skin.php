<?php
/**
 * SkinTemplate class for the Example skin
 *
 * @ingroup Skins
 */
class SkinFedora extends SkinTemplate {
	public $skinname = 'fedora', $stylename = 'Fedora',
		$template = 'FedoraTemplate', $useHeadElement = true;

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	public function initPage( OutputPage $out ) {

		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0' );
		$out->addStyle('https://apps.fedoraproject.org/global/fedora-bootstrap-1.0.1/fedora-bootstrap.css');
		$out->addScriptFile('https://code.jquery.com/jquery-3.1.0.min.js');
		$out->addScriptFile('https://apps.fedoraproject.org/global/fedora-bootstrap-1.0.1/fedora-bootstrap.js');
		$out->addModuleStyles( array(
			'mediawiki.skinning.interface',
			'mediawiki.skinning.content.externallinks',
			'skins.fedora'
		) );
		$out->addModules( array(
			'skins.fedora.js',
		) );
	}

	/**
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
	}
}
