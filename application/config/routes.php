<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'home';
// $route['booking/excel/(:any)'] = 'booking/excel/$1';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

//
$route['default_controller'] = 'Website_manager';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

######################### WEB ROUTE START ############################
/* $route['about-us'] 						= 'Website_manager/about';
$route['vision'] 						= 'Website_manager/vision';
$route['services'] 						= 'Website_manager/services';
$route['pincode-tracking'] 				= 'Website_manager/pincode_tracking';
$route['track-shipment'] 				= 'Website_manager/track_shipment';
$route['contact-us'] 					= 'Website_manager/contact_us';
$route['customer-login'] 				= 'Website_manager/customer_login';
$route['customer-detail'] 				= 'Customer_manager/customer_detail';
$route['view-report'] 					= 'Customer_manager/view_report';
$route['view-search-shipment'] 			= 'Customer_manager/search_shipment';
$route['view-list-shipment'] 			= 'Customer_manager/list_shipment';
$route['view-pickup-request'] 			= 'Customer_manager/pickup_request';
$route['view-pod'] 						= 'Customer_manager/pod';
$route['customer-logout'] 				= 'Website_manager/logout';
 */

$route['home_page']            =        'Website_manager/home';
$route['abouts_page']          =        'Website_manager/about';
$route['services_page']        =        'Website_manager/service';
$route['document_page']        =        'Website_manager/document';
$route['helpdesk_page']        =        'Website_manager/helpdesk';
$route['contacts_page']        =        'Website_manager/contact'; 
$route['Customerlogin_add']    =        'Website_manager/customerlogin';
$route['find_location']        =        'Website_manager/pincode_tracking';
$route['track_shipment']       =        'Website_manager/track_shipment';
$route['find_location_tack']   =        'Website_manager/tracking';
$route['career']   				=        'Website_manager/career';

$route['privacy']   				=        'Website_manager/privacy';






######################### Admin ROUTE START ############################
$route['admin'] 						= 'Website_manager/admin_login';
$route['admin_logout'] 					= 'Website_manager/logout';
$route['admin/dashboard'] 				= 'Admin_manager/view_dashboard';

$route['admin/list-company'] 			= 'Admin_company_manager/index';
$route['admin/add-company'] 			= 'Admin_company_manager/add_company';
$route['admin/edit-company/(:num)']		= 'Admin_company_manager/update_company/$1';
$route['admin/delete-company/(:num)']	= 'Admin_company_manager/delete_company/$1';

$route['admin/list-smtp'] 			= 'Admin_smtp_config/index';
$route['admin/add-smtp'] 			= 'Admin_smtp_config/add_smtp';
$route['admin/edit-smtp/(:num)']	= 'Admin_smtp_config/update_smtp/$1';
$route['admin/delete-smtp/(:num)']	= 'Admin_smtp_config/delete_smtp/$1';

$route['admin/list-pendingship'] 	= 'Admin_pendingshipment/index';
/* $route['admin/add-pod'] 	        = 'Admin_generatepod/addpodnew';
$route['admin/edit-pod/(:num)'] 	= 'Admin_generatepod/updatepodnew/$1';
$route['admin/delete-pod/(:num)']	= 'Admin_generatepod/deletepod/$1'; */

$route['admin/list-user'] 			= 'Admin_users/index';
$route['admin/add-user'] 			= 'Admin_users/add_user';
$route['admin/edit-user/(:num)']	= 'Admin_users/update_user/$1';
$route['admin/delete-user/(:num)']	= 'Admin_users/delete_user/$1';

$route['admin/add-partner'] 		= 'Admin_users/add_user';

$route['admin/list-gst'] 				= 'Admin_gst_setting/index';
$route['admin/view-add-gst'] 			= 'Admin_gst_setting/add_gst';
$route['admin/insert-gst'] 				= 'Admin_gst_setting/insert_gst';
$route['admin/view-edit-gst/(:num)'] 	= 'Admin_gst_setting/edit_gst/$1';
$route['admin/edit-gst/(:num)'] 	 	= 'Admin_gst_setting/update_gst/$1';
$route['admin/delete-gst/(:num)'] 		= 'Admin_gst_setting/delete_gst/$1';

$route['admin/list-customer'] 		    = 'Admin_customer/index';
$route['admin/add-customer'] 			= 'Admin_customer/add_customer';
$route['admin/edit-customer/(:num)']	= 'Admin_customer/update_customer/$1';
$route['admin/delete-customer/(:num)']	= 'Admin_customer/delete_customer/$1';

$route['admin/list-rate'] 							= 'Admin_ratemaster/index';
$route['admin/add-regionwise-rate/(:num)'] 			= 'Admin_ratemaster/assign_regionwise_rate/$1';
$route['admin/show_regionwise_rate/(:num)'] 		= 'Admin_ratemaster/regionwise_rate_edit/$1';

$route['admin/show_state_city_wise_rate/(:num)'] 	= 'Admin_ratemaster/state_city_wise_rate_edit/$1';
$route['admin/show_edit_state_city_wise_rate/(:num)/(:num)'] 	= 'Admin_ratemaster/edit_state_city_wise_rate_edit/$1/$2';

$route['admin/add_state_wise_rate/(:num)'] 			= 'Admin_ratemaster/add_StateCityRateMaster/$1';
$route['admin/edit_state_city_wise_rate/(:num)'] 	= 'Admin_ratemaster/edit_StateCityRateMaster/$1';

//$route['admin/edit-rate/(:num)'] 		= 'Admin_ratemaster/update_rate/$1';
$route['admin/delete-rate/(:num)'] 		= 'Admin_ratemaster/delete_rate/$1';

//=========== International Export Billing
$route['admin/list-booking'] 				= 'Admin_international_booking/index';
$route['admin/list-invoice'] 				= 'Admin_international_booking/invoice';

$route['admin/show-edit-invoice/(:num)/(:num)'] 	= 'Admin_international_booking/invoice_edit/$1/$2';
$route['admin/edit-invoice/(:num)'] 		= 'Admin_international_booking/save_edit/$1';
$route['admin/delete-invoice/(:num)'] 		= 'Admin_international_booking/invoice_delete/$1';

$route['admin/list-finalInvoice'] 				  = 'Admin_international_booking/finalInvoice';
$route['admin/show-edit-final-invoice/(:num)/(:num)'] = 'Admin_international_booking/final_invoice_edit/$1/$2';
$route['admin/invoice-view/(:num)/(:num)'] 		  = 'Admin_international_booking/invoice_view/$1/$2';
$route['admin/invoice-pdf/(:num)/(:num)'] 		  = 'Admin_international_booking/pdf/$1/$2';
$route['admin/edit-final-invoice/(:num)'] 		  = 'Admin_international_booking/save_edit/$1';
$route['admin/international_excel/(:num)/(:num)'] = 'Admin_international_booking/international_excel/$1/$2';

$route['admin/send-international-invoice-mail/(:num)/(:num)'] 	= 'Admin_international_booking/send_mail/$1/$2';
//========International Import Billing
$route['admin/list-booking-import'] 				= 'Admin_international_import_booking/index';
$route['admin/list-invoice-import'] 				= 'Admin_international_import_booking/invoice';

$route['admin/show-edit-invoice-import/(:num)/(:num)'] 	= 'Admin_international_import_booking/invoice_edit/$1/$2';
$route['admin/edit-invoice-import/(:num)'] 			= 'Admin_international_import_booking/save_edit/$1';
$route['admin/delete-invoice-import/(:num)'] 		= 'Admin_international_import_booking/invoice_delete/$1';

$route['admin/list-finalInvoice-import'] 					= 'Admin_international_import_booking/finalInvoice';
$route['admin/show-edit-final-invoice-import/(:num)/(:num)'] = 'Admin_international_import_booking/final_invoice_edit/$1/$2';
$route['admin/invoice-view-import/(:num)/(:num)'] 			= 'Admin_international_import_booking/invoice_view/$1/$2';
$route['admin/invoice-pdf-import/(:num)/(:num)'] 			= 'Admin_international_import_booking/pdf/$1/$2';
$route['admin/edit-final-invoice-import/(:num)'] 			= 'Admin_international_import_booking/save_edit/$1';
$route['admin/international_excel_import/(:num)/(:num)'] 	= 'Admin_international_import_booking/international_excel/$1/$2';

$route['admin/send-international-import-invoice-mail/(:num)/(:num)'] 	= 'Admin_international_import_booking/send_mail/$1/$2';

//====================
$route['admin/list-invoice-receipt']	= 'Admin_payment/view_receipts';
$route['admin/save-received-payments'] 	= 'Admin_payment/add_receipts';
$route['admin/save-adjust-payments'] 	= 'Admin_payment/add_adjust_payment';
$route['admin/list-payments-invoice'] 	= 'Admin_payment/index';
$route['admin/show-payment-invoice-list'] = 'Admin_payment/show_payment_invoice_list';
$route['admin/save-payments'] 			= 'Admin_payment/save_payment';
$route['admin/list-history']  			= 'Admin_payment/payment_history';
//====================
$route['admin/list-international-payments'] = 'Admin_international_booking/payments';
$route['admin/save-international-payments'] = 'Admin_international_booking/save_payment';
$route['admin/list-payment_history'] 		= 'Admin_international_booking/payment_history';
//=========== Domestic Billing
$route['admin/list-domestic-booking'] 		= 'Admin_domestic_booking/index';
$route['admin/list-domestic-invoice'] 		= 'Admin_domestic_booking/invoice';
$route['admin/show-edit-domestic-invoice/(:num)/(:num)'] = 'Admin_domestic_booking/invoice_edit/$1/$2';
$route['admin/edit-domestic-invoice/(:num)']   = 'Admin_domestic_booking/save_edit/$1';
$route['admin/delete-domestic-invoice/(:num)'] = 'Admin_domestic_booking/invoice_delete/$1';
$route['admin/delete-domestic-invoice-detail/(:num)'] = 'Admin_domestic_booking/invoice_detail_delete/$1';

$route['admin/list-domestic-finalInvoice'] 				 = 'Admin_domestic_booking/finalInvoice';
$route['admin/show-edit-final-domestic-invoice/(:num)/(:num)'] = 'Admin_domestic_booking/final_invoice_edit/$1/$2';
$route['admin/invoice-domestic-view/(:num)/(:num)'] 			 = 'Admin_domestic_booking/invoice_view/$1/$2';
$route['admin/edit-final-domestic-invoice/(:num)/(:num)'] = 'Admin_domestic_booking/save_edit/$1/$2';
$route['admin/domestic_excel/(:num)/(:num)'] 			 = 'Admin_domestic_booking/domestic_excel/$1/$2';

$route['admin/list-domestic-payments'] 				= 'Admin_domestic_booking/payments';
$route['admin/save-domestic-payments'] 				= 'Admin_domestic_booking/save_payment';
$route['admin/list-domestic-payment_history'] 		= 'Admin_domestic_booking/payment_history';

$route['admin/send-domestic-invoice-mail/(:num)/(:num)'] 	= 'Admin_domestic_booking/send_mail/$1/$2';
//==========================
$route['admin/list-labelprint'] 			= 'Admin_labelprint/index';
$route['admin/mics_printlabel/(:any)'] 		= 'Admin_labelprint/mics_printlabel/$1';
$route['admin/forwarder_printlabel/(:any)'] = 'Admin_labelprint/forwarder_printlabel/$1';

$route['admin/list-domestic-labelprint'] 			= 'Admin_domestic_labelprint/index';
$route['admin/domestic_printlabel/(:any)'] 			= 'Admin_domestic_labelprint/domestic_printlabel/$1';

$route['admin/list-cnodemaster'] 			= 'Admin_cnodemaster/index';
$route['admin/add-cnodemaster'] 			= 'Admin_cnodemaster/add_cnode';
//$route['admin/delete-cnodemaster/(:num)'] 	= 'Admin_cnodemaster/delete_cnode/$1';

$route['admin/list-cnode'] 					= 'Admin_cnode/index';
$route['admin/add-cnode'] 					= 'Admin_cnode/add_cnode';
$route['admin/delete-cnode/(:num)'] 		= 'Admin_cnode/delete_cnode/$1';

$route['admin/change-pincode-city'] 	= 'Admin_change_pincode/edit_pincode_city';
$route['admin/list-region'] 			= 'Admin_region/index';
$route['admin/add-region'] 				= 'Admin_region/add_region';
$route['admin/edit-region/(:num)'] 		= 'Admin_region/update_region/$1';
$route['admin/delete-region/(:num)'] 	= 'Admin_region/delete_region/$1';

$route['admin/list-country'] 			= 'Admin_country/index';
$route['admin/add-country'] 			= 'Admin_country/add_country';
$route['admin/edit-country/(:num)'] 	= 'Admin_country/update_country/$1';
$route['admin/delete-country/(:num)'] 	= 'Admin_country/delete_country/$1';

$route['admin/list-state'] 				= 'Admin_state/index';
$route['admin/add-state'] 				= 'Admin_state/add_state';
$route['admin/edit-state/(:num)'] 		= 'Admin_state/update_state/$1';
$route['admin/delete-state/(:num)'] 	= 'Admin_state/delete_state/$1';

$route['admin/list-city'] 				= 'Admin_city/index';
$route['admin/add-city'] 				= 'Admin_city/add_city';
$route['admin/edit-city/(:num)'] 		= 'Admin_city/update_city/$1';
$route['admin/delete-city/(:num)'] 		= 'Admin_city/delete_city/$1';

//======== 9-3-2021=======

$route['admin/list-homeslider'] 		= 'Admin_homeslider/index';
$route['admin/add-homeslider'] 			= 'Admin_homeslider/add_homeslider';
$route['admin/edit-homeslider/(:num)'] 	= 'Admin_homeslider/update_homeslider/$1';
$route['admin/delete-homeslider/(:num)'] = 'Admin_homeslider/delete_homeslider/$1';

$route['admin/list-news'] 				= 'Admin_news/index';
$route['admin/add-news'] 				= 'Admin_news/add_news';
$route['admin/edit-news/(:num)'] 		= 'Admin_news/update_news/$1';
$route['admin/delete-news/(:num)'] 		= 'Admin_news/delete_news/$1';

$route['admin/list-testimonial'] 		= 'Admin_testimonial/index';
$route['admin/add-testimonial'] 		= 'Admin_testimonial/add_testimonial';
$route['admin/edit-testimonial/(:num)'] = 'Admin_testimonial/update_testimonial/$1';
$route['admin/delete-testimonial/(:num)'] = 'Admin_testimonial/delete_testimonial/$1';

$route['admin/list-contact'] 			= 'Admin_contact/index';

$route['admin/list-request-quote'] 		= 'Admin_contact/request_quote';

$route['admin/list-delivered_ship'] 	= 'Admin_generatepod/delivered';

//===========menifiest
$route['admin/list-international-menifiest'] 		  = 'Admin_international_menifiest/index';
$route['admin/list-international-tracking-manifiest'] = 'Admin_international_menifiest/menifiest';
$route['admin/menifiest-international-add'] 	      = 'Admin_international_menifiest/add_menifiest';
$route['admin/insert-international-menifiest'] 		  = 'Admin_international_menifiest/insert_menifiest';
$route['admin/edit-international-menifiest/(:num)']   = 'Admin_international_menifiest/editmenifiest/$1';
$route['admin/update-international-menifiest'] 		  = 'Admin_international_menifiest/updatemenifiest';

$route['admin/tracking-international-menifiest'] = 'Admin_tracking/international_menifiest';
$route['admin/tracking-international-menifiest/(:any)'] = 'Admin_tracking/international_menifiest/$1';
$route['admin/download-international-tracking-menifiest/(:any)']  = 'Admin_tracking/download_international_menifiest/$1';

$route['admin/tracking-domestic-menifiest'] 		  		 = 'Admin_tracking/domestic_menifiest';
$route['admin/tracking-domestic-menifiest/(:any)'] 		  		 = 'Admin_tracking/domestic_menifiest/$1';
$route['admin/download-domestic-tracking-menifiest/(:any)']  = 'Admin_tracking/download_domestic_menifiest/$1';

$route['admin/list-domestic-menifiest'] = 'Admin_domestic_menifiest/index';
$route['admin/list-tracking-manifiest'] = 'Admin_domestic_menifiest/menifiest';
$route['admin/menifiest-add'] 			= 'Admin_domestic_menifiest/add_menifiest';
$route['admin/insert-menifiest'] 		= 'Admin_domestic_menifiest/insert_menifiest';
$route['admin/edit-menifiest/(:num)'] 	= 'Admin_domestic_menifiest/editmenifiest/$1';
$route['admin/update-menifiest'] 		= 'Admin_domestic_menifiest/updatemenifiest';

$route['admin/list-domestic-bag'] 		= 'Admin_domestic_bag/index';
$route['admin/list-tracking-bag'] 		= 'Admin_domestic_bag/bag';
$route['admin/bag-add'] 				= 'Admin_domestic_bag/add_bag';
$route['admin/insert-bag'] 				= 'Admin_domestic_bag/insert_bag';
$route['admin/edit-bag/(:num)'] 		= 'Admin_domestic_bag/editbag/$1';
$route['admin/update-bag'] 				= 'Admin_domestic_bag/updatebag';

$route['admin/tracking-domestic-bag'] 		  		 	= 'Admin_domestic_bag/domestic_bag';
$route['admin/tracking-domestic-bag/(:any)'] 		  	= 'Admin_domestic_bag/domestic_bag/$1';
$route['admin/download-domestic-tracking-bag/(:any)']  	= 'Admin_domestic_bag/download_domestic_bag/$1';

$route['admin/view-internal-status'] = 'Admin_domestic_menifiest/view_manifest_delivery_status2';

$route['admin/list-deilverysheet'] 		= 'Admin_deliverysheet/index';
$route['admin/add-deliverysheet'] 		= 'Admin_deliverysheet/adddelivery';
$route['admin/insert-deliverysheet'] 	= 'Admin_deliverysheet/insert_deliverysheet';
$route['admin/print-deliverysheet/(:any)'] 		= 'Admin_deliverysheet/deliverysheet/$1';
$route['admin/printdeliverysheet/(:any)'] 		= 'Admin_deliverysheet/print_deliverysheet/$1';
$route['admin/deliverysheet-detail/(:any)'] 	= 'Admin_deliverysheet/deliverysheet_detail/$1';


$route['admin/view-outgoing'] 			= 'Admin_outgoing/index';
$route['admin/add-outgoing'] 			= 'Admin_outgoing/add_outgoing';
$route['admin/insert-outgoing'] 		= 'Admin_outgoing/insert_outgoing';
$route['admin/editoutgoing/(:any)'] 	= 'Admin_outgoing/editoutgoing/$1';
$route['admin/updateoutgoing/(:num)'] 	= 'Admin_outgoing/updateoutgoing/$1';
$route['admin/deleteoutgoing/(:any)'] 	= 'Admin_outgoing/deleteoutgoing/$1';


$route['admin/view-incoming'] 			= 'Admin_incoming/index';
$route['admin/add-incoming'] 			= 'Admin_incoming/addincoming';
$route['admin/add-incoming/(:any)'] 	= 'Admin_incoming/addincoming/$1';
$route['admin/upload-pod'] 				= 'Admin_pod/index';
$route['admin/add-pod'] 				= 'Admin_pod/addpod';
$route['admin/insert-pod'] 				= 'Admin_pod/insertpod';

$route['admin/add-bulk-pod'] 			= 'Admin_pod/view_bulkpod';
$route['admin/insert-bulk-pod'] 		= 'Admin_pod/insert_bulkupload';

$route['admin/change-shipment-status'] 			= 'Admin_tracking/changeshipmentstatus';
$route['admin/change-bulk-shipment-status'] 	= 'Admin_tracking/changebulkstatus';

$route['admin/view-delivered'] 					= 'Admin_shipment_manager/view_delivered';

$route['admin/view-airlines'] 								= 'Admin_airlines_manager/all_airlines';
$route['admin/add-addairlines']								= 'Admin_airlines_manager/addairlines';
$route['admin/insertairlines']								= 'Admin_airlines_manager/insertairlines';
$route['admin/edit-airlines/(:num)']						= 'Admin_airlines_manager/editairlines/$1';
$route['admin/updateairlines/(:num)']						= 'Admin_airlines_manager/updateairlines/$1';
$route['admin/delete-airlines/(:num)']						= 'Admin_airlines_manager/deleteairlines/$1';

// complain managment 
$route['admin/view-complain'] 								= 'Admin_complain/complain_view';
$route['admin/ticket-detail/(:num)'] 						= 'Admin_complain/ticket_detail/$1';
$route['admin/insert-replay/(:num)'] 						= 'Admin_complain/insert_replay/$1';
$route['admin/ticket-close/(:num)'] 						= 'Admin_complain/ticket_close/$1';


//admin/airlines-charges
$route['admin/view-airport'] 								= 'Admin_airlines_manager/all_airport';
$route['admin/add-airport']									= 'Admin_airlines_manager/addairport';
$route['admin/insertairport']								= 'Admin_airlines_manager/insertairport';
$route['admin/editairport/(:num)']							= 'Admin_airlines_manager/editairport/$1';
$route['admin/updateairport/(:num)']						= 'Admin_airlines_manager/updateairport/$1';
$route['admin/deleteairport/(:num)']						= 'Admin_airlines_manager/deleteairport/$1';

$route['admin/view-airlines-flight']	 					= 'Admin_airlines_manager/airlines_Flight';
$route['admin/addairlinesflight']							= 'Admin_airlines_manager/addairlinesFlight';
$route['admin/insertairlinesFlight']						= 'Admin_airlines_manager/insertairlinesFlight';
$route['admin/editflight/(:num)']							= 'Admin_airlines_manager/editFlight/$1';
$route['admin/updateairlinesFlight/(:num)']					= 'Admin_airlines_manager/updateairlinesFlight/$1';
$route['admin/deleteflight/(:num)']							= 'Admin_airlines_manager/deleteFlight/$1';

$route['admin/view-airlines-flight-type'] 					= 'Admin_airlines_manager/airlines_flight_type';
$route['admin/addairlinesflighttype']						= 'Admin_airlines_manager/addairlinesflighttype';
$route['admin/insertairlinesFlighttype']					= 'Admin_airlines_manager/insertairlinesFlighttype';
$route['admin/editflighttype/(:num)']						= 'Admin_airlines_manager/editFlighttype/$1';
$route['admin/updateairlinesFlighttype/(:num)']				= 'Admin_airlines_manager/updateairlinesFlighttype/$1';
$route['admin/deleteflighttype/(:num)']						= 'Admin_airlines_manager/deleteFlighttype/$1';

$route['admin/airlines-charges/(:num)'] 					= 'Admin_airlines_manager/airlinescharges/$1';
$route['admin/addairlinescharges/(:num)'] 					= 'Admin_airlines_manager/addairlinescharges/$1';
$route['admin/insertairlinescharges'] 						= 'Admin_airlines_manager/insertairlinescharges';
$route['admin/editairlinescharges/(:num)'] 					= 'Admin_airlines_manager/editairlinescharges/$1';
$route['admin/deleteairlinescharges/(:num)/(:num)'] 		= 'Admin_airlines_manager/deleteairlinescharges/$1/$2';

$route['admin/list-vendor'] 				= 'Admin_vendor/index';
$route['admin/add-vendor'] 					= 'Admin_vendor/add_vendor';
$route['admin/edit-vendor/(:num)']	 		= 'Admin_vendor/edit_vendor/$1';
$route['admin/delete-vendor/(:num)'] 		= 'Admin_vendor/delete_vendor/$1';

$route['admin/list-driver'] 				= 'Admin_driver/index';
$route['admin/add-driver'] 					= 'Admin_driver/add_driver';
$route['admin/edit-driver/(:num)']	 		= 'Admin_driver/edit_driver/$1';
$route['admin/delete-driver/(:num)'] 		= 'Admin_driver/delete_driver/$1';

$route['admin/list-vehicle'] 				= 'Admin_vehicle/index';
$route['admin/add-vehicle'] 				= 'Admin_vehicle/add_vehicle';
$route['admin/edit-vehicle/(:num)']	 		= 'Admin_vehicle/edit_vehicle/$1';
$route['admin/delete-vehicle/(:num)'] 		= 'Admin_vehicle/delete_vehicle/$1';

$route['admin/view-branch'] 								= 'Admin_Branch_manager/view_branch';
$route['admin/add-branch'] 									= 'Admin_Branch_manager/addbranch';
$route['admin/insertbranch'] 								= 'Admin_Branch_manager/insertbranch';
$route['admin/edit-branch/(:num)']							= 'Admin_Branch_manager/editbranch/$1';
$route['admin/updatebranch/(:num)']							= 'Admin_Branch_manager/updatebranch/$1';
$route['admin/delete-branch/(:num)']						= 'Admin_Branch_manager/deletebranch/$1';

$route['admin/view-shipment'] 								= 'Admin_shipment_manager/view_shipment';
$route['admin/add-shipment'] 								= 'Admin_shipment_manager/add_shipment';
$route['admin/insertshipment'] 								= 'Admin_shipment_manager/insert_shipment';
$route['admin/edit-shipment/(:num)']						= 'Admin_shipment_manager/edit_shipment/$1';
$route['admin/update-shipment/(:num)']						= 'Admin_shipment_manager/update_shipment/$1';
$route['admin/delete-shipment/(:num)']						= 'Admin_shipment_manager/delete_shipment/$1';
$route['admin/printpod/(:num)']				    			= 'Admin_shipment_manager/print_label/$1';

$route['admin/view-international-shipment']				= 'Admin_international_shipment_manager/view_international_shipment';
$route['admin/view-international-shipment/(:num)']		= 'Admin_international_shipment_manager/view_international_shipment/$1';
$route['admin/view-international-unbill-shipment']		= 'Admin_international_shipment_manager/view_international_unbill_shipment';
$route['admin/view-international-pending-forworder']	= 'Admin_international_shipment_manager/view_pending_international_forworder';
$route['admin/view-add-international-shipment'] 		= 'Admin_international_shipment_manager/add_international_shipment';
$route['admin/add-international-shipment'] 				= 'Admin_international_shipment_manager/insert_internatioanl_shipment';
$route['admin/delete-international-shipment/(:num)']	= 'Admin_international_shipment_manager/delete_international_shipment/$1';
$route['admin/international_printpod/(:num)']			= 'Admin_international_shipment_manager/print_label/$1';

$route['admin/view_edit_international_shipment/(:num)']= 'Admin_international_shipment_manager/edit_international_shipment/$1';



$route['admin/view_international_frieght_list']= 'Admin_international_shipment_manager/view_international_frieght_list';
$route['admin/view_international_frieght_invoice']= 'Admin_international_shipment_manager/international_frieght_invoice';
$route['admin/insert-international-freight_invoice']= 'Admin_international_shipment_manager/insert_international_frieght_invoice';
$route['admin/view_edit_international_frieght_invoice/(:num)']= 'Admin_international_shipment_manager/edit_international_frieght_invoice/$1';
$route['admin/update_international_frieght_invoice']= 'Admin_international_shipment_manager/update_international_frieght_invoice';

$route['admin/international-freight_invoice/(:num)']= 'Admin_international_shipment_manager/show_international_frieght_invoice/$1';

$route['admin/edit-international-shipment/(:num)']= 'Admin_international_shipment_manager/update_international_shipment/$1';

$route['admin/view-domestic-shipment']				= 'Admin_domestic_shipment_manager/view_domestic_shipment';
$route['admin/view-domestic-shipment/(:num)']		= 'Admin_domestic_shipment_manager/view_domestic_shipment/$1';
$route['admin/view-domestic-unbill-shipment']		= 'Admin_domestic_shipment_manager/view_domestic_unbill_shipment';
$route['admin/view-domestic-pending-forworder']		= 'Admin_domestic_shipment_manager/view_pending_domestic_forworder';
$route['admin/view-add-domestic-shipment']  		= 'Admin_domestic_shipment_manager/add_domestic_shipment';
$route['admin/add-domestic-shipment'] 	   			= 'Admin_domestic_shipment_manager/insert_domestic_shipment';
$route['admin/delete-domestic-shipment/(:num)']		= 'Admin_domestic_shipment_manager/delete_domestic_shipment/$1';
$route['admin/domestic_printpod/(:num)']			= 'Admin_domestic_shipment_manager/print_label/$1';
$route['admin/view-edit-domestic-shipment/(:num)']  = 'Admin_domestic_shipment_manager/edit_domestic_shipment/$1';
$route['admin/edit-domestic-shipment/(:num)']		= 'Admin_domestic_shipment_manager/update_domestic_shipment/$1';


$route['admin/view-upload-domestic-shipment'] = 'Admin_domestic_shipment_manager/view_upload_domestic_shipment';
$route['admin/upload-domestic-shipment'] = 'Admin_domestic_shipment_manager/upload_domestic_shipment';


//$route['admin/ajax-country-search/(:any)']	= 'Admin_domestic_shipment_manager/ajax_country_search/$1';

$route['admin/list-mis-report'] 		 = 'Admin_report/mis_report';
$route['admin/list-mis-report/(:num)'] 		 = 'Admin_report/mis_report/$1';
$route['admin/list-mis-report/(:num)/(:any)'] 		 = 'Admin_report/mis_report/$1/$2';


$route['admin/list-DSR'] 				 = 'Admin_report/daily_sales_report';
$route['admin/list-international-gst-report'] = 'Admin_report/international_gst_report';
$route['admin/list-domestic-gst-report'] 	  = 'Admin_report/domestic_gst_report';
$route['admin/list-international-shipment-report']  = 'Admin_report/international_shipment_report';
$route['admin/list-domestic-shipment-report'] 		= 'Admin_report/domestic_shipment_report';

$route['admin/mis_report'] 				 = 'Admin_report/excel';
$route['admin/list-outstanding-report']  = 'Admin_report/outstanding_report';


$route['admin/upload-shipment']								= 'Admin_shipment_manager/bulk_upload';
$route['admin/unverified-shipment']							= 'Admin_shipment_manager/unverified_shipment';
$route['admin/verified-shipment']							= 'Admin_shipment_manager/verified_shipment';

$route['admin/addairlinescharges/(:num)'] 					= 'Admin_airlines_manager/addairlinescharges/$1';
$route['admin/insertairlinescharges'] 						= 'Admin_airlines_manager/insertairlinescharges';
$route['admin/editairlinescharges/(:num)'] 					= 'Admin_airlines_manager/editairlinescharges/$1';
$route['admin/deleteairlinescharges/(:num)/(:num)'] 		= 'Admin_airlines_manager/deleteairlinescharges/$1/$2';

//==================

$route['admin/view-courier-master'] 			= 'Admin_courier_manager/all_courier';
$route['admin/add-courier-master'] 				= 'Admin_courier_manager/add_courier';
$route['admin/insert_courier'] 					= 'Admin_courier_manager/insert_courier';
$route['admin/view-edit-courier-master/(:num)'] = 'Admin_courier_manager/edit_courier_company/$1';
$route['admin/edit-courier-master/(:num)'] 	 	= 'Admin_courier_manager/update_courier_company/$1';
$route['admin/delete-courier-master/(:num)'] 	= 'Admin_courier_manager/delete_courier_company/$1';


//$route['admin/view-international-courier_list']= 'Admin_international_zone_manager/all_courier';

//$route['admin/view-international-zone'] 	= 'Admin_international_zone_manager/all_zone';
$route['admin/view-international-zone/(:num)/(:any)/(:any)'] = 'Admin_international_zone_manager/all_zone/$1/$2/$3';
$route['admin/view-add-zone'] 					= 'Admin_international_zone_manager/add_zone';
$route['admin/insert_zone'] 					= 'Admin_international_zone_manager/insert_zone';
$route['admin/view-edit-zone/(:num)'] 			= 'Admin_international_zone_manager/edit_zone/$1';
$route['admin/edit-zone/(:num)'] 	 			= 'Admin_international_zone_manager/update_zone/$1';
$route['admin/delete-zone/(:num)'] 				= 'Admin_international_zone_manager/delete_zone/$1';

$route['admin/view-domestic-zone'] 				= 'Admin_domestic_zone_manager/all_zone';
$route['admin/view-domestic-add-zone'] 			= 'Admin_domestic_zone_manager/add_zone';
$route['admin/insert-domestic_zone'] 			= 'Admin_domestic_zone_manager/insert_zone';
$route['admin/view-domestic-edit-zone/(:num)'] 	= 'Admin_domestic_zone_manager/edit_zone/$1';
$route['admin/edit-domestic-zone/(:num)'] 	 	= 'Admin_domestic_zone_manager/update_zone/$1';
$route['admin/delete-domestic-zone/(:num)'] 	= 'Admin_domestic_zone_manager/delete_zone/$1';

$route['admin/all-fuel'] 				= 'Admin_fuel/all_fuel';
$route['admin/view-add-fuel'] 			= 'Admin_fuel/addfuel';
$route['admin/insert_fuel'] 			= 'Admin_fuel/insertfuel';
$route['admin/view-edit-fuel/(:num)'] 	= 'Admin_fuel/editfuel/$1';
$route['admin/edit-fuel/(:num)'] 	 	= 'Admin_fuel/updatefuel/$1';
$route['admin/delete-fuel/(:num)'] 		= 'Admin_fuel/deletefuel/$1';

$route['admin/all-coloader'] 				= 'Admin_coloader/all_coloader';
$route['admin/view-add-coloader'] 			= 'Admin_coloader/add_coloader';
$route['admin/insert_coloader'] 			= 'Admin_coloader/insert_coloader';
$route['admin/view-edit-coloader/(:num)'] 	= 'Admin_coloader/edit_coloader/$1';
$route['admin/edit-coloader/(:num)'] 	 	= 'Admin_coloader/update_coloader/$1';
$route['admin/delete-coloader/(:num)'] 		= 'Admin_coloader/delete_coloader/$1';

$route['admin/view-mode'] 				= 'Admin_mode_manager/all_mode';
$route['admin/view-add-mode'] 			= 'Admin_mode_manager/add_mode';
$route['admin/insert_mode'] 			= 'Admin_mode_manager/insert_mode';
$route['admin/view-edit-mode/(:num)'] 	= 'Admin_mode_manager/edit_mode/$1';
$route['admin/edit-mode/(:num)'] 	 	= 'Admin_mode_manager/update_mode/$1';
$route['admin/delete-mode/(:num)'] 		= 'Admin_mode_manager/delete_mode/$1';

$route['admin/view-courier-fixed-price/(:num)'] 	 = 'Admin_courier_manager/all_courier_fixed_price/$1';
$route['admin/view_add_courier_fixed_price/(:num)']  = 'Admin_courier_manager/view_add_courier_fixed_price/$1';
$route['admin/insert-courier-fixed-charge'] 		 = 'Admin_courier_manager/insert_courier_fixed_charge';
$route['admin/view-edit-courier-fixed-price/(:num)'] = 'Admin_courier_manager/view_edit_courier_fixed_price/$1';
$route['admin/edit-courier-fixed-charge/(:num)'] 	 = 'Admin_courier_manager/update_courier_fixed_price/$1';
$route['admin/delete-courier-fixed-charge/(:num)']   = 'Admin_courier_manager/delete_courier_fixed_charge/$1';

$route['admin/view-domestic-customer'] 		   			= 'Admin_domestic_rate_manager/view_domestic_customer';

$route['admin/view-domestic-rate/(:num)/(:num)/(:any)'] = 'Admin_domestic_rate_manager/view_domestic_rate/$1/$2/$3';
$route['admin/view-add-domestic-rate']  			    = 'Admin_domestic_rate_manager/add_domestic_rate';
$route['admin/signed-quotation-upload/(:num)/(:num)/(:any)'] 	    = 'Admin_signed_quotation_upload/view_signed_quatation/$1/$2/$3';
$route['admin/view-add-signed-quatation/(:num)/(:num)/(:any)'] 	    = 'Admin_signed_quotation_upload/view_add_signed_quatation/$1/$2/$3';
$route['admin/add-signed-quatation'] 							    = 'Admin_signed_quotation_upload/insert_signed_quatation';
$route['admin/delete-signed-quotation/(:num)']					    = 'Admin_signed_quotation_upload/delete_signed_quatation/$1';
$route['admin/edit-signed-quotation/(:num)']					    = 'Admin_signed_quotation_upload/edit_signed_quatation/$1';
$route['admin/update-signed-quatation/(:num)']							    = 'Admin_signed_quotation_upload/update_signed_quatation/$1';

$route['admin/insert-domestic-rate'] 		  			 = 'Admin_domestic_rate_manager/insert_domestic_rate';
$route['admin/view-edit-domestic-rate/(:num)/(:num)']  = 'Admin_domestic_rate_manager/view_edit_domestic_rate/$1/$2';
$route['admin/edit-domestic-rate/(:num)/(:num)'] 	   = 'Admin_domestic_rate_manager/update_domestic_rate/$1/$2';
$route['admin/delete-domestic-rate/(:num)/(:num)/(:any)']    = 'Admin_domestic_rate_manager/delete_domestic_rate/$1/$2/$3';

$route['admin/view-domestic-state-rate/(:num)'] 		= 'Admin_domestic_rate_manager/view_domestic_state_rate/$1';
$route['admin/insert-domestic-state-rate'] 				= 'Admin_domestic_rate_manager/insert_domestic_state_rate';
$route['admin/insert-domestic-city-rate'] 				= 'Admin_domestic_rate_manager/insert_domestic_city_rate';

$route['admin/view-international-rate-upload/(:num)/(:num)'] = 'Admin_international_rate_manager/view_rate_upload/$1/$2';
$route['admin/view-international-customer']     			= 'Admin_international_rate_manager/view_international_customer';
$route['admin/show_international_courier']     				= 'Admin_international_rate_manager/show_international_courier';
$route['admin/view-uploded-international-rate/(:num)/(:num)/(:any)'] = 'Admin_international_rate_manager/view_uploded_rate_data/$1/$2/$3';
$route['admin/delete-international-rate/(:num)/(:num)']   	= 'Admin_international_rate_manager/delete_international_rate/$1/$2';


$route['admin/insert-transfer-rate']     	  = 'Admin_international_rate_manager/insert_transfer_rate';
$route['admin/insert-domestic-transfer-rate'] = 'Admin_domestic_rate_manager/insert_transfer_rate';



$route['admin/upload-rate'] = 'Admin_international_rate_manager/upload_rate';
$route['admin/view-delivered-status'] 			= 'Admin_domestic_menifiest/delivered_status';
$route['admin/view-delivery-status'] 			= 'Admin_domestic_menifiest/view_delivery_status';
$route['admin/change-delivery-status'] 			= 'Admin_domestic_menifiest/change_delivery_status';
$route['admin/manage-tracking-status'] 			= 'Admin_domestic_menifiest/manage_tracking_status';
$route['admin/delete-tracking-status'] 			= 'Admin_domestic_menifiest/delete_tracking_status';
$route['admin/edit-tracking-status/(:num)'] 	= 'Admin_domestic_menifiest/edit_tracking_status/$1';
$route['admin/update-tracking-status'] 			= 'Admin_domestic_menifiest/update_tracking_status';


$route['admin/access-control/(:num)'] 	= 'Admin_access_control/view_access_control/$1';
$route['admin/delete-access-block/(:num)/(:num)'] 	= 'Admin_access_control/delete_access_block/$1/$2';


// Route Planners

// Route Planners

$route['admin/all-route'] 						= 'Admin_route_planner/all_route'; //Route list
$route['admin/add-route'] 						= 'Admin_route_planner/add_route'; //add route
$route['admin/edit-route/(:num)'] 		        = 'Admin_route_planner/update_route/$1';
$route['admin/delete-route/(:num)'] 	        = 'Admin_route_planner/delete_route/$1';

$route['admin/petty-report/(:num)'] 			= 'Admin_route_planner/petty_report/$1'; //find route

$route['admin/collection'] 						= 'Admin_route_planner/todaycoll';  //today collection list

$route['admin/petty-cash'] 						= 'Admin_route_planner/pettycash';   //pettycash list
$route['admin/generate-petty-cash/(:num)']      = 'Admin_route_planner/generte_pettycash/$1'; 
$route['admin/pay-amount/(:num)']   		    = 'Admin_route_planner/pay_amount/$1'; 
$route['admin/received-domestic-payment'] 	    = 'Admin_route_planner/received_domestic_payment'; 
$route['admin/received-petty-cash'] 		    = 'Admin_route_planner/recived_petty_cash'; 
$route['admin/due-report']						= 'Admin_route_planner/duereport';   // Due Report Superadmin



// ******************************* Add Franchise **********************************


$route['admin/franchise-list']				            = 'FranchiseController/index';   
$route['admin/franchise-topup-balance']				    = 'FranchiseController/franchise_topup_balance'; 
$route['admin/view-franchise-topup-data']				= 'FranchiseController/view_franchise_topup_data';
$route['admin/update-franchise-topup/(:num)']		    = 'FranchiseController/update_franchise_topup/$1';
$route['admin/filter-franchise-topup']		            = 'FranchiseController/filter_franchise_topup';

$route['admin/add-franchise']				            = 'FranchiseController/add_franchise';    
//$route['admin/update-franchise/(:num)/(:num)']	= 'FranchiseController/update_franchise_data/$1/$2';   
$route['admin/update-franchise/(:num)/(:num)/(:num)']	= 'FranchiseController/update_franchise_data/$1/$2/$3';   
 //$route['admin/update-franchise/(:num)']		    = 'FranchiseController/update_franchise_data/$1';   


// ******************************* Add Master Franchise **********************************

$route['admin/franchise-master']	= 'MasterFranchiseController/add_master_franchise';  
$route['admin/view-franchise-master']	= 'MasterFranchiseController/index';  
$route['admin/update-master-franchise/(:num)/(:num)']	 = 'MasterFranchiseController/update_master_franchise_data/$1/$2';

 //vehicle_type
 
 $route['admin/add-vehicle-type'] = 'Admin_vehicle_Type/add_vehicle_type';
 $route['admin/view-vehicle-type'] = 'Admin_vehicle_Type/index';
 $route['admin/edit-vehicle-type/(:num)'] = 'Admin_vehicle_Type/edit_vehicle_type/$1';
 $route['admin/delete-vehicle-type/(:num)'] = 'Admin_vehicle_Type/delete_vehicle_type/$1';
 
//  vehicle vendor
 $route['admin/add-vehicle-vendor'] = 'Admin_vehicle_vendor/add_vehicle_vendor';
 $route['admin/edit-vehicle-vendor/(:num)'] = 'Admin_vehicle_vendor/edit_vehicle_vendor/$1';
 $route['admin/view-vehicle-vendor'] = 'Admin_vehicle_vendor/index';
 
//  bank master 
 $route['admin/add-bank'] = 'Admin_bank/add_bank';
 $route['admin/view-bank'] = 'Admin_bank/index';
 $route['admin/edit-bank/(:num)'] = 'Admin_bank/edit_bank/$1';
 $route['admin/delete-bank/(:num)'] = 'Admin_bank/delete_bank';
//  Role master 
 $route['admin/add-role'] = 'Admin_role_master/add_role';
//  $route['admin/view-bank'] = 'Admin_bank/index';
//  $route['admin/edit-bank/(:num)'] = 'Admin_bank/edit_bank/$1';
//  $route['admin/delete-bank/(:num)'] = 'Admin_bank/delete_bank';
######################### Admin ROUTE END ############################

// add by pritesh 
$route['admin/download_pod/(:num)']				    = 'Downloadpod/download_pod/$1';
//************************************* FTL Master *******************************************

$route['admin/add-lr']	                 = 'FTLController/index'; 


$route['admin/add-lr-data']	             = 'FTLController/insert_lr_details';   
$route['admin/FTL-List']	             = 'FTLController/view_ftl_list';   
$route['admin/lr-printlabel/(:num)']	 = 'FTLController/view_lr_printlabel/$1';   

// add by in-scan 
$route['admin/inscan']	 = 'Admin_Inscan/in_scan';   
// add mis rute
$route['admin/mis-rute']	 = 'Admin_mis_rute/mis_rute';   

// Bag Master 
$route['admin/bag-master']	 = 'Admin_bagmaster/index'; 
$route['admin/addbag']	 = 'Admin_bagmaster/add_bag'; 
$route['admin/deletebag']	 = 'Admin_bagmaster/delete_bag'; 


$route['admin/list-incoming-bag'] 			= 'Admin_bag_incoming/incomingbag';
$route['admin/add-incoming-bag'] 			= 'Admin_bag_incoming/addincomingbag';
$route['admin/add-incoming-bag/(:any)'] 	= 'Admin_bag_incoming/addincomingbag/$1';

// Bag Genrate
$route['admin/bag-genrate']	 = 'Admin_bag_genrate/index'; 
$route['admin/view-genrated-bag']	 = 'Admin_bag_genrate/bag_genrated'; 
$route['admin/add-bag']	 = 'Admin_bag_genrate/genrate_bag'; 
$route['admin/add-bag-genrate']	 = 'Admin_bag_genrated/add_bag';
$route['admin/view-bag-genrated']	 = 'Admin_bag_genrated/index'; 

// Gatepass 

$route['admin/gatepass']	 = 'Admin_gatepass/index'; 
$route['admin/add-gatepass']	 = 'Admin_gatepass/genrate_gatepass'; 
$route['admin/view-genrated-gatepass']	 = 'Admin_gatepass/gatepass_genrated'; 

// Gatepass In- Scan
$route['admin/gatepass-in-scan']	 = 'Admin_gatepass_in_scan/index'; 
$route['admin/view-genrated-in-scan']	 = 'Admin_gatepass_in_scan/gatepass_in_scan_genrated';
$route['admin/add-gatepass-in-scan']	 = 'Admin_gatepass_in_scan/gatepass_genrated_in_scan';


$route['admin/pickup-in-scan']	 = 'Admin_Inscan/pickup_in_scan_status_insert';
$route['admin/branch-in-scan']	 = 'Admin_Inscan/brnach_in_scan_insert';

// Update Delivery Sheet 
$route['admin/single-delivery-update'] 	= 'Admin_delivery_update/index';
$route['admin/single-delivery-insert'] 	= 'Admin_delivery_update/single_delivery_status';

// update drs 
$route['admin/update-drs'] 		= 'Admin_deliverysheet/update_drs';
$route['admin/out-for-delivery'] 		= 'Admin_pending_menifest/pending_for_delivery';
// pending pod 
$route['admin/pending-pod'] 				= 'Admin_pod/pending_pod';
// Other Branch Out Scan
$route['admin/pending-menifest'] 				= 'Admin_pending_menifest/index';
// Pending For Delivery
$route['admin/pending-delivery'] 				= 'Admin_pending_menifest/pending_for_delivery';
//  Franchise rate group master
$route['admin/rate-group-master'] = 'Admin_rate_group_master/index';
$route['admin/franchise-rate-master'] = 'Admin_rate_group_master/add_franchise_rate';
$route['admin/franchise-rate-insert'] = 'Admin_rate_group_master/insert_franchise_rate';
$route['admin/edit-franchise-rate-master/(:num)'] = 'Admin_rate_group_master/edit_franchise_rate/$1';
$route['admin/view-franchise-rate/(:num)'] = 'Admin_rate_group_master/view_franchise_rate/$1';
$route['admin/edit-franchise-rate/(:num)']  = 'Admin_rate_group_master/edit_franchise_rate/$1';

//  Franchise fule group master
$route['admin/fule-group-master']               = 'Admin_franchise_fuel/index';
$route['admin/all-franchise-fuel'] 				= 'Admin_franchise_fuel/all_fuel';
$route['admin/view-franchise-add-fuel'] 			= 'Admin_franchise_fuel/addfuel';
$route['admin/franchise-insert_fuel'] 			= 'Admin_franchise_fuel/insertfuel';
$route['admin/view-franchise-edit-fuel/(:num)'] 	= 'Admin_franchise_fuel/editfuel/$1';
$route['admin/edit-franchise-fuel/(:num)'] 	 	= 'Admin_franchise_fuel/updatefuel/$1';
$route['admin/delete-franchise-fuel/(:num)'] 		= 'Admin_franchise_fuel/deletefuel/$1';

// Franchise Delivery Rate Master

$route['admin/delivery-group-master']                   = 'Admin_franchise_delivery_rate/delivery_group_master';
$route['admin/franchise-delivery-ratemaster'] 			= 'Admin_franchise_delivery_rate/add_delivery_rate';
$route['admin/view-franchise-delivery-ratemaster'] 		= 'Admin_franchise_delivery_rate/index';

//********************************** franchise balance sheet*************************** */

$route['admin/franchise_credit_list'] = 'Franchisebalance/credit_list';
$route['admin/franchise_debit_list'] = 'Franchisebalance/debit_list';
$route['admin/franchise_balance_list'] = 'Franchisebalance/balance_list';

//*******************************/ FTL Process /*******************************************8 */


$route['admin/ftl-customer-rate-master'] = 'Admin_TraficManager/ftl_customer_rate_master';
$route['admin/ftl-customer-rate-list'] = 'Admin_TraficManager/ftl_customer_rate_list';


$route['vendor'] = 'vendor/Login_controller/login';
// $route['vendor'] = 'vendor/Login_controller/index';
$route['update-driver-data/(:any)'] = 'vendor/Vendor_controller/update_driver_details/$1';
$route['user-profile'] = 'vendor/Login_controller/vendor_user_profile';
$route['dashboard'] = 'vendor/Vendor_controller/dashboard';
$route['posted-list'] = 'vendor/Vendor_controller/truck_posted_list';
$route['vendor-login'] = 'vendor/Login_controller/login';
$route['add-vendor'] = 'vendor/Login_controller/register';
$route['truck-post'] = 'vendor/Vendor_controller/truck_post';
$route['vendor-logout'] = 'vendor/Vendor_controller/logout';
$route['truck-order/(:num)'] = 'vendor/Vendor_controller/ftl_request_for_vendor/$1';
$route['vendor-request-for-truck'] = 'vendor/Vendor_controller/vendor_request_for_truck';
$route['vendor/quotation-request-list'] = 'vendor/Vendor_controller/truck_request_list_from_vendor';
$route['vendor/approve-quotation-request-list'] = 'vendor/Vendor_controller/approve_quotation_request_list';
$route['vendor/quotation-request-list/(:num)'] = 'vendor/Vendor_controller/truck_request_list_from_vendor/$1';
$route['upload-pod/(:any)'] = 'vendor/Vendor_controller/after_reach_vehicle_uploadPod/$1';
$route['calculate-freight'] = 'vendor/Vendor_controller/calculate_freight';


######################### Sales ROUTE START ############################


$route['logout'] 					         = 'Admin_sales/logout';
$route['sales'] 					         = 'Admin_sales/login_sales';
$route['store_sales_data'] 					         = 'Admin_sales/index';
$route['sales/ftl-request-data-list/(:num)'] 	= 'Admin_sales/ftl_request/$1';
$route['sales/ftl-request-data-list'] 	= 'Admin_sales/ftl_request';
// $route['admin/dashboard'] 				= 'Admin_manager/view_dashboard';


############################### USER ###########################

$route['users/ftl-list/(:num)'] 	= 'User_panel/show_ftl_request/$1';
$route['users/ftl-list'] 	= 'User_panel/show_ftl_request';
$route['users/ewaybill-list'] 	= 'User_panel/view_ewaybill_list';
$route['users/ewaybill-list/(:num)'] 	= 'User_panel/view_ewaybill_list/$1';



  // ************************** Trafic Manager ********************************

  $route['admin/quation-requested-list'] = 'Admin_TraficManager/quotation_requested_list';
  $route['admin/quation-requested-list/(:num)'] = 'Admin_TraficManager/quotation_requested_list/$1';
  $route['admin/quation-approve-list'] = 'Admin_TraficManager/approve_quotation_requested_list';
  $route['admin/quation-approve-list/(:num)'] = 'Admin_TraficManager/approve_quotation_requested_list/$1';
  $route['admin/ftl-documents-list'] = 'Admin_TraficManager/view_ewaybill_list';
  $route['admin/ftl-documents-list/(:num)'] = 'Admin_TraficManager/view_ewaybill_list/$1';
  $route['admin/quation-cancel-list'] = 'Admin_TraficManager/cancel_quotation_requested_list';
  $route['admin/quation-cancel-list/(:num)'] = 'Admin_TraficManager/cancel_quotation_requested_list/$1';
  $route['admin/pickup-request-list'] = 'Admin_TraficManager/pickup_request_list';
  $route['admin/pickup-request-list/(:num)'] = 'Admin_TraficManager/pickup_request_list/$1';
  $route['admin/upload-trip-documents'] = 'Admin_TraficManager/upload_trip_documents';
  $route['admin/upload-trip-documents/(:any)'] = 'Admin_TraficManager/upload_trip_documents/$1';
  $route['admin/upload-trip-documents-list'] = 'Admin_TraficManager/upload_trip_documents_list';
  $route['admin/upload-trip-documents-list/(:num)'] = 'Admin_TraficManager/upload_trip_documents_list/$1';
  $route['admin/update_upload_trip_documents/(:any)'] = 'Admin_TraficManager/update_upload_trip_documents/$1';
  $route['admin/ftl-pod-list'] = 'Admin_TraficManager/ftl_pod_list';
  $route['admin/ftl-pod-list/(:any)'] = 'Admin_TraficManager/ftl_pod_list/$1';
  $route['admin/upload-pod/(:any)'] = 'Admin_TraficManager/after_reach_vehicle_uploadPod_by_admin/$1';

  // **************************************** FTL Account ************************************

  $route['admin/pending-payment-approval'] = 'Admin_TraficManager/pending_payment_approve';
  $route['admin/pending-payment-approval/(:num)'] = 'Admin_TraficManager/pending_payment_approve/$1';
  $route['admin/pending-transfer-payment'] = 'Admin_TraficManager/pending_transfer_payment';
  $route['admin/ftl-payment'] = 'Admin_TraficManager/ftl_payment';
  $route['admin/ftl-payment/(:num)'] = 'Admin_TraficManager/ftl_payment/$1';

  $route['admin/upload-pod'] = 'Admin_TraficManager/upload-pod';
  $route['admin/upload-pod/(:num)'] = 'Admin_TraficManager/upload_pod_vendor/$1';

  
  
  //  SNEHAL WORK
$route['accountant-login'] 		 = 'Accounts/Login';
$route['validateLogin'] 		 = 'Accounts/Login/validateLogin';
// -------------- Accounts/Master Controller --------------
$route['accounts-vendor'] 		 = 'Accounts/Master/vendors';
$route['accounts-vendor/(:num)'] = 'Accounts/Master/vendors/$1';
$route['single-vendor/(:num)'] = 'Accounts/Master/vendor_details/$1';


$route['accounts-customer'] = 'Accounts/Master/customers';
$route['accounts-customer/(:num)'] = 'Accounts/Master/customers/$1';

$route['tds-sections'] 			 = 'Accounts/Master/tds_sections';
$route['submitSection'] 		 = 'Accounts/Master/submitSection';
$route['submitSection/(:num)'] 		 = 'Accounts/Master/submitSection/$1';
$route['getSectionRowData/(:num)'] 	 = 'Accounts/Master/getSectionRowData/$1';

$route['getSectionRecords'] 			 = 'Accounts/Master/getSectionRecords';
$route['tds-percent'] 			 = 'Accounts/Master/tds_percent';
$route['submitTds'] 		 = 'Accounts/Master/submitTds';
$route['submitTds/(:num)'] 		 = 'Accounts/Master/submitTds/$1';
$route['getTdsRowData/(:num)'] 			 = 'Accounts/Master/getTdsRowData/$1';

$route['gst'] 			 = 'Accounts/Master/gst_master';
$route['getStateRecords'] 			 = 'Accounts/Master/getStateRecords';
$route['getGstRowData/(:num)'] 		 = 'Accounts/Master/getGstRowData/$1';
$route['submitGst'] 		 = 'Accounts/Master/submitGst';
$route['submitGst/(:num)'] 		 = 'Accounts/Master/submitGst/$1';

$route['group_master'] 		 = 'Accounts/Master/group_master';
$route['getGroupNature'] 		 = 'Accounts/Master/getGroupNature';
$route['getExpGroupRowData/(:num)'] 		 = 'Accounts/Master/getExpGroupRowData/$1';
$route['submitExpGroup'] 		 = 'Accounts/Master/submitExpGroup';
$route['submitExpGroup/(:num)'] 		 = 'Accounts/Master/submitExpGroup/$1';

$route['expense_subgrp_master'] 		 = 'Accounts/Master/expense_subgrp_master';
$route['getExpSubGroupRowData/(:num)'] 		 = 'Accounts/Master/getExpSubGroupRowData/$1';
$route['getExpGroupData'] 		 = 'Accounts/Master/getExpGroupData';
$route['submitExpSubGroup'] 		 = 'Accounts/Master/submitExpSubGroup';
$route['submitExpSubGroup/(:num)'] 		 = 'Accounts/Master/submitExpSubGroup/$1';

$route['transaction_nature_master'] 		 = 'Accounts/Master/transaction_nature_master';
$route['submitNatureTrans'] 		 = 'Accounts/Master/submitNatureTrans';
$route['submitNatureTrans/(:num)'] 		 = 'Accounts/Master/submitNatureTrans/$1';
$route['getNatureTransRowData/(:num)'] 		 = 'Accounts/Master/getNatureTransRowData/$1';

$route['getVendorRecords/(:num)'] = 'Accounts/Master/getVendorRecords/$1';
$route['get_naturewise_group/(:num)'] = 'Accounts/Master/get_naturewise_group/$1';
$route['getTransNature/(:any)'] = 'Accounts/Ledger/getTransNature/$1';

$route['payment_trans_master'] = 'Accounts/Master/payment_trans_master';
$route['submitPaymentTrans'] = 'Accounts/Master/submitPaymentTrans';
$route['submitPaymentTrans/(:num)'] = 'Accounts/Master/submitPaymentTrans/$1';
$route['getPaymentTransRowData/(:num)'] = 'Accounts/Master/getPaymentTransRowData/$1';

// -------------- Accounts/Ledger Controller --------------
$route['create-ledger'] = 'Accounts/Ledger/create_ledger';
$route['create-vendorledger'] = 'Accounts/Ledger/create_vendorledger';
$route['submitLedgerGst'] = 'Accounts/Ledger/submitLedgerGst';
$route['submitLedger'] = 'Accounts/Ledger/submitLedger';

$route['ledger-list'] = 'Accounts/Ledger/all_ledger_details';
$route['create-sale-ledger'] = 'Accounts/Ledger/create_sale_ledger';
$route['create-purchase-ledger'] = 'Accounts/Ledger/create_purchase_ledger';
$route['view_ledger_voucher/(:num)'] = 'Accounts/Ledger/view_ledger_voucher/$1';

$route['getCities_statewise'] = 'Accounts/Master/getCities_statewise';
$route['update_vendor_records/(:num)'] = 'Accounts/Master/update_vendor_records/$1';

// -------------- Accounts/Voucher Controller -------------- 
$route['create-voucher'] = 'Accounts/Voucher/createnew_voucher';
$route['insert_voucher'] = 'Accounts/Voucher/insert_voucher';
$route['voucher-list'] = 'Accounts/Voucher/voucher_list';
$route['voucher_details/(:num)'] = 'Accounts/Voucher/voucher_details/$1';
$route['voucher_print/(:num)'] = 'Accounts/Voucher/voucher_print/$1';


// -------------- Courier Service Controller -------------- 
$route['courier-service-ptl'] = 'Accounts/Courier_service/ptl_courier_service';
$route['courier-service-ptl-view/(:num)'] = 'Accounts/Courier_service/ptl_courier_service_invoice_view/$1';

$route['courier-service-ftl'] = 'Accounts/Courier_service/ftl_courier_service';
$route['courier-service-ftl-view/(:num)'] = 'Accounts/Courier_service/ftl_courier_service_invoice_view/$1';

// ---------------- Unbill Shipments ------------------------------
$route['unbill-shipments'] 		 = 'Accounts/Master/view_unbilled_shipments';
$route['unbill-shipments/(:num)'] = 'Accounts/Master/view_unbilled_shipments/$1';

//  Pincode Services 
$route['admin/view-pincode-service'] = 'Admin_pincode_service/index';
$route['admin/view-pincode-service/(:num)'] = 'Admin_pincode_service/index/$1';
$route['admin/add-pincode-service'] = 'Admin_pincode_service/add_pincode';
$route['admin/pincode-service-status'] = 'Admin_pincode_service/pincode_service_status';
$route['admin/update-pincode-service/(:num)'] = 'Admin_pincode_service/update_pincode/$1';
$route['admin/edit-pincode-service/(:num)'] = 'Admin_pincode_service/edit_pincode/$1';


// inddent genration 
$route['admin/view-ftl-request']	     = 'AdminFTL_indent/index';   
$route['admin/view-ftl-request/(:any)']	     = 'AdminFTL_indent/index/$1';   
$route['admin/add-ftl-request']	     = 'AdminFTL_indent/add_ftl_request';   
$route['admin/update_ftl_request/(:num)']	  = 'AdminFTL_indent/update_ftl_request/$1';   

$route['admin/ftl-vendor-list'] = 'Admin_vendore_registration/index';
$route['admin/ftl-vendor-list/(:num)'] = 'Admin_vendore_registration/index/$1';
$route['admin/vendor-service/(:num)'] = 'Admin_vendore_registration/view_service/$1';
$route['admin/edit-vendor/(:num)'] = 'Admin_vendore_registration/edit_vendor/$1';
$route['admin/add-ftl-vendor'] = 'Admin_vendore_registration/add_ftl_vendor';
