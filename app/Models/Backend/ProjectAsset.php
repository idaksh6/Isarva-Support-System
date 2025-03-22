<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAsset extends Model
{
    use HasFactory;

    protected $table = 'si_project_assets';

    protected $fillable = [
        'project_id',
        'user_id',
        'image_path',
        'filename',
        'is_image',
        'uploaded_time',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false; // Since `uploaded_time` is used instead of `created_at
}
