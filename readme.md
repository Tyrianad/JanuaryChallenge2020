###Level 1 - Create JSON form config

f-config.json


###Level 2 Convert this into a HTML form

FormManager->getHtml();

###Level 3 Handle form submission via PHP
###Level 4 Create an XML file per form submission

Function used: FormManager->interceptSubmit()

###Improvements:

* Add validation for json configuration
* Add form validation
* Add custom validation messages
* Pre populate form in case of errors
* Additional checks for form submit
