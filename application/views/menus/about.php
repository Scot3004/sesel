<?php
echo anchor('main/readme', $this->lang->line('sesel_about'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('graficos/', $this->lang->line('sesel_graphs'), 'data-role="button" data-icon="check" data-theme="a" data-ajax="false"');
echo anchor('main/license/license-gpl3', $this->lang->line('sesel_license'), 'data-role="button" data-icon="check" data-theme="a" data-ajax="false"');
