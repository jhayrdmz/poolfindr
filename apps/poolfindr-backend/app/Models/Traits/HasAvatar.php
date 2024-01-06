<?php

namespace App\Models\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use App\Enums\MediaCollectionType;
use Spatie\MediaLibrary\InteractsWithMedia;

trait HasAvatar
{
    use InteractsWithMedia;

    /**
     * Avatar Relationship
     */
    public function avatar()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', MediaCollectionType::USER_AVATAR);
    }

    /**
     * Register media collections
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionType::USER_AVATAR)
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')->width(254);
            });
    }

    /**
     * Remove the avatar media.
     *
     * @return void
     */
    public function removeAvatar(): void
    {
        $this->touch();

        $this->avatar()->delete();
    }

    /**
     * Set the avatar of the user
     *
     * @param UploadedFile $file
     * @return Media
     */
    public function setAvatar(UploadedFile $file)
    {
        // Hashing file name
        $name = md5(uniqid(self::class . $this->getKey(), true));
        $fileName = $name . '.' . $file->extension();

        $this->touch();

        return $this->addMedia($file)
            ->usingName($name)
            ->usingFileName($fileName)
            ->toMediaCollection(MediaCollectionType::USER_AVATAR);
    }
}
