<?php

class Validation
{

    // nimmt einen String entgegen gibt einen boolean zurück
    public function validateText(string $input): bool
    {

        // setze $returnValue auf True
        $returnValue = true;

        // Trimmt den String und falls er leer ist setze $returnValue auf False
        if (empty(trim($input))) {
            $returnValue = false;
        }

        // gibt den $returnValue zurück mit True oder False
        return $returnValue;
    }

    // nimmt einen int entgegen gibt einen boolean zurück
    public function validateNumber(int $input): bool
    {

        // setze $returnValue auf True
        $returnValue = true;

        // falls der int leer ist setze $returnValue auf False
        if (empty(trim($input))) {
            $returnValue = false;
        }

        // gibt den $returnValue zurück mit True oder False
        return $returnValue;
    }
}
