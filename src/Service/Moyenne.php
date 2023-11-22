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
        foreach ($notes as $note) {
            $total += $note->getLaNote();
        }

        return round($total) / count($notes);
    }
}
