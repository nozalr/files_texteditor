<?php

namespace OCA\FilesTextEditor\Controller;


use OC\HintException;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCA\FilesTextEditor\Service\SettingsService;
use OCP\IL10N;
use OCP\ILogger;
use OCP\IRequest;
use OCP\Lock\LockedException;


class SettingsHandlerController extends Controller
{

    /** @var IL10N */
    private $l;

    /** @var ILogger */
    private $logger;

    /** @var SettingsService */
    private $settingsService;

    /**
     * @NoAdminRequired
     *
     * @param string $AppName
     * @param IRequest $request
     * @param IL10N $l10n
     * @param ILogger $logger
     */
    public function __construct($AppName,
                                IRequest $request,
                                IL10N $l10n,
                                ILogger $logger,
                                SettingsService $settingsService)
    {
        parent::__construct($AppName, $request);
        $this->l = $l10n;
        $this->logger = $logger;
        $this->settingsService = $settingsService;
    }

    /**
     * get global setting
     *
     * @NoAdminRequired
     *
     * @return DataResponse
     */
    public function get()
    {
        $keybindings = $this->settingsService->getUserOption('editor-keybindings');
        $settings = ['editor-keybindings' => $keybindings];

        return new DataResponse($settings, Http::STATUS_OK);
    }

    /**
     * get global setting
     *
     * @return DataResponse
     */
    public function getGlobal()
    {
        $keybindings = $this->settingsService->getAppOption('editor-keybindings');
        $settings = ['editor-keybindings' => $keybindings];

        return new DataResponse($settings, Http::STATUS_OK);
    }

    /**
     * set user setting
     *
     * @NoAdminRequired
     *
     * @param string $key
     * @param string $value
     * @return DataResponse
     */
    public function set($key, $value)
    {
        if ($this->settingsService->isValidOption($key, $value)) {
            $message = 'ok';
            $this->settingsService->setUserOption($key, $value);
        } else {
            $message = 'invalid key or value';
        }

        return [
            "status" => $message . $key . $value
        ];
    }

    /**
     * set global setting
     *
     * @param string $key
     * @param string $value
     * @return DataResponse
     */
    public function setGlobal($key, $value)
    {
        if ($this->settingsService->isValidOption($key, $value)) {
            $message = 'ok';
            $this->settingsService->setAppOption($key, $value);
        } else {
            $message = 'invalid key or value';
        }

        return new DataResponse([
            "status" => $message
        ], Http::STATUS_OK);
    }
}
