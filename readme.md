Federal Open Source Repositories PHP Class
==========================================

*Class to retrieve federal open source code hosted on GitHub*

Usage
-----

Instantiate the class

`$gh = new Federal_Open_Source_Repos();`

Get a specific agencies repos

`$gh->fcc`

Get all federal repos

`$gh->get_respos();`

Returns an array of repository objects, as returned from the GitHub API

See http://develop.github.com/p/repo.html for additional information