 <!-- START: Pre Loader -->
<!--        <div class="se-pre-con">
            <div class="loader"></div>
        </div> -->
        <!-- START: Header -->
<style type="text/css">
	#side-menu li a.active{
		color: #fff;
    	background: #265283;
	}
</style>
<div id="header-fix" class="header fixed-top ">
	<div class="site-width">
		<nav class="navbar navbar-expand-lg  p-0">
			<div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
				<a href="javascript:void(0);" class="horizontal-logo text-left">
					<?php $company_details = $this->basic_operation_m->get_table_row('tbl_company', array('id' => 1)); ?>
					<img src="assets/company/<?php echo $company_details->logo; ?>" class="portfolioImage img-fluid">
				</a>
			</div>
			<div class="navbar-right">
				<!-- START: Main Menu-->
				<div class="sidebar">
                    <div class="site-width">
                        <ul id="side-menu" class="sidebar-menu">
							<li class="dropdown active">                  
                                <ul>
									<!-- <li class="active"><a href="admin/dashboard"><i class="icon-home mr-1"></i> Dashboard</a></li> -->
									<li class="dropdown"><a href="#" class="<?= ($slug == 'vendor_list')?'active':''; ?>"><i class="fa fa-cog mr-2"></i> Accounts Master</a>
										<ul class="sub-menu">
											<li><a href="<?= base_url().'accounts-vendor'; ?>" class="<?= ($slug == 'vendor_menu')?'active':''; ?>"><i class="fa fa-users"></i> Vendors Group List</a></li>
											<!-- <li><a href="#" class="<?= ($slug == 'vendor_sublist')?'active':''; ?>"><i class="fa fa-users"></i> Vendors Sub-Group List</a></li> -->
											<li><a href="<?= base_url().'accounts-customer'; ?>" class="<?= ($slug == 'customer_menu')?'active':''; ?>"><i class="fa fa-users"></i> Customers Group List</a></li>
											<li><a href="<?= base_url().'tds-sections'; ?>" class="<?= ($slug == 'tds_sections')?'active':''; ?>"><i class="fa fa-users"></i> TDS Sections Master</a></li>
											<li><a href="<?= base_url().'tds-percent'; ?>" class="<?= ($slug == 'tds_percent')?'active':''; ?>"><i class="fa fa-users"></i> TDS % Master</a></li>
											<li><a href="<?= base_url().'gst'; ?>" class="<?= ($slug == 'gst_menu')?'active':''; ?>"><i class="fa fa-users"></i> GST Master</a></li>
											<li><a href="<?= base_url().'group_master'; ?>" class="<?= ($slug == 'exp_grp_menu')?'active':''; ?>"><i class="fa fa-users"></i> Group Master</a></li>
											<li><a href="<?= base_url().'expense_subgrp_master'; ?>" class="<?= ($slug == 'exp_subgrp_menu')?'active':''; ?>"><i class="fa fa-users"></i> Sub-group Master</a></li>
											<li><a href="<?= base_url().'transaction_nature_master'; ?>" class="<?= ($slug == 'trans_nature_menu')?'active':''; ?>"><i class="fa fa-users"></i> Transaction Nature Master</a></li>
											<li><a href="<?= base_url().'payment_trans_master'; ?>" class="<?= ($slug == 'pay_trans_menu')?'active':''; ?>"><i class="fa fa-users"></i>Payment Transaction Master</a></li>
											
											
										</ul>
									</li>
									<li class="dropdown"><a href="#" class="<?= ($slug == 'vendor_list')?'active':''; ?>"><i class="fa fa-cog mr-2"></i> Ledger</a>
										<ul class="sub-menu">
											<li><a href="<?= base_url().'create-ledger'; ?>" class="<?= ($slug == 'create_ledger')?'active':''; ?>"><i class="fa fa-users"></i> New Ledger</a></li>
											<li><a href="<?= base_url().'ledger-list'; ?>" class="<?= ($slug == 'ledger_menu')?'active':''; ?>"><i class="fa fa-users"></i> All Ledgers</a></li>
											<li><a href="<?= base_url().'create-vendorledger'; ?>" class="<?= ($slug == 'vledger_list')?'active':''; ?>"><i class="fa fa-users"></i> New Vendor Ledger</a></li>
											<!-- <li><a href="<?= base_url().'create-sale-ledger' ?>" class="<?= ($slug == 'saleledger_menu')?'active':''; ?>"><i class="fa fa-users"></i> New Sales Ledger</a></li> -->
											<!-- <li><a href="<?= base_url().'create-purchase-ledger' ?>" class="<?= ($slug == 'purchaseledger_menu')?'active':''; ?>"><i class="fa fa-users"></i> New Purchase Ledger</a></li> -->
											<!-- <li><a href="#" class="<?= ($slug == 'vendor_list')?'active':''; ?>"><i class="fa fa-users"></i> New Expense Ledger</a></li> -->
										</ul>
									</li>
									<li class="dropdown"><a href="#" class="<?= ($slug == 'vendor_list')?'active':''; ?>"><i class="fa fa-cog mr-2"></i> Courier Service</a>
										<ul class="sub-menu">
											<li><a href="<?= base_url().'courier-service-ptl'; ?>" class="<?= ($slug == 'ptl_invoice_menu')?'active':''; ?>"><i class="fa fa-users"></i> For PTL Invoice</a></li>
											<li><a href="<?= base_url().'courier-service-ftl'; ?>" class="<?= ($slug == 'ftl_invoice_menu')?'active':''; ?>"><i class="fa fa-users"></i> For FTL Invoice</a></li>
											<li><a href="<?= base_url().'unbill-shipments'; ?>" class="<?= ($slug == 'shipments_menu')?'active':''; ?>"><i class="fa fa-users"></i>Unbill Shipments</a></li>
										</ul>
									</li>
									<li class="dropdown"><a href="#" class="<?= ($slug == 'voucher_menu')?'active':''; ?>"><i class="fa fa-cog mr-2"></i> Voucher</a>
										<ul class="sub-menu">
											<li><a href="<?= base_url().'create-voucher'; ?>" class="<?= ($slug == 'voucher_menu')?'active':''; ?>"><i class="fa fa-users"></i> New Voucher</a></li>
											<li><a href="<?= base_url().'voucher-list'; ?>" class="<?= ($slug == 'voucherlist_menu')?'active':''; ?>"><i class="fa fa-users"></i> Voucher Details</a></li>
											
										</ul>
									</li>
									<!-- <li class="active"><a href="#"><i class="icon-home mr-1"></i> Voucher Master</a></li> -->
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
				

				<ul id="top-menu" class="top-menu">

					<li class="dropdown user-profile align-self-center d-inline-block">
						<a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
							<div class="media">
								<img src="assets/image/avtar.png" alt="" title="LU0001" class="d-flex img-fluid rounded-circle" width="29">
							</div>
						</a>
						<center><b><?php //echo $this->session->userdata('customer_name'); ?></b></center>
						<div class="dropdown-menu border dropdown-menu-right p-0">
							<a href="Login/logout" class="dropdown-item px-2 text-danger align-self-center d-flex">
								<span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
						</div>

					</li>

				</ul>
			</div>
		</nav>
	</div>
</div>
