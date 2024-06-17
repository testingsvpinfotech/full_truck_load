<main>
    <div class="container-fluid site-width">
        <div class="row">                 
            <div class="col-12  align-self-center">
                <div class="col-12 col-sm-12 mt-5">
                    <div class="box">
                        <div class="box-header justify-content-between align-items-center">
                            <h4 class="box-title"><?= $title; ?></h4>
                        </div>
                        <div class="box-body">
                            <div class="alert_msg"></div>
                                <form id="general_ledger_form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-row">
                                                <div class="col-4 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" onkeyup="getMailingName()">
                                                    <input type="hidden" class="form-control" name="ledger_code" id="ledger_code" value="<?= $max_no; ?>" readonly>
                                                </div>
                                                 <div class="col-4 mb-3">
                                                    <label>Alias</label>
                                                    <input type="text" class="form-control" name="alias" id="alias"
                                                        placeholder="Enter Alias">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Under</label>
                                                    <select class="form-control" name="under_group" id="under_group">
                                                        <option value="">Please Select</option>
                                                        <?php if(!empty($grp)): foreach ($grp as $value):
                                                            echo '<option value="'.$value->name.'">'.$value->name.' -('.$value->alias_name.')</option>';
                                                        endforeach; endif;  ?>
                                                    </select>

                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Date </label>
                                                    <input type="date" class="form-control" name="date" id="date" value="<?= date('d-m-Y'); ?>">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Type of Ledger </label>
                                                    <input class="form-control" name="ledger_type" id="ledger_type" placeholder="Enter type of Ledger">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Maintain balances bill by bill</label>
                                                    <select class="form-control" name="billbybill_balance" id="billbybill_balance">
                                                        <option value="">Please select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                 <div id="section_billbybill" class="col-4 mb-3" style="display: none;">
                                                     <label>Default credit period </label>
                                                    <input class="form-control" name="default_cr_period" id="default_cr_period" placeholder="Enter default credit period">
                                                 </div>
                                                 <div id="section1_billbybill" class="col-4 mb-3" style="display: none;">
                                                     <label>Check credit days during voucher entry </label>
                                                    <input class="form-control" name="chk_creditdays" id="chk_creditdays" placeholder="Enter credit days">
                                                 </div>

                                                <div class=" col-12">
                                                    <h5> Statutory Details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Is Gst applicable</label>
                                                    <select class="form-control" name="is_gst_applicable" id="is_gst_applicable">
                                                        <option value="">Applicable</option>
                                                        <option value="">Not Applicable</option>
                                                    </select>
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <label>Set Gst Details</label>
                                                    <select class="form-control" name="gst_details" id="gst_details" required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>

                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Type of Supply</label>
                                                    <select class="form-control" name="type_of_supply" id="type_of_supply">
                                                        <option value="">Please Select</option>
                                                        <option value="Goods">Goods</option>
                                                        <option value="Service">Service</option>
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Is Tds Applicable</label>
                                                    <select class="form-control" name="is_tds_applicable" id="is_tds_applicable" readonly>
                                                        <option value="">Select Tds</option>
                                                        <option value="Undefined" selected>Undefined</option>
                                                        <!-- <option value="Applicable">Applicable</option> -->
                                                        <!-- <option value="Not applicable">Not applicable</option> -->
                                                    </select>
                                                </div>
                                                <div id="tds_section" class="col-4 mb-3" style="display: none;">
                                                    <label>Nature of Payment</label>
                                                    <input class="form-control" name="nature_of_payment" id="nature_of_payment" placeholder="Enter Nature of Payment" />
                                                </div>

                                    </div>
                                </form>
                        </div>

                                <div class="col-md-6 row">

                                                <div class=" col-12">
                                                    <h5> Mailing details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="mailing_name" id="mailing_name" placeholder="name">
                                                </div>
                                                <div class="col-8 mb-3">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="mailing_address" id="mailing_address" placeholder="Address">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="mailing_pincode" id="mailing_pincode" placeholder="pincode">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="mailing_state" id="mailing_state" placeholder="State">
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="mailing_country" id="mailing_country" placeholder="country">
                                                </div>
                                                

                                                <div class=" col-12">
                                                    <h5> Banking details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Provide Bank Details</label>
                                                    <select type="text" class="form-control" name="is_bank_details" id="is_bank_details">
                                                        <option value="">Please Select</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                    </select>
                                                </div>
                                                <div id="bank_section" class="col-4 mb-3" style="display: none">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name">
                                                </div>
                                                <div id="bank_section1" class="col-4 mb-3" style="display: none">
                                                    <label>Branch Name</label>
                                                    <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                                                </div>
                                                <div id="bank_section2" class="col-4 mb-3" style="display: none">
                                                    <label>IFSC Code</label>
                                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter IFSC Code">
                                                </div>
                                                <div id="bank_section3" class="col-4 mb-3" style="display: none">
                                                    <label>Transaction Type</label>
                                                    <input type="text" class="form-control" name="transaction_type" id="transaction_type" placeholder="Enter Transaction type">
                                                </div>

                                                <div class=" col-12">
                                                    <h5> Tax Registration details </h5>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>PAN/IT No.</label>
                                                    <input type="text" class="form-control" name="pan_it_no" id="pan_it_no" placeholder="Enter PAN/IT No">
                                                </div>
                                                

                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary" onclick="general_ledger_submit()">Submit</button>
                                                </div>
                                            </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function getMailingName(){
        var dInput = $('#name').val();
        $("#mailing_name").val(dInput);
    }

    $('#billbybill_balance').on('change', function() {
        if( this.value == 'Yes' ){
            $("#section_billbybill").show();
            $("#section1_billbybill").show();
        }else{
            $("#section_billbybill").hide();
            $("#section1_billbybill").hide();
        }
    });

    $('#is_bank_details').on('change', function() {
        if( this.value == 'Yes' ){
            $("#bank_section").show();
            $("#bank_section1").show();
            $("#bank_section2").show();
            $("#bank_section3").show();
            // $("#bank_section4").show();
            
        }else{
            $("#bank_section").hide();
            $("#bank_section1").hide();
            $("#bank_section2").hide();
            $("#bank_section3").hide();
            // $("#bank_section4").hide();
        }
    });

    $('#gst_details').on('change', function(){
        var data = '';
        if( this.value == 'Yes' ){
            var name = $('#name').val();
            if(name == ""){
                var url = baseURL+'getTransNature/0';
            }else{
                var url = baseURL+'getTransNature/'+name;
            }
            $.ajax({
                url: url,
                type: 'GET',
                dataType: "json",
                success: function(resp) {
                    console.log(resp);
                    if(resp['gst'] != null){
                        var ledger_name = resp['gst']['ledger_name'];
                        var classification = resp['gst']['classification'];
                        var hsn_code = resp['gst']['hsn_code'];
                        var hsn_desc = resp['gst']['hsn_desc'];
                        var nongst_goods = resp['gst']['nongst_goods'];
                        var reverse_charge_applicability = resp['gst']['reverse_charge_applicability'];
                        var taxability = resp['gst']['taxability'];
                        var trans_nature = resp['gst']['trans_nature'];
                        var tax_id = resp['gst']['tax_id'];
                    }else{
                        var ledger_name = ""; var classification = ""; var hsn_code = "";
                        var hsn_desc = ""; var nongst_goods = ""; var reverse_charge_applicability = "No";
                        var taxability = "Taxable"; var trans_nature = ""; var tax_id = "";
                    }
                    data += '<form id="ledger_gst_form"><div class="row">';
                    data += '<div class="col-md-12">';
                    data += '<div class="alert_msg"></div>';
                        data += '<div class="form-group mb-2 row">';
                            data += '<label class="col-md-3"></label>';
                            data += '<input class="form-control mb-3 col-md-7" name="ledger_name" id="ledger_name" placeholder="Enter name" value="'+name+'" readonly>';
                        data += '</div>';

                        data += '<div class="form-group mb-2 row">';
                            data += '<label class="col-md-4">Classification</label>';
                            data += '<input class="form-control col-md-7" name="classification" id="classification" placeholder="Enter Classification" value="'+classification+'">';
                        data += '</div>';
                        data += '<h6 class="mt-2">HSN/SAC Details</h6>';
                        data += '<div class="form-group row mt-2 mb-2">';
                            data += '<label class="col-md-4">Description</label>';
                            data += '<input class="form-control col-md-7" name="hsn_desc" id="hsn_desc" placeholder="Enter Description" value="'+hsn_desc+'">';
                        data += '</div>';
                        data += '<div class="form-group mt-2 mb-2 row">';
                            data += '<label class="col-md-4">HSN/SAC</label>';
                            data += '<input class="form-control col-md-7" name="hsn_code" id="hsn_code" placeholder="Enter HSN/SAC No" value="'+hsn_code+'">';
                        data += '</div>';

                        data += '<div class="form-group mt-2 mb-2 row">';
                            data += '<label class="col-md-4">Is non-GST goods</label>';
                            data += '<input class="form-control col-md-7" name="nongst_goods" id="nongst_goods" placeholder="Enter non-GST goods" value="'+nongst_goods+'">';
                        data += '</div>';
                        data += '<div class="form-group mt-2 mb-2 row">';
                            data += '<label class="col-md-4">Nature of Transaction</label>';
                            data += '<select class="form-control col-md-7" name="trans_nature" id="trans_nature">';
                            data += '<option value="0">Please select</option>';
                            $.each(resp['nature'], function(index, item)
                            {
                                data += "<option value='"+item.id+"'>" + item.name + "</option>";
                            });
                            data += '</select>';
                        data += '</div>';

                        data += '<h6 class="mt-2">Tax Details</h6>';
                        data += '<div class="form-group row mt-2 mb-2">';
                            data += '<label class="col-md-4">Taxability</label>';
                            data += '<input class="form-control col-md-7" name="taxability" id="taxability" placeholder="Enter Taxability" value="'+taxability+'">';
                        data += '</div>';
                        data += '<div class="form-group row mt-2 mb-2">';
                            data += '<label class="col-md-4">Is reverse charge applicable</label>';
                            data += '<input class="form-control col-md-7" name="reverse_charge_applicability" id="reverse_charge_applicability" placeholder="Enter Reverse Charge" value="'+reverse_charge_applicability+'">';
                        data += '</div>';
                        data += '<div class="form-group mt-2 mb-2">';
                            data += '<table class="table">';
                            data += '<tr><th>Tax Type</th><th>Valuation Type</th><th>Rate</th></tr>';
                            data += '<tr><td>Integrated Tax</td><td>Based on Value</td><td>18%</td></tr>';
                            data += '<tr><td>Central Tax</td><td>Based on Value</td><td>9%</td></tr>';
                            data += '<tr><td>State Tax</td><td>Based on Value</td><td>9%</td></tr>';
                            data += '<tr><td>UT Tax</td><td>Based on Value</td><td>0%</td></tr>';
                            data += '<tr><td>Cess</td><td>Based on Value</td><td>0%</td></tr>';
                            data += '</table>';
                        data += '</div>';
                    data += '<div class="col-md-12 text-right mt-3" style="border-top: 1px solid #e2e5ed;padding-top: 10px;">';
                        data += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                    // if(id == null){
                        data += ' <button type="submit" class="btn btn-primary" onclick="submit_ledger_gst_details()">Save</button>';
                    // }else{
                    //     data += ' <button type="submit" class="btn btn-primary" onclick="submit_exp_group('+id+')">Update</button>';
                    // }
                    data += '</div>';
                    data += '</div></form>';
                    
                    $('#modal_title').html('SET GST Details');
                    
                    $('#modal_content').html(data);
                    $('#masterModal').modal('show');
                }
            });
        }
    });

    function submit_ledger_gst_details(){
        $("#ledger_gst_form").validate({
            rules: {
                hsn_code: {  required: true }
            },
            messages: {
                hsn_code: {  required: "HSN/SAC is required." }
            },
            submitHandler: function(form) {
                // if(id == null){
                    var url = baseURL+'submitLedgerGst';
                // }else{
                    // var url = baseURL+'submitGst/'+id;
                // }
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(resp) {
                        if (resp == 1) {
                            $('#masterModal').modal('hide');
                        }else{
                            display_alert('err','Already Exist !');
                            $("#masterModal").animate({'scrollTop':0},1000);   
                        }
                    }
                });
            }
        });
    }
</script>



