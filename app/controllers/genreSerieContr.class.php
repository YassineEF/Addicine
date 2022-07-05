<?php

    class genreSerieContr extends Film{
        protected $request;
        protected $id;
        protected $page;
        
        public function __construct($id,$page)
        {
            $this->id = $id;
            $this->page = $page;
            $this->request = new Film("https://api.themoviedb.org/3/discover/tv?api_key=".getenv('API_KEY')."&language=en&with_genres=".$this->id."&page=".$this->page);
            $this->tvGenres = new Film("https://api.themoviedb.org/3/genre/tv/list?api_key=".getenv('API_KEY')."&language=en");
        }
        public function checkData(){
            $this->request->setOption();
            $this->request->getData();
            return $this->request->data['results'];
        }
        public function getGenresTv(){
            $this->tvGenres->setOption();
            $this->tvGenres->getData();
            return $this->tvGenres->data['genres'];
        }
        
        public function close(){
            $this->request->closeCurl();
        }
    }