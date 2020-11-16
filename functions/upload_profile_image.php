<?php

/**
 * Сохраняет картинку $tmpFileName в директирию $imageDir.
 * @param string $tmpFileName
 * @param string $imageDir
 * @return string
 * Возвращает путь сохранившейся картинки
 */
function upload_profile_image(string $tmpFileName, string $imageDir): string
{
    $errorCode = $_FILES['profile-image']['error'];
    // Проверим на ошибки
    if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($tmpFileName)) {
        // || !is_uploaded_file($tmpFileName) - для проверки на то, что файл загружен
        // Массив с названиями ошибок
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
            UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
            UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
            UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
            UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
        ];
        // Зададим неизвестную ошибку
        $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
        // Если в массиве нет кода ошибки, то ошибка неизвестна
        $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode]: $unknownMessage;
        // Выведем название ошибки
        die($outputMessage);
    } else {
        echo 'Ошибок нет.';
    }

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = (string) finfo_file($fileInfo, $tmpFileName);
    if (strpos($mime, 'image') === false){
        die('Загружаемый файл должен быть изображением');
    }

    // Нужно добавить валидацию изображения
    $imageSize = getimagesize($tmpFileName);
    $limitBytes = 1024*1024*5;
    $limitWidth = 1280;
    $limitHeight = 768;
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

    if (!move_uploaded_file($tmpFileName, $imageDir . $nameImageFile . $format)) {
        die("При записи изображения на диск произошла ошибка.");
    }

    return  "/upload/" . $nameImageFile . $format;
}