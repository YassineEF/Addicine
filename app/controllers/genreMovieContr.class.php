<?php

    class genreMovieContr extends Film{
        protected $request;
        protected $id;
        protected $page;

        public function __construct($id,$page)
        {
            $this->id = $id;
            $this->page = $page;
            $this->request = new Film("https://api.themoviedb.org/3/discover/movie?api_key=".getenv('API_KEY')."&language=en&with_genres=".$this->id."&page=".$this->page);
            $this->movieGenres = new Film("https://api.themoviedb.org/3/genre/movie/list?api_key=".getenv('API_KEY')."&language=en");
        }
        public function checkData(){
            $this->request->setOption();
            $this->request->getData();
            return $this->request->data['results'];
        }
        public function getGenres(){
            $this->movieGenres->setOption();
            $this->movieGenres->getData();
            return $this->movieGenres->data['genres'];
        }
        
        public function close(){
            $this->request->closeCurl();
        }
    }