<script>
// PJ #1 - Tab selection
function select_tab(tab){
	$(".el_tabcontainer").hide();
	$("#tab_" + tab).show();
	$(".el_tabs ul li a").removeClass("s");
	$(".el_tabs ul li:nth-child(" + tab +") a").addClass("s");
}
</script>

<div class="color_red fs24 mt33">There are three services that we provide</div>

<div class="el_tabs">
	<ul>
		<li><a onclick="select_tab(1);" class="s">Calibration in-house</a></li>
		<li><a onclick="select_tab(2);" >Calibration on-site</a></li>
		<li><a onclick="select_tab(3);" >Repairs</a></li>
	</ul>
</div>

<div class="el_tabcontainer" id="tab_1">
	<div class="fs24 color_red center" style="line-height: 26px; padding-bottom: 35px; padding-top: 15px">Sending your item for calibration is easy</div>
	<div class="el_singletab">
		<div class="label">Step 1</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-a"></div>Send your well wrapped instrument to us
			</div>
			<ul class="b">
				<li>Email <a href="mailto:service@guymark.com">service@guymark.com</a> or call 01384 890606 for calibration charges.</li>
				<li>Complete our service request form. (email or post with your instrument)</li>
				<li>Pack your instrument along with all relevant transducers and accessories.</li>
				<li>Download and print off our box label.</li>
				<li>Post your instrument using your current despatch provider.</li>
				<li>Alternatively email <a href="mailto:service@guymark.com">service@guymark.com</a> or call 01384 890606 to arrange collection (additional charges apply)</li>

			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 2</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-b"></div>We will calibrate your instrument
			</div>
			<ul class="b">
				<li>All received instruments are booked onto our service database.</li>
				<li>An acknowledgement email will be sent to inform you of your instruments safe arrival and all items received.</li>
				<li>If you instrument does not arrive safely we will inform you immediately.</li>
				<li>All calibrations will be carried out to the relevant parts of BS EN ISO389, BS EN 60645 and manufacturer's service literature.</li>
				<li>UKAS calibrations will be carried out on all suitable and relevant instruments.</li>
				<li>A purchase order (account holders only) or other payment method will be required.</li>
			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 3</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-a"></div>We will post your instrument back to you
			</div>
			<ul class="b">
				<li>You will be notified of your instruments date of despatch.</li>
				<li>We will use FedEx to safely despatch your instrument, tracking information can be provided if required.</li>
				<li>Along with your received instrument you will find all relevant calibration certificates.</li>
				<li>Sign the despatch note and return in the pre-paid envelope.</li>
				<li>We will contact you with a calibration reminder one month before expiry date to arrange for the instruments next annual calibration.</li>
			</ul>
		</div>
	</div>
</div>

<div class="el_tabcontainer hidden" id="tab_2">
	<div class="fs24 color_red center" style="line-height: 26px; padding-bottom: 35px; padding-top: 15px">Sending your item for calibration is easy</div>
	<div class="el_singletab">
		<div class="label">Step 1</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-c"></div>Arrange your on-site calibration visit
			</div>
			<ul class="b">
				<li>Email your equipment list (inventory) to <a href="mailto:service@guymark.com">service@guymark.com</a> or call 01384 890606 to discuss our calibration charges.</li>
				<li>Alternatively complete our equipment list and email to <a href="mailto:service@guymark.com">service@guymark.com</a></li>
				<li>Include in your correspondence the dates your annual calibration is due.</li>
				<li>We will email you a quotation letter and quotation with a list of contract options and a number of optional dates for our visit.</li>
				<li>Upon acceptance of our quotation you will then receive an on-site confirmation letter to sign and return.</li>
				<li>A purchase order (account holders only) or other payment method will be required at this stage.</li>
			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 2</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-b"></div>We will calibrate your instruments on-site
			</div>
			<ul class="b">
				<li>On the confirmed on-site visit date our engineers will report to the relevant contact person, upon arrival.</li>
				<li>If required we will attend any induction process and any permit to work or Health &amp; Safety procedure that your hospital requires.</li>
				<li>All calibrations will be carried out to the relevant parts of BS EN ISO389, BS EN 60645 and manufacturer's service literature.</li>
				<li>UKAS calibrations will be carried out on all suitable and relevant instruments.</li>
			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 3</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-d"></div>We will post your completed reports
			</div>
			<ul class="b">
				<li>All calibration certificates and relevant reports will be processed and either posted or emailed to you.</li>
				<li>We will invoice the relevant department only for the work we have physically completed. This invoice will be posted or emailed dependent on your request.</li>
				<li>You will receive acknowledgement of next years visit dates pencilled into our diary awaiting your confirmation.</li>
			</ul>
		</div>
	</div>
</div>

<div class="el_tabcontainer hidden" id="tab_3">
	<div class="fs24 color_red center" style="line-height: 26px; padding-bottom: 35px; padding-top: 15px">Sending your item for calibration is easy</div>
	<div class="el_singletab">
		<div class="label">Step 1</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-a"></div>Send your well wrapped instrument to us
			</div>
			<ul class="b">
				<li>Email <a href="mailto:service@guymark.com">service@guymark.com</a> or call 01384 890606 for repair enquiries.</li>
				<li>Complete our service request form. (email <a href="mailto:service@guymark.com">service@guymark.com</a> or post with your instrument)</li>
				<li>Pack your instrument along with all relevant transducers and accessories.</li>
				<li>Download and print off our box label.</li>
				<li>Post your instrument using your current despatch provider.</li>
				<li>Alternatively email <a href="mailto:service@guymark.com">service@guymark.com</a> or call 01384 890606 to arrange collection (additional charges apply)</li>
			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 2</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-e"></div>We will repair your instrument
			</div>
			<ul class="b">
				<li>All received instruments are booked onto our service database.</li>
				<li>An acknowledgement email will be sent to inform you of your instruments safe arrival and all items received.</li>
				<li>If you instrument does not arrive safely we will inform you immediately.</li>
				<li>All instruments for repair will receive a work authorisation form itemising the fault, cause and action required.</li>
				<li>All costs will be included and no repair will take place without your agreed authorisation.</li>
				<li>If you decide you do not wish to go ahead with the repair and need the instrument returned, you will be charged an inspection fee and carriage.</li>
				<li>If you wish for the instrument to be scrapped at Guymark UK, we will dispose of it safely at no charge.</li>
				<li>A purchase order (account holders only) or other payment method will be required.</li>
			</ul>
		</div>
		<div class="arrow"></div>
	</div>
	<div class="el_singletab">
		<div class="label">Step 3</div>
		<div class="box">
			<div class="a">
				<div class="iconset1-a"></div>We will post your instrument back to you
			</div>
			<ul class="b">
				<li>You will be notified of your instruments date of despatch.</li>
				<li>We will use FedEx to safely despatch your instrument, tracking information can be provided if required.</li>
				<li>Within your received instrument you will find all relevant repair reports.</li>
				<li>Sign the despatch note and return in the pre-paid envelope.</li>
			</ul>
		</div>
	</div>
</div>