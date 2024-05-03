<?php

namespace App\Services;

use App\Models\File;
use App\Models\User;
use App\Services\OpenMeteo\OpenMeteoService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManagerService extends FileService
{
    public function __construct(
        private readonly UserService $userService,
        private OpenMeteoService     $meteoService
    )
    {
    }

    public function add(?UploadedFile $file, string $email, string $name): void
    {
        $file = $this->save($file);

        $user = $this->userService->findUserByEmail($email);
        if (!$user instanceof User) {
            $user = $this->userService->createUser($email, $name);
        }

        $file->sender()->associate($user);
        $file->temperature = $this->meteoService->getTemperatureByCity('KATOWICE');
        $file->save();
    }

    public function remove(int $id): void
    {
        File::findOrFail($id)->delete();
    }
}
