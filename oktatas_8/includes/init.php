<?php
define('ROOT_DIR', dirname(dirname(__FILE__)));
define('INCLUDES_DIR', dirname(dirname(__FILE__)) . '/includes');
define('CLASSES_DIR', dirname(dirname(__FILE__)) . '/classes');
define('MODELS_DIR', dirname(dirname(__FILE__)) . '/Models');
define('TRAITS_DIR', dirname(dirname(__FILE__)) . '/Traits');
define('DEFINITIONS_DIR', dirname(dirname(__FILE__)) . '/definitions');
define('SUBMITTED_DATA_DIR', dirname(dirname(__FILE__)) . '/submittedData');
define('PUBLIC_DIR', dirname(dirname(__FILE__))  . '/public');
define('PUBLIC_USERS_DIR', dirname(dirname(__FILE__))  . '/public/users');
require(INCLUDES_DIR . '/helpers.php');