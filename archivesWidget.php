<?php
/*
 * ----------------------------------------------------------------------
 * CollectiveAccess Archives widget & plugin
 * Created by idéesculture 2018 (www.ideesculture.com)
 * ----------------------------------------------------------------------
 * CollectiveAccess is a TM by Whirl-i-Gig
 * CollectiveAccess and this Archives widget & plugin are under GNU GPL v2 license
 *
 */
 	require_once(__CA_LIB_DIR__.'/ca/BaseWidget.php');
 	require_once(__CA_LIB_DIR__.'/ca/IWidget.php');

	class archivesWidget extends BaseWidget implements IWidget {
		# -------------------------------------------------------
		private $opo_config;

		static $s_widget_settings = array();
		# -------------------------------------------------------
		public function __construct($ps_widget_path, $pa_settings) {
			$this->title = _t('Archives');
			$this->description = _t('Arborescence des archives');
			parent::__construct($ps_widget_path, $pa_settings);

			$this->opo_config = Configuration::load($ps_widget_path.'/conf/archives.conf');
		}
		# -------------------------------------------------------
		/**
		 * Override checkStatus() to return true
		 */
		public function checkStatus() {
			return array(
				'description' => $this->getDescription(),
				'errors' => array(),
				'warnings' => array(),
				'available' => ((bool)$this->opo_config->get('enabled'))
			);
		}
		# -------------------------------------------------------
		/**
		 *
		 */
		public function renderWidget($ps_widget_id, &$pa_settings) {
			parent::renderWidget($ps_widget_id, $pa_settings);
			$this->opo_view->setVar("root_type", $this->opo_config->get('root_type'));
			return $this->opo_view->render('main_html.php');
		}
		# -------------------------------------------------------
		/**
		 * Get widget user actions
		 */
		static public function getRoleActionList() {
			return array();
		}
		# -------------------------------------------------------
	}

	BaseWidget::$s_widget_settings['linksWidget'] = array(
	);

?>
