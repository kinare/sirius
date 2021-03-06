<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'student.created' => [
            \App\Listeners\StudentListener::class,
        ],
//        'approval_entry.updated' => [
//            \App\Listeners\ApprovalEntryUpdatedListener::class,
//        ],
//        'employee_leave_application.created' => [
//            \App\Listeners\LeaveApplicationCreatedListener::class,
//        ],
//        'employee_leave_application.updated.status' => [
//            \App\Listeners\LeaveApplicationStatusChangedListener::class,
//        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
