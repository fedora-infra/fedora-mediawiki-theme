<?php
/**
 * BaseTemplate class for the Fedora skin
 *
 * @ingroup Skins
 */
class FedoraTemplate extends BaseTemplate {
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		$this->html( 'headelement' );
		?>
		<?php
		echo Html::openElement(
			'div',
			array( 'class' => 'navbar navbar-full navbar-light masthead' )
		);

		echo Html::openElement(
			'div',
			array( 'class' => 'container-fluid' )
		);

		echo Html::rawElement(
			'img',
			array(
				'src' => $this->data[ 'logopath' ],
				'alt' => $this->data[ 'sitename' ],
				'height' => '40px',
			)
		);

		echo Html::openElement(
			'ul',
			array( 'class' => 'nav navbar-nav pull-xs-right' )
		);

		foreach ( $this->getSidebar() as $boxName => $box ) {
			if ( $boxName != 'TOOLBOX' ) {
				echo Html::openElement(
					'li',
					array( 'class' => 'nav-item dropdown' )
				);

				echo Html::openElement(
					'a',
					array( 'class' => 'nav-link dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#', 'role' => 'button' )
				);
				echo isset( $box['headerMessage'] ) ? $this->getMsg( $box['headerMessage'] )->text() : $box['header'];
				echo Html::closeElement( 'a' );
				if ( is_array( $box['content'] ) ) {
					echo Html::openElement(
					'ul',
					array( 'class' => 'dropdown-menu dropdown-menu-right')
					);

					foreach ( $box['content'] as $key => $item ) {
						echo $this->makeListItem( $key, $item,  array('link-class'=>'dropdown-item'));
					}
				}
				echo Html::closeElement( 'ul' );
				echo Html::closeElement( 'li' );
			}
		}

		echo Html::openElement(
			'li',
			array( 'class' => 'nav-item dropdown' )
		);

		echo Html::openElement(
			'a',
			array( 'class' => 'nav-link dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#', 'role' => 'button' )
		);
		echo Html::rawElement(
			'img',
			array(
				'src' => 'https://seccdn.libravatar.org/avatar/de5bf8d06663adb3bb1b8d49ccab259828fad7dddeb233b073d0c447d79b4c14?s=24&d=retro',
			)
		);
		echo Html::closeElement( 'a' );
		echo '<ul class="dropdown-menu dropdown-menu-right">';
		foreach ( $this->getPersonalTools() as $key => $item ) {
			echo $this->makeListItem( $key, $item , array('link-class'=>'dropdown-item'));
		}
    echo '</ul>';

		echo Html::closeElement( 'li' );

		echo Html::closeElement( 'ul' );


		echo Html::closeElement( 'div' );
		echo Html::closeElement( 'div' );

		?>


		<div class="bodycontent">
			<div class="sub-header p-t-1">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
						<?php
						echo Html::rawElement(
							'h1',
							array(
								'lang' => $this->get( 'pageLanguage' )
							),
							$this->get( 'title' )
						);
						?>
					</div>
					<div class="col-sm-6">
						<div class="btn-group pull-xs-right">
						<?php
						foreach ( $this->data['content_navigation']['actions'] as $key => $item ) {
							echo $this->makeLink( $key, $item , array('link-class'=> 'btn btn-sm btn-secondary'));
						}
						 ?>
					 </div>
				</div>
			</div>

				<ul class="nav nav-tabs nav-small m-l-0">
				<?php
				foreach ( $this->data['content_navigation']['namespaces'] as $key => $item ) {
					$class = "";
					if (strpos($item['class'],'selected')!== false){
						$class = "active";
					}
					echo $this->makeListItem( $key, $item , array('tag'=> 'li class="nav-item"', 'link-class'=>"nav-link $class"));
				}


				foreach ( $this->data['content_navigation']['views'] as $key => $item ) {
					$class = "";
					if (strpos($item['class'],'selected')!== false){
						$class = "active";
					}
					echo $this->makeListItem( $key, $item , array('tag'=> 'li class="nav-item pull-xs-right"', 'link-class'=>"nav-link $class"));
				}
				?>

			</ul>
				</div>
			</div>

			<div class="mw-body container-fluid" role="main">
				<?php
				if ( $this->data['sitenotice'] ) {
					echo Html::rawElement(
						'div',
						array( 'id' => 'siteNotice' ),
						$this->get( 'sitenotice' )
					);
				}
				if ( $this->data['newtalk'] ) {
					echo Html::rawElement(
						'div',
						array( 'class' => 'usermessage' ),
						$this->get( 'newtalk' )
					);
				}
				echo $this->getIndicators();


				echo Html::rawElement(
					'div',
					array( 'id' => 'siteSub' ),
					$this->getMsg( 'tagline' )->parse()
				);
				?>

				<div class="mw-body-content">
					<?php
					echo Html::openElement(
						'div',
						array( 'id' => 'contentSub' )
					);
					if ( $this->data['subtitle'] ) {
						echo Html::rawelement (
							'p',
							[],
							$this->get( 'subtitle' )
						);
					}
					echo Html::rawelement (
						'p',
						[],
						$this->get( 'undelete' )
					);
					echo Html::closeElement( 'div' );

					$this->html( 'bodycontent' );
					$this->clear();
					echo Html::rawElement(
						'div',
						array( 'class' => 'printfooter' ),
						$this->get( 'printfooter' )
					);
					$this->html( 'catlinks' );
					$this->html( 'dataAfterContent' );
					?>
				</div>
			</div>

			<div id="mw-footer">
				<?php
				echo Html::openElement(
					'ul',
					array(
						'id' => 'footer-icons',
						'role' => 'contentinfo'
					)
				);
				foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) {
					echo Html::openElement(
						'li',
						array(
							'id' => 'footer-' . Sanitizer::escapeId( $blockName ) . 'ico'
						)
					);
					foreach ( $footerIcons as $icon ) {
						echo $this->getSkin()->makeFooterIcon( $icon );
					}
					echo Html::closeElement( 'li' );
				}
				echo Html::closeElement( 'ul' );

				foreach ( $this->getFooterLinks() as $category => $links ) {
					echo Html::openElement(
						'ul',
						array(
							'id' => 'footer-' . Sanitizer::escapeId( $category ),
							'role' => 'contentinfo'
						)
					);
					foreach ( $links as $key ) {
						echo Html::rawElement(
							'li',
							array(
								'id' => 'footer-' . Sanitizer::escapeId( $category . '-' . $key )
							),
							$this->get( $key )
						);
					}
					echo Html::closeElement( 'ul' );
				}
				$this->clear();
				?>
			</div>
		</div>

		<?php $this->printTrail() ?>
		</body>
		</html>

		<?php
	}

	/**
	 * Generates a single sidebar portlet of any kind
	 * @return string html
	 */
	private function getPortlet( $box ) {
		if ( !$box['content'] ) {
			return;
		}

		$html = Html::openElement(
			'div',
			array(
				'role' => 'navigation',
				'class' => 'mw-portlet',
				'id' => Sanitizer::escapeId( $box['id'] )
			) + Linker::tooltipAndAccesskeyAttribs( $box['id'] )
		);
		$html .= Html::element(
			'h3',
			[],
			isset( $box['headerMessage'] ) ? $this->getMsg( $box['headerMessage'] )->text() : $box['header'] );
		if ( is_array( $box['content'] ) ) {
			$html .= Html::openElement( 'ul' );
			foreach ( $box['content'] as $key => $item ) {
				$html .= $this->makeListItem( $key, $item );
			}
			$html .= Html::closeElement( 'ul' );
		} else {
			$html .= $box['content'];
		}
		$html .= Html::closeElement( 'div' );

		return $html;
	}


	/**
	 * Generates the search form
	 * @return string html
	 */
	private function getSearch() {
		$html = Html::openElement(
			'form',
			array(
				'action' => htmlspecialchars( $this->get( 'wgScript' ) ),
				'role' => 'search',
				'class' => 'mw-portlet',
				'id' => 'p-search'
			)
		);
		$html .= Html::hidden( 'title', htmlspecialchars( $this->get( 'searchtitle' ) ) );
		$html .= Html::rawelement(
			'h3',
			[],
			Html::label( $this->getMsg( 'search' )->escaped(), 'searchInput' )
		);
		$html .= $this->makeSearchInput( array( 'id' => 'searchInput' ) );
		$html .= $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) );
		$html .= Html::closeElement( 'form' );

		return $html;
	}

	/**
	 * Generates the sidebar
	 * Set the elements to true to allow them to be part of the sidebar
	 * @return string html
	 */
	private function getSiteNavigation() {
		$html = '';

		$sidebar = $this->getSidebar();

		$sidebar['SEARCH'] = false;
		$sidebar['TOOLBOX'] = true;
		$sidebar['LANGUAGES'] = true;

		foreach ( $sidebar as $boxName => $box ) {
			if ( $boxName === false ) {
				continue;
			}
			$html .= $this->getPortlet( $box, true );
		}

		return $html;
	}

	/**
	 * Generates page-related tools/links
	 * @return string html
	 */
	private function getPageLinks() {
		$html = $this->getPortlet( array(
			'id' => 'p-namespaces',
			'headerMessage' => 'namespaces',
			'content' => $this->data['content_navigation']['namespaces'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-variants',
			'headerMessage' => 'variants',
			'content' => $this->data['content_navigation']['variants'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-views',
			'headerMessage' => 'views',
			'content' => $this->data['content_navigation']['views'],
		) );
		$html .= $this->getPortlet( array(
			'id' => 'p-actions',
			'headerMessage' => 'actions',
			'content' => $this->data['content_navigation']['actions'],
		) );

		return $html;
	}

	/**
	 * Generates user tools menu
	 * @return string html
	 */
	private function getUserLinks() {
		return $this->getPortlet( array(
			'id' => 'p-personal',
			'headerMessage' => 'personaltools',
			'content' => $this->getPersonalTools(),
		) );
	}

	/**
	 * Outputs a css clear using the core visualClear class
	 */
	private function clear() {
		echo '<div class="visualClear"></div>';
	}
}
