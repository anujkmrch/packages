<?php

namespace Dsvv\Models;

use Illuminate\Database\Eloquent\Model;
use Order\Contracts\CartItemInterface;

class Course extends Model
{
    protected $_table = 'courses';

    /**
     * Boot function for using with User Events.
     *
     * @todo Move events to an Observer.
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            Event::fire(new SubscriptionCreated($model));
        });

        static::saving(function ($model) {
            // Set period if it wasn't set
            if (! $model->ends_at) {
                $model->setNewPeriod();
            }
        });

        static::saved(function ($model) {
            if ($model->getOriginal('plan_id') !== $model->plan_id) {
                event(new SubscriptionPlanChanged($model));
            }
        });
    }

    public function Session()
    {
    	return $this->belongsTo(CourseSession::class);
    }

    public function Applications()
    {
    	return $this->hasMany(CourseApplication::class);
    }
}
