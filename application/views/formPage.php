<div class="container form-top">
                    <div class="row">
                        <div class="col-sm-3 " style='padding:3%;'>
                        	<div class="row">
                        		<h3>Hello, <?php echo $_GET['name']; ?></h3>
                        		<button id='sign-out' class='btn btn-warning btn-md btn-block'>
                        			<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sign Out  
                        		</button>
                        	</div>
                        </div>
                        <div class="col-sm-9" style='padding:3%;'>
                        	<!--- Contract Form --> 
                        	<div class="row" id='contract-form'>
                        		<h3>Generate a land contract!<br />
                        			<small>Please fill up the form below and click "Generate Contract"</small>
                        		</h3>
                        		<br />
                        		<div class='row'>
                        			<div id='action-message' class='col-sm-12'>
                        			</div>
                        		</div>
                        		<div class='row'>
                        			<div class='col-sm-4'>
                        				<div class="form-group">
										    <label class='cute'>Buyer Name (Last, First Middle):</label>
										    <input type="text" class="form-control data-handle" id="buyer-lname" placeholder="Enter buyer last name">
										</div>
									</div>
									<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <input type="text" class="form-control data-handle" id="buyer-fname" placeholder="Enter buyer first name">
										</div>
                        			</div>
                        			<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <input type="text" class="form-control data-handle" id="buyer-mname" placeholder="Enter buyer middle name">
										</div>
                        			</div>
                        		</div>
                        		<div class='row'>
                        			<div class='col-sm-4'>
                        				<div class="form-group">
										    <label class='cute'>Seller Name (Last, First Middle):</label>
										    <input type="text" class="form-control data-handle" id="seller-lname" placeholder="Enter seller last name">
										</div>
									</div>
									<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <input type="text" class="form-control data-handle" id="seller-fname" placeholder="Enter seller first name">
										</div>
                        			</div>
                        			<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <input type="text" class="form-control data-handle" id="seller-mname" placeholder="Enter seller middle name">
										</div>
                        			</div>
                        		</div>
                        		<div class='row'>
                        			<div class='col-sm-8'>
                        				<div class="form-group">
										    <label class='cute'>Property Address:</label>
										    <input type="text" class="form-control data-handle" id="prop-address" placeholder="Enter address (i.e. 2/F CS Bldg)">
										</div>
									</div>
									<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <input type="text" class="form-control data-handle" id="prop-bar" placeholder="Enter barangay">
										</div>
                        			</div>
                        		</div>
                        		<div class='row'>
                        			<div class='col-sm-8'>
                        				<div class="form-group">
										    <input type="text" class="form-control data-handle" id="prop-city" placeholder="Enter city">
										</div>
									</div>
									<div class='col-sm-4'>
										<div class="form-group">
										    <select class='form-control data-handle' id="prop-provinces">
										    	<?php
										    		$provinces = ["Lanao del Norte", "Lanao del Sur", "Bukidnon", "Misamis Oriental", "Misamis Occidental"];
										    		foreach($provinces as $p){
										    			echo "<option>".$p."</option>";
										    		}
										    	?>
										    </select>
										</div>
                        			</div>
                        		</div>


                        		<div class='row'>
                        			<div class='col-sm-4'>
                        				<div class="form-group">
										    <label class='cute'>Execution Date:</label>
										    <select class='form-control data-handle' id="prop-date-year">
										    	<?php
										    		for($i=2036; $i>1900; $i--){
										    			echo "<option>".$i."</option>";
										    		}
										    	?>
										    </select>
										</div>
									</div>
									<div class='col-sm-4'>
										<div class="form-group">
											<label class='cute'>&nbsp</label>
										    <select class='form-control data-handle' id="prop-date-month">
										    	<?php
										    		$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
										    		foreach($months as $p){
										    			echo "<option>".$p."</option>";
										    		}
										    	?>
										    </select>
										</div>
                        			</div>
                        			<div class='col-sm-4'>
                        				<div class="form-group">
										    <label class='cute'>&nbsp</label>
										    <select class='form-control data-handle' id="prop-date-day">
										    	<?php
										    		for($i=1; $i<32; $i++){
										    			echo "<option>".$i."</option>";
										    		}
										    	?>
										    </select>
										</div>
									</div>
                        		</div>
                        		<div class='row'>
                        			<div class='col-sm-5 '>
                        				<button id='generate-document' class='btn btn-primary btn-block'>
                        					<span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp Generate Document
                        				</button>
                        			</div>
                        		</div>
                        	</div>

                        	<!--- Contract Doc --> 
                        	<div class='row' id='generated-contract-form' style='display:none'>
                        		<style> 
                        			#back-to-form a { 
                        			cursor: pointer; 
                        			} 
                        		</style>
                        		<div id='back-to-form'><a>
                        			<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 
                        			Back to contract form
                        		</a></div>
                        		<br />
                        		<div id='generated-contract-cont'>

                        		</div>
                        	</div>
                        </div>
                    </div>
                    
                </div>
                <script>
		        	$(document).ready(function(){

		        		$('#sign-out').click(function(){
		        			$('#app-container').html("Logging out...");

		        			var _url = "<?php echo base_url(); ?>index.php/App/authPage";
				        	$.ajax({
				        		url: _url, success: function(data){
				        			$('#app-container').html(data);
				        		}
				        	});
		        		});

		        		$('#back-to-form a').click(function(){
		        			$('#generated-contract-form').hide("slide", { direction: "right" }, 350, function(){
								// Generate initial stuff...
								$('#contract-form').show('slide', { direction: 'left'}, 350);
							}); 
		        		});

		        		$('#generate-document').click(function(){
		        			var dataset = []; 

		        			var loading = "<div align='center'><img src='<?php echo base_url(); ?>assets/loader.gif' /> <br /> Generating PDF document... Please wait...</div>";
		        			$('#generated-contract-cont').html(loading);

		        			var text = "<div class='alert alert-warning'>";
		        			var closeText = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		        			$('.data-handle').each(function(){ dataset.push($(this).val()); });

		        			if (dataset[0] == ""){
		        				text += closeText+"Please enter your buyer's last name.</div>";
		        				$('#action-message').html(text).show(0);	
		        			} else if (dataset[1] == ""){
		        				text += closeText+"Please enter your buyer's first name.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[2] == ""){
		        				text += closeText+"Please enter your buyer's middle name.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[3] == ""){
		        				text += closeText+"Please enter your seller's last name.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[4] == ""){
		        				text += closeText+"Please enter your seller's first name.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[5] == ""){
		        				text += closeText+"Please enter your seller's middle name.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[6] == ""){
		        				text += closeText+"Please enter your property's street address.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[7] == ""){
		        				text += closeText+"Please enter your property's barangay.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else if (dataset[8] == ""){
		        				text += closeText+"Please enter your property's city.</div>";
		        				$('#action-message').html(text).show(0);
		        			} else {
								$('#action-message').html("").show(0);

								$('#contract-form').hide("slide", { direction: "left" }, 350, function(){
									// Generate initial stuff...

									$('#generated-contract-form').show('slide', { direction: 'right'}, 350);

									var _url = "<?php echo base_url(); ?>index.php/App/doc/";
									$.ajax({
										url: _url, method: "POST", data: { p: dataset },
										dataType: 'json', success: function(data){
											//console.log(data);
											if (data.link == null){
												var message = '<div class="alert alert-danger" role="alert">';
												message += '<b>Ooops!</b> There might be an error in generating your document. Please try again.';
												message += '</div>';

												$('#generated-contract-cont').html(message);
											} else {
												var w = $('#generated-contract-form').width();
												var width = w;
												var height = $(window).height() * 0.9;

												var message = "<iframe src='"+data.link+"' width='"+width+"px' height='"+height+"px' />";
												$('#generated-contract-cont').html(message);
											}
										}, error: function(){
											var message = '<div class="alert alert-danger" role="alert">';
											message += '<b>Ooops!</b> There might be an error in generating your document. Please try again.';
											message += '</div>';

											$('#generated-contract-cont').html(message);
										}
									});
								}); 
		        			}
		        			

		        		});
		        	});
		        </script>