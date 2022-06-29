<?php
    function render($tpl_filename,$replaces){
        $tpl = file_get_contents($tpl_filename);
        $tpl = strtr($tpl, $replaces);
        return $tpl;
    }
  ?>