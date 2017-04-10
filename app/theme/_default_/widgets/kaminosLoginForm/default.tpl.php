<?php


use FormRenderer\FormRenderer;

echo FormRenderer::create()->prepare($v['formModel'])->render();