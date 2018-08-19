<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/Price/Form/PriceSet.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Price/Form/PriceSet.tpl', 1, false),array('block', 'crmRegion', 'CRM/Price/Form/PriceSet.tpl', 26, false),array('block', 'ts', 'CRM/Price/Form/PriceSet.tpl', 91, false),array('modifier', 'cat', 'CRM/Price/Form/PriceSet.tpl', 42, false),array('modifier', 'count', 'CRM/Price/Form/PriceSet.tpl', 57, false),array('modifier', 'crmMoney', 'CRM/Price/Form/PriceSet.tpl', 80, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('crmRegion', array('name' => "price-set-1")); $_block_repeat=true;smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div id="priceset" class="crm-section price_set-section">
    <?php if ($this->_tpl_vars['priceSet']['help_pre']): ?>
        <div class="messages help"><?php echo $this->_tpl_vars['priceSet']['help_pre']; ?>
</div>
    <?php endif; ?>

    <?php $this->assign('adminFld', false); ?>
    <?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'administer CiviCRM' )): ?>
      <?php $this->assign('adminFld', true); ?>
    <?php endif; ?>

    <?php $_from = $this->_tpl_vars['priceSet']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id'] => $this->_tpl_vars['element']):
?>
                <?php if ($this->_tpl_vars['element']['visibility'] == 'public' || ( $this->_tpl_vars['element']['visibility'] == 'admin' && $this->_tpl_vars['adminFld'] == true ) || $this->_tpl_vars['context'] == 'standalone' || $this->_tpl_vars['context'] == 'advanced' || $this->_tpl_vars['context'] == 'search' || $this->_tpl_vars['context'] == 'participant' || $this->_tpl_vars['context'] == 'dashboard' || $this->_tpl_vars['action'] == 1024): ?>
            <div class="crm-section <?php echo $this->_tpl_vars['element']['name']; ?>
-section">
            <?php if (( $this->_tpl_vars['element']['html_type'] == 'CheckBox' || $this->_tpl_vars['element']['html_type'] == 'Radio' ) && $this->_tpl_vars['element']['options_per_line']): ?>
              <?php $this->assign('element_name', ((is_array($_tmp='price_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['field_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['field_id']))); ?>
              <div class="label"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['label']; ?>
</div>
              <div class="content <?php echo $this->_tpl_vars['element']['name']; ?>
-content">
                <?php $this->assign('elementCount', '0'); ?>
                <?php $this->assign('optionCount', '0'); ?>
                <?php $this->assign('rowCount', '0'); ?>
                <?php $_from = $this->_tpl_vars['form'][$this->_tpl_vars['element_name']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['outer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['outer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['outer']['iteration']++;
?>
                  <?php $this->assign('elementCount', ($this->_tpl_vars['elementCount']+1)); ?>
                  <?php if (is_numeric ( $this->_tpl_vars['key'] )): ?>
                    <?php $this->assign('optionCount', ($this->_tpl_vars['optionCount']+1)); ?>
                    <?php if ($this->_tpl_vars['optionCount'] == 1): ?>
                      <?php $this->assign('rowCount', ($this->_tpl_vars['rowCount']+1)); ?>
                      <div class="price-set-row <?php echo $this->_tpl_vars['element']['name']; ?>
-row<?php echo $this->_tpl_vars['rowCount']; ?>
">
                    <?php endif; ?>
                    <span class="price-set-option-content"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['element_name']][$this->_tpl_vars['key']]['html']; ?>
</span>
                    <?php if ($this->_tpl_vars['optionCount'] == $this->_tpl_vars['element']['options_per_line'] || $this->_tpl_vars['elementCount'] == count($this->_tpl_vars['form'][$this->_tpl_vars['element_name']])): ?>
                      </div>
                      <?php $this->assign('optionCount', '0'); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($this->_tpl_vars['element']['help_post']): ?>
                  <div class="description"><?php echo $this->_tpl_vars['element']['help_post']; ?>
</div>
                <?php endif; ?>
              </div>
            <?php else: ?>

                <?php $this->assign('element_name', ((is_array($_tmp='price_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['field_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['field_id']))); ?>

                <div class="label"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['label']; ?>
</div>
                <div class="content <?php echo $this->_tpl_vars['element']['name']; ?>
-content"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['html']; ?>

                  <?php if ($this->_tpl_vars['element']['html_type'] == 'Text'): ?>
                    <?php if ($this->_tpl_vars['element']['is_display_amounts']): ?>
                    <span class="price-field-amount<?php if ($this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['frozen'] == 1): ?> sold-out-option<?php endif; ?>">
                    <?php $_from = $this->_tpl_vars['element']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
                      <?php if (( $this->_tpl_vars['option']['tax_amount'] || $this->_tpl_vars['option']['tax_amount'] == '0' ) && $this->_tpl_vars['displayOpt'] && $this->_tpl_vars['invoicing']): ?>
                        <?php $this->assign('amount', ($this->_tpl_vars['option']['amount']+$this->_tpl_vars['option']['tax_amount'])); ?>
                        <?php if ($this->_tpl_vars['displayOpt'] == 'Do_not_show'): ?>
                          <?php echo ((is_array($_tmp=$this->_tpl_vars['amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                        <?php elseif ($this->_tpl_vars['displayOpt'] == 'Inclusive'): ?>
                          <?php echo ((is_array($_tmp=$this->_tpl_vars['amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                          <span class='crm-price-amount-label'> (includes <?php echo $this->_tpl_vars['taxTerm']; ?>
 of <?php echo ((is_array($_tmp=$this->_tpl_vars['option']['tax_amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>
)</span>
                        <?php else: ?>
                          <?php echo ((is_array($_tmp=$this->_tpl_vars['option']['amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                          <span class='crm-price-amount-label'> + <?php echo ((is_array($_tmp=$this->_tpl_vars['option']['tax_amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>
 <?php echo $this->_tpl_vars['taxTerm']; ?>
</span>
                        <?php endif; ?>
                      <?php else: ?>
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['option']['amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>
 <?php echo $this->_tpl_vars['fieldHandle']; ?>
 <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['fieldHandle']]['frozen']; ?>

                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['frozen'] == 1): ?> (<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sold out<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    </span>
                    <?php else: ?>
                                            <?php if ($this->_tpl_vars['form'][$this->_tpl_vars['element_name']]['frozen'] == 1): ?>
                        <span class="sold-out-option">(<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sold out<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)<span>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if ($this->_tpl_vars['element']['help_post']): ?><br /><span class="description"><?php echo $this->_tpl_vars['element']['help_post']; ?>
</span><?php endif; ?>
                </div>

            <?php endif; ?>
              <?php if (! empty ( $this->_tpl_vars['extends'] ) && $this->_tpl_vars['extends'] == 'Membership'): ?>
                <?php if (( ! empty ( $this->_tpl_vars['priceSet'] ) && $this->_tpl_vars['element']['id'] == $this->_tpl_vars['priceSet']['auto_renew_membership_field'] ) || ( empty ( $this->_tpl_vars['priceSet'] ) && $this->_tpl_vars['element']['name'] == 'membership_amount' )): ?>
                  <div id="allow_auto_renew">
                    <div class='crm-section auto-renew'>
                      <div class='label'></div>
                      <div class ='content'>
                        <?php if (isset ( $this->_tpl_vars['form']['auto_renew'] )): ?>
                          <?php echo $this->_tpl_vars['form']['auto_renew']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['auto_renew']['label']; ?>

                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
              <div class="clear"></div>
          </div>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>

    <?php if ($this->_tpl_vars['priceSet']['help_post']): ?>
      <div class="messages help"><?php echo $this->_tpl_vars['priceSet']['help_post']; ?>
</div>
    <?php endif; ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Price/Form/Calculate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>