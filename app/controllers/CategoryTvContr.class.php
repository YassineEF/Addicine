<?php

    class CategoryTvContr extends Film{
        protected $request;
        protected $category;
        protected $page;


        public function __construct($category,$page)
        {
            $this->category = $category;
            $this->page = $page;
            $this->request = new Film("https://api.themoviedb.org/3/tv/".$this->category."?api_key=".getenv('API_KEY')."&language=en&page=".$this->page);
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