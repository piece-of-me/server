<?php

namespace App\Services;

use App\Models\Event;
use App\Models\UsersEvent;
use Illuminate\Support\Facades\DB;

class EventService
{
    public function store(int $userId, array $data): ?Event
    {
        DB::beginTransaction();
        try {
            $event = Event::create([
                'header' => $data['header'],
                'text' => $data['text'],
                'creator_id' => $userId,
            ]);
            UsersEvent::create([
                'user_id' => $userId,
                'event_id' => $event->id,
            ]);

            DB::commit();
            return $event;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        return null;
    }

}
