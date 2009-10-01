<?php 

	class mainActionComponents extends BUGSactioncomponent
	{
		
		public function componentUserdropdown()
		{
			BUGSlogging::log('user dropdown component');
			$this->rnd_no = rand();
			try
			{
				if (!$this->user instanceof BUGSuser)
				{
					BUGSlogging::log('loading user object in dropdown');
					$this->user = BUGSfactory::userLab($this->user);
					BUGSlogging::log('done (loading user object in dropdown)');
				}
				$this->viewuser_string = "window.open('" . BUGScontext::getTBGPath() . "viewuser.php?uid=" . $this->user->getUname() . "','mywindow','menubar=0,toolbar=0,location=0,status=0,scrollbars=0,width=600,height=400');";
				$this->closemenu_string = 'hideBud(\'' . $this->user->getUname() . '_' . $this->rnd_no . '\');';
			}
			catch (Exception $e) 
			{ 
			}
			BUGSlogging::log('done (user dropdown component)');
		}
		
		public function componentTeamdropdown()
		{
			BUGSlogging::log('team dropdown component');
			$this->rnd_no = rand();
			try
			{
				if (!$this->team instanceof BUGSteam)
				{
					BUGSlogging::log('loading team object in dropdown');
					$this->team = BUGSfactory::teamLab($this->team);
					BUGSlogging::log('done (loading team object in dropdown)');
				}
				$this->closemenu_string = 'hideBud(\'' . $this->team->getID() . '_' . $this->rnd_no . '\');';
			}
			catch (Exception $e) 
			{ 
			}
			BUGSlogging::log('done (team dropdown component)');
		}
		
		public function componentIdentifiableselector()
		{
			$this->include_teams = (isset($this->include_teams)) ? $this->include_teams : false;
			$this->allow_clear = (isset($this->allow_clear)) ? $this->allow_clear : true;
		}
		
		public function componentIdentifiableselectorresults()
		{
			$this->include_teams = (isset($include_teams)) ? $include_teams : false;
		}
		
		public function componentMyfriends()
		{
			$this->friends = BUGScontext::getUser()->getFriends();
		}
		
		public function componentProjectoverview()
		{
		}
		
		public function componentIssuedetailslistEditable()
		{
			$i18n = BUGScontext::getI18n();
			$this->statuses = BUGSstatus::getAll();
			$this->issuetypes = BUGSissuetype::getAllApplicableToProject($this->issue->getProject()->getID());
			$fields_list = array();
			$fields_list['category'] = array('title' => $i18n->__('Category'), 'visible' => $this->issue->isCategoryVisible(), 'changed' => $this->issue->isCategoryChanged(), 'merged' => $this->issue->isCategoryMerged(), 'name' => (($this->issue->getCategory() instanceof BUGScategory) ? $this->issue->getCategory()->getName() : ''), 'name_visible' => (bool) ($this->issue->getCategory() instanceof BUGScategory), 'noname_visible' => (bool) (!$this->issue->getCategory() instanceof BUGScategory), 'icon' => false, 'change_tip' => $i18n->__('Click to change category'), 'change_header' => $i18n->__('Change category'), 'choices' => BUGScategory::getAll(), 'clear' => $i18n->__('Clear the category'), 'select' => $i18n->__('%clear_the_category% or click to select a new category', array('%clear_the_category%' => '')));
			$fields_list['resolution'] = array('title' => $i18n->__('Resolution'), 'visible' => $this->issue->isResolutionVisible(), 'changed' => $this->issue->isResolutionChanged(), 'merged' => $this->issue->isResolutionMerged(), 'name' => (($this->issue->getResolution() instanceof BUGSresolution) ? $this->issue->getResolution()->getName() : ''), 'name_visible' => (bool) ($this->issue->getResolution() instanceof BUGSresolution), 'noname_visible' => (bool) (!$this->issue->getResolution() instanceof BUGSresolution), 'icon' => false, 'change_tip' => $i18n->__('Click to change resolution'), 'change_header' => $i18n->__('Change resolution'), 'choices' => BUGSresolution::getAll(), 'clear' => $i18n->__('Clear the resolution'), 'select' => $i18n->__('%clear_the_resolution% or click to select a new resolution', array('%clear_the_resolution%' => '')));
			$fields_list['priority'] = array('title' => $i18n->__('Priority'), 'visible' => $this->issue->isPriorityVisible(), 'changed' => $this->issue->isPriorityChanged(), 'merged' => $this->issue->isPriorityMerged(), 'name' => (($this->issue->getPriority() instanceof BUGSpriority) ? $this->issue->getPriority()->getName() : ''), 'name_visible' => (bool) ($this->issue->getPriority() instanceof BUGSpriority), 'noname_visible' => (bool) (!$this->issue->getPriority() instanceof BUGSpriority), 'icon' => false, 'change_tip' => $i18n->__('Click to change priority'), 'change_header' => $i18n->__('Change priority'), 'choices' => BUGSpriority::getAll(), 'clear' => $i18n->__('Clear the priority'), 'select' => $i18n->__('%clear_the_priority% or click to select a new priority', array('%clear_the_priority%' => '')));
			$fields_list['reproducability'] = array('title' => $i18n->__('Reproducability'), 'visible' => $this->issue->isReproducabilityVisible(), 'changed' => $this->issue->isReproducabilityChanged(), 'merged' => $this->issue->isReproducabilityMerged(), 'name' => (($this->issue->getReproducability() instanceof BUGSreproducability) ? $this->issue->getReproducability()->getName() : ''), 'name_visible' => (bool) ($this->issue->getReproducability() instanceof BUGSreproducability), 'noname_visible' => (bool) (!$this->issue->getReproducability() instanceof BUGSreproducability), 'icon' => false, 'change_tip' => $i18n->__('Click to change reproducability'), 'change_header' => $i18n->__('Change reproducability'), 'choices' => BUGSreproducability::getAll(), 'clear' => $i18n->__('Clear the reproducability'), 'select' => $i18n->__('%clear_the_reproducability% or click to select a new reproducability', array('%clear_the_reproducability%' => '')));
			$fields_list['severity'] = array('title' => $i18n->__('Severity'), 'visible' => $this->issue->isSeverityVisible(), 'changed' => $this->issue->isSeverityChanged(), 'merged' => $this->issue->isSeverityMerged(), 'name' => (($this->issue->getSeverity() instanceof BUGSseverity) ? $this->issue->getSeverity()->getName() : ''), 'name_visible' => (bool) ($this->issue->getSeverity() instanceof BUGSseverity), 'noname_visible' => (bool) (!$this->issue->getSeverity() instanceof BUGSseverity), 'icon' => false, 'change_tip' => $i18n->__('Click to change severity'), 'change_header' => $i18n->__('Change severity'), 'choices' => BUGSseverity::getAll(), 'clear' => $i18n->__('Clear the severity'), 'select' => $i18n->__('%clear_the_severity% or click to select a new severity', array('%clear_the_severity%' => '')));
			$fields_list['milestone'] = array('title' => $i18n->__('Targetted for'), 'visible' => $this->issue->isMilestoneVisible(), 'changed' => $this->issue->isMilestoneChanged(), 'merged' => $this->issue->isMilestoneMerged(), 'name' => (($this->issue->getMilestone() instanceof BUGSmilestone) ? $this->issue->getMilestone()->getName() : ''), 'name_visible' => (bool) ($this->issue->getMilestone() instanceof BUGSmilestone), 'noname_visible' => (bool) (!$this->issue->getMilestone() instanceof BUGSmilestone), 'icon' => true, 'icon_name' => 'icon_milestones.png', 'change_tip' => $i18n->__('Click to change which milestone this issue is targetted for'), 'change_header' => $i18n->__('Set issue target / milestone'), 'choices' => $this->issue->getProject()->getMilestones(), 'clear' => $i18n->__('Set as not targetted'), 'select' => $i18n->__('%set_as_not_targetted% or click to set a new target milestone', array('%set_as_not_targetted%' => '')));
			
			$this->fields_list = $fields_list;
		}
	}

?>