<?php /* Smarty version 2.6.27, created on 2017-03-24 20:21:40
         compiled from CRM/Report/Form/Actions-civiexportexcel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Report/Form/Actions-civiexportexcel.tpl', 1, false),array('modifier', 'cat', 'CRM/Report/Form/Actions-civiexportexcel.tpl', 2, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->assign('csv', ((is_array($_tmp=((is_array($_tmp='_qf_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['form']['formName']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['form']['formName'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '_submit_csv') : smarty_modifier_cat($_tmp, '_submit_csv'))); ?>

<?php $this->assign('excel', ((is_array($_tmp=((is_array($_tmp='_qf_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['form']['formName']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['form']['formName'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '_submit_excel') : smarty_modifier_cat($_tmp, '_submit_excel'))); ?>
<?php echo $this->_tpl_vars['form'][$this->_tpl_vars['excel']]['html']; ?>
&nbsp;&nbsp;

<?php echo '
  <script>
    CRM.$(function($) {
      var form_id = \''; ?>
<?php echo $this->_tpl_vars['form'][$this->_tpl_vars['excel']]['id']; ?>
<?php echo '\';

      '; ?>

                <?php if ($this->_tpl_vars['form'][$this->_tpl_vars['csv']]['id']): ?>
          <?php echo '
            var $dest = $(\'input#'; ?>
<?php echo $this->_tpl_vars['form'][$this->_tpl_vars['csv']]['id']; ?>
<?php echo '\').parent();
            $(\'input#\' + form_id).appendTo($dest);
          '; ?>

        <?php else: ?>
                    <?php echo '
            if ($(\'.crm-report-field-form-block .crm-submit-buttons\').size() > 0) {
              $(\'input#\' + form_id).appendTo(\'.crm-report-field-form-block .crm-submit-buttons\');
            }
            else {
              // Do not show the button when running in a dashlet
              // FIXME: we should probably just not add the HTML in the first place.
              $(\'input#\' + form_id).hide();
            }
          '; ?>

        <?php endif; ?>
      <?php echo '
    });
  </script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>