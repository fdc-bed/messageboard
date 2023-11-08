<?php 
App::uses('AppHelper', 'View/Helper');
class CustomHelper extends AppHelper {
    public $helpers = array('Html');
    public function activeLink($linkName, $controller, $action) {
        $currentController = $this->request->params['controller'];
        $currentAction = $this->request->params['action'];
        $class_name = array('class'=>'nav-link');
        $redirect_ca = array('controller'=> $controller, 'action'=> $action);

        if ($currentController === $controller && $currentAction === $action) {
            $class_name = array('class'=>'nav-link active');
            return $this->Html->link($linkName, $redirect_ca, $class_name); // CSS class for active link
        }
            return $this->Html->link($linkName, $redirect_ca, $class_name); // CSS class for active link
    }

    public function birthdateFormat($birthdate) {
        if($birthdate!=null){
            $birthdate = date_create($birthdate);
            return date_format($birthdate,'M d, Y');
        }else{
            return 'n/a';
        }
    }

    public function ageDisplay($birthdate) {
        if($birthdate!=null){
            // Calculate the age
            $today = new DateTime();
            $birthdate = new DateTime($birthdate);
            $age = $today->diff($birthdate)->y;
            return $age;
        }else{
            return 'n/a';
        }
    }

    public function datetimeFormat($date_param){
        if($date_param!=null){
            $date_param = date_create($date_param);
            return date_format($date_param,'M d, Y ga');
        }else{
            return 'n/a';
        }
    }

    public function datetimeFormatMessage($date_param){
        if($date_param!=null){
            $date_param = date_create($date_param);
            return date_format($date_param,'M d, Y g:ia');
        }else{
            return 'n/a';
        }
    }

    public function genderDisplay($gender){
        if($gender!=null){
            switch($gender):
                case "M":
                    return "Male";
                break;
                case "F":
                    return "Female";
                break;
                default:
                    return "not specificied";
                break;
            endswitch;
        }else{
            return 'n/a';
        }
    }

    public function hobbyDisplay($hobby){
        if($hobby!=null){
            return $hobby;
        }else{
            return 'n/a';
        }
    }
}

?>