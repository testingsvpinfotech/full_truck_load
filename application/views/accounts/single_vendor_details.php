<style type="text/css">
    .nav-tabs-custom ul li{ margin-bottom: 10px; }
    .nav-tabs-custom ul li a{ padding: 10px; border: 1px solid #eee; }
    .nav-tabs-custom ul li a.active{ color: #fff; background: #292b3a; padding: 10px; border: 1px solid #eee; }
</style>
<main>
    <div class="container-fluid site-width">
        <div class="row"> 
            <div class="col-12 col-sm-12 mt-5">
                <div class="box">
                    <div class="box-header justify-content-between align-items-center">
                        <h4 class="box-title"><?= $title; ?></h4>
                    </div>
                    <div class="box-body">
                        <form id="update_vendor_form">
                            <div class="row">
                                <div class="col-md-3">
                                    
                                    <div class="card box-primary">
                                        <div class="box-body box-profile p-2">
                                            <h3 class="profile-username text-center"><?= (!empty($vrecord))?$vrecord->vendor_name:""; ?></h3>
                                            <p class="text-muted text-center"><?= (!empty($vrecord))?$vrecord->vcode:""; ?>(<?= (!empty($vrecord))?$vrecord->register_type:""; ?>)</p>
                                        </div>
                                        <div class="card-body">
                                            <strong><i class="fa fa-phone-alt margin-r-5"></i> Phone</strong><p class="text-muted"><?= (!empty($vrecord))?$vrecord->mobile_no.'/ '.$vrecord->alternate_phone_number:""; ?></p>
                                            <hr>
                                            <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                                            <p class="text-muted"><?= (!empty($vrecord))?$vrecord->email.'/ '.$vrecord->alternate_email:""; ?></p>
                                            <hr>
                                            <!-- ===== Add Branch =====  -->
                                            <strong>Documents</strong><br/>
                                                <span class="mr-4"> 1. <a href="<?= base_url().'assets/ftl_documents/vendor_register_doc/'.$vrecord->pan_card_proof; ?>"><i class="fa fa-paperclip"></i></a> PAN CARD</span>
                                                <span class="mr-4"> 2. <a href="<?= base_url().'assets/ftl_documents/vendor_register_doc/'.$vrecord->address_proof; ?>"><i class="fa fa-paperclip"></i></a> ADDRESS PROOF</span><br/>
                                                <span class="mr-4"> 3. <a href="<?= base_url().'assets/ftl_documents/vendor_register_doc/'.$vrecord->cancel_cheque; ?>"><i class="fa fa-paperclip"></i></a> CANCEL CHEQUE</span>
                                                <span class="mr-4"></span> 4. <a href="<?= base_url().'assets/ftl_documents/vendor_register_doc/'.$vrecord->gst_proof; ?>"><i class="fa fa-paperclip"></i></a> GST PROOF</span>

                                            <a href="<?= base_url().'accounts-vendor'; ?>" class="btn btn-primary btn-block mt-3"><b>Back to List</b></a>
                                        </div>
                                    </div>
                                </div><!-- col-3 Closed -->
                                <div class="col-md-9">
                                    <div class="card box-primary p-4">
                                        <div class="row">
                                            <div class="col-4">
                                                <h5 style="border-bottom: 1px solid #eee">Basic Details</h5>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Username :</h6>
                                                    <h6 class="col-6"> <input name="username" id="username" value="<?= (!empty($vrecord))?$vrecord->username:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Pef Person Name :</h6>
                                                    <h6 class="col-6"> <input name="reference_person_name" id="reference_person_name" value="<?= (!empty($vrecord))?$vrecord->reference_person_name:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Service Provider :</h6>
                                                    <h6 class="col-6"> <input name="service_provider" id="service_provider" value="<?= (!empty($vrecord))?$vrecord->service_provider:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Credit Days :</h6>
                                                    <h6 class="col-6"> <input name="credit_days" id="credit_days" value="<?= (!empty($vrecord))?$vrecord->credit_days:""; ?>" class="form-control"></h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <h5 style="border-bottom: 1px solid #eee">Address Details</h5>
                                                <div class="form-group row">
                                                    <h6 class="col-4">Address :</h6>
                                                    <h6 class="col-8"> <input name="address" id="address" value="<?= (!empty($vrecord))?$vrecord->address:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-4">State :</h6>
                                                    <h6 class="col-8"> <input name="state" id="state" value="<?= (!empty($vrecord))?$vrecord->address:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-4">City :</h6>
                                                    <h6 class="col-8"> <input name="city" id="city" value="<?= (!empty($vrecord))?$vrecord->address:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-4">Pincode :</h6>
                                                    <h6 class="col-8"> <input name="pincode" id="pincode" value="<?= (!empty($vrecord))?$vrecord->pincode:""; ?>" class="form-control"></h6>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <h5 style="border-bottom: 1px solid #eee">Bank Details</h5>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Account Number :</h6>
                                                    <h6 class="col-6"> <input name="pincode" id="pincode" value="<?= (!empty($vrecord))?$vrecord->pincode:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">Bank Name :</h6>
                                                    <h6 class="col-6"> <input name="bank_name" id="bank_name" value="<?= (!empty($vrecord))?$vrecord->bank_name:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">IFSC Code :</h6>
                                                    <h6 class="col-6"> <input name="ifsc_code" id="ifsc_code" value="<?= (!empty($vrecord))?$vrecord->ifsc_code:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">GST No :</h6>
                                                    <h6 class="col-6"> <input name="gst_number" id="gst_number" value="<?= (!empty($vrecord))?$vrecord->gst_number:""; ?>" class="form-control"></h6>
                                                </div>
                                                <div class="form-group row">
                                                    <h6 class="col-6">PAN No :</h6>
                                                    <h6 class="col-6"> <input name="pan_number" id="pan_number" value="<?= (!empty($vrecord))?$vrecord->pan_number:""; ?>" class="form-control"></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card box-primary p-4">
                                        
                                        <div class="row">
                                            <div class="col-4 mb-2">
                                                <!-- ===== Add Branch =====  -->
                                            <strong>Assign Branch</strong><br>
                                            <select id="multiple-checkboxes" name="branch_id[]" class="form-control" multiple="multiple">
                                                <?php if(!empty($branch)): foreach ($branch as $value): ?>
                                                    <option value="<?= $value->branch_id; ?>" <?php foreach ($vbranch as $vb): echo ($vb->branch_id == $value->branch_id)?"selected":""; endforeach; ?>><?= $value->branch_name; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6>Add Muliple Address</h6>
                                                <table class="table">
                                                    <tr>
                                                        <th>Default</th>
                                                        <th>Address</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Pincode</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" id="dcheck"></td>
                                                        <td><input class="form-control" id="sub_address" placeholder="Enter Address"></td>
                                                        <td><select class="form-control" id="sub_state">
                                                            <option value="">Please select</option>
                                                            <?php if(!empty($state)){ foreach ($state as $sv) { ?>
                                                                <option value="<?= $sv->state_id ?>"><?= $sv->state_name ?></option>
                                                            <?php } } ?>
                                                        </select></td>
                                                        <td><select class="form-control" id="sub_city">
                                                            <option value="">Please select</option>
                                                        </select></td>
                                                        <td><input class="form-control" id="sub_pincode" placeholder="Pincode"></td>
                                                        <td><a class="btn btn-sm btn-success" onclick="add_multiple_address()">ADD NEW</a></td>
                                                    </tr>
                                                    <tbody id="address_wrapper">
                                                        <?php $adr_cnt = 1; if(!empty($vaddr)): foreach ($vaddr as $a): ?>
                                                    <tr id="row_id_<?= $adr_cnt; ?>">
                                                        <td>
                                                            <input type="checkbox" id="dcheck" <?= ($a->vdefault==1)?"checked":""; ?> disabled>
                                                            <input type="hidden" name="dcheck1_val[]" id="dcheck1_val_<?= $adr_cnt; ?>" value="<?= $a->vdefault; ?>" readonly>
                                                        </td>
                                                        <td><input class="form-control" id="sub_address1_<?= $adr_cnt; ?>" value="<?= $a->vaddress; ?>" placeholder="Enter Address" readonly></td>
                                                        <td>
                                                            <input type="hidden" class="form-control" name="sub_state_id1[]" id="sub_state_id1_<?= $adr_cnt; ?>" value="<?= $a->vstate; ?>" readonly>
                                                            <input class="form-control" id="sub_state_name1_<?= $adr_cnt; ?>" value="<?= $a->state_name; ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" class="form-control" name="sub_city_id1[]" id="sub_city_id1_<?= $adr_cnt; ?>" value="<?= $a->vcity; ?>" readonly>
                                                            <input class="form-control" id="sub_city_name1_<?= $adr_cnt; ?>" value="<?= $a->city_name; ?>" readonly>
                                                        </td>
                                                        <td><input class="form-control" id="sub_pincode1_<?= $adr_cnt; ?>" name="sub_pincode1[]" value="<?= $a->vpincode; ?>" placeholder="Pincode" readonly></td>
                                                        <td><a class="btn btn-sm btn-danger" onclick="remove_adr_row()"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                        <?php $adr_cnt++; endforeach; endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="card box-primary p-4">
                                        
                                        <a class="btn btn-primary text-white" onclick="update_vendor_record(<?= (!empty($vrecord))?$vrecord->customer_id:0; ?>)">Update Vendor</a>
                                        
                                    </div>
                                </div><!-- col-9 Closed -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script type="text/javascript">
    var adr_cnt = <?php echo $adr_cnt; ?>;
    console.log(adr_cnt);
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
          includeSelectAllOption: true,
        });

        $('#sub_state').change(function(){
            var state = $(this).val();
            $.ajax({
                url:'<?=base_url().'getCities_statewise' ?>',
                method: 'post',
                data: {state: state},
                dataType: 'json',
                success: function(response){
                  var data1 = '<option value="">Please select</option>';
                  $.each(response,function(index,item){
                    data1 += '<option value="'+item['city_id']+'">'+item['city_name']+'</option>';
                  });
                  $('#sub_city').html(data1);
                }
             });
        });
    });
    
    function add_multiple_address(){
        var check = 1;

        if($("#sub_address").val() == ""){
            check = 0;
        }else{
            check = 1;
        }
        var dcheck = 0;

        if(check == 1){
            // $('input[name="dcheck"]:checked');
            if ($('#dcheck').is(":checked")){
               dcheck = 1; 
            }
            var adr = $("#sub_address").val();
            var adr = $("#sub_address").val();
            var sub_state_id = $("#sub_state :selected").val();
            var sub_state_name = $("#sub_state :selected").text();

            var sub_city_id = $("#sub_city :selected").val();
            var sub_city_name = $("#sub_city :selected").text();

            var sub_pincode = $("#sub_pincode").val();

            var data = '';
            data += '<tr id="row_id_'+adr_cnt+'">';
                data += '<td><input type="hidden" id="id_'+adr_cnt+'" name="id[]" value="0">';
                data += '<input type="checkbox" id="dcheck1_'+adr_cnt+'" value="'+dcheck+'" checked readonly>';
                data += '<input type="hidden" name="dcheck1_val[]" id="dcheck1_val_'+adr_cnt+'" value="'+dcheck+'" readonly>';
                data += '</td>';

                data += '<td><input class="form-control" name="sub_address1[]" id="sub_address1_'+adr_cnt+'" value="'+adr+'" placeholder="Enter Address" readonly></td>';
                data += '<td>';
                    data += '<input type="hidden" class="form-control" name="sub_state_id1[]" id="sub_state_id1_'+adr_cnt+'" value="'+sub_state_id+'" readonly>';
                    data += '<input class="form-control" id="sub_state_name1_'+adr_cnt+'" value="'+sub_state_name+'" readonly>';
                data += '</td>';
                data += '<td>';
                    data += '<input type="hidden" class="form-control" name="sub_city_id1[]" id="sub_city_id1_'+adr_cnt+'" value="'+sub_city_id+'" readonly>';
                    data += '<input class="form-control" id="sub_city_name1_'+adr_cnt+'" value="'+sub_city_name+'" readonly>';
                data += '</td>';
               
                data += '<td><input class="form-control" name="sub_pincode1[]" id="sub_pincode1_'+adr_cnt+'" value="'+sub_pincode+'" placeholder="Pincode" readonly></td>';
                data += '<td><a class="btn btn-sm btn-danger" onclick="remove_adr_row('+adr_cnt+')"><i class="fa fa-trash"></i></a></td>';
            data += '</tr>';

            $('#address_wrapper').append(data);
            adr_cnt ++;
            $('#dcheck').prop('checked', false);
            $("#sub_address").val('');
            $("#sub_state").val('');
            $("#sub_city").val('');
            $("#sub_pincode").val('');
        }
    }

    function update_vendor_record(id){
        $.ajax({
            url:'<?=base_url().'update_vendor_records/' ?>'+id,
            method: 'post',
            data:$('#update_vendor_form').serialize(),
            // dataType: 'json',
            success: function(resp){
              if (resp == 1) {
                    display_alert('succ','successfully inserted !');
                    $("body, html").animate({'scrollTop':0},500);
                    setTimeout(function() { window.location.reload() }, 1000);
                }else if(resp == 2){
                    display_alert('err','Already Exist !');
                    $("body, html").animate({'scrollTop':0},500);
                }
            }
        });
    }

    function remove_adr_row(cnt){
        $("#row_id_").detach();
    }
</script>