<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 4.7                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2017                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 *
 * Generated from xml/schema/CRM/ACL/EntityRole.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:005d4928f36bf24b5e20e13f18f0588d)
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
/**
 * CRM_ACL_DAO_EntityRole constructor.
 */
class CRM_ACL_DAO_EntityRole extends CRM_Core_DAO {
  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  static $_tableName = 'civicrm_acl_entity_role';
  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var boolean
   */
  static $_log = false;
  /**
   * Unique table ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * Foreign Key to ACL Role (which is an option value pair and hence an implicit FK)
   *
   * @var int unsigned
   */
  public $acl_role_id;
  /**
   * Table of the object joined to the ACL Role (Contact or Group)
   *
   * @var string
   */
  public $entity_table;
  /**
   * ID of the group/contact object being joined
   *
   * @var int unsigned
   */
  public $entity_id;
  /**
   * Is this property active?
   *
   * @var boolean
   */
  public $is_active;
  /**
   * Class constructor.
   */
  function __construct() {
    $this->__table = 'civicrm_acl_entity_role';
    parent::__construct();
  }
  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static ::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Dynamic(self::getTableName() , 'entity_id', NULL, 'id', 'entity_table');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Entity Role') ,
          'description' => 'Unique table ID',
          'required' => true,
          'table_name' => 'civicrm_acl_entity_role',
          'entity' => 'EntityRole',
          'bao' => 'CRM_ACL_BAO_EntityRole',
        ) ,
        'acl_role_id' => array(
          'name' => 'acl_role_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('ACL Role ID') ,
          'description' => 'Foreign Key to ACL Role (which is an option value pair and hence an implicit FK)',
          'required' => true,
          'table_name' => 'civicrm_acl_entity_role',
          'entity' => 'EntityRole',
          'bao' => 'CRM_ACL_BAO_EntityRole',
        ) ,
        'entity_table' => array(
          'name' => 'entity_table',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Entity Table') ,
          'description' => 'Table of the object joined to the ACL Role (Contact or Group)',
          'required' => true,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'table_name' => 'civicrm_acl_entity_role',
          'entity' => 'EntityRole',
          'bao' => 'CRM_ACL_BAO_EntityRole',
        ) ,
        'entity_id' => array(
          'name' => 'entity_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('ACL Entity ID') ,
          'description' => 'ID of the group/contact object being joined',
          'required' => true,
          'table_name' => 'civicrm_acl_entity_role',
          'entity' => 'EntityRole',
          'bao' => 'CRM_ACL_BAO_EntityRole',
        ) ,
        'is_active' => array(
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('ACL Entity Role is Active') ,
          'description' => 'Is this property active?',
          'table_name' => 'civicrm_acl_entity_role',
          'entity' => 'EntityRole',
          'bao' => 'CRM_ACL_BAO_EntityRole',
        ) ,
      );
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }
  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName() {
    return self::$_tableName;
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog() {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'acl_entity_role', $prefix, array());
    return $r;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'acl_entity_role', $prefix, array());
    return $r;
  }
}
