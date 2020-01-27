<?php

abstract class Field{
    public $field_data;

    function __construct($field_data)
    {
        $this->field_data = $field_data;
    }

    /**
     * Returns the field in html form
     * @return String
     */
    abstract public function getHtml() : String;
}

class TextField extends Field{
    public function getHtml():String{
        $temp_html = '<div class="form-group">';

        $temp_html .= '<input class="form-control" type="text" 
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
    public function getHtml():String{
        $temp_html = '<div class="form-group">';

        $temp_html .= '<input class="form-control" type="password" 
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
    public function getHtml():String{
        $temp_html = '<div class="form-group">';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        $temp_html .= '<select class="form-control" class="'.$this->field_data->classes.'"
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
    public function getHtml():String{
        $temp_html = '<div class="form-group">';

        $temp_html .= '<textarea 
        class="'.$this->field_data->classes.' form-control"
        id="'.$this->field_data->id.'"
        name="'.$this->field_data->name.'"
        '.(isset($this->field_data->required)&&$this->field_data->required?'required="required"':"").'
        '.(isset($this->field_data->rows)&&$this->field_data->rows>0?'rows="'.$this->field_data->rows.'"':"").'
        '.(isset($this->field_data->cols)&&$this->field_data->cols>0?'cols="'.$this->field_data->cols.'"':"").'
        placeholder="'.$this->field_data->label.'"
        ></textarea>';

        $temp_html .= '</div>';

        return $temp_html;
    }
}

class RadioField extends Field{
    public function getHtml():String{
        $temp_html = '<div class="form-group">';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        foreach($this->field_data->options as $key => $option)
        {
            $temp_html .= '<div class="form-check '.$this->field_data->classes.'">';

            $temp_html .='<input type="radio" value="'.(isset($option->value)&&$option->value!=""?$option->value:$key).'"
                            '.(isset($option->checked)&&$option->checked?'checked':'').'
                            name="'.$this->field_data->name.'"
                            id="'.$this->field_data->name.$key.'"
                            class="form-check-input">';
            $temp_html .= '<label for="'.$this->field_data->name.$key.'" class="form-check-label">'.$option->text.'</label>';

            $temp_html .= '</div>';
        }


        $temp_html .= '</div>';

        return $temp_html;
    }
}

class CheckboxField extends Field{
    public function getHtml():String{
        $temp_html = '<div class="form-group">';
        $temp_html .= '<label>'.$this->field_data->label.'</label><br />';

        foreach($this->field_data->options as $key => $option)
        {
            $temp_html .= '<div class="form-check '.$this->field_data->classes.'">';

            $temp_html .='<input type="checkbox" value="'.(isset($option->value)&&$option->value!=""?$option->value:$key).'"
                            '.(isset($option->checked)&&$option->checked?'checked':'').'
                            name="'.$this->field_data->name.'[]"
                            id="'.$this->field_data->name.$key.'"
                            class="form-check-input">';
            $temp_html .= '<label for="'.$this->field_data->name.$key.'" class="form-check-label">'.$option->text.'</label>';

            $temp_html .= '</div>';
        }


        $temp_html .= '</div>';

        return $temp_html;
    }
}

?>