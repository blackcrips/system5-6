
<?php

include_once('autoLoadClasses.inc.php');
$controller = new Controller();

if(!isset($_POST['repayment-action'])){
    header("LOCATION: ../");
    exit(0);
} elseif ($_POST['repayment-action'] == 'check'){
    $controller->validateRepaymentPassword();
} elseif($_POST['repayment-action'] == 'add'){
    $controller->repaymentAction();
} elseif($_POST['repayment-action'] == 'edit') {
    $controller->repaymentAction();
} else {
    header("LOCATION: ../");
    exit(0);
}

