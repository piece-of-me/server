<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Event\StoreRequest;
use App\Http\Resources\Event\EventResource;
use App\Http\Resources\Event\IndexEventResource;
use App\Models\Event;
use App\Models\UsersEvent;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function __construct(protected EventService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'error' => null,
            'result' => IndexEventResource::collection(Event::all())
        ]);
    }

    public function userIndex(): JsonResponse
    {
        return response()->json([
            'error' => null,
            'result' => IndexEventResource::collection(Event::where('creator_id', Auth::user()->id)->get())
        ]);
    }

    public function show(Event $event): JsonResponse
    {
        return response()->json([
            'error' => null,
            'result' => new EventResource($event),
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $event = $this->service->store(Auth::user()->id, $data);
        if (!isset($event)) {
            return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'error' => null,
            'result' => new IndexEventResource($event),
        ]);
    }

    public function join(Event $event): JsonResponse
    {
        $usersEvent = UsersEvent::firstOrCreate([
            'user_id' => Auth::user()->id,
            'event_id' => $event->id,
        ]);
        if ($usersEvent->id) {
            return response()->json([
                'error' => null,
                'result' => [
                    'success' => true,
                ],
            ]);
        }
        return response()->json(status: Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function refuse(Event $event): JsonResponse
    {
        $userEvent = UsersEvent::where('user_id', Auth::user()->id)->where('event_id', $event->id)->first();
        if (!$userEvent) {
            return response()->json([
                'error' => false,
                'result' => [
                    'success' => false,
                    'message' => 'Пользователь не участвует в событии',
                ],
            ]);
        }
        $userEvent->delete();
        return response()->json([
            'error' => false,
            'result' => [
                'success' => true,
            ],
        ]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return response()->json([
            'error' => null,
            'result' => [
                'success' => true,
            ],
        ]);
    }
}
