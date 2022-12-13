<?php

namespace App\Http\Controllers;

use App\Enums\ServiceEventStatusEnum;
use App\Http\Requests\FinishServiceEventRequest;
use App\Models\ServiceEvent;
use Illuminate\Http\Request;

class ServiceEventController extends Controller
{
    public function finishServiceEvent(FinishServiceEventRequest $request)
    {
        $values = $request->validated();
        $event = ServiceEvent::find($values['id']);
        $event->status = ServiceEventStatusEnum::FINISHED;
        if (isset($values['note'])) {
            $event->note = $values['note'];
        }
        $event->save();
        return redirect()->route('dashboard')
            ->with('return_code', 200)
            ->with('return_message', 'Wykonano serwis');
    }
}
