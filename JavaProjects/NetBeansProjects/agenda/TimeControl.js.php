<?php
/**
 * This file is part of php-agenda.
 * 
 * php-agenda is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * php-agenda is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with php-agenda; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * Copyright 2006-2007, Thomas Abeel
 * 
 * Project: http://sourceforge.net/projects/php-agenda/
 * 
 */

header('Content-Type: application/x-javascript');
header('Pragma: no-cache');
/*
 * Load languages
 */
include ('lang/lang.inc.php');
?>
function TimeControl() {

  var timeId = 'TimeControl';
  var currentHour = 0;
  var currentMinute = 0;

  var selectedHour = 0;
  var selectedMinute = 0;

  var timeField = null;

  function getProperty(p_property){
    var p_elm = timeId;
    var elm = null;

    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    if (elm != null){
      if(elm.style){
        elm = elm.style;
        if(elm[p_property]){
          return elm[p_property];
        } else {
          return null;
        }
      } else {
        return null;
      }
    }
  }

  function setElementProperty(p_property, p_value, p_elmId){
    var p_elm = p_elmId;
    var elm = null;

    if(typeof(p_elm) == "object"){
      elm = p_elm;
    } else {
      elm = document.getElementById(p_elm);
    }
    if((elm != null) && (elm.style != null)){
      elm = elm.style;
      elm[ p_property ] = p_value;
    }
  }

  function setProperty(p_property, p_value) {
    setElementProperty(p_property, p_value, timeId);
  }

  this.clearTime = clearTime;
  function clearTime() {
    timeField.value = '';
    hide();
  }

  this.setTime = setTime;
  function setTime(hour, minute) {
    if (timeField) {
      if (hour < 10) {hour = "0" + hour;}
      if (minute < 10) {minute = "0" + minute;}

      var timeString = hour+":"+minute;
      timeField.value = timeString;
      hide();
    }
    return;
  }

  function getCurrentHour() {
	return new Date().getHours();
  }

  function getCurrentMinute() {
    return new Date().getMinutes();
  } 

  function timeDrawTable() {

    var table = "<table>";  
    table+="<tr><td colspan=12><a href='javascript:clearTimeControl();'><?php echo $lang['control-clear'];?></a> | <a href='javascript:hideTimeControl();'><?php echo $lang['control-close'];?></a></td></tr>";
    for(var h1=0;h1<8;h1++){
    table+="<tr>";
    for(var h2=0;h2<3;h2++){
	    var h=h1*3+h2;
    	
    	for(var m=0;m<60;m+=15){
    		if((h>=9 && h<=9)||(h>=18&&h<23)){
		   		table+="<td class='early'><a href='javascript:setTimeControl("+h+","+m+");'>"+h+":"+m+"</a></td>";
    		}else if(h>=10 && h<18){
	    		table+="<td class='office'><a href='javascript:setTimeControl("+h+","+m+");'>"+h+":"+m+"</a></td>";
	    	}else{
	    		table+="<td class='other'><a href='javascript:setTimeControl("+h+","+m+");'>"+h+":"+m+"</a></td>";
	    	}
    	}
    	
    	}
    	table+="</tr>";
    }
     table+="<tr><td colspan=12><a href='javascript:clearTimeControl();'><?php echo $lang['control-clear'];?></a> | <a href='javascript:hideTimeControl();'><?php echo $lang['control-close'];?></a></td></tr>";
    table+="</table>";
    return table;
  }
	this.show=show;
  function show(field) {
    can_hide = 0;
  
    // If the calendar is visible and associated with
    // this field do not do anything.
    if (timeField == field) {
      return;
    } else {
      timeField = field;
    }

    if(timeField) {
        var timeString = new String(timeField.value);
        var timeParts = timeString.split(":");
        
        selectedHour = parseInt(timeParts[0],10);
        selectedMinute = parseInt(timeParts[1],10);
      
    }

    if (!(selectedHour && selectedMinute)) {
      selectedMinute = getCurrentMinute();
      selectedHour = getCurrentHour();
    }

    currentMinute = selectedMinute;
    currentHour = selectedHour;
    

    if(document.getElementById){

      tmp_time = document.getElementById(timeId);
      tmp_time.innerHTML = timeDrawTable();

      setProperty('display', 'block');

      var fieldPos = new positionInfo(timeField);
      var timePos = new positionInfo(timeId);

      var x = fieldPos.getElementLeft();
      var y = fieldPos.getElementBottom();

      setProperty('left', x + "px");
      setProperty('top', y + "px");
 
      if (document.all) {
        setElementProperty('display', 'block', 'TimeControlIFrame');
        setElementProperty('left', x + "px", 'TimeControlIFrame');
        setElementProperty('top', y + "px", 'TimeControlIFrame');
        setElementProperty('width', timePos.getElementWidth() + "px", 'TimeControlIFrame');
        setElementProperty('height', timePos.getElementHeight() + "px", 'TimeControlIFrame');
      }
    }
  }

  this.hide = hide;
  function hide() {
    if(timeField) {
      setProperty('display', 'none');
      setElementProperty('display', 'none', 'TimeControlIFrame');
	  timeField = null;
    }
  }

  this.visible = visible;
  function visible() {
    return timeField
  }

  this.can_hide = can_hide;
  var can_hide = 0;
  
  this.clearTime = clearTime;
  function clearTimeControl() {
    timeField.value = '';
    hide();
  }
  this.hideTime=hideTime;
  function hideTime(){
    hide();
  }
}


this.clearTime = clearTime;
function clearTime() {
    timeField.value = '';
    hide();
}



var timeControl = new TimeControl();

function setTimeControl(hour,minute){
timeControl.setTime(hour,minute);
}

function showTimeControl(textField) {
	timeControl.show(textField);
}
function clearTimeControl() {
	timeControl.clearTime();
}
function hideTimeControl() {
	timeControl.hideTime();
}


document.write("<iframe id='TimeControlIFrame' src='javascript:false;' frameBorder='0' scrolling='yes' ></iframe>");
document.write("<div id='TimeControl'></div>");