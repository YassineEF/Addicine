<?php

    class SingleFilmContr extends Film{

        protected $request;
        protected $id;
        protected $video;
        protected $actor;


        public function __construct($id){
            $this->id = $id;
            $this->request = new Film("https://api.themoviedb.org/3/movie/".$this->id."?api_key=".getenv('API_KEY')."&language=en");
            // $this->request = new Film("https://api.themoviedb.org/3/movie/278 ?api_key=".getenv('API_KEY')."&language=en");
            $this->video = new Film("https://api.themoviedb.org/3/movie/".$this->id."/videos?api_key=".getenv('API_KEY')."&language=en");
            $this->actor = new Film("https://api.themoviedb.org/3/movie/".$this->id."/credits?api_key=".getenv('API_KEY')."&language=en");
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
        public function getActor(){
            $this->actor->setOption();
            $this->actor->getData();
            return $this->actor->data['cast'];
        }
        public function close(){
            $this->actor->closeCurl();
            $this->video->closeCurl();
            $this->request->closeCurl();
        }
    }