<?php
namespace inquid\parse;

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
        ParseClient::initialize( $this->app_id, $this->rest_key, $this->master_key );
        ParseClient::setServerURL("{$this->server_url}:{$this->port}",'parse');

    }

    public function healthCheck(){
      $health = ParseClient::getServerHealth();
      if($health['status'] === 200) ? return true:return false;
    }

}
