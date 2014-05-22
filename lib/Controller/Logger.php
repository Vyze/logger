<?php
namespace vyze\logger;

class Controller_Logger extends \Controller {

/**
 * Add-on for Atk4 for log processes
 * Install:
 * 1. Add line to your object to use it:
 * $this->logger = $this->add('vyze\logger\Controller_Logger');

 * @author Vyze
*/

    public $log_path=''; //path to log file
    public $log_str = 'Stop execution: ';

	function init() {
		parent::init();

		// Check required ATK version
        //TODO: can't check on server
//		$this->api->requires('atk','4.2.5');

        //default
        $log_default = $this->api->getConfig('log_path','shared/upload/log');
        $this->log_path = $log_default;

        // add add-on locations to pathfinder
        $this->loc = $this->api->locate('addons',__NAMESPACE__,'location');
        $addon_location = $this->api->locate('addons',__NAMESPACE__);
        $this->api->pathfinder->addLocation($addon_location,array(
            'php'=>'lib',
//            'template'=>'templates',
            //'css'=>'templates/css',
        ))->setParent($this->loc);

	}

    /**
     * @return created file if $open is TRUE
     * @param string $path - path to file directory
     * @param bool $open
     * @throws \BaseException
     */
    function createLog($path='',$open=false){

        if(!$f = @fopen($path,'wb')){
            throw $this->exception('Log file is not created: wrong path!');
        };

        fwrite($f,"Created ".date('Y-m-d:H:i:s')."\n");

        if($open) return $f;
        @fclose($f);
    }

    /**
     * @param string $path - path to file
    */
    function getLog($path='default'){
        if($path=='default'){
           $path=$this->log_path;
        }
        $path.='-'.date('M-Y');

        if(is_file($path)){
            return @fopen($path,'a');
        }
        return $this->createLog($path,true);
    }

    /**
     * Functtion writes a text to log file and to console.log
     * @param $f - file to write
     * @param string $text
     * @param bool $js_log - if TRUE, write to console.log
    */
    function addToLog($f=null,$text=''){
//        if(!f || !is_writable($f)) throw $this->exception("Can't read log file!");

        try{
            fwrite($f,$text."\n");
        }catch(\BaseException $e){
            die("Can't write log file!: ".$e->getText()."\n");
        }
    }

    /**Close log file*/
    function closeLog($f=null,$text =''){

        if(gettype($f)=='resource'){
            if($text){
                $this->addToLog($f,$text);
            }
            @fclose($f);
        }
    }

    function setPath($path = ''){
        $this->log_path = $path;
        return $this;
    }

}
