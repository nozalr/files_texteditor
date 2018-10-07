<?php

namespace OCA\FilesTextEditor\Service;

use OCP\ILogger;
use OCP\IConfig;

class SettingsService
{

    /** @var IConfig */
    private $config;

    /** @var ILogger */
    private $log;

    private $appName;

    private $userId;

    public function __construct(
        IConfig $config,
        ILogger $log,
        $appName,
        $userId
    )
    {
        $this->config = $config;
        $this->log = $log;
        $this->appName = $appName;
        $this->userId = $userId;
    }

    public function getAppName()
    {
        return $this->appName;
    }

    public function getAppValue($key, $default = null)
    {
        return $this->config->getAppValue($this->appName, $key, $default);
    }

    public function setAppValue($key, $value)
    {
        $this->config->setAppValue($this->appName, $key, $value);
    }

    public function getUserValue($userId, $key, $default = null)
    {
        return $this->config->getUserValue($userId, $this->appName, $key, $default);
    }

    public function setUserValue($userId, $key, $value)
    {
        $this->config->setUserValue($userId, $this->appName, $key, $value);
    }


    /* convenience functions */
    public function getOption($key)
    {
        $options = $this->getAppValue('options');
        $value = null;
        if ($options !== null) {
            $options = (array)json_decode($options, true);
            if (is_array($options)) {
                if (isset($options[$key])) {
                    return $options[$key];
                }
            }
        }
        return null;
    }


    public function setOption($key, $value)
    {
        $options = $this->getAppValue('options');
        $value = null;
        if ($options !== null) {
            $options = '{}';
        }
        $options = (array)json_decode($options, true);
        if (!is_array($options)) {
            $options = array();
        }
        $options[$key] = $value;
        $options = json_encode($options);
        $this->setAppValue('options', $options);
    }

    public function getAppOption($key, $default)
    {
        return $this->getAppValue($key, $default);
    }

    public function setAppOption($key, $value)
    {
        return $this->setAppValue($key, $value);
    }

    public function getUserOption($key)
    {
        // $this->log->error('getUserValue [userId]' . $this->userId . ' [key]' . $key . ' [value]' . $value, array('app' => $this->appName));
        $value = $this->getUserValue($this->userId, $key);
        if ($value === null) {
            return $this->getAppOption($key, $this->getDefaultOption($key));
        }
        return $value;
    }

    public function setUserOption($key, $value)
    {
        return $this->setUserValue($this->userId, $key, $value);
    }

    public function isValidOption($option, $value)
    {
        if ($option === 'editor-keybindings' && in_array($value, ['normal', 'vim', 'emacs'])) {
            return true;
        }
        return false;
    }

    public function getDefaultOption($option)
    {
        if ($option === 'editor-keybindings') {
            return 'normal';
        }
        return null;
    }
}
