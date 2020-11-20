<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Validators\UserValidator;
use PHPMailer\PHPMailer\PHPMailer;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/upload_profile_image.php";

class RegisterController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
        $this->validator = new UserValidator();
    }

    public function IndexAction()
    {
        if (isset($_POST['submit'])) {
            $inputUserData = array(
                'id' => uniqid(),
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'status-account' => false,
                'password' => $this->validator->clean($_POST['password']),
                'phone' => $this->validator->clean($_POST['phone']),
                'profile-image' => !empty($_FILES['profile-image']['name']) ?
                    upload_profile_image($_FILES['profile-image']['tmp_name'],
                        $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg"
            );
            if ($this->model->isUniqueUser($inputUserData['email'])) {
                if (!empty($this->validator->Validate($inputUserData))) {
                    $this->view->render("Регистрация", [
                        'errorsValidate' => $this->validator->Validate($inputUserData)
                    ]);
                } else {
                    $inputUserData['token'] = md5($inputUserData['email'] . time());
                    $this->model->create($inputUserData);
//                    $this->view->redirect("/register");
                    $this->SendToken($inputUserData['email'], $inputUserData['id'], $inputUserData['token']);
                }
            } else {
                $this->view->render("Регистрация", [
                    'errorUnique' => "Пользователь с Email: " . $inputUserData['email'] . " уже существует."
                ]);
            }
        } else {
            $this->view->render("Регистрация");
        }
    }

    /**
     *
     */
    public function ActivationAction()
    {
        unset($_SESSION['successMessageRegister']);
        $token = $this->route['token'];
        $user = $this->model->getById($this->route['id']);
        if ($user && $token === $user['token']) {
            $user['status-account'] = true;
            unset($user['token']);
            $this->model->update($user);
            $this->view->render('Активация аккаунта', [
                'successActivation' => "Аккаунт " . $user['email'] . " активирован"
            ]);
        } else {
            $this->view->render('Активация аккаунта', [
                'errorActivation' => "Неверный токен активации или пользователь " . $user['email'] . " не найден"
            ]);
        }
    }

    /**
     * @param $email
     * @param $id
     * @param $token
     */
    private function SendToken($email, $id, $token)
    {
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "gfiniti.drive@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "ldc82mkpr";
        $mail->CharSet = "utf-8";
        //Set who the message is to be sent from
        $mail->setFrom('vagrant@homestead.com', 'Maksim');
        //Set an alternative reply-to address
        $mail->addReplyTo($email, 'Maksim');
        //Set who the message is to be sent to
        $mail->addAddress($email, 'SendToken');
        //Set the subject line
        $mail->Subject = "Подтверждение почты на сайте " . $_SERVER['HTTP_HOST'];
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $message = 'Нужно подтвердить регистрацию на сайте
                <a href="' . $_SERVER['HTTP_HOST'] . '">' . $_SERVER['HTTP_HOST'] . '</a>
                Пожалуйста, подтвердите адрес вашей электронной почты, перейдя по этой ссылке:
                <a href="' . $_SERVER['HTTP_HOST'] . '/register/activation/' . $token . '/' . $id . '">
                    ' . $_SERVER['HTTP_HOST'] . '/register/activation/' . $token . '/' . $id . '
                </a>';
        $mail->msgHTML($message, dirname(__FILE__));
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //send the message, check for errors

        if (!$mail->send()) {
            die("При отправке подтверждения на Email что-то пошло не так<br>" . $mail->ErrorInfo);
        } else {
            $_SESSION['successMessageRegister'] = "<strong>Регистрация прошла успешно!!!</strong>
                Нужно перейти по ссылке, отправленной на $email";
            exit();
        }
    }
}