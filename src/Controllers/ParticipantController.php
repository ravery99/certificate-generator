<?php


class ParticipantController extends Controller
{

    public function showCertificate(): void
    {
        $participantModel = $this->loadModel("Participant"); 

        if ($participantModel) {
            $participants = $participantModel->getCertificate(); 
            $this->renderView("certificates", ['participants' => $participants]);
        } else {
            echo "Model Participant tidak ditemukan.";
        }
    }

    public function showExpire(): void
    {
        $participantModel = $this->loadModel("Participant");
        $this->renderView("expired_certificate", [""=> $participantModel]);
    }
}

