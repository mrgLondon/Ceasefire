<div id="custom_forms">

<?php
	// If the user has insufficient permissions to edit report fields, we flag this for a warning message
	$show_permission_message = FALSE;

	foreach ($disp_custom_fields as $field_id => $field_property)
	{
		// Is the field required
		$isrequired = ($field_property['field_required'])
			? "<span class='required'> *</span>"
			: "";

		// Private field
		$isprivate = ($field_property['field_ispublic_visible'])
			? '<span class="private">(' . Kohana::lang('ui_main.private') . ')</span>'
			: '';

		// Workaround for situations where admin can view, but doesn't have sufficient perms to edit.
		if (isset($custom_field_mismatch))
		{
			if(isset($custom_field_mismatch[$field_id]))
			{
				if($show_permission_message == FALSE)
				{
					echo '<small>'.Kohana::lang('ui_admin.custom_forms_insufficient_permissions').'</small><br/>';
					$show_permission_message = TRUE;
				}

				echo '<strong>'.$field_property['field_name'].'</strong> : ';
				if (isset($form['custom_field'][$field_id]))
				{
					echo $form['custom_field'][$field_id];
				}
				else
				{
					echo Kohana::lang('ui_main.no_data');;
				}
				//echo '<br/><br/>';
				//echo "</div>";
				continue;
			}
		}

		// Give all the elements an id so they can be accessed easily via javascript
		$id_name = 'id="custom_field_'.$field_id.'"';

		// Get the field value
		$field_value = ( ! empty($form['custom_field'][$field_id]))
			? $form['custom_field'][$field_id]
			: $field_property['field_default'];
		if ($field_property['field_type'] == 1)
		{
			// Text Field
			echo "<div class=\"report_row\" id=\"custom_field_row_" . $field_id ."\">";

			$field_options = customforms::get_custom_field_options($field_id);

			if (isset($field_options['field_hidden']) AND !isset($editor))
			{
				if($field_options['field_hidden'] == 1)
				{
                                    
                                    echo form::hidden($field_property['field_name'], $field_value);
				}
				else
				{
                                    
					echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
					echo form::input('custom_field['.$field_id.']', $field_value, $id_name .' class="text custom_text"');
				}
			}
			else
			{
				echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
				echo form::input('custom_field['.$field_id.']', $field_value, $id_name .' class="text custom_text"');
			}
			echo "</div>";
		}
		elseif ($field_property['field_type'] == 10) //my new custom Flexibledate field type
		{
			// Flexible date field
			echo "<div class=\"report_row\" id=\"custom_field_row_" . $field_id ."\">";

			$field_options = customforms::get_custom_field_options($field_id);

			if (isset($field_options['field_hidden']) AND !isset($editor))
			{
				if($field_options['field_hidden'] == 1)
				{
                                    echo form::hidden($field_property['field_name'], $field_value);
				}
				else
				{
					echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
					echo form::input('custom_field['.$field_id.']', $field_value, $id_name .' class="text custom_text"');
				}
			}
			else
			{
				echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
				echo form::input('custom_field['.$field_id.']', $field_value, $id_name .' class="text custom_text"');
			}
                        echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
                        echo "D: <select onchange='changeDate".$field_id."()' name='day".$field_id."' value='00'>Day<option value='00'>--</option> <option value='01'>1</option><option value='02'>2</option><option value='03'>3</option><option value='04'>4</option><option value='05'>5</option><option value='06'>6</option><option value='07'>7</option><option value='08'>8</option><option value='09'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option><option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option><option value='25'>25</option><option value='26'>26</option><option value='27'>27</option><option value='28'>28</option><option value='29'>29</option><option value='30'>30</option><option value='31'>31</option></select>";
                        echo "M: <select onchange='changeDate".$field_id."()' name='month".$field_id."' value='00'>Month<option value='00'>--</option>  <option value='01'>January</option><option value='02'>February</option><option value='03'>March</option><option value='04'>April</option><option value='05'>May</option><option value='06'>June</option><option value='07'>July</option><option value='08'>August</option><option value='09'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option></select>";
                        echo "Y: <select onchange='changeDate".$field_id."()' name='year".$field_id."' value='0000'>Year<option value='0000'>--</option>";
                        for ($x = date("Y")-90; $x <= date("Y"); $x++) {
                            echo "<option value='".$x."'>".$x."</option> ";
                        }
                        echo "</select> ";

                        echo "<script type='text/javascript'>
                            //alert('starting');    
                            function changeDate2".$field_id."(){
                                alert('changeDate2');
                                var dd = document.getElementsByName('day".$field_id."')[0];
                                var mm = document.getElementsByName('month".$field_id."')[0];
                                var yy = document.getElementsByName('year".$field_id."')[0];    
                                var fulldate = document.getElementsByName('custom_field[".$field_id."]')[0].value;
                                var t = str(fulldate).split('/');
                                dd.value = t[0];
                                mm.value = t[1];
                                yy.value = t[2];
                                } 

                            function changeDate".$field_id."(){
                                var dd = document.getElementsByName('day".$field_id."')[0].value;
                                var mm = document.getElementsByName('month".$field_id."')[0].value;
                                var yy = document.getElementsByName('year".$field_id."')[0].value;    
                                //alert(dd+'/'+mm+'/'+yy)    
                                var fulldate = document.getElementsByName('custom_field[".$field_id."]')[0];    
                                fulldate.value = dd+'/'+mm+'/'+yy;
                                //alert(dd+'/'+mm+'/'+yy)
                                }
                            //alert('".$field_value."');    
                            
                            var dd = document.getElementsByName('day".$field_id."')[0];
                            var mm = document.getElementsByName('month".$field_id."')[0];
                            var yy = document.getElementsByName('year".$field_id."')[0];    
                            var t = '".$field_value."'.split('/');
                            dd.value = t[0];
                            mm.value = t[1];
                            yy.value = t[2];

                            </script>";

			echo "</div>";
		}
		elseif ($field_property['field_type'] == 3)
		{ // Date Field
			echo "<div class=\"report_row\" id=\"custom_field_row_" . $field_id ."\">";
			echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
			echo form::input('custom_field['.$field_id.']', $field_value, ' id="custom_field_'.$field_id.'" class="text"');
			echo "<script type=\"text/javascript\">
				$(document).ready(function() {
				$(\"#custom_field_".$field_id."\").datepicker({
				showOn: \"both\",
                                dateFormat: \"dd/mm/yy\",
				buttonImage: \"".url::file_loc('img')."media/img/icon-calendar.gif\",
				buttonImageOnly: true
				});
				});
			</script>";
			echo "</div>";
		}
		elseif ($field_property['field_type'] == 4)
		{ // Date Field
			echo "<div class=\"report_row\" id=\"custom_field_row_" . $field_id ."\">";
			echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
			echo form::input('custom_field['.$field_id.']', $field_value, ' id="custom_field_'.$field_id.'" class="text"');
			echo "<script type=\"text/javascript\">
				$(document).ready(function() {
				$(\"#custom_field_".$field_id."\").datepicker({
				showOn: \"both\",
                                dateFormat: \"dd/mm/yy\",
				buttonImage: \"".url::file_loc('img')."media/img/icon-calendar.gif\",
				buttonImageOnly: true
				});
				});
			</script>";
			echo "</div>";
		}
		elseif ($field_property['field_type'] >=5 AND $field_property['field_type'] <=7)
		{
			// Multiple-selector Fields
			echo "<div class=\"report_row\" id=\"custom_field_row_" . $field_id ."\">";
			echo "<h4>" . $field_property['field_name'] . $isrequired . " " . $isprivate . "</h4>";
			$defaults = explode('::',$field_property['field_default']);

			$default = (isset($defaults[1])) ? $defaults[1] : 0;

			if (isset($form['custom_field'][$field_id]))
			{
				if($form['custom_field'][$field_id] != '')
				{
					$default = $form['custom_field'][$field_id];
				}
			}

			$options = explode(',',$defaults[0]);
			$html ='';
			switch ($field_property['field_type'])
			{
				case 5:
					foreach($options as $option)
					{
						$option = trim($option);
						$set_default = ($option == trim($default));

						$html .= "<span class=\"custom-field-option\">";
						$html .= form::label('custom_field['.$field_id.']'," ".$option." ");
						$html .= form::radio('custom_field['.$field_id.']',$option, $set_default, $id_name);
						$html .= "</span>";
					}
					break;
				case 6:
					$multi_defaults = !empty($field_property['field_response'])? explode(',', $field_property['field_response']) : NULL;

					$cnt = 0;
					$html .= "<table border=\"0\">";
					foreach($options as $option)
					{
						if ($cnt % 2 == 0)
						{
							$html .= "<tr>";
						}

						$html .= "<td>";
						$set_default = FALSE;

						if (!empty($multi_defaults))
						{
							foreach($multi_defaults as $key => $def)
							{
								$set_default = (trim($option) == trim($def));
								if ($set_default)
									break;
							}
						}
						$option = trim($option);
						$html .= "<span class=\"custom-field-option\">";
						$html .= form::checkbox("custom_field[".$field_id.'-'.$cnt.']', $option, $set_default, $id_name);
						$html .= form::label("custom_field[".$field_id.']'," ".$option);
						$html .= "</span>";

						$html .= "</td>";
						if ($cnt % 2 == 1 OR $cnt == count($options)-1)
						{
							$html .= "</tr>";
						}

						$cnt++;
					}
					// XXX Hack to deal with required checkboxes that are submitted with nothing checked
					$html .= "</table>";
					$html .= form::hidden("custom_field[".$field_id."-BLANKHACK]",'',$id_name);
					break;
				case 7:
					$ddoptions = array();
					// Semi-hack to deal with dropdown boxes receiving a range like 0-100
					if (preg_match("/[0-9]+-[0-9]+/",$defaults[0]) AND count($options == 1))
					{
						$dashsplit = explode('-',$defaults[0]);
						$start = $dashsplit[0];
						$end = $dashsplit[1];
						for($i = $start; $i <= $end; $i++)
						{
							$ddoptions[$i] = $i;
						}
					}
					else
					{
						foreach($options as $op)
						{
							$op = trim($op);
							$ddoptions[$op] = $op;
						}
					}

					$html .= form::dropdown("custom_field[".$field_id.']',$ddoptions,$default,$id_name);
					break;

			}

			echo $html;
			echo "</div>";
		}
		elseif ($field_property['field_type'] == 8 )
		{
			//custom div
			if ($field_property['field_default'] != "")
			{
				echo "<div class=\"" . $field_property['field_default'] . "\" $id_name>";
			}
			else
			{
				echo "<div class=\"custom_div\" $id_name >";
			}

			$field_options = customforms::get_custom_field_options($field_id);

			if (isset($field_options['field_toggle']) && !isset($editor))
			{
				if ($field_options['field_toggle'] >= 1)
				{
					echo "<script type=\"text/javascript\">
						$(function(){
						$('#custom_field_" .$field_id . "_link').click(function() {
  							$('#custom_field_" .$field_id . "_inner').toggle('slow', function() {
    						// Animation complete.
  							});
						});
					});
					</script>";
					echo "<a href=\"javascript:void(0);\" id=\"custom_field_" . $field_id ."_link\">";
					echo "<h2>" . $field_property['field_name'] . "</h2>";
					echo "</a>";

					$inner_visibility = ($field_options['field_toggle'] == 2) ? "none": "visible";

					echo "<div id=\"custom_field_" . $field_id . "_inner\" style=\"display:$inner_visibility;\">";
				}
				else
				{
					echo "<h2>" . $field_property['field_name'] . "</h2>";
					echo "<div id=\"custom_field_" . $field_id . "_inner\">";
				}
			}
			else
			{
				echo "<h2>" . $field_property['field_name'] . "</h2>";
				echo "<div id=\"custom_field_" . $field_id . "_inner\">";
			}
		}
		elseif ($field_property['field_type'] == 9)
		{
			// End of custom div
			echo "</div></div>";
			if (isset($editor))
			{
				echo "<h4 style=\"padding-top:0px;\">-------" . Kohana::lang('ui_admin.divider_end_field') . "--------</h4>";
			}
		}


		if (isset($editor))
		{
			$form_fields = '';
			$visibility_selection = array('0' => Kohana::lang('ui_admin.anyone_role'));
			$roles = ORM::factory('role')->find_all();
			foreach ($roles as $role)
			{
				$visibility_selection[$role->id] = ucfirst($role->name);
			}

			// Check if the field is required
			$isrequired = ($field_property['field_required'])
				? Kohana::lang('ui_admin.yes')
				: Kohana::lang('ui_admin.no');

			$form_fields .= "	<div class=\"forms_fields_edit\" style=\"clear:both\">
			<a href=\"javascript:fieldAction('e','EDIT',".$field_id.",".$form['id'].",".$field_property['field_type'].");\">EDIT</a>&nbsp;|&nbsp;
			<a href=\"javascript:fieldAction('d','DELETE',".$field_id.",".$form['id'].",".$field_property['field_type'].");\">DELETE</a>&nbsp;|&nbsp;
			<a href=\"javascript:fieldAction('mu','MOVE',".$field_id.",".$form['id'].",".$field_property['field_type'].");\">MOVE UP</a>&nbsp;|&nbsp;
			<a href=\"javascript:fieldAction('md','MOVE',".$field_id.",".$form['id'].",".$field_property['field_type'].");\">MOVE DOWN</a>
			</div>";
			echo $form_fields;
		}

		if ($field_property['field_type'] != 8 AND $field_property['field_type'] != 9)
		{
			//if we're doing custom divs we don't want these div's to get in the way.
			//echo "</div>";
		}
	}
?>
</div>