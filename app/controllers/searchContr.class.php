<?php

    class searchContr extends Film{
        protected $request;
        protected $keyWord;

        public function __construct($keyWord)
        {
            $this->keyWord = $keyWord;
            $this->request = new Film("https://api.themoviedb.org/3/search/multi?api_key=".getenv('API_KEY')."&language=en&query=".$this->keyWord);
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