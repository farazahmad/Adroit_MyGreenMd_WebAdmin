<?php
$message_register =<<<END
	Geachte {:name:}<br /><br />		
	Uw inschrijvingsgegevens zijn correct ontvangen. U kunt nu direct gebruikmaken van onze dienst door in te loggen met uw email adres en wachtwoord.<br /><br />
	Bewaar de volgende gegevens goed:<br /><br />
	Email : {:email:}<br />
	Wachtwoord : {:password:}<br /><br />
	Met Vriendelijke groet,<br /><br />
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
"email2"=>"Herhaal Email",
"use_login"=>"(use for login)",
"max_password"=>"(min. 6, max. 15 of characters)",
"email3"=>"Nieuw Email Adres",
"email4"=>"E-mailadres wijzigen",
"password1"=>"Wachtwoord",
"password2"=>"Herhaal wachtwoord",
"password3"=>"Oud wachtwoord",
"password4"=>"Nieuw wachtwoord",
"password5"=>"Wachtwoord wijzigen",
"delivery1"=>"Afleveradres",
"delivery2"=>"Afleveradres",
"salutation"=>"Voorletters",
"first_name"=>"Voornaam",
"last_name"=>"Achternaam",
"company"=>"Bedrijfs",
"contact_person"=>"Contactpersoon",
"address_line1"=>"Adres",
"address_line2"=>"Adresregel 2",
"zipcode"=>"Postcode",
"city"=>"Stad",
"country"=>"Land",
"lang_text"=>"Language",
"lang_text1"=>"(use for corespondence)",
"lang_text2"=>"Geef ten minste een van uw telefoonnummers, zodat onze Coffee Specialisten kunt u contact opnemen indien nodig met betrekking tot uw bestelling",
"home_phone"=>"Phone",
"mobile_phone"=>"Mobiele Telefoon",
"billing_adres1"=>"Uw factuuradres",
"billing_adres2"=>"Gebruikt u hetzelfde adres voor de levering en facturatie?",
"billing_adres3"=>"Met dezelfde adres van afleveradres",
"nationality"=>"Uw nationaliteit",
"your_employer"=>"Uw werkgever",
"agree"=>"Ik heb gelezen en ga akkoord met de Espressothui",
"terms"=>"Algemene Diensten",
"invoice_address"=>"Factuuradres",
"other"=>"Ander",
"reg_button"=>"Registeren",
"cancel_button"=>"Annuleren",
"private"=>"Prive",
"edit_account"=>"Account bewerken",
"send_email"=>$message_register,
"send_email2"=>$message_register2,
"send_email_subject"=>"Espressothuis Aanmelding",
"send_email_subject2"=>"Nieuwe aanmelding : {:name:}",
"error_confirm"=>"Registratie is mislukt, probeer het opnieuw ..",
"valid_confirm"=>"Uw gegevens worden verstrekt, controleer uw e-mail: (:e-mail:) voor meer informatie.."
);
$lang['error_form'] = array(
"TOS" => "Je moet de Espressothuis TOS eens",
"invalid" => "Controleer aub ingang met rode lijn..",
"txtAjax" => "Gegevens is bewerkt..",
"txtSaving" => "Opslaan.."
);
$lang['login'] = array(
"headtitle"=>"Member Login",
"empty_user_pass"=>"Gebruikersnaam of wachtwoord is niet geldig..",
"username"=>"Uw Email Adres",
"userpass"=>"Wachtwoord",
"email_valid"=>"Email not valid..",
"alphanumeric"=>"password only allowed alphanumeric!",
"minchar"=>"password minimal 6 characters",
"please_login"=>"Gelieve in te loggen..",
"please_fill"=>"Vul gebruikersnaam en wachtwoord!",
"accepted"=>"Geaccepteerd, redirecting aan de Lid-pagina..",
"login"=>"INLOGGEN",
"email_address"=>"Email adres:",
"password"=>"Wachtwoord:",
"forgot_password"=>"Wachtwoord vergeten?",
"member_login" => "Inloggen"
);
$message_forgot_pass =<<<END
	Geachte {:name:}<br /><br />
	Klik op onderstaande link, om uw wachtwoord opnieuw instellen<br />
	<a href="{:base_path:}resetpass/{:email_md5:}" target="_blank">{:base_path:}resetpass/{:email_md5:}</a><br />
	* indien links niet werken, kopieer de url naar uw browser<br />	
	<br />
	Met Vriendelijke groet,<br /><br />
	Espressothuis
END;
$lang['forgot_password'] = array(
"headtitle"=>"Forgot Password",
"title"=>"het herstellen van uw wachtwoord...",
"name"=>"Uw naam",
"nametxt"=>"Your Name:",
"email"=>"Uw email adres",
"emailtxt"=>"Email Address:",
"please_fill"=>"Please Fill Name and Email Address..",
"failed"=>"Data user not found..",
"email_valid"=>"Email not valid..",
"accepted"=>"validating..",
"send_button"=>"Sturen",
"login"=>"Inloggen",
"register"=>"Registeren",
"error_confirm"=>"uw email: {:email:} niet gevonden..",
"valid_confirm"=>"controleer dan uw e-mail : {:email:} voor meer informatie..",
"send_email"=>$message_forgot_pass,
"send_email_subject"=>"Espressothuis Wachtwoord vergeten"
);
$message_reset_pass =<<<END
	Dear {:name:}<br /><br />
	Uw wachtwoord is gereset,<br />
	Dit is uw account informatie:<br /><br />
	Email : {:email:}<br />
	Nu Wachtwoord : {:new_pass:}<br /><br />
	Met Vriendelijke groet,<br /><br />
	Espressothuis
END;
$lang['reset_password'] = array(
"headtitle"=>"Reset Password",
"title"=>"Vul uw nieuwe wachtwoord...",
"password1"=>"New Password",
"password2"=>"Confirm New Password",
"send_button"=>"Sturen",
"login"=>"Inloggen",
"register"=>"Registeren",
"error_confirm"=>"uw email adres niet gevonden..",
"valid_confirm"=>"controleer dan uw e-mail : {:email:} voor meer informatie..",
"send_email"=>$message_reset_pass,
"send_email_subject"=>"Espressothuis gereset"
);
$lang['change_password'] = array(
"empty_pass"=>"nieuw wachtwoord leeg!",
"alphanumeric"=>"vergeten mag alleen alfanumerieke!",
"minchar"=>"wachtwoord minimaal 6 karakters",
"not_match"=>"Bevestig wachtwoord niet overeen!"
);
$lang['change_email'] = array(
"empty_email"=>"nieuw e-mailadres leeg!",
"not_valid"=>"e-mail niet geldig!",
"not_match"=>"Bevestig e-mail niet overeen!"
);
$lang['homepage'] = array(
"register_text1"=>"Hoe lid worden<br />van de Mondrian<br />Club?",
"register_text2"=>"short description will goes here short description will goes here short description will goes here short description will goes here short description will goes here",
"register_button"=>"REGISTEREN"
);
$lang['news'] = array(
"news"=>"Nieuws",
"latest_news"=>"Laatste Nieuws",
"paging"=>"Pagina",
"show_all"=>"Toon Alle",
"read_more"=>"Less meer"
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
"agenda_date"=>"Datum",
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
									"shopping_cart" => "Winkelwagen",
									"abonnement" => "abonnement",		
									"checkout" => "afrekenen",		
									"grand_total" => "Grand Totaal",
									"price_combination" => "Prijs Combinatie",	
									"custom" => "gebruik",	
									"shipping_cart" => "Verzendkosten",	
									"your_order" => "Uw bestelling",
									"your_abonnement" => "Uw bestelling Abonnement
", 
									"pay" => "Betalen",	
									"account_information" => "Accountgegevens",	
									"delivery_address" => "Afleveradres",	
									"billing_address" => "Factuuradres",	
									"payment_method" => "Betaalwijze",		
									"shipping_method" => "Verzendwijze",		
									"information" => "Informatie",		
									"term" => "Ik heb gelezen en geaccepteerd Espressothuis's<br>
<a href=\"#\">Algemene voorwaarden</a>.",
									"edit" => "edit",			
									"contact_us" => "Contacteer ons",	
									"more_info" => "meer info"
);

$lang['general'] = array(
"title"=>"Title",
"email"=>"Email",
"name"=>"Naam",
"telephone"=>"Telefoon",
"messages"=>"Messages",
"reset"=>"RESET",
"submit"=>"SUBMIT",
"terms"=>"Ik heb gelezen en geaccepteerd Espressothuis's <a id=\"termslink\" class=\"termslink\" href=\"{:BASE_PATH:}terms.html\">Algemene voorwaarden</a>",
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
"headtext"=>"Deel uw ervaringen",
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
"have_account" => "Bent u al lid?",
"login" => "login",
"welcome" => "Welkom",
"login_as" => "ingelogd als:",
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
