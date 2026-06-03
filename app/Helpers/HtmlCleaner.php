<?php

namespace App\Helpers;

class HtmlCleaner
{
    public static function clean($html)
    {
       // Reemplazar múltiples espacios no rompibles por espacio normal
        $html = preg_replace('/(&nbsp;)+/', ' ', $html);

        // Eliminar saltos de línea innecesarios
        $html = preg_replace('/\s+/', ' ', $html);

        // Eliminar etiquetas <p> vacías
        $html = preg_replace('/<p>\s*<\/p>/', '', $html);

        // Eliminar todos los <br> (pueden causar espacios visuales)
        $html = preg_replace('/<br\s*\/?>/i', '', $html);

        // Eliminar estilos inline innecesarios
        $html = preg_replace('/style="[^"]*"/i', '', $html);

        // Normalizar listas
        $html = preg_replace('/<ul>/', '<ul style="margin-left: 20px; list-style-type: disc;">', $html);
        $html = preg_replace('/<ol>/', '<ol style="margin-left: 20px; list-style-type: decimal;">', $html);
        $html = preg_replace('/<li>/', '<li style="margin-bottom: 2px;">', $html);

        // Normalizar tablas
        $html = preg_replace('/<table>/', '<table style="width:100%; border-collapse:collapse; font-size:13px;">', $html);
        $html = preg_replace('/<th>/', '<th style="border:1px solid #ccc; padding:4px; background:#013565; color:#fff;">', $html);
        $html = preg_replace('/<td>/', '<td style="border:1px solid #ccc; padding:4px;">', $html);

        // Eliminar etiquetas vacías adicionales
        $html = preg_replace('/<(div|span)[^>]*>\s*<\/\1>/', '', $html);

        return trim($html);
    }
}