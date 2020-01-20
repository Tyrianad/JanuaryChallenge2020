<?php

abstract class Field{
    public $field_data;

    function __construct($field_data)
    {
        $this->field_data = $field_data;
    }

    abstract public function getHtml();
}

class TextField extends Field{
    public function getHtml(){
        $temp_html = '<div>';

        $temp_html .= '<input type="text" 
        placeholder="'.$this->field_data->label.'" 
        class="'.$this->field_data->classes.'"
        id="'.$this->field_data->id.'"
        name="'.$this->field_data->name.'"
        '.(isset($this->field_data->required)&&$this->field_data->required?'required="required"':"").'
        />';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class PasswordField extends Field{
    public function getHtml(){
        $temp_html = '<div>';

        $temp_html .= '<input type="password" 
        placeholder="'.$this->field_data->label.'" 
        class="'.$this->field_data->classes.'"
        id="'.$this->field_data->id.'"
        name="'.$this->field_data->name.'"
        '.(isset($this->field_data->required)&&$this->field_data->required?'required="required"':"").'
        />';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class SelectField extends Field{
    public function getHtml(){
        $temp_html = '<div>';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        $temp_html .= '<select class="'.$this->field_data->classes.'"
                        id="'.$this->field_data->id.'"
                        name="'.$this->field_data->name.'"
                        '.(isset($this->field_data->required)&&$this->field_data->required?'required="required"':"").'>';

        foreach($this->field_data->options as $key => $option)
        {
            $temp_html .= '<option value="'.(isset($option->value)&&$option->value!=""?$option->value:$key).'"
                            '.(isset($option->selected)&&$option->selected?'selected':'').'>'.
                            $option->text.
                            '</option>';
        }
        
        $temp_html .= '</select>';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class TextAreaField extends Field{
    public function getHtml(){
        $temp_html = '<div>';

        $temp_html .= '<textarea 
        class="'.$this->field_data->classes.'"
        id="'.$this->field_data->id.'"
        name="'.$this->field_data->name.'"
        '.(isset($this->field_data->required)&&$this->field_data->required?'required="required"':"").'
        '.(isset($this->field_data->rows)&&$this->field_data->rows>0?'rows="'.$this->field_data->rows.'"':"").'
        '.(isset($this->field_data->cols)&&$this->field_data->cols>0?'cols="'.$this->field_data->cols.'"':"").'
        >'.$this->field_data->label.'</textarea>';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class RadioField extends Field{
    public function getHtml(){
        $temp_html = '<div>';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        $temp_html .= '<div class="'.$this->field_data->classes.'"
                        id="'.$this->field_data->id.'">';

        foreach($this->field_data->options as $key => $option)
        {
            $temp_html .= '<label><input type="radio" value="'.(isset($option->value)&&$option->value!=""?$option->value:$key).'"
                            '.(isset($option->checked)&&$option->checked?'checked':'').'
                            name="'.$this->field_data->name.'[]">'.
                            $option->text.
                            '</label>';
        }
        
        $temp_html .= '</select>';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class CheckboxField extends Field{
    public function getHtml(){
        $temp_html = '<div>';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        $temp_html .= '<div class="'.$this->field_data->classes.'"
                        id="'.$this->field_data->id.'">';

        foreach($this->field_data->options as $key => $option)
        {
            $temp_html .= '<label><input type="checkbox" value="'.(isset($option->value)&&$option->value!=""?$option->value:$key).'"
                            '.(isset($option->checked)&&$option->checked?'checked':'').'
                            name="'.$this->field_data->name.'[]">'.
                            $option->text.
                            '</label>';
        }
        
        $temp_html .= '</select>';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

?>