<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->input('pdfCategory');
        switch($type) {
            case 'print-phealth-cf1':
                return $this->generatePhilhealthCf1Pdf();

            case 'print-phealth-cf2':
                return $this->generatePhilhealthCf2Pdf();

            case 'print-phealth-cf3':
                return $this->generatePhilhealthCf3Pdf();

            case 'print-phealth-cf4':
                return $this->generatePhilhealthCf4Pdf();

            case 'print-prescription':
                return $this->generatePrescriptionPdf();

            default:
                return response()->json(['message' => 'Invalid Slug'], 400);
        }
    }

    function generatePrescriptionPdf()
    {
        $file = resource_path('/pdfs/prescription_request.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, no-store, must-revalidate', // Prevent caching
            // 'Pragma' => 'no-cache', // HTTP 1.0 backwards compatibility
            // 'Expires' => '0', // Proxies
        ];

        return response()->streamDownload(function () use ($file) {
            readfile($file);
        }, 'prescription.pdf', $headers);
    }

    private function generatePhilhealthCf1Pdf() 
    {
        $file = resource_path('/pdfs/cf1.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->streamDownload(function () use ($file) {
            readfile($file);
        }, 'philhealth-cf1.pdf', $headers);
    } 

    private function generatePhilhealthCf2Pdf()
    {
        $file = resource_path('/pdfs/cf2.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->streamDownload(function () use ($file) {
            readfile($file);
        }, 'philhealth-cf2.pdf', $headers);
    }

    private function generatePhilhealthCf3Pdf()
    {
        $file = resource_path('/pdfs/cf3.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->streamDownload(function () use ($file) {
            readfile($file);
        }, 'philhealth-cf3.pdf', $headers);
    }

    private function generatePhilhealthCf4Pdf()
    {
        $file = resource_path('/pdfs/cf4.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->streamDownload(function () use ($file) {
            readfile($file);
        }, 'philhealth-cf4.pdf', $headers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
