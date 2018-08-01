<?php

namespace App\Shell;

use Cake\Console\Shell;
use \Workerman\Worker;
use App\Utility\PHPSocketIO\SocketIO;
use Cake\Http\Client;

class SocketioShell extends Shell {

    public $port = SOCKET_PORT;
    public $http;
    public $authToken;
    public $io;

    public function main() {

        $this->io = new SocketIO($this->port);

        $this->io->on('connection', function($socket) {

            echo "Connected ! \n";
            
            $socket->on('join_room', function ($eventData)use($socket) {
                $data = is_array($eventData) ? $eventData : json_decode($eventData, true);
                echo "Joined Room - " . $data['room'] . " \n";
                $socket->join($data['room']);
            });


            // when the client emits 'new message', this listens and executes
            $socket->on('post_message', function ($eventData)use($socket) {
                echo "Message Posted ! \n";
                $message = is_array($eventData) ? $eventData : json_decode($eventData, true);
                $this->authToken = $message['auth_token'];
                $this->getCakeClient();
                $response = $this->http->post(SITE_URL . '/chats/newMessage', $message);
                $data = json_decode($response->body(), true);
                file_put_contents('/var/www/html/beltway/webroot/test.txt', print_r($data, true));
                $this->io->to($message['room'])->emit('new_message', $data['data']['message']);
            });
            

            // when the user disconnects.. perform this
            $socket->on('disconnect', function () use($socket) {
                //Do Something
            });
        });

        global $argv;

        if (!empty($argv[2])) {
            $argv[1] = $argv[2];
            Worker::runAll();
        } else {
            $availableCommands = array(
                'start',
                'stop',
                'restart',
                'reload',
                'status',
                'connections',
            );
            $usage = "Usage: Pass third parameter from {" . implode('|', $availableCommands) . "} [-d]\n";
            exit($usage);
        }
    }

    public function getCakeClient() {
        $this->http = new Client([ 'headers' => [
                'Authorization' => 'Bearer ' . $this->authToken,
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function test($args) {
        file_put_contents('/var/www/html/hooty/trunk/webroot/test.txt', print_r($args, true));
    }

}
