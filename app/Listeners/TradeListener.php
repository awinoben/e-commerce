<?php

namespace App\Listeners;

use App\Events\TradeEvent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ShiftechAfrica\CodeGenerator\ShiftCodeGenerator;

class TradeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TradeEvent $event
     * @return void
     */
    public function handle(TradeEvent $event)
    {
        if (Schema::hasColumn($event->model->getTable(), 'slug')) {
            $event->model->slug = Str::slug($event->model->name);
        }

        if (Schema::hasColumn($event->model->getTable(), 'value')) {
            $event->model->slug = Str::slug($event->model->value);
        }

        if (Schema::hasColumn($event->model->getTable(), 'sku')) {
            if (is_null($event->model->sku))
                $event->model->sku = (new ShiftCodeGenerator)->generate();
        }

        if (Schema::hasColumn($event->model->getTable(), 'order_number')) {
            $event->model->order_number = (new ShiftCodeGenerator)->generate();
        }

        if (Schema::hasColumn($event->model->getTable(), 'password')) {
            if (request()->has('password')) {
                $event->model->password = bcrypt(request()->input('password'));
            }
        }
    }
}
