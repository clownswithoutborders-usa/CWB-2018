<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/common/cidzero.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/common/cidzero.tpl', 1, false),array('block', 'ts', 'CRM/common/cidzero.tpl', 3, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (! empty ( $this->_tpl_vars['nocid'] )): ?>
  <div class="crm-other-contact-row messages status">
    <span><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You are completing this form on behalf of someone else. Please enter their details.</span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php if (! empty ( $this->_tpl_vars['selectable'] )): ?>
    <div class="crm-contact-select-row">
      <div class="crm-content">
        <?php echo $this->_tpl_vars['form']['select_contact_id']['html']; ?>

      </div>
    </div>
  <?php endif; ?>
  </div>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>