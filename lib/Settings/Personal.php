<?php

namespace OCA\FilesTextEditor\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;
use OCA\FilesTextEditor\Service\SettingsService;

class Personal implements ISettings {
	/** @var IConfig */
	private $config;
	/** @var IL10N */
	private $l;
	/** @var SettingsService */
    private $settingsService;

	public function __construct(
        IConfig $config,
		IL10N $l,
        SettingsService $settingsService
	) {
		$this->config = $config;
		$this->l = $l;
        $this->settingsService = $settingsService;
	}
	/**
	 * @return TemplateResponse returns the instance with all parameters set, ready to be rendered
	 * @since 9.1
	 */
	public function getForm() {
        $global_keybindings = $this->settingsService->getAppOption('editor-keybindings', 'normal');
        $keybindings = $this->settingsService->getUserOption('editor-keybindings');
		$parameters = [
            'global-editor-keybindings' => $global_keybindings,
            'editor-keybindings' => $keybindings,
		];
		return new TemplateResponse('files_texteditor', 'settings/personal', $parameters, '');
	}
	/**
	 * @return string the section ID, e.g. 'sharing'
	 * @since 9.1
	 */
	public function getSection() {
		return 'additional';
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * E.g.: 70
	 * @since 9.1
	 */
	public function getPriority() {
		return 70;
	}
}
