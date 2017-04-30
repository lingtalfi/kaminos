UploadProfile_profileFinder
==============================
2017-04-29



Returns a ProfileFinderInterface instance.


The returned finder assumes that files are organized in a certain way.


The profileId has the following format:

- profileId: Module.identifier


Then the correspondence in the tree system is the following:

There is the **/profileDir/$Module.php** file.

This file contains a $profiles array which contains all the profile identifiers
for this module, so in this case the array contains at least a key with the name "identifier".
