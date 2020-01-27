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

    /**
     * Returns the full form
     * @return string
     */
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

                $temp_html .= '<div class="form-group"><input class="btn btn-primary" type="submit" name="submit" value="'.$this->submitText.'" /></div>';

                $temp_html .= '</form>';

                $this->form_html = $temp_html;
            }

            return $this->form_html;
        }
    }

    /**
     * Used to create the right object
     * @param $form_config
     */
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


    /**
     * Used for debug.
     * @param $toPrint mixed The variable to var_dump
     */
    private function debug($toPrint)
    {
        echo '<pre>';
        var_dump($toPrint);
        echo '</pre>';
    }

    public function interceptSubmit() : int{
        $xml = new DomDocument('1.0', 'UTF-8');
        $submission = $xml->appendChild($xml->createElement('submission'));
        $date = $xml->createAttribute('date');
        $date->value = date('Y-m-d H:i:s');
        $submission->appendChild($date);

        foreach($_REQUEST as $key => $field)
        {
            if($field!="")
            {
                if(is_array($field))
                {
                    $field_xml = $xml->createElement($key);
                    foreach($field as $option)
                    {
                        $option_xml = $xml->createElement('option',$option);
                        $field_xml->appendChild($option_xml);
                    }
                }
                else
                {
                    $field_xml = $xml->createElement($key,$field);
                }
                $submission->appendChild($field_xml);
            }
        }

        $xml->formatOutput = true;

        return file_put_contents('submissions/sub-'.time().'.xml',$xml->saveXML()) === false;

    }

}

?>