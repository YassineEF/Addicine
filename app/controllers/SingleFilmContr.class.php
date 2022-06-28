<?php

    class SingleFilmContr extends Film{

        protected $request;
        protected $id;
        protected $video;


        public function __construct($id){
            $this->id = $id;
            $this->request = new Film("https://api.themoviedb.org/3/movie/".$this->id."?api_key=".getenv('API_KEY')."&language=fr");
            $this->video = new Film("https://api.themoviedb.org/3/movie/".$this->id."/videos?api_key=".getenv('API_KEY')."&language=fr");
        }
        public function checkData(){
            $this->request->setOption();
            $this->request->getData();
            return $this->request->data;
        }
        public function getVideos(){
            $this->video->setOption();
            $this->video->getData();
            return $this->video->data['results'];
        }
        public function close(){
            $this->video->closeCurl();
            $this->request->closeCurl();
        }
    }