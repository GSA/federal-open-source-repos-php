<?php
/**
 * Class to retrieve federal open source code hosted on GitHub
 * 
 * Usage: 
 * 
 * Instantiate the class
 *   $gh = new Federal_Open_Source_Repos();
 *
 * Get a specific agencies repos
 *   $gh->fcc
 * 
 * Get all federal repos
 *   $gh->get_repos();
 *
 * Returns an array of repository objects, as returned from the GitHub API
 * See http://develop.github.com/p/repo.html for additional information
 *
 * Licensing Information:
 *
 * This code constitutes a work of the United States Government and is 
 * not subject to domestic copyright protection under 17 USC � 105. 
 *
 * The class uses code licensed under the terms of the GNU General 
 * Public License and therefore is licensed under GPL v2 or later.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @license GPL v2 or later
 * @version 1.0
 */
class Federal_Open_Source_Repos {

	//URL to query Social Media Registry for list of all Federal GitHub Accounts
	public $account_query = 'http://registry.usa.gov/accounts.json?service_id=github&agency_id=&tag=';
	
	//URL to query GitHub API to retreive repos
	public $repo_query = 'https://api.github.com/users/%s/repos';
	
	/**
	 * Query social media API for a list of GitHub usernames
	 * @return array an array of all federal github organizations' usernames 
	 */
	function get_accounts() {
		
		$data = file_get_contents( $this->account_query );
		
		//bad http get, abort
		if ( !$data )
			return false;
		
		$data = json_decode( $data );
		
		//bad JSON, abort
		if ( !$data )
			return false;
		
		return $this->list_pluck( $data->accounts, 'account' );
		
	}
	
	/**
	 * Magic Method to return an agency's repos
	 * @param string $account the agency's account name
	 * @return array an array of repo objects
	 * 
	 * Usage:
	 * $gh = new Federal_Github_Accounts();
	 * $gh->fcc;
	 *
	 */	
	function __get( $account ) {

		$data = file_get_contents( sprintf( $this->repo_query, $account ) );

		//bad JSON, abort	
		if ( !$data )
			return false;
		
		return json_decode( $data );
		
	}
	
	/**
	 * Loop through all github accounts in the social media registry 
	 * and retrieve their repositories on GitHub
	 * 
	 * @return array an single (merged) array of repository objects as returned from the GitHub API
	 */
	function get_repos() {
		
		$repos = array();
		foreach ( $this->get_accounts() as $account )
			$repos = $repos + $this->$account;
		
		return $repos;
		
	}
	
	/**
	 * Pluck a certain field out of each object in a list.
	 *
	 * Code from WordPress core, functions.php
	 * Used under GPLv2 or later
	 *
	 * @param array $list A list of objects or arrays
	 * @param int|string $field A field from the object to place instead of the entire object
	 * @return array
	 */
	function list_pluck( $list, $field ) {
		foreach ( $list as $key => $value ) {
			if ( is_object( $value ) )
				$list[ $key ] = $value->$field;
			else
				$list[ $key ] = $value[ $field ];
		}
	
		return $list;
	}
	
}