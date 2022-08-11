<?php
namespace imoisesf;

use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [
        "data"=>[]
    ];

    public function __construct($opts = array(), $tpl_dir = "views/user/")
    {
        $this->options = array_merge($this->defaults, $opts);
        //echo $_SERVER["DOCUMENT_ROOT"];
        $config = array(
            "base_url"      => null,
            "tpl_dir"       => $tpl_dir,
            "cache_dir"     => "views-cache/",
            "debug"         => false // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;
        
        $this->setData($this->options["data"]);

        $this->tpl->draw("header");


    }

    public function __destruct()
    {
        $this->tpl->draw("footer");
    }

    
    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }

    private function setData($data = array())
    {
        foreach ($this->options["data"] as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }
}

?>