<?php /* Smarty version 2.6.27, created on 2017-03-24 13:15:25
         compiled from CRM/Price/Form/Calculate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Price/Form/Calculate.tpl', 1, false),array('block', 'ts', 'CRM/Price/Form/Calculate.tpl', 33, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $this->assign('hideTotal', $this->_tpl_vars['quickConfig']+$this->_tpl_vars['noCalcValueDisplay']); ?>
<div id="pricesetTotal" class="crm-section section-pricesetTotal">
  <div class="label
  <?php if ($this->_tpl_vars['hideTotal']): ?>,  hiddenElement<?php endif; ?>" id="pricelabel">
    <label>
      <?php if (( $this->_tpl_vars['extends'] == 'Contribution' ) || ( $this->_tpl_vars['extends'] == 'Membership' )): ?>
      <span id='amount_sum_label'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Fee(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
       <?php if ($this->_tpl_vars['isAdditionalParticipants']): ?> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>for this participant<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
      <?php endif; ?>
    </label>
  </div>
  <div class="content calc-value" <?php if ($this->_tpl_vars['hideTotal']): ?>style="display:none;"<?php endif; ?> id="pricevalue" ></div>
</div>

<script type="text/javascript">
<?php echo '

var thousandMarker = \''; ?>
<?php echo $this->_tpl_vars['config']->monetaryThousandSeparator; ?>
<?php echo '\';
var separator      = \''; ?>
<?php echo $this->_tpl_vars['config']->monetaryDecimalPoint; ?>
<?php echo '\';
var symbol         = \''; ?>
<?php echo $this->_tpl_vars['currencySymbol']; ?>
<?php echo '\';
var optionSep      = \'|\';

cj("#priceset [price]").each(function () {

    var elementType =  cj(this).attr(\'type\');
    if ( this.tagName == \'SELECT\' ) {
      elementType = \'select-one\';
    }

    switch(elementType) {
      case \'checkbox\':
        //event driven calculation of element.
        cj(this).click(function(){
          calculateCheckboxLineItemValue(this);
          display(calculateTotalFee());
        });
        calculateCheckboxLineItemValue(this);
      break;

    case \'radio\':
      //event driven calculation of element.
      cj(this).click( function(){
        calculateRadioLineItemValue(this);
        display(calculateTotalFee());
      });
      calculateRadioLineItemValue(this);
      break;

  case \'text\':

    //event driven calculation of element.
    cj(this).bind( \'keyup\', function() {
      calculateText(this);
    }).bind( \'blur\' , function() {
      calculateText(this);
    });
    //default calculation of element.
    calculateText(this);

    break;

  case \'select-one\':
    calculateSelectLineItemValue(this);

    //event driven calculation of element.
    cj(this).change( function() {
      calculateSelectLineItemValue(this);
      display(calculateTotalFee());
    });


    break;

  }
  display(calculateTotalFee());
});

/**
 * Calculate the value of the line item for a radio value.
 */
function calculateCheckboxLineItemValue(priceElement) {
  eval( \'var option = \' + cj(priceElement).attr(\'price\') ) ;
  optionPart = option[1].split(optionSep);
  price = parseFloat(0);
  if (cj(priceElement).prop(\'checked\')) {
    price = parseFloat(optionPart[0]);
  }
  cj(priceElement).data(\'line_raw_total\', price);
}

/**
 * Calculate the value of the line item for a radio value.
 */
function calculateRadioLineItemValue(priceElement) {
  eval( \'var option = \' + cj(priceElement).attr(\'price\') );
  optionPart = option[1].split(optionSep);
  var lineTotal = parseFloat(optionPart[0]);
  cj(priceElement).data(\'line_raw_total\', lineTotal);
  var radionGroupName = cj(priceElement).attr("name");
  // Reset all unchecked options to having a data value of 0.
  cj(\'input[name=\' + radionGroupName + \']:radio:unchecked\').each(
    function () {
      cj(this).data(\'line_raw_total\', 0);
    }
  );
}

/**
 * Calculate the value of the line item for a select value.
 */
function calculateSelectLineItemValue(priceElement) {
  eval( \'var selectedText = \' + cj(priceElement).attr(\'price\') );
  var price = parseFloat(\'0\');
  var option = cj(priceElement).val();
  if (option) {
    optionPart = selectedText[option].split(optionSep);
    price   = parseFloat(optionPart[0]);
  }
  cj(priceElement).data(\'line_raw_total\', price);
}

/**
 * Calculate the value of the line item for a text box.
 */
function calculateText(priceElement) {
  //CRM-16034 - comma acts as decimal in price set text pricing
  var textval = parseFloat(cj(priceElement).val().replace(thousandMarker, \'\'));

  if (isNaN(textval)) {
    textval = parseFloat(0);
  }
  eval(\'var option = \'+ cj(priceElement).attr(\'price\'));
  optionPart = option[1].split(optionSep);
  addprice = parseFloat(optionPart[0]);
  var curval  = textval * addprice;
  cj(priceElement).data(\'line_raw_total\', curval);
  display(calculateTotalFee());
}

/**
 * Calculate the total fee for the visible priceset.
 */
function calculateTotalFee() {
  var totalFee = 0;
  cj("#priceset [price]").each(function () {
    totalFee = totalFee + cj(this).data(\'line_raw_total\');
  });
  return totalFee;
}

/**
 * Display calculated amount.
 */
function display(totalfee) {

    // totalfee is monetary, round it to 2 decimal points so it can
    // go as a float - CRM-13491
    totalfee = Math.round(totalfee*100)/100;
    var totalEventFee  = formatMoney( totalfee, 2, separator, thousandMarker);
    document.getElementById(\'pricevalue\').innerHTML = "<b>"+symbol+"</b> "+totalEventFee;

    cj(\'#total_amount\').val( totalfee );
    cj(\'#pricevalue\').data(\'raw-total\', totalfee).trigger(\'change\');

    ( totalfee < 0 ) ? cj(\'table#pricelabel\').addClass(\'disabled\') : cj(\'table#pricelabel\').removeClass(\'disabled\');
    if (typeof skipPaymentMethod == \'function\') {
      // Advice to anyone who, like me, feels hatred towards this if construct ... if you remove the if you
      // get an error on participant 2 of a event that requires approval & permits multiple registrants.
      skipPaymentMethod();
    }
}

//money formatting/localization
function formatMoney (amount, c, d, t) {
var n = amount,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "," : d,
    t = t == undefined ? "." : t, s = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\\d{3})(?=\\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

'; ?>

</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>