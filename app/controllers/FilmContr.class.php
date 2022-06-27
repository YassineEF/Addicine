<?php
    // include_once "./models/DotEnv.class.php";

    class FilmContr extends Film{

        protected $request;


        public function __construct(){
            $this->request = new Film("https://api.themoviedb.org/3/movie/popular?api_key=".getenv('API_KEY')."&language=fr");
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