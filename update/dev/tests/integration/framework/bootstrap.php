<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
require_once __DIR__ . '/magento_bp.php';
require_once __DIR__ . '/../../../../app/bootstrap.php';

if (!defined('TESTS_TEMP_DIR')) {
    define('TESTS_TEMP_DIR', dirname(__DIR__) . '/tmp');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
