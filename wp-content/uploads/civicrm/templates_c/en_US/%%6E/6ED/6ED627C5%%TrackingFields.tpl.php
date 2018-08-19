<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/common/TrackingFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/common/TrackingFields.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['trackingFields'] && ! empty ( $this->_tpl_vars['trackingFields'] )): ?>
<?php echo '
<script type="text/javascript">
CRM.$(function($) {
'; ?>

    <?php $_from = $this->_tpl_vars['trackingFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['trackingFieldName'] => $this->_tpl_vars['dontCare']):
?>
       $("#<?php echo $this->_tpl_vars['trackingFieldName']; ?>
").parent().parent().hide( );
    <?php endforeach; endif; unset($_from); ?>
<?php echo '
  }
);
</script>
'; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>