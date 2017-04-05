<div class="widget widget-exception">
    <h1>An exception occurred</h1>
    <?php


    /**
     * @var \Exception $exception
     */
    $exception = $v['exception'];
    $showMessage = $v['showMessage'];
    $showTrace = $v['showTrace'];
    $showFile = $v['showFile'];
    $showCode = $v['showCode'];
    $showLine = $v['showLine'];


    ?>
    <style>
        .widget-exception table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .widget-exception table tr,
        .widget-exception table td {
            border: 1px solid black;
        }

        .widget-exception table td {
            padding: 5px;
        }
    </style>
    <table>
        <?php if ($showMessage): ?>
            <tr>
                <td>Message</td>
                <td><?php echo $exception->getMessage(); ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($showFile): ?>
            <tr>
                <td>File</td>
                <td><?php echo $exception->getFile(); ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($showCode): ?>
            <tr>
                <td>Code</td>
                <td><?php echo $exception->getCode(); ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($showLine): ?>
            <tr>
                <td>Line</td>
                <td><?php echo $exception->getLine(); ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($showTrace): ?>
            <tr>
                <td>Trace</td>
                <td><?php echo nl2br($exception->getTraceAsString()); ?></td>
            </tr>
        <?php endif; ?>
    </table>
</div>
