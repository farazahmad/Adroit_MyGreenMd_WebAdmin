/*     
	12/20/08
	Form Validator
	Jquery plugin for form validation and quick contact forms
	Copyright (C) 2008 Jeremy Fry

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

jQuery.iFormValidate = {
	build : function(user_options)
	{
		var defaults = {
			ajax: false,
			validCheck: false,
			phpFile:"/example/send.php",
			agreement: false,
			txtTOS: "You have to agree the Espressothuis TOS",
			txtInvalid: "Please check input with red border..",
			txtAjax: "Data has been updated..",
			txtSaving: "Saving.."
		};
		return $(this).each(
			function() {
			var options = $.extend(defaults, user_options); 
			if(options.validCheck){
				$inputs = $(this).find(":input").filter(":not(:submit)").filter(":not(:checkbox)").filter(":not(.novalid)");
			}else{
				$inputs = $(this).find(":input").filter(":not(:submit)").filter(":not(:checkbox)");
			}
			
			
			//catch the submit
			$(this).submit(function(){
				$('.confirmtxt').hide();
				$('.errortxt').hide();
				//we need to do a seperate analysis for checboxes
				$checkboxes = $(this).find(":checkbox");
				//we test all our inputs
				var isValid = jQuery.iFormValidate.validateForm($inputs);
				if(options.agreement){
					if($("#userAgree").attr("checked")){
						var fromValid = '';
					}else
					{
						var fromValid = 'agree';
						isValid = false;
					}
					//alert($("#userAgree").attr("checked"));
				}
				//if any of them come back false we quit
				if(!isValid){
					var addText='';
					if(fromValid=='agree'){
						addText+=options.txtTOS;
					}
					if(addText==''){
						addText+=options.txtInvalid;
					}else
					{
						//addText+="<br>Please check input with red line..";
					}
						$('.errortxt').html(addText);
						$('.errortxt').show('slow');
						
					return false;
				}
				if(options.ajax){
					var data = {};
					$inputs.each(function(){
						data[this.name] = this.value;
					});
					$checkboxes.each(function(){
						if($(this).is(':checked')){
							data[this.name] = this.value;
						}else{
							data[this.name] = "";
						}
						//data[this.name] = this.value;
					});
					
					//$(this).parent('div').fadeOut("slow", function(){
						//$(this).load(options.phpFile, data, function(){
						//	$(this).fadeIn("slow");
						//});
					//});
					
					
					//$('.confirmtxt').html('Saving..');
						//ajax login here
						$.ajax({
						   type: "POST",
						   url: options.phpFile,
						   //data: data,
						   data: $(this).serialize(),
						   success: function(msg){
						    
						     if(msg=='success'){
								$('.confirmtxt').html(options.txtAjax);
								$('.confirmtxt').show('slow');
								window.location=options.afterURL;
							 }else
							 {
								$('.errortxt').html(msg);
								$('.errortxt').show('slow');
							 }
						   }
						 });
					return false;
				}else{
					$('.confirmtxt').html(options.txtSaving);
					$('.confirmtxt').show('slow');
					return true;
					
				}
			});
			
			$inputs.bind("keyup", jQuery.iFormValidate.validate);
			$inputs.filter("select").bind("change", jQuery.iFormValidate.validate);
		});
	},
	validateForm : function($inputs)
	{
		var isValid = true; //benifit of the doubt?
		
		$inputs.filter(".is_required").each(jQuery.iFormValidate.validate);		
		if($inputs.filter(".is_required").hasClass("invalid")){isValid=false;}
		if($inputs.filter(".vemail").hasClass("invalid")){isValid=false;}
		if($inputs.filter(".vzip").hasClass("invalid")){isValid=false;}
		//if($inputs.filter(".vcaptcha").hasClass("invalid")){isValid=false;}
		if($inputs.filter(".vname").hasClass("invalid")){isValid=false;}
		if($inputs.filter(".vusername").hasClass("invalid")){isValid=false;}
                if($inputs.filter(".vwebsite").hasClass("invalid")){isValid=false;}
					
		return isValid;
	},
		
	validate : function(){
		var $val = $(this).val();
		var isValid = true;
		var varnull = 'no';
		if($(this).hasClass('vdate')){
		//Regex for DATE
			var Regex = /^([\d]|1[0,1,2]|0[1-9])(\-|\/|\.)([0-9]|[0,1,2][0-9]|3[0,1])(\-|\/|\.)\d{4}$/;
			isValid = Regex.test($val);		
		}else if($(this).hasClass('vemail')){
		//Regex for Email
			var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!Regex.test($val)){isValid = false;}		
		}else if($(this).hasClass('vconfirm_email')){
			var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
			if(!Regex.test($val)){isValid = false;}		
			if(strtolower($val)!=strtolower($('#email').val())){isValid = false;}
			
		//Check for not empty empty
		}else if($(this).hasClass('vphone')){
		//Regex for Phone
			var Regex = /^\(?[2-9]\d{2}[ \-\)] ?\d{3}[\- ]?\d{4}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if($(this).hasClass('vzip')){
		//Check for U.S. 5 digit zip code
			var Regex = /^\d{5}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if($(this).hasClass('vyear')){
		//Check for 4 digit year code
			var Regex = /^\d{4}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if($(this).hasClass('vstate')){
		//Check for state
			var Regex = /^[a-zA-Z]{2}$/;
			if(!Regex.test($val)){isValid = false;}
		}else if($(this).hasClass('vname')){
		//Check for name	
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val=='' || $val.length === 0){ isValid = false; }
		}else if($(this).hasClass('vusername')){
		//Check for user name	
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val=='' || $val.length === 0){ isValid = false; }
		//Check for captcha
		}else if($(this).hasClass('vcaptcha')){
			//alert($val+' - '+$('#captchax').val());
			if(strtolower($val)!=strtolower($('#captchax').val())){isValid = false;}
		//Check for not empty empty
		}else if($(this).hasClass('vpasswdl')){
			//alert($val+' - '+$('#captchax').val());
			var Regex = /^[a-zA-Z0-9\ ']*$/;
			if(!Regex.test($val)){isValid = false;}
			if($val.length<6){isValid = false;}	
		//Check for not empty empty
		}else if($(this).hasClass('vpasswd')){
			//alert($val+' - '+$('#captchax').val());			
			if($val.length<6){isValid = false;}	
			if(strtolower($val)!=strtolower($('#password').val())){isValid = false;}
		}else if($(this).hasClass('vwebsite')){
		//Check for website
			var Regex = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
			if(!Regex.test($val)){isValid = false;}
		//Check for not empty empty
		}else if($(this).hasClass('vchecked')){
			//alert($(this).attr("checked"));
		}else if($(this).hasClass('is_required')){
			if($val.length === 0){
				isValid = false;
			}	
		}else
		{
			varnull = 'yes';
		}
		
		if(varnull == 'no'){
			if(isValid){
				$(this).removeClass("invalid");
				//$(this).addClass("valid");
			}else{
				//$(this).removeClass("valid");
				$(this).addClass("invalid");				
			}
		}else
		{
			$(this).removeClass("invalid");
			$(this).removeClass("valid");
		}
	}	
}
jQuery.fn.FormValidate = jQuery.iFormValidate.build;