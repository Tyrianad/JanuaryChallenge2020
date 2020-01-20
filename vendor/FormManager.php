<?php
require_once 'Fields.php';

class FormManager {

    private $fields = [];
    private $form_html;
    private $method;
    private $action;
    private $submitText;

    function __construct(String $config_file){
        $form_config = json_decode(file_get_contents($config_file));

        if(isset($form_config->method)&&in_array($form_config->method,array('POST','GET')))
            $this->method = $form_config->method;
        else
            $this->method = 'POST';

        if(isset($form_config->action))
            $this->action = $form_config->action;

        if(isset($form_config->submitText))
            $this->submitText = $form_config->submitText;
        else
            $this->submitText = 'Send';

        $this->generateFields($form_config);
    }

    public function getHtml(){
        if(count($this->fields)>0)
        {
            if(!isset($this->form_html))
            {
                $temp_html = '<form action="'.$this->action.'" method="'.$this->method.'">';

                foreach($this->fields as $field)
                {
                    $temp_html .= $field->getHtml();
                }

                $temp_html .= '<div><input type="submit" name="submit" value="'.$this->submitText.'" /></div>';

                $temp_html .= '</form>';

                $this->form_html = $temp_html;
            }

            return $this->form_html;    
        }
    }

    private function generateFields($form_config){
        foreach($form_config->fields as $field)
        {
              switch ($field->type)
              {
                  case 'text':
                    $this->fields[] = new TextField($field);
                  break;
                  case 'select':
                    $this->fields[] = new SelectField($field);
                  break;
                  case 'textarea':
                    $this->fields[] = new TextAreaField($field);
                  break;
                  case 'radio':
                    $this->fields[] = new RadioField($field);
                  break;
                  case 'password':
                    $this->fields[] = new PasswordField($field);
                  break;
                  case 'checkbox':
                    $this->fields[] = new CheckboxField($field);
                  break;
              }        
        }
    }

    private function debug($toPrint)
    {
        echo '<pre>';
        var_dump($toPrint);
        echo '</pre>';
    }

    public function interceptSubmit(){
        if($this->method=="POST")
        {
            if(isset($_POST['submit']))
            {
                echo 'post';
                echo '<pre>';
                var_dump($_POST);
                echo '</pre>';
            }
        }
        else
        {
            if(isset($_GET['submit']))
            {
                echo '<pre>';
                var_dump($_GET);
                echo '</pre>';
                die();
            }
        }
    }

}

?>