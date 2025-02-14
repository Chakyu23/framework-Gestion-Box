<?php

use Illuminate\Support\HtmlString;

if (!function_exists('renderEditorJsContent')) {
    function renderEditorJsContent($content):HtmlString
    {
        // Vérifier si $content est en JSON et le décoder
        $decodedContent = json_decode($content, true);

        if (!$decodedContent) {
            return new HtmlString('<p>Contenu non valide</p>');
        }

        $html = '';

        foreach ($decodedContent['blocks'] as $block) {
            switch ($block['type']) {
                case 'paragraph':
                    $html .= '<p>' . e($block['data']['text']) . '</p>';
                    break;

                case 'header':
                    $level = $block['data']['level'];
                    $html .= "<h{$level}>" . e($block['data']['text']) . "</h{$level}>";
                    break;

                case 'list':
                    $listTag = $block['data']['style'] === 'unordered' ? 'ul' : 'ol';
                    $html .= "<{$listTag}>";
                    foreach ($block['data']['items'] as $item) {
                        $html .= '<li>' . e($item) . '</li>';
                    }
                    $html .= "</{$listTag}>";
                    break;

                case 'quote':
                    $html .= '<blockquote>' . e($block['data']['text']) . '</blockquote>';
                    break;

                default:
                    $html .= '<p>Type de bloc non pris en charge</p>';
                    break;
            }
        }

        return new HtmlString($html);
    }
}
