<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GlobalModel extends CI_Model
{
    public function format_currentcy($value)
    {
        $value = 'Rp ' . number_format($value, 0, ',', '.');
        return $value;
    }

    public function format_percent($value)
    {
        $value = number_format($value, 1, '.', ',') . '%';
        return $value;
    }
}
