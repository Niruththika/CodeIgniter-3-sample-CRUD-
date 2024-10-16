<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/third_party/dompdf/autoload.inc.php';

class Dompdf extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}