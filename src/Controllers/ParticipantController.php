<?php

namespace App\Controllers;

class ParticipantController extends Controller
{

    public function showCertificate($email, $name, $timestamp): void
    {
        $participantModel = $this->loadModel("Participant"); 

        if ($participantModel) {
            $certificate = $participantModel->findCertificate($email, $name, $timestamp); 
            $certificate ? $this->renderView("certificates", ['certificate' => $certificate]) 
                         : $this->showExpire();
        } else {
            echo "Model Participant tidak ditemukan.";
        }
    }

    public function showExpire(): void
    {
        $participantModel = $this->loadModel("Participant");
        $this->renderView("expired_certificate");
    }
}


