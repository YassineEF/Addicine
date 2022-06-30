<?php

    class FilmContr extends Film{

        protected $request;
        protected $movieGenres;
        protected $tvGenres;

        public function __construct(){
            $this->request = new Film("https://api.themoviedb.org/3/movie/popular?api_key=".getenv('API_KEY')."&language=en");
            $this->movieGenres = new Film("https://api.themoviedb.org/3/genre/movie/list?api_key=".getenv('API_KEY')."&language=en");
            $this->tvGenres = new Film("https://api.themoviedb.org/3/genre/tv/list?api_key=".getenv('API_KEY')."&language=en");
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
        public function getGenresTv(){
            $this->tvGenres->setOption();
            $this->tvGenres->getData();
            return $this->tvGenres->data['genres'];
        }
        public function close(){
            $this->tvGenres->closeCurl();
            $this->movieGenres->closeCurl();
            $this->request->closeCurl();
        }

    }