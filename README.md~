Add-on for Atk4 for log processes
Installation:

1. Add line to config.php:
    $config['use_mailer_logger']=true;

2. Add line to your object to use:
    $this->logger = $this->add('vyze\logger\Controller_Logger');
3. Use it's functions.
Example:
 someClass/someFunction(){...
//init
$this->logger = $this->add('vyze\logger\Controller_Logger');
$logFile = $this->logger->getLog($path_to_file); // if $path_to_file isn't set, it takes $config['log_path'] as default
$this->logger->addToLog($logFile, 'string for log');
$this->logger->closeLog($logFile, 'optional adding string before close log file');

Author:
    Vladislav Polyukhovich aka Vyze