<?php

    abstract class Log
    {   
        protected $link;
        
        abstract function push($message);
        
        public function __construct()
        {
                
        }
        
        public function __desctruct()
        {
            
        }
    }


    class Database_log extends Log
    {
        protected $settings = array();
        protected $table;
        
        public function __construct($host = 'localhost', $user, $pass, $db, $table)
        {
            $this->settings = ["host" => $host, "user" => $user, "pass" => $pass, "db" => $db];
            $this->table = $table;
            
            if( $this->connect_to_db() && !$this->table_exist())
            {
                $this->table_create();
            }
        }
        
        public function __destruct()
        {
            if($this->link)
            {
                mysqli_close($this->link);
            }
        }
        
        private function connect_to_db()
        {
            $this->link = mysqli_connect($this->settings['host'], $this->settings['user'], $this->settings['pass'], $this->settings['db']);
            
            if(!$this->link) 
            { 
                printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
                exit;
                return 0;
            }
            else
            {
                return 1;
            }
        }
        
        
        private function table_exist()
        {
            $result = mysqli_query($this->link, "SELECT * FROM {$this->table}");
            return $result; // true if exist
        }            
                    
        private function table_create()
        {
            $result = mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS  `{$this->table}` (
             `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
             `date` DATETIME NOT NULL ,
             `message` VARCHAR( 256 ) NOT NULL ,
            PRIMARY KEY (  `id` )
            )"); 
            if(!$result)
            {
                echo "Ошибка создания таблицы {$this->table}";
            }
        }
        
        //Print settings
        public function __toString()
        {
            return "Host: {$this->settings['host']}\nUsername: {$this->settings['user']}\nPassword: {$this->settings['pass']}\nDatabase: {$this->settings['db']}\nTable: {$this->table}\n";
        }
        
        public function __get($key)
        {
            return $this->key;
        }
        
        public function push($message)
        {
            $request = "INSERT INTO {$this->table} (date, message) VALUES ('".date("Y-m-d H:i:s")."', '{$message}')";
            $result = mysqli_query($this->link, $request);
        }
    }
    
    
    class Stream_log extends Log
    {
        public function __construct($stream)
        {   
            if( !$this->link = fopen($stream, 'a') )
            {
                printf("Невозможно открыть ресурс: %s\n", $stream); 
                exit;
                return 0;
            }
        }
        
        public function __destruct()
        {
            if($this->link)
            {
                fclose($this->link);
            }
        }
        
        public function push($message)
        {
            $note = date("Y-m-d H:i:s")."\t".$message."\n";
            $fwrite = fwrite($this->link, $note);
        }
    }


    class Stdout_log extends Stream_log
    {
        public function __construct()
        {
            $stream = 'php://stdout';
            parent::__construct($stream);
        }
    }


    class File_log extends Stream_log
    {
        public function __construct($stream)
        {
            //$temp = $stream;
            if($_SERVER['DOCUMENT_ROOT'] != NULL)
            {
                $stream = "".$_SERVER['DOCUMENT_ROOT']."/".$stream;
            }
            parent::__construct($stream);
        }
    }

    
    //printf($dblog); // Выводит настройки базы данных
    
    $log[] = new File_log("logfile.txt");
    $log[] = new Database_log('localhost', 'root', '9200209', 'database', 'loglist');
    $log[] = new Stdout_log();

    foreach($log as $value)
    {
        $value->push("Page was updated");
    }

    

?>
