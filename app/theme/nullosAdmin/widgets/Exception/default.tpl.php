<!-- page content -->
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number">Oops</h1>
            <h2>An exception occurred</h2>
            <div class="mid_center">
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
                <table class="table text-left table-bordered">
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
        </div>
    </div>
</div>
<!-- /page content -->
