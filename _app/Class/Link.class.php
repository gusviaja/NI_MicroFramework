<?php

/**
 * Link [ MODEL ]
 * Classe responsável por organizar o SEO do sistema e realizar a navegação!
 * 
 * @copyright (c) 2015, Nestor G. Tedesco Iglesias - NI SISTEMAS WEB
 */
class Link {

    private $File;
    private $Link;

    /** DATA */
    private $Local;
    private $Patch;
    private $Tags;
    private $Data;

    /** @var Seo */
    private $Seo;
    
    function __construct() {
       
       

        // $this->Local = strip_tags(trim(filter_input(INPUT_SERVER, 'REQUEST_URI')));
        // var_dump($this->Local);
        // $this->Local = ($this->Local ? $this->Local : 'index');
        //  var_dump($this->Local);
        //  $this->Local = explode('/', $this->Local);
        //   var_dump($this->Local);
         
        //      $this->File = (isset($this->Local[0] && $this->Local[0] == "" ) ? $this->Local[0] : 'index');
        //     $this->Link = (isset($this->Local[2]) ? $this->Local[2] : null);
        
        //     $this->File = 'index' ;
        //     $this->Link = null;
         
        
        // $this->Seo = new Seo($this->File, $this->Link);
        //   var_dump($this->Link);;
        //     var_dump($this->File);
        //     
        //     
            
             $this->Local = strip_tags(trim(filter_input(INPUT_SERVER, 'REQUEST_URI')));
             if($this->Local == "/"):
                $this->File = 'index';
                $this->Link == null;
             else:
                $this->Local = explode('/',$this->Local);
                $this->File = $this->Local[1];
                isset($this->Local[2]) ? $this->Link = $this->Local[2] : null;
             endif;   


        // var_dump($this->Local == '/');
        // $this->Local = ($this->Local == "/" ? 'index' : $this->Local );
        //  // var_dump($this->Local);
        //  $this->Local = explode('/', $this->Local);
        //   var_dump($this->Local);
        //   if($this->Local[1] != ""):
        //      $this->File = (isset($this->Local[1]) ? $this->Local[1] : 'index');
        //     $this->Link = (isset($this->Local[2]) ? $this->Local[2] : null);
        //   else:
        //     $this->File = 'index' ;
        //     $this->Link = null;
        //   endif;
        
        $this->Seo = new Seo($this->File, $this->Link);
          // var_dump($this->Link);;
          //   var_dump($this->File);
      
       
    }

      
    public function getTags() {
        $this->Tags = $this->Seo->getTags();
            echo $this->Tags;
    }

    public function getData() {
        $this->Data = $this->Seo->getData();
        return $this->Data;
    }

    public function getLocal() {
        return $this->Local;
    }

    public function getPatch() {
        $this->setPatch();
        return $this->Patch;
    }

    //PRIVATES
    private function setPatch() {
     
        if (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . '.php';
        elseif (file_exists(REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php')):
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . $this->File . DIRECTORY_SEPARATOR . $this->Link . '.php';
        else:
            $this->Patch = REQUIRE_PATH . DIRECTORY_SEPARATOR . '404.php';
        endif;
    }

}
