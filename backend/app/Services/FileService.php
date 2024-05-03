<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Models\File;
use Illuminate\Support\Facades\File as FacadesFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private string $name;
    private string $hash;
    private string $type;
    private int $size;
    private string $resolution;
    private array $exif;
    private array $iptc;
    private ?File $file;

    public function getFileUrl(): ?string
    {
        return $this->file->getImageUrlAttribute();
    }

    protected function save(?UploadedFile $file): File
    {
        $this->readData($file);
        $this->savePhisicalFile($file);
        $this->savePhisicalThumbnailsFile();
        return $this->persistToDatabase();
    }

    private function readData(?UploadedFile $file): void
    {
        $this->name = $file->getClientOriginalName();
        $this->hash = hash('sha256', rand());
        $this->type = $file->getClientOriginalExtension();
        $this->size = ImageHelper::getSize($file);
        $this->resolution = ImageHelper::getResolution($file);
        $this->exif = ImageHelper::getExif($file);
        $this->iptc = ImageHelper::getIptc($file);
    }

    private function savePhisicalFile(?UploadedFile $file): void
    {
        $file->move(storage_path(File::STORAGE_IMAGES_PATH), $this->hash);
    }

    private function savePhisicalThumbnailsFile(): void
    {
        if (!FacadesFile::exists(storage_path(File::STORAGE_IMAGES_THUMBNAILS_PATH))) {
            FacadesFile::makeDirectory(storage_path(File::STORAGE_IMAGES_THUMBNAILS_PATH));
        }

        $imageManager = new ImageManager(new Driver());
        $imageManagerFile = $imageManager->read(storage_path(File::STORAGE_IMAGES_PATH) . $this->hash);
        $imageManagerFile->scale(width: 250);
        $imageManagerFile->save(storage_path(File::STORAGE_IMAGES_THUMBNAILS_PATH . $this->hash));
    }

    private function persistToDatabase(): File
    {
        $file = new File();
        $file->name = $this->name;
        $file->hash = $this->hash;
        $file->type = $this->type;
        $file->size = $this->size;
        $file->resolution = $this->resolution;
        $file->exif_data = $this->exif;
        $file->iptc_data = $this->iptc;
        $file->save();
        $this->file = $file;

        return $file;
    }

}
