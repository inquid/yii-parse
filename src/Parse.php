<?php

namespace inquid\parse;

use Parse\ParseClient;
use yii\base\Component;

class Parse extends Component
{
    public $app_id;
    public $rest_key;
    public $master_key;
    public $server_url;
    public $port = 1337;

    public function init()
    {
        parent::init();
        ParseClient::initialize($this->app_id, $this->rest_key, $this->master_key);
        ParseClient::setServerURL("{$this->server_url}:{$this->port}", 'parse');

    }

    public function healthCheck()
    {
        $health = ParseClient::getServerHealth();
        return $health['status'] === 200 ? true : false;
    }

    /** set curl http client (default if none set) */
    public function setHttpClient()
    {
        ParseClient::setHttpClient(new ParseCurlHttpClient());
    }

    /** set stream http client, requires 'allow_url_fopen' to be enabled in php.ini */
    public function setHttpClientStream()
    {
        ParseClient::setHttpClient(new ParseStreamHttpClient());
    }

    /**
     * Use an Absolute path for your file! holds one or more certificates to verify the peer with
     */
    public function setCAFile($file)
    {
        ParseClient::setCAFile($file);
    }

}
}
