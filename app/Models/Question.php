<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Question extends Model
{
        use SoftDeletes;
	protected $table = "questions"; //table name

    public function Subject(){
        return $this->belongsTo('App\Models\Subject','subject_id');
    } 

    public function ClassType(){
        return $this->belongsTo('App\Models\ClassType','class_type_id');
    } 
    
    public function Section(){
        return $this->belongsTo('App\Models\Master\Section','section_id');
    } 
    
    public function QuestionType(){
        return $this->belongsTo('App\Models\exam\QuestionType','question_type_id');
    } 

    public static function countQuestion(){
        $data = Question::count();
        return $data;
    }
    public static function countChapter(){
        $data = Question::whereNotNull('chapter_id')->groupBy('chapter_id')->count();
        return $data;
    }
    public static function countTopic(){
        $data = Question::whereNotNull('topic_id')->groupBy('topic_id')->count();
        return $data;
    }
	
    
}