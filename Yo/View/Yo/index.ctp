<h1>Yo</h1>
<?php
echo $this->Form->button('Get', array('id' => 'button'));
$script = "$('#button').click(function()
    {
        $.get('".$this->Html->url(array('action' => 'zomg'))."', function(data) {
            $('.result').html(data);
        });
    }
    );";
$this->Html->scriptBlock($script, array('block' => 'script'));
?>
<div class="result"></div>