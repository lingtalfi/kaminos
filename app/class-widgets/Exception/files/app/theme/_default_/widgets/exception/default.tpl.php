<div class="widget widget-exception">
    <?php

    $displayMode = $v['displayMode'];
    $exception = $v['exception'];

    /**
     * @var \Exception $exception
     */


    switch ($displayMode) {
        case 'message':
            echo $exception->getMessage();
            break;
        case 'line':
            echo $exception->getLine();
            break;
        case 'trace':
            echo $exception->getTraceAsString();
            break;
        default:
            break;
    }


    ?>
</div>
