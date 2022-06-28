<?php

    class SerieContr extends Film{

        protected $request;


        public function __construct(){
            $this->request = new Film("https://api.themoviedb.org/3/tv/popular?api_key=".getenv('API_KEY')."&language=fr");
        }
        public function checkData(){
            $this->request->setOption();
            $this->request->getData();
            return $this->request->data['results'];
        }
        public function close(){
            $this->request->closeCurl();
        }

    }