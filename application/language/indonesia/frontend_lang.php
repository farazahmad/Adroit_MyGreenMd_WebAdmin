<?php
$message_register =<<<END
	Dear {:name:}<br /><br />		
	Your registration information has been correctly received. You can now directly use our service by logging with your email address and password.<br /><br />
	This is your account information:<br />
	Email : {:email:}<br />
	Password : {:password:}<br /><br />
	Sincerely,<br /><br />
	Espressothuis
END;
$message_register2 =<<<END
	Dear {:name:}<br /><br />		
	Your registration information for affiliate has been correctly received.<br /><br />
	This is your account information:<br />
	Email : {:email:}<br />
	Password : {:password:}<br /><br />
	you can login now, but for affiliate you have to waiting for admin approval<br />
	and it will take within 7 days<br /><br />
	Sincerely,<br /><br />
	Espressothuis
END;
$lang['register'] = array(
"headtitle"=>"Member Registration",
"headtitle2"=>"Affilate Registration",
"headtitle3"=>"Member Information",
"headtitle4"=>"Affilate Information",
"personal_info"=>"Personal Information",
"affiliate_status"=>"Affiliate Status",
"coupon_code"=>"Coupon Code",
"total_transaction"=>"Total Transaction",
"earn_money"=>"Earn Money",
"total_cashout"=>"Total Cashout",
"earn_info"=>"will have paid every month when the amount of money collected is more than 50 Euro",
"pending"=>"still waiting from admin approval for affiliate..",
"email1"=>"Email",
"email2"=>"Confirm Email",
"use_login"=>"(use for login)",
"max_password"=>"(min. 6, max. 15 of characters)",
"email3"=>"New Email Address",
"email4"=>"Change Email Address",
"password1"=>"Password",
"password2"=>"Confirm Password",
"password3"=>"Old Password",
"password4"=>"New Password",
"password5"=>"Change Password",
"delivery1"=>"Delivery Address",
"delivery2"=>"Delivery address",
"salutation"=>"Salutation",
"first_name"=>"First Name",
"last_name"=>"Last Name",
"company"=>"Company",
"contact_person"=>"Contact Person",
"address_line1"=>"Address",
"address_line2"=>"Address Line 2",
"zipcode"=>"Postal / Zip Code",
"city"=>"City",
"country"=>"Country",
"lang_text"=>"Language",
"lang_text1"=>"(use for corespondence)",
"lang_text2"=>"Please enter at least one of your phone numbers so that our Coffee Specialists may contact you if necessary concerning your order",
"home_phone"=>"Phone",
"mobile_phone"=>"Mobile Phone",
"billing_adres1"=>"Billing Address",
"billing_adres2"=>"Are you using the same address for delivery and billing?",
"billing_adres3"=>"Using the same address from delivery address",
"nationality"=>"Your nationality",
"your_employer"=>"Your employer",
"agree"=>"I have read and agree to the Espressothuis",
"terms"=>"Terms of Services",
"invoice_address"=>"Invoice Address",
"other"=>"Other",
"reg_button"=>"Register",
"cancel_button"=>"Cancel",
"private"=>"Private",
"edit_account"=>"Edit Account",
"send_email"=>$message_register,
"send_email2"=>$message_register2,
"send_email_subject"=>"Espressothuis Registration",
"send_email_subject2"=>"New registration : {:name:}",
"error_confirm"=>"Registration failed, try again ..",
"valid_confirm"=>"Your data is submitted, check your e-mail: {:email:} for more information.."
);
$lang['error_form'] = array(
"TOS"=>"You have to agree the Espressothuis TOS",
"invalid"=>"Please check input with red border..",
"txtAjax" => "Data has been updated..",
"txtSaving" => "Saving.."
);
$lang['login'] = array(
"headtitle"=>"Member Login",
"empty_user_pass"=>"Username or password is not valid..",
"not_match"=>"Username or password is not match..",
"username"=>"Your Email Address",
"userpass"=>"password",
"email_valid"=>"Email not valid..",
"alphanumeric"=>"password only allowed alphanumeric!",
"minchar"=>"password minimal 6 characters",
"please_login"=>"Please Login",
"please_fill"=>"Please fill username and password!",
"accepted"=>"Accepted, redirecting to member page..",
"login"=>"LOGIN",
"email_address"=>"Email address:",
"password"=>"Password:",
"forgot_password"=>"Forgot password?",
"member_login"=>"Member Login"
);
$message_forgot_pass =<<<END
	Dear {:name:}<br /><br />
	Click link below, here reset your password<br />
	<a href="{:base_path:}resetpass/{:email_md5:}" target="_blank">{:base_path:}resetpass/{:email_md5:}</a><br />	
	* if links not work,, just copy the url to your browser<br />
	<br />
	Sincerely,<br /><br />
	Espressothuis
END;
$lang['forgot_password'] = array(
"headtitle"=>"Forgot Password",
"title"=>"recover your password...",
"name"=>"Your name",
"nametxt"=>"Your Name:",
"email"=>"Your email address",
"emailtxt"=>"Email Address:",
"please_fill"=>"Please Fill Name and Email Address..",
"failed"=>"Data user not found..",
"email_valid"=>"Email not valid..",
"accepted"=>"validating..",
"send_button"=>"Send",
"login"=>"Login",
"register"=>"Register",
"error_confirm"=>"your email : {:email:} not found..",
"valid_confirm"=>"check your e-mail : {:email:} for more information..",
"send_email"=>$message_forgot_pass,
"send_email_subject"=>"Espressothuis Forgot Password"
);

$message_reset_pass =<<<END
	Dear {:name:}<br /><br />
	Your password has been reset,<br />
	This is your account information:<br /><br />
	Email : {:email:}<br />
	New Password : {:new_pass:}<br /><br />
	Sincerely,<br /><br />
	Espressothuis
END;
$lang['reset_password'] = array(
"headtitle"=>"Reset Password",
"title"=>"Enter your new password...",
"password1"=>"New Password",
"password2"=>"Confirm New Password",
"send_button"=>"Send",
"login"=>"Login",
"register"=>"Register",
"error_confirm"=>"your email address not found..",
"valid_confirm"=>"check your e-mail : {:email:} for more information..",
"send_email"=>$message_reset_pass,
"send_email_subject"=>"Espressothuis Reset Password"
);
$lang['change_password'] = array(
"empty_pass"=>"new password empty!",
"alphanumeric"=>"password only allowed alphanumeric!",
"minchar"=>"password minimal 6 characters",
"not_match"=>"confirm password not match!"
);
$lang['change_email'] = array(
"empty_email"=>"new email address empty!",
"not_valid"=>"email not valid!",
"not_match"=>"confirm email not match!"
);
$lang['homepage'] = array(
"register_text1"=>"Hoe lid worden<br />van de Mondrian<br />Club?",
"register_text2"=>"short description will goes here short description will goes here short description will goes here short description will goes here short description will goes here",
"register_button"=>"REGISTER"
);
$lang['news'] = array(
"news"=>"News",
"latest_news"=>"Latest News",
"paging"=>"Paging",
"show_all"=>"Show All",
"read_more"=>"Read more"
);
$message_contact =<<<END
	New Contact Data<br /><br />
	Email : {:email:}<br />
	Name : {:name:}<br />
	Phone : {:phone:}<br />
	Message : {:message:}<br />
	<br />
	Sincerely,<br /><br />
	Espressothuis
END;
$lang['contact'] = array(
"send_email"=>$message_contact,
"contact_success"=>"Message has been sent",
"contact_failed"=>"send message failed.."
);
$lang['member_page'] = array(
"special_club"=>"Special Club Offer",
"reminder"=>"Reminder",
"reminder_not_found"=>"reminder preview not found",
"event_category"=>"Event category",
"add_new_agenda"=>"Add new Agenda",
"agenda_date"=>"Date",
"agenda_title"=>"Title",
"agenda_text"=>"Agenda Text",
"title"=>"Member Page",
"account_info"=>"Account Information",
"shopping_cart"=>"Shopping Cart",
"my_agenda"=>"My Agenda",
"webshop"=>"Webshop",
"textagenda"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
);
$lang['webshop'] = array(
									"shopping_cart" => "Shopping Cart",
									"abonnement" => "abonnement",		
									"checkout" => "checkout",		
									"grand_total" => "Grand Total",
									"price_combination" => "Price Combination",	
									"custom" => "custom",	
									"shipping_cart" => "shipping cart",	
									"your_order" => "Your Order",
									"your_abonnement" => "Your Abonnement", 
									"pay" => "pay",	
									"account_information" => "Account Information",	
									"delivery_address" => "Delivery address",	
									"billing_address" => "Billing address",	
									"payment_method" => "Payment Method",		
									"shipping_method" => "Shipping Method",		
									"information" => "Information",		
									"term" => "I have read and accepted Espressothuis's <br><a href='#'>Terms and Condition</a>.",
									"edit" => "edit",			
									"contact_us" => "Contact us",	
									"more_info" => "more info"
);
$lang['general'] = array(
"title"=>"Title",
"email"=>"Email",
"name"=>"Name",
"telephone"=>"Telephone",
"messages"=>"Messages",
"reset"=>"RESET",
"submit"=>"SUBMIT",
"terms"=>"I have read and accepted Espressothuis's <a id=\"termslink\" class=\"termslink\" href=\"{:BASE_PATH:}terms.html\">Terms and Condition</a>",
"picture"=>"Picture"
);
$message_exp =<<<END
	Add new experience<br /><br />
	Email : {:exp_email:}<br />
	Name : {:exp_name:}<br />
	Picture : {:exp_pic:}<br />
	Experience title : {:exp_title:}<br />
	Experience description : {:exp_desc:}<br />
	<br/>
	Admin will approve your experience data..
	<br/>
	Sincerely,<br /><br />
	Espressothuis
END;
$lang['experience'] = array(
"download_exp"=>"Download Experience",
"by"=>"by",
"submit_your_exp"=>"SUBMIT YOUR EXPERIENCE",
"more_exp"=>"MORE EXPERIENCES",
"expofday_head"=>"From The Expert",
"send_email"=>$message_exp,
"headtext"=>"Send your experiment",
"exp_title"=>"Experience title",
"exp_desc"=>"Experience Description",
"exp_success"=>"New experience been submitted",
"exp_failed"=>"Submit new experience failed..",
"exp_picture_failed"=>"Please input picture..",
"download_failed"=>"Download experience failed.."
);

$lang['recipe'] = array(
"download_recipe"=>"Download Recipe",
"how_to_make"=>"How to make",
"ingredients"=>"Ingredients",
"by"=>"by",
"submit_your_recipe"=>"SUBMIT YOUR RECIPE",
"more_recipes"=>"MORE RECIPES",
"recipeofday_head"=>"From The Expert",
"submit_recipe"=>"Submit your recipe",
"recipe_name"=>"Recipe name",
"ingredients"=>"Ingredients",
"how_to"=>"How to",
"login"=>"You must be <a id=\"termslink\" class=\"termslink\" href=\"{:BASE_PATH:}login.html\">logged in</a> to submit your recipes or <a id=\"termslink\" class=\"termslink\" href=\"{:BASE_PATH:}register_new.html\">register here</a>",
"recipe_success"=>"New recipe been submitted",
"recipe_failed"=>"Submit new recipe failed..",
"recipe_picture_failed"=>"Please input picture..",
"download_failed"=>"Download recipe failed.."
);
$lang['date'] = array(
"birth_date"=>"Birth Date",
"date"=>"Date",
"month"=>"Month",
"year"=>"Year"
);

$lang['userinfo'] = array(
"have_account" => "Already have a member?",
"login" => "login",
"welcome" => "Welcome",
"login_as" => "Login as",
"logout" => "logout",
"register" => "register"
);

$lang['faq'] = array(
"faq_search" => "FAQ search",
"faq" => "FAQ",
"question" => "Question",
"answer" => "Answer",
"faq_not_found" => "FAQ not found!",
"search_result" => "Search result",
"not_found" => "not found!",
"data_found" => "data found!"
);
?>