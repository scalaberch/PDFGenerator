<div class="container">
                	<div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our PDF generator</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-top">
                                <div id='login-loading' style='display:none'>
                                    <div align='center'><img src='<?php echo base_url(); ?>assets/loader.gif' /> <br /> 
                                        Logging in... Please wait...<br /><br /></div>
                                </div>
			                    <div role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" id='u'  placeholder="Username..." class="form-username form-control" value=''>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" id='p'  placeholder="Password..." class="form-password form-control"  value=''>
			                        </div>
                                    <div class="form-group" id='login-status'>
                                        
                                    </div>
			                        <button type="submit" id='sign-in' class="btn btn-block">Sign in!</button>
			                    </div>
		                    </div>
                        </div>
                    </div>
                </div>
<script>
$(document).ready(function(){
    $('#u').keyup(function(ev){var code=ev.which;if(code==13){$('#sign-in').click();}});$('#p').keyup(function(ev){var code=ev.which;if(code==13){$('#sign-in').click();}});$('#sign-in').click(function(){var username=$('#u');var password=$('#p');$('.login-form').hide('fade',250,function(){$('#login-loading').show('fade',250);var _login="<?php echo base_url(); ?>index.php/App/auth";$.ajax({url:_login,type:"POST",data:{u:username.val(),p:password.val()},dataType:'json',success:function(data){if(data.status){var m='<div class="alert alert-success alert-dismissible" role="alert">'
m+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';m+='<strong>Please wait!</strong> Transferring you to the application.</div>';$('#login-status').html(m);$('#login-loading').hide('fade',250,function(){$('.login-form').show('fade',250);});var _url="<?php echo base_url(); ?>index.php/App/formPage?name="+data.name;$.ajax({url:_url,success:function(data){$('#app-container').html(data);}});}else{var m='<div class="alert alert-warning alert-dismissible" role="alert">'
m+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';m+='<strong>Ooops!</strong> We can\'t find your username/password. Please contact kieth for your username/password.</div>';$('#login-status').html(m);$('#login-loading').hide('fade',250,function(){$('.login-form').show('fade',250);});}},error:function(){var m='<div class="alert alert-warning alert-dismissible" role="alert">'
m+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';m+='<strong>Ooops!</strong> There seems to be an error in logging in. Please try again.</div>';$('#login-status').html(m);$('#login-loading').hide('fade',250,function(){$('.login-form').show('fade',250);});}})});});
});
</script>