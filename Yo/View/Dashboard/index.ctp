<h1>Yo</h1>
<?php
echo $this->Form->button('Get', array('id' => 'button'));
echo $this->Form->input('username');
echo $this->Form->button('Yo', array('id' => 'yo'));
$script = "$('#button').click(function()
    {
        $.get('".$this->Html->url(array('action' => 'getSubscribers'))."', function(data) {
            $('.result').html(data);
        });
    });
    
    $('#yo').click(function()
    {
        $.get('".$this->Html->url(array('action' => 'user'))."', {username:'nanexcool'}, function(data) {
            $('.result').html(data);
        });
    });
";
$this->Html->scriptBlock($script, array('block' => 'script'));
?>
<div class="result"></div>