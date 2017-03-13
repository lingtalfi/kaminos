<?php





foreach ($v['controls'] as $control):
    switch ($control['type']) {
        case 'input':
            echo "pou";
            break;
        default:
            echo "Unknown control type: " . $control['type'];
            break;
    }

endforeach;