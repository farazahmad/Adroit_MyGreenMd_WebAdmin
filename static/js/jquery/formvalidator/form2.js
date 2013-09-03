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
			ajax: true,
			validCheck: false,
			phpFile:"/example/send.php"
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
				//we need to do a seperate analysis for checboxes
				$checkboxes = $(this).find(":checkbox");
				//we test all our inputs
				var isValid = jQuery.iFormValidate.validateForm($inputs);
				//if any of them come back false we quit
				if(!isValid){
					
						new Boxy('<div class=\'gagal_show\'><center >Maaf, Data Yang Dimasukan Kurang Lengkap <br/> <br/> Silahkan Cek Kembali..'+						
						'</center></div> ',
						{title: 'Konfirmasi',modal:true,center:true,closeText:'Tutup'});
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
					});	
					//$(this).parent('div').fadeOut("slow", function(){
						//$(this).load(options.phpFile, data, function(){
						//	$(this).fadeIn("slow");
						//});
					//});
					
					
					new Boxy('<div ><center ><span class="title_loading">Tunggu Sebentar, Sedang Memproses Data.. </span><br/>'+
						'</center></div> ',
						{title: 'Konfirmasi',modal:true,center:true,draggable:true,closeText:'Tutup'});
						//ajax login here
					
					
					return false;
				}else{
					
					new Boxy('<div class=\'loading_on\'><center>Data Sedang Diproses...</center><a href="#" class="hidden_link" onclick="Boxy.get(this).hide(); return false"></a></div> ',
					{modal:true,center:true});
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
					
		return isValid;
	},
		
	validate : function(){
		var $val = $(this).val();
		var isValid = true;
		
		if($(this).hasClass('vdate')){
		//Regex for DATE
			var Regex = /^([\d]|1[0,1,2]|0[1-9])(\-|\/|\.)([0-9]|[0,1,2][0-9]|3[0,1])(\-|\/|\.)\d{4}$/;
			isValid = Regex.test($val);		
		}else if($(this).hasClass('vemail')){
		//Regex for Email
			var Regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!Regex.test($val)){isValid = false;}		
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
			if(strtolower($val)!=strtolower($('#passwd').val())){isValid = false;}
			
		//Check for not empty empty
		}else if($val.length === 0){
			isValid = false;
		}
		
		if(isValid){
			$(this).removeClass("invalid");
			$(this).addClass("valid");
		}else{
			$(this).removeClass("valid");
			$(this).addClass("invalid");
		}
	}	
}
jQuery.fn.FormValidate = jQuery.iFormValidate.build;