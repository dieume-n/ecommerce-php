<?php

namespace App\Utilities\Helpers;

class FileUpload
{
    protected $fileName, $maxFileZise = 209000, $extension, $path;

    /**
     * Get File Name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($file, $name = '')
    {
        if ($name === '') {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(['_', ' '], '-', $name));
        $hash = md5(microtime());
        $ext = $this->fileExtension($file);
        $this->fileName = "{$name}-{$hash}.{$ext}";
    }

    protected function fileExtension($file)
    {
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    public function fileSize($file)
    {
        $fileObj = new static;
        return $file > $fileObj->maxFileZise ? true : false;
    }

    /**
     * Validate File extension
     *
     * @param [type] $file
     * @return boolean
     */
    public static function isImage($file)
    {
        $fileObj = new static;
        $ext = $this->fileExtension($file);
        $validExt = ['jpg', 'jpeg', 'bmp'];

        if (!in_array(strtolower($ext), $validExt)) {
            return false;
        }
        return true;
    }

    /**
     * Get the path to the uploaded file
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Move uploaded file to intended location
     *
     * @param string $tempPath
     * @param string $folder
     * @param FiLE $file
     * @param string $newName
     * @return mixed
     */
    public static function move($tempPath, $folder, $file, $newName)
    {
        $fileObj = new static;
        $ds = DIRECTORY_SEPARATOR;

        $fileObj->setFileName($file, $newName);
        $fileName = $fileObj->getFileName();

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $fileObj->path = "{$folder}. {$ds}{$fileName}";
        $absPath = realpath(__DIR__ . "../../../public/{$fileObj->path}");

        if (move_uploaded_file($tempPath, $absPath)) {
            return $fileObj;
        }
        return null;
    }
}
