<?php

namespace App\Helpers;

class EditorJsHelper
{
    public static function renderContent($jsonContent)
    {
        $data = json_decode($jsonContent, true);

        if (!is_array($data)) {
            return 'Aucun contenu valide.';
        }

        $htmlContent = '';
        foreach ($data as $block) {
            switch ($block['type']) {
                case 'paragraph':
                    $htmlContent .= '<p>' . nl2br(e($block['data']['text'])) . '</p>';
                    break;
                case 'header':
                    $htmlContent .= '<h' . $block['data']['level'] . '>' . e($block['data']['text']) . '</h' . $block['data']['level'] . '>';
                    break;
                case 'list':
                    $htmlContent .= '<ul>';
                    foreach ($block['data']['items'] as $item) {
                        $htmlContent .= '<li>' . e($item) . '</li>';
                    }
                    $htmlContent .= '</ul>';
                    break;
                // Ajoutez d'autres types de blocs si nécessaire (images, liens, etc.)
                default:
                    $htmlContent .= '<p>' . e($block['data']['text']) . '</p>';
            }
        }

        return $htmlContent;
    }
}
