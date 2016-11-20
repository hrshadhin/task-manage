<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
  //protected $dates = ['deadLine'];
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'title', 'description', 'status', 'due_date','users_id'
  ];
  protected $hidden = [
        'users_id',
    ];
  function setDueDateAttribute($value)
  {
    if($value !='')
      return $this->attributes['due_date'] = Carbon::createFromFormat('Y-m-d', $value);
    else
      return $this->attributes['due_date'] =null;
  }
  function getUpdatedAtAttribute($dateTime)
  {
      return Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)
      ->format('M j,y H:i:s');
  }
  function getDueDateAttribute($date)
  {
    if($date !='')
      return Carbon::createFromFormat('Y-m-d', $date)
      ->format('M j,y');
    return "";
  }
}
