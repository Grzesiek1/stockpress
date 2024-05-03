<?php
declare(strict_types=1);

namespace App\Http\Responses;
class StandardResponse
{
    public string $message;

    public bool $success;

    public array $errors;

    public int $code;

    public array $data;

    public function __construct(string $message, bool $success, array $errors, int $code, array $data)
    {
        $this->message = $message;
        $this->success = $success;
        $this->errors = $errors;
        $this->code = $code;
        $this->data = $data;
    }
}
