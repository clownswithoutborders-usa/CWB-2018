<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/Contribute/Form/Contribution/OnBehalfOf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Contribution/OnBehalfOf.tpl', 1, false),array('block', 'crmRegion', 'CRM/Contribute/Form/Contribution/OnBehalfOf.tpl', 43, false),array('modifier', 'count', 'CRM/Contribute/Form/Contribution/OnBehalfOf.tpl', 44, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['form']['is_for_organization']): ?>
  <div class="crm-public-form-item crm-section <?php echo $this->_tpl_vars['form']['is_for_organization']['name']; ?>
-section">
    <div class="label">&nbsp;</div>
    <div class="content">
      <?php echo $this->_tpl_vars['form']['is_for_organization']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['is_for_organization']['label']; ?>

    </div>
    <div class="clear"></div>
  </div>
<?php endif; ?>

<div class="crm-public-form-item" id="on-behalf-block">
  <?php $this->_tag_stack[] = array('crmRegion', array('name' => "onbehalf-block")); $_block_repeat=true;smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php if (count($this->_tpl_vars['onBehalfOfFields'])): ?>
      <fieldset>
      <legend><?php echo $this->_tpl_vars['fieldSetTitle']; ?>
</legend>
      <?php if ($this->_tpl_vars['form']['org_option']): ?>
        <div id='orgOptions' class="section crm-public-form-item crm-section">
          <div class="content">
            <?php echo $this->_tpl_vars['form']['org_option']['html']; ?>

          </div>
        </div>
      <?php endif; ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/UF/Form/Block.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['onBehalfOfFields'],'mode' => 8,'prefix' => 'onbehalf')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </fieldset>
    <?php endif; ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php echo '
<script type="text/javascript">

  CRM.$(function($) {

    var orgOption = $("input:radio[name=org_option]:checked").attr(\'id\');
    var onBehalfRequired = '; ?>
'$onBehalfRequired'<?php echo ';
    var onbehalfof_id = $(\'#onbehalfof_id\');
    var is_for_organization = $(\'#is_for_organization\');

    selectCreateOrg(orgOption, false);

    if (is_for_organization.length) {
      $(\'#on-behalf-block\').toggle(is_for_organization.is(\':checked\'));
    }

    is_for_organization.on(\'change\', function(){
      $(\'#on-behalf-block\').toggle($(this).is(\':checked\'));
    });

   $("input:radio[name=\'org_option\']").click( function( ) {
     var orgOption = $(this).attr(\'id\');
     selectCreateOrg(orgOption, true);
   });

   onbehalfof_id.change(function() {
    setLocationDetails($(this).val());
   }).change();

   if (onbehalfof_id.length) {
     setLocationDetails(onbehalfof_id.val());
   }

    function resetValues() {
     // Don\'t trip chain-select when clearing values
     $(\'.crm-chain-select-control\', "#select_org div").select2(\'val\', \'\');
     $(\'input[type=text], select, textarea\', "#select_org div").not(\'.crm-chain-select-control, #onbehalfof_id\').val(\'\').change();
     $(\'input[type=radio], input[type=checkbox]\', "#select_org div").prop(\'checked\', false).change();

     $(\'#on-behalf-block input\').not(\'input[type=checkbox], input[type=radio], #onbehalfof_id\').val(\'\');
     // clear checkboxes and radio
     $(\'#on-behalf-block\')
      .find(\'input[type=checkbox], input[type=radio]\')
      .not(\'input[name=org_option]\')
      .attr(\'checked\', false);
    }

   function selectCreateOrg( orgOption, reset ) {
    if (orgOption == \'CIVICRM_QFID_0_org_option\') {
      $("#onbehalfof_id").show().change();
      $("input#onbehalf_organization_name").hide();
    }
    else if (orgOption == \'CIVICRM_QFID_1_org_option\') {
      $("input#onbehalf_organization_name").show();
      $("#onbehalfof_id").hide();
      reset = true;
    }

    if ( reset ) {
      resetValues();
    }
  }

 function setLocationDetails(contactID , reset) {
   resetValues();
   var locationUrl = '; ?>
'<?php echo $this->_tpl_vars['locDataURL']; ?>
'<?php echo ' + contactID;
   var submittedOnBehalfInfo = '; ?>
'<?php echo $this->_tpl_vars['submittedOnBehalfInfo']; ?>
'<?php echo ';
   var submittedCID = '; ?>
"<?php echo $this->_tpl_vars['submittedOnBehalf']; ?>
"<?php echo ';

   if (submittedOnBehalfInfo) {
     submittedOnBehalfInfo = $.parseJSON(submittedOnBehalfInfo);

     if (submittedCID == contactID) {
       $.each(submittedOnBehalfInfo, function(key, value) {
         //handle checkboxes
         if (typeof value === \'object\') {
           $.each(value, function(k, v) {
             $(\'#onbehalf_\' + key + \'_\' + k).prop(\'checked\', v);
           });
         }
         else if ($(\'#onbehalf_\' + key).length) {
           $(\'#onbehalf_\' + key ).val(value);
         }
         //radio buttons
         else if ($("input[name=\'onbehalf[" + key + "]\']").length) {
           $("input[name=\'onbehalf[" + key + "]\']").val([value]);
         }
       });
       return;
     }
   }

   $.ajax({
    url         : locationUrl,
    dataType    : "json",
    timeout     : 5000, //Time in milliseconds
    success     : function(data, status) {
      for (var ele in data) {
        if ($("#"+ ele).hasClass(\'crm-chain-select-target\')) {
          $("#"+ ele).data(\'newVal\', data[ele].value).off(\'.autofill\').on(\'crmOptionsUpdated.autofill\', function() {
            $(this).off(\'.autofill\').val($(this).data(\'newVal\')).change();
          });
        }
        else if ($(\'#\' + ele).data(\'select2\')) {
          $(\'#\' + ele).select2(\'val\', data[ele].value);
        }
        if (data[ele].type == \'Radio\') {
          if (data[ele].value) {
            var fldName = ele.replace(\'onbehalf_\', \'\');
            $("input[name=\'onbehalf["+ fldName +"]\']").filter("[value=\'" + data[ele].value + "\']").prop(\'checked\', true);
          }
        }
        else if (data[ele].type == \'CheckBox\') {
          for (var selectedOption in data[ele].value) {
            var fldName = ele.replace(\'onbehalf_\', \'\');
            $("input[name=\'onbehalf["+ fldName+"]["+ selectedOption +"]\']").prop(\'checked\',\'checked\');
          }
        }
        else if (data[ele].type == \'AdvMulti-Select\') {
          var customFld = ele.replace(\'onbehalf_\', \'\');
          // remove empty value if any
          $(\'#onbehalf\\\\[\'+ customFld +\'\\\\]-f option[value=""]\').remove();
          $(\'#onbehalf\\\\[\'+ customFld +\'\\\\]-t option[value=""]\').remove();

          for (var selectedOption in data[ele].value) {
            // remove selected values from left and selected values to right
            $(\'#onbehalf\\\\[\'+ customFld +\'\\\\]-f option[value="\' + selectedOption + \'"]\').remove()
              .appendTo(\'#onbehalf\\\\[\'+ customFld +\'\\\\]-t\');
            $(\'#onbehalf_\'+ customFld).val(selectedOption);
          }
        }
        else {
          // do not set defaults to file type fields
          if ($(\'#\' + ele).attr(\'type\') != \'file\') {
            $(\'#\' + ele ).val(data[ele].value).change();
          }
        }
      }
    },
    error       : function(XMLHttpRequest, textStatus, errorThrown) {
      CRM.console(\'error\', "HTTP error status: ", textStatus);
    }
  });
}
});

</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>