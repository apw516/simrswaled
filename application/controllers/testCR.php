<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class testCR extends CI_Controller {
	public function __construct()
    {
        parent::__construct();		
		$this->load->library('Pdf');
        $this->load->model('model_pencarian');   
    }
	public function index()
	{
        $my_report = "D:\\CR\\rincian.rpt";
        $my_pdf = "D:\\CR\\komen.pdf"; // RPT export to pdf file 

        $ObjectFactory= new COM("CrystalReports11.ObjectFactory.1") or die ("Error on load"); // call COM port 
        $crapp = $ObjectFactory-> CreateObject("CrystalRuntime.Application.10"); // create an instance for Crystal 
        $creport = $crapp->OpenReport($my_report, 1); // call rpt report 
         
      
        $creport->Database->Tables(1)->SetLogOnInfo("komentar", "komentar", "root", ""); 
        $creport->EnableParameterPrompting = 0; 

        //- DiscardSavedData - to refresh then read records
        $creport->DiscardSavedData;
        $creport->ReadRecords();


        //export to PDF process
        $creport->ExportOptions->DiskFileName=$my_pdf; //export to pdf
        $creport->ExportOptions->PDFExportAllPages=true;
        $creport->ExportOptions->DestinationType=1; // export to file
        $creport->ExportOptions->FormatType=31; // PDF type
        $creport->Export(false);

        //------ Release the variables ------
        $creport = null;
        $crapp = null;
        $ObjectFactory = null;

        //------And Now -> Embed the report in the webpage ------
        print "<embed src=\"D:\\xampp\\htdocs\\cia\\cr\\komen.pdf\" width=\"100%\" height=\"100%\">";

    //   $this->load->view('test');
	}   
}
