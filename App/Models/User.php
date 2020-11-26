<?php


namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function __construct()
    {
        self::$tableName = 'users';
        parent::__construct();
    }

    public static function getImagePath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function create(array $data)
    {
        $sql = "INSERT INTO " . self::$tableName . "(id,name,email,password,phone,profile_image)" .
            " VALUES (:id, :name, :email, :password, :phone, :profile_image)";
        return self::$db->query($sql, [
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'profile_image' => $data['profile_image'],
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function update(array $data)
    {
        $sql = "UPDATE " . self::$tableName .
            " SET name = :name, email = :email, password = :password, 
               phone = :phone, profile_image = :profile_image,
               status_account = :status_account, token = :token
               WHERE id = :id";
        return self::$db->query($sql, [
            'id' => isset($data['id']) ? $data['id'] : "",
            'name' => isset($data['name']) ? $data['name'] : "",
            'email' => isset($data['email']) ? $data['email'] : "",
            'password' => isset($data['password']) ? $data['password'] : "",
            'phone' => isset($data['phone']) ? $data['phone'] : "",
            'profile_image' => isset($data['profile_image']) ? $data['profile_image'] : "",
            'status_account' => isset($data['status_account']) ? $data['status_account'] : "",
            'token' => isset($data['token']) ? $data['token'] : "",
        ]);
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

        if (!move_uploaded_file($tmpFileName, self::getImagePath() . $nameImageFile . $format)) {
            die("При записи изображения на диск произошла ошибка.");
        }

        return '/upload/' . $nameImageFile . $format;
    }
}