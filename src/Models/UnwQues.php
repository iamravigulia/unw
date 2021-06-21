<?php
namespace Edgewizz\Unw\Models;

use Illuminate\Database\Eloquent\Model;

class UnwQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Unw\Models\UnwAns', 'question_id');
    }
    protected $table = 'fmt_unjumble_words_ques';
}