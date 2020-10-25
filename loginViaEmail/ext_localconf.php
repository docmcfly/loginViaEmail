<?php

defined('TYPO3_MODE') || die('Access denied.');

// $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::class] = [
// 'className' => Cylancer\Loginviaemail\XClass\CyFrontendUserAuthentication::class
// ];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'cylancer', 
    // Service type
    'auth', 
    // Service key
    Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService::SERVICE_KEY, array(
        'title' => 'Login via email',
        'description' => 'Allows an login with email address as user name',

        'subtype' => 'getUserFE,authUserFE',

        'available' => true,
        'priority' => 60,
        'quality' => 50,

        'os' => '',
        'exec' => '',
        'className' => Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService::class
    ));


