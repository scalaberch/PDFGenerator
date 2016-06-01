<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->view('login');
		$this->load->view('form');
	}

	public function auth(){
		$username = $_POST['u'];
		$password = $_POST['p'];

		$users    = array('user1', 'user2', 'user3');
		$passes   = array('pass1', 'pass2', 'pass3');
		$names    = array('User 1', 'User 2', 'User 3');

		$isAuth = false; $name = "";
		for($i=0; $i<count($users); $i++){
			if ($username == $users[$i] and $password == $passes[$i]){
				$isAuth = true; $name = $names[$i];
				break;
			}
		}

		echo json_encode(array('status'=>$isAuth, 'name'=>$name));
	}

	public function authPage(){
		$this->load->view('loginPage', true);
	}

	public function formPage(){
		$this->load->view('formPage', true);
	}

	public function doc(){

		$result = array();
		$parameters = $_POST['p'];
		$this->load->library('Pdf');

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('scalaberch');
		$pdf->SetTitle('Generated PDF Document');

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();
		$pdf->SetFont('dejavusans', '', 10);


		$buyerName = strtoupper($parameters[0].", ".$parameters[1]." ".$parameters[2]);
		$sellerName = strtoupper($parameters[3].", ".$parameters[4]." ".$parameters[5]);

		$address = strtoupper($parameters[6]);
		$barangay = strtoupper($parameters[7]);
		$city = strtoupper($parameters[8]);
		$province = strtoupper($parameters[9]);

		$day = strval($parameters[12]);
		$l = strlen($day);

		if ($l > 1){
			if ($day[$l - 2] == '1'){
				$limitedPower = true;	
			} else {
				$limitedPower = false;
			}
		} else { $limitedPower = false; }

		if ($day[$l - 1] == '1'){
			if (!$limitedPower){ $day .= "st"; } else { $day .= "th"; }
		} else if ($day[$l - 1] == '2'){
			if (!$limitedPower){ $day .= "nd"; } else { $day .= "th"; }
		} else if ($day[$l - 1] == '3'){
			if (!$limitedPower){ $day .= "rd"; } else { $day .= "th"; }
		} else {
			$day .= "th";
		}

		$month = strtoupper($parameters[11]);
		$year = $parameters[10];


		// create some HTML content
		$html = '<h2 align="center">Some Sample Contract</h2>
			<br /><br />
		<p>
			The first party (henceforth known as "Buyer") agrees to purchase from the second party 
			(henceforth known as "Seller") the land (henceforth known as "Land") located at the 
			following address: '.$address.', '.$barangay.', city/municipality of '.$city.', province of 
			'.$province.'.
		</p>
		<p>
			The following terms and conditions apply to this Contract:
		</p>
		<p>
			Price : Buyer agrees to purchase the Land described above, paying a total purchase price of Php. 300,000.00. Buyer will pay	Php 100.00 for a down payment, and thereafter payments will be made monthly and monthly installments will be in the amount of Php 5,000.00, including a 0.02% interest rate.
		</p>

		<p>
		End of contract : The entire balance must be paid three (3) months after the first payment was met. If there is a remaining balance on this date, the interest on said balance shall be 12%, with a Php. 5,000.00 late fee applied every day month until the balance is paid in full.
		</p>

		<p>
		Default : If Buyer does not pay 2 payments on time, Seller has the right to declare Buyer in default of this Contract.
		</p>
		<p>
		Title : Upon final payment, when entire purchase price has been paid in full, Buyer agrees to provide Seller with the title(s) and/or deed(s) to the Land. Seller further agrees to relinquish any and all claims to the Land. Buyer agrees to remove Seller from any liability with regard to issues that arise after the date of the title transfer. Buyer agrees to take complete responsibility, financial and otherwise, for the Land upon title transfer.
		</p>
		<p>
		Insurance : Seller agrees to maintain a hazard insurance policy on the Land of no less than Php. 5,000.00 until the completion of the payment plan, at which point any insurance becomes the responsibility of Buyer.
		</p>
		<p>
		Taxes : All taxes on the Land shall be the responsibility of Buyer as of the date of this Contract.
		</p>
		<p></p><p></p>
		<p>This Contract is executed on the '.$day.' of '.$month.', '.$year.'</p>
		<p></p><p></p>
		<p>We, the undersigned, agree to this Contract and all its terms.</p>
		<p></p><p></p><p></p><p></p>
		<table>
			<tr>
			<td>
				<u>'.$buyerName.'</u>
			</td>
			<td>
				<u>'.$sellerName.'</u>
			</td>
			</tr>
			<tr>
			<td>
				First Party. Buyer
			</td>
			<td>
				Second Party. Seller
			</td>
			</tr>
			<tr><td></td></tr><tr><td></td></tr>
			<tr>
				<td>_________________________</td>
				<td>_________________________</td>
				</tr>
				<tr>
				<td>Date Signed </td>
				<td>Date Signed </td>
			</tr>
		</table>
		';

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');



		$request = md5(date("Y-m-d H:i:s.u"));
		$actual_link = '/Users/scalaberch/www/bugtick/client/SumitpdfGen/pdf/Contract-'.$request.'.pdf';
		$url = base_url()."pdf/Contract-".$request.'.pdf';
		$pdf->Output($actual_link, 'F');

		echo json_encode(array('link'=>$url));


		//$pdf->Output('/Users/scalaberch/www/bugtick/client/SumitpdfGen/pdf/pdfexample.pdf', 'I');
	}
}
