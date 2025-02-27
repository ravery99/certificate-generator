<?php

namespace App\Models;

use App\Utils\CertificateService;
use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;
use App\Models\Participant;
use App\Utils\UnitConverter;
use App\Config\Config;

class Certificate
{
    private Participant $participant;
    private array $text_boxes = [];

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function generate(): string
    {
        $this->createTextBoxes();
        return $this->createCertificateImage();
    }

    private function createTextBoxes(): void
    {
        $training_name = "Training Sistem Informasi Manajemen Rumah Sakit";
        $text_box_data = [
            ['text' => $this->participant->getName(), 'size' => new Size(24, 2.2), 'coordinate' => new Coordinate(5.4, 6.97), 'font' => TextStyles::$TITLE],
            ['text' => "Divisi " . $this->participant->getDivision(), 'size' => new Size(24, 0.63), 'coordinate' => new Coordinate(5.4, 11.65), 'font' => TextStyles::$SUBTITLE],
            ['text' => $this->participant->getFacility(), 'size' => new Size(24, 0.63), 'coordinate' => new Coordinate(5.4, 13.9), 'font' => TextStyles::$SUBTITLE],
            
            // ['text' => "Dalam partisipasinya mengikuti kegiatan " . $this->participant->getTrainingName(), 'size' => new Size(22.46, 0.65), 'coordinate' => new Coordinate(3.25, 15.3), 'font' => TextStyles::$DESCRIPTION],
            
            ['text' => "Dalam partisipasinya mengikuti kegiatan $training_name", 'size' => new Size(24, 0.65), 'coordinate' => new Coordinate(3.25, 15), 'font' => TextStyles::$DESCRIPTION],
            ['text' => "yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $this->participant->getTrainingDate(), 'size' => new Size(24, 0.65), 'coordinate' => new Coordinate(3.25, 15.8), 'font' => TextStyles::$DESCRIPTION]
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

    private function createCertificateImage(): string
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
        $filepath = $this->setCertificatePath();
        imagepng($image, $filepath);
        imagedestroy($image);

        return $filepath;
    }

    private function setCertificatePath(): string 
    {
        $certificate_service = new CertificateService();   
        $email = $this->participant->getEmail();
        $name = $this->participant->getName();

        $filename = $certificate_service->formatCertificateFilename($email, $name);
        $filepath = __DIR__ . '/../../storage/certificates/' . $filename;

        return $filepath;
    }


}