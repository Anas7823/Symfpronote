<?php
namespace App\Service;

use App\Entity\Note;

class Moyenne
{
    public function calculateAverage(array $notes): float
    {
        if (empty($notes)) {
            return 0.0;
        }

        $total = 0;
        $totcoeff = 0;
        $Unenote = 0;
        foreach ($notes as $note) {
            $Unenote += $note->getLaNote();
            $total += $note->getLaNote() * $note->getMatiere()->getCoeff();
            $totcoeff += $note->getMatiere()->getCoeff();
        }

        return round($total / $totcoeff, 2);
    }
}
