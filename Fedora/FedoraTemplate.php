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
			array( 'class' => 'navbar navbar-expand-lg navbar-light masthead py-2 justify-content-between' )
		);

		//echo Html::openElement(
		//	'div',
		//	array( 'class' => 'container' )
		//);
		//echo Html::openElement(
		//	'div',
		//	array( 'class' => 'row' )
		//);
		//echo Html::openElement(
		//	'div',
		//	array( 'class' => 'col-md-4' )
		//);
		echo Html::openElement(
			'a',
			array(
				'href' => $this->data['nav_urls']['mainpage']['href'],
				'class' => 'navbar-brand'
			)
		);

		echo Html::rawElement(
			'img',
			array(
				'src' => '/w/skins/Fedora/resources/images/fedorawiki_logo.png',
				'alt' => $this->data[ 'sitename' ],
				'height' => '40px',
			)
		);
		echo Html::closeElement( 'a' );
		//echo Html::closeElement( 'div' );

		echo Html::openElement(
			'div',
			array( 'class' => 'navbar-nav' )
		);
		echo $this->getSearch();		
		echo Html::closeElement( 'div' );

		//echo Html::openElement(
		//	'div',
		//	array( 'class' => 'col-md-5' )
		//);
		echo Html::openElement(
			'ul',
			array( 'class' => 'navbar-nav align-items-center' )
		);
		foreach ( $this->getSidebar() as $boxName => $box ) {
			if ( $boxName != 'TOOLBOX' ) {
				echo Html::openElement(
					'li',
					array( 'class' => 'nav-item dropdown' )
				);

				echo Html::openElement(
					'a',
					array( 'class' => 'nav-link dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#', 'role' => 'button', 'data-bs-toggle' => 'dropdown')
				);
				echo isset( $box['headerMessage'] ) ? $this->getMsg( $box['headerMessage'] )->text() : $box['header'];
				echo Html::closeElement( 'a' );
				if ( is_array( $box['content'] ) ) {
					echo Html::openElement(
					'ul',
					array( 'class' => 'dropdown-menu dropdown-menu-end')
					);

					foreach ( $box['content'] as $key => $item ) {
						echo $this->makeListItem( $key, $item,  array('link-class'=>'dropdown-item'));
					}
				}
				echo Html::closeElement( 'ul' );
				echo Html::closeElement( 'li' );
			}
		}
		$personaltools = $this->getPersonalTools();
		$loggedin = $this->getSkin()->getUser()->isRegistered();
		if ( !$loggedin ) {
			echo Html::rawElement(
				'a',
				array(
					'href' => $personaltools['login']['links'][0]['href'],
					'class' => 'btn btn-primary m-l-2',
				),
				"Log In"
			);
		} else {
			echo Html::openElement(
				'li',
				array( 'class' => 'nav-item dropdown' )
			);

			echo Html::openElement(
				'a',
				array( 'class' => 'nav-link dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#', 'role' => 'button', 'data-bs-toggle' => 'dropdown' )
			);
			$avatarhash = md5(strtolower($this -> data["username"]."@fedoraproject.org"));
			echo Html::rawElement(
				'img',
				array(
					'src' => 'https://seccdn.libravatar.org/avatar/'.$avatarhash.'?s=24&d=retro',
				)
			);
			echo Html::closeElement( 'a' );
			echo '<ul class="dropdown-menu dropdown-menu-end">';
			foreach ( $personaltools as $key => $item ) {
				echo $this->makeListItem( $key, $item , array('link-class'=>'dropdown-item'));
			}
	    echo '</ul>';

			echo Html::closeElement( 'li' );
		}
		echo Html::closeElement( 'ul' );
		//echo Html::closeElement( 'div' );				
		//echo Html::closeElement( 'div' ); //row		
		// echo Html::closeElement( 'div' ); //container
		echo Html::closeElement( 'div' ); //navbar

		?>


		<div class="bodycontent">
			<div class="sub-header pt-4">
				<div class="container">
					<div class="d-flex justify-content-between align-items-center">
						<div>
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
						<div>
							<div class="btn-group">
							<?php
							foreach ( $this->data['content_navigation']['actions'] as $key => $item ) {
								echo $this->makeLink( $key, $item , array('link-class'=> 'btn btn-sm btn-outline-primary'));
							}
							echo $this->getIndicators();
							?>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-between">
						<ul class="nav nav-tabs nav-small border-0 ms-0">
						<?php
						foreach ( $this->data['content_navigation']['namespaces'] as $key => $item ) {
							$class = "";
							if (strpos($item['class'],'selected')!== false){
								$class = "active";
							}
							echo $this->makeListItem( $key, $item , array('tag'=> 'li class="nav-item"', 'link-class'=>"nav-link $class"));
						}
						?>
						</ul>
						<ul class="nav nav-tabs nav-small border-0 ms-0">
						<?php
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
			</div>
		</div>

			<div class="mw-body container pb-5" role="main">
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

			<div class="footer py-5 text-white">
				<div class="container">
					<div class="row footerlinks justify-content-center">
						<div class="col-sm-3 col-4 mt-3">
							<div>
								<dl>
									<dt class="text-uppercase h4"><strong>About</strong></dt>
									<dd><a href="https://getfedora.org/">Get Fedora Linux</a></dd>
									<dd><a href="https://getfedora.org/en/sponsors/">Sponsors</a></dd>
									<dd><a href="https://fedoramagazine.org">Fedora Magazine</a></dd>
									<dd><a href="https://fedoraproject.org/wiki/Legal:Main#Legal">Legal</a></dd>
								</dl>
							</div>
					</div>
					<div class="col-sm-3 col-4 mt-3">
							<div>
								<dl>
									<dt class="text-uppercase h4"><strong>Support</strong></dt>
									<dd><a href="https://fedoraproject.org/wiki/Communicating_and_getting_help">Get Help</a></dd>
									<dd><a href="https://ask.fedoraproject.org/">Ask Fedora</a></dd>
									<dd><a href="https://discussion.fedoraproject.org/c/ask/common-issues/">Common Issues</a></dd>
									<dd><a href="https://developer.fedoraproject.org/">Fedora Developer Portal</a></dd>
								</dl>
							</div>
					</div>
					<div class="col-sm-3 col-4 mt-3">
							<div>
								<dl>
									<dt class="text-uppercase h4"><strong>Community</strong></dt>
									<dd><a href="https://fedoraproject.org/wiki/Join">Join Fedora</a></dd>
									<dd><a href="https://fedoraproject.org/wiki/Overview">About Fedora</a></dd>
									<dd><a href="http://fedoraplanet.org">Planet Fedora</a></dd>
									<dd><a href="https://accounts.fedoraproject.org/">Fedora Accounts</a></dd>
								</dl>
							</div>
					</div>
					</div>
					<div class="row footerlinks">
						<div class="col-12 text-center">
							<p class="disclaimer fw-bold">
								This is a community maintained site.  Red Hat is not responsible for content.
							</p>
							<p>
							&copy; <?php echo date('Y');?> Red Hat, Inc. and others.  Content is available under <a href-"https://creativecommons.org/licenses/by-sa/4.0/deed.en">Attribution-Share Alike 4.0 International</a> unless otherwise noted.
							</p>
							<p> Fedora is sponsored by Red Hat. <a href="https://www.redhat.com/en/technologies/linux-platforms/articles/relationship-between-fedora-and-rhel">Learn more about the relationship between Red Hat and Fedora »</a> </p>
							<div class="py-3"> 
								<?php 
								echo Html::rawElement(
									'img',
									array(
										'src' => '/w/skins/Fedora/resources/images/redhat.png',
										'alt' => 'Red Hat Logo',
										'height' => '40px',
									)
								);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

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
				'id' => Sanitizer::escapeIdForAttribute( $box['id'] )
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
		$html .= Html::openElement(
			'div',
			array( 'class' => 'input-group' )
		);
		$html .= $this->makeSearchInput( array( 'id' => 'searchInput' , 'class' => 'form-control') );
		$html .= Html::openElement(
			'span',
			array( 'class' => 'input-group-btn' )
		);
		//<input name="go" value="Go" title="Go to a page with this exact name if it exists" id="searchGoButton" class="btn btn-secondary" type="submit">
		//$html .= $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'btn btn-secondary' ) );
		$html .= Html::OpenElement(
			'button',
			array( 'id' => 'searchGoButton', 'class' => 'btn bg-white border rounded-0 rounded-end', 'type' => 'submit' )
		);
		$html .= Html::rawelement(
			'i',
			array('class' => 'fa fa-search')
		);
		$html .= Html::closeElement( 'button' );		
		$html .= Html::closeElement( 'span' );
		$html .= Html::closeElement( 'div' );		
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
