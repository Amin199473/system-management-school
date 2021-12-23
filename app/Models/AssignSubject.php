<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;

    public function school_subject() {
        return $this->belongsTo(SchoolSubject::class,'subject_id','id');
    }

    public function class() {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
}
