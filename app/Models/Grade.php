<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'grade',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
    
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }    

    

}
