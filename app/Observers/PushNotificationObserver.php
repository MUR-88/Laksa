<?php

namespace App\Observers;

use App\Models\PushNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
// use Illuminate\Contracts\Queue\ShouldQueue;


//General sound 046a029d-a76d-4c84-b2c8-e81d4ce78f70
//General order c3e5da59-0920-4cc0-ae96-281e0bdfb2d1
//General error d2da18c1-0372-4730-a9d4-c3085d321182

class PushNotificationObserver
{
    public $afterCommit = true;
    
    public function created(PushNotification $pushNotification)
    {
        // Akses API ke OneSignal untuk buat notifikasi
        $tags = [];
        $schedule = null;

        $is_all = true;

        if ($pushNotification->user_id) {
            $is_all = false;
            $tags = [
                ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $pushNotification->user_id],
            ];
            $schedule = $pushNotification->scheduled_at ? Carbon::parse($pushNotification->scheduled_at)->timezone(7)
                ->format('Y-m-d H:i:s') . ' GMT+0700' : null;
        } elseif ($pushNotification->is_admin) {
            $is_all = false;
            $tags = [
                ["field" => "tag", "key" => "is_admin", "relation" => "=", "exists"],
            ];
            $schedule = $pushNotification->is_scheduled ? Carbon::parse($pushNotification->scheduled_at)->timezone(7)
                ->format('Y-m-d H:i:s') . ' GMT+0700' : null;
        }

        $client = new Client();

        try {
            $body = [
                "app_id" => config("onesignal.app_id"),
                "headings" => [
                    "en" => $pushNotification->judul,
                    "id" => $pushNotification->judul
                ],
                "contents" => [
                    "en" => $pushNotification->isi,
                    "id" => $pushNotification->isi
                ],
                "subtitle" => [
                    "en" => $pushNotification->isi,
                    "id" => $pushNotification->isi
                ],
            ];

            if ($is_all) {
                $body = [
                    ...$body,
                    "included_segments" => ['All'],
                ];
            } else {
                $body = [
                    ...$body,
                    "filters" => $tags,
                ];
            }

            if ($schedule) {
                $body = [
                    ...$body,
                    'send_after' => $schedule
                ];
            }

            if ($pushNotification->is_with_sound == 1) {
                if($pushNotification->is_admin == 1){
                    if ($pushNotification->tipe_suara == 1){
                        $body = [
                            ...$body,
                            "android_channel_id" => "7124d3f4-4203-40e1-980d-19dd185c3cb1"
                        ];
                    } elseif ($pushNotification->tipe_suara == 2){
                        $body = [
                            ...$body,
                            "android_channel_id" => "80f02a1e-95f7-4cb7-bd53-06871a1c1f23"
                        ];
                    } elseif ($pushNotification->tipe_suara == 3){
                        $body = [
                            ...$body,
                            "android_channel_id" => "c7692a31-6039-49b1-8af1-4401708c72f4"
                        ];
                    }
                } else {
                    if ($pushNotification->tipe_suara == 1){
                        $body = [
                            ...$body,
                            "android_channel_id" => "23d19b71-e411-4455-b132-caf40f58eb9c"
                        ];
                    } elseif ($pushNotification->tipe_suara == 2){
                        $body = [
                            ...$body,
                            "android_channel_id" => "3d53fbf0-738b-410b-8520-da8178d2dc96"
                        ];
                    } elseif ($pushNotification->tipe_suara == 3){
                        $body = [
                            ...$body,
                            "android_channel_id" => "58e145f9-bfad-4e1b-b190-1122190bdbeb"
                        ];
                    }
                }
            }

            $response = $client->request("POST", "https://onesignal.com/api/v1/notifications", [
                "body" => json_encode($body),
                "headers" => [
                    "Authorization" => "Basic " . config("onesignal.rest_api_key"),
                    "accept" => "application/json",
                    "content-type" => "application/json",
                ],
            ]);

            $response_body = $response->getBody();

            $pushNotification->update([
                "response_status" => $response->getStatusCode(),
                "response_message" => $response_body
            ]);
        } catch (\Exception $error) {
            $pushNotification->update([
                "response_status" => $error->getCode(),
                "response_message" => $error->getMessage()
            ]);
        }
    }

    public function updated(PushNotification $pushNotification)
    {
        //
    }

    public function deleted(PushNotification $pushNotification)
    {
        //
    }

    public function restored(PushNotification $pushNotification)
    {
        //
    }

    public function forceDeleted(PushNotification $pushNotification)
    {
        //
    }
}
