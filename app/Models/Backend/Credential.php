<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $table = 'si_credentials';

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
        'created_by',
        'updated_by',
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
