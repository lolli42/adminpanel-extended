<?php
defined('TYPO3_MODE') or die('Access denied.');

call_user_func(
    function () {
        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['debug'])) {
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['debug']['submodules'] = array_replace_recursive(
                $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['debug']['submodules'],
                [
                    'hooks' => [
                        'module' => \Psychomieze\AdminpanelExtended\Modules\HooksAndSignals\Hooks::class,
                        'after' => [
                            'log',
                        ],
                    ],
                    'signals' => [
                        'module' => \Psychomieze\AdminpanelExtended\Modules\HooksAndSignals\Signals::class,
                        'after' => ['hooks'],
                    ],
                ]
            );
        }

        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['info']) &&
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('beuser')) {
            $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['info']['submodules'] = array_replace_recursive(
                $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['adminpanel']['modules']['info']['submodules'],
                [
                    'userinformation' => [
                        'module' => Psychomieze\AdminpanelExtended\Modules\Info\UserInformation::class
                    ]
                ]
            );
        }
    }
);
