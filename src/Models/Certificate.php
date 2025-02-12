<?php

namespace App\Models;

use App\Utils\CertificateTemplate;
use App\Utils\TextStyles;
use App\Models\Participant;

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
            ['text' => $this->participant->getName(), 'size' => new Size(18.91, 2.2), 'coordinate' => new Coordinate(100, 200), 'font' => TextStyles::$TITLE],
            ['text' => "Divisi " . $this->participant->getDivision(), 'size' => new Size(17.97, 0.93), 'coordinate' => new Coordinate(100, 300), 'font' => TextStyles::$SUBTITLE],
            ['text' => $this->participant->getFacility(), 'size' => new Size(17.97, 0.93), 'coordinate' => new Coordinate(100, 360), 'font' => TextStyles::$SUBTITLE],
            // ['text' => "Dalam partisipasinya mengikuti kegiatan " . $this->participant->getTrainingName(), 'size' => new Size(22.46, 0.65), 'coordinate' => new Coordinate(100, 420), 'font' => TextStyles::$DESCRIPTION],
            ['text' => "Dalam partisipasinya mengikuti kegiatan $training_name", 'size' => new Size(22.46, 0.65), 'coordinate' => new Coordinate(100, 420), 'font' => TextStyles::$DESCRIPTION],
            ['text' => "yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $this->participant->getTrainingDate(), 'size' => new Size(22.46, 0.65), 'coordinate' => new Coordinate(100, 480), 'font' => TextStyles::$DESCRIPTION]
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
            $text_display = $text_box->getTextDisplay();
            $fontStyle = $text_display->getFontStyle();
            $text = $text_display->getText();
            $coordinate = $text_box->getCoordinate();

            imagettftext($image, $fontStyle->getFontSize(), 0, $coordinate->getXCoordinate(), $coordinate->getYCoordinate(), $fontStyle->getFontColor(), $fontStyle->getFontFilename(), $text);
        }

        $filename = $this->formatCertificateFilename();
        $filepath = '../../storage/certificates/' . $filename;

        imagepng($image, $filepath);
        imagedestroy($image);

        return $filepath;
    }

    private function formatText(string $text): string
    {
        $cleanText = preg_replace('/[^A-Za-z0-9\-]/', '_', $text);
        return $cleanText;
    }

    private function formatCertificateFilename(): string
    {
        $email = $this->participant->getEmail();
        $name = $this->participant->getName();

        $cleanEmail = $this->formatText($email);
        $cleanName = $this->formatText($name);
        $timestamp = time();

        $filename = sprintf('%s-%s-%d.png', $cleanEmail, $cleanName, $timestamp);
        return $filename;
    }
}