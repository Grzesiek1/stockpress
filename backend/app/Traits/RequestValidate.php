<?php

declare(strict_types=1);

namespace App\Traits;

use App\Http\Responses\StandardResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait RequestValidate
{
    protected array $errors = [];

    protected function validateRequest(FormRequest $request): bool
    {
        $allParams = [
            $request->all(),
            $request->route()->parameters(),
            $request->allFiles(),
        ];

        return $this->validateParams(array_merge(...$allParams), $request->rules(), $request->messages());
    }


    protected function validateParams(array $params, array $rules, array $messages): bool
    {
        $validator = Validator::make($params, $rules, $messages);
        if ($validator->fails()) {
            $this->errors[] = $validator->errors();
        }

        return !$validator->fails();
    }

    protected function noErrors(): bool
    {
        return empty($this->errors);
    }

    protected function hasErrors(): bool
    {
        return !$this->noErrors();
    }

    protected function errorResponse(): JsonResponse
    {
        $responseCode = ResponseAlias::HTTP_BAD_REQUEST;

        return response()->json(
            new StandardResponse(ResponseAlias::$statusTexts[$responseCode], false, $this->errors, $responseCode, []),
            $responseCode
        );
    }
}
