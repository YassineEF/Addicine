<?php

    class SingleActorContr extends Film{
        protected $request;
        protected $id;
        protected $movies;

        public function __construct($id)
        {
            $this->id = $id;
            $this->request = new Film("https://api.themoviedb.org/3/person/".$this->id."?api_key=".getenv('API_KEY')."&language=en");
            $this->movies = new Film("https://api.themoviedb.org/3/person/".$this->id."/combined_credits?api_key=".getenv('API_KEY')."&language=en");
        }
        public function checkData(){
            $this->request->setOption();
            $this->request->getData();
            return $this->request->data;
        }
        public function getMovies(){
            $this->movies->setOption();
            $this->movies->getData();
            return $this->movies->data['cast'];
        }
        public function close(){
            $this->movies->closeCurl();
            $this->request->closeCurl();
        }
    }