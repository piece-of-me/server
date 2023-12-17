<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use App\Models\UsersEvent;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $faker = FakerFactory::create();

        $users->each(function (User $user) use ($users, $faker) {
            $max = $faker->numberBetween(1, 6);
            $maxParticipant = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $max; $i++) {
                $event = Event::create([
                    'header' => $faker->words(2, true),
                    'text' => $faker->text(350),
                    'creator_id' => $user->id,
                ]);
                UsersEvent::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);

                $users
                    ->filter(fn(User $filteredUser) => $filteredUser->id !== $user->id)
                    ->slice(0, $maxParticipant)
                    ->each(function (User $participant) use ($event) {
                        UsersEvent::create([
                            'user_id' => $participant->id,
                            'event_id' => $event->id,
                        ]);
                    });
            }
        });

    }
}
