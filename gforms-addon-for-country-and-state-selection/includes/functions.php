<?php
    class GFCWS_Countrywisestate_Field_Ajax{
        function __construct(){
            add_action( 'wp_ajax_Ajax_GFCWS_Filter_Record', array( $this, 'Ajax_GFCWS_Filter_Record'));
            add_action('wp_ajax_nopriv_Ajax_GFCWS_Filter_Record', array( $this, 'Ajax_GFCWS_Filter_Record'));           
            add_action( 'wp_ajax_Ajax_GFCWS_Filter', array( $this, 'Ajax_GFCWS_Filter'));
            add_action('wp_ajax_nopriv_Ajax_GFCWS_Filter', array( $this, 'Ajax_GFCWS_Filter'));           
        }
        function Ajax_GFCWS_Filter_Record(){
            $country_request = sanitize_text_field($_GET['country']);
            $csvFile = file(plugin_dir_url( __DIR__ ). 'assets/data/states.csv');
            $datas = [];
            foreach ($csvFile as $line) {
                $datas[] = str_getcsv($line);
            }            
            $newcountry = array();
            foreach ($datas as $values) {   
                $state = $values[0];
                $key = $values[3];
                $newcountry[$key][] = $state;
            }        
            $newcountrys = array_shift($newcountry);

            $states_option = "";
            $states_option .= "<option value=''>Select State</option>";
            $bolean = false;
            $arr = array();
            foreach($newcountry as $key_country => $val_country){
                if($key_country === $country_request){
                    foreach($val_country as $key_states => $val_states){
                        $states_option .= "<option value='{$val_states}'>{$val_states}</option>";
                        $bolean = true;
                    }
                    break;
                }
            }
            array_push($arr,$states_option);
            array_push($arr,$bolean);
            echo json_encode($arr);
            wp_die();
        }


        function Ajax_GFCWS_Filter(){
            $country_request = sanitize_text_field($_GET['country']);
            $state_request = sanitize_text_field($_GET['state']);
            $csvFile = file(plugin_dir_url( __DIR__ ). 'assets/data/states.csv');
            $datas = [];
            foreach ($csvFile as $line) {
                $datas[] = str_getcsv($line);
            }            
            $newcountry = array();
            foreach ($datas as $values) {   
                $state = $values[0];
                $key = $values[3];
                $newcountry[$key][] = $state;
            }        
         
            $newcountrys = array_shift($newcountry);
            ksort($newcountry);
            
            $country_option = "";
            $country_option .= "<option value=''>Empty (no choices selected)</option>";
            $bolean = false;
            $arr = array();
            if($country_request == 'country'){
                foreach($newcountry as $countryname => $val_country){
                    $country_option .= "<option value='{$countryname}'>{$countryname}</option>";
                }
            }else{
                ksort($newcountry[$country_request]);
               
                foreach($newcountry[$country_request] as $countryname => $val_country){
                    if($val_country == $state_request){
                        $country_option .= "<option value='{$val_country}' selected>{$val_country}</option>";
                    }
                    $country_option .= "<option value='{$val_country}'>{$val_country}</option>";
                }
            }
            
            array_push($arr,$country_option);
            array_push($arr,$bolean);
            echo json_encode($arr);
            wp_die();
        }
    }
    new GFCWS_Countrywisestate_Field_Ajax;
?>