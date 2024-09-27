<?php

namespace App\Console\Commands;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class SendNotifyFcm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notify-fcm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private function getAccessToken()
    {
        $credentialsPath = storage_path('app/json/firebase-service-account.json'); // Path to your service account file

        $client = new GoogleClient();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];
    }

    private function toFcm()
    {
        return [
                'topic' => 'news',
                'notification' => [
                    'title' => 'Breaking News',
                    'body' => 'New news story available.'
                ],
                'data' => [
                    'story_id' => 'story_12345'
                ]
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = $this->toFcm();
        $client = new Client();
        $response = $client->post('https://fcm.googleapis.com/v1/projects/test-9ae10/messages:send', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'message' => [
                    'topic' => $message['topic'],
                    'notification' => $message['notification'],
                    'data' => $message['data'],
                ],
            ],
        ]);
        return $response->getBody()->getContents();
    }
}
