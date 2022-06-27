<?php

    class Film{

        protected $curl;
        public $data;

        public function __construct($curl){
            $this->curl = curl_init($curl);
        }
        public function setOption(){
            curl_setopt_array($this->curl,[
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 1
            ]);
        }
        public function getData(){
            $this->data = curl_exec($this->curl);
            if($this->data == false){
                var_dump(curl_error($this->curl));
            }else{
                $this->data = json_decode($this->data, true);
            }
            curl_close($this->curl);
        }



    }