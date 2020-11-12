<?php


namespace App\Controllers;

use App\Core\Controller;

class RegisterController extends Controller
{
    public function IndexAction()
    {
        if(isset($_POST['submit'])) {
            $userDataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
            $inputUserData = array(
                'id' => uniqid(),
                'name' => clean($_POST['name']),
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password']),
                'phone' => clean($_POST['phone'])
            );
            if (is_unique_user($userDataPath, $inputUserData['email'])){
                save_user($userDataPath, $inputUserData);
                login_user($userDataPath,
                    ['email' => $inputUserData['email'], 'password' => $inputUserData['password']]
                );
            }
        }

        $this->view->render("Регистрация");
    }
}