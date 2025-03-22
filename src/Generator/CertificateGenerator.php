<?php

namespace App\Generator;

use App\Models\Certificate;
use App\Services\CertificateService;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;
use App\Utils\UnitConverter;
use App\Config\Config;

class CertificateGenerator
{
    private CertificateService $certificate_service;   
    private array $participant;
    private array $text_boxes = [];
    private array $certificate_info = [];

    public function __construct(array $participant, Certificate $certificate_model)
    {
        $this->certificate_service = new CertificateService($certificate_model);
        $this->participant = $participant;
    }

    public function generate(): array
    {
        $this->createTextBoxes();
        $this->setCertificateLink();
        $this->createCertificateImage();
        return $this->certificate_info;
    }

    private function createTextBoxes(): void
    {
        $training_name = "Training Sistem Informasi Manajemen Rumah Sakit";
        $text_box_data = [
            ['text' => $this->participant['p_name'], 'size' => new Size(24, 2.2), 'coordinate' => new Coordinate(5.4, 6.97), 'font' => TextStyles::$TITLE],
            ['text' => "Divisi " . $this->participant['division_name'], 'size' => new Size(24, 0.63), 'coordinate' => new Coordinate(5.4, 11.65), 'font' => TextStyles::$SUBTITLE],
            ['text' => $this->participant['facility_name'], 'size' => new Size(24, 0.63), 'coordinate' => new Coordinate(5.4, 13.9), 'font' => TextStyles::$SUBTITLE],
            
            // ['text' => "Dalam partisipasinya mengikuti kegiatan " . $this->participant['training_name'], 'size' => new Size(22.46, 0.65), 'coordinate' => new Coordinate(3.25, 15.3), 'font' => TextStyles::$DESCRIPTION],
            
            ['text' => "Dalam partisipasinya mengikuti kegiatan $training_name", 'size' => new Size(24, 0.65), 'coordinate' => new Coordinate(3.25, 15), 'font' => TextStyles::$DESCRIPTION],
            ['text' => "yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $this->participant['training_date'], 'size' => new Size(24, 0.65), 'coordinate' => new Coordinate(3.25, 15.8), 'font' => TextStyles::$DESCRIPTION]
        ];

        foreach ($text_box_data as $data) {
            $this->text_boxes[] = $this->createTextBox($data['text'], $data['size'], $data['coordinate'], $data['font']);
        }
    }

    private function createTextBox(string $text, Size $size, Coordinate $coordinate, FontStyle $font_style): TextBox
    {
        $text_display = new TextDisplay($text, $font_style);
        return new TextBox($text_display, $size, $coordinate);
    }

    private function createCertificateImage()
    {
        $image = CertificateTemplate::getImage();
        foreach ($this->text_boxes as $text_box) {
            $textbox_width = $text_box->getSize()->getWidth() * UnitConverter::dpiToDpcm(Config::DPI);
            $text_display = $text_box->getTextDisplay();
            $fontStyle = $text_display->getFontStyle();
            $text = $text_display->getAdaptiveText($textbox_width, Config::DPI);
            $coordinate = $text_box->getCoordinate();

            imagettftext($image, $fontStyle->getFontSize(), 0, $coordinate->getXCoordinate(), $coordinate->getYCoordinate(), $fontStyle->getFontColor(), $fontStyle->getFontFilename(), $text);
        }
        $filepath = __DIR__ . '/../../storage/certificates/' . $this->certificate_info['filename'];
        
        imagepng($image, $filepath);
        imagedestroy($image);
    }
    
    private function setCertificateFilename()
    {
        $id = $this->participant['id'];
        $filename = $this->certificate_service->formatCertificateFilename($id); 
        $this->certificate_info['filename'] = $filename;
    }

    private function setCertificateLink()
    {
        $this->setCertificateFilename();
        $link = $this->certificate_service->formatCertificateLink($this->certificate_info['filename']);
        $this->certificate_info['link'] = $link;
    }
}