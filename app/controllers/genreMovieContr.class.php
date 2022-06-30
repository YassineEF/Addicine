<?php

    class genreMovieContr extends Film{
        protected $request;
        protected $id;

        public function __construct($id)
        {
            $this->id = $id;
            $this->request = new Film("https://api.themoviedb.org/3/discover/movie?api_key=".getenv('API_KEY')."&language=en&with_genres=".$this->id);
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