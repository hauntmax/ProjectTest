<?php


namespace App\Controllers;

use App\Core\Controller;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/is_unique_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/save_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/upload_profile_image.php";

class RegisterController extends Controller
{
    public function IndexAction()
    {
        if(isset($_POST['submit']))
        {
            $userDataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
            $inputUserData = array(
                'id' => uniqid(),
                'name' => clean($_POST['name']),
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password']),
                'phone' => clean($_POST['phone']),
                'profile-image' => !empty($_FILES['profile-image']['name']) ?
                                        upload_profile_image($_FILES['profile-image']['tmp_name'],
                                            $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg"
            );
            if (is_unique_user($userDataPath, $inputUserData['email'])){
                if (!empty(checkValidateUser($inputUserData)))
                {
                    $this->view->render("Регистрация", [
                        'errorsValidate' => checkValidateUser($inputUserData)
                    ]);
                }
                else {
                    save_user($userDataPath, $inputUserData);
                    login_user($userDataPath,
                        ['email' => $inputUserData['email'], 'password' => $inputUserData['password']]
                    );
                }
            }
            else {
                $this->view->render("Регистрация", [
                    'errorUnique' => "Пользователь с Email: ".$inputUserData['email']." уже существует."
                ]);
            }
        }
        else {
            $this->view->render("Регистрация");
        }
    }
}