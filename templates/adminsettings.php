<?php
/**
 * ownCloud - RCDevs OpenOTP Two-factor Authentication
 *
 * @package user_rcdevsopenotp
 * @author Julien RICHARD
 * @copyright 2015 RCDEVS info@rcdevs.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * Displays <a href="http://opensource.org/licenses/AGPL-3.0">GNU AFFERO GENERAL PUBLIC LICENSE</a>
 * @license http://opensource.org/licenses/AGPL-3.0 GNU AFFERO GENERAL PUBLIC LICENSE
 *
 */

script('user_rcdevsopenotp', 'script');
style('user_rcdevsopenotp', 'settings');
?>
<div id="openotp_general_settings" class="section">
	<form id="openotp_settings" method="POST" action="">
		<h2><?php p($l->t('OpenOTP Two-Factor Authentication'));?></h2>

		<p style="padding-bottom:10px;">
			<?php p($l->t('Enter your OpenOTP server settings in the fields below.')); ?> 
			<?php p($l->t('You can also enable or disable Two-Factor Authentication by editing the personnal settings on the Users page.')); ?> 
		</p>

		<?php foreach( $_['openotp_allconfig'] as $openotp_config  ):?>
		<p class="p_<?php p($openotp_config['type']); ?>">
			<?php switch( $openotp_config['type'] ){ 
					case "text": ?>
			<label class="for_text" for="<?php p($openotp_config['name']); ?>"><?php p($l->t($openotp_config['label']));?></label>
			<input type="text" id="<?php p($openotp_config['name']); ?>" name="<?php p($openotp_config['name']); ?>" value="<?php p($_[$openotp_config['name']]); ?>"
			       title="<?php p($l->t($openotp_config['title']));?>">
			<?php 	break;
					case "checkbox": 
					?>
			<input type="checkbox" name="<?php p($openotp_config['name']); ?>" id="<?php p($openotp_config['name']); ?>" <?php if ($_[$openotp_config['name']] === "on" || ( !$_[$openotp_config['name']] && $openotp_config['default_value'] ) ){ p(' checked'); } ?> >
			<label class="for_checkbox" for="<?php p($openotp_config['name']); ?>"><?php p($l->t($openotp_config['label']));?></label>
			<?php 	break;
					case "radio": ?>
			<label class="radio_group_label"><?php p($l->t($openotp_config['label']));?></label>
			<div style="display:inline-block;">
			<?php foreach($openotp_config['radios'] as $name => $radio): ?>	
					<input type="radio" value="<?php p($radio['value']); ?>" name="<?php p($openotp_config['name']); ?>" id="<?php p($name); ?>" 
						<?php if (!$_[$openotp_config['name']] && $radio['checked'] ) p(' checked="checked"');
					  		elseif ($_[$openotp_config['name']] === $radio['value']) p(' checked="checked"'); ?>>
					<label class="for_radio" for="<?php p($name); ?>"><?php p($l->t($radio['label']));?></label><br/>
			<?php endforeach; ?>	
			</div>
			<?php 	break; 
			} ?>
		</p>	
		<?php endforeach; ?>
		
		<p style="margin-top:20px;">
        	<input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']);?>" />
        	<input type="hidden" name="openotp_settings_sent" value="1" />
	        <input type='submit' id="saveconfig" value='<?php p($l->t('Save'));?>'>			
		</p>		
	</form>
	<div id="message"></div>
</div>