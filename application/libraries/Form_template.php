<?php

class Form_template{
              
    public function __construct(){
        
    }

    /**
     * Return input text with label
     * @param label String 
     * @param name String
     * @param placeholder String
     * @param value String    
     * 
     * @return String html text
     */

    public function text($label, $name, $placeholder=null, $value=null){
        if($placeholder == null){
            $placeholder = 'Enter your '. $name;
        }
        return "
        <label class='col-form-label' for='" . $name . "'>" . $label . "</label>
        <input class='form-control' id='". $name . "' type='text' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "'>
        
        
        ";

    }

    public function password($label, $name, $placeholder = null, $value = null)
    {
        if ($placeholder == null) {
            $placeholder = 'Enter your ' . $name;
        }
        return "
        <label class='col-form-label' for='" . $name . "'>" . $label . "</label>
        <input class='form-control' id='" . $name . "' type='password' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "'>
        
        
        ";
    }

    public function email($label, $name, $placeholder = null, $value = null)
    {
        if ($placeholder == null) {
            $placeholder = 'Enter your ' . $name;
        }
        return "
        <label class='col-form-label' for='" . $name . "'>" . $label . "</label>
        <input class='form-control' id='" . $name . "' type='email' name='" . $name . "' placeholder='" . $placeholder . "' value='" . $value . "'>
        
        
        ";
    }

    public function select($label, $name, $option, $selected = null)
    {
        $select_option = "<option value='0'>Please select</option>";
        foreach ($option as $key => $value) {

            $is_selected = ($selected != null && $value->id == $selected) ? 'selected' : '';
            $select_option = $select_option."<option " . $is_selected . " value='".$value->id."'>".$value->name."</option>";
        }
       

        return "
        <label class='col-form-label' for='" . $name . "'>" . $label . "</label>
        <select class='form-control' id='select1' name='" . $name . "'>
            " . $select_option . "
        </select>
        ";
    }

    /**
     * Return textarea with label
     * @param label String 
     * @param name String
     * @param placeholder String
     * @param value String    
     * 
     * @return String html text
     */

    public function textarea($label, $name, $placeholder=null, $value = null)
    {
        if ($placeholder == null) {
            $placeholder = 'enter your ' . $name;
        }
        return "
            <label class='col-form-label' for='" . $name . "'>" . $label . "</label>
          
            <textarea name='" . $name . "' id='' cols='30' rows='10' class='form-control'placeholder='" . $placeholder . "'>" . $value . "</textarea>
          
            
            ";
    }

    /**
     * Return submit button
     * @return String html text
     */

    public function submit(){
        return "
             <div class='col-12'>
                <div class='float-right'>                    
                    <button class='btn btn-sm btn-primary' type='submit'> Submit</button>
                     <button class='btn btn-sm btn-danger' type='reset'> Reset</button>
                </div>
            </div>
        ";
    }

    



}
