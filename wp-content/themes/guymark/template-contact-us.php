<?php
/*
Template Name: Contact us
*/

the_post();
?>


<?php get_header(); ?>

	<div class="container style-2 contactpage">

		<div class="block">
			<?php woo_breadcrumbs(); ?>
			<?php get_template_part("partials/pj", "banner-map"); ?>

			<div class="el_side">
				<?php 
				$override_parent = 3921;
				get_template_part("partials/pj", "sidebar-nav"); ?>
				<?php get_template_part("partials/pj", "sidebar-news"); ?>
			</div>

			<div class="el_content">
				<?php
				the_content();
				?>
				
				<div class="contact_details mt33">
					<div class="left">
						<p>
							Pay us a visit at the Guymark <br />head quarters:<br /><br />
							<span class="fs16 lh23">
								<span class="color_blue fwbold">Address:</span><br />
								Veronica House<br />
								Old Bush Street<br />
								Brierley Hill<br />
								West Midlands<br />
								DY5 1UB
							</span>
						</p>
					</div>
					<div class="right">
						<p>
							For the main switchboard, pick up the telephone and call us on the contact number below:<br /><br />
							<span class="fs22 fwbold"><span class="color_blue">Telephone: </span>01384 890600</span>
						</p>
						<div class="divider-s"></div>
						<p>
							We still cherish our trusty fax machine, so why not send us a fax on the below number:<br /><br />
							<span class="fs22 fwbold"><span class="color_blue">Fax: </span>01384 890609</span>
						</p>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="divider-l"></div>
				
				<p class="fs16 color_red fwbold">
					Do you know the department you&rsquo;re after? Whether it&rsquo;s sales or order enquiries see the relevant email addresses below and get in touch direct.<br />
					<div class="emails lh25">
						<span class="color_blue fwbold">Direct emails:</span><br />
						<div>
							<div class="label">Sales Enquiries:</div>
							<a href="mailto:sales@guymark.com">sales@guymark.com</a>
							<div class="clearfix"></div>
						</div>
						<div>
							<div class="label">Order Processing:</div>
							<a href="mailto:orders@guymark.com">orders@guymark.com</a>
							<div class="clearfix"></div>
						</div>
						<div>
							<div class="label">Account Enquiries:</div>
							<a href="mailto:accounts@guymark.com">accounts@guymark.com</a>
							<div class="clearfix"></div>
						</div>
						<div>
							<div class="label">Service Enquiries:</div>
							<a href="mailto:service@guymark.com">service@guymark.com</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
				</p>
				
				<div class="divider-l"></div>
				
				<p class="fs16 color_red fwbold pb6">
					Are you in a rush? Contact us via the short enquiry form below:
				</p>
				
				
<script language="javascript">
<!--

function sendDetails(){
	var url = "/wp-content/themes/guymark/js/contact.php";
	var params = ""; 
	
	params += "&form_name=" + encodeBase64(document.getElementById("form_name").value);
	params += "&form_organisation=" + encodeBase64(document.getElementById("form_organisation").value);
	params += "&form_address=" + encodeBase64(document.getElementById("form_address").value);
	params += "&form_telephone=" + encodeBase64(document.getElementById("form_telephone").value);
	params += "&form_email=" + encodeBase64(document.getElementById("form_email").value);
	params += "&form_enquiry=" + encodeBase64(document.getElementById("form_enquiry").value);
    
    var form_offers = document.getElementById('form_offers');
    if(form_offers.checked){
        params += "&form_offers=" + encodeBase64("Yes");
    }
    else {
        params += "&form_offers=" + encodeBase64("No");
    }
	
	
	if (window.XMLHttpRequest) {http = new XMLHttpRequest();}
	else if (window.ActiveXObject){
		try {http = new ActiveXObject("Msxml2.XMLHTTP");} 
		catch (e){try{http = new ActiveXObject("Microsoft.XMLHTTP");}
		catch (e){}
		}
	}
	else return;
	
	http.open("POST", url, false);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.setRequestHeader("Content-length", params.length);
	http.setRequestHeader("Connection", "close");
	http.send(params);

	if(http.status == 200) {
		if(http.responseText == "OK"){
			$("#form_alert").removeClass("red");
			$("#form_alert").addClass("green");
			$("#form_alert").text("Your message was sent successfully. Thank you.");
            $(".contactform .row").hide(); 
		}
		else {
			if(http.responseText.charAt(0) == "r"){
				$("#form_alert").addClass("red");
				$("#form_alert").removeClass("green");
				$("#form_alert").text(http.responseText.substring(1));
			}
			else {
				$("#form_alert").addClass("green");
				$("#form_alert").removeClass("red");
				$("#form_alert").text(http.responseText.substring(1));
			}
		}
	}
	else {
		alert("Please check your Internet connection.");
	}
	return false;

}

-->
</script>
				
				<div class="contactform">
					<div class="row">
						<div class="label">Name <span>*</span></div>
						<input id="form_name" type="text" />
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="label">Organisation</div>
						<input id="form_organisation" type="text" />
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="label">Address</div>
						<textarea id="form_address" name="" cols="" rows="5"></textarea>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="label">Telephone <span>*</span></div>
						<input id="form_telephone" type="text" />
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="label">Email <span>*</span></div>
						<input id="form_email" type="text" />
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="label">Enquiry <span>*</span></div>
						<textarea id="form_enquiry" name="" cols="" rows="5"></textarea>
						<div class="clearfix"></div>
					</div>
					<div class="row final">
						<input id="form_offers" name="" type="checkbox" value="" />
						<div class="label checkbox">Would you like to receive future offers / promotions etc?</div>
						<input name="" type="submit" value="Submit form" onclick="sendDetails();" />
						<div class="clearfix"></div>
					</div>
					<div id="form_alert" class="row final alert">
						
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
	
<?php get_template_part("partials/split-blog"); ?>

<?php get_footer(); ?>
