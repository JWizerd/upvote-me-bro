<?php 

if( ! class_exists('UMB_Logger') ) :

    class UMB_Logger
    {   
        const FILE = 'log.json';
        /**
         * if there are errors let's append an error message for debugging purposes
         * typically the error messages that we are going to be displaying are 
         * Exceptions.
         * 
         * @param  
         * @since 1.0
         */
        public static function report($msg) 
        {
            try {

                $log_json = file_get_contents($this::FILE);

                // if true for json_decode use assoc array not object
                $log_data = json_decode($log_json, true);

                array_push($arr_data, ['error' => $msg]);

                $encoded = json_encode($log_data, JSON_PRETTY_PRINT);

                file_put_contents($this::FILE, $jsondata);

            } catch (\Throwable $e) {

                echo "error logging to file: {$e->getMessage()}";

            } // end catch
        } // end fn

    } // end class

endif;
