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

`$gh->get_repos();`

Returns an array of repository objects, as returned from the GitHub API

See http://develop.github.com/p/repo.html for additional information

Contributing to the Project
---------------------------

1. Fork the project using the "fork" button in the top-right corner
1. Create a new branch
1. Make changes
1. Commit, push
1. Visit your repository's page to submit a pull request

*Note: By contributing to this project, you do so under the terms of the GNU General Public License v2 or later.*