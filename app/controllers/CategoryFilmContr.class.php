<?php

    class CategoryFilmContr extends Film{
        protected $request;
        protected $category;

        public function __construct($category)
        {
            $this->category = $category;
            $this->request = new Film("https://api.themoviedb.org/3/movie/".$this->category."?api_key=".getenv('API_KEY')."&language=en");
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