<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class TransactionCard extends Component
{
    public $order;
    public $schedule;
    public $timeStart;
    public $timeEnd;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->schedule = Carbon::make($order->play_date)->locale('id')->translatedFormat('l, d F Y');
        $this->timeStart = Carbon::make($order->start_at)->format('H:i');
        $this->timeEnd = Carbon::make($order->end_at)->format('H:i');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.transaction-card');
    }
}
