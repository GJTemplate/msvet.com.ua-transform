<?php
/*

 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">  

    <tr>
	<td valign="top">
    <div style="padding:10px 20px 0;">
          <h3><?php echo JText::_('COM_VIRTUEMART_USER_FORM_BILLTO_LBL'); ?></h3>
    </div>
     </td>
     </tr>


	<tr>
	<td valign="top">       
	<div style="padding:0 20px 20px;"> 
    <p>
	    <?php

	    foreach ($this->userfields['fields'] as $field) {
		if (!empty($field['value'])) {
			?><!-- span class="titles"><?php echo $field['title'] ?></span -->
	    	    <span class="values vm2<?php echo '-' . $field['name'] ?>" ><?php echo $this->escape($field['value']) ?></span>
			<?php if ($field['name'] != 'title' and $field['name'] != 'first_name' and $field['name'] != 'middle_name' and $field['name'] != 'zip') { ?>
			    <br class="clear" />
			    <?php
			}
		    }
		 
	    }
	    ?> 
    </p>       
    </div>


	</td>
</tr>


</table>

