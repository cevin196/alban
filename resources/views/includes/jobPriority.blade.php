@php
    function normalize($value, $min, $max, bool $type)
    {
        $hasil = 0;
        if ($type) {
            $hasil = ($value - $min) / ($max - $min);
        } else {
            $hasil = ($max - $value) / ($max - $min);
        }
    
        return $hasil;
    }
@endphp
