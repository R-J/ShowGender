<?php if (!defined('APPLICATION')) exit();
/**
  *  ShowGender adds a css class to discussion and comment view
  *  so that you can set individual styles for masculine and feminine users
  */

$PluginInfo['ShowGender'] = array(
   'Name' => 'Show Gender',
   'Description' => 'Adds gender symbols to username in discussion',
   'Version' => '0.1',
   'RequiredApplications' => array('Vanilla' => '>=2.0.18'),
   'MobileFriendly' => TRUE,
   'Author' => 'Robin'
);

class ShowGenderPlugin extends Gdn_Plugin {
   public function DiscussionController_Render_Before($Sender) {
      $Sender->AddCssFile($this->GetResource('design/showgender.css', FALSE, FALSE));
   }

   function DiscussionController_BeforeCommentMeta_Handler($Sender) {
      $UserID = $Sender->EventArguments['Author']->UserID;
      $Gender = Gdn::SQL()
         ->Select('Gender')
         ->From('User')
         ->Where('UserID', $UserID)
         ->Get()
         ->FirstRow(DATASET_TYPE_ARRAY)['Gender'];
      echo "<span class=\"Gender_{$Gender}\" />";
   }
}
  