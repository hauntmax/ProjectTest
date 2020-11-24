<?php


namespace App\Forms;

use App\Forms\Validators\Validator;

class Form
{

    protected Validator $validator;

    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isSubmit(): bool
    {
        if (isset($_POST['submit'])) {
            return true;
        }
        return false;
    }

    /**
     * @param array|null $data
     * @return array
     */
    public function getValues(array $data = null): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function validateErrors(): array
    {
        return [];
    }
}