<?php 

if( ! class_exists('UMB_Logger') ) :

    class UMB_Logger
    {   
        private $file;

        public function __construct() 
        {
            $this->file = realpath(__DIR__ . '/..') . '/log.json';
        }
        /**
         * if there are errors let's append an error message for debugging purposes
         * typically the error messages that we are going to be displaying are 
         * Exceptions.
         * 
         * @param  
         * @since 1.0
         */
        public function report($msg) 
        {
            try {

                $log = $this->get_file_data();

                array_push($log, ['error' => $msg]);

                $this->store_error($log);

            } catch (\Exception $e) {

                echo "error logging to file: {$e->getMessage()}";

            } // end catch
        } // end fn

        private function get_file_data() 
        {
            $log_json = file_get_contents($this->file);

            // if true for json_decode use assoc array not object
            return json_decode($log_json, true);

        } // end fn

        private function store_error($error_data) 
        {   
            $encoded = json_encode($error_data, JSON_PRETTY_PRINT);

            file_put_contents($this->file, $encoded);
        } // end fn

        public function display() {
            return $this->get_file_data();
        } // end fn

    } // end class

    // use later to return log of errors when 
    header('Content-Type: application/json');
    (new UMB_Logger)->display();

endif;
