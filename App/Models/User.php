<?php


namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public static function getImagePath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    }

    public function __construct()
    {
        self::$nameDirectory = 'userdata';
        parent::__construct();
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return parent::getAll();
    }

    /**
     * @param string $id
     * @return false|mixed|void
     */
    public static function getById(string $id)
    {
        return parent::getById($id);
    }

    /**
     * @param array $userData
     * @return int
     */
    public static function create(array $userData)
    {
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        return parent::create($userData);
    }

    /**
     * @param array $userData
     * @return int
     */
    public static function update(array $userData)
    {
        return parent::update($userData);
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function delete(string $id): bool
    {
        $user = self::getById($id);
        if (!$user) {
            return false;
        }
        if (isset($user['profile-image']) && $user['profile-image'] !== "/upload/noimage.jpg") {
            unlink($_SERVER['DOCUMENT_ROOT'] . $user['profile-image']);
        }
        if (isset($_SESSION['userId']) && $user['id'] == $_SESSION['userId']) {
            session_start();
            session_destroy();
            header('Location:/');
        }
        return parent::delete($id);
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function isUniqueUser(string $email): bool
    {
        foreach (self::getAll() as $user) {
            if ($user['email'] == $email) {
                return false;
            }
        }
        return true;
    }

    /**
     * Метод загружает изображение в директорию
     * @param string $tmpFileName
     * @return string
     * Возвращает путь загруженного изображения
     */
    public static function uploadProfileImage(string $tmpFileName): string
    {
        $errorCode = $_FILES['profile-image']['error'];
        // Проверка на ошибки при загрузке файла
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($tmpFileName)) {
            // || !is_uploaded_file($tmpFileName) - для проверки на то, что файл загружен
            // Массив с ошибками при загрузке файла
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            // Если в массиве нет кода ошибки, то ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            // Выведем название ошибки
            die($outputMessage);
        } else {
            echo 'Файл загружен.' . "<br>";
        }

        // Проверить MIME тип загружаемого файла
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_file($fileInfo, $tmpFileName);
        if (strpos($mime, 'image') === false) {
            die('Загружаемый файл должен быть изображением');
        }

        // Нужно добавить валидацию изображения
        $imageSize = getimagesize($tmpFileName);
        $limitBytes = 1024 * 1024 * 5;
        $limitWidth = 1600;
        $limitHeight = 900;
        if (filesize($tmpFileName) > $limitBytes) {
            die('Размер изображения не должен превышать 5 Мбайт');
        }
        //$imageSize[0] - ширина изображения
        if ($imageSize[0] > $limitWidth) {
            die('Ширина изображения не должна превышать 1280 точек');
        }
        //$imageSize[1] - высота изображения
        if ($imageSize[1] > $limitHeight) {
            die('Высота изображения не должна превышать 768 точек');
        }

        // Перемещение загружаемого файла в директорию $imageDir
        $nameImageFile = md5_file($tmpFileName);
        // $imageSize[2] - Тип изображения
        $extension = image_type_to_extension($imageSize[2]);
        $format = str_replace('jpeg', 'jpg', $extension);

        if (!move_uploaded_file($tmpFileName, self::getImagePath(). $nameImageFile . $format)) {
            die("При записи изображения на диск произошла ошибка.");
        }

        return '/upload/' . $nameImageFile . $format;
    }
}