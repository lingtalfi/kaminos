UploadController
====================
2017-04-29




This controller provides one method: handleUpload, which handles an ajax upload.

This is an ajax controller, which is hooked into the Core module's ajaxRouter via the Core_feedAjaxUri2Controllers hook.

The system used is [Upload-Profiles](https://github.com/lingtalfi/Upload-Profiles).





The profile structure used is the following:



- ?maxFileSize: int, size in M, intended to be checked application side
- ?acceptedFiles: array of accepted mime types or file extensions, intended to be checked application side

- targetDir: the full path to the directory containing the items
- ?checkUser: null|callback, if callback, returns boolean: whether or not the user is granted the permission to upload to that dir.
                            If not, the upload is cancelled.
                            
- ?getFileName: null|callback|string, 
                        If callback, takes the default fileName as input and returns the fileName to use (for instance image-shoes.jpg).
                        If string, the string will be used as the fileName.
                        
                        
- ?accept: null|string|callback, whether or not to accept the given file.
                                    If null or not set, the file will be accepted without condition (default).
                                    If string, can be one of:
                                            - image: will be accepted only if it's an image
                                    If callback, takes the file path as entry, and returns a boolean.
- ?uploadAfter: callback, callback to do something with the uploaded file.
                        For instance, you could generate thumbnail(s), delete the original file, and more...