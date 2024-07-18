/* Document.ready Start */	
jQuery(document).ready(function() {
	
	$("#volumetric_table").hide(); 	
	
	var length_detail = $("#length_detail").val();	
	if(length_detail != '')
	{
		$("#volumetric_table").show(); 	
	}
	
	
	var courier_company_name = $("#courier_company option:selected").attr('data-id');
		$('#forworder_name').val(courier_company_name);
		
	$("#courier_company").change(function () {
		var courier_company_name = $("#courier_company option:selected").attr('data-id');
		$('#forworder_name').val(courier_company_name);
	});
	
	$("#dispatch_details").change(function (){
			var dispatch_details =$("#dispatch_details").val();
			//alert(dispatch_details);
			if(dispatch_details=="Credit")
			{
				$("#credit_div").show();
				$("#credit_div_label").show();
				$("#payby").hide();
				$("#Refno").hide();
					
				$("#sub_total").attr("readonly", true);
				$("#grand_total").attr("readonly", true);
				
				
				
			}
			else if(dispatch_details=="Cash")
			{
				//$("#credit_div").hide();
				//$("#credit_div_label").hide();	
				
				$("#credit_div").show();
				$("#credit_div_label").show();
				
				$("#payby").show();
				$("#Refno").show();
				
				$("#sender_name").attr("readonly", false); 
				$("#sender_address").attr("readonly", false); 
				$("#sender_city").attr("readonly", false); 
				$("#sender_pincode").attr("readonly", false);
				$("#sender_contactno").attr("readonly", false);
				$("#sender_gstno").attr("readonly", false);
				$("#sub_total").attr("readonly", false);
				$("#grand_total").attr("readonly", false);
				
			}
			if(dispatch_details=="Credit")
			{
				
				var user_type = $("#usertype").val();
				if(user_type != 1 )
				{
					$('#frieht').hide();
					$('#transportation_charges').hide();
					$('#pickup_charges').hide();
					$('#delivery_charges').hide();
					$('#courier_charges').hide();
					$('#insurance_charges').hide();
					$('#other_charges').hide();
					$('#amount').hide();
					$('#fuel_charges').hide();
					$('#sub_total').hide();
					$('#cgst').hide();
					$('#sgst').hide();
					$('#igst').hide();
					$('#awb_charges').hide();
					$('#fov_charges').hide();
					$('#grand_total').hide();
					$('#cft').hide();
				}
			}
			else
			{
				$('#frieht').show();
				$('#transportation_charges').show();
				$('#pickup_charges').show();
				$('#delivery_charges').show();
				$('#courier_charges').show();
				$('#insurance_charges').show();
				$('#other_charges').show();
				$('#amount').show();
				$('#fuel_charges').show();
				$('#sub_total').show();
				$('#cgst').show();
				$('#sgst').show();
				$('#igst').show();
				$('#awb_charges').show();
				$('#fov_charges').show();
				$('#grand_total').show();
				$('#cft').show();
			}

			if(dispatch_details!="Cash")
			{
				
				calculate_cft();			
					
			}
				
	});
	
	// getting customer info 
	$("#customer_account_id").change(function () 
	{
		var customer_name = $(this).val();
		if (customer_name != null || customer_name != '') 
		{
			$.ajax({
				type: 'POST',
				dataType: "json",
				url: 'Admin_domestic_shipment_manager/getsenderdetails',
				data: 'customer_name=' + customer_name,
				success: function (data) 
				{
					$("#sender_name").val(data.user.customer_name);
					$("#sender_address").val(data.user.address);
					$("#sender_pincode").val(data.user.pincode);
					$("#sender_contactno").val(data.user.phone);
					$("#sender_gstno").val(data.user.gstno);
					$("#gst_charges").val(data.user.gst_charges);
					// $("#sender_city").val(data.user.city);
					// $("#sender_state").val(data.user.state);					
					$("#customer_account_id").val(customer_name);

					 var option;					
					 option += '<option value="' + data.user.city_id + '">' + data.user.city_name + '</option>';
					$('#sender_city').html(option);

					 var option1;					
					 option1 += '<option value="' + data.user.state_id + '">' + data.user.state_name + '</option>';
					$('#sender_state').html(option1);
					var dispatch_details =$("#dispatch_details").val();
					if(dispatch_details!="Cash")
					{
						
						calculate_cft();			
							
					}
					document.getElementById("reciever").focus();								
				}
			});
		}
	});
	
	////Consignee   Pincode
	$("#sender_pincode").on('blur', function () 
	{
		var pincode = $(this).val();
		if (pincode != null || pincode != '') {
		
			
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {					
					$('#sender_city').html(data.option);					
				}
			});
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getState',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) 
				{					
					$('#sender_state').html(data);					
				}
			});
		}
	});	
	
	//Consignee  Pincode
	$("#reciever_pincode").on('blur', function () 
	{
		var pincode = $(this).val();
		if (pincode != null || pincode != '') 
		{
			
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {	
				
					$('#reciever_city').html(data.option);		
					$('#forworder_name').html(data.forwarder2);				
				}
			});
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getState',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) 
				{					
					$('#reciever_state').html(data);

				}
			});
		}
	});	
	
	//Consignee  Zone
	$("#reciever_state, #reciever_city").blur(function () 
	{
		var reciever_state =$("#reciever_state").val();
		var reciever_city =$("#reciever_city").val();
		$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/getZone',			
				data:{reciever_state:reciever_state,reciever_city:reciever_city},
				dataType: "json",
				success: function (d) 
				{	
					$("#receiver_zone_id").val(d.region_id);						
					$("#receiver_zone").val(d.region_name);			
				}
			});
			
	});
	
	// this function is use for getting charges acording chargeble weight input field 
	$(".chargable_weight,#valumetric_chageable").blur(function () 
	{
		if ($('#is_appointment').is(':checked')) 
		{
			var is_appointment   = 1;
		}
		else{
			var is_appointment   = 0;
		}
		var customer_id   = $('#customer_account_id').val();
		var c_courier_id  = $('#courier_company').val();
		var mode_id   = $('#mode_dispatch').val();
		var sender_state  = $("#sender_state").val();		
		var sender_city  = $("#sender_city").val();		
		var state  = $("#reciever_state").val();		
		var city  = $("#reciever_city").val();		
		var doc_type = $("#doc_typee").val();
		var receiver_zone_id = $("#receiver_zone_id").val();
		var receiver_gstno = $("#receiver_gstno").val();
		var booking_date =$('#booking_date').val();
		var dispatch_details =$('#dispatch_details').val();
		var invoice_value 	 = parseFloat(($('#invoice_value').val() != '') ? $('#invoice_value').val() : 0);
		
		var chargable_weight = parseFloat($('#chargable_weight').val()) > 0 ? $('#chargable_weight').val() : 0;
		
		if(customer_id != '' && mode_id != '')
		{
			$.ajax({
				type: 'POST',
				url: 'Admin_domestic_shipment_manager/add_new_rate_domestic',
				data: 'customer_id=' + customer_id  +'&c_courier_id=' + c_courier_id+'&mode_id=' + mode_id+'&state=' + state +'&city=' + city +'&chargable_weight='+chargable_weight+'&receiver_zone_id='+receiver_zone_id+'&receiver_gstno='+receiver_gstno+'&booking_date='+booking_date+'&invoice_value='+invoice_value+'&dispatch_details='+dispatch_details+'&sender_state='+sender_state+'&sender_city='+sender_city+'&is_appointment='+is_appointment,

				dataType: "json",
				success: function (data) {	
					console.log("final_rate====="+data.query);
					console.log("====="+data.frieht);
					$('#frieht').val(data.frieht);
					$('#transportation_charges').val(0);
					$('#pickup_charges').val(0);
					$('#delivery_charges').val(0);
					$('#insurance_charges').val(0);
					$('#courier_charges').val(data.cod);
					$('#other_charges').val(data.to_pay_charges);
					$('#amount').val(data.amount);
					$('#fuel_charges').val(data.final_fuel_charges);
					$('#sub_total').val(data.sub_total);
					$('#cgst').val(data.cgst);
					$('#sgst').val(data.sgst);
					$('#igst').val(data.igst);
					$('#awb_charges').val(data.docket_charge);
					$('#fov_charges').val(data.fov);
					$('#appt_charges').val(data.appt_charges);
					$('#grand_total').val(data.grand_total);
					$('#cft').val(data.cft);
					$('#delivery_date').val(data.tat_date);
					// alert(data.grand_total);
				}
			});
		}
		else
		{
			$('#frieht').val();
		}
	});
	
	$("#frieht,#transportation_charges,#pickup_charges,#delivery_charges,#courier_charges,#awb_charges,#other_charges,#insurance_charges,#green_tax,#appt_charges,#fuel_charges,#fov_charges").change(function () {
			var type_of_doc = $('#type_of_doc').val();
			var sender_gstno = $('#sender_gstno').val();
			var frieht = parseFloat(($('#frieht').val() != '') ? $('#frieht').val() : 0);
			var transportation_charges = parseFloat(($('#transportation_charges').val() != '') ? $('#transportation_charges').val() : 0);
			var pickup_charges 	 = parseFloat(($('#pickup_charges').val() != '') ? $('#pickup_charges').val() : 0);
			var delivery_charges = parseFloat(($('#delivery_charges').val() != '') ? $('#delivery_charges').val() : 0);
			var courier_charges  = parseFloat(($('#courier_charges').val() != '') ? $('#courier_charges').val() : 0);
			var awb_charges		 = parseFloat(($('#awb_charges').val() != '') ? $('#awb_charges').val() : 0);
			var other_charges 	 = parseFloat(($('#other_charges').val() != '') ? $('#other_charges').val() : 0);
			var fov_charges 	 = parseFloat(($('#fov_charges').val() != '') ? $('#fov_charges').val() : 0);
			var insurance_charges 	 = parseFloat(($('#insurance_charges').val() != '') ? $('#insurance_charges').val() : 0);
			var green_tax 	 = parseFloat(($('#green_tax').val() != '') ? $('#green_tax').val() : 0);
			var appt_charges 	 = parseFloat(($('#appt_charges').val() != '') ? $('#appt_charges').val() : 0);
			var fuel_charges 	 = parseFloat(($('#fuel_charges').val() != '') ? $('#fuel_charges').val() : 0);
            // alert(fov_charges);
			var totalAmount = (
				frieht + transportation_charges + pickup_charges + delivery_charges + courier_charges +awb_charges + other_charges + fov_charges + insurance_charges + green_tax + appt_charges 
				);
				//alert(fov_charges);
			$('#amount').val(totalAmount);
		 	var courier_id = parseFloat(($('#courier_company').val() != '') ? $('#courier_company').val() : 0);
		 	var booking_date =$('#booking_date').val();
			var customer_id   = $('#customer_account_id').val();
			var dispatch_details =$('#dispatch_details').val();

			if (dispatch_details=='Cash') {
				sub_total = totalAmount + fuel_charges;
				$('#sub_total').val(sub_total);
				var sender_state = $('#sender_state').val();
				var reciever_state = $('#reciever_state').val();
				
				$.ajax({
					type: 'POST',
					url: 'Admin_domestic_shipment_manager/cashGstCalc',
					data: {
						totalAmount : sub_total,
						customer_id : customer_id,
						type_of_doc : type_of_doc,
						sender_gstno : sender_gstno,
					},
					dataType: "json",
					success: function(data) {					
						console.log(data);
						$('#cgst').val(data.cgst);
		            	$('#sgst').val(data.sgst);
						$('#igst').val(data.igst);
						$('#grand_total').val(data.grand_total);	
						
					}
				});
			}else{
				$('#cgst').attr('readonly',true);
				$('#sgst').attr('readonly',true);
				$('#igst').attr('readonly',true);
				$.ajax({
					type: 'POST',
					url: 'Admin_domestic_shipment_manager/getFuelcharges',
					data: 'courier_id='+courier_id +'&sub_amount='+totalAmount+'&booking_date='+booking_date+'&customer_id='+customer_id+'&dispatch_details='+dispatch_details,
					dataType: "json",
					success: function(data) {					
						// $('#fuel_charges').val(data.final_fuel_charges);
						if (dispatch_details=='Cash') {
							$('#sub_total').val(totalAmount);
						}else{
							$('#sub_total').val(data.sub_total);
							$('#cgst').val(cgst);
			            	$('#sgst').val(sgst);
							$('#igst').val(data.igst);
							$('#grand_total').val(data.grand_total);	
						}
					}
				});
			}
		});

	
	// chkceing duplicate number
	$("#awn").blur(function () {
        var pod_no = $(this).val();
        if (pod_no != null || pod_no != '') {
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: 'Admin_domestic_shipment_manager/check_duplicate_awb_no',
                data: 'pod_no=' + pod_no,
                success: function (data) {
                    if(data.msg!=""){       
                    		 $('#awn').focus();
                    		 $('#awn').val("");
                    		 alert(data.msg);
                    }else{
                    }
                    
                }
            });
        }
    });
	
	// doc type change 
	$("#doc_typee").change(function ()
	{
			var shipment =$("#doc_typee").val();
			if(shipment==1)
			{
				$('#div_inv_row').show();

				$(".length_td").show();
                $(".height_td").show();
                $(".breath_td").show();
                $(".volumetic_weight_td").show();
                $(".cft_th").show();                                                    
                $(".volumetric_weight_th").show();
                $(".length_th").show();
                $(".breath_th").show();
                $(".height_th").show();
			}else{
				$('#div_inv_row').hide();
				$('#invoice_no').val("");
				$('#invoice_value').val("");
				$('#eway_no').val("");

				$(".length_td").hide();
                $(".height_td").hide();
                $(".breath_td").hide();
                $(".volumetic_weight_td").hide();
                $(".cft_th").hide();                                                    
                $(".volumetric_weight_th").hide();
                $(".length_th").hide();
                $(".breath_th").hide();
                $(".height_th").hide();  
			}
	});
	
	$("#reciever").blur(function () 
	{
        var reciever = $(this).val();
		$('#contactperson_name').val(reciever);
        
    });
	
	// /this is use for getting receiver city info by pincode
	$("#no_of_pack1").on('change', function () 
	{
		if ($('#is_volumetric').is(':checked')) 
		{
			var  no_of_pack1 =  $("#no_of_pack1").val(); 
			$("#volumetric_table").show(); 
			
			
			 var totalRow = $('#volumetric_table_row').find('tr').length;
			console.log(totalRow);
			if (totalRow > 1) 
			{
				for (var jk = 1; jk < totalRow; jk++) 
				{
					console.log(jk);
					$('#volumetric_table_row').find('tr:last').remove();
					//totalRow--;
				} 
			} 
			
			//$('table.weight-table tbody').find('tr').remove();
			for (var i = 2; i <= no_of_pack1; i++) 
			{
				var allTrs = $('table.weight-table tbody').find('tr');
				var lastTr = allTrs[allTrs.length - 1];
				var $clone = $(lastTr).clone();

				var countrows = $(".height").length;
				$clone.find('td').each(function () 
				{
					var el = $(this).find(':first-child');
					var id = el.attr('id') || null;
					if (id) 
					{
						var i = id.substr(id.length - 1);

						var nextElament = countrows; //parseInt(i)+1;
						var remove = 1;
						if (countrows > 10) 
						{
							var remove = 2;
						}
						var removeChar = (id.length - remove);
						var prefix = id.substr(0, removeChar);

						
						//console.log('prefix:::' + prefix + '::::' + id + '::::' + removeChar);
						el.attr('id', prefix + (nextElament));
						el.attr('data-attr', (nextElament));
						el.attr('id', prefix + (nextElament));
						el.attr('data-attr', (nextElament));
						el.attr('required','required');
					}
				});
				$clone.find('input:text').val('');
				$('table.weight-table tbody').append($clone);
				var totalRow = $('table.weight-table tbody').find('tr').length;
				
				if (totalRow > 1) 
				{
					$('.remove-weight-row').show();			
				} else {
					$('.remove-weight-row').hide();
				}
			}
		
		}
	});
	
	// /this is use for getting receiver city info by pincode
	$("#is_volumetric").on('change', function () 
	{
		if ($(this).is(':checked')) 
		{
			var  no_of_pack1 =  $("#no_of_pack1").val(); 
			$("#volumetric_table").show(); 
			
			//$('table.weight-table tbody').find('tr').remove();
			for (var i = 2; i <= no_of_pack1; i++) 
			{
				var allTrs = $('table.weight-table tbody').find('tr');
				var lastTr = allTrs[allTrs.length - 1];
				var $clone = $(lastTr).clone();

				var countrows = $(".height").length;
				$clone.find('td').each(function () 
				{
					var el = $(this).find(':first-child');
					var id = el.attr('id') || null;
					if (id) 
					{
						var i = id.substr(id.length - 1);

						var nextElament = countrows; //parseInt(i)+1;
						var remove = 1;
						if (countrows > 10) 
						{
							var remove = 2;
						}
						var removeChar = (id.length - remove);
						var prefix = id.substr(0, removeChar);

						
						//console.log('prefix:::' + prefix + '::::' + id + '::::' + removeChar);
						el.attr('id', prefix + (nextElament));
						el.attr('data-attr', (nextElament));
					}
				});
				$clone.find('input:text').val('');
				$('table.weight-table tbody').append($clone);
				var totalRow = $('table.weight-table tbody').find('tr').length;
				
				if (totalRow > 1) 
				{
					$('.remove-weight-row').show();			
				} else {
					$('.remove-weight-row').hide();
				}
			}
		}
		else
		{
			$("#volumetric_table").hide(); 
		}
		
	
	});	
	
	$(document).on("blur",'.valumetric_actual', function(){

		var idNo = $(this).attr('data-attr');
		var id = $(this).attr('id');
		var val = $(this).val();

		if (!val) {
			val = 0;
		}

		val = parseFloat(val);

		valumetric_weight = parseFloat($("#valumetric_weight" + idNo).val());

		if (valumetric_weight > val) {
			$('#valumetric_chageable'+idNo).val(valumetric_weight);
		}else{
			$('#valumetric_chageable'+idNo).val(val);
		}

	});
	$(document).on("blur",'.no_of_pack, .per_box_weight, .actual_weight, .length, .breath, .height', function()
	{
		var idNo = $(this).attr('data-attr');
		var id = $(this).attr('id');

		if(id=='per_box_weight'+idNo){

			var table2 = $(this).closest('table');
			var rowCount2 = $('#volumetric_table #volumetric_table_row tr').length;
			val = parseInt($('#'+id).val());
			tot = parseInt($('#no_of_pack1').val());
			// +"  -- row "+idNo

			var sum = 0;

			for (let i = idNo; i > 0; i--) {
			  sum =  sum + parseInt($('#per_box_weight'+i).val());
			}

			if (sum >= tot) {
				dd = sum - tot;
				if (val > dd) {$(this).val(val-dd);}
				if (dd > val) {$(this).val(dd-val);}

				var rm_tr = tot - idNo;
				if (rm_tr) {
					for (let i = 0; i < rm_tr; i++) {
					  $(this).closest('tr').next().remove();
					}
					
				}
				
			}else{
				var table = $(this).closest('table');
				var rowCount = $('#volumetric_table #volumetric_table_row tr').length;

				
				if (tot > rowCount) {

					dd1 =  tot - sum;
					if (rowCount) {
					for (let i = 1; i <= rowCount; i++) {
							d3 = $('#per_box_weight'+i).val();
							if (!d3 || d3=='' || d3=='0') {
								$('#per_box_weight'+i).closest('tr').remove();
							}
							
						}
						
					}
					
					for (let i = 0; i < dd1; i++) {
						var allTrs = $('table.weight-table tbody').find('tr');
						var lastTr = allTrs[allTrs.length - 1];
						var $clone = $(lastTr).clone();

						var countrows = $(".height").length;
						$clone.find('td').each(function () 
						{
							var el = $(this).find(':first-child');
							var id = el.attr('id') || null;
							if (id) 
							{
								var i = id.substr(id.length - 1);

								var nextElament = countrows; //parseInt(i)+1;
								var remove = 1;
								if (countrows > 10) 
								{
									var remove = 2;
								}
								var removeChar = (id.length - remove);
								var prefix = id.substr(0, removeChar);
								el.attr('id', prefix + (nextElament));
								el.attr('data-attr', (nextElament));
								el.attr('required','required');
							}
						});

						$clone.find('input:text').val('');
						$('table.weight-table tbody').append($clone);
						
					}			
				}
		
			}
		}

		$('#per_box_weight'+(idNo+1)).trigger('blur');

	
		calculateTotalWeight();
	});
	
	function calculateTotalWeight() 
	{
		var totalRow = $('table.weight-table tbody').find('tr').length;	
		var totalActualWeight = 0;
		var totalValumetricWeight = 0;
		var totalLength = 0;
		var totalBreath = 0;
		var totalHeight = 0;
		var totalOneCftKg = 0;
		var totalNoOfPack = 0;
		var totalPerBoxWeight = 0;
		var valumetric_chageable = 0;
		var valumetric_actual = 0;
	
		var mode_dispatch = $('#mode_dispatch').val();
		var currentActualWeight = $('#actual_weight').val();
		
	
		for (var i = 1; i <= totalRow; i++) 
		{
			
			if (currentActualWeight > 0) 
			{    
				
				currentActualWeight = Math.round(currentActualWeight);
				// currentActualWeight = Math.ceil(currentActualWeight);
				$("#chargable_weight").val(currentActualWeight);
			}
			
			var perBoxWeightCurrent = $('#per_box_weight' + i).val();
			var length = $("#length" + i).val();
			var breath = $("#breath" + i).val();
			var height = $("#height" + i).val();
			
			if (length != '' && breath != '' && height != '' ) 
			{		
		
				if(mode_dispatch != 1)
				{
					cft = $('#cft').val();
					if (cft==0 || cft=='0') {cft=7}
					valumetric_weight = (((length * breath * height) / 27000)  * cft) * perBoxWeightCurrent ;	
				}
				else
				{
					air_cft = $('#air_cft').val();
					if (air_cft==0 || air_cft=='0') {air_cft=5000}
					valumetric_weight = ((length * breath * height) / air_cft) * perBoxWeightCurrent;	
				}
				
				total_valumetric_weight = valumetric_weight.toFixed(2);
				$("#valumetric_weight" + i).val(total_valumetric_weight);

				dd = $("#valumetric_actual" + i).val();

				if (!dd) {
					$("#valumetric_actual" + i).val(total_valumetric_weight);
				}
				
					
			}
			else 
			{
					$("#valumetric_weight" + i).val(0);
			}
			

			
			totalValumetricWeight = parseFloat(totalValumetricWeight) + parseFloat(($('#valumetric_weight' + i).val() != '') ? $('#valumetric_weight' + i).val() : 0);
			totalPerBoxWeight = parseFloat(totalPerBoxWeight) + parseFloat(($('#per_box_weight' + i).val() != '') ? $('#per_box_weight' + i).val() : 0);
			totalLength = parseFloat(totalLength) + parseFloat(($('#length' + i).val() != '') ? $('#length' + i).val() : 0);
			totalBreath = parseFloat(totalBreath) + parseFloat(($('#breath' + i).val() != '') ? $('#breath' + i).val() : 0);
			totalHeight = parseFloat(totalHeight) + parseFloat(($('#height' + i).val() != '') ? $('#height' + i).val() : 0);
			valumetric_chageable = parseFloat(valumetric_chageable) + parseFloat(($('#valumetric_chageable' + i).val() != '') ? $('#valumetric_chageable' + i).val() : 0);
			valumetric_actual = parseFloat(valumetric_actual) + parseFloat(($('#valumetric_actual' + i).val() != '') ? $('#valumetric_actual' + i).val() : 0);
		}
		
		var totalActualWeight = $('#actual_weight').val();
		
		if (totalValumetricWeight) 
		{
			var roundoff_type = $("#roundoff_type").val();
			// $('#valumetric_weight').val(totalValumetricWeight); ttttttt
			if (roundoff_type == '1') 
			{
				$('#valumetric_weight').val(totalValumetricWeight);
			}
			else 
			{
				$('#valumetric_weight').val(totalValumetricWeight);
			}
		}
		
	
		if(valumetric_chageable > totalActualWeight)
		{
			valumetric_chageable = Math.ceil(valumetric_chageable);
			$("#chargable_weight").val(valumetric_chageable);
		}
		else
		{
			totalActualWeight = Math.round(totalActualWeight);
			$("#chargable_weight").val(totalActualWeight);
		}
		
		if (totalNoOfPack) {
			$('#no_of_pack').val(totalNoOfPack);
		}
		if (totalPerBoxWeight) {
			$('#per_box_weight').val(totalPerBoxWeight);
		}
		if (totalActualWeight) {
			$('#actual_weight').val(totalActualWeight);
		}
		if (totalValumetricWeight) 
		{
			var roundoff_type = $("#roundoff_type").val();
			if (roundoff_type == '1') 
			{
				$('#valumetric_weight').val(totalValumetricWeight.toFixed(2));
			}
			else 
			{
				$('#valumetric_weight').val(totalValumetricWeight.toFixed(2));
			}
		}
		$('#length').val(totalLength.toFixed(2));
		$('#breath').val(totalBreath.toFixed(2));	
		$('#height').val(totalHeight.toFixed(2));
		$('#valumetric_weight').val(totalValumetricWeight.toFixed(2));
		$('#valumetric_chageable').val(valumetric_chageable.toFixed(2));
		$('#valumetric_actual').val(valumetric_actual.toFixed(2));
	}

	$("#customer_account_id").select2();
	$("#sender_state").select2();
	$("#sender_city").select2();
	$("#awn").focus();
	
	$("#invoice_value").blur(function () 
	{
		var invoice_bavalue = $(this).val();
		if(invoice_bavalue > 50000)
		{
			$('#eway_no').prop('required',true);
		}
		else
		{
			$('#eway_no').prop('required',false);
		}
	});	
	
	// for edit section
	var shipment =$("#doc_typee").val();
	if(shipment==1)
	{
		$('#div_inv_row').show();
		$(".length_td").show();
        $(".height_td").show();
        $(".breath_td").show();
        $(".volumetic_weight_td").show();
        $(".cft_th").show();                                                    
        $(".volumetric_weight_th").show();
        $(".length_th").show();
        $(".breath_th").show();
        $(".height_th").show();        
	}else{
		$('#div_inv_row').hide();
		$('#invoice_no').val("");
		$('#invoice_value').val("");
		$('#eway_no').val("");
		$(".length_td").hide();
        $(".height_td").hide();
        $(".breath_td").hide();
        $(".volumetic_weight_td").hide();
        $(".cft_th").hide();                                                    
        $(".volumetric_weight_th").hide();
        $(".length_th").hide();
        $(".breath_th").hide();
        $(".height_th").hide();               
	}
  
});


function calculate_cft(){
		var courier_id = parseFloat(($('#courier_company').val() != '') ? $('#courier_company').val() : 0);
		var booking_date =$('#booking_date').val();
		var customer_account_id =$('#customer_account_id').val();


		if (!customer_account_id) {
			$('#cft').val(7);
		}else{
			$.ajax({
					type: 'POST',
					url: 'Admin_international_shipment_manager/available_cft',
			    	data: 'courier_id='+courier_id+'&booking_date='+booking_date+'&customer_id='+customer_account_id,
					dataType: "json",
					success: function(data) {
						// alert(data.cft_charges);	
					    // if(data.cft_charges=="0")
					    // {
							
					    // }else{
					    	$('#cft').val(data.cft_charges);
					    	$('#air_cft').val(data.air_cft);
					    // }
				
					}
			});
		}
	}



	function checkForTheCondition(){
    		if ($('#is_volumetric').is(':checked')) 
			{
				no_of_pack1 = $('#no_of_pack1').val();
				per_box_weight = $('#per_box_weight').val();

				if(per_box_weight==no_of_pack1){
					$('#submit1').click();
				}else{
					alert('Please Enter '+no_of_pack1+' no of Packets!');
				}

			}else{
				$('#submit1').click();
			}
    	}

/****************************************************************** FTL (FULL TRUCK LOAD) start**************************/
// Basic validations 
(function ($) {
	$.fn.inputFilter = function (callback, errMsg) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function (e) {
			if (callback(this.value)) {
				// Accepted value
				if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
					$(this).removeClass("input-error");
					this.setCustomValidity("");
				}
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				// Rejected value - restore the previous one
				$(this).addClass("input-error");
				this.setCustomValidity(errMsg);
				this.reportValidity();
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				// Rejected value - nothing to restore
				this.value = "";
			}
		});
	};
}(jQuery));

	// Integer value allowed only 
	$("#sender_pincode,#sender_contactno,#reciever_pincode,#reciever_contact,#no_of_pack1,.per_box_weight,.manifest_driver_contact,.manifest_coloader_contact,#credit_days,#pincode,#cmppincode,#origin_pincode").inputFilter(function (value) {
		return /^\d*$/.test(value);    // Allow digits only, using a RegExp
	}, "Only Numbers allowed");

	// Decimal value allowed only 
	$('#invoice_value,#actual_weight,#chargable_weight,.length,.breath,.height,.valumetric_actual,#credit_limit,.billing_amount').keypress(function (event) {
		if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
			$(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) || $(this).val().indexOf('.') !== -1 && event.keyCode == 190) {
			event.preventDefault();
		}
	}).on('paste', function (event) {
		event.preventDefault();
	});

	$('.fillter').select2();


	

	// Indent Tripsheet from 
	$("#consignee_pincode").on('blur', function () {
		var pincode = $(this).val();
		if (pincode != '' || pincode != 'null' || pincode !='0') {
			$.ajax({
				type: 'POST',
				url: 'FTLController/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {
					if (data.status == 'failed') {
						$('#consignee_city').val("");
						$('#consignee_state').val("");
						alertify.alert(data.message,
							function () {
								alertify.success('Ok');
							});
						return false;
					} else {
						$('#consignee_city').val(data.city_id);
						$('#consignee_state').val(data.state_id);
					}
					$("#consignee_city").trigger("change");
					$("#consignee_state").trigger("change");
				}
			});
			$("#consignee_state").trigger("change");
		}
	});
	//  Origin pincode
	$("#origin_pincode").on('blur', function () {
		var pincode = $(this).val();
		if (pincode != '' || pincode != 'null' || pincode !='0') {
			$.ajax({
				type: 'POST',
				url: 'FTLController/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {
					if (data.status == 'failed') {
						$('#origin_city_id').val("");
						$('#origin_state_id').val("");
						alertify.alert(data.message,
							function () {
								alertify.success('Ok');
							});
						return false;
					} else {
						$('#origin_city_id').val(data.city_id);
						$('#origin_state_id').val(data.state_id);
					}
					$("#origin_city_id").trigger("change");
					$("#origin_state_id").trigger("change");
				}
			});
			$("#origin_state_id").trigger("change");
		}
	});
	//  Destination pincode
	$("#destination_pincode").on('blur', function () {
		var pincode = $(this).val();
		if (pincode != '' || pincode != 'null' || pincode !='0') {
			$.ajax({
				type: 'POST',
				url: 'FTLController/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {
					if (data.status == 'failed') {
						$('#destination_city').val("");
						$('#destination_state_id').val("");
						alertify.alert(data.message,
							function () {
								alertify.success('Ok');
							});
						return false;
					} else {
						$('#destination_city').val(data.city_id);
						$('#destination_state_id').val(data.state_id);
					}
					$("#destination_city").trigger("change");
					$("#destination_state_id").trigger("change");
				}
			});
			$("#destination_state_id").trigger("change");
		}
	});

	// indent genration 
	$("#customer").change(function() {
		getConssignee();
	});

	function getConssignee(){
		   var val = $('#customer').val();
			if (val == "2") {
			  $(".consignee_details").show();
			  $(".target_rate").prop('required',true);
			  $("#target_rate").prop("readonly",false);
			  $(".consignor_details").hide();
			}
			if (val == "1") {
			  $(".consignee_details").hide();
			  $(".target_rate").prop('required',true);
			  $("#target_rate").prop("readonly",true);
			  $(".consignor_details").show();
			}
			}

	$("#vehicle_id").on('change ', function() {
		// var current_date = $('#current_date').val();
		var customer_id = $('#customer_id').val();
		var vehicle_id = $('#vehicle_id').val();
		var origin_city_id = $('.origin_city_id').val();
		var destination_city_id = $('.destination_city_id').val();
		// alert(customer_id);
		if (customer_id != null || customer_id != '') {
  
		  $.ajax({
			type: 'POST',
			url: 'AdminFTL_indent/gat_rfq_customer_data',
			data: 'customer_id=' + customer_id + '&vehicle_id=' + vehicle_id + '&origin_city_id=' + origin_city_id + '&destination_city_id=' + destination_city_id,
			dataType: "json",
			success: function(data) {
			    if(data ==''){
					alert("Target Rate not Defind \nplease define rate.");
					$("#target_rate").prop('required',true);
					$('#target_rate').val('');
					$("#target_rate").prop("readonly",true);
				}else{
			      $('#target_rate').val(data.rate);
				  $("#target_rate").prop("readonly",false);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			   alert("Target Rate not Defind \nplease define rate.");
			}
  
		  });
		}  
	});

	$(function() {
	var dtToday = new Date();

	var month = dtToday.getMonth() + 1;
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();
	if (month < 10)
		month = '0' + month.toString();
	if (day < 10)
		day = '0' + day.toString();
	var maxDate = year + '-' + month + '-' + day;
	$('#inputdate').attr('min', maxDate);
	});

	  $("#loading_type").change(function() {
		if ($(this).val() == '2') {
		  $('#show_vendor_msg').modal('show');
		}
	  });
	
	  $(".confirmation_vendor").click(function() {
		$('#show_Unload_vendor_confr').modal('show');
	  });
	
	
	  // ***************** Unloding *******************************
	
	  $("#Unloading_type").change(function() {
		if ($(this).val() == '2') {
		  $('#show_Unload_vendor_msg').modal('show');
		}
	  });
	
	  $(".confirmation_unload_vendor").click(function() {
		$('#show_Unload_vendor_confr').modal('show');
	  });
	
	  // ***************** Resktype *******************************
	
	  $("#insurance_by").change(function() {
		if ($(this).val() == '1') {
		  $('#risk').modal('show');
		  $('#cfo_charges_data').show();
		}else{
		  $('#cfo_charges_data').hide();
		}
	  });
	  
	
	
	  $('.get_vehical_type').change(function() {
		base_url = '<?php echo base_url(); ?>';
		var vehicle_id = $(this).val();
		$.ajax({
		  url: base_url + "FTLController/getVehicleCapicty",
		  type: 'POST',
		  data: {
			vehicle_id: vehicle_id
		  },
		  dataType: 'json',
		  success: function(d) {
			//  var objectX = JSON.parse(d);
			console.log(d);
			// alert(d);
			$('#vehicle_capicty').val(d[0].capicty);
			$('#vehicle_body_type').val(d[0].body_type);
	
		  }
		});
	  });


	  $("#v_pincode").on('blur', function () {
		var pincode = $(this).val();
		if (pincode != '' || pincode != 'null' || pincode !='0') {
			$.ajax({
				type: 'POST',
				url: 'FTLController/getCityList',
				data: 'pincode=' + pincode,
				dataType: "json",
				success: function (data) {
					if (data.status == 'failed') {
						$('#v_city_id').val("");
						$('#v_state_id').val("");
						alertify.alert(data.message,
							function () {
								alertify.success('Ok');
							});
						return false;
					} else {
						$('#v_city_id').val(data.city_id);
						$('#v_state_id').val(data.state_id);
					}
					$("#v_city_id").trigger("change");
					$("#v_state_id").trigger("change");
				}
			});
			$("#v_state_id").trigger("change");
		}
	});

	$(".gst").change(function () {
		var inputValue = $(this).val();
		var gstinFormat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
		
		if (gstinFormat.test(inputValue)) {                                    
			return true;
		} else {                                    
			alert('Please Enter Valid GSTIN Number');
			$(this).val('');
			$(this).focus();
		}
	});
	$(".pan").change(function() {
		var inputvalues = $(this).val();
		var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
		if (!regex.test(inputvalues)) {
			$(".pan").val("");
			alert('Invalid PAN CARD Number');
		}
	});

	$("#register_type").change(function() {
		var registered = $(this).val();
		if (registered == '1') {
			$(".required_gst").attr("required", "true");
			$(".hide_gst_certificate").show();
		} else {
			$(".hide_gst_certificate").hide();
		}
	});

	function checkGST(){
		var registered = $('#register_type').val();
		if (registered == '1') {
			$(".required_gst").attr("required", "true");
			$(".hide_gst_certificate").show();
		} else {
			$(".hide_gst_certificate").hide();
		}
	}

	function selectFirstOption(id) {
		const selectElement = document.getElementById(id);
		selectElement.selectedIndex = 0; // Selects the first option (index 0)
	}


	var cnt = 1;
	$('#add_data').click(function() {
		var origin = $('#origin').val();
		var destination = $('#destination').val();
		var vehicle_type = $('#vehicle_type').val();                                 
		if (origin && destination && vehicle_type) {
			var $html = '<div class="row mb-4" id="RANDOM_NO_' + cnt + '" data-id="#RANDOM_NO#">' +
				'<div class="form-group col-sm-3">' +
				'<input type="text" name="origin[]" data-id="#RANDOM_NO#" class="form-control" value="' + origin + '" readonly>' +
				'</div>' +
				'<div class="form-group col-sm-3">' +
				'<input type="text" class="form-control" name="destination[]" data-id="#RANDOM_NO#" value="' + destination + '" readonly>' +
				'</div>' +
				'<div class="form-group col-sm-3">' +
				'<input type="text" class="form-control" name="vehicle_type[]" data-id="#RANDOM_NO#" value="' + vehicle_type + '" readonly>' +
				'</div>' +
				'<div class="form-group col-sm-3 mt-4">' +
				'<button type="button" class="btn btn-danger removebutton" onClick="remove_row123(' + cnt + ')">Delete</button>' +
				'</div>' +
				'</div>';

			$('#show_column').append($html);
			selectFirstOption('origin');
			selectFirstOption('destination');
			selectFirstOption('vehicle_type');
			cnt++;
		} else {
			alert('Please select all fields');
		}
	});
	function remove_row123(cnt1) {
		$("#RANDOM_NO_" + cnt1).remove();
	}

	$(".gst").on('input', function () {
		var inputValue = $(this).val();
		$(this).val(inputValue.toUpperCase());
	});

/****************************************************************** FTL (FULL TRUCK LOAD) end **************************/
