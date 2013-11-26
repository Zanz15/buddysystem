<?php
class Buddymatching
{
	private $buddies;
	private $incomings;

	function __construct($buddies, $incomings)
	{
		$this->buddies = $buddies;
		$this->incomings = $incomings;
	}

	public function match($buddiesPerGroup, $incomingsPerGroup)
	{
		if( (count($this->buddies) < $buddiesPerGroup) || (count($this->incomings) < $incomingsPerGroup) )
			return;

		$maxBuddyGroups = floor(count($this->buddies) / $buddiesPerGroup);
		$maxIncomingGroups = floor(count($this->incomings) / $incomingsPerGroup);
		$maxGroups = $maxBuddyGroups < $maxIncomingGroups ? $maxBuddyGroups : $maxIncomingGroups;

		$matchesIncomings = $this->matchIncomings($incomingsPerGroup, $maxGroups);
		$matchesBuddies = $this->matchBuddies($buddiesPerGroup, $matchesIncomings['groups']);

		return array(
			'incomings' => $matchesIncomings,
			'buddies' => $matchesBuddies
		);
	}

	public function idsToObjects($matchesIncomings, $matchesBuddies)
	{
		$matches = array();

		if(is_null($matchesIncomings) || is_null($matchesBuddies))
			return;

		foreach( $matchesIncomings['groups'] as $groupId => $group )
			foreach( $group as $incomingId )
		{
			$incoming = $this->incomings[$incomingId];
			$incoming['idGroup'] = $matchesIncomings['matches'][$incomingId]['group'];
			$incoming['match'] = $matchesIncomings['matches'][$incomingId]['match'];
			$matches['groups'][$groupId][] = $incoming;
		}

		foreach( $matchesBuddies['groups'] as $groupId => $group )
			foreach( $group as $buddyId )
		{
			$buddy = $this->buddies[$buddyId];
			$buddy['idGroup'] = $matchesBuddies['matches'][$buddyId]['group'];
			$buddy['match'] = $matchesBuddies['matches'][$buddyId]['match'];
			$matches['groups'][$groupId][] = $buddy;
		}

		return $matches;

	}

	private function matchIncomings($incomingsPerGroup, $numGroups)
	{
		$matchConds = array (
			//array('lang & study', 'preferredLanguage', 'idStudy'),
			//array('study', 'idStudy'),
			//array('lang', 'preferredLanguage'),
			array('filler')
		);
		$groups = array(); // reference id's of $incomings
		$matched = array(); // "group"-reference for $groups "match" for matching string
		$statistics = array('1st' => 0);
		foreach( $matchConds as $matchCond )
			$statistics[$matchCond[0]] = 0;

		$groupCount = 0;

		// first pick seed
		foreach( $this->incomings as $seedId => $seedIncoming ) {
			if (array_key_exists($seedId, $matched)) continue;

			$groups[$groupCount][] = $seedId;
			$matched[$seedId] = array(
				"group" => $groupCount,
				"match" => "1st"
			);
			$groupMemberCount = 1;
			$statistics['1st'] ++;

			// find other group members according to match conditions
			foreach( $matchConds as $matchCond ) {
				if ($groupMemberCount >= $incomingsPerGroup) break;

				// go through all incomings to find matches
				foreach( $this->incomings as $incomeId => $income )
				{
					if ($groupMemberCount >= $incomingsPerGroup) break;
					if (array_key_exists($incomeId, $matched)) continue;
					
					// check all matching conditions
					$addToGroup = true;
					for( $i=1; $i < count($matchCond); $i++) {
						if($seedIncoming[$matchCond[$i]] != $income[$matchCond[$i]]) {
							$addToGroup = false;
							break;
						}
					}
					if($addToGroup) {
						$groupMemberCount++;
						$groups[$groupCount][] = $incomeId;
						$matched[$incomeId] = array(
							"group" => $groupCount,
							"match" => $matchCond[0]
						);
						$statistics[$matchCond[0]] ++;
					}
				}
			}
			if (++$groupCount >= $numGroups) break;
		}

		return array(
			"groups" => $groups,
			"matches" => $matched,
			"statistics" => $statistics
		);
	}

	private function matchBuddies($buddiesPerGroup, $incomingGroups)
	{
		$matchConds = array (
			array('p&s', 'idStudy', array('country', 'idPreferredCountryFirst')),
			array('s&s', 'idStudy', array('country', 'idPreferredCountrySecond')),
			array('t&s', 'idStudy', array('country', 'idPreferredCountryThird')),
			array('prim', array('country', 'idPreferredCountryFirst')),
			array('sec', array('country', 'idPreferredCountrySecond')),
			array('third', array('country', 'idPreferredCountryThird')),
			array('study', 'idStudy'),
			array('filler')
		);
		$groups = array(); // reference id's of $buddies
		$matched = array(); // "group"-reference for $groups "match" for matching string
		$statistics = array();
		foreach( $matchConds as $matchCond )
			$statistics[$matchCond[0]] = 0;

		// fill up all the groups
		foreach($incomingGroups as $groupId => $group)
		{
			$groupMemberCount = 0;

			// find group members according to match conditions
			foreach( $matchConds as $matchCond ) {
				if ($groupMemberCount >= $buddiesPerGroup) break;

				// go through all buddies to find matches
				foreach( $this->buddies as $buddyId => $buddy )
				{
					if ($groupMemberCount >= $buddiesPerGroup) break;
					if (array_key_exists($buddyId, $matched)) continue;
					
					// go through all incomings in the group
					foreach( $group as $groupMemberId)
					{
						if (array_key_exists($buddyId, $matched)) break;

						// check all matching conditions
						$addToGroup = true;
						for( $i=1; $i < count($matchCond); $i++) {
							$condition1 = is_array($matchCond[$i]) ? $matchCond[$i][0] : $matchCond[$i];
							$condition2 = is_array($matchCond[$i]) ? $matchCond[$i][1] : $matchCond[$i];

							if($this->incomings[$groupMemberId][$condition1] != $buddy[$condition2]) {
								$addToGroup = false;
								break;
							}
						}
						if($addToGroup) {
							$groupMemberCount++;
							$groups[$groupId][] = $buddyId;
							$matched[$buddyId] = array(
								"group" => $groupId,
								"match" => $matchCond[0]
							);
							$statistics[$matchCond[0]] ++;
						}
					}
				}
			}
		}

		return array(
			"groups" => $groups,
			"matches" => $matched,
			"statistics" => $statistics
		);
	}
}
?>
