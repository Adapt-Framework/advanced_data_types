<?php

namespace adapt\advanced_data_types{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_advanced_data_types extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('advanced_data_types', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                /* Add validators */
                $this->sanitize->add_validator(
                    'xml',
                    function($value){
                        if ((is_object($value) && $value instanceof \adapt\xml) || (is_string($value) && \adapt\xml::is_xml($value))){
                            return true;
                        }
                        return false;
                    },
                    "
                    function(value){
                        return /<[a-z][\s\S]*>/i.test(value);
                    }
                    "
                );
                
                $this->sanitize->add_validator(
                    'html',
                    function($value){
                        if ((is_object($value) && $value instanceof \adapt\html) || (is_string($value) && \adapt\html::is_html($value))){
                            return true;
                        }
                        return false;
                    },
                    "
                    function(value){
                        return /<[a-z][\s\S]*>/i.test(value);
                    }
                    "
                );
                
                $this->sanitize->add_validator(
                    'ip4',
                    '^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$'
                );
                
                $this->sanitize->add_validator(
                    'ip6',
                    '^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$'
                );
                
                $this->sanitize->add_validator(
                    'email_address',
                    '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'
                );
                
                $this->sanitize->add_validator(
                    'name',
                    '^[A-Za-z]+([ \'-][A-Za-z]+)*$'
                );
                
                $this->sanitize->add_validator(
                    'json',
                    function($value){
                        return is_json($value);
                    },
                    "
                    function(value){
                        try {
                            JSON.parse(str);
                        } catch (e) {
                            return false;
                        }
                        return true;
                    }
                    "
                );
                
                /* Add formatters */
                $this->sanitize->add_format(
                    'name',
                    function($value){
                        $value = strtolower($value);
                        $breaks = array(" ", "'", "-");
                        foreach($breaks as $break){
                            $parts = explode($break, $value);
                            for($i = 0; $i < count($parts); $i++){
                                if (strlen($parts[$i]) == 1){
                                    $parts[$i] = strtoupper($part[$i]);
                                }elseif(strlen($parts[$i]) > 1){
                                    $parts[$i] = strtoupper(substr($parts[$i], 0, 1)) . substr($parts[$i], 1);
                                }
                            }
                            $value = implode($break, $parts);
                        }
                        return $value;
                    },
                    "function(value){
                        if (typeof value === \"string\"){
                            var breaks = [\" \", \"'\", \"-\"];
                            value = value.toLowerCase();
                            for(var i = 0; i < breaks.length; i++){
                                var parts = value.split(breaks[i]);
                                for(var j = 0; j < parts.length; j++){
                                    if (parts[j].length == 1){
                                        parts[j] = parts[j].toUpperCase();
                                    }else{
                                        if (parts[j].length > 1){
                                            parts[j] = parts[j].substr(0, 1).toUpperCase() + parts[j].substr(1);
                                        }
                                    }
                                }
                                
                                value = parts.join(breaks[i]);
                            }
                            
                        }
                        
                        return value;
                    }"
                );

                
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>