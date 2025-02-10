<?php


class ParticipantController extends Controller
{
    protected ?Participant $participantModel = null;

    public function __construct()
    {
        $this->participantModel = $this->loadModel("Participant"); 
    }

    public function showCertificate(): void
    {
        if ($this->participantModel) {
            $participants = $this->participantModel->getParticipants(); // Ambil data peserta dari participant.php
            $this->renderView("view_certificates", ['participants' => $participants]);
        } else {
            echo "Model Participant tidak ditemukan.";
        }
    }
}
