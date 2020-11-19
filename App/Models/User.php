<?php


namespace App\Models;

use App\Core\Model;

class User extends Model
{
    private string $dataPath;

    public function __construct()
    {
        parent::__construct();
        $this->dataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $users = array();
        foreach (glob($this->dataPath."/*.json") as $jsonFilePath){
            $user = json_decode(file_get_contents($jsonFilePath), true);
            $users[$user['id']] = $user;
        }
        return $users;
    }

    /**
     * @param string $id
     * @return false|mixed|void
     */
    public function getById(string $id)
    {
        $users = $this->getAll();
        if (isset($users[$id])){
            return $users[$id];
        }
        return false;
    }

    /**
     * @param array $userData
     * @return int
     */
    public function create(array $userData): int
    {
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        if (file_put_contents($this->dataPath.'/'.$userData['id'].".json",
            json_encode($userData))){
            return (int)$userData['id'];
        }
        return false;
    }

    /**
     * @param array $userData
     * @return int
     */
    public function update(array $userData): int
    {
        $this->delete($userData['id']);
        if (file_put_contents($this->dataPath.'/'.$userData['id'].".json", json_encode($userData))){
            return $userData['id'];
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $user = $this->getById($id);
        if (unlink($_SERVER['DOCUMENT_ROOT'] . "/userdata/" . $user['id'] . ".json")){
            if (isset($user['profile-image']) && $user['profile-image'] !== "/upload/noimage.jpg"){
                unlink($_SERVER['DOCUMENT_ROOT'] . $user['profile-image']);
            }
            if ($user['id'] == $_SESSION['userId']){
                session_start();
                session_destroy();
                header('Location:/');
            }
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function isUniqueUser(string $email): bool
    {
        $users = $this->getAll();
        foreach ($users as $user){
            if ($user['email'] == $email){
                return false;
            }
        }
        return true;
    }
}