NullosFormRenderer
======================
2017-04-28




Form model
===============

switch
-----------
- control:
----- type: switch
----- label: 
----- htmlAttributes
--------- value: 1|0
--------- type: checkbox
--------- ...


htmlTextArea
-----------
- control:
----- type: htmlTextarea
----- value: string




colorPicker
-----------
same as text input except for the type

- control:
----- type: colorPicker
----- htmlAttributes
--------- type: text
--------- value: string 


datetimePicker
-----------
http://www.daterangepicker.com/


- control:
----- type: datetimePicker
----- htmlAttributes
--------- type: text
--------- value: string 
----- js: 
--------- timePicker: true
--------- timePickerIncrement: 30
--------- locale: 
------------- format: 'MM/DD/YYYY h:mm A'
--------- ...
        
        
dropzone
-----------
http://www.dropzonejs.com/


- control:
----- type: dropzone
----- value: array of urls, each of which representing an image's uri
----- label: 
----- conf:  
--------- profileId: we use the [UploadProfiles system](https://github.com/lingtalfi/Upload-Profiles) 
--------- showDeleteLink: bool=true 
----- htmlAttributes:  
        
        
        
sqlQuerySelect
-----------

same as select (the model is different from an input's perspective, 
but the output for the renderer is the same).

                
autocomplete
-----------
same as text input except for the type

- control:
----- type: autocomplete
----- htmlAttributes
--------- type: text
--------- value: string 
----- js
--------- uri
