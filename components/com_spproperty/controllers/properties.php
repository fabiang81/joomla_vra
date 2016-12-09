<?php
/**
 * @package     SP Property
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No Direct Access
defined ('_JEXEC') or die('Resticted Aceess');

class SppropertyControllerProperties extends FOFController{

	public function __construct($config = array()){
		parent::__construct($config);
	}

	public function onBeforeBrowse(){
		$params = JComponentHelper::getParams('com_spproperty');
		$limit 	= $params->get('properties_limit', 4);

		$this->getThisModel()->limit( $limit );
		$this->getThisModel()->limitstart($this->input->getInt('limitstart', 0));
	
		return true;
	}

	public function getModel($name = 'Properties', $prefix = 'SppropertyModel', $config = array()) {
		return parent::getModel($name = 'Properties', $prefix = 'SppropertyModel', $config = array());
	}

	public function booking(){
		
		$model 		= $this->getModel();
		$user 		= JFactory::getUser();
		$user_id 	= $user->id;

		$input 		= JFactory::getApplication()->input;
		$mail  		= JFactory::getMailer();

		$name 		= $input->post->get('name', NULL, 'STRING');
		$phone 		= $input->post->get('phone', NULL, 'STRING');
		$recipient 	= $input->post->get('email', NULL, 'STRING');
		$message 	= $input->post->get('message', NULL, 'STRING');
		$sender 	= base64_decode($input->post->get('sender', NULL, 'STRING'));
		$pid 		= $input->post->get('pid', NULL, 'INT');
		$pname 		= $input->post->get('pname', NULL, 'STRING');
		$visitor_ip	= $input->post->get('visitor_ip', NULL, 'STRING');

		$subject 	= JText::_('COM_SPPROPERTY_EMAIL_SUBJECT_TEXT') . $pname;

		$output = array();

		$output['status'] = false;
		
		if ($model->insertBooking($pid, $name, $phone, $recipient, $message, $user_id, $visitor_ip)) {
			$output['status'] = true;

			$msg  = '';
			$msg .= '<p><span>Request for: ' . $pname .'</span></p> <br />';
			$msg .= '<p><span>Name : ' . $name .'</span></p> <br />';
			$msg .= '<p><span>Phone : ' . $phone .'</span></p> <br />';
			$msg .= '<p><span>Email : ' . $recipient .'</span></p> <br />';
			$msg .= '<p><span>message : ' . nl2br( $message ) .'</span></p> <br />';

			// Sent email
			$senderinfo = array($sender, $name);	
			$mail->setSender($senderinfo);
			$mail->addRecipient($recipient);
			$mail->addCC($sender);
			$mail->setSubject($subject);
			$mail->isHTML(true);
			$mail->Encoding = 'base64';	
			$mail->setBody( $msg );

			if ($mail->Send()) {
				$output['content'] = JText::_('COM_SPPROPERTY_PREQUEST_SUCCESS');
			} else {
				$output['content'] = JText::_('COM_SPPROPERTY_PREQUEST_SENT_ERORR');
			}

		} else {
			$output['status']  = false;
			$output['content'] = JText::_('COM_SPPROPERTY_PREQUEST_ERROR');
		}

		echo json_encode($output);
		die();
	}


}