<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/Contribute/Form/Contribution/PremiumBlock.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Contribution/PremiumBlock.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Contribution/PremiumBlock.tpl', 46, false),array('modifier', 'crmMoney', 'CRM/Contribute/Form/Contribution/PremiumBlock.tpl', 80, false),array('modifier', 'cat', 'CRM/Contribute/Form/Contribution/PremiumBlock.tpl', 87, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['products']): ?>
  <div id="premiums" class="premiums-group">
    <?php if ($this->_tpl_vars['context'] == 'makeContribution'): ?>
      <fieldset class="crm-group premiums_select-group">
      <?php if ($this->_tpl_vars['premiumBlock']['premiums_intro_title']): ?>
        <legend><?php echo $this->_tpl_vars['premiumBlock']['premiums_intro_title']; ?>
</legend>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['premiumBlock']['premiums_intro_text']): ?>
        <div id="premiums-intro" class="crm-section premiums_intro-section">
          <?php echo $this->_tpl_vars['premiumBlock']['premiums_intro_text']; ?>

        </div>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['context'] == 'confirmContribution' || $this->_tpl_vars['context'] == 'thankContribution'): ?>
    <div class="crm-group premium_display-group">
      <div class="header-dark">
        <?php if ($this->_tpl_vars['premiumBlock']['premiums_intro_title']): ?>
          <?php echo $this->_tpl_vars['premiumBlock']['premiums_intro_title']; ?>

        <?php else: ?>
          <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your Premium Selection<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['preview']): ?>
      <?php $this->assign('showSelectOptions', '1'); ?>
    <?php endif; ?>

    <?php echo '<div id="premiums-listings">'; ?><?php if ($this->_tpl_vars['showPremium'] && ! $this->_tpl_vars['preview'] && $this->_tpl_vars['premiumBlock']['premiums_nothankyou_position'] == 1): ?><?php echo '<div class="premium premium-no_thanks" id="premium_id-no_thanks" min_contribution="0"><div class="premium-short"><input type="checkbox" disabled="disabled" /> '; ?><?php echo $this->_tpl_vars['premiumBlock']['premiums_nothankyou_label']; ?><?php echo '</div><div class="premium-full"><input type="checkbox" checked="checked" disabled="disabled" /> '; ?><?php echo $this->_tpl_vars['premiumBlock']['premiums_nothankyou_label']; ?><?php echo '</div></div>'; ?><?php endif; ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?><?php echo '<div class="premium '; ?><?php if ($this->_tpl_vars['showPremium']): ?><?php echo 'premium-selectable'; ?><?php endif; ?><?php echo '" id="premium_id-'; ?><?php echo $this->_tpl_vars['row']['id']; ?><?php echo '" min_contribution="'; ?><?php echo $this->_tpl_vars['row']['min_contribution']; ?><?php echo '"><div class="premium-short">'; ?><?php if ($this->_tpl_vars['row']['thumbnail']): ?><?php echo '<div class="premium-short-thumbnail"><img src="'; ?><?php echo $this->_tpl_vars['row']['thumbnail']; ?><?php echo '" alt="'; ?><?php echo $this->_tpl_vars['row']['name']; ?><?php echo '" /></div>'; ?><?php endif; ?><?php echo '<div class="premium-short-content">'; ?><?php echo $this->_tpl_vars['row']['name']; ?><?php echo '</div><div style="clear:both"></div></div><div class="premium-full"><div class="premium-full-image">'; ?><?php if ($this->_tpl_vars['row']['image']): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['row']['image']; ?><?php echo '" alt="'; ?><?php echo $this->_tpl_vars['row']['name']; ?><?php echo '" />'; ?><?php endif; ?><?php echo '</div><div class="premium-full-content"><div class="premium-full-title">'; ?><?php echo $this->_tpl_vars['row']['name']; ?><?php echo '</div><div class="premium-full-disabled">'; ?><?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=$this->_tpl_vars['row']['min_contribution'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'You must contribute at least %1 to get this item'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '<br/><input type="button" value="'; ?><?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=$this->_tpl_vars['row']['min_contribution'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Contribute %1 Instead'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '" amount="'; ?><?php echo $this->_tpl_vars['row']['min_contribution']; ?><?php echo '" /></div><div class="premium-full-description">'; ?><?php echo $this->_tpl_vars['row']['description']; ?><?php echo '</div>'; ?><?php if ($this->_tpl_vars['showSelectOptions']): ?><?php echo ''; ?><?php $this->assign('pid', ((is_array($_tmp='options_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['row']['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['row']['id']))); ?><?php echo ''; ?><?php if ($this->_tpl_vars['pid']): ?><?php echo '<div class="premium-full-options"><p>'; ?><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['pid']]['html']; ?><?php echo '</p></div>'; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo '<div class="premium-full-options"><p><strong>'; ?><?php echo $this->_tpl_vars['row']['options']; ?><?php echo '</strong></p></div>'; ?><?php endif; ?><?php echo ''; ?><?php if (( ( $this->_tpl_vars['premiumBlock']['premiums_display_min_contribution'] && $this->_tpl_vars['context'] == 'makeContribution' ) || $this->_tpl_vars['preview'] == 1 ) && $this->_tpl_vars['row']['min_contribution'] > 0): ?><?php echo '<div class="premium-full-min">'; ?><?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=$this->_tpl_vars['row']['min_contribution'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Minimum: %1'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</div>'; ?><?php endif; ?><?php echo '<div style="clear:both"></div></div></div><div style="clear:both"></div></div>'; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if ($this->_tpl_vars['showPremium'] && ! $this->_tpl_vars['preview'] && $this->_tpl_vars['premiumBlock']['premiums_nothankyou_position'] == 2): ?><?php echo '<div class="premium premium-no_thanks" id="premium_id-no_thanks" min_contribution="0"><div class="premium-short"><input type="checkbox" disabled="disabled" /> '; ?><?php echo $this->_tpl_vars['premiumBlock']['premiums_nothankyou_label']; ?><?php echo '</div><div class="premium-full"><input type="checkbox" checked="checked" disabled="disabled" /> '; ?><?php echo $this->_tpl_vars['premiumBlock']['premiums_nothankyou_label']; ?><?php echo '</div></div>'; ?><?php endif; ?><?php echo '</div>'; ?>


    <?php if ($this->_tpl_vars['context'] == 'makeContribution'): ?>
      </fieldset>
    <?php elseif (! $this->_tpl_vars['preview']): ?>       </div>
    <?php endif; ?>
  </div>

  <?php if ($this->_tpl_vars['context'] == 'makeContribution'): ?>
    <?php echo '
    <script>
      CRM.$(function($) {
        var is_separate_payment = '; ?>
<?php if ($this->_tpl_vars['membershipBlock']['is_separate_payment']): ?><?php echo $this->_tpl_vars['membershipBlock']['is_separate_payment']; ?>
<?php else: ?>0<?php endif; ?><?php echo ';

        // select a new premium
        function select_premium(premium_id) {
          if($(premium_id).length) {
            // hide other active premium
            $(\'.premium-full\').hide();
            $(\'.premium-short\').show();
            // show this one
            $(\'.premium-short\', $(premium_id)).hide();
            $(\'.premium-full\', $(premium_id)).show();
            // record this one
            var id_parts = premium_id.split(\'-\');
            $(\'#selectProduct\').val(id_parts[1]);
          }
        }

        // click premium to select
        $(\'.premium-short\').click(function(){
          select_premium( \'#\'+$($(this).parent()).attr(\'id\') );
        });

        // select the default premium
        var premium_id = $(\'#selectProduct\').val();
        if(premium_id == \'\') premium_id = \'no_thanks\';
        select_premium(\'#premium_id-\'+premium_id);

        // get the current amount
        function get_amount() {
          var amount;

          if (typeof totalfee !== "undefined") {
            return totalfee;
          }

          // see if other amount exists and has a value
          if($(\'.other_amount-content input\').length) {
            amount = Number($(\'.other_amount-content input\').val());
            if(isNaN(amount))
              amount = 0;
          }

          function check_price_set(price_set_radio_buttons) {
            if (!amount) {
              $(price_set_radio_buttons).each(function(){
                if ($(this).prop(\'checked\')) {
                  amount = $(this).attr(\'data-amount\');
                  if (typeof amount !== "undefined") {
                    amount = Number(amount);
                  }
                  else {
                    amount = 0;
                  }
                }
              });
            }
          }

          // check for additional contribution
          var additional_amount = 0;
          if(is_separate_payment) {
            additional_amount = amount;
            amount = 0;
          }

          // make sure amount is a number at this point
          if(!amount) amount = 0;

          // next, check for membership/contribution level price set
          check_price_set(\'#priceset input[type="radio"]\');

          // account for is_separate_payment
          if(is_separate_payment && additional_amount) {
            amount += additional_amount;
          }

          return amount;
        }

        // update premiums
        function update_premiums() {
          var amount = get_amount();

          $(\'.premium\').each(function(){
            var min_contribution = $(this).attr(\'min_contribution\');
            if(amount < min_contribution) {
              $(this).addClass(\'premium-disabled\');
            } else {
              $(this).removeClass(\'premium-disabled\');
            }
          });
        }
        $(\'.other_amount-content input\').change(update_premiums);
        $(\'input, #priceset\').change(update_premiums);
        update_premiums();

        // build a list of price sets
        var amounts = [];
        var price_sets = {};
        $(\'input, #priceset  select,#priceset\').each(function(){
          if (this.tagName == \'SELECT\') {
            var selectID = $(this).attr(\'id\');
            var selectvalues = JSON.parse($(this).attr(\'price\'));
            Object.keys(selectvalues).forEach(function (key) {
              var option = selectvalues[key].split(optionSep);
              amount = Number(option[0]);
              price_sets[amount] = \'#\' + selectID + \'-\' + key;
              amounts.push(amount);
            });
          }
          else {
            var amount = Number($(this).attr(\'data-amount\'));
            if (!isNaN(amount)) {
              amounts.push(amount);

             var id = $(this).attr(\'id\');
             price_sets[amount] = \'#\'+id;
            }
          }
        });
        amounts.sort(function(a,b){return a - b});

        // make contribution instead buttons work
        $(\'.premium-full-disabled input\').click(function(){
          var amount = Number($(this).attr(\'amount\'));
          if (price_sets[amount]) {
            if (!$(price_sets[amount]).length) {
              var option =  price_sets[amount].split(\'-\');
              $(option[0]).val(option[1]);
              $(option[0]).trigger(\'change\');
            }
            else if ($(price_sets[amount]).attr(\'type\') == \'checkbox\') {
               $(price_sets[amount]).prop("checked",true);
               if ((typeof totalfee !== \'undefined\') && (typeof display == \'function\')) {
                 if (totalfee > 0) {
                   totalfee += amount;
                 }
                 else {
                   totalfee = amount;
                 }
                 display(totalfee);
               }
             }
             else {
               $(price_sets[amount]).click();
               $(price_sets[amount]).trigger(\'click\');
             }
          } else {
            // is there an other amount input box?
            if($(\'.other_amount-section input\').length) {
              // is this a membership form with separate payment?
              if(is_separate_payment) {
                var current_amount = 0;
                if($(\'#priceset input[type="radio"]:checked\').length) {
                  current_amount = Number($(\'#priceset input[type="radio"]:checked\').attr(\'data-amount\'));
                  if(!current_amount) current_amount = 0;
                }
                var new_amount = amount - current_amount;
                $(\'.other_amount-section input\').val(new_amount.toFixed(2));
              } else {
                $(\'.other_amount-section input\').click();
                $(\'.other_amount-section input\').val($(this).attr(\'amount\'));
              }
            } else {
              // find the next best price set
              var selected_price_set = false;
              for(var i in amounts) {
                if(amounts[i] >= amount) {
                  selected_price_set = amounts[i];
                  break;
                }
              }
              if(!selected_price_set) {
                selected_price_set = amounts[amounts.length-1];
              }

              if (!$(price_sets[selected_price_set]).length) {
                var option =  price_sets[selected_price_set].split(\'-\');
                $(option[0]).val(option[1]);
                $(option[0]).trigger(\'change\');
              }
              else if ($(price_sets[selected_price_set]).attr(\'type\') == \'checkbox\') {
                $(price_sets[selected_price_set]).prop("checked",true);
                if ((typeof totalfee !== \'undefined\') && (typeof display == \'function\')) {
                  if (totalfee > 0) {
                    totalfee += amount;
                  }
                  else {
                    totalfee = amount;
                  }
                  display(totalfee);
                }
             }
             else {
               $(price_sets[selected_price_set]).click();
               $(price_sets[selected_price_set]).trigger(\'click\');
             }
            }
          }
          update_premiums();
        });

        // validation of premiums
        var error_message = \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You must contribute more to get that item<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\';
        $.validator.addMethod(\'premiums\', function(value, element, params){
          var premium_id = $(\'#selectProduct\').val();
          var premium$ = $(\'#premium_id-\'+premium_id);
          if(premium$.length) {
            if(premium$.hasClass(\'premium-disabled\')) {
              return false;
            }
          }
          return true;
        }, error_message);

        // add validation rules
        CRM.validate.functions.push(function(){
          $(\'#selectProduct\').rules(\'add\', \'premiums\');
        });

        // need to use jquery validate\'s ignore option, so that it will not ignore hidden fields
        CRM.validate.params[\'ignore\'] = \'.ignore\';
      });
    </script>
    '; ?>


  <?php else: ?>
    <?php echo '
    <script>
      CRM.$(function($) {
        cj(\'.premium-short\').hide();
        cj(\'.premium-full\').show();
      });
    </script>
    '; ?>

  <?php endif; ?>
<?php endif; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>