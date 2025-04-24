<?php

namespace Controllers\_BaseController_\Events\LoggerDrivers;

use System\Helpers\Classes\Fs as Filesystem;

use function filesystem\read;
use function filesystem\write;
use function filesystem\makeDirectory;

class FS implements DriverInterface
{
    protected $logDirRoot;

    protected $logFileName;

    protected $logFilePath;

    protected $error = array(
        'code' => 0,
        'file' => null,
        'line' => null,
        'message' => null,
        'requestUri' => null,
        'trace' => array(),
    );

    public function __construct()
    {
        $this->logDirRoot = Filesystem::server()->temp("errors/" . date('Y-m-d'));
        makeDirectory($this->logDirRoot);
    }

    public function setError($code, $message, $file, $line)
    {
        $this->error['code'] = $code;
        $this->error['file'] = $file;
        $this->error['line'] = $line;
        $this->error['message'] = $message;
        $this->error['requestUri'] = $_SERVER['REQUEST_URI'];

        foreach(debug_backtrace() as $line){
            $this->error['trace'] = array(
                'file' => isset($line['file']) ? $line['file'] : '',
                'line' => isset($line['line']) ? $line['line'] : '',
                'class' => isset($line['class']) ? $line['class'] : '',
                'type' => isset($line['type']) ? $line['type'] : '',
                'function' => isset($line['function']) ? $line['function'] : '',
            );
        }
        return $this->initLogFileOptions();
    }

    protected function initLogFileOptions()
    {
        $hash = md5($this->error['code'] . $this->error['file'] . $this->error['line']);
        $this->logFileName = "log-{$hash}.json";
        $this->logFilePath = $this->logDirRoot . "/" . $this->logFileName;
        return $this;
    }

    public function add()
    {
        $data = array();

        if(file_exists($this->logFilePath)){
            $content = read($this->logFilePath);
            $data = json_decode($content, true);
        }

        $errorKey = md5($this->error['code'] . $this->error['file'] . $this->error['line'] . $this->error['message']);

        if(isset($data[$errorKey]['counter'])){
            $this->error['counter'] = $data[$errorKey]['counter'] + 1;
        }else{
            $this->error['counter'] = 1;
        }
        $data[$errorKey] = $this->error;

        return write($this->logFilePath, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    }
}