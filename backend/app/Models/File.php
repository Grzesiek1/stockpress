<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const STORAGE_IMAGES_PATH = '/app/public/images/';
    const STORAGE_IMAGES_THUMBNAILS_PATH = '/app/public/images/thumbnails/';

    use HasFactory;

    protected $fillable = [
        'name',
        'hash',
        'type',
        'size',
        'resolution',
        'exif_data',
        'iptc_data',
        'temperature',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'exif_data' => 'json',
        'iptc_data' => 'json',
    ];

    protected $appends = [
        'sender_name',
        'sender_email',
        'image_url',
        'thumbnails_url'
    ];

    protected $hidden = [
        'hash',
    ];

    /**
     * Define the relationship between File and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Access the sender's name using the sender relationship.
     *
     * @return string
     */
    public function getSenderNameAttribute()
    {
        return ($this->sender) ? $this->sender->name : null;
    }

    /**
     * Access the sender's email using the sender relationship.
     *
     * @return string
     */
    public function getSenderEmailAttribute()
    {
        return ($this->sender) ? $this->sender->email : null;
    }

    public function getImageUrlAttribute()
    {
        return route('showImage', ['file' => $this->id]);
    }

    public function getThumbnailsUrlAttribute()
    {
        return route('showThumbnail', ['file' => $this->id]);
    }
}
