<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * @package App
 */
class Activity extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_time', 'end_time', 'date'];

    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = ['user_id', 'date', 'start_time', 'end_time', 'state', 'heading', 'description'];

    /**
     * Get the data about the creator off the activity?
     *
     * @return mixed
     */
    public function creator()
    {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * Get the affected groups for this activity.
     *
     * @return mixed
     */
    public function groups()
    {
        return $this->belongsToMany('App\Groups');
    }

   

    /**
     * Format the timestamp format
     *
     * @param  string $date The start time from the form
     * @return string
     */
    public function setStartTimeAttribute($date)
    {
        // Use with Carbon instance:
        // -------
        // Carbon::createFromFormat('H:i', $date)->format('H:i');
        return $this->attributes['start_time'] = strtotime(str_replace('/', '-', $date));
    }

    /**
     * Format the timetamp format
     *
     * @param  string $date end time from the form
     * @return string
     */
    public function setEndTimeAttribute($date)
    {
        // Use with Carbon instance:
        // -------
        // Carbon::createFromFormat('H:i', $date)->format('H:i');
        return $this->attributes['end_time'] = strtotime(str_replace('/', '-', $date));
    }
}
