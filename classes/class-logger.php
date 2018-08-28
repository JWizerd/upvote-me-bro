<?php 

if( ! class_exists('UMB_Logger') ) :

    class UMB_Logger
    {   
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
                $log_file = file_get_contents('log.json');
                $arr_data = json_decode($jsondata, true);
                array_push($arr_data,$formdata);
            } catch (\Throwable $e) {

            } // end catch
        } // end fn

    } // end class

endif
