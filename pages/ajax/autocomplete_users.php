<?php
/**
 *	Autocomplete Facebook Style Plugin
 *	@package autocomplete facebook style
 *	@author Liran Tal <liran.tal@gmail.com>
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Liran Tal of Enginx 2009
 *	@link http://www.enginx.com
 **/


	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

	global $CONFIG;

	$pid = get_input('projectid', false);
	if($pid && $project = gantt_get_project($pid)) {
		$members = array();
		$membersId = $project->project_contributors;
		foreach($membersId as $memberId){
			if(($member = get_entity($memberId)) && $member->validated) {
				$members[]=$member;
			}
		}
	} else {
		if ($members_ = elgg_get_entities(array('types'=>'user', 'limit'=>0))) {
			$members = array();
			foreach($members_ as $member){
				if($member->validated) {
					$members[]=$member;
				}
			}
		}
	}
	echo elgg_view('autocomplete/autocomplete_users', array('entities' => $members));
?>
